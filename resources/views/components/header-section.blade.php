 <!-- header Top -->
 <header class="top-header">
  <nav class="nav nav-pages">
    @foreach($headerLinks as $link)
      <li class="nav-item"><a class="nav-link" href="{{ route('pageView', ['id' => $link->id, 'slug' => Str::slug($link->title)]) }}" class="mx-2">{{ $link->title }}</a></li>
    @endforeach
  </nav>
  <div class="dateToday">
      <span>{{ $hijriDate }}</span>
  </div>
  <div class="header_pages_left">
      <a href="#" class="btn btn-outline btn-sm mx-2">EN</a>
      <a class="link" href="{{ route('login') }}">
        <i class="fa fa-user"></i>
      </a>
  </div>
</header>

<!-- main header -->
<nav class="main_nav navbar navbar-expand-lg">
  <div class="container">
    <div class="menu_wrapper">
        <a class="navbar-brand" href="{{ url('/') }}">
          <x-logo-component/>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" href="#mobileMenu" role="button" aria-controls="offcanvasExample">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- desktop menu -->
        <div class="main_menu_links">
            <ul class="nav navbar-nav">
              @foreach($categories as $cate)
                <li class="nav-item">
                  @if($cate->blogs->count() > 0)
                    <a class="nav-link toggle-menu" href="#">{{ $cate->name }}</a>
                    <div class="mega-menu">
                        <div class="row">
                                @foreach($cate->blogs->chunk(4) as $chunk)
                                    <div class="col-md-4">
                                      <div class="mega-item">
                                        <ul>
                                            @foreach($chunk as $blog)
                                            <li><a href="{{ route('blogView', ['id' => $blog->id, 'slug' => Str::slug($blog->title)]) }}">{{ $blog->title }}</a></li>
                                            @endforeach
                                        </ul>
                                      </div>
                                    </div>
                                @endforeach
                        </div>
                    </div>
                  @else 
                    <a class="nav-link" href="#">{{ $cate->name }}</a>
                  @endif
                </li>
              @endforeach
            </ul>
        </div>

        <div class="nav navbar accessibility_icons">
            <div class="dropdown">
              <button class="btn btn-icon" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fa fa-search"></i>
              </button>
              <ul class="dropdown-menu asset_menu_mega">
                <li>
                  <a class="dropdown-item" href="#">
                    <div class="asset_icon_mega">
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
                    </div>
                  </a>
                </li>
              </ul>
            </div>
{{-- 
            <div class="dropdown">
              <button class="btn btn-icon" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fa fa-wheelchair-move"></i>
              </button>
              <ul class="dropdown-menu">
                <div class="row">
                    <div class="col-md-4">
                      <a href="#">
                        <span class="hide-element">  
                           تمكين التباين
                        </span>
                        <i class="fa fa-adjust"></i>
                      </a>
                    </div>
                    <div class="col-md-4">
                      <a href="#">
                        <span class="hide-element">  
                            قراءة النص
                        </span>
                        <i class="fa fa-adjust"></i>
                      </a>
                    </div>
                    <div class="col-md-4">
                      <a href="#">
                        <span class="hide-element">  
                            تكبير الخط
                        </span>
                        <i class="fa fa-zoom-in"></i>
                      </a>
                    </div>
                </div>
              </ul>
            </div>
            
            <div class="dropdown">
              <button class="btn btn-icon" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fa fa-envelope"></i>
              </button>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#">Action</a></li>
                <li><a class="dropdown-item" href="#">Another action</a></li>
                <li><a class="dropdown-item" href="#">Something else here</a></li>
              </ul>
            </div> --}}
        </div>
        <!-- end desktop menu -->

        <!-- mobile menu -->
        <div class="offcanvas offcanvas-start d-lg-none" tabindex="-1" id="mobileMenu" aria-labelledby="mobileMenuLabel">
          <div class="offcanvas-header">
            <h5 class="offcanvas-title headerTop">
              <div class="dateToday">
                  <span>{{ $hijriDate }}</span>
              </div>
            </h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
          </div>
          <div class="offcanvas-body">
            <nav class="nav nav-pages">
              @foreach($headerLinks as $link)
                <li class="nav-item"><a class="nav-link" href="{{ route('pageView', ['id' => $link->id, 'slug' => Str::slug($link->title)]) }}" class="mx-2">{{ $link->title }}</a></li>
              @endforeach
            </nav>
            <hr />
            <div class="nav accessibility_icons">
              <div class="dropdown">
                <button class="btn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                  <i class="fa fa-search"></i>
                </button>
                <ul class="dropdown-menu">
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
                </ul>
              </div>

              {{-- <div class="dropdown">
                <button class="btn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                  <i class="fa fa-wheelchair-move"></i>
                </button>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="#">Action</a></li>
                  <li><a class="dropdown-item" href="#">Another action</a></li>
                  <li><a class="dropdown-item" href="#">Something else here</a></li>
                </ul>
              </div>
              
              <div class="dropdown">
                <button class="btn" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                  <i class="fa fa-envelope"></i>
                </button>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="#">Action</a></li>
                  <li><a class="dropdown-item" href="#">Another action</a></li>
                  <li><a class="dropdown-item" href="#">Something else here</a></li>
                </ul>
              </div> --}}

            </div>
            <hr />
            <ul class="nav navbar-nav">
              @foreach($categories as $cate)
                <li class="nav-item">
                  @if($cate->blogs->count() > 0)
                    <a class="nav-link toggle-menu" href="#">{{ $cate->name }}</a>
                    <div class="mega-menu">
                        <div class="row">
                                @foreach($cate->blogs->chunk(4) as $chunk)
                                    <div class="col-md-4">
                                      <div class="mega-item">
                                        <ul>
                                            @foreach($chunk as $blog)
                                            <li><a href="#">{{ $blog->title }}</a></li>
                                            @endforeach
                                        </ul>
                                      </div>
                                    </div>
                                @endforeach
                        </div>
                    </div>
                  @else 
                    <a class="nav-link" href="#">{{ $cate->name }}</a>
                  @endif
                </li>
              @endforeach
            </ul>
          </div>
        </div>
    </div>
  </div>
</nav>
