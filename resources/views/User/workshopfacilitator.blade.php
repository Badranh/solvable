@extends('layouts.app')

@section('content')
<div class="container">
<div class="row justify-content-center">
<div class="col-md-8">
<div class="card">
    <div class="card-header"><center>{{ $w->Title }}</center></div>

    <div class="card-body">
        <center><label>Workshop Link: {{ $w->link }}</label></center>

        @if(!$w->isFull())
        <!-- Diplay Participants if in joining phase-->
        <form action="{{ route('workshop.begin') }}" method="post">
            @csrf
            <center>
                <button type="submit" class="btn btn-primary">Start Workshop</button>
            </center>
        </form>
        
        Joined Users:
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
                @foreach($w->participants as $user)
                    @if($user->id != auth()->user()->id)    
                    <tr>
                        <td>{{$user->name}} </td>
                        <td>{{$user->email}} </td>
                    </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
        @else
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
        @endif
    </div>



    <!--Allow facilitator to finalize workshop if all users have voted-->
    @if(auth()->user()->workshop->voted == auth()->user()->workshop->nparticipants)
    <form action="{{ route('workshop.end') }}" method="post">
            @csrf
            <center>
                <button type="submit" class="btn btn-primary">Finish Workshop</button>
            </center>
        </form>
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
channel.bind('facilitator', function(data) {
    window.location.reload();
});
</script>