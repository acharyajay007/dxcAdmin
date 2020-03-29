@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="panel panel-warning text-center">
                <div class="panel-heading">Unauthorized Access</div>

                <div class="panel-body">
                    You don't have permission to access this page. If you found it issue then contact administrator.<br/><br/>
                    <a class="btn btn-default" href="{{route('home')}}"><i class="glyphicon glyphicon-home"></i> Go to Home</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
