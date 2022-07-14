jQuery(document).ready(function($)
{

	var a = 0;
	$(window).scroll(function() 
	{
		var oTop = $('#counter').offset().top - window.innerHeight;
		if (a == 0 && $(window).scrollTop() > oTop) {
			$('.count').each(function () {
				var number = $(this).text(); 
			 	var result = number.replace(/,/g, "");
			    $(this).prop('Counter',0).animate({
			        Counter: result
			    }, {
			        duration: 4000,
			        easing: 'swing',
			        step: function (now) {
			           var counternew = Math.ceil(now).toLocaleString('en'); 
			           $(this).text(counternew);
			        }
			    });
			});
			a = 1;
  		}
	});

});


	