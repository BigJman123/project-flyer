@extends('layout')

@section('content')

	<div class="row">
		<div class="col-md-4">
			<h1>{!! $flyer->street !!}</h1>
			<h2>{!! $flyer->price !!}</h2>

			<hr>

			<div class="description">{!! nl2br($flyer->description) !!}</div>
		</div>

		<div class="col-md-8 gallery">
			@foreach ($flyer->photos->chunk(4) as $set)
				<div class="row">
					@foreach ($set as $photo)
						<div class="col-md-3 gallery__image">
							<img src="/{{ $photo->thumbnail_path }}" alt="">
						</div>
					@endforeach
				</div>
			@endforeach

			@if ($user && $user->owns($flyer))
				
				<hr>

				<form id="addPhotoForm" 
					action="{{ route('store_photo_path', [$flyer->zip, $flyer->street]) }}" 
					method="POST" 
					class="dropzone"
				>
					{{ csrf_field() }}
				</form>
			@endif
		</div>
	</div>


	<h2>Add Your Photos</h2>

	
@stop

@section('scripts.footer')
	<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.3.0/dropzone.js"></script>
	<script>
		Dropzone.options.addPhotoForm = {
			paramName: 'photo',
			maxFilesize: 3,
			acceptedFiles: '.jpg, .jpeg, .png, .bmp',
		};
	</script>
@stop