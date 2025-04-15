<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CateController extends Controller
{   
    public function getListCate(){
        $categories = Category::orderBy('id', 'desc')->get();
        return view('admin.categories.cate_list', compact('categories')); 
    }

    public function getAddCate(){
        return view('admin.categories.cate_add');
    }

    public function postAddCate(Request $req){
        $validated = $req->validate([
            'name'=>'required|unique:categories,name',
            'description'=>'required',
        ],[
            'name.required'=>'Vui lòng nhập tên danh mục!',
            'name.unique'=>'Danh mục đã tồn tại',
            'description'=>'Vui lòng nhập tmô tả danh mục!',
        ]);
        $cate = new Category();
        $cate->name = $req->name;
        $cate->description = $req->description;
        $cate->save();
        return redirect()->route('getListCate')->with('success', 'Thêm danh mục thành công!');
        return redirect()->route('getListCate')->with('error', 'Thêm danh mục thất bại!');
    }

    public function getEditCate($id){
        $category = Category::findOrFail($id);
        return view('admin.categories.cate_edit', compact('category'));
    }

    public function postEditCate(Request $req, $id){
        $validated = $req->validate([
            'name' => 'required|unique:categories,name,'.$id,
            'description'=>'required',
        ],[
            'name.required'=>'Vui lòng nhập tên danh mục!',
            'name.unique'=>'Tên danh mục đã tồn tại!',
            'description.required'=>'Vui lòng nhập mô tả!',
        ]);
        $category = Category::findOrFail($id);
        $category->update([
            'name'=>$req->name,
            'description'=>$req->description,
        ]);
        return redirect()->route('getListCate')->with('success', 'Sửa thành công!');
        return redirect()->route('getListCate')->with('success', 'Sửa thất bại!');
    }

    public function delCate($id){
        $category = Category::findOrFail($id);
        $category->delete();
        return redirect()->route('getListCate')->with('success', 'Xóa thành công!');
        return redirect()->route('getListCate')->with('success', 'Xóa thất bại!');
    }
}
