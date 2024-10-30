@extends('layouts.app')

@section('title', 'Sales List')

@section('content')
<div class="container">
    <h2>Sales List</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('sales.index') }}" method="GET" class="form-inline mb-3">
        <div class="form-group mr-2">
            <label for="client_id" class="mr-2">Filter by Client:</label>
            <select name="client_id" id="client_id" class="form-control">
                <option value="">All Clients</option>
                <option value="none" {{ request('client_id') == 'none' ? 'selected' : '' }}>No Client</option>
                @foreach($clients as $client)
                    <option value="{{ $client->id }}" {{ request('client_id') == $client->id ? 'selected' : '' }}>
                        {{ $client->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group mr-2">
            <label for="user_id" class="mr-2">Filter by User:</label>
            <select name="user_id" id="user_id" class="form-control">
                <option value="">All Users</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ request('user_id') == $user->id ? 'selected' : '' }}>
                        {{ $user->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Filter</button>
    </form>

    <div class="table-responsive">
        <table class="table table-bordered">
            
            <thead>
                <tr>
                    <th>Client</th>
                    <th>User</th>
                    <th>Total</th>
                    <th>Sold in</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>
                @forelse($sales as $sale)
                    <tr>
                        <td>{{ $sale->client->name ?? 'N/A' }}</td>
                        <td>{{ $sale->user->name }}</td>
                        <td>R$ {{ number_format($sale->total, 2, ',', '.') }}</td>
                        <td>{{ $sale->created_at->format('d/m/Y H:i') }}</td>
                        <td>
                            <a href="{{ route('sales.edit', $sale->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <a href="{{ route('sales.download', $sale->id) }}" class="btn btn-sm btn-info">Download PDF</a>
                            <button type="button" class="btn btn-sm btn-danger" onclick="confirmDelete('{{ route('sales.destroy', $sale->id) }}')">Delete</button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6">No sales found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection