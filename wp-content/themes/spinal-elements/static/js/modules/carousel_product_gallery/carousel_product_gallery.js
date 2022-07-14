jQuery(document).ready(function($) 
{

    $(".thumbnail-view").hover(function()
    {
        $('.carousel-product-gallery-item').removeClass('activethumbnail');
        $('.carousel-product-gallery-item').removeClass('activelargeimage');
        var thumbnail_index = $(this).attr('data-index');
        $(this).addClass('activethumbnail');
        $('.showindex' + thumbnail_index).addClass('activelargeimage');
    });

    $(".thumbnail-view").click(function()
    {
        $('.carousel-product-gallery-item').removeClass('activethumbnail');
        $('.carousel-product-gallery-item').removeClass('activelargeimage');
        var thumbnail_index = $(this).attr('data-index');
        $(this).addClass('activethumbnail');
        $('.showindex' + thumbnail_index).addClass('activelargeimage');
    });

    $(".product-large-image-item").click(function()
    {
       var thumbnail_index = $(this).attr('data-id');
       $(".popup-thumbnail-view").removeClass("activethumbnail");
       $(".popup-thumbnail-view"+thumbnail_index).addClass("activethumbnail");
       $('body').addClass("product-popup-body");
       var videourl = $(this).find('.carousel-product-gallery').children(".carousel-product-gallery-image").children(".viemovideourl");
       var product_type = videourl.attr("product-type");

       if(product_type == 'video')
       {
           $(".popup-image").hide();
           $(".carousel-product-video-module-inner").show();
           var videosrc = videourl.val();
           var popupvideo = $('.product-large-image-popup').find(".video-popup-div").children("iframe");
           popupvideo.attr("src", videosrc);
       }
       else
       {
           $(".carousel-product-video-module-inner").hide();
           $(".popup-image").show();
           var findimage = $(this).find('.carousel-product-gallery').children(".carousel-product-gallery-image").children("img");
           var getsrc = findimage.attr("src");
           var popupimage = $('.product-large-image-popup').find(".image-product-popup").children("a").children("img");
           popupimage.attr("src", getsrc);
       }
       $('.product-large-image-popup').show();
    });

    $(".popup-thumbnail-view").click(function()
    {
       $(".zoombtn").removeClass("zoom-out");
       $(".popup-thumbnail-view").removeClass("activethumbnail");
       $(this).addClass("activethumbnail");
       var videourl = $(this).children(".carousel-product-gallery-image").children(".viemovideourl");
       var product_type = videourl.attr("product-type");
       if(product_type == 'video')
       {
           $(".popup-image").hide();
           $(".carousel-product-video-module-inner").show();
           var videosrc = videourl.val();
           var popupvideo = $('.product-large-image-popup').find(".video-popup-div").children("iframe");
           popupvideo.attr("src", videosrc);
       }
       else
       {
           $(".carousel-product-video-module-inner").hide();
           $(".popup-image").show();
           var findimage = $(this).children(".carousel-product-gallery-image").children("img");
           var getsrc = findimage.attr("src");
           var popupimage = $('.product-large-image-popup').find(".image-product-popup").children("a").children("img");
           popupimage.attr("src", getsrc);
       }
    
    });

    $(".crossbtn").click(function()
    {
       $('body').removeClass("product-popup-body");
       $('.product-large-image-popup').hide();
    });

    $('.popupouter').click(function(e) {
        if (!$(e.target).closest('.popuinnerblcsk').length){
            $(".popupouter").hide();
            $("body").removeClass("product-popup-body");
        }
    });
    
    var zoomvariable = 1;
    $('.zoombtn').on('click', function()
    {
        $(this).toggleClass("zoom-out");
    });

  

    /*$(".video-pause").click(function()
    {
        $(".video-pause").hide();
        $(".video-play").show();
    });
    $(".video-play").click(function()
    {
        $(".video-pause").show();
        $(".video-play").hide();
    });

    $(".playbtn").click(function()
    {
        var findifream = $(this).parent('.icon-video').parent('.carousel-product-video-module-inner').children('iframe').attr('id');
        console.log(findifream);
        var iframe = document.getElementById(findifream);
        var player = $f(iframe);
        player.api("play");
    });


    $(".pausebtn").click(function()
    {
        var findifream = $(this).parent('.icon-video').parent('.carousel-product-video-module-inner').children('iframe').attr('id');
       // console.log(findifream);
        var iframe = document.getElementById(findifream);
        var player = $f(iframe);
        player.api("pause");
    });*/

});

