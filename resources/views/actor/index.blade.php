@extends('layouts.app')

@section('content')
	<div class="container mx-auto px-4 py-4">	
		
		<!-- Popular -->
		<div class="popular-actors py-24 mx-2 md:mx-0">
			<h2 class="uppercase tracking-wider text-orange-500 text-lg font-semibold"> popular actors </h2>
			<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-8 ">
				@foreach ($popularActors as $actor)
					<div class="actor mt-8">
						<a href="{{ route('actor.item', $actor['id']) }}">
							<img src="{{ $actor['profile_path'] }}" alt="{{ $actor['name'] }}" class="hover:opacity-75 transition ease-in-out duaration-150">
						</a>
						<div class="mt-2">
							<a href="{{ route('actor.item', $actor['id']) }}" class="text-lg hover:text-gray-300">{{ $actor['name'] }}</a>
							<div class="text-sm truncate text-gray-400">{{ $actor['known_for'] }}</div>
						</div>
					</div>
				@endforeach
			</div>
		</div> <!-- end popular -->

		<div class="page-load-status flex item-center">
			<div class="flex justify-center">
				<div class="infinite-scroll-request spinner my-8 text-4xl">$nbsp;</div>
			</div>
			<p class="infinite-scroll-last">End of content</p>
			<p class="infinite-scroll-error">Error</p>
		</div>

		{{-- <div class="flex justify-between my-16">
			@if($previous)
				<a href="/actor/page/{{ $previous }}">Previous</a>
			@else
				<div></div>
			@endif
			
			@if($next)
				<a href="/actor/page/{{ $next }}">Next</a>
			@else
				<div></div>
			@endif
		</div> --}}

	</div>
@endsection

@push('js')
	<script src="https://unpkg.com/infinite-scroll@3/dist/infinite-scroll.pkgd.min.js"></script>
	<script>
		var elem = document.querySelector('.grid');
		var infScroll = new InfiniteScroll( elem, {
			// options
			path: '/actor/page/@{{#}}',
			append: '.actor',
			status: '.page-load-status',
			history: false,
		});
	</script>
@endpush