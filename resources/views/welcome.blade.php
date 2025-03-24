@extends('layouts.app')

@section('title', 'Welcome to ELMOVIE')

@section('content')
    @include('components.home.hero')
    @include('components.home.call_popup')
    @include('components.home.call_to_action')
    @include('components.home.newsletter')
@endsection
