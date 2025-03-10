@extends('layouts.dashboard')

@section('page-header')
<div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title float-start mb-0">{{ $page->title }}</h2>
                <div class="breadcrumb-wrapper">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">الرئيسية</a>
                        </li>
                        <li class="breadcrumb-item"><a href="#">{{ $page->title }}</a>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="content-header-right text-md-end col-md-3 col-12">
        <div class="mb-1 breadcrumb-right">
            <a href="{{ route('page.view') }}" class="btn btn-primary waves-effect waves-float waves-light">عودة للصفحات</a>
        </div>
    </div>
</div>
@endsection

@section('content')
    <section id="blogView">
        <!-- show blog -->
        <div class="blog-wrapper">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card shadow">
                        <div class="card-image">
                            <img src="{{ asset($page->main_image) }}" alt="{{ $page->title }}">
                        </div>
                        <div class="card-body">
                            <h3 class="card-title text-center">{{ $page->title }}</h3>
                            <p class="text-muted text-center">نشر في {{ $page->created_at->format('d M Y') }}</p>

                            {{-- عرض محتوى المقال مع تنسيق HTML --}}
                            <div class="article-content">
                                {!! $page->content !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
@endsection
