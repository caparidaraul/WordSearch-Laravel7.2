@extends('layouts.app')

@section('content')
    <h1>{{$title}}</h1>
    @if(count($searched) > 0)
        <ul class="list-group">
            @foreach($searched as $item)
                <li class="list-group-item">
                    <a href="/search/{{$item->word}}">{{$item->word}}</a>
                    <small class="f-right">{{ date('j F, Y h:i A', strtotime($item->created_at)) }}</small>
                </li>
            @endforeach
            <ul>
            <br>
            {{$searched->links()}}
    @else
        <div class="jumbotron text-center">
            <h1 class="display-4">Search history is clear!</h1>
            <p class="lead">
                Either it was intentionally cleared or there was no history of search at all!
            </p>
            <hr class="my-4">
            <p>
                Be the first to add an entry!
            </p>
        </div>
    @endif
@endsection