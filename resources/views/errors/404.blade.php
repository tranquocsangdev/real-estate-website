<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Không tìm thấy trang</title>
    <style>
        :root {
            --bg-main: #0f172a;
            --bg-soft: #1e293b;
            --accent: #f97316;
            --text-main: #f8fafc;
            --text-muted: #cbd5e1;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: Inter, Arial, sans-serif;
            background: radial-gradient(circle at 20% 20%, #1e293b 0%, #0f172a 45%, #020617 100%);
            color: var(--text-main);
            display: grid;
            place-items: center;
            overflow: hidden;
        }

        .glow {
            position: fixed;
            border-radius: 50%;
            filter: blur(45px);
            opacity: 0.35;
            z-index: 0;
            animation: float 6s ease-in-out infinite;
        }

        .glow.one {
            width: 280px;
            height: 280px;
            background: #f97316;
            top: -60px;
            left: -60px;
        }

        .glow.two {
            width: 240px;
            height: 240px;
            background: #0ea5e9;
            right: -70px;
            bottom: -70px;
            animation-delay: 1.5s;
        }

        .error-card {
            width: min(92vw, 640px);
            padding: 42px 34px 30px;
            border: 1px solid rgba(255, 255, 255, 0.12);
            border-radius: 24px;
            background: rgba(15, 23, 42, 0.72);
            backdrop-filter: blur(8px);
            box-shadow: 0 22px 50px rgba(0, 0, 0, 0.35);
            text-align: center;
            position: relative;
            z-index: 1;
            animation: cardIn 0.85s ease;
        }

        .error-code {
            font-size: clamp(84px, 18vw, 160px);
            line-height: 1;
            margin: 0;
            letter-spacing: 2px;
            text-shadow: 0 12px 34px rgba(249, 115, 22, 0.26);
            animation: pulse 2.4s ease-in-out infinite;
        }

        .error-title {
            margin: 12px 0 8px;
            font-size: clamp(24px, 4vw, 32px);
        }

        .error-desc {
            margin: 0 auto;
            max-width: 520px;
            color: var(--text-muted);
            line-height: 1.65;
            font-size: 16px;
        }

        .error-actions {
            margin-top: 24px;
            display: flex;
            justify-content: center;
            gap: 10px;
            flex-wrap: wrap;
        }

        .home-btn,
        .back-btn {
            border: none;
            border-radius: 12px;
            padding: 11px 16px;
            text-decoration: none;
            font-weight: 600;
            font-size: 14px;
            transition: transform 0.2s ease, opacity 0.2s ease, background 0.2s ease;
        }

        .home-btn {
            background: var(--accent);
            color: #fff;
        }

        .back-btn {
            background: rgba(148, 163, 184, 0.18);
            color: var(--text-main);
        }

        .home-btn:hover,
        .back-btn:hover {
            transform: translateY(-2px);
            opacity: 0.95;
        }

        .countdown {
            margin-top: 16px;
            font-size: 14px;
            color: #94a3b8;
        }

        .countdown strong {
            color: #fff;
        }

        @keyframes cardIn {
            from {
                transform: translateY(22px) scale(0.98);
                opacity: 0;
            }

            to {
                transform: translateY(0) scale(1);
                opacity: 1;
            }
        }

        @keyframes pulse {

            0%,
            100% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.03);
            }
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(18px);
            }
        }
    </style>
</head>

<body>
    <div class="glow one"></div>
    <div class="glow two"></div>

    <main class="error-card">
        <h1 class="error-code">404</h1>
        <h2 class="error-title">Trang không tồn tại</h2>
        <p class="error-desc">
            Liên kết bạn truy cập có thể đã bị đổi hoặc xóa. Bạn sẽ được tự động chuyển về trang chủ sau
            <strong id="countNum">8</strong> giây.
        </p>

        <div class="error-actions">
            <a href="/" class="home-btn">Về trang chủ ngay</a>
            <a href="javascript:history.back()" class="back-btn">Quay lại trang trước</a>
        </div>

        <p class="countdown">Tự động chuyển hướng sau <strong id="countNumFooter">8</strong> giây...</p>
    </main>

    <script>
        (function() {
            let seconds = 8;
            const counterTop = document.getElementById('countNum');
            const counterBottom = document.getElementById('countNumFooter');

            const timer = setInterval(function() {
                seconds -= 1;
                if (counterTop) counterTop.textContent = seconds;
                if (counterBottom) counterBottom.textContent = seconds;

                if (seconds <= 0) {
                    clearInterval(timer);
                    window.location.href = '/';
                }
            }, 1000);
        })();
    </script>
</body>

</html>
