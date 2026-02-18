@extends('layouts.front_app')
@section('title')
WabePoint | Online PoS | Inventory Management System 
@endsection

@php
    use App\Models\Blog;
    $blogs = Blog::get();
@endphp

@section('content')
{{$blogs}}
    <blog :blogs='@json($blogs ?? [])'></blog>
@endsection
