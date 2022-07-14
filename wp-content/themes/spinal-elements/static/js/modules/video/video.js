jQuery(document).ready(function($) 
{
	$(".video-pause").click(function()
	{
		$(".video-pause").hide();
    	$(".video-play").show();
	});
	$(".video-play").click(function()
	{
		$(".video-pause").show();
    	$(".video-play").hide();
	});

	var iframe = document.getElementById('projectplayer');

	// $f == Froogaloop
	var player = $f(iframe);

	// bind events
	var playButton = document.getElementById("play-button");
	playButton.addEventListener("click", function() {
	  player.api("play");
	});

	var pauseButton = document.getElementById("pause-button");
	pauseButton.addEventListener("click", function() {
	  player.api("pause");
	});
});