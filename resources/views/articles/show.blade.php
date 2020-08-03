@extends('layouts.app')

@section('title')
{{ $article->judul }}
@endsection

@section('content')

<div class="container">
	<div class="row my-3">
		@if (session('message'))
		<div class="alert alert-success my-3">
			{{ session('message') }}
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
		@endif
		<div class="col-lg-8">
			<h3>{{ $article->judul }}</h3>
			<small>
				Posted by : <i>{{ $article->user_id }}</i>
				<br>
				Last updated : <i>{{ $article->updated_at->diffForHumans() }}, at {{ $article->updated_at }}</i>
			</small>
			<hr>
			
			@if(Auth::user()->role == 'admin')
			<ul class="list-inline">
				<li class="list-inline-item">
					<a href="{{ route('articles.edit', $article) }}" class="btn btn-outline-success">Edit</a>
				</li>
				<li class="list-inline-item">
					<form action="{{ route('articles.destroy', $article) }}" method="post">
						@method('delete')
						@csrf
						<button type="submit" class="btn btn-outline-danger" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?');">Delete</button>
					</form>
				</li>
			</ul>
			@endif
			
			<img src="{{ asset($article->takeImageArticle()) }}" alt="" class="img-fluid">

			<p class="mt-3">
				{!! $article->content !!}
			</p>
		</div>
		<div class="col-lg-4">
			<p>More updated article</p>
			@foreach($moreArticles as $more)
			<div class="card mb-3" style="width: 18rem;">
				@if($more->gambar)
				<img src="{{ asset($more->takeImageArticle()) }}" class="card-img-top" alt="...">
				@endif
				<div class="card-body">
					<h5 class="card-title">
						<a href="{{ route('articles.show', $more) }}">{{ Str::limit($more->judul, 25) }}</a>
					</h5>
					<p class="card-text">
						{!! Str::limit($more->content, 100) !!}
					</p>
					<a href="{{ route('articles.show', $more) }}" class="">Read more..</a>
					<br>
					<small>Last updated : {{ $article->updated_at->diffForHumans() }}, at {{ $article->updated_at }}</small>
				</div>
			</div>
			@endforeach
		</div>
	</div>

</div>

@endsection
