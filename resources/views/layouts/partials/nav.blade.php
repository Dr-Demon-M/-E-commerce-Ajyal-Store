<nav class="main-header navbar navbar-expand navbar-light bg-white border-bottom shadow-sm">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link text-secondary" data-widget="pushmenu" href="#" role="button">
                <i class="fas fa-bars"></i>
            </a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{ route('dashboard') }}" class="nav-link fw-600 text-dark">Home</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="#" class="nav-link text-muted">Contact</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{ route('notifications.index') }}" class="nav-link fw-600 text-muted">Notifications Center</a>
        </li>
    </ul>

    <ul class="navbar-nav ml-auto align-items-center">
        <x-dashboard.notifications-menu />
        <li class="nav-item">
            <a class="nav-link text-secondary" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>
    </ul>
</nav>
