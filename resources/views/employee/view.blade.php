@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="panel panel-default">
                <div class="panel-heading pb-1">
                    View Employee
                    <a class="btn btn-sm btn-default pull-right" href="{{URL::to('employees')}}">Back</a>
                </div>

                <div class="panel-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <table class="table table-bordered table-striped">
                                <tr>
                                    <td width="40%">Name</td>
                                    <td>{{$employee->name}}</td>
                                </tr>
                                <tr>
                                    <td>Designation</td>
                                    <td>{{$employee->designation}}</td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td>{{$employee->email}}</td>
                                </tr>
                                <tr>
                                    <td>Birthdate</td>
                                    <td>{{$employee->date_of_birth?date("d F Y", strtotime($employee->date_of_birth)):'-'}}</td>
                                </tr>
                                <tr>
                                    <td>Joined On</td>
                                    <td>{{$employee->joining_date?date("d F Y", strtotime($employee->joining_date)):'-'}}</td>
                                </tr>
                                @if($employee->manager)
                                <tr>
                                    <td>Manager Name</td>
                                    <td>{{$employee->manager->name}}</td>
                                </tr>
                                 <tr>
                                    <td>Manager Email</td>
                                    <td>{{$employee->manager->email}}</td>
                                </tr>
                                @endif
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
