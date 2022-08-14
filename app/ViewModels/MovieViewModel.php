<?php

namespace App\ViewModels;

use Carbon\Carbon;
use Spatie\ViewModels\ViewModel;

class MovieViewModel extends ViewModel
{
    public $movie;
    public $similarMovies;

    public function __construct($movie, $similarMovies)
    {
        $this->movie= $movie;
        $this->similarMovies= $similarMovies;
    }

    public function movie()
    {
        $movie = $this->movie;

        $movieCrew=[];
        $count = 0 ;
        if($movie['credits'] != null){
            foreach($movie['credits']['crew'] as $crew){
                if($crew['department'] == "Directing" ) {
                    $movieCrew[0]['name'] = $crew['name'];
                    $movieCrew[0]['job'] = $crew['job'];
                }
                elseif($count < 1 && ( $crew['job'] == "Producer" )) {
                    $movieCrew[1]['name'] = $crew['name'];
                    $movieCrew[1]['job'] = $crew['job'];
                    ++$count;
                }
            }
        }
        
        

        return collect($movie)->merge([
            'poster_path' => $movie['poster_path'] 
                ? 'https://image.tmdb.org/t/p/w500'.$movie['poster_path'] 
                : 'https://via.placeholder.com/448x672',
            'vote_average' => $movie['vote_average'] * 10 .'%',
            'release_date' => Carbon::parse($movie['release_date'])->format('M d, Y'),
            'genres' => collect($movie['genres'])->pluck('name')->flatten()->implode(', '),
            'crew' => $movieCrew,
            'cast' => collect($movie['credits']['cast'])->take(5),
            'images' => collect($movie['images']['backdrops'])->take(9),
            'original_language' => isset($movie['original_language']) ? $movie['original_language'] : ''
        ])->only([
            'poster_path', 'id', 'vote_average', 'title', 'overview', 'release_date', 'genres', 'crew', 'cast', 'images', 'videos', 'original_language'
        ]);    
        
    }

    public function similarMovies()
    {

        $movies = $this->similarMovies; 
        // dump($movies);
        return collect($movies)->take(5)->map(function($movie){
            return collect($movie)->merge([
                'poster_path' => $movie['poster_path'] 
                    ? 'https://image.tmdb.org/t/p/w185'.$movie['poster_path']
                    : 'https://via.placeholder.com/185x278',
                'vote_average' => $movie['vote_average'] * 10 .'%',
                'release_date' => Carbon::parse($movie['release_date'])->format('M d, Y'),
                'title' => $movie['title'],
                
            ]);    
        });
        
    }
}
