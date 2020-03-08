@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <center>Admin Dashboard</center>
                </div>

                <div class="card-body">
                    <div class="alert alert-primary" role="alert"><center>Confirm Users</center></div>
                    {{$ucount}} user approval request(s).
                    <button type="button" class="btn btn-outline-success btn-sm float-right" onclick="window.location.href = '/admin/approve'">Review</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection