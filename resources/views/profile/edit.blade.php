@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center pt-3 pb-2 mb-4 border-bottom">
    <h1 class="h2">Edit Profile</h1>
    <a href="{{ route('profile.show') }}" class="btn btn-outline-secondary">
        <i class="fas fa-arrow-left me-1"></i> Back to Profile
    </a>
</div>

@if (session('status') === 'profile-updated')
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fas fa-check-circle me-2"></i> Profile updated successfully!
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="card shadow-sm rounded-4 border-0">
    <div class="card-body p-4">
        <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            {{-- Name --}}
            <div class="mb-3">
                <label for="name" class="form-label fw-semibold">Name</label>
                <input name="name" id="name" type="text"
                       class="form-control @error('name') is-invalid @enderror"
                       value="{{ old('name', $user->name) }}" required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Email --}}
            <div class="mb-3">
                <label for="email" class="form-label fw-semibold">Email</label>
                <input name="email" id="email" type="email"
                       class="form-control @error('email') is-invalid @enderror"
                       value="{{ old('email', $user->email) }}" required>
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Phone --}}
            <div class="mb-3">
                <label for="phone" class="form-label fw-semibold">Phone</label>
                <input name="phone" id="phone" type="text"
                       class="form-control @error('phone') is-invalid @enderror"
                       value="{{ old('phone', $user->phone) }}" required>
                @error('phone')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Password --}}
            <div class="mb-3">
                <label for="password" class="form-label fw-semibold">New Password <small class="text-muted">(optional)</small></label>
                <input name="password" id="password" type="password"
                       class="form-control @error('password') is-invalid @enderror"
                       autocomplete="new-password">
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- Confirm Password --}}
            <div class="mb-3">
                <label for="password_confirmation" class="form-label fw-semibold">Confirm New Password</label>
                <input name="password_confirmation" id="password_confirmation" type="password"
                       class="form-control" autocomplete="new-password">
            </div>

            {{-- Profile Image --}}
            <div class="mb-3">
                <label for="profile_image" class="form-label fw-semibold">Profile Image</label>
                <input type="file" name="profile_image" id="profile_image"
                       class="form-control @error('profile_image') is-invalid @enderror">
                @error('profile_image')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror

                @if ($user->profile_image)
                    <div class="mt-3">
                        <img src="{{ asset('storage/' . $user->profile_image) }}"
                             alt="Profile Image"
                             class="rounded shadow-sm"
                             style="max-height: 150px;">
                    </div>
                @endif
            </div>

            {{-- Submit --}}
            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary px-4">
                    <i class="fas fa-save me-1"></i> Update Profile
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
