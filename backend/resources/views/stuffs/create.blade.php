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
            <span>готовые img: sneekers, t_short, trousers, hoodie, accessories</span>
            <div class="form-group">
                <label for="type_id">Type:</label>
                <select class="form-control" id="type_id" name="type_id">
                    @foreach($types as $type)
                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group" id="info">
                <div>
                    <div>Info</div>
                    <label for="info[0][title]">Title:</label>
                    <input type="text" id="info[0][title]" name="info[0][title]" required>
                    <label for="info[0][description]">Description:</label>
                    <textarea id="info[0][description]" name="info[0][description]" required></textarea>
                </div>
            </div>
            <button type="button" onclick="addInfo()">Add More Info</button>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection