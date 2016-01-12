@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="page-title">{{ $article->title }}</h1>
        <small>
            <i class="fa fa-calendar"></i>
            {{ $article->created_at->diffForHumans() }}
        </small>
        <hr>
        <article>
            {!! parsedown($article->article) !!}
        </article>
    </div>
@endsection