@extends('layouts.dashboard')

@section('page-header')
<div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title float-start mb-0">المواضيع</h2>
                <div class="breadcrumb-wrapper">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">الرئيسية</a>
                        </li>
                        <li class="breadcrumb-item"><a href="#">عرض المواضيع</a>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="content-header-right text-md-end col-md-3 col-12">
        <div class="mb-1 breadcrumb-right">
            {{-- زر العودة إلى قائمة المقالات --}}
            <a href="{{ route('blog.view') }}" class="btn btn-primary waves-effect waves-float waves-light">عودة للمقالات</a>
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
                            <img src="{{ asset($blog->main_image) }}" alt="{{ $blog->title }}">
                        </div>
                        <div class="card-body">
                            <h3 class="card-title text-center">{{ $blog->title }}</h3>
                            <p class="text-muted text-center">نشر في {{ $blog->created_at->format('d M Y') }}</p>

                            {{-- عرض محتوى المقال مع تنسيق HTML --}}
                            <div class="article-content">
                                {!! $blog->content !!}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <!-- show comments post -->
                    <div class="comments_box">
                        <h3>{{ $Allcomment->count() }} تعليق</h3>
                        @forelse ($Allcomment as $comment)
                            <div class="card">
                                <div class="card-body">
                                    <div class="comment-list">
                                        <div class="comment_num">{{ $loop->iteration }}</div>
                                        <div class="comment_box">
                                            <div class="comment-meta">
                                                <div class="comment_author">يقول {{ $comment->name }}:</div>
                                                <div class="comment_date">{{ \Carbon\Carbon::parse($comment->created_at)->format('d/m/Y \الساعة h:i A') }}</div>
                                            </div>
                                            <div class="comment_content">
                                                {{ $comment->comment }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <h3>لا يوجد اى تعليقات</h3>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

    </section>
@endsection
