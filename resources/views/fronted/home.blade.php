@extends('layouts.guest')

@section('page-title')
جامعة الملك فيصل
@endsection

@section('content')
<!-- hero section -->
<section class="hero_section">
    <div class="container">
        <div class="hero_section_wrapper">
          <div class="row">
            <div class="col-md-6">
                <div class="row">
  
                <div class="col-12">
                  <!-- Hero Slider Text -->
                  <div id="hero-sliderText-container">
                    <div class="owl-carousel owl-hero-thumb owl-theme owl-rtl owl-loaded" id="sliderText"></div>
                  </div>
                </div>
                  
                  <div class="col-12">
                      <div class="owl-carousel owl-hero-thumb owl-theme owl-rtl owl-loaded">
                        <!-- Hero Slider 2 -->
                        <div id="hero-sliderHero3-container">
                          <div class="owl-carousel owl-hero-thumb owl-theme owl-rtl owl-loaded" id="sliderHero3"></div>
                        </div>
                    </div>
                  </div>
                </div>
            </div>
            <div class="col-md-6">
              <!-- Hero Slider 2 -->
              <div class="hero-sliderHero2-container">
                <div class="owl-carousel owl-hero-thumb owl-theme owl-rtl owl-loaded" id="sliderHero2"></div>
              </div>
            </div>
          </div>
        </div>
    </div>
</section>
<!-- News latest blogs -->
<section class="NewsBlogs">
    <div class="container">
        <div class="section-heading section">
            <h3>الأخبار الرئيسية</h3>
        </div>
        <div class="blog_latest">
            <div class="owl-carousel owl-blog owl-theme owl-rtl owl-loaded main_News">
                <div class="owl-stage-outer">
                    <div class="owl-stage">
                        @foreach ($blogs as $blog)
                            <div class="owl-item">
                            <div class="card">
                                <div class="card-image">
                                    <img src="{{ asset($blog->main_image) }}" alt="{{ $blog->title }}">
                                </div>
                                <div class="card-body">
                                    <h3>{{ $blog->title }}</h3>
                                </div>
                                <div class="card-footer">
                                    <a class="link" href="{{ route('blogView', ['id' => $blog->id, 'slug' => Str::slug($blog->title)]) }}">اقرأ المزيد ...</a>
                                </div>
                            </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- News spotlight blogs -->
<section class="spotlight section2">
    <div class="container">
        <div class="section-heading">
            <h3 class="spotlight_slider_heading">تحت الضوء</h3>
        </div>
        <div class="blog">
            <div id="spotlight_slider_wrapper">
                <div class="owl-carousel owl-hero-thumb owl-theme owl-rtl owl-loaded spotlight_slider"></div>
            </div>
        </div>
    </div>
</section>

<!-- News blog with Category -->
<section class="UniversityNews section">
    <div class="container">
        <div class="section-heading">
            <h3>أخبار الجامعة</h3>
        </div>
        <div class="blogs">
            <div class="owl-carousel owl-blog-item owl-theme owl-rtl owl-loaded News_Channel">
                <div class="owl-stage-outer">
                    <div class="owl-stage">
                        @foreach ($blogs as $blog)
                            <div class="owl-item">
                            <div class="card">
                                <div class="card-image">
                                    <img class="News_img" src="{{ asset($blog->main_image) }}" alt="{{ $blog->title }}">
                                </div>
                                <div class="card-body">
                                    <h3>{{ $blog->title }}</h3>
                                </div>
                                <div class="card-footer">
                                    <a class="link" href="{{ route('blogView', ['id' => $blog->id, 'slug' => Str::slug($blog->title)]) }}">اقرأ المزيد ...</a>
                                </div>
                            </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!--Electronic services -->
<section class="ourServices section2">
    <div class="container">
        <div class="section-heading">
            <h3 class="Service_heading">الخدمات الإلكترونية</h3>
        </div>
        <div class="Service_wrapper">
            <div class="owl-carousel owl-blog-item owl-theme owl-rtl owl-loaded Service_slider"></div>
        </div>
    </div>
</section>

<!--Channel youtube -->
<section class="ChannelYoutube section">
    <div class="container">
        <div class="section-heading">
            <h3 class="ChannelYoutubeHeading">قناة الجامعة</h3>
        </div>
        <div class="ChannelSlider_wrapper">
            <div class="owl-carousel owl-blog-item owl-theme owl-rtl owl-loaded ChannelSlider"></div>
        </div>
    </div>
</section>

<!--Channel youtube -->
{{-- <section class="Data section2">
    <div class="container">
        <div class="section-heading">
            <h3>البيانات المفتوحة</h3>
        </div>
        <div class="owl-carousel owl-blog-item owl-theme owl-rtl owl-loaded">
            <div class="owl-stage-outer">
                <div class="owl-stage">
                    @foreach ($blogs as $blog)
                        <div class="owl-item">
                            <a class="link" href="#">
                                <div class="card">
                                    <div class="card-image">
                                    </div>
                                    <div class="card-body">
                                        <div class="item_box">
                                            <img src="{{ asset($blog->main_image) }}" alt="{{ $blog->title }}">
                                            <h3>{{ $blog->title }}</h3>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section> --}}
@endsection

