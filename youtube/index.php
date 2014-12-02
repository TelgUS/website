<!DOCTYPE html>
<html>

<head>
<title>Watch YouTube</title>

<!-- Bootstrap -->
<link href="/css/bootstrap.min.css" rel="stylesheet">


<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

<style>
.docs-header {
	padding: 30px 15px;
	color: #cdbfe3;
	background-color: #6f5499;
}
</style>

<script>
// 3. This function creates an <iframe> (and YouTube player)
//    after the API code downloads.
var player;
function onYouTubeIframeAPIReady() {
	alert('youtube iframe api is ready');
	player = new YT.Player('player', {
		height: '390',
		width: '640',
		videoId: videoId,
		events: {
			'onReady': onPlayerReady,
			'onStateChange': onPlayerStateChange
		}
	});
} // end onYouTubeIframeAPIReady

// 4. The API will call this function when the video player is ready.
function onPlayerReady(event) {
	alert('player is ready');
	event.target.playVideo();
} // end function onPlayerReady

// 5. The API calls this function when the player's state changes.
//    The function indicates that when playing a video (state=1),
//    the player should play for six seconds and then stop.
var done = false;
function onPlayerStateChange(event) {
	alert('player state is changed: ' + event.target.getPlayerState());
	if (event.data == YT.PlayerState.PLAYING && !done) {
		setTimeout(stopVideo, 6000);
		done = true;
	}
} // end function onPlayerStateChange

function stopVideo() {
	player.stopVideo();
} // end function stopVideo

function loadVideo() {
	videoId = $("#id").val();

	if (videoId.trim().length == 0) {
		alert('Enter a valid Video ID');
		return false;
	}

	if (document.getElementById("yt_script") == null) {
		// 2. This code loads the IFrame Player API code asynchronously.
		var tag = document.createElement('script');

		tag.src = "https://www.youtube.com/iframe_api";
		var firstScriptTag = document.getElementsByTagName('script')[0];
		firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
	
		var sid=document.createAttribute("id");
		sid.value="yt_script";
		document.getElementsByTagName("script")[0].setAttributeNode(sid);
	}

} // end loadVideo

</script>
</head>

<body>

	<div class="container">
		<h1>Watch YouTube</h1>
	</div>

	<div class="docs-header">
		<div class="container">
			<form class="form-inline" role="form" name="video"
				onsubmit="loadVideo(); return false;">
				<div class="form-group">
					<label for="id">Video ID</label> <input type="text"
						class="form-control" id="id" placeholder="Video ID"
						value="A5aFGzE5ClI">
				</div>
				<button type="submit" class="btn btn-primary">Watch</button>
			</form>
		</div>
	</div>

	<div class="container">
		<br>
		<!-- 1. The <iframe> (and video player) will replace this <div> tag. -->
		<div id="player"></div>

	</div>

	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<script
		src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js">
	</script>

	<!-- Include all compiled plugins (below), or include individual files as needed -->
	<script src="/js/bootstrap.min.js"></script>

</body>
</html>