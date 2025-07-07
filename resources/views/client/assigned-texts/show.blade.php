@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center pt-3 pb-2 mb-4 border-bottom">
    <h1 class="h4 text-dark mb-0">📄 Assigned Text Details</h1>
    <a href="{{ route('client.dashboard') }}" class="btn btn-sm btn-outline-secondary">
        <i class="fas fa-arrow-left me-1"></i> Back to Dashboard
    </a>
</div>

<div class="card shadow-sm border-0 rounded-4 mb-4">
    <div class="card-body">
        <h5 class="card-title fw-bold text-primary">{{ $assignedText->title }}</h5>
        <p class="card-text text-muted">{{ $assignedText->content }}</p>

        <ul class="list-group list-group-flush mt-4">
            @if($assignedText->notes)
                <li class="list-group-item">
                    <strong>📝 Notes:</strong> {{ $assignedText->notes }}
                </li>
            @endif
            <li class="list-group-item">
                <strong>👤 Assigned By:</strong> {{ $assignedText->creator->name ?? 'System' }}
            </li>
            <li class="list-group-item">
                <strong>📅 Assigned On:</strong> {{ $assignedText->created_at->format('M d, Y h:i A') }}
            </li>
        </ul>
    </div>
</div>
@endsection
