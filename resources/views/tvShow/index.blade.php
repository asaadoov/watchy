@extends('layouts.app')

@section('content')
	<div class="container mx-auto px-4 pt-16">	
		<!-- Arabic Tv-Shows-->
		<div class="arabic-tvshow mx-2 md:mx-0">
			<h2 class="uppercase tracking-wider text-orange-500 text-lg font-semibold"> arabic tv-shows </h2>
			<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8 ">
				@foreach($arabicTv as $tvShow)
					@if($tvShow['poster_path'] != null)
						<!-- this it how the component is called -->
						<x-tv-show-card :tvShow="$tvShow"  />
					@endif
				@endforeach
			</div>
		</div>

		<!-- Popular -->
		<div class="popular-tvshow py-24 mx-2 md:mx-0">
			<h2 class="uppercase tracking-wider text-orange-500 text-lg font-semibold"> popular tv-shows </h2>
			<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8 ">
				@foreach($popularTv as $tvShow)
					<!-- this it how the component is called -->
					<x-tv-show-card :tvShow="$tvShow"  />
				@endforeach
			</div>
		</div>

		<!-- Top Rated Tv-Shows -->
		<div class="rated-tvshow py-24 mx-2 md:mx-0">
			<h2 class="uppercase tracking-wider text-orange-500 text-lg font-semibold"> Top Raated tv-show </h2>

			<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8 ">
				@foreach($topRatedTv as $tvShow)
					<!-- this it how the component is called -->
					<x-tv-show-card :tvShow="$tvShow"  />
				@endforeach
			</div>
		</div>
	</div>
@endsection