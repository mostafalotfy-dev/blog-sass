@extends("layouts.app")

@section("content")
    @include("auth.login")
    @include("auth.register")
    @include("posts.index")
    @include("posts.single")
    @auth
    @include("profile.index")
    @endauth
@endsection
