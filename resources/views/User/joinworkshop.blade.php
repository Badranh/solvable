@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create Category</div>
                <form action="{{ route('workshop.join') }}" method="post">
                    <div class="card-body">
                        @csrf
                        <label>Workshop Link: </label>
                        <input type="text" class="form-control" name="link" />
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Join Workshop</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection