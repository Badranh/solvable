@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create Workshop</div>
                <form action="{{ route('workshop.create') }}" method="post">
                    <div class="card-body">
                        @csrf
                        <label>Title</label>
                        <input type="text" class="form-control" name="title" />
                        <label>Problem</label>
                        <input type="text" class="form-control" name="problem" />
                        <label>Number of participants:</label>
                        <input type="number" class="form-control" name="nparticipants" />
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Create Workshop</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection