<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\employees; 

class employee extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all_employee = employees::all();

        $data = array('data' => $all_employee);

        return response($data,200)
            ->header('Content-Type', 'application/json')
            ->header('X-Header-One', 'Header Value')
            ->header('X-Header-Two', 'Header Value'); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $employee = new employees();
        $employee->emp_name = $request->name;
        $employee->emp_email = $request->email;
        $employee->emp_phone = $request->phone;
        $employee->emp_password = $request->password;
        $employee->created_at = date('Y-m-d');
        $employee->save();

        $resp = array("status"=>'success','message' => "Employee Added");
        
        
        return response($resp,200)
                    ->header('Content-Type', 'application/json')
                    ->header('X-Header-One', 'Header Value')
                    ->header('X-Header-Two', 'Header Value'); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $single_employee = employees::where('id', $id)->get();

        $data = array('single_data',$single_employee);

        return response($data,200)
                    ->header('Content-Type', 'application/json')
                    ->header('X-Header-One', 'Header Value')
                    ->header('X-Header-Two', 'Header Value');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $employee = new employees();

        $data['emp_name'] = $request->name;
        $data['emp_email'] = $request->email;
        $data['emp_phone'] = $request->phone;
        $data['emp_password'] = $request->password;

        employees::where('id',$id)->update($data);

        $resp = array("status"=>'success','message' => "Employee Updated");
        
        
        return response($resp,200)
                    ->header('Content-Type', 'application/json')
                    ->header('X-Header-One', 'Header Value')
                    ->header('X-Header-Two', 'Header Value'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}