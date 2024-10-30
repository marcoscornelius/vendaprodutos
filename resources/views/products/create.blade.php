@extends('layouts.app')

@section('title', 'Register Product')

@section('content')
<div class="container">
    <h2>Register Product</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('products.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Product name</label>
            <input type="text" maxlength="55" name="name" id="name" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="price">Price</label>
            <input type="number" name="price" id="price" max="99999" class="form-control" step="0.01" required>
        </div>      

        <button type="submit" class="btn btn-primary">Register Product</button>
    </form>
</div>
@endsection