<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login | NGO DEMO Portal</title>

    {{-- <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet"> --}}
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@300;400;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --ngo-green: #008000;
            --danger: #cc0000;
            --navy: #1a2a6c;
        }

        body {
            font-family: 'Roboto Condensed', sans-serif !important;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
        }

        .login-card {
            background: white;
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            border-top: 5px solid var(--ngo-green);
        }

        .logo-section {
            text-align: center;
            margin-bottom: 5px;
        }

        .ngo-name {
            color: var(--danger);
            font-weight: 800;
            font-size: 22px;
            margin-top: 10px;
        }

        .form-label {
            font-weight: 600;
            font-size: 14px;
            color: #555;
        }

        .form-control {
            border-radius: 10px;
            padding: 12px;
            border: 1px solid #ddd;
        }

        .form-control:focus {
            border-color: var(--ngo-green);
            box-shadow: 0 0 0 0.25rem rgba(0, 128, 0, 0.1);
        }

        .btn-login {
            background: var(--ngo-green);
            color: white;
            width: 100%;
            padding: 12px;
            border-radius: 10px;
            font-weight: 600;
            border: none;
            transition: 0.3s;
            margin-top: 20px;
        }

        .btn-login:hover {
            background: #006400;
            transform: translateY(-2px);
        }

        .back-link {
            text-align: center;
            margin-top: 20px;
        }

        .back-link a {
            color: #777;
            text-decoration: none;
            font-size: 14px;
        }

        .back-link a:hover {
            color: var(--danger);
        }

        .input-group-text {
            background: transparent;
            border-left: none;
            cursor: pointer;
        }

        .password-input {
            border-right: none;
        }
    </style>
</head>

<body>

    <div class="login-card">
        <div class="logo-section">
            <img src="{{ asset($settings->logo) }}" class="rounded-circle" alt="NGO Logo"
                style="width: 150px; height: 150px">

        </div>

        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Email Address</label>
                <div class="input-group">
                    <span class="input-group-text bg-light border-end-0"><i class="fa fa-user text-muted"></i></span>
                    <input type="email" name="email" class="form-control border-start-0"
                        placeholder="admin@example.com" value="{{ old('email') }}" >
                </div>
                @error('email')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>


            <div class="mb-3">
                <label class="form-label">Password</label>
                <div class="input-group">
                    <span class="input-group-text bg-light border-end-0"><i class="fa fa-lock text-muted"></i></span>
                    <input type="password" name="password" id="password"
                        class="form-control border-start-0 password-input" placeholder="••••••••" >
                    <span class="input-group-text" onclick="togglePassword()">
                        <i class="fa fa-eye" id="toggleIcon"></i>
                    </span>
                </div>
            </div>

            <button type="submit" class="btn-login shadow">LOGIN TO DASHBOARD</button>
        </form>

        <div class="back-link">
            <a href="{{ route('home.index') }}"><i class="fa fa-arrow-left me-1"></i> Back to Website</a>
        </div>
    </div>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.getElementById('toggleIcon');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            }
        }
    </script>

</body>

</html>
