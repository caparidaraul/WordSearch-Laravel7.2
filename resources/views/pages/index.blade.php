@extends('layouts.app')

@section('content')
    <h1 class="cover-heading">{{$title}}</h1>
    
    @include('inc.search')
@endsection