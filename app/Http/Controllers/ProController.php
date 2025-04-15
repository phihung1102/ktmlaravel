<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ProController extends Controller
{
    public function getListPro(){
        $products = Product::with('category_pro')->orderBy('id', 'desc')->get();
        return view('admin.products.pro_list', compact('products')); 
    }

    public function getAddPro(){
        $categories = Category::all();
        return view('admin.products.pro_add', compact('categories'));
    }

    public function postAddPro(Request $req){
        $validated = $req->validate([
            'name' => 'required|unique:products,name',
            'description' => 'required',
            'price' => 'required|numeric',
            'sale_price' => 'required|numeric',
            'new' => 'required|boolean',
            'top' => 'required|boolean',
            'status' => 'required|in:active,inactive',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ],[
            'name.required' => 'Vui lòng nhập tên sản phẩm!',
            'name.unique' => 'Sản phẩm đã tồn tại!',
            'description.required' => 'Vui lòng nhập mô tả!',
            'price.required' => 'Vui lòng nhập giá!',
            'sale_price.required' => 'Vui lòng nhập giá khuyến mãi!',
            'new.required' => 'Vui lòng chọn trạng thái mới!',
            'top.required' => 'Vui lòng chọn sản phẩm nổi bật!',
            'status.required' => 'Vui lòng chọn trạng thái!',
            'category_id.required' => 'Vui lòng chọn danh mục!',
        ]);
    
        $pro = new Product();
        $pro->name = $req->name;
        $pro->description = $req->description;
        $pro->price = $req->price;
        $pro->sale_price = $req->sale_price;
        $pro->new = $req->new;
        $pro->top = $req->top;
        $pro->status = $req->status;
        $pro->category_id = $req->category_id;
    
        if($req->hasFile('image')){
            $file = $req->file('image');
            $filename = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('images'), $filename);
            $pro->image = $filename;
        }
    
        if($pro->save()){
            return redirect()->route('getListPro')->with('success', 'Thêm sản phẩm thành công!');
        } else {
            return redirect()->route('getListPro')->with('error', 'Thêm sản phẩm thất bại!');
        }
    }
    

    public function getEditPro($id){
        $product = Product::findOrFail($id);
        $categories = Category::all();
        return view('admin.products.pro_edit', compact('product', 'categories'));
    }

    public function postEditPro(Request $req, $id){
        $validated = $req->validate([
            'name' => 'required|unique:products,name,'.$id,
            'description'=>'required',
            'price' => 'required|numeric',
            'sale_price' => 'required|numeric',
            'new' => 'required|boolean',
            'top' => 'required|boolean',
            'status' => 'required|in:active,inactive',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ],[
            'name.required'=>'Vui lòng nhập tên danh mục!',
            'name.unique'=>'Tên danh mục đã tồn tại!',
            'description.required'=>'Vui lòng nhập mô tả!',
            'price.required' => 'Vui lòng nhập giá!',
            'sale_price.required' => 'Vui lòng nhập giá khuyến mãi!',
            'new.required' => 'Vui lòng chọn trạng thái mới!',
            'top.required' => 'Vui lòng chọn sản phẩm nổi bật!',
            'status.required' => 'Vui lòng chọn trạng thái!',
            'category_id.required' => 'Vui lòng chọn danh mục!',
        ]);
        $product = Product::findOrFail($id);
        $product->update([
            'name'=>$req->name,
            'description'=>$req->description,
            'price'=>$req->price,
            'sale_price'=>$req->sale_price,
            'new'=>$req->new,
            'top'=>$req->top,
            'status'=>$req->status,
            'category_id'=>$req->category_id,
        ]);
        if($req->hasFile('image')){
            if($product->image && file_exists(public_path('images/' . $product->image))){
                unlink(public_path('images/' . $product->image));
            }

            $img = $req->file('image');
            $imgName = time() . '_' .$img->getClientOriginalName();
            $img->move(public_path('images'), $imgName);
            $product->image = $imgName;
            $product->save();
        }
        return redirect()->route('getListPro')->with('success', 'Sửa thành công!');
    }

    public function delPro($id){
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()->route('getListPro')->with('success', 'Xóa thành công!');
    }


    public function getProDetails($id){
        $product = Product::with('category_pro')->findOrFail($id);
        $related_products = Product::where('category_id', $product->category_id)->where('id', '!=', $product->id)->get();
        return view('pages.pro__details', compact('product', 'related_products'));
    }
}
