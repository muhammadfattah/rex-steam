<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home.index', [
            'title' => 'Top Games',
            'games' => Game::notDeletedAdmin()->paginate(8)
        ]);
    }


    public function detail($game)
    {
        if (!$gameData = Game::findByGameName(Str::of($game)->slug(' ')->ucfirst())) {
            abort(404);
        }

        if ($gameData->for_adult) {
            $age = NULL;
            if (auth()->check()) {
                if (auth()->user()->id === $gameData->user_id) {
                    $age = 17;
                } else {
                    if (auth()->user()->birthdate !== NULL) {
                        $age = date_diff(date_create(date('Y-m-d', strtotime(auth()->user()->birthdate))), date_create(date('Y-m-d')))->format('%y');
                    } else {
                        return redirect($game . "/check-age");
                    }
                }
            } else if (session('birthdate')) {
                $age = date_diff(date_create(date('Y-m-d', strtotime(session('birthdate')))), date_create(date('Y-m-d')))->format('%y');
            }

            if ($age === NULL) {
                return redirect($game . "/check-age");
            } else if ($age < 17) {
                return redirect('/')->with('message', [
                    'icon'  => 'error',
                    'title' => 'Sorry',
                    'text'  => "there is inappropriate content for the user's current age"
                ]);
            }
        }

        return view('home.detail', [
            'title' => 'Detail Game',
            'game'  => $gameData
        ]);
    }

    public function searchGames()
    {
        return view('home.index', [
            'title' => 'Search Games',
            'games' => Game::notDeletedAdmin()->filter(request(['search']))->paginate(8)->withQueryString()
        ]);
    }

    public function checkAge($game)
    {
        if (!$gameData = Game::findByGameName(Str::of($game)->slug(' ')->ucfirst())) {
            abort(404);
        }

        return view('home.checkage', [
            'title' => 'Check Age',
            'game'  => $gameData
        ]);
    }
    public function confirmAge($game)
    {
        $day = request('day');
        $month = request('month');
        $year = request('year');
        $timestamp = strtotime("$day-$month-$year");
        if (auth()->check()) {
            User::find(auth()->user()->id)->update([
                'birthdate' => date("Y-m-d H:i:s", $timestamp)
            ]);
        } else {
            session()->flash('birthdate', date("Y-m-d H:i:s", $timestamp));
        }
        return redirect('/' . $game);
    }
}
