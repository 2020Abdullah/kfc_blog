@extends('layouts.guest')

@section('page-title')
{{ $page->title }}
@endsection

@section('meta-social')
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta property="og:title" content="{{ $page->title }}" />
<meta property="og:description" content="{{ Str::limit(strip_tags($page->content), 150) }}" />
<meta property="og:image" content="{{ asset($page->main_image) }}" />
<meta property="og:url" content="{{ request()->url() }}" />
<meta property="og:type" content="article" />
@endsection

@section('content')

<section id="kfc_post">
    <div class="heading_wrapper">
        <div class="container">
            <div class="heading_section">
                <h3>{{ $page->title }}</h3>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item" aria-current="page">الرئيسية</li>
                      <li class="breadcrumb-item active" aria-current="page">{{ $page->title }}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <!-- post view -->
            <div class="col-md-8">
                <div class="post-wrapper">
                    <div class="card">
                        <div class="card-image">
                            <img src="{{ asset($page->main_image) }}" alt="{{ $page->title }}">
                        </div>
                        <div class="card-body post_view">
                            <div class="post-header">
                                <h3 class="post-heading">{{ $page->title }}</h3>
                                <div class="post-meta">
                                    <span id="hijri-date">تاريخ النشر : {{ $hijriDate }}</span>
                                </div>
                                <div class="post-content">
                                    {!! $page->content !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- sidebar -->
            <div class="col-md-4">
                <div class="sidebar-wrapper">
                    <!-- nav links pages -->
                    <div class="card">
                        <div class="card-header">
                            <h3>الصفحات</h3>
                        </div>
                        <div class="card-body">
                            <div class="list-group list-group-flush">
                                @foreach($pages as $page)
                                    <li class="list-group-item">
                                        <a class="link" href="{{ route('pageView', ['id' => $page->id, 'slug' => Str::slug($page->title)]) }}" class="mx-2">{{ $page->title }}</a>
                                    </li>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@section('script')
<script>
function printSpecificContent(className) {
    let printContents = document.querySelector(className).innerHTML;
    let originalContents = document.body.innerHTML;

    document.body.innerHTML = printContents; // استبدال محتوى الصفحة بالمحتوى المطلوب طباعته
    window.print(); // تشغيل الطباعة
    document.body.innerHTML = originalContents; // إعادة المحتوى الأصلي بعد الطباعة
}
</script>
@endsection


