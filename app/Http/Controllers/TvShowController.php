<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ViewModels\TvShowViewModel;
use App\ViewModels\TvShowsViewModel;
use Illuminate\Support\Facades\Http;

class TvShowController extends Controller
{
    public function index()
    {
		// $arabicMovies = Http::get('https://api.themoviedb.org/3/discover/movie?language=ar&primary_release_date.gte=2010&vote_average.gte=7.9&with_original_language=ar&api_key='.config('services.tmdb.token'))
		// 	->json()['results'];
        $popularTv = Http::get('https://api.themoviedb.org/3/tv/popular?api_key='.config('services.tmdb.token'))
			->json()['results'];

		$topRatedTv = Http::get('https://api.themoviedb.org/3/tv/top_rated?api_key='.config('services.tmdb.token'))
			->json()['results'];
		
		$arabicTv = Http::get('https://api.themoviedb.org/3/discover/tv?language=ar&sort_by=primary_release_date.desc&page=1&with_original_language=ar&api_key='.config('services.tmdb.token'))
			->json()['results'];

		$genres = Http::get('https://api.themoviedb.org/3/genre/tv/list?api_key='.config('services.tmdb.token'))
			->json()['genres'];


		// dd($genres);

		$viewModel = new TvShowsViewModel($popularTv, $topRatedTv, $arabicTv, $genres);

		return view('tvShow.index', $viewModel);
    }
    
    public function show($id)
    {
        $tvShow = Http::get('https://api.themoviedb.org/3/tv/'. $id .'?append_to_response=credits,videos,images&api_key='.config('services.tmdb.token'))
			->json();

		$viewModel= new TvShowViewModel($tvShow);

		return view('tvShow.show', $viewModel);
    }
}
