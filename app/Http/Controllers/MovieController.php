<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;

use App\ViewModels\MoviesViewModel;
use App\ViewModels\MovieViewModel;

class MovieController extends Controller
{
	public function index(){
		
		$popularMovies = Http::get('https://api.themoviedb.org/3/movie/popular?api_key='.config('services.tmdb.token'))->json()['results'];
		// dd($popularMovies);
		$nowPlayingMovies = Http::get('https://api.themoviedb.org/3/movie/now_playing?api_key='.config('services.tmdb.token'))
			->json()['results'];
		
		$arabicMovies = Http::get('https://api.themoviedb.org/3/discover/movie?language=ar&primary_release_date.gte=2000&with_original_language=ar&api_key='.config('services.tmdb.token'))
			->json()['results'];
		
		// $arabicMovies2 = Http:: 	->get('https://api.themoviedb.org/3/discover/movie?language=ar&sort_by=primary_release_date.desc&page=2&primary_release_date.gte=2014&vote_average.gte=7.5&with_original_language=ar')
		// 	->json()['results'];
	
		// $arabicMovies= array_merge($arabicMovies1, $arabicMovies2);

		$genres = Http::get('https://api.themoviedb.org/3/genre/movie/list?api_key='.config('services.tmdb.token'))
			->json()['genres'];


		// dd($genres);

		$viewModel = new MoviesViewModel($popularMovies, $nowPlayingMovies, $arabicMovies, $genres);

		return view('movie.index', $viewModel);
		
		// return view('movie.index', compact(['popularMovies', 'genres', 'nowPlayingMovies', 'arabicMovies']));
	}

	public function show($id){

		$movie = Http::get('https://api.themoviedb.org/3/movie/'.$id.'?append_to_response=credits,videos,images&api_key='.config('services.tmdb.token'))
			->json();
		$similarMovies = Http::get('https://api.themoviedb.org/3/movie/'.$id.'/similar?api_key='.config('services.tmdb.token'))
			->json()['results'];


		$viewModel= new MovieViewModel($movie, $similarMovies);

		return view('movie.show', $viewModel);
	}
}
