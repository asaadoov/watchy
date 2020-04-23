@extends('layouts.app')

@section('content')
	<div class="tvShow-info border-b border-gray-800">
		<div class="container mx-auto px-4 py-16 flex items-center flex-col md:flex-row">
			<div class="flex-none">
				<img src="{{ $tvShow['poster_path'] }}" alt="{{ $tvShow['name'] }}" class="w-64 md:w-96">
			</div>

			<div class="md:ml-24 ">
				<h2 class="text-4xl font-semibold">{{ $tvShow['name'] }} <span class="text-sm text-orange-500 font-semibold uppercase">( Tv Show )</span></h2>
				<div class="flex flex-wrap items-center text-gray-400 text-sm">
					<svg class="fill-current text-orange-500 w-4" viewBox="0 0 24 24"><g data-name="Layer 2"><path d="M17.56 21a1 1 0 01-.46-.11L12 18.22l-5.1 2.67a1 1 0 01-1.45-1.06l1-5.63-4.12-4a1 1 0 01-.25-1 1 1 0 01.81-.68l5.7-.83 2.51-5.13a1 1 0 011.8 0l2.54 5.12 5.7.83a1 1 0 01.81.68 1 1 0 01-.25 1l-4.12 4 1 5.63a1 1 0 01-.4 1 1 1 0 01-.62.18z" data-name="star"/></g></svg>
					<span class="ml-1">{{ $tvShow['vote_average'] }}</span>
					<span class="mx-2">|</span>
					<span>{{ $tvShow['first_air_date'] }}</span>
					<span class="mx-2">|</span>
					<span> {{ $tvShow['genres'] }} </span>
				</div>

				<p class="text-gray-300 mt-8">
					{{ $tvShow['overview'] }}
				</p>

				@if($tvShow['crew'])
					<div class="mt-12">
						<h2 class="text-white font-semibold"> Featured Cast </h2>
						<div class="flex flex-col md:flex-row mt-4">
							@foreach($tvShow['crew'] as $crew)
									<div class="mt-4 md:mt-0 md:mr-10">
										<div>{{$crew['name']}}</div>
										<div class="text-sm text-gray-400">{{$crew['job']}}</div>
									</div>
							@endforeach
						</div>
				@ENDIF

					@if(count($tvShow['videos']['results']) > 0)
					<div x-data="{ isOpen: false }">
						<div class="mt-12">
								<button 
									@click="isOpen = true"
									class="flex inline-flex items-center bg-orange-500 text-gray-900 rounded font-semibold px-5 py-4 hover:bg-orange-600 transition ease-in-out duration-150">
									<svg class="w-6 fill-current" viewBox="0 0 24 24"><path d="M0 0h24v24H0z" fill="none"/><path d="M10 16.5l6-4.5-6-4.5v9zM12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z"/></svg>
									<span class="ml-2">Play Trailer</span>
								</button>
							</div>
							
							<div
							style="background-color: rgba(0, 0, 0, .5);"
							class="fixed top-0 left-0 w-full h-full flex items-center shadow-lg overflow-y-auto"
							x-show.transition.opacity="isOpen"
							>
							<div class="container mx-auto lg:px-32 rounded-lg overflow-y-auto">
								<div class="bg-gray-900 rounded">
									<div class="flex justify-end pr-4 pt-2">
										<button
										@click="isOpen = false; 
												var video = $('#player').attr('src'); 
												$('#player').attr('src',''); 
												$('#player').attr('src',video);"
										@keydown.escape.window="isOpen = false"
										class="text-3xl leading-none hover:text-gray-300">&times;
									</button>
								</div>
								<div class="modal-body px-8 py-8" id="trailer">
									<div class="responsive-container overflow-hidden relative" style="padding-top: 56.25%">
										<iframe id="player" class="responsive-iframe absolute top-0 left-0 w-full h-full" src="https://www.youtube.com/embed/{{ $tvShow['videos']['results'][0]['key'] }}" style="border:0;" allow="autoplay; encrypted-media" allowfullscreen></iframe>

									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				@endif

				</div>
			</div>
		</div>
	</div> <!-- End Movie-info -->

	@if(count($tvShow['cast']) > 0)
	<div class="movie-cast border-b border-gray-800">
		<div class="container mx-auto px-4 py-16">
			<h2 class="text-3xl text-orange-500 uppercase font-semibold">Cast</h2>

			<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8 ">
				@foreach($tvShow['cast'] as $cast)
						<div class="mt-8 ">
							<a href="{{ route('actor.item', $cast['id']) }}" class="glyphicons_v2 picture grey profile no_image_holder profile zero">
								@if($cast['profile_path'] != null)
									<img src="{{'https://image.tmdb.org/t/p/w300'.$cast['profile_path'] }} " alt="{{$cast['name']}}" class="hover:opacity-75 transition ease-in-out duration-150">
								@else
									<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 272.383 272.383" style="enable-background:new 0 0 272.383 272.383; background:#fff;" xml:space="preserve">
									<g><g><path style="fill:#010002;" d="M223.214,152.723h-32.237c16.306-20.152,26.76-47.195,26.76-71.415    C217.737,36.474,181.262,0,136.428,0S55.114,36.474,55.114,81.309c0,24.22,10.454,51.263,26.76,71.415H49.164    c-14.86,0-28.544,7.468-36.599,19.972c-5.673,8.811-6.864,24.242-3.535,45.868l4.259,27.701    c2.246,14.647,15.621,26.118,30.437,26.118h184.928c14.816,0,28.191-11.471,30.442-26.118l4.259-27.701    c3.329-21.626,2.138-37.056-3.535-45.868C251.758,160.191,238.073,152.723,223.214,152.723z M248.342,244.616    c-1.409,9.154-10.427,16.888-19.689,16.888H43.725c-9.263,0-18.281-7.734-19.689-16.888l-4.259-27.701    c-2.828-18.389-2.143-31.998,1.931-38.324c6.043-9.388,16.312-14.99,27.456-14.99h42.838    c12.901,11.988,28.229,19.668,44.421,19.668s31.525-7.68,44.421-19.668h42.37c11.145,0,21.414,5.602,27.456,14.985    c4.079,6.326,4.759,19.94,1.931,38.324L248.342,244.616z M207.408,81.309c0,24.438-12.276,52.786-30.263,71.415    c-1.86,1.925-3.775,3.737-5.749,5.439c-2.29,1.974-4.64,3.813-7.065,5.439c-8.686,5.831-18.145,9.339-27.908,9.339    s-19.216-3.508-27.902-9.339c-2.426-1.626-4.775-3.465-7.065-5.439c-1.974-1.702-3.889-3.514-5.749-5.439    c-17.987-18.629-30.263-46.972-30.263-71.415c0-39.14,31.84-70.985,70.985-70.985S207.408,42.169,207.408,81.309z"/>
											</g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g>
									</svg>
								@endif
								
							</a>
							<div class="mt-2">
								<a href="{{ route('actor.item', $cast['id']) }}" class="text-lg mt-2 font-semibold hover:text-gray:300">{{$cast['name']}}</a>
								<div class="flex items-center text-gray-400 text-sm mt-1">
									<span>{{$cast['character']}}</span>
								</div>
							</div>
						</div>
				@endforeach
			</div> <!-- Grid Ends -->

		</div>
	</div> <!-- Cast Ends -->
	@endif

	@if(count($tvShow['images']) > 0)
		<div class="movie-images border-b border-gray-800" 
			x-data="{ isOpen: false, image:'' }">
			<div class="container mx-auto px-4 py-16">
				<h2 class="text-3xl text-orange-500 uppercase font-semibold">Images</h2>
				<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-8 ">
					@foreach ($tvShow['images'] as $image)
							<div class="mt-8 ">
								<a href="#"
									@click.prevent="
										image= '{{'https://image.tmdb.org/t/p/original'.$image['file_path']}}'
										isOpen= true
									">
									<img src="{{'https://image.tmdb.org/t/p/w500'.$image['file_path']}}" alt="image" class="hover:opacity-75 transition ease-in-out duration-150">
								</a>
							</div>
					@endforeach
				</div> <!-- Grid Ends -->

				<div
					style="background-color: rgba(0, 0, 0, .5);"
					class="fixed top-0 left-0 w-full h-full flex items-center shadow-lg overflow-y-auto"
					x-show="isOpen"
				>
					<div class="container mx-auto lg:px-32 rounded-lg overflow-y-auto">
						<div class="bg-gray-900 rounded">
							<div class="flex justify-end pr-4 pt-2">
								<button
										@click="isOpen = false"
										@keydown.escape.window="isOpen = false"
										class="text-3xl leading-none hover:text-gray-300">&times;
								</button>
							</div>
							<div class="modal-body px-8 py-8">
								<img :src="image" alt="poster">
							</div>
						</div>
					</div>
				</div>

			</div>
		</div> <!-- Images Ends -->
	@endif
@endsection