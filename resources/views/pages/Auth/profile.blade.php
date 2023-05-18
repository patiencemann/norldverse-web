@extends('layouts.app')

@section('title')
    {{ Auth::user()->name }}
@endsection

@section('content')
    <x-navigation-bar />
@endsection
