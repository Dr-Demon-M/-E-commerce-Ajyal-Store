<li class="nav-item dropdown">
    <a class="nav-link" data-toggle="dropdown" href="#">
        <i class="far fa-bell text-secondary"></i>
        @if ($newCount)
            <span class="badge badge-warning navbar-badge rounded-circle"
                style="font-size: 0.6rem;">{{ $newCount }}</span>
        @endif
    </a>
    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right border-0 shadow-lg mt-2" style="min-width: 300px;">
        <span class="dropdown-header fw-bold text-center">Notifications Center</span>

        @foreach ($notifications as $notification)
            <div class="dropdown-divider m-0"></div>
            <a href="{{ $notification->data['url']}}?notification_id={{ $notification->id }} " class="dropdown-item py-2 @if ($notification->unread()) text-bold @endif">
                <div class="d-flex align-items-start">
                    <i class="{{ $notification->data['icon'] }} mr-2 mt-1 text-info"></i>
                    <div style="overflow: hidden;">
                        <p class="mb-0 text-sm text-wrap" style="line-height: 1.4;">
                            {{ $notification->data['body'] }}
                        </p>
                        <small class="text-muted d-block mt-1">{{ $notification->created_at->diffForHumans() }}</small>
                    </div>
                </div>
            </a>
        @endforeach

        <div class="dropdown-divider m-0"></div>
        <a href="{{ route('notifications.index') }}" class="dropdown-item dropdown-footer text-primary text-sm font-weight-bold">View All
            Notifications</a>
    </div>
</li>
