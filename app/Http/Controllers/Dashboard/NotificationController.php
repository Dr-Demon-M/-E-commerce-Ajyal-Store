<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = Auth::user()->notifications()->paginate(5);
        $newCount = Auth::user()->Notifications()->count();
        return view('dashboard.notifications.index', compact('notifications', 'newCount'));
    }

    public function deleteAll()
    {
        Auth::user()->readNotifications()->delete();

        return back();
    }
}
