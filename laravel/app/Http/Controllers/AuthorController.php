<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\AuthorRequest;
use App\Author;

class AuthorController extends Controller
{
    public function index()
    {
        $data = Author::select('id', 'name')->orderBy('id', 'DESC')->get()->toArray();
        return view('admin.author.index', compact('data'));
    }

    public function create()
    {
        return view('admin.author.create');
    }

    public function store(AuthorRequest $request)
    {
        $category = new Author;
        $category->name      = $request->txtAuthorName;
        $category->alias     = changeTitle($request->txtAuthorName);
        $category->keyword   = $request->txtKeyword;
        $category->description = $request->txtDescription;
        $category->save();
        return redirect()->route('dashboard.author.index')->with(['flash_message'=> 'Thêm tác giả thành công !', 'flash_level'=> 'success']);
    }

    public function destroy($id)
    {
        if(!\Auth::user()->isAdmin())
            return redirect()->route('dashboard.author.index')->with(['flash_message'=> 'Bạn không phải quản trị viên !', 'flash_level'=> 'danger']);
        $cat    = Author::find($id);
        $cat->delete();
        return redirect()->route('dashboard.author.index')->with(['flash_message'=> 'Xóa tác giả thành công !', 'flash_level'=> 'success']);
    }

    public function edit(\App\Author $author)
    {
        if(!\Auth::user()->isAdmin())
            return redirect()->route('dashboard.author.index')->with(['flash_message'=> 'Bạn không phải quản trị viên !', 'flash_level'=> 'danger']);
        $data   = $author->toArray();
        return view('admin.author.edit', compact('data'));
    }

    public function update(Request $request)
    {
        $this->validate($request,
            ['txtAuthorName' => 'required'],
            ['txtAuthorName.required' => 'Vui lòng nhập tên vào']
            );

        $category = Author::find($request->id);
        $category->name      = $request->txtAuthorName;
        $category->alias     = changeTitle($request->txtCategoryName);
        $category->keyword   = $request->txtKeyword;
        $category->description = $request->txtDescription;
        $category->save();
        return redirect()->route('dashboard.author.index')->with(['flash_message'=> 'Tác giả đã lưu thành công !', 'flash_level'=> 'success']);
    }

    /**
     * AJAX
     */
    public function ajaxCreate(Request $request)
    {
         $this->validate($request,
            ['nameAuthor' => 'required|unique:authors,name']);

        if ($request->ajax()) {
            $author = new Author;
            $author->name      = $request->nameAuthor;
            $author->alias     = changeTitle($request->nameAuthor);
            $author->save();
            return [
            'status' => 'done',
            'msg' => 'Tác giả đã được tạo thành công !',
            'idAuthor' => $author->id
            ];
        }
        return 'FALSE';
    }
}
