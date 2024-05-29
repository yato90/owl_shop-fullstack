@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Create New Stuff</h2>
        <form method="POST" action="{{ route('stuffs.store') }}">
            @csrf
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" class="form-control" id="name" name="name">
            </div>
            <div class="form-group">
                <label for="price">Price:</label>
                <input type="text" class="form-control" id="price" name="price">
            </div>
            <div class="form-group">
                <label for="img">Image URL:</label>
                <input type="text" class="form-control" id="img" name="img">
            </div>
            <div class="form-group">
                <label for="type">Type:</label>
                <input type="text" class="form-control" id="type" name="type">
            </div>
            <div class="form-group">
                <label for="rating">rating:</label>
                <input type="number" class="form-control" id="rating" name="rating">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection