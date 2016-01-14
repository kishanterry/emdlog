@extends('layouts.app')

@section('content')
    <div class="container" itemscope itemtype="http://schema.org/Blog">
        <h1 class="page-title" itemprop="name">
            Articles by me
            @if(!app('auth')->guest())
            <a href="{{ url('/articles/create') }}" class="btn btn-default">
                <i class="fa fa-pencil"></i>
                New Article
            </a>
            @endif
        </h1>
        @forelse($articles as $article)
            <article class="media article" itemscope itemtype="http://schema.org/BlogPosting">
                <div class="media-body">
                    <h3 class="media-heading">
                        <a href="{{ url("/articles/{$article->slug}") }}" itemprop="headline">
                            {{ $article->title }}
                        </a>
                    </h3>
                    <p>
                        <small itemprop="datePublished">
                            <i class="fa fa-calendar"></i>
                            {{ $article->created_at->diffForHumans() }}
                        </small>
                        @if(!app('auth')->guest())
                            <small>
                                &nbsp;&hybull;
                                <a href="{{ url("/articles/{$article->slug}/edit") }}" class="btn btn-xs btn-link">
                                    <i class="fa fa-pencil"></i>
                                    Edit
                                </a>
                                <span class="label {{ $article->published ? 'label-success' : 'label-danger' }}">
                                    {{  $article->published ? 'Published' : 'Draft' }}
                                </span>
                            </small>
                        @endif
                    </p>
                    <div itemprop="text">
                        {{ $article->excerpt }}
                    </div>
                </div>
            </article>
        @empty
            <div class="alert alert-warning">
                <p class="text-center">
                    <i class="fa fa-battery-1"></i>
                    There are currently no articles written by me. Please check back in a while.
                </p>
            </div>
        @endforelse
    </div>
@endsection