<HTML>
<HEAD>
<TITLE> USNO Master Clock Time</TITLE>

<html>

<head>
<title></title>
</head>
<BODY>


<style type="text/css">
 form,label
 {
   font-family:arial, sans-serif, helvetica, "times new roman";
   font-size:10pt; /* increase or decrease the value to change the size of the font */
 }
 h1
 {
   font-family:arial, sans-serif, helvetica, "times new roman";
 }
</style>

    <script type="text/javascript">
    <!-- hide the code from old browsers that do not support javascript
	
	var xmlHttp;
	var startResponse;
	var serverTime;
	var refresher;
	var lag;
	var DST;
	   
	function GetXmlHttpObject()
	{
		var xmlHttp=null;
	
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
			serverTime = parseFloat(xmlHttp.responseXML.documentElement.firstChild.firstChild.nodeValue);
			DST = xmlHttp.responseXML.documentElement.firstChild.attributes[0].value;
			serverTime = serverTime + 1000 + lag;
			setTimeout("incTime()", (2000-serverTime%1000));
		}
	}
	
	function showTime()
	{
		document.getElementById('USNOclk').innerHTML="Loading...<br />";
		xmlHttp=GetXmlHttpObject();
		if (xmlHttp==null){
			document.getElementById('USNOclk').innerHTML="Sorry, browser incapatible. <BR />";
			return;
		} 
		refresher = 0;
		startResponse = new Date().getTime();
		var url="http://tycho.usno.navy.mil/cgi-bin/time.pl?n="+ startResponse;
		xmlHttp.onreadystatechange=stateChanged;
		xmlHttp.open("GET",url,true);
		xmlHttp.send(null);
	}
	
	function incTime()
	{
		refresher++;
		serverTime=Math.floor(serverTime-(serverTime%1000)+1000);
		var d = new Date();
		d.setTime(serverTime);
		
		document.getElementById('USNOclk').innerHTML=((d.getUTCHours() < 10) ? "0" + d.getUTCHours() : d.getUTCHours()) + ":" + ((d.getUTCMinutes() < 10) ? "0" + d.getUTCMinutes() : d.getUTCMinutes()) + ":" + ((d.getUTCSeconds() < 10) ? "0" + d.getUTCSeconds() : d.getUTCSeconds()) + " UTC<br />";
			
		if (refresher > 180){
			showTime();
		}else{
			setTimeout("incTime()", 1000);
		}
	}

window.onload = showTime;

// end hiding -->
</script>
</head>

<body>


    <h1 align="center">US Naval Observatory Master Clock </h1>
    <h1 id="USNOclk" style="margin:0" align="center"></h1>

</script>
<P>
   
<P>
<HR>
<CENTER>
<IMG ALIGN=TOP SRC="gif/bl_dot.gif">
<IMG ALIGN=TOP SRC="gif/new25.gif">
<A HREF="http://tycho.usno.navy.mil/simpletime.html">Animated USNO Time in Standard Time Zones</A> </FONT> <br>(Requires Javascript be enabled.)

<P>

<IMG ALIGN=TOP SRC="gif/bl_dot.gif">
<A HREF="http://tycho.usno.navy.mil/timer.html">USNO Time in Standard Time Zones</A>
</FONT>


<P>

<IMG ALIGN=TOP SRC="gif/bl_dot.gif">
<A HREF="what1.html"> USNO Master Clock Time Animated GIF Clocks</A> 
</FONT>
<BR> (Requires compatible browser, see <A HREF="gifclocks.html"> details here.)</A>
<P>
<IMG ALIGN=TOP SRC="gif/bl_dot.gif">
	<A HREF="zones.html">Converting from Universal Time</A>
</FONT>
<P>
<IMG ALIGN=TOP SRC="gif/bl_dot.gif">
<A HREF="sidereal.html">Compute Local Apparent Sidereal Time</A>
</FONT>
<P>
<IMG ALIGN=TOP SRC="gif/bl_dot.gif">
<A HREF="http://tycho.usno.navy.mil/cgi-bin/anim">Another Realtime Clock</A>
</FONT>
<HR>
<P>

</FONT>
<P>
See also the <A HREF="http://www.time.gov">www.time.gov Time Display</A>
<BR>   </BR>

<P>


	<A HREF="frontpage.html">
	BACK TO Time Service Home PageTop</A>  

<P>
</CENTER>
</BODY>
</HTML>
