<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ArtistsToFollow extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $artists = [
            ['img' => '/images/alessia.png', 'alt' => 'Avatar of Alessia', 'name' => 'alessia_draws'],
            ['img' => '/images/adrian.png', 'alt' => 'Avatar of Adrian', 'name' => 'Mr. Anderson'],
            ['img' => '/images/mr-anderson.png', 'alt' => 'Avatar of Michael', 'name' => 'Michael'],
            ['img' => '/images/adelle.png', 'alt' => 'Avatar of Adelle', 'name' => 'just_anne'],
        ];

        return view('components.artists-to-follow', compact('artists'));
    }
}
