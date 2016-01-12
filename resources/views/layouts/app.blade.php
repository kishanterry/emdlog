<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ $meta['page_meta_title'] }}</title>
    @if($meta['page_meta_description'])
        <meta name="description" content="{{ $meta['page_meta_description'] }}">
        @endif

                <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body id="app-layout">
<nav class="navbar navbar-default">
    <div class="container">
        <div class="navbar-header">

            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#emdlog-navbar-collapse">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <!-- Branding Image -->
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ env('APP_NAME') }}
            </a>
        </div>

        <div class="collapse navbar-collapse" id="emdlog-navbar-collapse">
            <ul class="nav navbar-nav">
                <li{!! request()->is('articles*') ? ' class="active"' : ''  !!}>
                    <a href="{{ url('/articles') }}">Blog</a>
                </li>
            </ul>

            <ul class="nav navbar-nav navbar-right">
                @if (!Auth::guest())
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                           aria-expanded="false">
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>

@yield('content')

{!! parsedown(get_footer()) !!}
<script>
    window.Emdlog = {
        csrfToken: '{{ csrf_token() }}'
    }
</script>
<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
