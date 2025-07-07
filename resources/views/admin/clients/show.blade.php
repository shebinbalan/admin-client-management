@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-3 mb-4 border-bottom">
    <h1 class="h2">Client Details</h1>
    <a href="{{ route('admin.clients.index') }}" class="btn btn-outline-secondary">
        <i class="fas fa-arrow-left"></i> Back to Clients
    </a>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="card text-center shadow-sm">
            <div class="card-body">
                <img src="{{ $client->profile_image_url }}" class="rounded-circle mb-3" width="120" height="120" alt="Profile Image">
                <h4 class="card-title">{{ $client->name }}</h4>
                <p class="card-text text-muted">{{ $client->email }}</p>
                <span class="badge bg-{{ $client->status->color() }}">
                    {{ $client->status->label() }}
                </span>
            </div>
        </div>
    </div>

    <div class="col-md-8">
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-white fw-bold">
                Personal Information
            </div>
            <div class="card-body">
                <dl class="row mb-0">
                    <dt class="col-sm-4">Name:</dt>
                    <dd class="col-sm-8">{{ $client->name }}</dd>

                    <dt class="col-sm-4">Email:</dt>
                    <dd class="col-sm-8">{{ $client->email }}</dd>

                    <dt class="col-sm-4">Phone:</dt>
                    <dd class="col-sm-8">{{ $client->phone ?? '-' }}</dd>

                    <dt class="col-sm-4">Status:</dt>
                    <dd class="col-sm-8">
                        <span class="badge bg-{{ $client->status->color() }}">
                            {{ $client->status->label() }}
                        </span>
                    </dd>

                    <dt class="col-sm-4">Joined:</dt>
                    <dd class="col-sm-8">{{ $client->created_at->format('M d, Y') }}</dd>
                </dl>
            </div>
        </div>

       @if($client->assignedTexts->isNotEmpty())
    <div class="card shadow-sm">
        <div class="card-header bg-white fw-bold">
            Assigned Texts
        </div>
        <div class="card-body">
            <ul class="list-group list-group-flush">
                @foreach($client->assignedTexts as $text)
                    <li class="list-group-item">
                        <div class="fw-semibold">{{ $text->title }}</div>
                        <div class="text-muted small">
    ID: {{ $text->id }} |
    Status:
    <span class="badge bg-{{ $text->status === 'completed' ? 'success' : ($text->status === 'pending' ? 'warning' : 'secondary') }}">
        {{ ucfirst($text->status) }}
    </span>
</div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@else
    <div class="alert alert-info mt-4">
        No assigned texts found for this client.
    </div>
@endif
    </div>
</div>
@endsection
