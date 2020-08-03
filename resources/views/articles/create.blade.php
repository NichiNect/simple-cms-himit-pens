@extends('layouts.app')

@section('title', 'Create New Article')

@section('content')

<div class="container">
	<div class="row my-3">
		<div class="col-md-6">

			<h3>Create New Article</h3>
			<br>

			<form action="{{ route('articles.create') }}" method="post" enctype="multipart/form-data">
				@csrf
				<div class="form-group">
					<label for="title">Title</label>
					<input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" placeholder="Type the title of article..">
					@error('title')
					<small class="form-text text-danger ml-2">
						{{ $message }}
					</small>
					@enderror
				</div>
				<div class="form-group">
					<label for="">Thumbnail</label>
					<div class="custom-file mb-3">
						<input type="file" name="thumbnail" id="thumbnail" class="custom-file-input">
						<label class="custom-file-label @error('title') is-invalid @enderror" for="thumbnail">Choose file...</label>
						@error('thumbnail')
						<small class="form-text text-danger ml-2">
							{{ $message }}
						</small>
						@enderror
					</div>
				</div>
				<div class="form-group">
					<label for="content">Content</label>
					<textarea name="content" id="content" class="@error('content') is-invalid @enderror" placeholder="Type the content..">{{ old('content') }}</textarea>
					@error('content')
					<small class="form-text text-danger ml-2">
						{{ $message }}
					</small>
					@enderror
				</div>

				<button type="submit" class="btn btn-primary">Submit</button>
			</form>

		</div>
	</div>
</div>

@endsection


@section('scriptjs')
<script>
	ClassicEditor
	.create( document.querySelector('#content') )
	.then( editor => {
		console.log( editor );
	} )
	.catch( error => {
		console.error( error );
	} );
</script>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
	$('.custom-file-input').on('change', function() {
		let fileName = $(this).val().split('\\').pop();
		$(this).next('.custom-file-label').addClass("selected").html(fileName);
	});
</script>
@endsection