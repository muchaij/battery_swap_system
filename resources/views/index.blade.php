@extends('layouts.app')

@section('content')
<div class="container-fluid main">
    <div class="row d-flex align-items-center dark">
        <div class='col-sm-1'></div>
        <div class="col-sm-6">
            <h3>Battery Tracking App</h3>
            <p>
                A battery usage tracking app for drivers. A portal that helps drivers track their battery usage and
                 exchangess
            </p>
        </div>
    </div>
</div>
<div class="container mt-5 mb-5">
    <div class="row">
        <div class="col-sm-6">
            <h3>Battery App Manager</h3>
            <p>
                To enjoy the services of our battery exchanges, register as a driver and monitor your battery
                usage
            </p>
            <a href='{{url("login")}}' class='btn btn-primary'>Get Started</a>
        </div>
    </div>
</div>
@endsection
