@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h3>Edit Profile</h3>
    <form method="POST" action="{{ route('employee.profile.update') }}">
        @csrf
        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" value="{{ old('name', $user->name) }}" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" value="{{ old('email', $user->email) }}" class="form-control" required>
        </div>
        <button class="btn btn-primary">Update</button>
        <a href="{{ route('employee.home') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
