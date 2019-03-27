<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $data = Category::select('id', 'name', 'parent_id')->orderBy('id', 'DESC')->get()->toArray();
        return view('admin.category.index', compact('data'));
    }

    public function create()
    {
        $parent = Category::select('id', 'name', 'parent_id')->orderBy('id', 'DESC')->get()->toArray();
        return view('admin.category.create', compact('parent'));
    }

    public function store(CategoryRequest $request)
    {
        $category = new Category;
        $category->name      = $request->txtCategoryName;
        $category->alias     = changeTitle($request->txtCategoryName);
        $category->parent_id = (int) $request->intParent;
        $category->keyword   = $request->txtKeyword;
        $category->description = $request->txtDescription;
        $category->save();
        return redirect()->route('dashboard.category.index')->with(['flash_message'=> 'Tạo chuyên mục thành công !', 'flash_level'=> 'success']);
    }

    public function destroy(Category $category)
    {
        $parent = Category::where('parent_id', $category->id)->count();
        if($parent == 0){
            $category->delete();
            return redirect()->route('dashboard.category.index')->with(['flash_message'=> 'Xóa chuyên mục thành công !', 'flash_level'=> 'success']);
        }
        return redirect()->route('dashboard.category.index')->with(['flash_message'=> 'Xóa chuyên mục không thành công, chuyên mục này tồn tại chuyên mục con !', 'flash_level'=> 'danger']);
    }

    public function edit(Category $category)
    {
        $data   = $category->toArray();
        $parent = Category::select('id', 'name', 'parent_id')->orderBy('id', 'DESC')->get();
        return view('admin.category.edit', compact('parent', 'data'));
    }

    public function update(Request $request)
    {
        $this->validate($request,
            ['txtCategoryName' => 'required'],
            ['txtCategoryName.required' => 'Vui lòng nhập tên vào']
            );

        $category = Category::find($request->id);
        $category->name      = $request->txtCategoryName;
        $category->alias     = changeTitle($request->txtCategoryName);
        $category->parent_id = (int) $request->intParent;
        $category->keyword   = $request->txtKeyword;
        $category->description = $request->txtDescription;
        $category->save();
        return redirect()->route('dashboard.category.index')->with(['flash_message'=> 'Chuyên mục đã lưu thành công !', 'flash_level'=> 'success']);
    }

    /**
     * AJAX
     */
    public function ajaxCreate(Request $request)
    {
         $this->validate($request,
            ['nameCategory' => 'required|unique:categories,name']);

        if ($request->ajax()) {
            $category = new Category;
            $category->name      = $request->nameCategory;
            $category->alias     = changeTitle($request->nameCategory);
            $category->save();
            return [
            'status' => 'done',
            'msg' => 'Chuyên mục đã được tạo thành công !',
            'idCategory' => $category->id
            ];
        }
        return 'FALSE';
    }
}
