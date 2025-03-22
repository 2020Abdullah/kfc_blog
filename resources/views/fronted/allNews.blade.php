@extends('layouts.guest')

@section('page-title')
الأخبار
@endsection

@section('content')

<section id="kfc_allNews page_wrapper_container">
    <div class="heading_wrapper">
        <div class="container">
            <div class="heading_section">
                <h3>الأخبار الرئيسية</h3>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item" aria-current="page">
                        <a class="link" href="{{ route('home') }}">الرئيسية</a>
                      </li>
                      <li class="breadcrumb-item active">الأخبار الرئيسية</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="container">
        <!-- pages_links -->
        <nav class="pages_links">
            <ul class="nav">
                @foreach($Newspages as $page)
                    <li class="nav-item"><a class="nav-link" href="{{ route('pageView', ['id' => $page->id, 'slug' => Str::slug($page->title)]) }}">{{ $page->title }}</a></li>
                @endforeach
            </ul>
        </nav>
        <!-- search box -->
        <div class="serach-box">
            <div class="card">
                <div class="card-body">
                    <h4>البحث</h4>
                    <form action="#">
                        @csrf
                        <input type="search" class="form-control search-input" placeholder="عنوان الخبر أو المحتوى">
                        <button type="submit" class="btn btn-primary">بحث</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- show News -->
        <div class="post_allnews_paper">
            <div class="post_news_paper_right">
                @forelse ($allNews as $news)
                    <div class="card">
                        <div class="card-body">
                            <div class="card-image">
                                <img src="{{ asset($news->main_image) }}" alt="img">
                            </div>
                            <div class="post_news_paper_content">
                                <a class="post_news_paper_link" href="{{ route('blogView', ['id' => $news->id, 'slug' => Str::slug($news->title)]) }}">
                                    <h3 class="post_news_paper_title">
                                        {{ $news->title }}
                                    </h3>
                                </a>
                                <p class="post_news_paper_date">
                                    @php
                                        $date = \Alkoumi\LaravelHijriDate\Hijri::Date('j / m / Y هـ', $news->created_at);
                                    @endphp
                                    <i class="fa fa-calendar"></i>
                                    <span>تاريخ النشر: {{ $date }}</span>
                                </p>
                                <p class="post_news_paper_info">
                                    {!!  Str::limit($news->content, 250, '...') !!}
                                </p>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="card">
                        <div class="card-body text-center">
                            <h3>لا توجد اى أخبار حتي الآن</h3>
                        </div>
                    </div>
                @endforelse
                <div class="page_num">
                    {{ $allNews->links() }}
                </div>
            </div>
        </div>
    </div>
</section>

@endsection


