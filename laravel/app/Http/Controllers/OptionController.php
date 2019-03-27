<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Option;

class OptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.setting.index');
    }

    public function update(Request $request)
    {
        $data = $request->all();
        foreach($data as $key => $value)
        {
            if($key != '_token' && $key != '_method')
                Option::put($key, $value);
        }
        if(($request->hasFile('fImages')))
        {
            @unlink(public_path('assets/images/watemark.png'));
            $request->file('fImages')->move(public_path('assets/images'), 'watermark.png');
        }
        return redirect()->route($data['_redirect'])->with(['flash_message'=> 'Mọi thay đổi đã lưu thành công !', 'flash_level'=> 'success']);
   }

    public function tos()
    {
        return view('admin.setting.tos');
    }

    public function ads()
    {
        return view('admin.setting.ads');
    }
}
