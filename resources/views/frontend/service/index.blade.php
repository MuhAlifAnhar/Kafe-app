@extends('frontend.template.main')

@section('title', 'Layanan Kami')

@section('content')
{{-- Breadcrumb --}}
<div class="container-fluid py-4 my-4 mt-0">
    <div class="container animated bounceInDown">
        <h1 class="display-6 mb-4">Layanan Kami</h1>
        <ol class="breadcrumb mb-0 animated bounceInDown">
            <li class="breadcrumb-item">
                <div>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-house-door" viewBox="0 0 16 16">
                        <path
                            d="M8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4.5a.5.5 0 0 0 .5-.5v-4h2v4a.5.5 0 0 0 .5.5H14a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293zM2.5 14V7.707l5.5-5.5 5.5 5.5V14H10v-4a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5v4z" />
                    </svg>
                </div>
            </li>
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Beranda</a></li>
            <li class="breadcrumb-item active" aria-current="page">Layanan</li>
        </ol>

        <div role="separator" class="dropdown-divider pt-1 mt-4 border-secondary"></div>
    </div>
</div>

@include('frontend._service')

@include('frontend._testimonial')

@include('frontend._form-testimonial')

@endsection
