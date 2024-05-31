@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>List of Stuffs</h1>
        @foreach ($stuffs as $stuff)
        <img src="{{ asset('img/' . $stuff->img . '.jpg') }}"  with="224" height="248" />
        <ul>
                <li>{{ $stuff->name }}</li>
                <li>{{ $stuff->price }}</li>
                <li>{{ $stuff->type_id }}</li>
                <li>{{ $stuff->rating }}</li>
        </ul>
        Info
        <ul>
            @foreach ($stuff->info as $info)
                <li>{{ $info->title }} - {{ $info->description }}</li>
            @endforeach
        </ul>
        <form action="{{ route('stuffs.destroy', $stuff->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit">Delete</button>
        </form>
        <!--<form action="{{ route('stuffs.rate', $stuff->id) }}" method="POST">
            @csrf
            <label for="rating">Rate this stuff:</label>
            <select name="rating" id="rating" required>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
            </select>
            <button type="submit">Submit Rating</button>
        </form>
        -->
        @endforeach
    </div>
@endsection