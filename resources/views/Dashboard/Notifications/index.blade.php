@extends('layouts.dashboardLayout')

@section('title')
    <div class="d-flex align-items-center justify-content-between w-100">
        <h4 class="mb-0 text-dark fw-bold"><i class="fa-solid fa-bell text-primary"></i> Notifications Center</h4>

    </div>
@endsection

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Notifications</li>
@endsection

@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
@endpush

@section('content')

    <body class="bg-light">

        <div class="container py-4">

            <div class="d-flex align-items-center justify-content-between mb-3">
                <h3 class="mb-0">All Notifications</h3>
                <span class="badge bg-primary">{{ $newCount }} Total</span>
            </div>
            <div class="card shadow-sm">
                <div class="table-responsive">
                    <table class="table mb-0 align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th>Message</th>
                                <th style="width: 180px;">Created</th>
                                <th style="width: 140px;">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($notifications as $notification)
                                <tr>
                                    <td class=" @if ($notification->unread()) text-bold @endif">
                                        <a href="{{ $notification->data['url'] }}?notification_id={{ $notification->id }}"
                                            class="text-decoration-none text-dark d-block">
                                            <div class="fw-semibold">{{ $notification->data['body'] }}</div>
                                            <div class="text-muted small">{{ $notification->data['Customer'] }}</div>
                                        </a>
                                    </td>
                                    <td class="text-muted"> {{ $notification->created_at->diffForHumans() }}</td>
                                    <td><span
                                            class="badge {{ $notification->read_at ? 'bg-success' : 'bg-warning text-dark' }}">{{ $notification->read_at ? 'Read' : 'unread' }}</span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="text-center">
                </div>
                @if ($notifications->isEmpty())
                    <div class="text-center py-4">
                        <i class="bi bi-bell-slash text-success fs-1 mb-3 d-block"></i>
                        <h6 class="text-dark fw-bold mb-1">All Caught Up!</h6>
                        <p class="text-muted small mb-0">No notifications right now.</p>
                    </div>
                @endif
                @if ($notifications->count() > 0)
                    <div class="card-footer bg-white border-top-0 py-3">
                        <div class=" d-flex justify-content-end pr-3" style="margin: 0 25px 25px 0;">
                            <form action="{{ route('notifications.delete') }}" method="POST">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-dark ">Remove All Notifications</button>
                            </form>
                        </div>
                        <div class="d-flex justify-content-center mt-2">
                            {{ $notifications->withQueryString()->links() }}
                        </div>
                    </div>
                @endif
            </div>
        </div>

        </div>
    @endsection
