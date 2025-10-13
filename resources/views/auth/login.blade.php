<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Employee Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      margin: 0;
      font-family: "Poppins", sans-serif;
      background: #dbdee2ff;;
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .login-container {
      display: flex;
      width: 900px;
      height: 550px;
      border-radius: 25px;
      overflow: hidden;
      background: #fff;
      box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
    }

    /* Left section (Form) */
    .login-form {
      flex: 1;
      padding: 60px 50px;
      background: linear-gradient(135deg, #fefefe, #fff8e1);
      display: flex;
      flex-direction: column;
      justify-content: center;
    }

    .login-form h3 {
      font-weight: 600;
      margin-bottom: 10px;
      color: #333;
    }

    .login-form p {
      color: #666;
      margin-bottom: 30px;
    }

    .form-control {
      border-radius: 10px;
      padding: 12px;
      margin-bottom: 15px;
      border: 1px solid #ddd;
    }

    .btn-submit {
      background-color: #ffcb2b;
      border: none;
      border-radius: 12px;
      padding: 12px;
      font-weight: 600;
      width: 100%;
      transition: 0.3s;
    }

    .btn-submit:hover {
      background-color: #f0bb00;
      transform: translateY(-2px);
    }

    .login-form .social-btns {
      display: flex;
      justify-content: space-between;
      margin-top: 20px;
    }

    .social-btns button {
      width: 48%;
      border-radius: 10px;
      padding: 10px;
      border: 1px solid #ccc;
      background-color: #fff;
      font-weight: 500;
    }

    .social-btns button:hover {
      background-color: #f9f9f9;
    }

    /* Right section (Image) */
    .login-image {
      flex: 1;
      background-image: url("https://images.pexels.com/photos/3184422/pexels-photo-3184422.jpeg"); 
      background-size: cover;
      background-position: center;
      position: relative;
    }

    .image-overlay {
      position: absolute;
      inset: 0;
      background: rgba(190, 181, 181, 0);
    }

    @media (max-width: 768px) {
      .login-container {
        flex-direction: column;
        width: 95%;
        height: auto;
      }

      .login-image {
        height: 250px;
      }

      .login-form {
        padding: 40px 30px;
      }
    }
  </style>
</head>

<body>
  <div class="login-container">
    <!-- Left section -->
    <div class="login-form">
      <h3>Employee Login</h3>
      <p>Sign in to access your dashboard</p>

      {{-- Error Message --}}
      @if (session('error'))
        <div class="alert alert-danger">
          {{ session('error') }}
        </div>
      @endif

      {{-- Validation Errors --}}
      @if ($errors->any())
        <div class="alert alert-danger">
          <ul class="mb-0">
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <form method="POST" action="{{ route('login.submit') }}">
        @csrf
        <input type="email" name="email" class="form-control" placeholder="Email Address" required autofocus>
        <input type="password" name="password" class="form-control" placeholder="Password" required>
        <button type="submit" class="btn btn-submit">Login</button>
      </form>

      <div class="social-btns">
        <button><img src="https://img.icons8.com/color/20/google-logo.png" alt=""> Google</button>
        <button><img src="https://img.icons8.com/ios-filled/20/mac-os.png" alt=""> Apple</button>
      </div>

    </div>

    <!-- Right section -->
    <div class="login-image">
      <div class="image-overlay"></div>
    </div>
  </div>
</body>

</html>
