<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header bg-dark mt-2">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item me-auto"><a class="navbar-brand" href="../../../html/rtl/vertical-menu-template/index.html"><span class="brand-logo">
                <x-logo-component />
            </li>
            <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pe-0" data-bs-toggle="collapse"><i class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i><i class="d-none d-xl-block collapse-toggle-icon font-medium-4  text-primary" data-feather="disc" data-ticon="disc"></i></a></li>
        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class="nav-item active">
                <a class="d-flex align-items-center" href="{{ route('dashboard') }}">
                    <i class="fa fa-home"></i>
                    <span class="menu-title text-truncate">
                        الرئيسية
                    </span>
                </a>
            </li>

            <li class=" nav-item">
                <a class="d-flex align-items-center" href="{{ route('slider.index') }}">
                    <i class="fa fa-newspaper"></i>
                    <span class="menu-title text-truncate">
                        المعرض
                    </span>
                </a>
            </li>

            <li class=" nav-item">
                <a class="d-flex align-items-center" href="{{ route('category.view') }}">
                    <i class="fa fa-list-alt"></i>
                    <span class="menu-title text-truncate">
                        التصنيفات
                    </span>
                </a>
            </li>

            <li class=" nav-item">
                <a class="d-flex align-items-center" href="{{ route('blog.view') }}">
                    <i class="fa fa-newspaper"></i>
                    <span class="menu-title text-truncate">
                         الأخبار
                    </span>
                </a>
            </li>

            <li class=" nav-item">
                <a class="d-flex align-items-center" href="{{ route('page.view') }}">
                    <i data-feather='package'></i>
                    <span class="menu-title text-truncate">
                        الصفحات 
                    </span>
                </a>
            </li>

        </ul>
    </div>
</div>
