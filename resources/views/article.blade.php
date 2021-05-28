@extends('rapidez::layouts.app')

@section('title', $article->meta_title ?: $article->name)
@section('description', $article->meta_description)

@section('content')
    <div class="container mx-auto mb-5 px-3 sm:px-0">
        <div class="prose prose-green max-w-none">
            <h1>{{ $article->name }}</h1>
            {!! $article->text !!}
        </div>
    </div>
@endsection
