<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
|--------------------------------------------------------------------------
| Common references for Markdown reference-style labels, with Internationalization @i18n
|--------------------------------------------------------------------------
| @link http://michelf.ca/projects/php-markdown/dingus/
|
| Note, this file is a cross between a config file and a view! -- t() is safe here.
*/
?>

[ga]: https://www.google.com/analytics/ "<?php echo t('Google Analytics') ?>"
[piwik]: http://piwik.org/ "<?php echo t('Piwik open source web analytics') ?>"
[capret]: http://capret.mitoeit.org/ "<?php echo t('Cut and Paste Reuse Tracking') ?>"
[cc]: http://creativecommons.org/ "<?php echo t('Creative Commons') ?>"
[cc-api]: http://api.creativecommons.org/ "Creative Commons API"
[oembed]: http://oembed.com/ "<?php echo t('oEmbed specification') ?>"

[blog]: <?php echo BLOG_URL ?> "<?php echo t('%s project blog, on %s', array(t('Track OER'), 'Cloudworks')) ?>"
[code]: <?php echo CODE_URL ?> "<?php echo t('%s project code, on %s', array('Track OER', 'GitHub')) ?>"
[jisc]: http://www.jisc.ac.uk/ "Joint Information Systems Committee"
[hefce]: http://www.hefce.ac.uk/ "Higher Education Funding Council for England"
[oerri]: <?php echo OERRI_URL ?> "OER Rapid Innovation strand at JISC (OERRI)"
[feed2js]: http://feed2js.org/ "Powered by Feed2JS"
[gcse]: http://www.google.com/cse/home?cx=<?php echo SEARCH_GCSE_ID ?> "Powered by Google custom search"
[ou]: http://www.open.ac.uk/ "<?php echo t('The Open University') ?>"
[iet]: http://iet.open.ac.uk/ "<?php echo t('Institute of Educational Technology') ?>"


<?php
/* php-markdown-extra: abbreviations - case-sensitive.
*/
?>
*[URL]: Uniform resource locator,
*[API]: <?php echo t('Application programming interface') ?>,
*[OER]: <?php echo t('Open Educational Resource') ?>,
*[CaPRéT]: <?php echo t('Cut and Paste Reuse Tracking') ?>,
*[JISC]: Joint Information Systems Committee
*[HEFCE]: Higher Education Funding Council for England
*[B2S]: Bridge to Success project
*[ISP]: Internet service provider
*[GA]: Google Analytics
*[MSIE]: Microsoft Internet Explorer browser
*[B2S]: Bridge to Success project


<?php
/* markdown_extended_ex.php: Interwiki links - case-sensitive.
*  Note, if just php-markdown-extra is used then these references are hidden in output - good!
*/
?>
[@:*]: https://twitter.com/
[In:*]: http://linkedin.com/
[Define:*]: http://google.com/search?q=define%3A
[Wiki:*]: http://en.wikipedia.org/wiki/
[Gdoc:*]: https://docs.google.com/document/d/
[Gdev:*]: https://developers.google.com/
[Slideshare:*]: http://slideshare.net/

[Cloud:*]: http://cloudworks.ac.uk/cloud/view/
[Labspace:*]: http://labspace.open.ac.uk/
[Toer:*]: http://track.olnet.org/

