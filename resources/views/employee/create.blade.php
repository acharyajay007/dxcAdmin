@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="panel panel-default">
                <div class="panel-heading pb-1">
                    Add Employee
                    <a class="btn btn-sm btn-default pull-right" href="{{URL::to('employees')}}">Back</a>
                </div>

                <div class="panel-body">
                    <form action="{{URL::to('employees')}}" enctype="multipart/form-data" method="post">
                        {{ method_field('POST') }}
                        {{ csrf_field() }}
                        <div class="row">
                            @if ($errors->any())
                                <div class="col-sm-12">
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            @endif
                            
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input name="name" value="{{old('name')}}" class="form-control" type="text" placeholder="Name">
                                </div>
                                <div class="form-group">
                                    <label>Designation</label>
                                    <input name="designation" value="{{old('designation')}}" class="form-control" type="text" placeholder="Designation">
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input name="email" value="{{old('email')}}" class="form-control" type="text" placeholder="Email">
                                </div> 
                                <div class="form-group">
                                    <label>Password</label>
                                    <input name="password" value="{{old('password')}}" class="form-control" type="password" placeholder="Password">
                                </div>         
                                <div class="form-group">
                                    <label>Date of birth</label>
                                    <input name="date_of_birth" value="{{old('date_of_birth')}}" class="form-control" type="date" datemin="{{date('Y-m-d',strtotime('-18 year'))}}" placeholder="Date of birth">
                                </div>
                                <div class="form-group">
                                    <label>Joining Date</label>
                                    <input name="joining_date" value="{{old('joining_date')}}" class="form-control" type="date" datemin="{{date('Y-m-d')}}" placeholder="Joining Date">
                                </div>
                                <div class="form-group">
                                    <label>Manager</label>
                                    <select name="manager_id" class="form-control" type="text">
                                        <option value="">Select Manager</option>
                                        @foreach($managers as $m)
                                            <option {{old('manager_id')==$m->id?'selected':''}} value="{{$m->id}}">{{$m->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div> 
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <hr>
                                <div class="form-group">
                                    <button class="btn btn-default">Cancel</button>
                                    <button type="submit" class="btn btn-success pull-right">Save</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
