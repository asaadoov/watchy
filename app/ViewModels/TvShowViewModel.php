<?php

namespace App\ViewModels;

use Carbon\Carbon;
use Spatie\ViewModels\ViewModel;

class TvShowViewModel extends ViewModel
{
    public $tvShow;

    public function __construct($tvShow)
    {
        $this->tvShow= $tvShow;
    }

    public function tvShow()
    {
        $tvShow = $this->tvShow;

        $tvShowCrew=[];
        $count = 0 ;
        foreach($tvShow['credits']['crew'] as $crew){
            if($crew['department'] == "Directing" ) {
                $tvShowCrew[0]['name'] = $crew['name'];
                $tvShowCrew[0]['job'] = $crew['job'];
            }
            elseif($count < 1 && ( $crew['job'] == "Producer" )) {
                $tvShowCrew[1]['name'] = $crew['name'];
                $tvShowCrew[1]['job'] = $crew['job'];
                ++$count;
            }
        }
        
        

        return collect($tvShow)->merge([
            'poster_path' => $tvShow['poster_path'] 
                ? 'https://image.tmdb.org/t/p/w500'.$tvShow['poster_path'] 
                : 'https://via.placeholder.com/448x672',
            'vote_average' => $tvShow['vote_average'] * 10 .'%',
            'first_air_date' => Carbon::parse($tvShow['first_air_date'])->format('M d, Y'),
            'genres' => collect($tvShow['genres'])->pluck('name')->flatten()->implode(', '),
            'crew' => $tvShowCrew,
            'media_type' => 'TV SHOW',
            'cast' => collect($tvShow['credits']['cast'])->take(5),
            'images' => collect($tvShow['images']['backdrops'])->take(9),
        ])->only([
            'poster_path', 'id', 'vote_average', 'name', 'overview', 'first_air_date', 'genres', 'crew', 'cast', 'images', 'videos', 'media_type'
        ]);    
        
    }
}
