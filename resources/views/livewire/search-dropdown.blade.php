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
    
</div>