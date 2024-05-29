@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>List of Stuffs</h1>
        @foreach ($stuffs as $stuff)
        <img src="{{ asset('img/' . $stuff->img . '.jpg') }}" />
        <ul>
                <li>{{ $stuff->name }}</li>
                <li>{{ $stuff->price }}</li>
                <li>{{ $stuff->type }}</li>
                <li>{{ $stuff->rating }}</li>
        </ul>
        @endforeach
    </div>
@endsection