@extends('layouts.guest')

@section('page-title')
الأخبار
@endsection

@section('content')

<section id="kfc_allNews page_wrapper_container">
    <div class="heading_wrapper">
        <div class="container">
            <div class="heading_section">
                <h3>مركز البحث</h3>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item" aria-current="page">الرئيسية</li>
                      <li class="breadcrumb-item active">مركز البحث</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="container">
        <!-- search box -->
        <div class="serach-box">
            <div class="card">
                <div class="card-body">
                    <h4>البحث</h4>
                    <form action="{{ route('search') }}" method="GET">
                        @csrf
                        <input type="search" name="query" class="form-control search-input" placeholder="عنوان الخبر أو المحتوى">
                        <button type="submit" class="btn btn-primary">بحث</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- show result word -->
        <h3 class="word_result">نتائج البحث عن كلمة : {{ $query }}</h3>

        <!-- show News -->
        <div class="post_allnews_paper">
            <div class="post_news_paper_right">
                @forelse ($blogs as $blog)
                    <div class="card">
                        <div class="card-body">
                            <div class="card-image">
                                <img src="{{ asset($blog->main_image) }}" alt="img">
                            </div>
                            <div class="post_news_paper_content">
                                <a class="post_news_paper_link" href="{{ route('blogView', ['id' => $blog->id, 'slug' => Str::slug($blog->title)]) }}">
                                    <h3 class="post_news_paper_title">
                                        {{ $blog->title }}
                                    </h3>
                                </a>
                                <p class="post_news_paper_date">
                                    @php
                                        $date = \Alkoumi\LaravelHijriDate\Hijri::Date('j / m / Y هـ', $blog->created_at);
                                    @endphp
                                    <i class="fa fa-calendar"></i>
                                    <span>تاريخ النشر: {{ $date }}</span>
                                </p>
                                <p class="post_news_paper_info">
                                    {!!  Str::limit($blog->content, 250, '...') !!}
                                </p>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="card">
                        <div class="card-body text-center">
                            <h3>لا توجد اى أخبار مرتبطة ببحثك</h3>
                        </div>
                    </div>
                @endforelse
                <div class="page_num">
                    {{ $blogs->links() }}
                </div>
            </div>
        </div>
    </div>
</section>

@endsection


