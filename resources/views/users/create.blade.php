@extends('layouts.app')

@section('title', 'Add User')

@section('content')
<div class="page-header">
    <h1>Create New User</h1>
    <p>Add a new user to the system</p>
</div>

<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{ route('users.store') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="username" class="form-label">Username *</label>
                        <input type="text" id="username" name="username" class="form-control @error('username') is-invalid @enderror" value="{{ old('username') }}" placeholder="e.g., johndoe" required>
                        @error('username')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="account_type" class="form-label">Role *</label>
                        <select id="account_type" name="account_type" class="form-select @error('account_type') is-invalid @enderror" required>
                            <option value="">-- Select a Role --</option>
                            <option value="admin" {{ old('account_type') === 'admin' ? 'selected' : '' }}>Admin (Full Access)</option>
                            <option value="staff" {{ old('account_type') === 'staff' ? 'selected' : '' }}>Staff (Can Edit Content)</option>
                            <option value="teacher" {{ old('account_type') === 'teacher' ? 'selected' : '' }}>Teacher</option>
                            <option value="student" {{ old('account_type') === 'student' ? 'selected' : '' }}>Student (View Only)</option>
                        </select>
                        @error('account_type')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password *</label>
                        <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Minimum 6 characters" required>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="password_confirmation" class="form-label">Confirm Password *</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="Re-enter password" required>
                    </div>

                    <div style="display: flex; gap: 0.5rem;">
                        <button type="submit" class="btn btn-primary">Create User</button>
                        <a href="{{ route('users.index') }}" class="btn btn-outline-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
