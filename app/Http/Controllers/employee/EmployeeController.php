<?php

namespace App\Http\Controllers\employee;

use App\Employee;
use App\Http\Controllers\Controller;
use Image;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $employee=Employee::paginate(2);
        return response()->json($employee);
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
            'salary'=>'required|integer',
            'position'=>'required',
            'avatar'=>'required',
            'address'=>'required',
        ]);

        $pos = strpos($request->avatar, ';');
        $sub = substr($request->avatar,0,$pos);
        $ext = explode('/',$sub)[1];
        $name=Str::random(10).".".$ext;
        $img=Image::make($request->avatar)->resize(240,200);
        $upload='back/employee';
        $img_name=$upload.'/'.$name;
        $img->save($img_name);

        $employee = new Employee;
        $employee->name = $request->name;
        $employee->email = $request->email;
        $employee->phone = $request->phone;
        $employee->salary = $request->salary;
        $employee->position = $request->position;
        $employee->address = $request->address;
        $employee->avatar = $img_name;
        $employee->save();
        return response()->json(['success'=>'employee added successfully']);


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $employee = Employee::where('id',$id)->first();
        return response()->json($employee);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){
        $employee = Employee::where('id',$id)->first();
        $old_img=$employee->avatar;
        if ($request->name !=''){
            $employee->name=$request->name;
        }
        if ($request->email !=''){
            $employee->email=$request->email;
        }
        if ($request->phone !=''){
            $employee->phone=$request->phone;
        }
        if ($request->address !=''){
            $employee->address=$request->address;
        }
        if ($request->salary !=''){
            $employee->salary=$request->salary;
        }
        if ($request->position !=''){
            $employee->position=$request->position;
        }
        if ($request->avatar){
            $pos = strpos($request->avatar, ';');
            $sub = substr($request->avatar,0,$pos);
            $ext = explode('/',$sub)[1];
            $name=Str::random(10).".".$ext;
            $img=Image::make($request->avatar)->resize(240,200);
            $upload='back/employee';
            $img_name=$upload.'/'.$name;
            $img->save($img_name);
            unlink($old_img);
            $employee->avatar = $img_name;
        }
        $employee->save();
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
        $employee = Employee::where('id',$id)->first();
        unlink($employee->avatar);
        Employee::where('id',$id)->delete();
        return response()->json('success');

    }
}
