<?php

namespace App\Http\Controllers\supplier;

use App\Http\Controllers\Controller;
use App\Supplier;
use Image;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SuplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $supplier=Supplier::paginate(2);
        return response()->json($supplier);
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
            'name'=>'required|min:5',
            'email'=>'required|email',
            'phone'=>'required',
            'shopname'=>'required',
            'avatar'=>'required',
            'address'=>'required',
        ]);

        $pos = strpos($request->avatar, ';');
        $sub = substr($request->avatar,0,$pos);
        $ext = explode('/',$sub)[1];
        $name=Str::random(10).".".$ext;
        $img=Image::make($request->avatar)->resize(240,200);
        $upload='back/supplier';
        $img_name=$upload.'/'.$name;
        $img->save($img_name);

        $supplier=new Supplier;
        $supplier->name = $request->name;
        $supplier->email = $request->email;
        $supplier->phone = $request->phone;
        $supplier->shopname = $request->shopname;
        $supplier->address = $request->address;
        $supplier->avatar = $img_name;
        $supplier->save();
        return response()->json(['success'=>'Supplier added successfully']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $supplier = Supplier::where('id',$id)->first();
        return response()->json($supplier);
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
        $supplier = Supplier::where('id',$id)->first();
        $old_img=$supplier->avatar;
        if ($request->name !=''){
            $supplier->name=$request->name;
        }
        if ($request->email !=''){
            $supplier->email=$request->email;
        }
        if ($request->phone !=''){
            $supplier->phone=$request->phone;
        }
        if ($request->address !=''){
            $supplier->address=$request->address;
        }
        if ($request->shopname !=''){
            $supplier->shopname=$request->shopname;
        }
        if ($request->avatar){
            $pos = strpos($request->avatar, ';');
            $sub = substr($request->avatar,0,$pos);
            $ext = explode('/',$sub)[1];
            $name=Str::random(10).".".$ext;
            $img=Image::make($request->avatar)->resize(240,200);
            $upload='back/supplier';
            $img_name=$upload.'/'.$name;
            $img->save($img_name);
            unlink($old_img);
            $supplier->avatar = $img_name;
        }
        $supplier->save();
        return response()->json('successfully updated',200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $supplier = Supplier::where('id',$id)->first();
        unlink($supplier->avatar);
        Supplier::where('id',$id)->delete();
        return response()->json('success');
    }
}
