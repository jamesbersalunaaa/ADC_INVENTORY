<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADC Inventory Login</title>
    <link rel="icon" type="image/png" href="{{ asset('img/logo.png') }}">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Segoe UI", Arial, sans-serif;
        }

        body {
            min-height: 100vh;
            background: #f3f6f1;
            display: flex;
            overflow-x: hidden;
            color: #111827;
        }

        /* LOADING SCREEN */
        #pageLoader {
            position: fixed;
            inset: 0;
            background: #111827;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 9999;
            transition: opacity 0.5s ease, visibility 0.5s ease;
        }

        #pageLoader.hide {
            opacity: 0;
            visibility: hidden;
        }

        .loader-content {
            text-align: center;
            color: white;
        }

        .loader-content img {
            width: 120px;
            margin-bottom: 18px;
        }

        .loader-circle {
            width: 42px;
            height: 42px;
            border: 4px solid rgba(255,255,255,0.2);
            border-top: 4px solid #8aff5c;
            border-radius: 50%;
            margin: 0 auto;
            animation: spin 0.9s linear infinite;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        .left-panel {
            width: 45%;
            min-height: 100vh;
            position: relative;
            overflow: hidden;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 50px;
            clip-path: polygon(0 0, 100% 0, 90% 100%, 0 100%);
        }

        .left-panel::before,
        .left-panel::after {
            content: "";
            position: absolute;
            inset: 0;
            background-size: cover;
            background-position: center;
            animation-duration: 18s;
            animation-timing-function: ease-in-out;
            animation-iteration-count: infinite;
            z-index: 0;
        }

        .left-panel::before {
            background-image:
                linear-gradient(rgba(17, 24, 39, 0.88), rgba(17, 24, 39, 0.94)),
                url("https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?auto=format&fit=crop&w=1200&q=80");
            animation-name: fadeOne;
        }

        .left-panel::after {
            background-image:
                linear-gradient(rgba(17, 24, 39, 0.88), rgba(17, 24, 39, 0.94)),
                url("https://images.unsplash.com/photo-1553413077-190dd305871c?auto=format&fit=crop&w=1200&q=80");
            animation-name: fadeTwo;
        }

        @keyframes fadeOne {
            0% {
                opacity: 1;
                transform: scale(1);
            }

            45% {
                opacity: 1;
                transform: scale(1.08);
            }

            55% {
                opacity: 0;
                transform: scale(1.1);
            }

            100% {
                opacity: 0;
                transform: scale(1.12);
            }
        }

        @keyframes fadeTwo {
            0% {
                opacity: 0;
                transform: scale(1.12);
            }

            45% {
                opacity: 0;
                transform: scale(1.1);
            }

            55% {
                opacity: 1;
                transform: scale(1.08);
            }

            100% {
                opacity: 1;
                transform: scale(1);
            }
        }

        .brand-box {
            width: 100%;
            text-align: center;
            position: relative;
            z-index: 2;
            animation: fadeUp 0.8s ease;
        }

        .brand-box img {
            width: 360px;
            max-width: 100%;
            margin-bottom: 20px;
        }

        .brand-box h2 {
            font-size: 21px;
            letter-spacing: 2px;
            font-weight: 600;
            margin-bottom: 55px;
            color: #f9fafb;
        }

        .features {
            display: flex;
            justify-content: center;
            gap: 28px;
            flex-wrap: wrap;
        }

        .feature {
            width: 120px;
            padding: 18px 12px;
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(138, 255, 92, 0.3);
            border-radius: 16px;
            backdrop-filter: blur(10px);
            text-align: center;
        }

        .feature-icon {
            width: 48px;
            height: 48px;
            border: 1.5px solid #8aff5c;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 12px;
            color: #8aff5c;
        }

        .feature-icon svg {
            width: 23px;
            height: 23px;
        }

        .feature p {
            font-size: 13px;
            line-height: 1.4;
            color: #e5e7eb;
        }

        .right-panel {
            width: 55%;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 45px;
            background:
                radial-gradient(circle at top right, rgba(138, 255, 92, 0.18), transparent 35%),
                #f3f6f1;
        }

        .login-wrapper {
            width: 100%;
            max-width: 520px;
            animation: fadeUp 0.8s ease;
        }

        .login-card {
            background: rgba(255, 255, 255, 0.78);
            backdrop-filter: blur(18px);
            -webkit-backdrop-filter: blur(18px);
            padding: 45px;
            border-radius: 24px;
            box-shadow: 0 20px 55px rgba(17, 24, 39, 0.16);
            border: 1px solid rgba(255, 255, 255, 0.7);
        }

        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(18px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .login-header {
            text-align: center;
            margin-bottom: 32px;
        }

        .login-header .small-logo {
            width: 80px;
            height: 80px;
            object-fit: contain;
            margin-bottom: 16px;
        }

        .login-card h1 {
            font-size: 32px;
            color: #111827;
            margin-bottom: 8px;
            font-weight: 800;
        }

        .login-card h1 span {
            color: #54c52f;
        }

        .subtitle {
            color: #6b7280;
            font-size: 15px;
        }

        .divider {
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 26px 0;
            color: #54c52f;
        }

        .divider::before,
        .divider::after {
            content: "";
            flex: 1;
            height: 1px;
            background: #d9efd2;
        }

        .divider-icon {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            background: #f4fff0;
            border: 1px solid #d9efd2;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 14px;
        }

        .divider-icon svg {
            width: 20px;
            height: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-size: 14px;
            font-weight: 700;
            color: #374151;
            margin-bottom: 8px;
        }

        .input-box {
            display: flex;
            align-items: center;
            border: 1px solid #d7eacb;
            border-radius: 12px;
            overflow: hidden;
            background: rgba(255, 255, 255, 0.85);
            transition: 0.2s ease;
        }

        .input-box:focus-within {
            border-color: #65d83b;
            box-shadow: 0 0 0 4px rgba(101, 216, 59, 0.14);
            background: white;
        }

        .input-icon {
            width: 56px;
            color: #54c52f;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .input-icon svg {
            width: 21px;
            height: 21px;
        }

        .input-box input {
            width: 100%;
            padding: 15px 14px;
            border: none;
            outline: none;
            font-size: 15px;
            color: #111827;
            background: transparent;
        }

        .input-box input::placeholder {
            color: #9ca3af;
        }

        .password-box {
            position: relative;
        }

        .password-box input {
            padding-right: 48px;
        }

        .toggle-password {
            position: absolute;
            right: 14px;
            top: 50%;
            transform: translateY(-50%);
            width: 34px;
            height: 34px;
            border: none;
            background: transparent;
            color: #6b7280;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .toggle-password:hover {
            color: #45b91d;
        }

        .toggle-password svg {
            width: 20px;
            height: 20px;
        }

        .options {
            display: flex;
            justify-content: flex-start;
            align-items: center;
            margin: 22px 0 28px;
            font-size: 14px;
        }

        .remember {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #4b5563;
        }

        .remember input {
            accent-color: #54c52f;
        }

        .login-btn {
            width: 100%;
            padding: 16px;
            background: linear-gradient(135deg, #80ef55, #43bd20);
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 800;
            cursor: pointer;
            box-shadow: 0 10px 22px rgba(80, 200, 40, 0.32);
            transition: 0.2s ease;
            letter-spacing: 0.5px;
        }

        .login-btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 13px 26px rgba(80, 200, 40, 0.4);
        }

        .login-btn:active {
            transform: translateY(0);
        }

        .error-message {
            margin-top: 16px;
            padding: 12px 14px;
            border-radius: 10px;
            background: #fee2e2;
            color: #991b1b;
            font-size: 14px;
            font-weight: 600;
            border: 1px solid #fecaca;
        }

        .footer {
            text-align: center;
            color: #6b7280;
            margin-top: 25px;
            font-size: 13px;
            line-height: 1.6;
        }

        @media (max-width: 1100px) {
            .left-panel {
                padding: 35px;
            }

            .brand-box img {
                width: 300px;
            }

            .brand-box h2 {
                font-size: 18px;
            }

            .login-card {
                padding: 38px 32px;
            }
        }

        @media (max-width: 900px) {
            body {
                flex-direction: column;
                overflow-y: auto;
            }

            .left-panel,
            .right-panel {
                width: 100%;
                min-height: auto;
            }

            .left-panel {
                padding: 38px 20px;
                clip-path: none;
            }

            .brand-box img {
                width: 240px;
            }

            .brand-box h2 {
                margin-bottom: 28px;
                font-size: 16px;
            }

            .features {
                gap: 15px;
            }

            .feature {
                width: 105px;
                padding: 14px 10px;
            }

            .right-panel {
                padding: 28px 16px;
            }
        }

        @media (max-width: 600px) {
            .login-card {
                padding: 30px 22px;
                border-radius: 18px;
            }

            .login-card h1 {
                font-size: 27px;
            }

            .login-header .small-logo {
                width: 68px;
                height: 68px;
            }

            .subtitle {
                font-size: 14px;
            }

            .feature {
                width: 95px;
            }

            .feature p {
                font-size: 12px;
            }

            .feature-icon {
                width: 43px;
                height: 43px;
            }

            .input-icon {
                width: 48px;
            }

            .input-box input {
                padding: 14px 12px;
                font-size: 14px;
            }
        }
    </style>
</head>

<body>

    <div id="pageLoader">
        <div class="loader-content">
            <img src="{{ asset('img/logo.png') }}" alt="ADC Logo">
            <div class="loader-circle"></div>
        </div>
    </div>

    <div class="left-panel">
        <div class="brand-box">
            <img src="{{ asset('img/logo.png') }}" alt="ADC General Merchandise Logo">

            <h2>INVENTORY MANAGEMENT SYSTEM</h2>

            <div class="features">
                <div class="feature">
                    <div class="feature-icon">
                        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path>
                            <path d="M3.27 6.96 12 12.01l8.73-5.05"></path>
                            <path d="M12 22.08V12"></path>
                        </svg>
                    </div>
                    <p>Manage<br>Inventory</p>
                </div>

                <div class="feature">
                    <div class="feature-icon">
                        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M9 11l3 3L22 4"></path>
                            <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path>
                        </svg>
                    </div>
                    <p>Track<br>Stock</p>
                </div>

                <div class="feature">
                    <div class="feature-icon">
                        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M3 3v18h18"></path>
                            <path d="M7 15l4-4 3 3 5-7"></path>
                        </svg>
                    </div>
                    <p>Generate<br>Reports</p>
                </div>
            </div>
        </div>
    </div>

    <div class="right-panel">
        <div class="login-wrapper">
            <div class="login-card">
                <div class="login-header">
                    <img class="small-logo" src="{{ asset('img/logo.png') }}" alt="ADC Logo">
                    <h1>Welcome <span>Back</span></h1>
                    <p class="subtitle">Sign in to continue to your account</p>
                </div>

                <div class="divider">
                    <div class="divider-icon">
                        <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M12 15v2"></path>
                            <path d="M6 11V8a6 6 0 0 1 12 0v3"></path>
                            <rect x="4" y="11" width="16" height="10" rx="2"></rect>
                        </svg>
                    </div>
                </div>

                <form method="POST" action="/login">
                    @csrf

                    <div class="form-group">
                        <label>Email Address</label>
                        <div class="input-box">
                            <div class="input-icon">
                                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path d="M4 4h16v16H4z"></path>
                                    <path d="m22 6-10 7L2 6"></path>
                                </svg>
                            </div>
                            <input type="email" name="email" placeholder="Enter your email" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Password</label>
                        <div class="input-box password-box">
                            <div class="input-icon">
                                <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <rect x="3" y="11" width="18" height="11" rx="2"></rect>
                                    <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                                </svg>
                            </div>

                            <input type="password" id="password" name="password" placeholder="Enter your password" required>

                            <button type="button" class="toggle-password" onclick="togglePassword()" aria-label="Show or hide password">
                                <svg id="eyeIcon" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7S1 12 1 12z"></path>
                                    <circle cx="12" cy="12" r="3"></circle>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <div class="options">
                        <label class="remember">
                            <input type="checkbox" name="remember">
                            Remember me
                        </label>
                    </div>

                    <button type="submit" class="login-btn">LOGIN</button>

                    @if(session('error'))
                        <div class="error-message">
                            {{ session('error') }}
                        </div>
                    @endif
                </form>
            </div>

            <div class="footer">
                © 2026 ADC General Merchandise Inc.<br>
                All rights reserved.
            </div>
        </div>
    </div>

    <script>
        window.addEventListener("load", function () {
            const loader = document.getElementById("pageLoader");

            setTimeout(function () {
                loader.classList.add("hide");
            }, 700);
        });

        function togglePassword() {
            const password = document.getElementById("password");
            const eyeIcon = document.getElementById("eyeIcon");

            if (password.type === "password") {
                password.type = "text";

                eyeIcon.innerHTML = `
                    <path d="M17.94 17.94A10.94 10.94 0 0 1 12 20C5 20 1 12 1 12a21.77 21.77 0 0 1 5.06-5.94"></path>
                    <path d="M9.9 4.24A10.45 10.45 0 0 1 12 4c7 0 11 8 11 8a21.69 21.69 0 0 1-3.22 4.31"></path>
                    <path d="M14.12 14.12A3 3 0 0 1 9.88 9.88"></path>
                    <path d="M1 1l22 22"></path>
                `;
            } else {
                password.type = "password";

                eyeIcon.innerHTML = `
                    <path d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7S1 12 1 12z"></path>
                    <circle cx="12" cy="12" r="3"></circle>
                `;
            }
        }
    </script>

</body>
</html>