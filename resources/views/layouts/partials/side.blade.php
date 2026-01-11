<aside class="main-sidebar sidebar-light-primary elevation-2 border-right">
    <a href="{{ url('/') }}" class="brand-link border-bottom shadow-sm">
        <img src="{{ asset('dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-2"
            style="opacity: .9; filter: drop-shadow(0px 2px 2px rgba(0,0,0,0.1));">
        <span class="brand-text font-weight-bold text-primary">{{ config('app.name') }}</span>
    </a>

    <div class="sidebar px-2">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex align-items-center shadow-sm rounded bg-light p-2">
            <div class="image">
                <img src="{{ asset('dist/img/user2-160x160.jpg') }}" class="img-circle border border-white elevation-1"
                    alt="User Image" style="width: 2.5rem;">
            </div>
            <div class="info w-100">
                <a href="{{ route('dashboard.profile.edit') }}" class="d-block fw-600 text-dark mb-1 ml-2">{{ Auth::user()->name }}</a>
                <form action="{{ route('logout') }}" method="Post" class="ml-2">
                    @csrf
                    <button class="btn btn-xs btn-outline-danger btn-block border-0 text-left p-0"
                        style="font-size: 0.75rem;">
                        <i class="fas fa-sign-out-alt mr-1" style="padding: 10px;"></i> Logout
                    </button>
                </form>
            </div>
        </div>

        <div class="form-inline mt-2">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar bg-white border-light shadow-none" type="search"
                    placeholder="Quick Search..." aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar bg-white border-light shadow-none">
                        <i class="fas fa-search fa-fw text-muted"></i>
                    </button>
                </div>
            </div>
        </div>

        <nav class="mt-3">
            <x-Side />
        </nav>
    </div>
</aside>
