@extends('layouts.app')

@section('title', 'Users')

@section('content')
<div class="page-header d-flex justify-content-between align-items-center">
    <div>
        <h1>Users</h1>
        <p>Manage system users and their roles</p>
    </div>
    <a href="{{ route('users.create') }}" class="btn btn-primary">New User</a>
</div>

<div class="card">
    @if($users->count() > 0)
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Account Type</th>
                        <th>Created On</th>
                        <th>Created By</th>
                        <th>Updated On</th>
                        <th>Updated By</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td><span class="badge bg-light" style="color: #111827; border: 1px solid #e5e7eb;">{{ $user->id }}</span></td>
                            <td>{{ $user->username }}</td>
                            <td><span class="badge bg-light" style="color: #111827; border: 1px solid #e5e7eb;">{{ ucfirst($user->account_type) }}</span></td>
                            <td><small style="color: #6b7280;">{{ $user->created_on ? \Carbon\Carbon::parse($user->created_on)->format('M d, Y H:i') : '-' }}</small></td>
                            <td><small style="color: #6b7280;">{{ $user->createdBy ? $user->createdBy->username : '-' }}</small></td>
                            <td><small style="color: #6b7280;">{{ $user->updated_on ? \Carbon\Carbon::parse($user->updated_on)->format('M d, Y H:i') : 'NULL' }}</small></td>
                            <td><small style="color: #6b7280;">{{ $user->updatedBy ? $user->updatedBy->username : 'NULL' }}</small></td>
                            <td>
                                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="empty-state">
            <p>No users found</p>
            <p style="color: #6b7280;">Start by <a href="{{ route('users.create') }}">creating a new user</a></p>
        </div>
    @endif
</div>
@endsection
