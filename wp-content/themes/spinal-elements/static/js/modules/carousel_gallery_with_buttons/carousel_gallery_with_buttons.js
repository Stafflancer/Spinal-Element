  jQuery(document).ready(function($){

    $('.gallery_button_carousel').slick({
		dots: true,
	    arrows: false, 
	    autoplay:true,
  		autoplaySpeed:3000,
        draggable: true,
        infinite: true,
	    slidesToShow: 1, 
	    slidesToScroll: 1,
	    responsive: [{ 
	        breakpoint: 768,
	        settings: { 
	            slidesToShow: 1 } 
	    }] 
	});

});   