<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content=""/>
    <meta name="author" content=""/>
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <base href="/">
    <link rel="stylesheet" href="https://unpkg.com/nprogress@0.2.0/nprogress.css">
    <script src="https://unpkg.com/nprogress@0.2.0/nprogress.js"></script>
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body x-data="app">
<div id="app">

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#!">Blog</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">


                    <li class="nav-item">
                        @auth
                            <form action="{{route("logout")}}" method="post">
                                @csrf
                                <input type="submit" class="btn btn-primary btn-info" value="@lang("Logout")">
                            </form>

                        @else
                            <a href="/login" class="nav-link">@lang("Login")</a>

                    </li>
                    <li class="nav-item"> <a href="/register" class="nav-link">@lang("Register")</a></li>
                    @endauth
                    <template  x-if="isAuthorized()">
                        <li class="nav-item"><a class="nav-link"  href="/profile">Profile</a></li>
                    </template>
                    <template  x-if="isAuthorized()">
                        <li class="nav-item"><a class="nav-link active" aria-current="page" href="/"
                            >Blog</a></li>
                    </template>
                </ul>
            </div>
        </div>
    </nav>

    <header class="py-5 bg-light border-bottom mb-4">
        <div class="container">
            <div class="text-center my-5">
                <h1 class="fw-bolder">Welcome to Blog Home!</h1>
                <p class="lead mb-0">Homepage</p>
            </div>
        </div>
    </header>

        <div class="container">
            @yield("content")
        </div>


</div>

</body>
</html>
@stack("scripts")
<script src="//unpkg.com/alpinejs" defer></script>

