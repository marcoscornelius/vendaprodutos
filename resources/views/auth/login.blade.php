@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="container">
    <div class="text-center mb-4">
        <a href="{{ route('login') }}">
            <img src="{{ asset('images/logo.jpeg') }}" alt="Logo" class="img-fluid" style="max-width: 100px;">
        </a>
    </div>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <h2>Login</h2>

    <form action="{{ route('login.perform') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" required class="form-control" name="email">
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required class="form-control">
        </div>

        <button type="submit" class=" btn-primary btn">Login </button>

        @if($errors->any())
            <div class="alert alert-danger mt-3">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </form>

    <p> Don’t have an account? <a href="{{ route('register') }}">Register here</a></p>
</div>
@endsection