@extends('layouts.dashboard')

@section('page-header')
<div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title float-start mb-0">لوحة التحكم</h2>
                <div class="breadcrumb-wrapper">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">عرض الإحصائيات</a>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')
    <section id="dashboard">       
        <!-- show dashboard -->
        <div class="row">
            <div class="col">
                <div class="card text-center">
                    <div class="card-header">
                        <h3>التصنيفات</h3>
                    </div>
                    <div class="card-body">
                        <h3>{{ $categoryCount }}</h3>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card text-center">
                    <div class="card-header">
                        <h3>الأخبار</h3>
                    </div>
                    <div class="card-body">
                        <h3>{{ $blogCount }}</h3>
                    </div>
                </div>
            </div>
        </div>

        <!-- show setting -->
        <div class="card">
            <div class="card-header">
                <h3>إعدادات الموقع</h3>
            </div>
            <form action="{{ route('update.data') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @if ($siteInfo == null)
                    <div class="card-body">
                        <ul class="nav nav-tabs" role="tablist">                            
                            <li class="nav-item">
                                <a class="nav-link active" id="site-tab" data-bs-toggle="tab" href="#site" aria-controls="home" role="tab" aria-selected="false">معلومات الموقع</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="social-tab" data-bs-toggle="tab" href="#social" aria-controls="social" role="tab" aria-selected="true">صفحات التواصل</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="appDwonload-tab" data-bs-toggle="tab" href="#appDwonload" aria-controls="appDwonload" role="tab" aria-selected="true">معلومات عن التطبيق</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="profile-tab" data-bs-toggle="tab" href="#profile" aria-controls="profile" role="tab" aria-selected="true">ملفك الشخصي</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="site" aria-labelledby="site-tab" role="tabpanel">
                                <div class="mb-2">
                                    <label for="site_name" class="form-label">اسم الموقع</label>
                                    <input type="text" id="site_name" name="site_name" class="form-control">
                                </div>

                                <div class="mb-2">
                                    <label for="site_logo" class="form-label">اللوجو</label>
                                    <input type="file" id="site_logo" name="site_logo" class="form-control">
                                </div>

                                <div class="mb-2">
                                    <label for="address" class="form-label">العنوان (اختيارى)</label>
                                    <input type="text" id="address" name="address" class="form-control">
                                </div>

                                <div class="mb-2">
                                    <label for="site_email" class="form-label">البريد الإلكتروني الخاص بالموقع (اختيارى)</label>
                                    <input type="text" id="site_email" name="site_email" class="form-control">
                                </div>

                                <div class="mb-2">
                                    <label for="zip_code" class="form-label">الرمز البريدى (اختيارى)</label>
                                    <input type="text" id="zip_code" name="zip_code" class="form-control">
                                </div>

                            </div>

                            <div class="tab-pane" id="social" aria-labelledby="social-tab" role="tabpanel">
                                <div class="mb-2">
                                    <label for="intagram_link" class="form-label">انستجرام</label>
                                    <input type="text" id="intagram" name="intagram_link" placeholder="https://www.instagram.com/turki_t696/" class="form-control">
                                </div>
                                <div class="mb-2">
                                    <label for="linkedin_link" class="form-label">لينكد ان</label>
                                    <input type="text" id="snapchat" name="linkedin_link" placeholder="https://www.linkedin.com/in/user/" class="form-control">
                                </div>
                                <div class="mb-2">
                                    <label for="snapchat_link" class="form-label">سناب شات</label>
                                    <input type="text" id="snapchat" name="snapchat_link" placeholder="https://www.snapchat.com/add/turki-t696" class="form-control">
                                </div>
                                <div class="mb-2">
                                    <label for="youtube_link" class="form-label">قناة اليوتيوب</label>
                                    <input type="text" id="youtube_link" name="youtube_link" placeholder="https://www.youtube.com/channel" class="form-control">
                                </div>
                                <div class="mb-2">
                                    <label for="twitter_link" class="form-label">منصة اكس</label>
                                    <input type="text" id="twitter_link" name="twitter_link" placeholder="https://x.com/user" class="form-control">
                                </div>
                                <div class="mb-2">
                                    <label for="phone_number" class="form-label">رقم الجوال</label>
                                    <input type="text" id="phone_number" name="phone_number" placeholder="xxxxxxxxxx" class="form-control">
                                </div>
                                <div class="mb-2">
                                    <label for="whatsUp_number" class="form-label">رقم الواتساب</label>
                                    <input type="text" id="whatsUp_number" name="whatsUp_number" placeholder="xxxxxxxxxx" class="form-control">
                                </div>
                            </div>

                            <div class="tab-pane" id="appDwonload" aria-labelledby="appDwonload-tab" role="tabpanel">
                                <div class="mb-2">
                                    <label for="google_play" class="form-label">لينك تحميل تطبيقك علي جوجل بلاى</label>
                                    <input type="text" id="google_play" name="google_play" class="form-control">
                                </div>
                                <div class="mb-2">
                                    <label for="app_store" class="form-label">لينك تحميل تطبيقك علي ابل ستور</label>
                                    <input type="text" id="app_store" name="app_store" class="form-control">
                                </div>
                            </div>

                            <div class="tab-pane" id="profile" aria-labelledby="profile-tab" role="tabpanel">
                                <div class="mb-2">
                                    <label for="name" class="form-label">اسمك</label>
                                    <input type="text" id="name" name="name" value="{{ auth()->user()->name }}" class="form-control">
                                </div>
                                <div class="mb-2">
                                    <label for="email" class="form-label">بريدك الإلكتروني</label>
                                    <input type="email" id="email" name="email" value="{{ auth()->user()->email }}" class="form-control">
                                </div>
                                <div class="mb-2">
                                    <label for="pass" class="form-label">كلمة السر</label>
                                    <input type="password" id="pass" placeholder="***********" name="pass" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                @else 
                    <div class="card-body">
                        <ul class="nav nav-tabs" role="tablist">                            
                            <li class="nav-item">
                                <a class="nav-link active" id="site-tab" data-bs-toggle="tab" href="#site" aria-controls="home" role="tab" aria-selected="false">معلومات الموقع</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="social-tab" data-bs-toggle="tab" href="#social" aria-controls="social" role="tab" aria-selected="true">صفحات التواصل</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="appDwonload-tab" data-bs-toggle="tab" href="#appDwonload" aria-controls="appDwonload" role="tab" aria-selected="true">معلومات عن التطبيق</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="profile-tab" data-bs-toggle="tab" href="#profile" aria-controls="profile" role="tab" aria-selected="true">ملفك الشخصي</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="site" aria-labelledby="site-tab" role="tabpanel">
                                <div class="mb-2">
                                    <label for="site_name" class="form-label">اسم الموقع</label>
                                    <input type="text" id="site_name" name="site_name" value="{{ $siteInfo->site_name }}" class="form-control">
                                </div>

                                <div class="mb-2">
                                    <label for="site_logo" class="form-label">اللوجو</label>
                                    <input type="file" id="site_logo" name="site_logo" class="form-control">
                                </div>

                                <div class="mb-2">
                                    <label for="address" class="form-label">العنوان</label>
                                    <input type="text" id="address" name="address" value="{{ $siteInfo->address }}" class="form-control">
                                </div>

                                <div class="mb-2">
                                    <label for="site_email" class="form-label">البريد الإلكتروني الخاص بالموقع</label>
                                    <input type="text" id="site_email" name="site_email" value="{{ $siteInfo->site_email }}" class="form-control">
                                </div>

                                <div class="mb-2">
                                    <label for="zip_code" class="form-label">الرمز البريدى</label>
                                    <input type="text" id="zip_code" name="zip_code" value="{{ $siteInfo->zip_code }}" class="form-control">
                                </div>

                            </div>

                            <div class="tab-pane" id="social" aria-labelledby="social-tab" role="tabpanel">
                                <div class="mb-2">
                                    <label for="intagram_link" class="form-label">انستجرام</label>
                                    <input type="text" id="intagram" name="intagram_link" value="{{ $siteInfo->intagram_link }}" class="form-control">
                                </div>
                                <div class="mb-2">
                                    <label for="linkedin_link" class="form-label">لينكد ان</label>
                                    <input type="text" id="snapchat" name="linkedin_link" value="{{ $siteInfo->linkedin_link }}" class="form-control">
                                </div>
                                <div class="mb-2">
                                    <label for="snapchat_link" class="form-label">سناب شات</label>
                                    <input type="text" id="snapchat" name="snapchat_link" value="{{ $siteInfo->snapchat_link }}" class="form-control">
                                </div>
                                <div class="mb-2">
                                    <label for="youtube_link" class="form-label">قناة اليوتيوب</label>
                                    <input type="text" id="youtube_link" name="youtube_link" value="{{ $siteInfo->youtube_link }}" class="form-control">
                                </div>
                                <div class="mb-2">
                                    <label for="twitter_link" class="form-label">منصة اكس</label>
                                    <input type="text" id="twitter_link" name="twitter_link"  value="{{ $siteInfo->twitter_link }}" class="form-control">
                                </div>
                                <div class="mb-2">
                                    <label for="phone_number" class="form-label">رقم الجوال</label>
                                    <input type="text" id="phone_number" name="phone_number" value="{{ $siteInfo->phone_number }}" class="form-control">
                                </div>
                                <div class="mb-2">
                                    <label for="whatsUp_number" class="form-label">رقم الواتساب</label>
                                    <input type="text" id="whatsUp_number" name="whatsUp_number" value="{{ $siteInfo->whatsUp_number }}" class="form-control">
                                </div>
                            </div>

                            <div class="tab-pane" id="appDwonload" aria-labelledby="appDwonload-tab" role="tabpanel">
                                <div class="mb-2">
                                    <label for="google_play" class="form-label">لينك تحميل تطبيقك علي جوجل بلاى</label>
                                    <input type="text" id="google_play" name="google_play" value="{{ $siteInfo->google_play }}"   class="form-control">
                                </div>
                                <div class="mb-2">
                                    <label for="app_store" class="form-label">لينك تحميل تطبيقك علي ابل ستور</label>
                                    <input type="text" id="app_store" name="app_store" value="{{ $siteInfo->app_store }}" class="form-control">
                                </div>
                            </div>

                            <div class="tab-pane" id="profile" aria-labelledby="profile-tab" role="tabpanel">
                                <div class="mb-2">
                                    <label for="name" class="form-label">اسمك</label>
                                    <input type="text" id="name" name="name" value="{{ auth()->user()->name }}" class="form-control">
                                </div>
                                <div class="mb-2">
                                    <label for="email" class="form-label">بريدك الإلكتروني</label>
                                    <input type="email" id="email" name="email" value="{{ auth()->user()->email }}" class="form-control">
                                </div>
                                <div class="mb-2">
                                    <label for="pass" class="form-label">كلمة السر</label>
                                    <input type="password" id="pass" placeholder="***********" name="pass" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                <div class="card-footer">
                    <button type="submit" class="btn btn-relief-success">حفظ</button>
                </div>
            </form>
        </div>
    </section>
@endsection