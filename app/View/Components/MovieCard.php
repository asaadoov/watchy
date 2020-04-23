<?php

namespace App\View\Components;

use Illuminate\View\Component;

class MovieCard extends Component
{
    public $movie;

    /**
     * Create a new component instance.
     *
     * @return void
     */

    // the construct pass the data to the component view
    public function __construct($movie)
    {
        $this->movie = $movie;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */

    // it render the actual view
    public function render()
    {
        return view('components.movie-card');
    }
}
