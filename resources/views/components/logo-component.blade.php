<div class="logo">
    @if($site_logo !== null)
        <img class="logo_img" src="{{ asset($site_logo) }}" alt="logo">
    @else 
        <img src="{{ asset('fronted/img/KFU_logo_white.png') }}" alt="KFU Logo" height="50">
    @endif
</div>