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
        <form action="{{ route('stuffs.destroy', $stuff->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit">Delete</button>
        </form>
        @endforeach
    </div>
@endsection