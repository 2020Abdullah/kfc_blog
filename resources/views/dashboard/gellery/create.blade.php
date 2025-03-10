@extends('layouts.dashboard')

@section('css')
    <link rel="stylesheet" href="{{ asset('backend/vendors/css/forms/wizard/bs-stepper.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/css-rtl/plugins/forms/form-wizard.css') }}">
    @livewireStyles
@endsection

@section('page-header')
<div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title float-start mb-0">إنشاء معرض</h2>
                <div class="breadcrumb-wrapper">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">الرئيسية</a>
                        </li>
                        <li class="breadcrumb-item"><a href="#">إنشاء معرض</a>
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
    <div class="row">
        <div class="col-md-12">
            @livewire('slider-create')
        </div>
    </div>
</section>
@endsection


@section('js')
    @livewireScripts
@endsection