jQuery(document).ready(function($) 
{
	$('.timeline-slider').slick({
        dots: false,
        arrows: true, 
        infinite: false,
        adaptiveHeight: true,
        slidesToShow: 3, 
        slidesToScroll: 1, 
        prevArrow: '<div class="slick-prev"><svg xmlns="http://www.w3.org/2000/svg" width="38" height="38" fill="currentColor" class="bi bi-arrow-left-short" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5z"/></svg></div>',
        nextArrow: '<div class="slick-next"><svg xmlns="http://www.w3.org/2000/svg" width="38" height="38" fill="currentColor" class="bi bi-arrow-right-short" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z"/></svg></div>', 
        responsive: [{ 
        breakpoint: 768,
        settings: { 
            slidesToShow: 1 } 
        }] 
    });
});