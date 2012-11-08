## Search OERRI

Search within all the project blogs for the [OER Rapid Innovation][oerri] projects <a id=gsc-r0 href="#results">&rarr; Results</a> <small>| [Google CSE][gcse].</small>

<!-- Put the following javascript before the closing </head> tag. -->
<script>
var gcse_callback = function() {

  //$.log('GCSE search fired.');

  if (document.readyState == 'complete') {
    // Document is ready when CSE element is initialized.

    $('.gsc-control-cse').attr({ id: 'cse' });

    setTimeout(function () {
      $('.gsc-resultsbox-visible').attr({ id: 'results' });

      var r = $('#results');
      if (r.length == 0) {
        $('#gsc-r0').css({ display: 'none' });
      }
    }, 1400); // A hack!

    $.log('GCSE search complete.');

<?php    // Render an element with both search box and search results in div with id 'test'.
    /*google.search.cse.element.render(
        {
          div: "test",
          tag: 'search'
         });*/
?>
  }<?php /*else {
    // Document is not ready yet, when CSE element is initialized.
    google.setOnLoadCallback(function() {
       // Render an element with both search box and search results in div with id 'test'.
        google.search.cse.element.render(
            {
              div: "test",
              tag: 'search'
            });
    }, true);
  }*/ ?>
};

// Insert it before the CSE code snippet so that cse.js can take the script
// parameters, like parsetags, callbacks.
window.__gcse = {
  //parsetags: 'explicit',
  callback: gcse_callback
};

(function () {
  var cx = '<?php echo SEARCH_GCSE_ID ?>';
  var gcse = document.createElement('script'); gcse.type = 'text/javascript'; gcse.async = true;
  gcse.src = (document.location.protocol == 'https:' ? 'https:' : 'http:') +
        '//www.google.com/cse/cse.js?cx=' + cx;
  var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(gcse, s);
})();
</script>
<!-- Place this tag where you want both of the search box and the search results to render -->
<!-- https://developers.google.com/custom-search/docs/element#javascript -->
<gcse:search autoSearchOnLoad="true"></gcse:search>

<!--<div class="gcse-searchbox" data-autoSearchOnLoad="true" ></div>-->