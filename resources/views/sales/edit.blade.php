@extends('layouts.app')

@section('title', 'Edit Sale')

@section('content')
<div class="container">
    <h2>Edit Sale #{{ $sale->id }}</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('sales.update', $sale->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="client_id">Client</label>
            <select name="client_id" id="client_id" class="form-control">
                <option value="">No Client</option>
                @foreach($clients as $client)
                    <option value="{{ $client->id }}" {{ $sale->client_id == $client->id ? 'selected' : '' }}>
                        {{ $client->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update Sale</button>
    </form>
</div>
@endsection