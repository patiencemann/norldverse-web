@extends('layouts.guest')

@section('title')
    {{ Auth::user()->name }}
@endsection

@section('content')
    <x-navigation-bar />
@endsection
