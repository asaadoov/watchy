@extends('layouts.app')

@section('content')
	<div class="container mx-auto px-4 pt-16">	
		<!-- Popular -->
		<div class="popular-movies mx-2 md:mx-0">
			<h2 class="uppercase tracking-wider text-orange-500 text-lg font-semibold"> popular movies </h2>
			<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8 ">
				@foreach($popularMovies as $movie)
					<!-- this it how the component is called -->
					<x-movie-card :movie="$movie"  />
				@endforeach
			</div>
		</div>
	</div>
@endsection