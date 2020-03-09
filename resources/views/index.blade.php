@extends('layouts.app')

@section('content')

<body class="text-center">
    <div class="cover-container d-flex h-100 p-3 mx-auto flex-column">
        <main role="main" class="inner cover">
            <h1 class="cover-heading">Welcome to Solvable</h1>
            <p class="lead">The online idea crowd sourcing platform</p>
        </main>

        <br><br>
        <br><br>

        <div class="container d-flex h-100">
            <div class="row justify-content-center align-items-center">
                <div class="col-md-4">
                    <div class="card mb-7 box-shadow">
                        <div class="card-header">
                            <h4 class="my-0 font-weight-normal">Create a Workshop</h4>
                        </div>
                        <div class="card-body">
                            <p class="card-text">Propose a problem and invite people to help you find an inventive solution.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card mb-7 box-shadow">
                        <div class="card-header">
                            <h4 class="my-0 font-weight-normal">Propose a Solution</h4>
                        </div>
                        <div class="card-body">
                            <p class="card-text">And rate other people's solutions based on how out of the box they are.</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card mb-7 box-shadow">
                        <div class="card-header">
                            <h4 class="my-0 font-weight-normal">View the Results</h4>
                        </div>
                        <div class="card-body">
                            <p class="card-text">Find the best solution by viewing the ideas from highest rating to lowest.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <br><br>

        <p class="lead">
            <a href="/register" class="btn btn-lg btn-primary">Get Started</a>
        </p>
    </div>
</body>
@endsection