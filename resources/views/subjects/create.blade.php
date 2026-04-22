@extends('layouts.app')

@section('title', 'Add Subject')

@section('content')
<div class="page-header">
    <h1>Create New Subject</h1>
    <p>Add a new subject to the system</p>
</div>

<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{ route('subjects.store') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="code" class="form-label">Subject Code *</label>
                        <input type="text" id="code" name="code" class="form-control @error('code') is-invalid @enderror" value="{{ old('code') }}" placeholder="e.g., CS101" required>
                        @error('code')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="title" class="form-label">Subject Title *</label>
                        <input type="text" id="title" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" placeholder="e.g., Introduction to CS" required>
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="unit" class="form-label">Credit Units *</label>
                        <input type="number" id="unit" name="unit" class="form-control @error('unit') is-invalid @enderror" value="{{ old('unit') }}" min="1" placeholder="e.g., 3" required>
                        @error('unit')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div style="display: flex; gap: 0.5rem;">
                        <button type="submit" class="btn btn-primary">Create Subject</button>
                        <a href="{{ route('subjects.index') }}" class="btn btn-outline-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
