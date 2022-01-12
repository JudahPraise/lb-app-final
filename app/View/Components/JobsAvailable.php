<?php

namespace App\View\Components;

use App\Models\Position;
use Illuminate\View\Component;

class JobsAvailable extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $positions = Position::all();
        return view('components.jobs-available', compact('positions'));
    }
}
