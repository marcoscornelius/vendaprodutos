@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Add Client</h1>
    <form action="{{ route('clients.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" maxlength="30" name="name" id="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label" for="email" >Email</label>
            <input type="email" name="email" id="email" maxlength="50" class="form-control" required>
        </div>
            <div class="mb-3">

                <label for="phone" class="form-label">Phone</label>
                <input type="text" id="phone" name="phone" class="form-control">

            </div>
        <button type="submit" class="btn btn-primary">Add Client</button>
    </form>
</div>
@endsection