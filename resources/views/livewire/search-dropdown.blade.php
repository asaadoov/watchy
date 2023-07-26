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


    
</div>