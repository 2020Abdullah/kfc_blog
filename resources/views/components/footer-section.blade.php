<footer class="footer">
    <div class="footer-top">
      <div class="footer-column">
        <h3>تواصل معنا</h3>
        <p>{{ $siteInfo->phone_number }}</p>
        <p>{{ $siteInfo->site_email }}</p>
        <p>{{ $siteInfo->address }}</p>
        <p>ص.ب 400 - الرمز البريدي {{ $siteInfo->zip_code }}</p>
      </div>
  
      <div class="footer-column">
        <h3>روابط تهمك</h3>
        <ul>
          @foreach($FooterLink as $link)
            <li class="nav-item"><a class="nav-link" href="{{ route('pageView', ['id' => $link->id, 'slug' => Str::slug($link->title)]) }}" class="mx-2">{{ $link->title }}</a></li>
          @endforeach
        </ul>
      </div>
  
      <div class="footer-column">
        <h3 class="head">حمل تطبيق جامعة الملك فيصل على الهواتف الذكية</h3>
        <div class="app-links">
          <a href="{{ $siteInfo->google_play ? $siteInfo->google_play : '#' }}"><img src="{{ asset('assets/google-play.png') }}" alt="Google Play"></a>
          <a href="{{ $siteInfo->app_store ?  $siteInfo->app_store : '#' }}"><img src="{{ asset('assets/app-store.png') }}" alt="App Store"></a>
        </div>
        <div class="social-links">
          <a href="{{ $siteInfo->intagram_link ?  $siteInfo->intagram_link : '#' }}"><img src="{{ asset('assets/instagram.png') }}" alt="Instagram"></a>
          <a href="{{ $siteInfo->youtube_link ?  $siteInfo->youtube_link : '#' }}"><img src="{{ asset('assets/youtube.png') }}" alt="YouTube"></a>
          <a href="{{ $siteInfo->linkedin_link ?  $siteInfo->linkedin_link : '#' }}"><img src="{{ asset('assets/linkedin.png') }}" alt="LinkedIn"></a>
          <a href="{{ $siteInfo->snapchat_link ?  $siteInfo->snapchat_link : '#' }}"><img src="{{ asset('assets/snapchat.png') }}" alt="Snapchat"></a>
          <a href="{{ $siteInfo->twitter_link ?  $siteInfo->twitter_link : '#' }}"><img src="{{ asset('assets/twitter.png') }}" alt="Twitter"></a>
        </div>
      </div>
    </div>
  
    <div class="footer-bottom">
      <p>جميع الحقوق محفوظة لجامعة الملك فيصل © 2025 | تصميم وتطوير <a class="author" href="https://www.facebook.com/FekraSmartTech/">فكرة سمارت</a></p>
    </div>
  </footer>
  