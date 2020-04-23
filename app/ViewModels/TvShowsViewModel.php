<?php

namespace App\ViewModels;

use Spatie\ViewModels\ViewModel;
use \Carbon\Carbon;

class TvShowsViewModel extends ViewModel
{
    public $popularTv;
    public $topRatedTv;
    public $arabicTv;
    public $genres;


    public function __construct($popularTv, $topRatedTv, $arabicTv, $genres)
    {
        $this->popularTv = $popularTv;
        $this->topRatedTv = $topRatedTv;
        $this->arabicTv = $arabicTv;
        $this->genres = $genres;

        // dd();
    }

    private function formatTvShows($tvShows)
    {
        
        return collect($tvShows)->map(function($tvShow) {
            $tvShowName = $tvShow['original_name'] != $tvShow['name'] ? ' | ' . $tvShow['original_name'] : '';
            $tvShowName = $tvShow['name'] . $tvShowName;
            
            $tvShowGenres = collect($tvShow['genre_ids'])
                ->mapWithKeys(function( $genre ) {
                    return [$genre => $this->genres()->get($genre)];
                })
                ->implode(', ');

            return collect($tvShow)->merge([
                'poster_path' => $tvShow['poster_path'] 
                ? 'https://image.tmdb.org/t/p/w500'.$tvShow['poster_path'] 
                : 'https://via.placeholder.com/481x798',
                'vote_average' => $tvShow['vote_average'] * 10 .'%',
                'first_air_date' => Carbon::parse($tvShow['first_air_date'])->format('M d, Y'),
                'genres' => $tvShowGenres,
                'name' => $tvShowName,
            ])->only([
                'poster_path', 'id', 'vote_average', 'name', 'overview', 'first_air_date', 'genres', 
            ]);
        });
    }

    public function arabicTv()
    {
        return $this->formatTvShows($this->arabicTv);
    }

    public function popularTv()
    {
        return $this->formatTvShows($this->popularTv);
    }

    public function topRatedTv()
    {
        return $this->formatTvShows($this->topRatedTv);
    }

    public function genres()
    {
        
		return collect($this->genres)->mapWithKeys(function( $genre ) {
			return [$genre['id'] => $genre['name']];
		});
    }
}
