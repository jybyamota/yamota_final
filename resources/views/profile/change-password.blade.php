@extends('layouts.app')

@section('title', 'Change Password')

@section('content')
<style>
    .password-container {
        max-width: 600px;
        margin: 0 auto;
    }

    .page-header {
        text-align: center;
        margin-bottom: 2rem;
    }

    .page-header h1 {
        font-size: 1.75rem;
        font-weight: 700;
        color: var(--text-primary);
        margin-bottom: 0.25rem;
    }

    .password-card {
        background: white;
        border: 1px solid var(--border-light);
        border-radius: 8px;
        padding: 1.5rem;
        box-shadow: var(--shadow-sm);
    }

    .form-group {
        margin-bottom: 1.25rem;
    }

    .form-label {
        display: block;
        font-weight: 700;
        color: var(--text-primary);
        margin-bottom: 0.375rem;
        font-size: 0.9rem;
        text-transform: none;
    }

    .form-control {
        width: 100%;
        padding: 0.625rem;
        border: 1px solid var(--border-light);
        border-radius: 6px;
        font-size: 0.9rem;
        transition: all 0.3s ease;
    }

    .form-control:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        outline: none;
    }

    .requirements-box {
        background: var(--bg-secondary);
        border-left: 4px solid var(--primary);
        padding: 1rem;
        border-radius: 6px;
        margin-bottom: 1.25rem;
    }

    .requirements-box strong {
        display: block;
        color: var(--text-primary);
        font-size: 0.9rem;
        margin-bottom: 0.5rem;
    }

    .requirements-box ul {
        margin: 0;
        padding-left: 1.5rem;
    }

    .requirements-box li {
        color: var(--text-secondary);
        font-size: 0.85rem;
        margin-bottom: 0.25rem;
    }

    .button-group {
        display: flex;
        gap: 0.75rem;
        margin-top: 1.25rem;
    }

    .btn {
        padding: 0.6rem 1.25rem;
        border-radius: 6px;
        font-weight: 600;
        font-size: 0.85rem;
        border: none;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-block;
        text-align: center;
    }

    .btn-primary {
        background-color: var(--primary);
        color: white;
    }

    .btn-primary:hover {
        background-color: var(--primary-dark);
        transform: translateY(-2px);
        box-shadow: var(--shadow-md);
    }

    .btn-secondary {
        background-color: var(--text-secondary);
        color: white;
    }

    .btn-secondary:hover {
        background-color: var(--text-primary);
        transform: translateY(-2px);
        box-shadow: var(--shadow-md);
    }

    .invalid-feedback {
        display: block;
        color: #dc2626;
        font-size: 0.85rem;
        margin-top: 0.5rem;
    }

    .form-control.is-invalid {
        border-color: #dc2626;
    }
</style>

<div class="password-container">
    <div class="page-header">
        <h1>Change Password</h1>
    </div>

    <div class="password-card">
        <form method="POST" action="{{ route('profile.change-password') }}">
            @csrf

            <div class="form-group">
                <label for="current_password" class="form-label">Current Password *</label>
                <input type="password" id="current_password" name="current_password" class="form-control @error('current_password') is-invalid @enderror" required>
                @error('current_password')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password" class="form-label">New Password *</label>
                <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" required>
                @error('password')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password_confirmation" class="form-label">Confirm New Password *</label>
                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" required>
            </div>

            <div class="requirements-box">
                <strong>Password Requirements:</strong>
                <ul>
                    <li>Minimum 6 characters</li>
                    <li>Passwords must match</li>
                </ul>
            </div>

            <div class="button-group">
                <button type="submit" class="btn btn-primary">Change Password</button>
                <a href="{{ route('dashboard') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
