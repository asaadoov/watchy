<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;


class SearchDropdown extends Component
{
    public $search = '';

    public function render()
    {
        $searchResult= [];

        if(strlen($this->search) >= 2){
            $searchResult = Http::withToken(config('services.tmdb.token'))
            ->get('https://api.themoviedb.org/3/search/multi?query='.urlencode( $this->search ))
            ->json()['results'];
        }
        
        $searchResult= collect($searchResult)
            ->take(7)
            ->map(function($movie){
                if(isset($movie['release_date'])){
                    $releaseDate = $movie['release_date'];
                } elseif(isset($movie['first_air_date'])){
                    $releaseDate = $movie['first_air_date'];
                } else{
                    $releaseDate = '';
                };
                
                if(isset($movie['title'])){
                    $title = $movie['title'];
                } elseif(isset($movie['name'])){
                    $title = $movie['name'];
                } else{
                    $title = 'Untitled';
                };
                
                if(isset($movie['poster_path'])){
                    $posterPath = 'https://image.tmdb.org/t/p/w92/'.$movie['poster_path'];
                } elseif(isset($movie['profile_path'])){
                    $posterPath = 'https://image.tmdb.org/t/p/w92/'.$movie['profile_path'];
                } else{
                    $posterPath = 'https://via.placeholder.com/32x48';
                };
                
                if($movie['media_type'] === 'movie'){
                    $linkToPage = route('movie.item', $movie['id']);
                } elseif($movie['media_type'] === 'tv'){
                    $linkToPage = route('tvshow.item', $movie['id']);
                } else{
                    $linkToPage = route('actor.item', $movie['id']);
                };

                return collect($movie)->merge([
                    'poster_path' => $posterPath,
                    'title' => $title,
                    'releaseDate' => $releaseDate,
                    'linkToPage' => $linkToPage,

                ]);
            });

        return view('livewire.search-dropdown', compact(['searchResult']));
    }
}
