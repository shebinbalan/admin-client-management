@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-4 border-bottom">
    <h1 class="h2 text-dark">Admin Dashboard</h1>
</div>

<div class="row g-4 mb-4">
    
    <div class="col-xl-3 col-md-6">
        <div class="card text-white bg-primary shadow h-100">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <div class="text-sm text-uppercase">Total Clients</div>
                    <h4 class="fw-bold">{{ $totalClients }}</h4>
                </div>
                <i class="fas fa-users fa-2x opacity-75"></i>
            </div>
        </div>
    </div>

  
    <div class="col-xl-3 col-md-6">
        <div class="card text-white bg-success shadow h-100">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <div class="text-sm text-uppercase">Total Assigned Texts</div>
                    <h4 class="fw-bold">{{ $totalTexts ?? 0 }}</h4>
                </div>
                <i class="fas fa-file-alt fa-2x opacity-75"></i>
            </div>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-lg-12">
        <div class="card shadow-sm">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Recent Clients</h5>
                <a href="{{ route('admin.clients.index') }}" class="btn btn-sm btn-outline-primary">
                    <i class="fas fa-arrow-right"></i> View All
                </a>
            </div>
            <div class="card-body">
                @if($recentClients->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-sm align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Profile</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>Joined</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentClients as $client)
                                    <tr>
                                        <td>
                                            <img src="{{ $client->profile_image_url }}" alt="Profile" class="rounded-circle" style="width: 35px; height: 35px;">
                                        </td>
                                        <td>{{ $client->name }}</td>
                                        <td>{{ $client->email }}</td>
                                        <td>
                                            <span class="badge bg-{{ $client->status->color() }}">
                                                {{ $client->status->label() }}
                                            </span>
                                        </td>
                                        <td>{{ $client->created_at->format('M d, Y') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text-muted mb-0">No recent clients available.</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
