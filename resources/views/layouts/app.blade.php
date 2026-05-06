<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Social Garage @yield('title', '')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=DM+Sans:wght@300;400;500;600&family=Space+Mono:wght@400;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        :root {
            --black: #0a0a0a;
            --white: #f5f0e8;
            --cream: #ede8dc;
            --orange: #e8521a;
            --orange-dark: #c0421200;
            --gray: #2a2a2a;
            --gray-mid: #555;
            --gray-light: #999;
            --border: #2a2a2a;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            background: var(--black);
            color: var(--white);
            font-family: 'DM Sans', sans-serif;
            font-size: 15px;
            line-height: 1.6;
            min-height: 100vh;
        }

        /* NAV */
        nav {
            position: sticky;
            top: 0;
            z-index: 100;
            background: var(--black);
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 2rem;
            height: 56px;
        }

        .nav-logo {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 1.6rem;
            letter-spacing: 2px;
            color: var(--white);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .nav-logo span {
            color: var(--orange);
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 0.25rem;
            list-style: none;
        }

        .nav-links a {
            color: var(--gray-light);
            text-decoration: none;
            font-size: 0.85rem;
            font-weight: 500;
            letter-spacing: 0.5px;
            padding: 6px 14px;
            border-radius: 4px;
            transition: color 0.15s, background 0.15s;
        }

        .nav-links a:hover { color: var(--white); background: var(--gray); }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 8px 18px;
            border-radius: 4px;
            font-family: 'DM Sans', sans-serif;
            font-size: 0.85rem;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            border: none;
            transition: all 0.15s;
            letter-spacing: 0.3px;
        }

        .btn-primary {
            background: var(--orange);
            color: var(--white);
        }

        .btn-primary:hover { background: #d44718; }

        .btn-ghost {
            background: transparent;
            color: var(--gray-light);
            border: 1px solid var(--border);
        }

        .btn-ghost:hover { color: var(--white); border-color: #555; }

        .btn-danger {
            background: transparent;
            color: #e05555;
            border: 1px solid #3a2020;
        }

        .btn-danger:hover { background: #3a2020; }

        .btn-sm { padding: 5px 12px; font-size: 0.8rem; }

        /* LAYOUT */
        .container {
            max-width: 960px;
            margin: 0 auto;
            padding: 0 1.5rem;
        }

        .page-content {
            padding: 2rem 0;
        }

        /* CARDS */
        .card {
            background: var(--gray);
            border: 1px solid var(--border);
            border-radius: 6px;
            overflow: hidden;
        }

        /* FORMS */
        input, textarea, select {
            width: 100%;
            background: #111;
            border: 1px solid var(--border);
            border-radius: 4px;
            color: var(--white);
            font-family: 'DM Sans', sans-serif;
            font-size: 0.9rem;
            padding: 10px 14px;
            transition: border-color 0.15s;
            outline: none;
        }

        input:focus, textarea:focus, select:focus {
            border-color: var(--orange);
        }

        input::placeholder, textarea::placeholder {
            color: #555;
        }

        label {
            display: block;
            font-size: 0.8rem;
            font-weight: 600;
            letter-spacing: 0.8px;
            text-transform: uppercase;
            color: var(--gray-light);
            margin-bottom: 6px;
        }

        .form-group { margin-bottom: 1.25rem; }

        .form-error {
            color: #e05555;
            font-size: 0.8rem;
            margin-top: 4px;
        }

        /* ALERTS */
        .alert {
            padding: 12px 16px;
            border-radius: 4px;
            font-size: 0.875rem;
            margin-bottom: 1.5rem;
        }

        .alert-success { background: #0f2a1a; border: 1px solid #1a4a2a; color: #4ade80; }
        .alert-error { background: #2a0f0f; border: 1px solid #4a1a1a; color: #f87171; }

        /* TAGS */
        .tag {
            display: inline-block;
            background: #1a1a1a;
            border: 1px solid var(--border);
            color: var(--gray-light);
            font-size: 0.72rem;
            font-family: 'Space Mono', monospace;
            letter-spacing: 0.5px;
            padding: 2px 8px;
            border-radius: 2px;
        }

        .tag-orange {
            background: rgba(232, 82, 26, 0.1);
            border-color: rgba(232, 82, 26, 0.3);
            color: var(--orange);
        }

        /* DIVIDER */
        hr { border: none; border-top: 1px solid var(--border); margin: 1.5rem 0; }

        /* USER AVATAR */
        .avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: var(--orange);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-family: 'Space Mono', monospace;
            font-size: 0.75rem;
            font-weight: 700;
            color: white;
            flex-shrink: 0;
            text-transform: uppercase;
        }

        .avatar-sm {
            width: 28px;
            height: 28px;
            font-size: 0.65rem;
        }

        /* DROPDOWN */
        .dropdown { position: relative; }

        .dropdown-menu {
            position: absolute;
            right: 0;
            top: calc(100% + 8px);
            background: #1a1a1a;
            border: 1px solid var(--border);
            border-radius: 6px;
            min-width: 180px;
            display: none;
            z-index: 200;
            overflow: hidden;
        }

        .dropdown:hover .dropdown-menu, .dropdown.open .dropdown-menu { display: block; }

        .dropdown-menu a, .dropdown-menu button {
            display: block;
            width: 100%;
            padding: 10px 16px;
            text-align: left;
            background: none;
            border: none;
            color: var(--gray-light);
            font-family: 'DM Sans', sans-serif;
            font-size: 0.85rem;
            cursor: pointer;
            text-decoration: none;
            transition: background 0.1s, color 0.1s;
        }

        .dropdown-menu a:hover, .dropdown-menu button:hover {
            background: var(--gray);
            color: var(--white);
        }

        .dropdown-divider { border-top: 1px solid var(--border); }

        /* MODAL */
        .modal-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.7);
            z-index: 500;
            align-items: center;
            justify-content: center;
        }

        .modal-overlay.open { display: flex; }

        .modal {
            background: #1a1a1a;
            border: 1px solid var(--border);
            border-radius: 8px;
            padding: 1.5rem;
            width: 100%;
            max-width: 440px;
            margin: 1rem;
        }

        .modal-title {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 1.3rem;
            letter-spacing: 1px;
            margin-bottom: 1rem;
        }

        /* EMPTY STATE */
        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
            color: var(--gray-light);
        }

        .empty-state-icon {
            font-size: 3rem;
            display: block;
            margin-bottom: 1rem;
            opacity: 0.4;
        }

        .empty-state h3 {
            font-family: 'Bebas Neue', sans-serif;
            font-size: 1.4rem;
            letter-spacing: 1px;
            color: #555;
            margin-bottom: 0.5rem;
        }
    </style>
</head>
<body>

<nav>
    <a href="{{ route('cotxes.index') }}" class="nav-logo">
        Social<span>Garage</span>
    </a>

    <ul class="nav-links">
        @auth
            <li><a href="{{ route('cotxes.index') }}">Feed</a></li>
            <li><a href="{{ route('cotxes.create') }}">+ Nou Cotxe</a></li>
            <li class="dropdown">
                <a href="#" style="display:flex;align-items:center;gap:8px;">
                    <div class="avatar avatar-sm">{{ substr(Auth::user()->name, 0, 2) }}</div>
                    {{ Auth::user()->name }}
                </a>
                <div class="dropdown-menu">
                    <div class="dropdown-divider"></div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit">Tancar sessió</button>
                    </form>
                </div>
            </li>
        @else
            <li><a href="{{ route('login') }}">Iniciar sessió</a></li>
            <li>
                <a href="{{ route('register') }}" class="btn btn-primary btn-sm">Registrar-se</a>
            </li>
        @endauth
    </ul>
</nav>

<div class="container page-content">
    @if(session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
    @endif

    @if($errors->any())
        <div class="alert alert-error">
            @foreach($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif

    @yield('content')
</div>

<script>
    document.querySelectorAll('.dropdown').forEach(d => {
        d.querySelector('a').addEventListener('click', e => {
            if(d.querySelector('.dropdown-menu')) {
                e.preventDefault();
                d.classList.toggle('open');
            }
        });
    });

    document.addEventListener('click', e => {
        if(!e.target.closest('.dropdown')) {
            document.querySelectorAll('.dropdown').forEach(d => d.classList.remove('open'));
        }
    });

    window.openModal = id => document.getElementById(id).classList.add('open');
    window.closeModal = id => document.getElementById(id).classList.remove('open');

    document.querySelectorAll('.modal-overlay').forEach(m => {
        m.addEventListener('click', e => { if(e.target === m) m.classList.remove('open'); });
    });
</script>

</body>
</html> 