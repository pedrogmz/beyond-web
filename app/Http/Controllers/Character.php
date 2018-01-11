<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Auth;
use DB;

class Character extends Controller
{
    public function debug($id) {
        $char = DB::table('player.player')
            ->leftJoin('player.player_index', 'player.id', '=', 'player_index.id')
            ->leftJoin('player.guild_member', 'player.id', '=', 'guild_member.pid')
            ->leftJoin('player.guild', 'guild_member.guild_id', '=', 'guild.id')
            ->select('player.*', 'player_index.empire')
            ->where('player.id', $id)
            ->first();
        $diferencia = time() - $char->last_play;
        if (Cookie::get('Desbug') != '1') {
            if( $diferencia > (10*60) ) {
                if($char->empire == 1) {
                    $x = 459770;
                    $y = 953980;
                    $map = 0;
                } else if($char->empire == 2) {
                    $x = 52043;
                    $y = 166304;
                    $map = 21;
                } else if($char->empire == 3) {
                    $x = 957291;
                    $y = 255221;
                    $map = 41;	
                }
                $updateMap = DB::table('player.player')
                    ->where('player.id', '=', $char->id)
                    ->update(['player.map_index' => $map, 'player.x' => $x, 'player.y' => $y, 'exit_x' => $x, 'exit_y' => $y]);
                return redirect()->back()->with('status', __('strings.hDesbug1'))->cookie('Desbug', '1', time()+600);
            } else {
                return redirect()->back()->with('status', __('strings.hDesbug2'));
            }
        } else {
            return redirect()->back()->with('status', __('strings.hDesbug3'));     
        }
    }

    public function accountCharList() {
        $account_id = Auth::user()->id;
        $charlist = DB::table('player.player')
                ->leftJoin('player.player_index', 'player.id', '=', 'player_index.id')
                ->leftJoin('player.guild_member', 'player.id', '=', 'guild_member.pid')
                ->leftJoin('player.guild', 'guild_member.guild_id', '=', 'guild.id')
                ->join('account.account', 'player.account_id', '=', 'account.id')
                ->select('player.*', 'guild.name as guildname', 'player_index.empire')
                ->where('player.account_id', $account_id)
                ->orderBy('level', 'desc')
                ->orderBy('exp', 'desc')
                ->orderBy('playtime', 'desc')
                ->get();
                return view('user.charlist', ['charlist' => $charlist]);
    }

    public function FullRanking() {
        return view('front.ranking');
    }
}
