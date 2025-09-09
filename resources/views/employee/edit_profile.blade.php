<!doctype html>
<html lang="en">

<head>
    <title>Update Profile</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

</head>

<body>
    <div class="container py-4">

        {{-- Validation Errors --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Success Message --}}
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif


        <form action="{{ route('employee.edit_profile') }}" method="POST" enctype="multipart/form-data"
            id="employeeForm">
            @csrf
            @method('PUT') {{-- Spoof PUT method --}}
            <div class="card shadow-lg border-0 rounded-3 mx-auto" style="max-width: 800px;">
                <div
                    class="card-header bg-primary text-white d-flex align-items-center justify-content-between fs-5 fw-bold">
                    <!-- Back button -->
                    <a href="{{ route('employee.home') }}" class="text-white text-decoration-none" data-toggle="tooltip"
                        data-placement="bottom" title="Back">
                        <i class="bi bi-arrow-left"></i>
                    </a>
                    <span class="mx-auto">Update Your Profile</span>
                    <span></span>
                </div>


                <div class="text-center mt-4">
                    {{-- Profile Image --}}
                    @if ($employee->id_proof ?? false)
                        <img src="{{ asset('storage/' . $employee->id_proof) }}" alt="Profile Image"
                            class="rounded-circle border border-3 border-primary"
                            style="width: 120px; height: 120px; object-fit: cover;">
                    @else
                        <img src="{{ asset('images/default-profile.png') }}" alt="Default Profile"
                            class="rounded-circle border border-3 border-primary"
                            style="width: 120px; height: 120px; object-fit: cover;">
                    @endif

                    {{-- Upload New Profile Image --}}
                    <div class="text-center col mt-3">
                        <div class="gap-2">
                            @if ($employee->id_proof)
                                <a href="{{ asset('storage/' . $employee->id_proof) }}" target="_blank"
                                    class="btn btn-sm btn-outline-primary">
                                    Current
                                </a>
                            @endif
                            <label class="btn btn-outline-primary btn-sm mb-0">
                                Change Image
                                <input type="file" name="id_proof" class="d-none">
                            </label>
                        </div>
                    </div>



                </div>

                <div class="card-body p-4">
                    {{-- Basic & Contact Information --}}
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label class="form-label">First Name</label>
                            <input type="text" name="first_name" class="form-control"
                                value="{{ old('first_name', $employee->first_name) }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Last Name</label>
                            <input type="text" name="last_name" class="form-control"
                                value="{{ old('last_name', $employee->last_name) }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Date of Birth</label>
                            <input type="date" name="dob" class="form-control"
                                value="{{ old('dob', $employee->dob) }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Gender</label>
                            <select name="gender" class="form-control" required>
                                <option value="Male"
                                    {{ old('gender', $employee->gender) == 'Male' ? 'selected' : '' }}>Male</option>
                                <option value="Female"
                                    {{ old('gender', $employee->gender) == 'Female' ? 'selected' : '' }}>Female
                                </option>
                                <option value="Other"
                                    {{ old('gender', $employee->gender) == 'Other' ? 'selected' : '' }}>Other</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Phone</label>
                            <input type="tel" name="phone" class="form-control"
                                value="{{ old('phone', $employee->phone) }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control"
                                value="{{ old('email', $employee->email) }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Password</label>
                            <input type="password" name="password_hash" class="form-control">
                            <small class="text-muted">Leave blank if you don’t want to change it.</small>
                        </div>

                        <div class="col-12">
                            <label class="form-label">Address</label>
                            <textarea name="address" class="form-control" rows="2" required>{{ old('address', $employee->address) }}</textarea>
                        </div>
                    </div>
                </div>

                {{-- Submit --}}
                <div class="text-center mt-4 mb-4">
                    <button type="submit" class="btn btn-lg btn-primary">Update Profile</button>
                </div>
            </div>
    </div>
    </form>
    </div>



    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
</body>

</html>
