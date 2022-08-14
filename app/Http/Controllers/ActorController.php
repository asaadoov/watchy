<?php

namespace App\Http\Controllers;

use App\ViewModels\ActorsViewModel;
use App\ViewModels\ActorViewModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ActorController extends Controller
{
    public function index($page = 1)
    {
        abort_if($page > 500, 204);
        // $arabicMovies = Http::get('https://api.themoviedb.org/3/discover/movie?language=ar&primary_release_date.gte=2010&vote_average.gte=7.9&with_original_language=ar&api_key='.config('services.tmdb.token'))
		// 	->json()['results'];
        $popularActors = Http::get('https://api.themoviedb.org/3/person/popular?page='.$page.'&api_key='.config('services.tmdb.token'))
            ->json()['results'];

        $viewModel = new ActorsViewModel($popularActors, $page);


        return view('actor.index', $viewModel);
    }
    
    public function show($id)
    {
        $actor = Http::withToken(config('services.tmdb.token'))
			->get('https://api.themoviedb.org/3/person/'. $id.'?api_key='.config('services.tmdb.token'))
            ->json();
        
        $social = Http::withToken(config('services.tmdb.token'))
			->get('https://api.themoviedb.org/3/person/'. $id . '/external_ids?api_key='.config('services.tmdb.token'))
            ->json();
        
        $credits = Http::withToken(config('services.tmdb.token'))
			->get('https://api.themoviedb.org/3/person/'. $id . '/combined_credits?api_key='.config('services.tmdb.token'))
            ->json();

        $viewModel= new ActorViewModel($actor, $social, $credits);

        return view('actor.show', $viewModel);
    }
}
