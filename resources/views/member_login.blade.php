<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Member Portal | NGO DEMO</title>
    
    {{-- <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet"> --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
     <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@300;400;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --ngo-green: #008000;
            --danger: #cc0000;
            --navy: #1a2a6c;
        }

        body {
            font-family: 'Roboto Condensed', sans-serif !important;
    
            /* font-family: 'Great Vibes', cursive; */
            background-color: #f0f2f5;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
        }

        .main-container {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
            width: 90%;
            max-width: 900px;
            display: flex;
            flex-wrap: wrap;
        }

        /* Left Side: Image/Info */
        .member-info-side {
            background: linear-gradient(rgba(26, 42, 108, 0.8), rgba(0, 128, 0, 0.8)), url('https://images.unsplash.com/photo-1559027615-cd7607df7494?q=80&w=2074');
            background-size: cover;
            background-position: center;
            color: white;
            padding: 40px;
            flex: 1;
            min-width: 300px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        /* Right Side: Form */
        .login-form-side {
            padding: 50px;
            flex: 1.2;
            min-width: 300px;
        }

        .ngo-brand {
            color: var(--danger);
            font-weight: 800;
            font-size: 28px;
            margin-bottom: 5px;
        }

        .form-label { font-weight: 600; color: #444; }

        .form-control {
            border-radius: 8px;
            padding: 12px;
            background-color: #f8f9fa;
            border: 1px solid #eee;
        }

        .form-control:focus {
            background-color: #fff;
            border-color: var(--ngo-green);
            box-shadow: none;
        }

        .btn-member-login {
            background: var(--navy);
            color: white;
            border: none;
            padding: 12px;
            border-radius: 8px;
            width: 100%;
            font-weight: 600;
            transition: 0.3s;
            margin-top: 15px;
        }

        .btn-member-login:hover {
            background: var(--ngo-green);
            transform: translateY(-2px);
        }

        .register-text {
            text-align: center;
            margin-top: 25px;
            font-size: 14px;
            color: #777;
        }

        .register-text a {
            color: var(--ngo-green);
            font-weight: 700;
            text-decoration: none;
        }

        @media (max-width: 768px) {
            .member-info-side { display: none; }
            .login-form-side { padding: 30px; }
        }
    </style>
</head>
<body>

    <div class="main-container">
        <div class="member-info-side">
            <h2 class="fw-bold">Welcome Back, Change-Maker!</h2>
            <p class="opacity-75">Aapke sahyog se hi hum roz nayi manzilein tay kar rahe hain. Login karein aur apni progress dekhein.</p>
            <div class="mt-4">
                <div class="d-flex align-items-center mb-3">
                    <i class="fa fa-check-circle me-2"></i>
                    <span>Track your donations</span>
                </div>
                <div class="d-flex align-items-center mb-3">
                    <i class="fa fa-check-circle me-2"></i>
                    <span>Get Member Certificate</span>
                </div>
                <div class="d-flex align-items-center">
                    <i class="fa fa-check-circle me-2"></i>
                    <span>Manage Volunteers</span>
                </div>
            </div>
        </div>

        <div class="login-form-side">
            <div class="text-center mb-4">
                <div class="ngo-brand">NGO DEMO</div>
                <h4 class="fw-bold">Member Login</h4>
            </div>

            <form>
                <div class="mb-3">
                    <label class="form-label">Member ID / Registered Mobile</label>
                    <div class="input-group">
                        <span class="input-group-text bg-white"><i class="fa fa-id-card text-muted"></i></span>
                        <input type="text" class="form-control" placeholder="NGO-2024-XXXX" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <div class="input-group">
                        <span class="input-group-text bg-white"><i class="fa fa-lock text-muted"></i></span>
                        <input type="password" id="memberPass" class="form-control" placeholder="••••••••" required>
                        <button class="btn btn-outline-secondary border-start-0" type="button" onclick="togglePass()">
                            <i class="fa fa-eye" id="passIcon"></i>
                        </button>
                    </div>
                </div>

                <div class="d-flex justify-content-between mb-4">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="rem">
                        <label class="form-check-label small" for="rem">Stay logged in</label>
                    </div>
                    <a href="#" class="small text-success text-decoration-none">Forgot Password?</a>
                </div>

                <button type="submit" class="btn-member-login">LOGIN TO PORTAL</button>
            </form>

            <div class="register-text">
                Don't have a Member ID? <br>
                <a href="">Apply for Membership Now</a>
            </div>

            <div class="mt-4 text-center">
                <a href="{{ route('home.index') }}" class="text-muted small text-decoration-none">
                    <i class="fa fa-arrow-left"></i> Back to Homepage
                </a>
            </div>
        </div>
    </div>

    <script>
        function togglePass() {
            const passInput = document.getElementById('memberPass');
            const icon = document.getElementById('passIcon');
            if (passInput.type === 'password') {
                passInput.type = 'text';
                icon.classList.replace('fa-eye', 'fa-eye-slash');
            } else {
                passInput.type = 'password';
                icon.classList.replace('fa-eye-slash', 'fa-eye');
            }
        }
    </script>

</body>
</html>