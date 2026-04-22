@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="page-header">
    <h1>Welcome back, {{ auth()->user()->name }}</h1>
    <p>Here's an overview of your account</p>
</div>

<div class="row mb-4">
    {{-- Quick Actions Card --}}
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex align-items-center gap-2">
                <i class="fas fa-lightning-bolt text-warning"></i>
                <span>Quick Actions</span>
            </div>
            <div class="card-body">
                <div class="d-grid gap-3">
                    <a href="{{ route('subjects.index') }}" class="btn btn-primary d-flex align-items-center justify-content-between">
                        <span><i class="fas fa-book-open"></i> View Subjects</span>
                        <i class="fas fa-arrow-right"></i>
                    </a>
                    <a href="{{ route('programs.index') }}" class="btn btn-primary d-flex align-items-center justify-content-between">
                        <span><i class="fas fa-graduation-cap"></i> View Programs</span>
                        <i class="fas fa-arrow-right"></i>
                    </a>
                    @if(auth()->user()->isAdmin())
                        <a href="{{ route('users.index') }}" class="btn btn-warning d-flex align-items-center justify-content-between">
                            <span><i class="fas fa-users"></i> Manage Users</span>
                            <i class="fas fa-arrow-right"></i>
                        </a>
                    @endif
                    <a href="{{ route('profile.change-password') }}" class="btn btn-secondary d-flex align-items-center justify-content-between">
                        <span><i class="fas fa-lock"></i> Change Password</span>
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
