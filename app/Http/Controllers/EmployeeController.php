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

class EmployeeController extends Controller
{
    use CommonTrait;
    
    public function __construct() {
         $this->middleware(['auth']);

         $this->middleware('permission:employee-list');
         $this->middleware('permission:employee-add', ['only' => ['create','store']]);
         $this->middleware('permission:employee-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:employee-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = User::role('employee')->orderBy('created_at', 'desc')->paginate("10");
        return view('employee.list',['employees'=>$employees]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $managers = User::role('manager')->get();
        return view('employee.create', ['managers'=> $managers]);
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
            return redirect('employees')->with('message', 'Employee Created Successfully!');
        } catch (ModelNotFoundException $ex) {
            return redirect()->back()->withInput(Input::all())->withErrors(['role'=>'Employee Role Not Exists']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(User $employee)
    {
        return view('employee.view',['employee'=>$employee]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(User $employee)
    {
        $managers = User::role('manager')->get();
        return view('employee.edit',['employee'=>$employee, 'managers'=> $managers]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEmployee $request, User $employee)
    {
        try{
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
            return redirect('employees')->with('message', 'Employee Updated Successfully!');
        } catch (ModelNotFoundException $ex) {
            return redirect()->back()->withInput(Input::all())->withErrors(['role'=>'Employee Role Not Exists']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $employee)
    {
        $employee->delete();
        return redirect('employees')->with('message', 'Employee Deleted Successfully!');
    }
}
