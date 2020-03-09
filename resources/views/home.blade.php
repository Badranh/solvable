@extends('layouts.app')

@section('content')


<body class="text-center">
    <div class="row justify-content-center" style="width:100%">
        <div class="col-md-8">

            <div class="text-center">
                <h1 class="display-4">Solvable</h1>
                <br><br><br><br>
            </div>

            <div class="row justify-content-center align-items-center">
                <div class="col-md-4">
                    <div class="card mb-7 box-shadow">
                        <div class="card-head">
                            <br>
                            <strong>
                                Create a Workshop
                            </strong>
                        </div>
                        <div class="card-body">
                            <p class="lead">
                                <a href="/create" class="btn btn-lg btn-block btn-primary">Create</a>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mb-7 box-shadow">
                        <div class="card-head">
                            <br>
                            <strong>
                                Join a Workshop
                            </strong>
                        </div>
                        <div class="card-body">
                            <p class="lead">
                                <a href="/join" class="btn btn-lg btn-block btn-primary">Join</a>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mb-7 box-shadow">
                        <div class="card-head">
                            <br>
                            <strong>
                                View Workshop History
                            </strong>
                        </div>
                        <div class="card-body">
                            <p class="lead">
                                <a href="/history" class="btn btn-lg btn-block btn-primary">History</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
@endsection