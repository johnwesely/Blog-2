<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Category;

class CategoryDropdown extends Component
{
    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.category-dropdown', [
            'categories' => Category::all(),                                              // loads categories into dropdown directly.
            'currentCategory' => Category::where('slug', request('category'))->first()    // current category if exists         
        ]);                                                                               // No more need to supply category arguments to views
    }
}
