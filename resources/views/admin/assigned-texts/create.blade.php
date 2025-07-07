@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Add New Assigned Text</h1>
    <a href="{{ route('admin.assigned-texts.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Back to Texts
    </a>
</div>

<div class="card">
    <div class="card-body">
        <form method="POST" action="{{ route('admin.assigned-texts.store') }}">
            @csrf

            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" 
                       id="title" name="title" value="{{ old('title') }}" required>
                @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="content" class="form-label">Content</label>
                <textarea class="form-control @error('content') is-invalid @enderror" 
                          id="content" name="content" rows="5" required>{{ old('content') }}</textarea>
                @error('content')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="client_ids" class="form-label">Assign to Clients</label>
                <select class="form-select @error('client_ids') is-invalid @enderror" 
                        name="client_ids[]" id="client_ids" multiple required>
                    @foreach($clients as $id => $name)
                        <option value="{{ $id }}" @if(in_array($id, old('client_ids', []))) selected @endif>
                            {{ $name }}
                        </option>
                    @endforeach
                </select>
                @error('client_ids')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select class="form-select @error('status') is-invalid @enderror" name="status" id="status">
                    <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="in-progress" {{ old('status') == 'in-progress' ? 'selected' : '' }}>In Progress</option>
                    <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                </select>
                @error('status')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="deadline" class="form-label">Deadline</label>
                <input type="date" class="form-control @error('deadline') is-invalid @enderror"
                       id="deadline" name="deadline" value="{{ old('deadline') }}">
                @error('deadline')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="priority" class="form-label">Priority (1 = High, 5 = Low)</label>
                <select class="form-select @error('priority') is-invalid @enderror" name="priority" id="priority">
                    @for ($i = 1; $i <= 5; $i++)
                        <option value="{{ $i }}" {{ old('priority', 3) == $i ? 'selected' : '' }}>{{ $i }}</option>
                    @endfor
                </select>
                @error('priority')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="notes" class="form-label">Notes (Optional)</label>
                <textarea class="form-control @error('notes') is-invalid @enderror"
                          id="notes" name="notes" rows="3">{{ old('notes') }}</textarea>
                @error('notes')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Assign Text</button>
        </form>
    </div>
</div>
@endsection
