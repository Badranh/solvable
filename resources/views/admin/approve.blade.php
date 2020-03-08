@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Users waiting to be approved</div>

                <div class="card-body">

                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Username</th>
                                <th>Email</th>
                                <th> </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                            <tr>
                                <td>{{$user->name}} </td>
                                <td>{{$user->email}} </td>
                                <td>
                                    <form action="/admin/approve" method="post">
                                    @csrf
                                        <button type="submit" class="float-right btn btn-outline-success btn-sm" value={{$user->email}} name=email>Approve</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection