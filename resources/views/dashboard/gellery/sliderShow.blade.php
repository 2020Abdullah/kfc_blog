@extends('layouts.dashboard')

@section('css')
    <link rel="stylesheet" href="{{ asset('backend/vendors/css/forms/wizard/bs-stepper.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/css-rtl/plugins/forms/form-wizard.css') }}">
    @livewireStyles
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
@endsection

@section('page-header')
<div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title float-start mb-0">عرض الشرائح</h2>
                <div class="breadcrumb-wrapper">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">الرئيسية</a>
                        </li>
                        <li class="breadcrumb-item"><a href="#">تعديل المعرض</a>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')
<section id="slider_view">
    @if(session()->has('message'))
        <div class="alert alert-success">
            <div class="alert-body">
                {{ session('message') }}
            </div>
        </div>
    @endif
    <div class="sliderView">
        @livewire('slider-setting', ['sliderId' => $sliderId])
    </div>
</section>
@endsection


@section('js')
    @livewireScripts
    <script src="{{ asset('backend/js/slider.js') }}"></script>
@endsection