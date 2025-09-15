@extends('layouts.app')

<div class="container">
    <h1>Job Desk Hub</h1>
    <a href="{{ route('jobs.create') }}" class="btn btn-primary mb-3">Add New Job</a>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <ul class="list-group">
        @forelse($jobs as $job)
            <li class="list-group-item">
                {{ $job->designation }} - {{ $job->department_id }} ({{ $job->role_id }})
                <span class="badge badge-secondary float-right">${{ $job->salary_range }}</span>
            </li>
        @empty
            <li class="list-group-item">No jobs available.</li>
        @endforelse
    </ul>
</div>@extends('layouts.app')

<div class="container">
    <h1>Job Desk Hub</h1>
    <a href="{{ route('jobs.create') }}" class="btn btn-primary mb-3">Add New Job</a>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <ul class="list-group">
        @forelse($jobs as $job)
            <li class="list-group-item">
                {{ $job->designation }} - {{ $job->department_id }} ({{ $job->role_id }})
                <span class="badge badge-secondary float-right">${{ $job->salary_range }}</span>
            </li>
        @empty
            <li class="list-group-item">No jobs available.</li>
        @endforelse
    </ul>
</div>@extends('layouts.app')

<div class="container">
    <h1>Job Desk Hub</h1>
    <a href="{{ route('jobs.create') }}" class="btn btn-primary mb-3">Add New Job</a>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <ul class="list-group">
        @forelse($jobs as $job)
            <li class="list-group-item">
                {{ $job->designation }} - {{ $job->department_id }} ({{ $job->role_id }})
                <span class="badge badge-secondary float-right">${{ $job->salary_range }}</span>
            </li>
        @empty
            <li class="list-group-item">No jobs available.</li>
        @endforelse
    </ul>
</div>@extends('layouts.app')

<div class="container">
    <h1>Job Desk Hub</h1>
    <a href="{{ route('jobs.create') }}" class="btn btn-primary mb-3">Add New Job</a>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <ul class="list-group">
        @forelse($jobs as $job)
            <li class="list-group-item">
                {{ $job->designation }} - {{ $job->department_id }} ({{ $job->role_id }})
                <span class="badge badge-secondary float-right">${{ $job->salary_range }}</span>
            </li>
        @empty
            <li class="list-group-item">No jobs available.</li>
        @endforelse
    </ul>
</div>@extends('layouts.app')

<div class="container">
    <h1>Job Desk Hub</h1>
    <a href="{{ route('jobs.create') }}" class="btn btn-primary mb-3">Add New Job</a>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <ul class="list-group">
        @forelse($jobs as $job)
            <li class="list-group-item">
                {{ $job->designation }} - {{ $job->department_id }} ({{ $job->role_id }})
                <span class="badge badge-secondary float-right">${{ $job->salary_range }}</span>
            </li>
        @empty
            <li class="list-group-item">No jobs available.</li>
        @endforelse
    </ul>
</div>@extends('layouts.app')

<div class="container">
    <h1>Job Desk Hub</h1>
    <a href="{{ route('jobs.create') }}" class="btn btn-primary mb-3">Add New Job</a>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <ul class="list-group">
        @forelse($jobs as $job)
            <li class="list-group-item">
                {{ $job->designation }} - {{ $job->department_id }} ({{ $job->role_id }})
                <span class="badge badge-secondary float-right">${{ $job->salary_range }}</span>
            </li>
        @empty
            <li class="list-group-item">No jobs available.</li>
        @endforelse
    </ul>
</div>@extends('layouts.app')

<div class="container">
    <h1>Job Desk Hub</h1>
    <a href="{{ route('jobs.create') }}" class="btn btn-primary mb-3">Add New Job</a>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <ul class="list-group">
        @forelse($jobs as $job)
            <li class="list-group-item">
                {{ $job->designation }} - {{ $job->department_id }} ({{ $job->role_id }})
                <span class="badge badge-secondary float-right">${{ $job->salary_range }}</span>
            </li>
        @empty
            <li class="list-group-item">No jobs available.</li>
        @endforelse
    </ul>
</div>@extends('layouts.app')

<div class="container">
    <h1>Job Desk Hub</h1>
    <a href="{{ route('jobs.create') }}" class="btn btn-primary mb-3">Add New Job</a>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <ul class="list-group">
        @forelse($jobs as $job)
            <li class="list-group-item">
                {{ $job->designation }} - {{ $job->department_id }} ({{ $job->role_id }})
                <span class="badge badge-secondary float-right">${{ $job->salary_range }}</span>
            </li>
        @empty
            <li class="list-group-item">No jobs available.</li>
        @endforelse
    </ul>
</div>@extends('layouts.app')

<div class="container">
    <h1>Job Desk Hub</h1>
    <a href="{{ route('jobs.create') }}" class="btn btn-primary mb-3">Add New Job</a>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <ul class="list-group">
        @forelse($jobs as $job)
            <li class="list-group-item">
                {{ $job->designation }} - {{ $job->department_id }} ({{ $job->role_id }})
                <span class="badge badge-secondary float-right">${{ $job->salary_range }}</span>
            </li>
        @empty
            <li class="list-group-item">No jobs available.</li>
        @endforelse
    </ul>
</div>