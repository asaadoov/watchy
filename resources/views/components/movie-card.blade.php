<div class="mt-8 ">
	<a href="{{ route('movie.item', $movie['id']) }}">
		<img src="{{$movie['poster_path']}}" alt="{{ $movie['title'] }}" class="hover:opacity-75 transition ease-in-out duration-150">
	</a>
	
</div>