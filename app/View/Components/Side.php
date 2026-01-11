<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Route;
use Illuminate\View\Component;

class Side extends Component
{
    public array $items;
    public string $active;

    public function __construct()
    {
        $this->items = $this->prepareItems(config('side'));
        $this->active = Route::currentRouteName();
    }

    public function render(): View|Closure|string
    {
        return view('components.side');
    }

    protected function prepareItems(array $items): array
    {
        $user = auth()->user();
        foreach ($items as $key => $item) {
            if (isset($item['ability']) && !$user->can($item['ability'])) {
                unset($items[$key]);
            }
        }
        return $items;
    }
}
