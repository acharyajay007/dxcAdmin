@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>
                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-sm-3">
                            <a  style="text-decoration: none!important" href="{{route('employees.index')}}">
                            <div class="well">
                                <h4 style="margin-top:0px">Total Employees</h4>
                                <h2  style="margin-top:0px">{{$totalEmployees}}</h2>
                            </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
