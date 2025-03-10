@extends('layouts.dashboard')

@section('page-header')
<div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title float-start mb-0">الأخبار</h2>
                <div class="breadcrumb-wrapper">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">الرئيسية</a>
                        </li>
                        <li class="breadcrumb-item"><a href="#">عرض الأخبار</a>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="content-header-right text-md-end col-md-3 col-12">
        <div class="mb-1 breadcrumb-right">
            <a class="btn btn-primary waves-effect waves-float waves-light" href="{{ route('blog.add') }}">إضافة خبر جديد</a>
        </div>
    </div>
</div>
@endsection

@section('content')
    <section id="blogView">
        <!-- show blog -->
        <div class="blog-list-wrapper">
            <div class="row">
                @forelse ($blogs as $blog)
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-image">
                                <a href="{{ route('blog.show', $blog->id) }}">
                                    <img class="card-img-top" src="{{ asset($blog->main_image) }}" alt="{{ $blog->title }}">
                                </a>
                            </div>
                            <div class="card-body">
                                {{-- عنوان المقال --}}
                                <h5 class="card-title">{{ $blog->title }}</h5>
                                
                                {{-- يمكنك عرض جزء من المحتوى إن أردت --}}
                                <p class="card-text">
                                    {{ Str::limit(strip_tags($blog->content), 100) }}
                                </p>
                        
                                <a href="{{ route('blog.show', $blog->id) }}" class="btn btn-primary">
                                    <i data-feather="eye"></i>
                                </a>

                                <a href="{{ route('blog.edit', $blog->id) }}" class="btn btn-success">
                                    <i data-feather="edit-2"></i>
                                </a>

                                <a href="{{ route('blog.show', $blog->id) }}" class="btn btn-danger delBtn" data-id="{{ $blog->id }}" data-bs-toggle="modal" data-bs-target="#DelModel">
                                    <i data-feather="trash"></i>
                                </a>

                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body text-center">
                                <h3>لا توجد اى أخبار مضافة</h3>
                            </div>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
    <!-- model delete -->
    @include('dashboard.blog.Mdel')
@endsection


@section('js')
<script>
    $(".delBtn").on('click', function(){
        let blog_id = $(this).attr('data-id')
        $("#DelModel .blog_id").val(blog_id);
    })
</script>
@endsection