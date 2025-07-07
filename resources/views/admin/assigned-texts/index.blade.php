@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Assigned Texts</h1>
    <a href="{{ route('admin.assigned-texts.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> Add New Text
    </a>
</div>

<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Content Preview</th>
                        <th>Assigned To</th>
                        <th>Created By</th>
                        <th>Created</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($assignedTexts as $text)
                        <tr>
                            <td>{{ $text->title }}</td>
                            <td>{{ Str::limit($text->content, 50) }}</td>
                            <td>
                                <span class="badge bg-info">{{ $text->assignedUsers->count() }} users</span>
                            </td>
                            <td>{{ $text->creator->name }}</td>
                            <td>{{ $text->created_at->format('M d, Y') }}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('admin.assigned-texts.show', $text) }}" class="btn btn-sm btn-outline-info">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.assigned-texts.edit', $text) }}" class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form method="POST" action="{{ route('admin.assigned-texts.destroy', $text) }}" class="d-inline">
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
                            <td colspan="6" class="text-center">No assigned texts found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{ $assignedTexts->links() }}
    </div>
</div>
@endsection