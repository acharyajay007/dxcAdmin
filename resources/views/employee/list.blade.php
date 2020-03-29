@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading pb-1">
                    Employees
                    @if(auth()->user()->can('employee-add'))
                    <a class="btn btn-sm btn-success pull-right" href="{{URL::to('employees/create')}}">Add New</a>
                    @endif
                </div>

                <div class="panel-body">
                    <div class="row">
                        @if(session()->has('message'))
                            <div class="col-sm-12">
                                <div class="alert alert-success alert-dismissible" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    {{ session()->get('message') }}
                                </div>
                            </div>
                        @endif
                    </div>
                     <div class="row">
                        <div class="col-sm-12">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <td>Name</td>
                                        <td>Designation</td>
                                        <td>Manager</td>
                                        <td>Email</td>
                                        <td>Birthdate</td>
                                        <td>Joined On</td>
                                        <td>Action</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($employees->count()>0)
                                    @foreach($employees as $e)
                                        <tr>
                                            <td>{{$e->name}}</td>
                                            <td>{{$e->designation}}</td>
                                            <td>{{$e->manager->name}}</td>
                                            <td>{{$e->email}}</td>
                                            <td>{{date("d F Y", strtotime($e->date_of_birth))}}</td>
                                            <td>{{date("d F Y", strtotime($e->joining_date))}}</td>
                                            <td>
                                                @if(auth()->user()->can('employee-edit'))
                                                <a class="btn btn-primary" href="{{route('employees.edit',[$e->id])}}">Edit</a>
                                                @endif
                                                @if(auth()->user()->can('employee-view'))
                                                <a class="btn btn-warning" href="{{route('employees.show',[$e->id])}}">View</a>
                                                @endif
                                                @if(auth()->user()->can('employee-delete'))
                                                {{ Form::open(array('url' => 'employees/' . $e->id, 'style' => 'display:inline')) }}
                                                    {{ Form::hidden('_method', 'DELETE') }}
                                                    {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                                                {{ Form::close() }}
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                    @else
                                        <tr>
                                            <td colspan="5" class="text-center">No Employees Found</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>                            
                        </div>
                        <div class="row">
                            <div class="col-sm-12 text-center">
                                {{ $employees->links() }}
                            </div>
                        </div
                     </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
