jQuery(document).ready(function($)
{
 	jQuery('.hover-item').mouseover(function() 
 	{
 		$(".list-view-image").removeClass("activeimage");
 		var vissiblediv = $(this).next(".list-view-image").addClass("activeimage");

		return false;
	});
});