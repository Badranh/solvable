@extends('layouts.app')

@section('content')
<div class="container">
<div class="row justify-content-center">
<div class="col-md-8">
<div class="card">
    <div class="card-header"><center>{{ $w->Title }}</center></div>
    @if(!$w->isFull())
    <!--Waiting for workshop to start-->
    <div class="card-body">
        <label><center>Please wait, workshop is starting...</center></label>
    </div>
    @elseif(!$w->isShuffling())
    <!--Waiting for participants to give thier solutions-->
        @if(auth()->user()->card_id == -1)
        <!--Ask participant for a solution-->
        <div class="card-body">
            <center>Problem:</center><br>
            <center>{{$w->Problem}}</center>
            <form action="{{ route('card.create') }}" method="post">
                <div class="card-body">
                    @csrf
                    <label>Your Solution:</label>
                    <textarea class="form-control" name="solution"> </textarea><br>
                    <center><button type="submit" class="btn btn-primary">Submit Solution</button></center>
                </div>
            </form>
        </div>
        @else
        <!--Participant already submitted a solution-->
        <div class="card-body">
            <center>Please wait while everyone else submits thier solutions.</center><br>
        </div>
        @endif
    @elseif(auth()->user()->iteration < $w->participants()->count() - 2 && auth()->user()->iteration < $w->rounds)
    <!--Shuffling solutions for answers-->
    <div class="card-body">
        <center>Problem:</center>
        <center>{{$w->Problem}}</center><br>
        <center>Solution:</center>
        <center>{{$c->text}}</center><br>
        <form action="{{ route('card.rate') }}" method="post">
            <div class="card-body">
                @csrf
                <label>Your Rating:</label>
                <input type="number" class="form-control" name="rating"><br>
                <center><button type="submit" class="btn btn-primary" name="cid" value="{{$c->id}}">Submit Rating</button></center>
            </div>
        </form>
    </div>
    @else
    <!--Show participant all ratings-->
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
    @endif
</div>
</div>
</div>
</div>
@endsection

<script src="https://js.pusher.com/5.1/pusher.min.js"></script>
<script>
var pusher = new Pusher('f53e8cd63802d26fd848', {
    cluster: 'eu',
    forceTLS: true
});

var channel = pusher.subscribe('{{ $w->link }}');
channel.bind('participant', function(data) {
    window.location.reload();
});
</script>