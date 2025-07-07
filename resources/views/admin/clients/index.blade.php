@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Clients Management</h1>
    <a href="{{ route('admin.clients.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> Add New Client
    </a>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Profile</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Status</th>
                        <th>Created</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($clients as $client)
                        <tr>
                            <td>
                                <img src="{{ $client->profile_image_url ? asset($client->profile_image_url) : asset('images/default-avatar.png') }}" 
                                alt="Profile" 
                                class="rounded-circle" 
                                style="width: 40px; height: 40px; object-fit: cover;">
                            </td>
                            <td>{{ $client->name }}</td>
                            <td>{{ $client->email }}</td>
                            <td>{{ $client->phone }}</td>
                            <td>
                                <span class="badge bg-{{ $client->status->color() }}">
                                    {{ $client->status->label() }}
                                </span>
                            </td>
                            <td>{{ $client->created_at->format('M d, Y') }}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('admin.clients.show', $client) }}" class="btn btn-sm btn-outline-info">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.clients.edit', $client) }}" class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form method="POST" action="{{ route('admin.clients.destroy', $client) }}" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" 
                                                onclick="return confirm('Are you sure?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">No clients found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{ $clients->links() }}
    </div>
</div>
@endsection