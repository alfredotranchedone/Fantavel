<?php namespace App\Http\Controllers;

use App\Calendario;
use App\Classifica;
use App\Player;
use App\Team;

class HomeController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Home Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders your application's "dashboard" for users that
	| are authenticated. Of course, you are free to change or remove the
	| controller as you wish. It is just here to get your app started!
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		 $this->middleware('auth');
	}

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function index()
	{

        $next = Calendario::nextMatches()->get();
        $last = Calendario::lastMatches()->get();

        $nextGiornata = Calendario::nextGiornata()->first();
        $lastGiornata = Calendario::lastGiornata()->first();

        $classifica = Classifica::getClassifica();

		return view('pages.home',[
            'player_count' => Player::count(),
            'team_count' => Team::count(),
            'nextMatches' => $next,
            'lastMatches' => $last,
            'nextGiornata' => $nextGiornata,
            'lastGiornata' => $lastGiornata,
            'classifica' => $classifica,
        ]);
	}

}
