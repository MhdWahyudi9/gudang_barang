<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login - Gudang Environtment</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Font (Nunito) -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #4e73df, #1cc88a);
            font-family: 'Nunito', sans-serif;
            position: relative;
            min-height: 100vh;
            margin: 0;
        }

        .shape {
            position: absolute;
            border-radius: 50%;
            filter: blur(100px);
            opacity: 0.3;
            animation: float 12s ease-in-out infinite alternate;
        }
        .shape1 {
            width: 400px;
            height: 400px;
            background: #ffffff;
            top: -100px;
            left: -150px;
        }
        .shape2 {
            width: 300px;
            height: 300px;
            background: #ffffff;
            bottom: -100px;
            right: -100px;
            animation-delay: 4s;
        }
        @keyframes float {
            0% { transform: translateY(0px) translateX(0px); }
            100% { transform: translateY(30px) translateX(20px); }
        }

        .wave {
            position: absolute;
            bottom: 0;
            width: 100%;
            height: 200px;
            background: url('https://svgshare.com/i/uHv.svg');
            background-repeat: no-repeat;
            background-size: cover;
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(15px);
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: all 0.3s;
        }
        .glass-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 50px rgba(0, 0, 0, 0.4);
        }
        .glass-card .card-header {
            background: transparent;
            border-bottom: none;
            color: white;
            font-weight: 700;
            font-size: 1.5rem;
        }
        .form-label {
            color: white;
            font-weight: 600;
        }
        .form-check-label {
            color: white;
            font-weight: 500;
            font-size: 0.9rem;
        }
        .form-control {
            background: rgba(255, 255, 255, 0.7);
            border: none;
            border-radius: 12px;
            padding: 10px 15px;
            transition: all 0.3s;
        }
        .form-control:focus {
            background: rgba(255, 255, 255, 0.95);
            box-shadow: 0 0 15px rgba(0,0,0,0.2);
        }
        .btn-custom {
            background: linear-gradient(90deg, #4e73df, #1cc88a);
            border: none;
            border-radius: 50px;
            font-weight: 700;
            transition: all 0.3s;
        }
        .btn-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.3);
        }
        .logo-img {
            width: 200px;
            margin-bottom: 15px;
        }
        .alert {
            border-radius: 12px;
        }

        .full-bg {
            background: url('{{ asset('images/background-login.jpg') }}') center/cover no-repeat;
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0.3;
            z-index: 1;
        }
        .wrapper-center {
            position: relative;
            z-index: 10;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }
    </style>
</head>
<body>

    <div class="shape shape1"></div>
    <div class="shape shape2"></div>
    <div class="wave"></div>

    <div class="full-bg"></div>

    <div class="wrapper-center">
        <div class="card glass-card text-center col-md-4">
            <div class="card-body">

                <img src="{{ asset('images/logo-pertamina.png') }}" alt="Logo Pertamina" class="logo-img">

                <div class="card-header text-center">Gudang Environtment</div>

                @if ($errors->any())
                    <div class="alert alert-danger text-center mt-3">
                        Email atau password salah.
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}" class="text-start mt-3">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" required autofocus value="{{ old('email') }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" id="password" class="form-control" required>
                    </div>

                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" id="showPassword" onclick="togglePassword()">
                        <label class="form-check-label" for="showPassword">
                            Tampilkan Password
                        </label>
                    </div>

                    <button type="submit" class="btn btn-custom w-100 py-2">Login</button>
                </form>

            </div>
        </div>
    </div>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById("password");
            if (passwordInput.type === "password") {
                passwordInput.type = "text";
            } else {
                passwordInput.type = "password";
            }
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
