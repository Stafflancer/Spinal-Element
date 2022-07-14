jQuery(document).ready(function($){

	$( ".sub-menu" ).before( "<span class='submenutoggle'></span>" );

	// header dixed scroll
	function stickyNavigation() {
		let $header = jQuery('.header-spinalelements');

		if (jQuery(window).scrollTop() > 50) {
			$header.addClass('header-white');
		} else {
			$header.removeClass('header-white');
		}
	}

	jQuery(window).on('load', function () {
		stickyNavigation();
	}).scroll(function () {
		stickyNavigation();
	});

    // animation
        wow = new WOW(
	      {
	        animateClass: 'animated',
	        offset:       100,
	        callback:     function(box) {
	          console.log("WOW: animating <" + box.tagName.toLowerCase() + ">")
	        }
	      }
	    );
	    wow.init();

     $('li.tab-menu-new a').on('click', function()
     {
        var target = $(this).attr('title');
        console.log(target);
        $('li.tab-menu-new a').removeClass('active');
        $(this).addClass('active');
       	var indexnumber = $("."+target).attr('data-slick-index');
       	$('.gallery_button_carousel').slick('slickGoTo', indexnumber);
        //return false;
    });



  	// header-subemnu
 	
    $('.menu-item-has-children .submenutoggle').click(function(){
        if($(this).siblings('.sub-menu').hasClass('active-menu')){
              $(this).siblings('.sub-menu').removeClass('active-menu');      
        }else{
     	  $(this).siblings('.sub-menu').addClass('active-menu');
        }
    });

    $( "#producttypesfilter" ).change(function() {
	  var pageurl = this.value;
	  window.location.replace(pageurl);
	});
	
});