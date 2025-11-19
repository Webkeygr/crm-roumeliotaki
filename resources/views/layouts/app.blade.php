<!doctype html>
<html lang="el">
<head>
    <meta charset="utf-8">
    <title>@yield('title', 'Roumeliotaki CRM')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Bootstrap 5 (CDN) --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Icons --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background-color: #0b1020;
            color: #e9edf5;
            font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
        }

        .sidebar {
            min-height: 100vh;
            background: radial-gradient(circle at top left, #1b2440 0, #050814 60%);
            border-right: 1px solid rgba(255, 255, 255, 0.05);
        }

        .sidebar .nav-link {
            color: #9ea9d5;
            font-weight: 500;
            border-radius: 0.65rem;
            padding: 0.55rem 0.9rem;
            display: flex;
            align-items: center;
            gap: 0.55rem;
        }

        .sidebar .nav-link:hover {
            background: rgba(252, 236, 69, 0.12);
            color: #fcec45;
        }

        .sidebar .nav-link.active {
            background: linear-gradient(90deg, #fcec45, #f9d349);
            color: #111321;
            box-shadow: 0 0 18px rgba(252, 236, 69, 0.4);
        }

        .sidebar .nav-link.active i {
            color: #111321;
        }

        .brand-key {
            width: 34px;
            height: 34px;
            border-radius: 10px;
            background: radial-gradient(circle at 20% 0, #fcec45 0, #f9af3c 45%, #111321 80%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #111321;
            font-weight: 800;
            font-size: 18px;
            box-shadow: 0 0 25px rgba(252, 236, 69, 0.55);
        }

        .main-wrapper {
            min-height: 100vh;
        }

        .topbar {
            backdrop-filter: blur(16px);
            background: linear-gradient(90deg, rgba(11, 16, 32, 0.92), rgba(11, 16, 32, 0.8));
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }

        .page-title {
            font-size: 1.3rem;
            font-weight: 600;
        }

        .badge-soft {
            border-radius: 999px;
            padding: 0.25rem 0.75rem;
            font-size: 0.75rem;
            background-color: rgba(252, 236, 69, 0.16);
            color: #fcec45;
        }

        .card-glass {
            background: radial-gradient(circle at top left, #151b33 0, #050815 60%);
            border-radius: 1.25rem;
            border: 1px solid rgba(255, 255, 255, 0.06);
            box-shadow: 0 18px 60px rgba(0, 0, 0, 0.65);
        }

        .table-dark-custom {
            --bs-table-bg: transparent;
            --bs-table-striped-bg: rgba(255, 255, 255, 0.02);
            --bs-table-striped-color: #e9edf5;
            --bs-table-hover-bg: rgba(252, 236, 69, 0.04);
            --bs-table-hover-color: #ffffff;
        }

        .btn-key {
            background: linear-gradient(135deg, #fcec45, #f9d349);
            border: none;
            border-radius: 999px;
            padding-inline: 1.2rem;
            color: #111321;
            font-weight: 600;
            box-shadow: 0 12px 30px rgba(252, 236, 69, 0.45);
        }

        .btn-key:hover {
            background: linear-gradient(135deg, #ffe45f, #f6c935);
            color: #111321;
        }

        .form-control,
        .form-select {
            border-radius: 0.7rem;
            background-color: rgba(4, 10, 26, 0.85);
            border: 1px solid rgba(255, 255, 255, 0.08);
            color: #e9edf5;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #fcec45;
            box-shadow: 0 0 0 0.2rem rgba(252, 236, 69, 0.25);
            background-color: #050815;
            color: #ffffff;
        }

        .text-muted-soft {
            color: #858fb5 !important;
        }

        @media (max-width: 991.98px) {
            .sidebar {
                min-height: auto;
            }
        }
    </style>

    @stack('styles')
</head>
<body>
<div class="container-fluid">
    <div class="row main-wrapper">
        {{-- Sidebar --}}
        <nav class="col-12 col-md-3 col-lg-2 sidebar py-3 px-3 px-lg-3">
            <div class="d-flex align-items-center justify-content-between mb-4">
                <div class="d-flex align-items-center gap-3">
                    <div class="brand-key">
                        <span>K</span>
                    </div>
                    <div>
                        <div class="fw-semibold text-white">Roumeliotaki CRM</div>
                        <div class="small text-muted-soft">Το κλειδί στις σχέσεις πελατών</div>
                    </div>
                </div>
            </div>

            <hr class="border-secondary border-opacity-25">

            <div class="nav flex-column gap-1 mt-3">
                <a href="{{ route('customers.index') }}"
                   class="nav-link {{ request()->routeIs('customers.*') ? 'active' : '' }}">
                    <i class="bi bi-people-fill"></i>
                    <span>Πελάτες</span>
                </a>

                {{-- Μελλοντικά: Εταιρίες, Συμβόλαια, Ραντεβού κτλ. --}}
                <a href="#" class="nav-link disabled">
                    <i class="bi bi-building"></i>
                    <span>Εταιρίες (soon)</span>
                </a>
                <a href="#" class="nav-link disabled">
                    <i class="bi bi-file-earmark-text"></i>
                    <span>Συμβόλαια (soon)</span>
                </a>
                <a href="#" class="nav-link disabled">
                    <i class="bi bi-calendar-event"></i>
                    <span>Ραντεβού (soon)</span>
                </a>
            </div>

            <div class="mt-auto pt-4 small text-muted-soft d-none d-md-block">
                <div>Made for <strong>Roumeliotaki Insurance</strong></div>
                <div>by Webkey</div>
            </div>
        </nav>

        {{-- Main content --}}
        <main class="col-12 col-md-9 col-lg-10 px-0 d-flex flex-column">
            {{-- Topbar --}}
            <header class="topbar py-3 px-3 px-md-4 d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center gap-2">
                    <div class="page-title">@yield('page-title', 'Πίνακας Ελέγχου')</div>
                    <span class="badge-soft d-none d-sm-inline-flex">
                        v1 · Internal CRM
                    </span>
                </div>

                <div class="d-flex align-items-center gap-3">
                    <span class="small text-muted-soft d-none d-sm-inline">Συνδεδεμένος χρήστης</span>
                    <div class="rounded-circle bg-light text-dark d-flex align-items-center justify-content-center"
                         style="width:34px;height:34px;">
                        <i class="bi bi-person-fill"></i>
                    </div>
                </div>
            </header>

            {{-- Content --}}
            <section class="flex-fill py-3 py-md-4 px-3 px-md-4">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                    </div>
                @endif

                @yield('content')
            </section>
        </main>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>
