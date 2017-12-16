<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class MenuComposer
{
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $ranking = Storage::get('ranking.txt');
        $onlinePlayers = Storage::get('online_players.txt');
        $view->with('ranking', $ranking);
        $view->with('onlinePlayers', $onlinePlayers);
    }
}
