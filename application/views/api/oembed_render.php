<?php
/** oEmbed XML/JSON/JSON-P renderer view.
*/

// 'Services' controller.
if (! isset($not_oembed)) {
  $oembed['version'] = "1.0";
}

if (isset($oembed['description'])) {
  $oembed['description'] = str_replace(array('    ', '  ', "\r", "\n"), array(' ', ''), $oembed['description']);
}

if ('json'==$format):
  //application/json+oembed
  if ($this->input->get('debug') || $callback) {
    // text/javascript if there is a callback.
    @header('X-content-type: application/json-p');
    @header("Content-Type: application/javascript; charset=UTF-8");
  } else {
    @header("Content-Type: application/json; charset=UTF-8");
  }

  // I'm not sure that PHP json_decode likes newlines(?)
  if (isset($oembed['html'])) {
      $oembed['html'] = str_replace(array('  ', "\r", "\n"), array(' ', ''), $oembed['html']);
  }

  $json = json_encode($oembed);
  $json = str_replace('"dc:', '"dc$', $json); //XML namespaces - check Gdata.
  $json = str_replace(',"',  ','.PHP_EOL.'"', $json);
  //Pretty-print?
  if ($callback) {
    $json = "$callback($json)";
  }
  echo $json;
else:
  @header("Content-Type: application/xml; charset=UTF-8");
  echo '<?xml version="1.0" encoding="UTF-8"?>';
//xmlns="http://oembed.com"

function _xml_element($obj) {
  $output = '';
  foreach ($obj as $key => $value) {
    // Add '_key' and '0' keys to the 'ex:' namespace.
    $key = '_' == $key[0] ? 'ex:'. $key : $key; //0===strpos($key, '_')
    $key = is_numeric($key) ? 'ex:n'. $key : $key;
    $output .= "<$key>". (is_array($value) || is_object($value) ? _xml_element($value) : htmlspecialchars($value)) /*WARNING: recurse! */ ."</$key>".PHP_EOL;
  }
  return $output;
}

?>
<oembed xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:ex="<?php echo XMLNS_OU_OEMBED_EXTEND ?>" xml:lang="en">
<?php echo _xml_element($oembed);
/* foreach ($oembed as $key => $value): ?>
  <<?php echo"$key>". (is_string($value) ? htmlspecialchars($value) : $value) /*TODO: more work? *-/ ."</$key" ?>>
<?php endforeach;*/ ?>
</oembed>
<?php
endif;