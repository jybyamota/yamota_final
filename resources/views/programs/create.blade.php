@extends('layouts.app')

@section('title', 'Add Program')

@section('content')
<div class="page-header">
    <h1>Create New Program</h1>
    <p>Add a new academic program to the system</p>
</div>

<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{ route('programs.store') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="code" class="form-label">Program Code *</label>
                        <input type="text" id="code" name="code" class="form-control @error('code') is-invalid @enderror" value="{{ old('code') }}" placeholder="e.g., BS-CS" required>
                        @error('code')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="title" class="form-label">Program Title *</label>
                        <input type="text" id="title" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" placeholder="e.g., Bachelor of Science in CS" required>
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="years" class="form-label">Duration (years) *</label>
                        <input type="number" id="years" name="years" class="form-control @error('years') is-invalid @enderror" value="{{ old('years') }}" min="1" placeholder="e.g., 4" required>
                        @error('years')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div style="display: flex; gap: 0.5rem;">
                        <button type="submit" class="btn btn-primary">Create Program</button>
                        <a href="{{ route('programs.index') }}" class="btn btn-outline-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
