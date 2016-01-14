@extends('layouts.app')

@section('content')
    <div class="container" itemscope itemtype="http://schema.org/Article">
        <h1 class="page-title" itemprop="headline">{{ $article->title }}</h1>
        <small itemprop="datePublished">
            <i class="fa fa-calendar"></i>
            {{ $article->created_at->diffForHumans() }}
        </small>
        <hr>
        <article itemprop="articleBody">
            {!! parsedown($article->article) !!}
        </article>
    </div>
@endsection