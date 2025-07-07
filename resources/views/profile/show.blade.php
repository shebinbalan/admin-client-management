@extends('layouts.app')

@section('content')
<div class="container py-4">

    {{-- Page Header --}}
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 border-bottom">
        <h1 class="h2">My Profile</h1>
    </div>

    {{-- Add vertical space below the header --}}
    <div class="mb-4"></div>

    @php
        $user = \App\Models\User::find(auth()->id());
    @endphp

    {{-- Profile Card --}}
    <div class="card shadow-sm border-0 rounded-4 overflow-hidden">
        <div class="card-body d-flex flex-column flex-md-row align-items-center gap-4 p-4">

            {{-- Profile Image --}}
            @if ($user->profile_image)
                <img src="{{ asset('storage/' . $user->profile_image) }}"
                     alt="Profile Image"
                     class="rounded-circle border shadow-sm"
                     style="width: 120px; height: 120px; object-fit: cover;">
            @else
                <div class="rounded-circle bg-secondary text-white d-flex align-items-center justify-content-center shadow-sm"
                     style="width: 120px; height: 120px; font-size: 1.5rem;">
                    N/A
                </div>
            @endif

            {{-- Profile Details --}}
            <div class="flex-grow-1">
                <h4 class="fw-semibold text-dark mb-2">{{ $user->name }}</h4>

                <ul class="list-unstyled mb-3 text-muted small">
                    <li><i class="fas fa-envelope me-2"></i>{{ $user->email }}</li>
                    <li><i class="fas fa-phone me-2"></i>{{ $user->phone ?? 'N/A' }}</li>
                    <li><strong>Role:</strong> {{ $user->user_type->label() }}</li>
                    <li><strong>Joined:</strong> {{ $user->created_at->format('M d, Y') }}</li>
                    <li>
                        <strong>Last Login:</strong>
                        {{ $user->last_login_at ? $user->last_login_at->diffForHumans() : 'Never' }}
                    </li>
                </ul>

                <a href="{{ route('profile.edit') }}" class="btn btn-outline-primary btn-sm">
                    <i class="fas fa-edit me-1"></i> Edit Profile
                </a>
            </div>

        </div>
    </div>
</div>
@endsection
