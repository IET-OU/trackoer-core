<?php
  $CI =& get_instance();
  if ($CI->input->is_cli_request()) {
    fprintf(STDERR, "Error, $message".PHP_EOL);
    exit (1);
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>404 Page Not Found</title>
<style type="text/css">

::selection{ background-color: #E13300; color: white; }
::moz-selection{ background-color: #E13300; color: white; }
::webkit-selection{ background-color: #E13300; color: white; }

body {
	background-color: #ffcfcfc;
	margin: 40px;
	/*font: 13px/20px normal Helvetica, Arial, sans-serif; //ou-specific */
	font: 1em Helvetica,sans-serif;
	color: #4F5155;
}

a {
	color: #003399;
	background-color: transparent;
	font-weight: normal;
}

h1 {
	color: #444;
	background-color: transparent;
	border-bottom: 1px solid #D0D0D0;
	x-font-size: 19px;
	font-weight: normal;
	margin: 0 0 14px 0;
	padding: 14px 15px 10px 15px;
}

code {
	font-family: Consolas, Monaco, Courier New, Courier, monospace;
	font-size: 12px;
	background-color: #f9f9f9;
	border: 1px solid #D0D0D0;
	color: #002166;
	display: block;
	margin: 14px 0 14px 0;
	padding: 12px 10px 12px 10px;
}

#container {
	margin: 10px;
	border: 1px solid #D0D0D0;
	-webkit-box-shadow: 0 0 8px #D0D0D0;
}

p {
	margin: 12px 15px 12px 15px;
}
</style>
</head>
<body>
	<div id="container">
		<h1><?php //echo $heading; //ou-specific ?>We're sorry</h1>
		<?php //echo $message; ?><p>We could not find the page you requested (404)
		<p><?php echo function_exists('anchor') ? anchor('', 'Go home') : '' ?>
		<p><img src="<?php echo defined('ERROR_ICON') ? ERROR_ICON : 'http://www.open.ac.uk/img/err_block_sm.jpg' ?>" alt="" />
	</div>
</body>
</html>