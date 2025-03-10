@extends('layouts.guest')

@section('page-title')
{{ $post->title }}
@endsection

@section('meta-social')
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta property="og:title" content="{{ $post->title }}" />
<meta property="og:description" content="{{ Str::limit(strip_tags($post->content), 150) }}" />
<meta property="og:image" content="{{ asset($post->main_image) }}" />
<meta property="og:url" content="{{ request()->url() }}" />
<meta property="og:type" content="article" />
@endsection

@section('content')

<section id="kfc_post">
    <div class="heading_wrapper">
        <div class="container">
            <div class="heading_section">
                <h3>التفاصيل</h3>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item" aria-current="page">الرئيسية</li>
                      <li class="breadcrumb-item active" aria-current="page">{{ $post->title }}</li>
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
                            <img src="{{ asset($post->main_image) }}" alt="{{ $post->title }}">
                        </div>
                        <div class="card-body post_view">
                            <div class="post-header">
                                <h3 class="post-heading">{{ $post->title }}</h3>
                                <div class="post-meta">
                                    <button onclick="printSpecificContent('.post_view')" class="print-btn">طباعة الخبر</button>
                                    <span id="hijri-date">تاريخ النشر : {{ $hijriDate }}</span>
                                </div>
                                <div class="post-content">
                                    {!! $post->content !!}
                                </div>
                            </div>
                        </div>
                    </div>

                    @if ($nextArticle)
                        <div class="post_Next">
                            <div class="section-heading">
                                <h3>تابع القراءة </h3>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <a href="#" class="post_box_right">
                                        <div class="card-image">
                                            <img src="{{ asset($nextArticle->main_image) }}" alt="{{ $nextArticle->title }}">
                                        </div>
                                        <div class="post_meta">
                                            <h4 class="news_repeater_title">{{ $nextArticle->title }}</h4>
                                            <span class="news_repeater_date"> {{ \Carbon\Carbon::parse($nextArticle->created_at)->format('Y/m/d') }}</span>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="News_latest">
                        <div class="section-heading">
                            <h3>أحدث الأخبار</h3>
                        </div>
                        <div class="row">
                            @foreach ($latestArticles as $art)
                                <div class="col-md-4">
                                    <div class="card post_card">
                                        <div class="card-body">
                                            <div class="card-image">
                                                <img src="{{ asset($art->main_image) }}" alt="{{ $art->title }}">
                                            </div>

                                            <h3 class="post_title">
                                                <a href="{{ route('blog.show', ['id' => $art->id, 'slug' => Str::slug($art->title)]) }}">{{ $art->title }}</a>
                                            </h3>
                                
                                            <p class="post_info">{!! Str::limit($art->content, 100) !!}</p>
                                            <a class="Readmore" href="{{ route('blog.show', ['id' => $art->id, 'slug' => Str::slug($art->title)]) }}" class="text-green-600 font-semibold mt-3 block">إقرأ المزيد</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="allNews">
                            <a href="{{ route('allNews') }}" class="btn btn-primary">
                                المزيد من الأخبار
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- sidebar -->
            <div class="col-md-4">
                <div class="sidebar-wrapper">
                    <div class="card">
                        <div class="card-body">
                            <div class="serach-box">
                                <h4>البحث</h4>
                                <form action="{{ route('search') }}" method="GET">
                                    @csrf
                                    <input type="search" name="query" class="form-control search-input" placeholder="عنوان الخبر أو المحتوى">
                                    <button type="submit" class="btn btn-primary">بحث</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="share-box text-center">
                                <h4 class="share-title">نشر الخبر عن طريق</h4>
                                <hr>
                                <div class="social-icons">
                                    <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(request()->url()) }}" target="_blank" class="linkedin">
                                        <i class="fab fa-linkedin-in"></i>
                                    </a>
                                    <a href="https://t.me/share/url?url={{ urlencode(request()->url()) }}" target="_blank" class="telegram">
                                        <i class="fab fa-telegram-plane"></i>
                                    </a>
                                    <a href="https://wa.me/?text={{ urlencode(request()->url()) }}" target="_blank" class="whatsapp">
                                        <i class="fab fa-whatsapp"></i>
                                    </a>
                                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}" target="_blank" class="facebook">
                                        <i class="fab fa-facebook-f"></i>
                                    </a>
                                    <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}" target="_blank" class="twitter">
                                        <i class="fab fa-x-twitter"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="posts-box">
                                <h3>الملف الصحفي</h3>
                                <hr/>
                                @foreach ($articles as $article)
                                    <a href="#" class="post_news_paper">
                                        <div class="post_news_paper_head">
                                            <h3 class="post_news_paper_title">وكالة الأنباء السعودية</h3>
                                            <span class="post_news_paper_date">{{ \Carbon\Carbon::parse($article->created_at)->format('Y/m/d') }}</span>
                                        </div>
                                        <p class="post_news_paper_info">
                                            {{ Str::limit($article->title, 60)  }}
                                        </p>
                                    </a>
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


