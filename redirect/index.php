<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- <meta http-equiv="refresh" content="5;url=https://wangmai.eng.cmu.ac.th" /> -->
	<meta property="og:title" content="WangMai - Eng CMU 30Years building room checker" />
	<meta property="og:type" content="website" />
	<meta property="og:image" content="../002-w-1.png" />
	<meta property="og:url" content="https://wangmai.eng.cmu.ac.th" />
	<title>Redirect Page / WangMai</title>
	<script type="text/javascript">
		var timeleft = 5;
		var downloadTimer = setInterval(function(){
		timeleft--;
		document.getElementById("count_redirect").textContent = timeleft;
		if(timeleft <= 0){	
			clearInterval(downloadTimer);
		}
		},1000);
		window.setTimeout(function(){
	        window.location.href = "https://wangmai.eng.cmu.ac.th";
	    }, 5000);
</script>
</head>
<body>
	Redirecting you in <span id="count_redirect">5</span> seconds
</body>
</html>