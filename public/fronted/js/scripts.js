/*
 ** scrollTop button 
*/

$(document).ready(function () {
  $(".toggle-menu").click(function (e) {
      e.preventDefault();
      
       // الـ mega-menu التابعة للعنصر الحالي
       var $currentMegaMenu = $(this).siblings(".mega-menu");
        
       // إغلاق أي قوائم أخرى مفتوحة
       $(".mega-menu").not($currentMegaMenu).slideUp(300);
       
       // فتح/إغلاق القائمة التابعة للعنصر الحالي
       $currentMegaMenu.slideToggle(300);

  });

  // إغلاق القائمة عند النقر في أي مكان خارجها
  $(document).click(function (e) {
      if (!$(e.target).closest(".nav-item").length) {
          $(".mega-menu").slideUp(300);
      }
  });

  // slider Text 
  function loadSliderText(code, containerId, itemsId) {
    $.ajax({
        url: '/get-slider-by-code/' + code,
        type: 'GET',
        success: function(response) {
            if(response.status === 'success') {
                let sliderItems = '';
                $.each(response.items.slices, function(index, item) {
                    sliderItems += `
                        <div class="item mt-3">
                            <h4 class="text-warning">${item.title}</h4>
                            <p>${item.description}</p>
                        </div>
                    `;
                });

                $(itemsId).html(sliderItems);

                $(itemsId).owlCarousel({
                    rtl: true,
                    loop: true,
                    margin: 10,
                    nav: false,
                    dots: true,
                    autoplay: false,
                    // autoplayTimeout: 5000,
                    autoplayHoverPause: true,
                    items: response.items_number,
                    responsive: {
                        0: { items: 1 },
                        600: { items: 1 },
                        1000: { items: response.items_number }
                    }
                });
            } else {
                $(containerId).html('<p>لا يوجد سلايدر لعرضه</p>');
            }
        },
        error: function() {
            $(containerId).html('<p>حدث خطأ أثناء تحميل السلايدر</p>');
        }
    });
  }

  // slider hero2
  function loadSliderHero2(code, containerId, itemsId) {
    $.ajax({
        url: '/get-slider-by-code/' + code,
        type: 'GET',
        success: function(response) {
            if(response.status === 'success') {
                let sliderItems = '';
                $.each(response.items.slices, function(index, item) {
                    sliderItems += `
                        <div class="item mt-3">
                            <div class="hero_img_container">
                                <img src="${item.image}"  alt="${item.title}">                            
                            </div>
                        </div>
                    `;
                });

                $(itemsId).html(sliderItems);

                $(itemsId).owlCarousel({
                    rtl: true,
                    loop: true,
                    margin: 10,
                    nav: false,
                    dots: false,
                    autoplay: true,
                    autoplayTimeout: 5000,
                    autoplayHoverPause: true,
                    items: response.items_number,
                    responsive: {
                        0: { items: 1 },
                        600: { items: 1 },
                        1000: { items: response.items_number }
                    }
                });
            } else {
                $(containerId).html('<p>لا يوجد سلايدر لعرضه</p>');
            }
        },
        error: function() {
            $(containerId).html('<p>حدث خطأ أثناء تحميل السلايدر</p>');
        }
    });
  }

  // slider hero Campany
  function loadSliderHero3(code, containerId, itemsId) {
    $.ajax({
        url: '/get-slider-by-code/' + code,
        type: 'GET',
        success: function(response) {
            if(response.status === 'success') {
                let sliderItems = '';
                $.each(response.items.slices, function(index, item) {
                    sliderItems += `
                        <div class="item mt-3">
                            <a href="#">
                                <div class="item_award">
                                    <img src="${item.image}"  alt="${item.title}">                            
                                </div>
                            </a>
                        </div>
                    `;
                });

                $(itemsId).html(sliderItems);

                $(itemsId).owlCarousel({
                    rtl: true,
                    loop: true,
                    margin: 10,
                    nav: false,
                    dots: true,
                    autoplay: true,
                    autoplayTimeout: 3000,
                    autoplayHoverPause: true,
                    items: response.items_number,
                    responsive: {
                        0: { items: 1 },
                        600: { items: 1 },
                        1000: { items: response.items_number }
                    }
                });
            } else {
                $(containerId).html('<p>لا يوجد سلايدر لعرضه</p>');
            }
        },
        error: function() {
            $(containerId).html('<p>حدث خطأ أثناء تحميل السلايدر</p>');
        }
    });
  }

  // slider latest News 
  function loadSliderMainBlog(itemsId, items) {
    $(itemsId).owlCarousel({
        rtl: true,
        loop: true,
        margin: 10,
        nav: false,
        dots: true,
        autoplay: true,
        autoplayTimeout: 3000,
        autoplayHoverPause: true,
        items: items,
        responsive: {
            0: { items: 1 },
            600: { items: 1 },
            1000: { items: items }
        }
    });
  }

  // slider Spotlight 
  function loadSliderSpotlight(code, containerId, itemsId) {
    $.ajax({
        url: '/get-slider-by-code/' + code,
        type: 'GET',
        success: function(response) {
            if(response.status === 'success') {
                let sliderItems = '';
                $(".spotlight_slider_heading").text(response.items.name);
                $.each(response.items.slices, function(index, item) {
                    sliderItems += `
                        <div class="item mt-3">
                            <a href="${item.refLink ? item.refLink : '#'}">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="quick_access_card">
                                            <div class="quick_access_icon_container">
                                                <img class="quick_access_icon" alt="quick access icon" src="${item.image}">
                                            </div>
                                            <h3 class="quick_access_title">${item.title}</h3>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    `;
                });

                $(itemsId).html(sliderItems);

                $(itemsId).owlCarousel({
                    rtl: true,
                    loop: true,
                    margin: 10,
                    nav: false,
                    dots: true,
                    autoplay: true,
                    autoplayTimeout: 3000,
                    autoplayHoverPause: true,
                    items: response.items_number,
                    responsive: {
                        0: { items: 1 },
                        600: { items: 1 },
                        1000: { items: response.items_number }
                    }
                });
            } else {
                $(containerId).html('<p>لا يوجد سلايدر لعرضه</p>');
            }
        },
        error: function() {
            $(containerId).html('<p>حدث خطأ أثناء تحميل السلايدر</p>');
        }
    });
  }

    // slider Services 
    function loadSliderServices(code, containerId, itemsId) {
        $.ajax({
            url: '/get-slider-by-code/' + code,
            type: 'GET',
            success: function(response) {
                if(response.status === 'success') {
                    let sliderItems = '';
                    $(".Service_heading").text(response.items.name);
                    $.each(response.items.slices, function(index, item) {
                        sliderItems += `
                            <div class="item mt-3">
                                <a href="${item.refLink ? item.refLink : '#'}">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="quick_access_card">
                                                <div class="quick_access_icon_container">
                                                    <img class="quick_access_icon" alt="quick access icon" src="${item.image}">
                                                </div>
                                                <h3 class="quick_access_title">${item.title}</h3>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        `;
                    });

                    $(itemsId).html(sliderItems);

                    $(itemsId).owlCarousel({
                        rtl: true,
                        loop: true,
                        margin: 10,
                        nav: false,
                        dots: true,
                        autoplay: false,
                        autoplayTimeout: 3000,
                        autoplayHoverPause: true,
                        items: response.items_number,
                        responsive: {
                            0: { items: 1 },
                            600: { items: 1 },
                            1000: { items: response.items_number }
                        }
                    });

                    // استبدال الصورة بـ iframe عند النقر
                    $(".video-thumbnail").on("click", function() {
                        let videoUrl = $(this).attr("data-video");
                        let iframe = `<iframe width="100%" height="250" 
                                        src="${videoUrl}?autoplay=1" 
                                        frameborder="0" allowfullscreen></iframe>`;
                        $(this).replaceWith(iframe);
                    });

                } else {
                    $(containerId).html('<p>لا يوجد سلايدر لعرضه</p>');
                }
            },
            error: function() {
                $(containerId).html('<p>حدث خطأ أثناء تحميل السلايدر</p>');
            }
        });
    }

  // slider channel Youtube 
  function loadSliderChannel(code, containerId, itemsId) {
    $.ajax({
        url: '/get-slider-by-code/' + code,
        type: 'GET',
        success: function(response) {
            if(response.status === 'success') {
                let sliderItems = '';
                $(".ChannelYoutubeHeading").text(response.items.name);
                $.each(response.items.slices, function(index, item) {
                    if (item.youtube_link) {
                        let youtubeId = extractYoutubeId(item.youtube_link); // استخراج ID الفيديو

                        sliderItems += `
                            <div class="item mt-3">
                                <a href="javascript:void(0)" class="video-thumbnail" data-video="${item.youtube_link}">
                                    <img src="https://img.youtube.com/vi/${youtubeId}/hqdefault.jpg" 
                                        class="lazyload video-preview" 
                                        width="100%" height="250" alt="YouTube Video">
                                    <div class="play-button"></div>
                                </a>
                            </div>
                        `;
                    }
                });

                $(itemsId).html(sliderItems);

                $(itemsId).owlCarousel({
                    rtl: true,
                    loop: true,
                    margin: 10,
                    nav: false,
                    dots: true,
                    autoplay: false,
                    autoplayTimeout: 3000,
                    autoplayHoverPause: true,
                    items: response.items_number,
                    responsive: {
                        0: { items: 1 },
                        600: { items: 1 },
                        1000: { items: response.items_number }
                    }
                });

                // استبدال الصورة بـ iframe عند النقر
                $(".video-thumbnail").on("click", function() {
                    let videoUrl = $(this).attr("data-video");
                    let iframe = `<iframe width="100%" height="250" 
                                    src="${videoUrl}?autoplay=1" 
                                    frameborder="0" allowfullscreen></iframe>`;
                    $(this).replaceWith(iframe);
                });

            } else {
                $(containerId).html('<p>لا يوجد سلايدر لعرضه</p>');
            }
        },
        error: function() {
            $(containerId).html('<p>حدث خطأ أثناء تحميل السلايدر</p>');
        }
    });
  }

    // استخراج ID الفيديو من الرابط
    function extractYoutubeId(url) {
        let regExp = /^.*(youtu\.be\/|v\/|u\/\w\/|embed\/|watch\?v=)([^#\&\?]*).*/;
        let match = url.match(regExp);
        return (match && match[2].length == 11) ? match[2] : null;
    }

  // get slider Channel
  loadSliderChannel('University', '.ChannelSlider_wrapper', '.ChannelSlider');

    // get sliderText 
    loadSliderText('Hero1', '#hero-sliderText-container', '#sliderText');

    // get sliderHero2
    loadSliderHero2('Hero2', '#hero-sliderHero2-container', '#sliderHero2');

    // get sliderHero3
    loadSliderHero3('Hero3', '#hero-sliderHero3-container', '#sliderHero3');
   
    // get slider sliderHero main News
    loadSliderMainBlog('.News_Channel', 5);

    loadSliderMainBlog('.main_News', 1);

    // get SliderSpotlight
    loadSliderSpotlight('spotlight', '.spotlight_slider_wrapper', '.spotlight_slider');

    // get SliderServices
    loadSliderServices('Services', '.Service_wrapper', '.Service_slider');


});