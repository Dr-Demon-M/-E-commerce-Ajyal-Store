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
    </ul>

    <ul class="navbar-nav ml-auto align-items-center">
        <li class="nav-item">
            <a class="nav-link text-secondary" data-widget="navbar-search" href="#" role="button">
                <i class="fas fa-search"></i>
            </a>
            <div class="navbar-search-block">
                <form class="form-inline">
                    <div class="input-group input-group-sm">
                        <input class="form-control form-control-navbar border-secondary-subtle" type="search"
                            placeholder="Type to search..." aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-navbar border border-left-0" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                            <button class="btn btn-navbar border border-left-0" type="button"
                                data-widget="navbar-search">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </li>

        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-comments text-secondary"></i>
                <span class="badge badge-info navbar-badge rounded-circle" style="font-size: 0.6rem;">3</span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right border-0 shadow-lg mt-2">
                <a href="#" class="dropdown-item">
                    <div class="media align-items-center">
                        <img src="{{ asset('dist/img/user1-128x128.jpg') }}" alt="User Avatar"
                            class="img-size-50 mr-3 img-circle border">
                        <div class="media-body">
                            <h3 class="dropdown-item-title text-sm fw-bold">
                                Brad Diesel
                                <span class="float-right text-xs text-danger"><i class="fas fa-star"></i></span>
                            </h3>
                            <p class="text-xs text-muted mb-0 text-truncate" style="max-width: 150px;">Sent you a new
                                proposal...</p>
                            <p class="text-xs text-secondary mt-1"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                        </div>
                    </div>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item dropdown-footer text-primary text-sm">View All Messages</a>
            </div>
        </li>

        <x-dashboard.notifications-menu count='7' />

        <li class="nav-item">
            <a class="nav-link text-secondary" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-primary" data-widget="control-sidebar" data-slide="true" href="#"
                role="button">
                <i class="fas fa-th-large"></i>
            </a>
        </li>
    </ul>
</nav>
