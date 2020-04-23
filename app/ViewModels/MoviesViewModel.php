<?php

namespace App\ViewModels;

use Spatie\ViewModels\ViewModel;
use \Carbon\Carbon;

class MoviesViewModel extends ViewModel
{
    public $popularMovies;
    public $nowPlayingMovies;
    public $arabicMovies;
    public $genres;


    public function __construct($popularMovies, $nowPlayingMovies, $arabicMovies, $genres)
    {
        $this->popularMovies = $popularMovies;
        $this->nowPlayingMovies = $nowPlayingMovies;
        $this->arabicMovies = $arabicMovies;
        $this->genres = $genres;

        // dd();
    }

    private function formatMovies($movies)
    {
        
        return collect($movies)->map(function($movie) {
            $movieTitle = $movie['original_title'] != $movie['title'] ? ' | ' . $movie['original_title'] : '';
            $movieTitle = $movie['title'] . $movieTitle;
            
            $movieGenres = collect($movie['genre_ids'])
                ->mapWithKeys(function( $genre ) {
                    return [$genre => $this->genres()->get($genre)];
                })
                ->implode(', ');

            return collect($movie)->merge([
                'poster_path' => $movie['poster_path'] 
                    ? 'https://image.tmdb.org/t/p/w185'.$movie['poster_path']
                    : 'https://via.placeholder.com/185x278',
                'vote_average' => $movie['vote_average'] * 10 .'%',
                'release_date' => Carbon::parse($movie['release_date'])->format('M d, Y'),
                'genres' => $movieGenres,
                'title' => $movieTitle,
                'original_language' => isset($movie['original_language']) ? $movie['original_language'] : '' 
            ])->only([
                'poster_path', 'id', 'vote_average', 'title', 'overview', 'release_date', 'genres', 'original_language'
            ]);
        });
    }

    public function arabicMovies()
    {
        return $this->formatMovies($this->arabicMovies);
    }

    public function popularMovies()
    {
        return $this->formatMovies($this->popularMovies);
    }

    public function nowPlayingMovies()
    {
        return $this->formatMovies($this->nowPlayingMovies);
    }

    public function genres()
    {
        
		return collect($this->genres)->mapWithKeys(function( $genre ) {
			return [$genre['id'] => $genre['name']];
		});
    }
}
