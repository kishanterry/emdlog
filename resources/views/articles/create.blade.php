@extends('layouts.app')

@section('content')
    @include('articles.partials.form', ['article' => new App\Models\Article])
@endsection