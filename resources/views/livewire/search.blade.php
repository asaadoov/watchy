<div 
    class="relative mt-3 md:mt-0" 
    x-data="{ isOpen: true }" 
    @click.away="isOpen =  false">
    <input 
        type="text" 
        wire:model.debounce.500ms="search" 
        class="bg-gray-800 rounded-full w-64 px-4 pl-8 py-2 focus:outline-none focus:shadow-outline text-sm	" 
        placeholder='Search (Press "/" to focus)'
        x-ref="search"
        @keydown.window="
            if(event.keyCode == 191){
                event.preventDefault();
                $refs.search.focus();
            }
        "
        @focus = "isOpen= true"
        @keydown.escape.window = "isOpen =  false"
        @key.shift.tab= "isOpen=false"
        @keydown="isOpen = true"
    >
    <div class="absolute top-0">
        <svg class="fill-current w-4 text-gray-500 mt-3 ml-2" viewBox="0 0 24 	24"><path class="heroicon-ui" d="M16.32 14.9l5.39 5.4a1 1 0 01-1.42 1.4l-5.38-5.38a8 8 0 111.41-1.41zM10 16a6 6 0 100-12 6 6 0 000 12z"/>
        </svg>
    </div>

    <div wire:loading class="spinner top-0 right-0 mr-4 mt-5"></div>

    @if(strlen($search) >= 2 )
        <div 
            class="z-50 absolute bg-gray-800 text-sm rounded w-64 mt-4" 
            x-show.transition.opacity="isOpen"
        >
            @if($searchResult->count() > 0)
                <ul>
                    @foreach ($searchResult as $movie)
                        <li class="border-b border-gray-700">
                            <a 
                                href="{{ $movie['linkToPage'] }}" 
                                class="block hover:bg-gray-700 px-3 py-3 flex items-center"
                                @if($loop->last) @keydown.tab.exact="isOpen=false" @endif>
                            
                                @if($movie['poster_path'])
                                    <img src="{{$movie['poster_path']}}" alt="{{$movie['title']}}" class="w-8">
                                @else
                                    <img src="{{ asset('img/50x75.png') }}" alt="poster" class="w-8">
                                @endif
                                
                                <span class="ml-4">{{$movie['title']}}</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            @else
                <div class="px-3 py-3">No results for "{{ $search }}"</div>
            @endif
        </div>
    @endif
</div>