<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
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
        $accountsCreated = Storage::get('total_accounts.txt');
        $charsCreated = Storage::get('total_characters.txt');
        $lastChar = Storage::get('last_char.txt');
        $view->with('ranking', $ranking);
        $view->with('onlinePlayers', $onlinePlayers);
        $view->with('accountsCreated', $accountsCreated);
        $view->with('charsCreated', $charsCreated);
        $view->with('lastChar', $lastChar);
    }
}
