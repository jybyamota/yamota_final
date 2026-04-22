@extends('layouts.app')

@section('title', 'Programs')

@section('content')
<div class="page-header d-flex justify-content-between align-items-center">
    <div>
        <h1>Programs</h1>
        <p>Manage academic programs and courses</p>
    </div>
    @if(auth()->user()->isAdmin() || auth()->user()->account_type === 'staff')
        <a href="{{ route('programs.create') }}" class="btn btn-primary">New Program</a>
    @endif
</div>

<div class="card">
    @if($programs->count() > 0)
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Code</th>
                        <th>Title</th>
                        <th>Duration</th>
                        <th>Created</th>
                        @if(auth()->user()->isAdmin() || auth()->user()->account_type === 'staff')
                            <th>Actions</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach($programs as $program)
                        <tr>
                            <td><span class="badge bg-light" style="color: #111827; border: 1px solid #e5e7eb;">{{ $program->code }}</span></td>
                            <td>{{ $program->title }}</td>
                            <td><span class="badge bg-light" style="color: #111827; border: 1px solid #e5e7eb;">{{ $program->years }} Year(s)</span></td>
                            <td><small style="color: #6b7280;">{{ $program->created_at ? $program->created_at->format('M d, Y') : '-' }}</small></td>
                            @if(auth()->user()->isAdmin() || auth()->user()->account_type === 'staff')
                                <td>
                                    <a href="{{ route('programs.edit', $program->program_id) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="empty-state">
            <p>No programs found</p>
            @if(auth()->user()->isAdmin() || auth()->user()->account_type === 'staff')
                <p style="color: #6b7280;">Start by <a href="{{ route('programs.create') }}">creating a new program</a></p>
            @endif
        </div>
    @endif
</div>
@endsection
