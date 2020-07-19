@extends('layouts.app')

@section('content')
    <h1 class="cover-heading">You searched for: <strong>{{$word}}</strong></h1>

    @include('inc.search')

    @if(!empty($definition))
        <hr>
        <p>
            <strong>Definition</strong>: {!!$definition!!}
        </p>
    @endif
@endsection