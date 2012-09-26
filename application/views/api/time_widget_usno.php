<!doctype html><html lang="en"><meta charset="utf-8" /><title>*Clock widget (USNO)</title>
<meta name="ROBOTS" content="noindex,nofollow" />
<style>
body{ font-family:Arial, helvetica, sans-serif; text-align:center; }
h1{ margin:0; }
</style>


<h1 id="USNOclk">Javascript is required</h1>

<a href="http://tycho.usno.navy.mil/what.html" title="THE US Naval Observatory Master Clock">USNO Time</a>



<script>
//<!-- hide the code from old browsers that do not support javascript
var USNO = USNO || {};

(function () {
	var Clock = document.getElementById("USNOclk");
	var xmlHttp;
	var startResponse;
	var serverTime;
	var refresher;
	var lag;
	var DST;

	function GetXmlHttpObject()
	{
		//var xmlHttp=null;

		if (window.XMLHttpRequest) { 
			xmlHttp = new XMLHttpRequest();
		} else if (window.ActiveXObject) {
			xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
		}

		return xmlHttp;
	}

	function stateChanged() 
	{
		if (xmlHttp.readyState==4){ 
			lag = (new Date().getTime() - startResponse)/2;
			if (! xmlHttp.responseXML) return;
			serverTime = parseFloat(xmlHttp.responseXML.documentElement.firstChild.firstChild.nodeValue);
			DST = xmlHttp.responseXML.documentElement.firstChild.attributes[0].value;
			serverTime = serverTime + 1000 + lag;
			//setTimeout("incTime()", (2000-serverTime%1000));
			setTimeout("USNO.incTime()", (2000-serverTime%1000));
		}
	}

	function showTime()
	{
		//Clock = document.getElementById(id);
		Clock.innerHTML = "Loading...";
		xmlHttp=GetXmlHttpObject();
		if (xmlHttp==null){
			Clock.innerHTML="Sorry, browser incapatible.";
			return;
		}
		refresher = 0;
		startResponse = new Date().getTime();
		//var url="http://tycho.usno.navy.mil/cgi-bin/time.pl?n="+ startResponse;
		var url="<?php echo site_url() ?>api/time/xml?n="+ startResponse;
		xmlHttp.onreadystatechange=stateChanged;
		xmlHttp.open("GET",url,true);
		xmlHttp.send(null);
	}

	//function incTime()
	USNO.incTime = function ()
	{
		refresher++;
		serverTime=Math.floor(serverTime-(serverTime%1000)+1000);
		var d = new Date();
		d.setTime(serverTime);

		Clock.innerHTML=((d.getUTCHours() < 10) ? "0" + d.getUTCHours() : d.getUTCHours()) + ":" + ((d.getUTCMinutes() < 10) ? "0" + d.getUTCMinutes() : d.getUTCMinutes()) + ":" + ((d.getUTCSeconds() < 10) ? "0" + d.getUTCSeconds() : d.getUTCSeconds()) + " UTC"; //<br />";

		if (refresher > 180){
			showTime();
		}else{
			//setTimeout("incTime()", 1000);
			setTimeout("USNO.incTime()", 1000);
		}
	}

	window.onload = showTime;
})();
// end hiding -->
</script>

</html>
<!--
http://tycho.usno.navy.mil/what.html
-->
