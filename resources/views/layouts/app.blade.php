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
        background-color: #f7f1e9; /* ζεστό off-white, ίδιο feeling με το site */
        color: #344048;            /* σκούρο γκρι-μπλε για κείμενα */
        font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
    }

    .sidebar {
        min-height: 100vh;
        background: linear-gradient(180deg, #6e8f95 0%, #4f6f75 60%, #39535a 100%);
        border-right: 1px solid rgba(0, 0, 0, 0.06);
    }

    .sidebar .nav-link {
        color: #dde6ea;
        font-weight: 500;
        border-radius: 0.65rem;
        padding: 0.55rem 0.9rem;
        display: flex;
        align-items: center;
        gap: 0.55rem;
        transition: background-color 0.18s ease, color 0.18s ease, box-shadow 0.18s ease;
    }

    .sidebar .nav-link:hover {
        background: rgba(255, 255, 255, 0.09);
        color: #ffffff;
    }

    .sidebar .nav-link.active {
        background: linear-gradient(90deg, #f3d8b5 0%, #e3b278 100%);
        color: #3c4a4f;
        box-shadow: 0 0 18px rgba(227, 178, 120, 0.55);
    }

    .sidebar .nav-link.active i {
        color: #334047;
    }

    .brand-key {
        width: 34px;
        height: 34px;
        border-radius: 10px;
        background: radial-gradient(circle at 20% 0, #f3d8b5 0, #e49a6b 45%, #2f4248 80%);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #28333a;
        font-weight: 800;
        font-size: 18px;
        box-shadow: 0 0 20px rgba(227, 178, 120, 0.65);
    }

    .main-wrapper {
        min-height: 100vh;
    }

    .topbar {
        backdrop-filter: blur(16px);
        background: linear-gradient(90deg, rgba(247, 241, 233, 0.96), rgba(245, 237, 227, 0.96));
        border-bottom: 1px solid rgba(0, 0, 0, 0.06);

         position: sticky;
    top: 0;
    z-index: 1030;
    }

    .page-title {
        font-size: 1.3rem;
        font-weight: 600;
    }

    .badge-soft {
        border-radius: 999px;
        padding: 0.25rem 0.75rem;
        font-size: 0.75rem;
        background-color: rgba(227, 178, 120, 0.18);
        color: #c5864a;
    }

    .card-glass {
        background: radial-gradient(circle at top left, #ffffff 0, #f3e8dc 55%);
        border-radius: 1.25rem;
        border: 1px solid rgba(0, 0, 0, 0.05);
        box-shadow: 0 18px 50px rgba(0, 0, 0, 0.06);
    }

    .table-dark-custom {
        --bs-table-bg: transparent;
        --bs-table-striped-bg: rgba(248, 241, 232, 0.9);
        --bs-table-striped-color: #344048;
        --bs-table-hover-bg: rgba(227, 178, 120, 0.12);
        --bs-table-hover-color: #222b30;
    }

    .btn-key {
        background: linear-gradient(135deg, #6e8f95, #4f6f75);
        border: none;
        border-radius: 999px;
        padding-inline: 1.2rem;
        color: #fdfdfd;
        font-weight: 600;
        box-shadow: 0 10px 25px rgba(79, 111, 117, 0.35);
        transition: background 0.18s ease, box-shadow 0.18s ease, color 0.18s ease;
    }

    .btn-key:hover {
        background: linear-gradient(135deg, #e49a6b, #f3d8b5);
        color: #2d363a;
        box-shadow: 0 10px 24px rgba(228, 154, 107, 0.45);
    }

    .form-control,
    .form-select {
        border-radius: 0.7rem;
        background-color: #ffffff;
        border: 1px solid #d7c8b8;
        color: #344048;
    }

    .form-control::placeholder,
    .form-select::placeholder {
        color: #a4aeb4;
    }

    /* Σκούρο κείμενο στο main content */
main {
    color: #111111;
}

main .table,
main .table th,
main .table td {
    color: #111111;
}


    .form-control:focus,
    .form-select:focus {
        border-color: #e49a6b;
        box-shadow: 0 0 0 0.18rem rgba(228, 154, 107, 0.25);
        background-color: #ffffff;
        color: #344048;
    }

    .text-muted-soft {
        color: #8c9aa0 !important;
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
        <nav class="col-12 col-md-3 col-lg-2 sidebar py-3 px-3 px-lg-3 d-none d-md-block">
<div class="d-flex align-items-center justify-content-between mb-4">
    {{-- Όλο το brand είναι link στην "αρχική" --}}
    <a href="{{ route('customers.index') }}"
       class="d-flex align-items-center gap-3 text-decoration-none">
        <div class="brand-key">
            <span>RI</span>
        </div>
        <div>
            <div class="fw-semibold text-white">Roumeliotaki CRM</div>
            <div class="small text-muted-soft">Το κλειδί στις σχέσεις πελατών</div>
        </div>
    </a>
</div>

            <hr class="border-secondary border-opacity-25">

            <div class="nav flex-column gap-1 mt-3">
                <a href="{{ route('customers.index') }}"
                   class="nav-link {{ request()->routeIs('customers.*') ? 'active' : '' }}">
                    <i class="bi bi-people-fill"></i>
                    <span>Πελάτες</span>
                </a>

                {{-- Μελλοντικά: Εταιρίες, Συμβόλαια, Ραντεβού κτλ. --}}
                <a href="{{ route('companies.index') }}"
                 class="nav-link {{ request()->routeIs('companies.*') ? 'active' : '' }}">
                <i class="bi bi-building"></i>
                <span>Εταιρίες</span>
                </a>

                <a href="#" class="nav-link disabled">
                    <i class="bi bi-file-earmark-text"></i>
                    <span>Συμβόλαια (soon)</span>
                </a>
                <a href="{{ route('appointments.index') }}"
   class="nav-link {{ request()->routeIs('appointments.*') ? 'active' : '' }}">
    <i class="bi bi-calendar-event"></i>
    <span>Ραντεβού</span>
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
                    {{-- HAMBURGER μόνο σε mobile --}}
    <button class="btn btn-outline-light d-inline-flex d-md-none"
            type="button"
            data-bs-toggle="offcanvas"
            data-bs-target="#mobileMenu"
            aria-controls="mobileMenu">
        <i class="bi bi-list"></i>
    </button>
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
{{-- Offcanvas menu για mobile --}}
<div class="offcanvas offcanvas-end bg-dark text-white" tabindex="-1" id="mobileMenu">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title">Μενού</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"
                aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <nav class="nav flex-column gap-2">
            <a href="{{ route('customers.index') }}"
               class="nav-link text-white {{ request()->routeIs('customers.*') ? 'fw-bold' : '' }}">
                <i class="bi bi-people-fill me-2"></i> Πελάτες
            </a>
            <a href="{{ route('companies.index') }}"
               class="nav-link text-white {{ request()->routeIs('companies.*') ? 'fw-bold' : '' }}">
                <i class="bi bi-building me-2"></i> Εταιρίες
            </a>
            <a href="#" class="nav-link text-secondary">
                <i class="bi bi-file-earmark-text me-2"></i> Συμβόλαια (soon)
            </a>
            <a href="{{ route('appointments.index') }}"
               class="nav-link text-white {{ request()->routeIs('appointments.*') ? 'fw-bold' : '' }}">
                <i class="bi bi-calendar-event me-2"></i> Ραντεβού
            </a>
        </nav>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>
