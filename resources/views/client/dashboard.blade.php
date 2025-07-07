@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-4 border-bottom">
    <h1 class="h2 text-dark">Client Dashboard</h1>
</div>

<div class="row mb-4">
    <div class="col-md-6 col-lg-4">
        <div class="card shadow-sm border-0 rounded-4">
            <div class="card-body d-flex align-items-center">
                <div class="me-3">
                    <i class="fas fa-file-alt fa-2x text-primary"></i>
                </div>
                <div>
                    <h6 class="mb-0">Assigned Texts</h6>
                    <h4 class="fw-bold text-primary mb-0">{{ $assignedTexts->count() }}</h4>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Summary of Assigned Texts --}}
<div class="card shadow-sm border-0 rounded-4">
    <div class="card-header bg-white">
        <h5 class="mb-0 fw-semibold text-primary">📄 Assigned Texts Overview</h5>
    </div>

    <div class="card-body">
                @if($assignedTexts->isEmpty())
                    <p class="text-muted mb-0">No texts assigned yet.</p>
                @else
                        <ul class="list-group list-group-flush">
                    @foreach($assignedTexts as $text)
                        <li class="list-group-item d-flex justify-content-between align-items-start flex-column flex-md-row">
                            <div class="mb-2 mb-md-0">
                                <strong>{{ $text->title }}</strong><br>
                                <small class="text-muted">
                                    Assigned by: {{ $text->creator->name ?? 'Admin' }} <br>
                                    Assigned on: {{ $text->created_at->format('M d, Y h:i A') }}
                                </small>
                            </div>
                            <a href="{{ route('client.assigned-texts.show', $text->id) }}" class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-eye"></i>
                            </a>
                        </li>
                    @endforeach
                </ul>
            
        @endif
    </div>
</div>
@endsection
