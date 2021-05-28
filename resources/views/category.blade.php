@extends('rapidez::layouts.app')

@section('title', $category->meta_title)
@section('description', $category->meta_description)

@section('content')
    <div class="container mx-auto mb-5 px-3 sm:px-0">
        <div class="prose prose-green max-w-none">
            {!! $category->description !!}
        </div>
        <div class="sm:grid sm:gap-3 md:gap-5 sm:grid-cols-2 md:grid-cols-3">
            @foreach($categories as $category)
                <div>
                    <strong class="inline-block mb-3 font-bold text-xl">
                        {{ $category->name }}
                    </strong>

                    @foreach($subCategories = $category->subCategories as $subCategory)
                        <div class="flex items-center">
                            <svg class="w-6 h-6 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"></path></svg>
                            <a href="{{ route('knowledgebase', $subCategory->url_key) }}" class="hover:underline">
                                {{ $subCategory->name }}
                            </a>
                        </div>
                    @endforeach

                    @if($subCategories->isEmpty())
                        @foreach($category->articles()->limit(Rapidez::config('kb/general/article_links_limit'))->orderBy('position')->get() as $article)
                            <div class="flex items-center">
                                <svg class="w-6 h-6 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                <a href="{{ route('knowledgebase', $category->url_key.'/'.$article->url_key) }}" class="hover:underline">
                                    {{ $article->name }}
                                </a>
                            </div>
                        @endforeach

                        <a href="{{ route('knowledgebase', $category->url_key) }}" class="hover:underline">
                            @lang('Show all articles')
                        </a>
                    @endif
                </div>
            @endforeach
        </div>

        @isset($articles)
            @if($articles && $category->description)
                <hr class="my-5">
            @endif

            @foreach($articles as $article)
                <div class="mb-3">
                    <a href="{{ url()->current().'/'.$article->url_key }}" class="text-lg font-semibold hover:underline">
                        {{ $article->name }}
                    </a>
                    <div class="text-gray-700">{{ Str::limit(strip_tags($article->text), 150) }}</div>
                </div>
            @endforeach

            {{ $articles->links() }}
        @endisset
    </div>
@endsection
