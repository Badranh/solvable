@extends('layouts.app')

@section('content')
<div class="container">
<div class="row justify-content-center">
<div class="col-md-8">
<div class="card">
    <div class="card-header"><center>{{$w->Title}}</center></div>
    <div class="card-body">
    <div class=><center>{{$w->Problem}}</center></div>
        <!--Display solutions with thier score-->
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Solution</th>
                    <th>Rating</th>
                </tr>
            </thead>
            <tbody>
                @foreach($w->cards()->orderBy('score','DESC')->get() as $card)
                <tr>
                    <td>{{$card->user->name}}</td>
                    <td>{{$card->text}}</td>
                    <td>{{$card->score}}</td>
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