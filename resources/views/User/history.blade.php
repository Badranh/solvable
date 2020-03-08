@extends('layouts.app')

@section('content')
<div class="container">
<div class="row justify-content-center">
<div class="col-md-8">
<div class="card">
    <div class="card-header"><center>Workshop History</center></div>

    @if($workshops->count() != null)
    <div class="card-body">
        As a facilitator:
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Problem</th>
                    <th> </th>
                </tr>
            </thead>
            <tbody>
                @foreach($workshops as $w)
                <tr>
                    <td>{{$w->Title}} </td>
                    <td>{{$w->Problem}} </td>
                    <td>
                    <button type="button" class="btn btn-outline-success btn-sm float-right" onclick="window.location.href = '/workshop/view?wid={{$w->id}}'">View</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif

    @if($cards->count() != null)
    <div class="card-body">
        As a participant:
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Problem</th>
                    <th> </th>
                </tr>
            </thead>
            <tbody>
                @foreach($cards as $c)
                <tr>
                    <td>{{$c->workshop->Title}} </td>
                    <td>{{$c->workshop->Problem}} </td>
                    <td>
                    <button type="button" class="btn btn-outline-success btn-sm float-right" onclick="window.location.href = '/workshop/view?wid={{$c->workshop->id}}'">View</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif
</div>
</div>
</div>
</div>
@endsection