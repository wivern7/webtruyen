<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = User::orderBy('updated_at', 'DESC')->get();
        return view('admin.user.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'txtName' => 'required|max:255',
            'txtEmail' => 'required|email|max:255|unique:users,email',
            'txtPassword' => 'required|confirmed|min:6',
        ], [
            'txtName.required' => 'Bạn chưa điền tên',
            'txtName.max' => 'Tên chỉ tối đa 255 ký tự',
            'txtEmail.required' => 'Bạn chưa điền Email',
            'txtEmail.unique' => 'Email này đã được sử dụng',
            'txtEmail.max' => 'Email chỉ tối đa 255 ký tự',
            'txtEmail.email' => 'Không đúng định dạng Email',
            'txtPassword.required' => 'Bạn chưa điền mật khẩu',
            'txtPassword.confirmed' => 'Xác nhận mậy khẩu không khớp',
            'txtPassword.min' => 'Mật khẩu ít nhất phải có 6 ký tự',
        ]);

        User::create([
            'name' => $request->txtName,
            'email' => $request->txtEmail,
            'password' => bcrypt($request->txtPassword),
            'level' => $request->txtLevel,
        ]);

        return redirect()->route('dashboard.user.index')->with(['flash_message' => 'Tạo thành viên thành công !', 'flash_level' => 'success']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('admin.user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'txtName' => 'required|max:255',
            'txtEmail' => 'required|email|max:255',
            'txtPassword' => 'confirmed|min:6',
        ], [
            'txtName.required' => 'Bạn chưa điền tên',
            'txtName.max' => 'Tên chỉ tối đa 255 ký tự',
            'txtEmail.required' => 'Bạn chưa điền Email',
            'txtEmail.max' => 'Email chỉ tối đa 255 ký tự',
            'txtEmail.email' => 'Không đúng định dạng Email',
            'txtPassword.confirmed' => 'Xác nhận mậy khẩu không khớp',
            'txtPassword.min' => 'Mật khẩu ít nhất phải có 6 ký tự',
        ]);

        $user = User::find($request->id);
        $user->name = $request->txtName;
        $user->email = $request->txtEmail;
        if(!empty($request->txtPasswoard)) $user->password = bcrypt($request->txtPassword);
        $user->level = $request->txtLevel;
        $user->save();
        return redirect()->route('dashboard.user.index')->with(['flash_message'=> 'Thành viên đã lưu thành công !', 'flash_level'=> 'success']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('dashboard.user.index')->with(['flash_message'=> 'Xóa thành viên thành công !', 'flash_level'=> 'success']);
    }

    public function passwordChange(Request $request)
    {
        $this->validate($request, [
            'txtPassword' => 'confirmed|min:6',
        ], [
            'txtPassword.confirmed' => 'Xác nhận mậy khẩu không khớp',
            'txtPassword.min' => 'Mật khẩu ít nhất phải có 6 ký tự',
        ]);
        $user = User::find(\Auth::user()->id);
        $user->password = bcrypt($request->txtPassword);
        $user->save();
        return redirect()->route('dashboard.changepassword')->with(['flash_message'=> 'Đã đổi mật khẩu thành công !', 'flash_level'=> 'success']);

    }
}
