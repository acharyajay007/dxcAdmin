<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Http\Requests\StoreEmployee;
use App\Http\Requests\UpdateEmployee;
use App\Traits\CommonTrait;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Company;
use Hash;
use Input;

class EmployeeRestController extends Controller
{
    use CommonTrait;
    
    public function __construct() {       
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $offset =0;
        $limit =10;
        if($request->has("start") && $request->get("start")!="") {
            $offset = $request->get('start');
        }

        if($request->has("limit") && $request->get("limit")!="") {
            $limit = $request->get('limit');
        }
        $employees = User::role('employee')->with('manager:id,name,email')->orderBy('created_at', 'desc')->offset($offset)->limit($limit)->get();
        return  response()->json($employees, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEmployee $request)
    {
        try{
     
             $employeeRole = Role::where('name', 'employee')->firstOrFail(); 
             $data = [
                "name" => $request->get("name"),
                "designation" => $request->get("designation"),
                "email" => $request->get("email"),
                "password" => Hash::make($request->get("password")),
                "manager_id" => $request->get("manager_id"),
                "date_of_birth" => $request->get("date_of_birth"),
                "joining_date" => $request->get("joining_date"),
            ];
            $employee = User::create($data);
            $employee->assignRole($employeeRole);
            return  response()->json($employee, 201);
        } catch (ModelNotFoundException $ex) {
            return  response()->json(['errors'=>['role'=>'Employee Role Not Exists']], 404);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        try{
            $employee = User::findOrFail($id);
            return  response()->json($employee, 200);
        } catch (ModelNotFoundException $ex) {
            return  response()->json(['errors'=>['role'=>'Employee Role Not Exists']], 404);
        }
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEmployee $request, int $id)
    {
        try{
            $employee = User::findOrFail($id);
            $employeeRole = Role::where('name', 'employee')->firstOrFail(); 
            $data = [
                "name" => $request->get("name"),
                "designation" => $request->get("designation"),
                "email" => $request->get("email"),
                "manager_id" => $request->get("manager_id"),
                "date_of_birth" => $request->get("date_of_birth"),
                "joining_date" => $request->get("joining_date"),
            ];
            $employee->update($data);
            $employee->assignRole($employeeRole);
            return  response()->json($employee, 201);
        } catch (ModelNotFoundException $ex) {
            return  response()->json(['errors'=>['role'=>'Employee Role Not Exists']], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        try{
            $employee = User::findOrFail($id);
            $employee->delete();
            return response()->json([], 200);
        } catch (ModelNotFoundException $ex) {
            return  response()->json(['errors'=>['role'=>'Employee Role Not Exists']], 404);
        }
        
    }
}
