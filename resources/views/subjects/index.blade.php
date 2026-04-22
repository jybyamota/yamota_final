@extends('layouts.app')

@section('title', 'Subjects')

@section('content')
<div class="page-header d-flex justify-content-between align-items-center">
    <div>
        <h1>Subjects</h1>
        <p>Manage all subjects in your institution</p>
    </div>
    @if(auth()->user()->isAdmin() || auth()->user()->account_type === 'staff')
        <a href="{{ route('subjects.create') }}" class="btn btn-primary">New Subject</a>
    @endif
</div>

<div class="card">
    @if($subjects->count() > 0)
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Code</th>
                        <th>Title</th>
                        <th>Unit</th>
                        <th>Created</th>
                        @if(auth()->user()->isAdmin() || auth()->user()->account_type === 'staff')
                            <th>Actions</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach($subjects as $subject)
                        <tr>
                            <td><span class="badge bg-light" style="color: #111827; border: 1px solid #e5e7eb;">{{ $subject->code }}</span></td>
                            <td>{{ $subject->title }}</td>
                            <td>{{ $subject->unit }}</td>
                            <td><small style="color: #6b7280;">{{ $subject->created_at ? $subject->created_at->format('M d, Y') : '-' }}</small></td>
                            @if(auth()->user()->isAdmin() || auth()->user()->account_type === 'staff')
                                <td>
                                    <a href="{{ route('subjects.edit', $subject->subject_id) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="empty-state">
            <p>No subjects found</p>
            @if(auth()->user()->isAdmin() || auth()->user()->account_type === 'staff')
                <p style="color: #6b7280;">Start by <a href="{{ route('subjects.create') }}">creating a new subject</a></p>
            @endif
        </div>
    @endif
</div>
@endsection
