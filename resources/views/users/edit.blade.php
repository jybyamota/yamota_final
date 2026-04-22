@extends('layouts.app')

@section('title', 'Edit User')

@section('content')
<div class="page-header">
    <h1>Edit User</h1>
    <p>Update user information</p>
</div>

<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{ route('users.update', $user->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="username" class="form-label">Username *</label>
                        <input type="text" id="username" name="username" class="form-control @error('username') is-invalid @enderror" value="{{ old('username', $user->username) }}" placeholder="e.g., johndoe" required>
                        @error('username')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="account_type" class="form-label">Role *</label>
                        <select id="account_type" name="account_type" class="form-select @error('account_type') is-invalid @enderror" required>
                            <option value="">-- Select a Role --</option>
                            <option value="admin" {{ old('account_type', $user->account_type) === 'admin' ? 'selected' : '' }}>Admin (Full Access)</option>
                            <option value="staff" {{ old('account_type', $user->account_type) === 'staff' ? 'selected' : '' }}>Staff (Can Edit Content)</option>
                            <option value="teacher" {{ old('account_type', $user->account_type) === 'teacher' ? 'selected' : '' }}>Teacher</option>
                            <option value="student" {{ old('account_type', $user->account_type) === 'student' ? 'selected' : '' }}>Student (View Only)</option>
                        </select>
                        @error('account_type')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div style="display: flex; gap: 0.5rem;">
                        <button type="submit" class="btn btn-primary">Update User</button>
                        <a href="{{ route('users.index') }}" class="btn btn-outline-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
