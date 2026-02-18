@extends('layouts.front_app')

@section('title')
    {{ $blog->name }} | WabePoint | Online PoS | Inventory Management System 
@endsection

@section('meta_title')
    {{ $blog->meta_title }}
@endsection

@section('meta_description')
    {{ $blog->meta_description }}
@endsection

@section('content')

<!-- Blog Details Area Start -->
<blog-details
            :blog='@json($blog)'
            :previous='@json($previous)'
            :next='@json($next)'
            :blog-posts='@json($blog_posts)'
            url="{{ Request::url() }}"
        ></blog-details>



       
@endsection

<!-- Add Custom CSS for Floating Share Buttons -->

