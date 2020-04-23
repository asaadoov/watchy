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
        $popularTv = Http::withToken(config('services.tmdb.token'))
			->get('https://api.themoviedb.org/3/tv/popular')
			->json()['results'];

		$topRatedTv = Http::withToken(config('services.tmdb.token'))
			->get('https://api.themoviedb.org/3/tv/top_rated')
			->json()['results'];
		
		$arabicTv = Http::withToken(config('services.tmdb.token'))
			->get('https://api.themoviedb.org/3/discover/tv?language=ar&sort_by=primary_release_date.desc&page=1&primary_release_date.gte=2014&vote_average.gte=5.0&with_original_language=ar')
			->json()['results'];

		$genres = Http::withToken(config('services.tmdb.token'))
			->get('https://api.themoviedb.org/3/genre/tv/list')
			->json()['genres'];


		// dd($genres);

		$viewModel = new TvShowsViewModel($popularTv, $topRatedTv, $arabicTv, $genres);

		return view('tvShow.index', $viewModel);
    }
    
    public function show($id)
    {
        $tvShow = Http::withToken(config('services.tmdb.token'))
			->get('https://api.themoviedb.org/3/tv/'. $id .'?append_to_response=credits,videos,images')
			->json();

		$viewModel= new TvShowViewModel($tvShow);

		return view('tvShow.show', $viewModel);
    }
}
