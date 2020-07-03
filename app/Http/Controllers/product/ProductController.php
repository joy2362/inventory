<?php

namespace App\Http\Controllers\product;

use Image;
use DB;
use App\Category;
use App\Http\Controllers\Controller;
use App\Product;
use App\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product=Product::paginate(2);
        return response()->json($product);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'category_id'=>'required',
            'product_name'=>'required',
            'product_code'=>'required',
            'buying_price'=>'required|integer',
            'selling_price'=>'required|integer',
            'image'=>'required',
            'product_quentity'=>'required|integer',
        ]);
        $pos = strpos($request->image, ';');
        $sub = substr($request->image,0,$pos);
        $ext = explode('/',$sub)[1];
        $name=Str::random(10).".".$ext;
        $img=Image::make($request->image)->resize(240,200);
        $upload='back/product';
        $img_name=$upload.'/'.$name;
        $img->save($img_name);

        $product= new Product;
        $product->category_id = $request->category_id;
        $product->product_name = $request->product_name;
        $product->product_code = $request->product_code;
        $product->buying_price = $request->buying_price;
        $product->selling_price = $request->selling_price;
        $product->product_quentity = $request->product_quentity;
        $product->image = $img_name;

        if ($request->supplier_id){
            $product->supplier_id = $request->supplier_id;
        }
        if ($request->root){
            $product->root = $request->root;
        }
        if ($request->buying_date){
            $product->buying_date = $request->buying_date;
        }
        if ($request->product_expiredate){
            $product->product_expiredate = $request->product_expiredate;
        }

        $product->save();
        return  response()->json('product added successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = DB::table('products')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->join('suppliers', 'products.supplier_id', '=', 'suppliers.id')
            ->where('products.id', $id)
            ->select('products.*', 'categories.name as category', 'suppliers.name as supplier')
            ->get();
       // $product = Product::where('id',$id)->first();
        if ($product){
            return response()->json($product);
        }else{
            return response()->json(['message' => 'Product not found'],404);
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product= Product::where('id',$id)->first();
        $old_img=$product->image;
        if ($request->image){
            $pos = strpos($request->image, ';');
            $sub = substr($request->image,0,$pos);
            $ext = explode('/',$sub)[1];
            $name=Str::random(10).".".$ext;
            $img=Image::make($request->image)->resize(240,200);
            $upload='back/product';
            $img_name=$upload.'/'.$name;
            $img->save($img_name);
            unlink($old_img);
            $product->image = $img_name;
        }
        if ($request->category_id !=''){
            $product->category_id=$request->category_id;
        }
        if ($request->product_name !=''){
            $product->product_name=$request->product_name;
        }
        if ($request->product_code !=''){
            $product->product_code=$request->product_code;
        }
        if ($request->buying_price !=''){
            $product->buying_price = $request->buying_price;
        }
        if ($request->selling_price !=''){
            $product->selling_price=$request->selling_price;
        }
        if ($request->product_quentity !=''){
            $product->product_quentity=$request->product_quentity;
        }
        if ($request->supplier_id !=''){
            $product->supplier_id=$request->supplier_id;
        }
        if ($request->root !=''){
            $product->root=$request->root;
        }
        if ($request->buying_date !=''){
            $product->buying_date=$request->buying_date;
        }
        if ($request->product_expiredate !=''){
            $product->product_expiredate=$request->product_expiredate;
        }
        $product->save();
        return  response()->json('product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product= Product::where('id',$id)->first();
        unlink($product->image);
        Product::where('id',$id)->delete();
        return response()->json('success');
    }


    public function getCategory(){
        $category = Category::all();
        return response()->json($category);
    }

    public function getSupplier(){
        $supplier = Supplier::all();
        return response()->json($supplier);
    }
}
