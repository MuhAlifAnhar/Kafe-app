@extends('frontend.template.main')

@section('title', 'Beranda')

@section('content')
    <!-- Hero Start -->
    @include('frontend._hero')
    </section>
    <!-- Hero End -->

    <!-- About Start -->
    @include('frontend._about')
    <!-- About End -->

    <!-- Service Start -->
    @include('frontend._service')
    <!-- Service End -->

    <!-- Events Start -->
    @include('frontend._event')
    <!-- Events End -->

    <!-- Menu Start -->
    @include('frontend._menu')
    <!-- Menu End -->

    <!-- Book Us Start -->
    @include('frontend._book')
    <!-- Book Us End -->

    <!-- Team Start -->
    @include('frontend._chef-team')
    <!-- Team End -->

    <!-- Testimonial Start -->
    @include('frontend._testimonial')
    <!-- Testimonial End -->

    <!-- Blog Start -->
    @include('frontend._blog')
    <!-- Blog End -->
@endsection
