<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="col-md-5 offset-md-3">
        <h3 class="mb-4 text-center">Login</h3>

        <form method="POST" action="#" onsubmit="return false;">
            @csrf
            <div class="mb-3">
                <label class="form-label">Email Address</label>
                <input type="email" name="email" class="form-control" value="" />
            </div>

            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" value="" />
            </div>

            <button type="submit" class="btn btn-primary w-100" onclick="alert('Login submitted!')">Login</button>
        </form>
    </div>
</div>
</body>
</html>
