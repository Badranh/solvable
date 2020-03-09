@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <center>User Dashboard</center>
                </div>

                <div class="card-body">
                    <div class="alert alert-info" role="alert">
                        <center>Create a Workshop</center>
                    </div>
                    <center>
                    <button type="button" class="btn btn-outline-success btn-sm" onclick="window.location.href = '/create'">Create</button>
                    </center>
                </div>
                <div class="card-body">
                    <div class="alert alert-info" role="alert">
                        <center>Join a Workshop</center>
                    </div>
                    <center>
                    <button type="button" class="btn btn-outline-success btn-sm" onclick="window.location.href = '/join'">Join</button>
                    </center>
                </div>
                <div class="card-body">
                    <div class="alert alert-info" role="alert">
                        <center>View Workshop History</center>
                    </div>
                    <center>
                    <button type="button" class="btn btn-outline-success btn-sm" onclick="window.location.href = '/history'">History</button>
                    </center>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection