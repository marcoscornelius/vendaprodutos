@extends('layouts.app')

@section('title', 'Clients List')

@section('content')
<div class="container">
    <h2>Clients List</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Actions</th>
            </tr>
        </thead>
        
        <tbody>
            @foreach($clients as $client)
                <tr>

                    <td>{{ $client->name }}</td>
                    <td>{{ $client->email }}</td>
                    <td>{{ $client->phone }}</td>
                    <td>
                      <a href="{{ route('clients.edit', $client->id) }}" class="btn btn-warning">Edit</a>
                      <button type="button" class="btn btn-danger" onclick="confirmDelete('{{ route('clients.destroy', $client->id) }}')">Delete</button>
                    </td>

                </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('clients.create') }}" class="btn btn-success">Add New Client</a>
</div>
@endsection