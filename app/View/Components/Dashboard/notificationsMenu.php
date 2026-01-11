<?php

namespace App\View\Components\Dashboard;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class notificationsMenu extends Component
{
    /**
     * Create a new component instance.
     */

    public $notifications;
    public $newCount;

    public function __construct($count = 10)
    {
        $this->notifications = Auth::user()->notifications()->take($count)->get();
        $this->newCount = Auth::user()->unReadNotifications()->count();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.dashboard.notifications-menu');
    }
}
