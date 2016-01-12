@extends('layouts.app')

@section('content')
<div class="container">
    {!! parsedown(get_home()) !!}
</div>
@endsection