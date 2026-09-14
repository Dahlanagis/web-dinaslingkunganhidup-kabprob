<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sesi Kedaluwarsa - Dinas Lingkungan Hidup</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: linear-gradient(135deg, #092612 0%, #031409 100%);
            color: #ffffff;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 20px;
            box-sizing: border-box;
        }
        .error-card {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border-radius: 24px;
            padding: 40px 30px;
            max-width: 480px;
            width: 100%;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
        }
        .error-icon {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: rgba(234, 179, 8, 0.15);
            border: 2px solid rgba(234, 179, 8, 0.4);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.2rem;
            color: #facc15;
            margin: 0 auto 20px auto;
        }
        h1 {
            font-size: 1.5rem;
            font-weight: 800;
            margin: 0 0 10px 0;
        }
        p {
            font-size: 0.92rem;
            color: rgba(255, 255, 255, 0.75);
            line-height: 1.6;
            margin: 0 0 26px 0;
        }
        .btn-refresh {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: linear-gradient(135deg, #16a34a 0%, #15803d 100%);
            color: #ffffff;
            text-decoration: none;
            padding: 12px 28px;
            border-radius: 12px;
            font-weight: 700;
            font-size: 0.92rem;
            border: 1px solid #4ade80;
            cursor: pointer;
            transition: all 0.25s ease;
            box-shadow: 0 4px 14px rgba(22, 163, 74, 0.4);
        }
        .btn-refresh:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(22, 163, 74, 0.6);
            background: linear-gradient(135deg, #22c55e 0%, #16a34a 100%);
        }
    </style>
</head>
<body>
    <div class="error-card">
        <div class="error-icon">
            <i class="bi bi-shield-exclamation"></i>
        </div>
        <h1>Halaman / Sesi Kedaluwarsa</h1>
        <p>Halaman login telah terbuka terlalu lama sehingga sesi token keamanan perlu disegarkan kembali.</p>
        <a href="{{ url('/login') }}" class="btn-refresh">
            <i class="bi bi-arrow-clockwise"></i> Muat Ulang Halaman Login
        </a>
    </div>
</body>
</html>
