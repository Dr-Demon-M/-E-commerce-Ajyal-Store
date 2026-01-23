<?php

namespace App\View\Components;

use App\Models\Category;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class BottomHeader extends Component
{
    public $categories;
    // public $subCategory;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->categories = Category::whereNull('parent_id')
            ->with('children')->get();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.bottom-header');
    }
}
