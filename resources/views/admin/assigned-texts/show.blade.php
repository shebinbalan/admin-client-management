@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center pt-3 pb-2 mb-4 border-bottom">
    <h1 class="h4 text-dark">Assigned Text Detail</h1>
    <a href="{{ route('admin.assigned-texts.index') }}" class="btn btn-sm btn-outline-secondary">
        <i class="fas fa-arrow-left"></i> Back to List
    </a>
</div>

<div class="card mb-4 shadow-sm">
    <div class="card-body">
        <h5 class="card-title fw-bold">{{ $assignedText->title }}</h5>
        <p class="card-text">{{ $assignedText->content }}</p>

        <ul class="list-group list-group-flush mb-3">
            <li class="list-group-item"><strong>Status:</strong>
                <span class="badge bg-{{ $assignedText->status === 'completed' ? 'success' : ($assignedText->status === 'pending' ? 'warning' : 'secondary') }}">
                    {{ ucfirst($assignedText->status) }}
                </span>
            </li>
            <li class="list-group-item"><strong>Priority:</strong> {{ $assignedText->priority ?? '-' }}</li>
            <li class="list-group-item"><strong>Deadline:</strong> {{ $assignedText->deadline ? \Carbon\Carbon::parse($assignedText->deadline)->format('M d, Y') : 'N/A' }}</li>
            @if($assignedText->notes)
                <li class="list-group-item"><strong>Notes:</strong> {{ $assignedText->notes }}</li>
            @endif
            <li class="list-group-item"><strong>Created By:</strong> {{ $assignedText->creator->name ?? 'System' }}</li>
        </ul>
    </div>
</div>


<div class="card shadow-sm">
    <div class="card-header bg-white fw-bold">Assigned Clients</div>
    <div class="card-body">
        @if($assignedText->assignedUsers->isNotEmpty())
            <ul class="list-group">
                @foreach($assignedText->assignedUsers as $client)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                            <strong>{{ $client->name }}</strong>
                            <br>
                            <small class="text-muted">{{ $client->email }}</small>
                        </div>
                        <span class="badge bg-{{ $client->status->color() }}">{{ $client->status->label() }}</span>
                    </li>
                @endforeach
            </ul>
        @else
            <div class="alert alert-info">No clients assigned yet.</div>
        @endif
    </div>
</div>
@endsection
