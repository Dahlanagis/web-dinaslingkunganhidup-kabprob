<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - Dinas Lingkungan Hidup</title>
    @php
        $siteSetting = \App\Models\Setting::first();
        $favPath = $siteSetting?->favicon_path ?: $siteSetting?->logo_path;
        $faviconUrl = $favPath ? asset('storage/' . $favPath) : null;
    @endphp
    @if($faviconUrl)
        <link rel="icon" type="image/x-icon" href="{{ $faviconUrl }}">
        <link rel="shortcut icon" href="{{ $faviconUrl }}">
        <link rel="apple-touch-icon" href="{{ $faviconUrl }}">
    @endif
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #f8fafc;
            margin: 0;
            padding: 0;
            overflow-x: hidden;
            min-height: 100vh;
            box-sizing: border-box;
        }

        *, *:before, *:after {
            box-sizing: inherit;
        }

        .split-layout {
            display: flex;
            min-height: 100vh;
            flex-wrap: wrap;
        }

        /* LEFT PANEL (BRANDING) */
        .left-panel {
            width: 45%;
            background-color: #092612; /* Very Dark Green */
            color: white;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 40px;
            padding-bottom: 60px; /* Space for footer */
            position: relative;
        }
        
        .brand-logo-container {
            width: 110px;
            height: 110px;
            background: rgba(255, 255, 255, 0.08); /* Subtle like screenshot */
            border-radius: 25px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 15px;
        }

        .brand-logo-container img {
            width: 75px;
            height: 75px;
            object-fit: contain;
        }

        .left-title {
            font-size: 1.6rem;
            font-weight: 700;
            margin-bottom: 8px;
            text-align: center;
            letter-spacing: -0.2px;
        }

        .title-divider {
            width: 50px;
            height: 3px;
            background-color: #fbc02d; /* Gold line */
            border-radius: 2px;
            margin: 0 auto 10px auto;
        }

        .left-subtitle {
            font-size: 0.85rem;
            color: rgba(255, 255, 255, 0.8);
            text-align: center;
            max-width: 75%;
            line-height: 1.5;
            margin-bottom: 20px;
        }

        .badge-container {
            display: flex;
            gap: 15px;
            justify-content: center;
            width: 100%;
        }

        .custom-badge {
            padding: 8px 18px;
            border-radius: 50px;
            border: 1px solid rgba(255, 255, 255, 0.3);
            font-size: 0.8rem;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 8px;
            background: rgba(255, 255, 255, 0.1);
        }

        .left-footer {
            position: absolute;
            bottom: 25px;
            left: 0;
            right: 0;
            text-align: center;
            font-size: 0.8rem;
            color: rgba(255, 255, 255, 0.5);
        }

        /* RIGHT PANEL (FORM) */
        .right-panel {
            width: 55%;
            background-color: #ffffff;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 40px;
            padding-bottom: 60px; /* Space for footer */
            position: relative;
        }

        .form-container {
            width: 100%;
            max-width: 400px; /* Reduced for neatness */
            margin: auto; /* Fixes top cutoff when flex centered */
            padding-top: 10px;
            padding-bottom: 10px;
        }

        .form-title {
            font-size: 1.4rem;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 4px;
        }

        .form-subtitle {
            font-size: 0.8rem;
            color: #64748b;
            margin-bottom: 15px;
        }

        .form-label {
            font-size: 0.75rem;
            font-weight: 600;
            color: #334155;
            margin-bottom: 4px;
        }

        .form-control-custom {
            display: block;
            width: 100%;
            padding: 8px 12px;
            font-size: 0.85rem;
            font-weight: 500;
            color: #1e293b;
            background-color: #f1f5f9; /* Light gray-blue bg */
            border: 1px solid #cbd5e1;
            border-radius: 6px;
            transition: all 0.2s ease;
        }

        .form-control-custom:focus {
            outline: none;
            border-color: #092612;
            background-color: #fff;
            box-shadow: 0 0 0 3px rgba(9, 38, 18, 0.1);
        }

        .input-group-custom {
            position: relative;
        }

        .input-group-custom i.bi-person-fill,
        .input-group-custom i.bi-lock-fill,
        .input-group-custom i.bi-shield-check {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
            font-size: 1rem;
        }

        .input-group-custom .form-control-custom {
            padding-left: 35px;
        }

        #password {
            padding-right: 35px;
        }

        .eye-toggle {
            position: absolute;
            right: 8px;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
            cursor: pointer;
            border: none;
            background: transparent;
            padding: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* CAPTCHA FAKE UI */
        .captcha-box {
            display: flex;
            align-items: center;
            background: #ffffff;
            border: 1px solid #cbd5e1;
            border-radius: 6px;
            padding: 4px;
            gap: 6px;
            margin-bottom: 6px;
        }

        .captcha-image {
            flex-grow: 1;
            height: 35px;
            background: #ffffff;
            border-radius: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Courier New', Courier, monospace;
            font-size: 1.2rem;
            font-weight: bold;
            color: #334155;
            letter-spacing: 5px;
            position: relative;
            overflow: hidden;
        }
        
        /* Noise lines for captcha */
        .captcha-image::before {
            content: '';
            position: absolute;
            width: 100%;
            height: 2px;
            background: #cbd5e1;
            transform: rotate(-3deg);
        }
        .captcha-image::after {
            content: '';
            position: absolute;
            width: 100%;
            height: 1px;
            background: #94a3b8;
            transform: rotate(5deg);
        }

        .captcha-reload {
            width: 35px;
            height: 35px;
            border-radius: 6px;
            border: 1px solid #cbd5e1;
            background: white;
            color: #64748b;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s;
        }
        .captcha-reload:hover {
            background: #f1f5f9;
            color: #1e293b;
        }

        /* Buttons */
        .btn-custom-primary {
            background-color: #092612; /* Very Dark Green */
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 6px;
            font-weight: 700;
            font-size: 0.85rem;
            transition: all 0.3s ease;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
        }

        .btn-custom-primary:hover {
            background-color: #041208;
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(27, 94, 32, 0.2);
        }

        .btn-custom-secondary {
            background-color: white;
            color: #475569;
            border: 1px solid #cbd5e1;
            padding: 8px 16px;
            border-radius: 6px;
            font-weight: 600;
            font-size: 0.85rem;
            transition: all 0.2s ease;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
        }

        .btn-custom-secondary:hover {
            background-color: #f8fafc;
            color: #1e293b;
        }

        .btn-row {
            display: flex;
            gap: 10px;
            margin-top: 15px;
        }
        
        .btn-row > div:first-child { flex: 1; }
        .btn-row > div:last-child { flex: 2; }

        .form-check-label {
            font-size: 0.8rem;
            font-weight: 500;
            color: #64748b;
        }

        .forgot-link {
            font-size: 0.8rem;
            font-weight: 700;
            color: #092612;
            text-decoration: none;
        }

        .forgot-link:hover {
            text-decoration: underline;
        }

        .right-footer {
            position: absolute;
            bottom: 25px;
            left: 0;
            right: 0;
            text-align: center;
            font-size: 0.75rem;
            color: #94a3b8;
            font-weight: 500;
        }

        /* Error Messages */
        .error-message {
            color: #ef4444;
            font-size: 0.8rem;
            font-weight: 500;
            margin-top: 4px;
        }

        @media (max-width: 991px) {
            .split-layout { flex-direction: column; height: auto; }
            .left-panel { width: 100%; padding: 60px 20px; min-height: 400px; }
            .right-panel { width: 100%; padding: 40px 20px; }
            .left-footer, .right-footer { position: relative; bottom: 0; margin-top: 40px; }
        }
    </style>
</head>
<body>

    <div class="split-layout">
        
        <!-- LEFT PANEL -->
        <div class="left-panel">
            <div class="brand-logo-container">
                @php
                    $loginSetting = \App\Models\Setting::first();
                    $loginLogoUrl = $loginSetting?->logo_path ? asset('storage/' . $loginSetting->logo_path) : asset('storage/settings/01M1YY8BN5S1Z5WMQT4BQF44Q0.jpg');
                @endphp
                <img src="{{ $loginLogoUrl }}" alt="Logo DLH" onerror="this.outerHTML='<i class=\'bi bi-tree-fill\' style=\'font-size: 3rem; color: #fff;\'></i>'">
            </div>
            
            <h1 class="left-title">Dinas Lingkungan Hidup<br>Kab. Probolinggo</h1>
            <div class="title-divider"></div>
            
            <p class="left-subtitle">
                Sistem Informasi Manajemen Terpadu untuk Publikasi dan Pelayanan Masyarakat.
            </p>

            <div class="badge-container mt-4">
                <div class="custom-badge">
                    <i class="bi bi-shield-check"></i> Administrator Akses
                </div>
                <div class="custom-badge">
                    <i class="bi bi-lock-fill"></i> Enkripsi SSL
                </div>
            </div>

            <div class="left-footer">
                &copy; {{ date('Y') }} Hak Cipta Dilindungi
            </div>
        </div>

        <!-- RIGHT PANEL -->
        <div class="right-panel">
            
            <div class="form-container">
                <h2 class="form-title">Login Admin</h2>
                <p class="form-subtitle">Masukkan kredensial akun administrator Anda</p>

                <!-- Session Status -->
                @if (session('status'))
                    <div class="alert alert-success mb-4" style="font-size: 0.9rem; padding: 10px; border-radius: 8px;">
                        {{ session('status') }}
                    </div>
                @endif

                <div class="mb-3 p-3 rounded-3" style="background: #f0fdf4; border: 1px solid #bbf7d0; font-size: 0.82rem; color: #166534;">
                    <div class="fw-bold mb-1"><i class="bi bi-shield-lock-fill me-1 text-success"></i> Kredensial Administrator:</div>
                    <div style="line-height: 1.5;">Email: <strong>superadminDLH@gmail.com</strong> (atau: <strong>superadminDLH</strong>)</div>
                    <div style="line-height: 1.5;">Password: <strong>password</strong></div>
                </div>

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Email Address -->
                    <div class="mb-3">
                        <label for="email" class="form-label">Email / Username</label>
                        <div class="input-group-custom">
                            <i class="bi bi-person-fill"></i>
                            <input id="email" type="text" class="form-control-custom" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" placeholder="Masukkan email atau username anda...">
                        </div>
                        @error('email')
                            <div class="error-message" style="color: #dc2626; font-size: 0.82rem; margin-top: 5px;">
                                <i class="bi bi-exclamation-circle-fill me-1"></i>
                                {{ $message === 'auth.failed' ? 'Email/Username atau password yang dimasukkan salah.' : $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <div class="input-group-custom">
                            <i class="bi bi-lock-fill"></i>
                            <input id="password" type="password" class="form-control-custom" name="password" required autocomplete="current-password" placeholder="Masukkan password...">
                            <button type="button" class="eye-toggle" onclick="togglePassword()">
                                <i class="bi bi-eye-slash-fill" id="eyeIcon"></i>
                            </button>
                        </div>
                        @error('password')
                            <div class="error-message" style="color: #dc2626; font-size: 0.82rem; margin-top: 5px;">
                                <i class="bi bi-exclamation-circle-fill me-1"></i>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <!-- Captcha (Visual Mockup) -->
                    <div class="mb-3">
                        <label class="form-label">Verifikasi Keamanan</label>
                        
                        <div class="captcha-box">
                            <div class="captcha-image" id="captchaImage">
                                K U H X S
                            </div>
                            <button type="button" class="captcha-reload" onclick="reloadCaptcha()" title="Muat ulang Captcha">
                                <i class="bi bi-arrow-clockwise"></i>
                            </button>
                        </div>
                        
                        <div class="input-group-custom">
                            <i class="bi bi-shield-check"></i>
                            <input type="text" class="form-control-custom" name="captcha" required placeholder="KETIK KARAKTER DI ATAS...">
                        </div>
                    </div>

                    <!-- Remember Me & Forgot Password -->
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <div class="form-check">
                            <input class="form-check-input shadow-sm" type="checkbox" name="remember" id="remember_me">
                            <label class="form-check-label" for="remember_me">
                                Ingat Saya
                            </label>
                        </div>
                        
                        @if (Route::has('password.request'))
                            <a class="forgot-link" href="{{ route('password.request') }}">
                                Lupa Sandi?
                            </a>
                        @endif
                    </div>

                    <!-- Buttons -->
                    <div class="btn-row">
                        <div>
                            <a href="/" class="btn-custom-secondary text-decoration-none">
                                <i class="bi bi-arrow-left"></i> Batal
                            </a>
                        </div>
                        <div>
                            <button type="submit" class="btn-custom-primary">
                                Login Sekarang <i class="bi bi-arrow-right"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="right-footer">
                &copy; {{ date('Y') }} Dinas Lingkungan Hidup Kab. Probolinggo
            </div>
            
        </div>
    </div>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eyeIcon');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.classList.remove('bi-eye-slash-fill');
                eyeIcon.classList.add('bi-eye-fill');
            } else {
                passwordInput.type = 'password';
                eyeIcon.classList.remove('bi-eye-fill');
                eyeIcon.classList.add('bi-eye-slash-fill');
            }
        }

        function reloadCaptcha() {
            const chars = 'ABCDEFGHJKLMNPQRSTUVWXYZ23456789';
            let result = '';
            for (let i = 0; i < 5; i++) {
                result += chars.charAt(Math.floor(Math.random() * chars.length)) + ' ';
            }
            document.getElementById('captchaImage').innerText = result.trim();
        }
        
        // Init captcha
        reloadCaptcha();
    </script>
</body>
</html>
