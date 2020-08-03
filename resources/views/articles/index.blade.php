@extends('layouts.app')

@section('title', 'All Articles')

@section('content')

<div class="container">
	<div class="row">
		<div class="col-lg">		
			<h1>This All Articles</h1>
		</div>
	</div>

	@if (session('success'))
	<div class="alert alert-success my-3">
		{{ session('success') }}
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
	</div>
	@endif

	<div class="row">
		@foreach($articles as $article)
		<div class="col-lg-4">
			<div class="card my-2 mb-3">
				<div class="card-header">
					{{ $article->judul }}
				</div>
				<div class="card-body row">
					@if(!$article->gambar) 
					<div class="col-md">
						{!! Str::limit($article->content, 100) !!}
						<a href="{{ route('articles.show', $article) }}">Read more..</a>
					</div>
					@else
					<div class="col-md-4">
						<img style="height: 100px; object-fit: cover; object-position: center;" src="{{ asset($article->takeImageArticle()) }}" alt="" class="img-thumbnail">
					</div>
					<div class="col-md-8">
						{!! Str::limit($article->content, 100) !!}
						<a href="{{ route('articles.show', $article) }}">Read more..</a>
					</div>
					@endif
				</div>
			</div>
		</div>
		@endforeach
		
	</div>
	{{ $articles->links() }}
</div>

@endsection