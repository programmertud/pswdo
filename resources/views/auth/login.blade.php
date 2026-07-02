<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login – PSWDO Surigao del Norte</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Plus+Jakarta+Sans:wght@600;700;800&display=swap" rel="stylesheet">

    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --navy:      #0f2d5e;
            --navy-dark: #091e42;
            --navy-mid:  #1a3a6e;
            --gold:      #f5a623;
            --gold-lt:   #fdb940;
            --bg:        #f0f4f9;
            --white:     #ffffff;
            --text:      #000000;
            --muted:     #000000;
            --border:    #e2e8f0;
            --red:       #dc2626;
        }

        html, body {
            height: 100%;
            font-family: 'Inter', sans-serif;
            background: var(--bg);
            color: var(--text);
        }

        .login-shell {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #091e42 0%, #0f2d5e 40%, #0d9488 100%);
            padding: 24px;
            position: relative;
            overflow: hidden;
        }

        /* Decorative circles */
        .login-shell::before,
        .login-shell::after {
            content: '';
            position: absolute;
            border-radius: 50%;
            opacity: .08;
        }
        .login-shell::before {
            width: 500px; height: 500px;
            background: var(--gold);
            top: -150px; right: -100px;
        }
        .login-shell::after {
            width: 350px; height: 350px;
            background: #fff;
            bottom: -120px; left: -80px;
        }

        .login-card {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(4px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 20px;
            box-shadow: 0 25px 60px rgba(0,0,0,.25);
            width: 100%;
            max-width: 420px;
            overflow: hidden;
            position: relative;
            z-index: 1;
        }

        /* Card header */
        .card-header {
            background: rgba(9, 30, 66, 0.4);
            padding: 36px 32px 28px;
            text-align: center;
        }
        .card-header .logo-wrap {
            display: flex;
            justify-content: center;
            margin-bottom: 16px;
        }
        .card-header .logo-wrap img {
            width: 90px;
            height: 90px;
            object-fit: contain;
            border-radius: 14px;
            background: rgba(255,255,255,.1);
            padding: 6px;
        }
        .card-header h1 {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 15px;
            font-weight: 800;
            color: #000;
            line-height: 1.4;
        }
        .card-header p {
            font-size: 11px;
            color: #000;
            font-weight: 600;
            margin-top: 4px;
            text-transform: uppercase;
            letter-spacing: .9px;
        }

        /* Accent strip */
        .accent-strip {
            height: 4px;
            background: linear-gradient(90deg, var(--gold), var(--gold-lt));
        }

        /* Form body */
        .card-body {
            padding: 32px;
        }
        .card-body h2 {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 18px;
            font-weight: 700;
            color: var(--text);
            margin-bottom: 6px;
        }
        .card-body .subtitle {
            font-size: 12.5px;
            color: var(--muted);
            margin-bottom: 28px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 6px;
            margin-bottom: 18px;
        }
        .form-group label {
            font-size: 12.5px;
            font-weight: 600;
            color: var(--text);
        }
        .input-wrap {
            position: relative;
        }
        .input-wrap .input-icon {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            width: 16px; height: 16px;
            color: var(--muted);
            pointer-events: none;
        }
        .form-control {
            width: 100%;
            border: 1.5px solid rgba(255, 255, 255, 0.2);
            border-radius: 10px;
            padding: 10px 12px 10px 38px;
            font-size: 13.5px;
            font-family: 'Inter', sans-serif;
            outline: none;
            transition: border-color .15s, box-shadow .15s;
            background: rgba(255, 255, 255, 0.3);
            color: var(--text);
        }
        .form-control:focus {
            border-color: var(--navy);
            box-shadow: 0 0 0 3px rgba(15,45,94,.08);
        }
        .form-control.has-error { border-color: var(--red); }

        .error-msg {
            font-size: 11.5px;
            color: var(--red);
            display: flex;
            align-items: center;
            gap: 4px;
            margin-top: 2px;
        }

        .btn-login {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            width: 100%;
            padding: 12px;
            background: var(--navy-dark);
            color: #fff;
            border: none;
            border-radius: 10px;
            font-size: 14px;
            font-weight: 600;
            font-family: 'Inter', sans-serif;
            cursor: pointer;
            transition: background .15s, transform .1s;
            margin-top: 8px;
        }
        .btn-login:hover { background: var(--navy-mid); }
        .btn-login:active { transform: scale(.98); }

        .card-footer {
            padding: 14px 32px 20px;
            text-align: center;
        }
        .card-footer p {
            font-size: 11px;
            color: var(--red);
            font-weight: 600;
        }
    </style>
</head>
<body>
<div class="login-shell">
    <div class="login-card">
        <!-- Header -->
        <div class="card-header">
            <div class="logo-wrap">
                <img src="{{ asset('logo-hri.png') }}" alt="CSWDO Logo">
            </div>
            <h1>Provincial Social Welfare<br>&amp; Development Office</h1>
            <p>Surigao del Norte · PSWDO</p>
        </div>

        <div class="accent-strip"></div>

        <!-- Form body -->
        <div class="card-body">
            <h2>Welcome back</h2>
            <p class="subtitle">Sign in to access the database system.</p>

            @if($errors->has('credentials'))
                <div style="background:#fef2f2;color:#dc2626;border:1px solid #fecaca;border-radius:8px;padding:10px 14px;font-size:13px;margin-bottom:18px;display:flex;align-items:center;gap:8px;">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                    {{ $errors->first('credentials') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login.post') }}">
                @csrf

                <div class="form-group">
                    <label for="username">Username</label>
                    <div class="input-wrap">
                        <svg class="input-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/></svg>
                        <input
                            id="username"
                            type="text"
                            name="username"
                            class="form-control {{ $errors->has('username') ? 'has-error' : '' }}"
                            value="{{ old('username') }}"
                            placeholder="Enter username"
                            autocomplete="username"
                            autofocus
                        >
                    </div>
                    @error('username')
                        <span class="error-msg">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="input-wrap">
                        <svg class="input-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0110 0v4"/></svg>
                        <input
                            id="password"
                            type="password"
                            name="password"
                            class="form-control {{ $errors->has('password') ? 'has-error' : '' }}"
                            placeholder="Enter password"
                            autocomplete="current-password"
                        >
                    </div>
                    @error('password')
                        <span class="error-msg">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit" class="btn-login">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M15 3h4a2 2 0 012 2v14a2 2 0 01-2 2h-4"/><polyline points="10 17 15 12 10 7"/><line x1="15" y1="12" x2="3" y2="12"/></svg>
                    Sign In
                </button>
            </form>
        </div>

        <div class="card-footer">
            <p>Database on Children {{ date('Y') }} &bull; Province of Surigao del Norte</p>
        </div>
    </div>
</div>
</body>
</html>
