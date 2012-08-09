<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter Piwik Helper
 *
 * Helper for echoing piwik tracking tag based on what
 * is defined in config/piwik.php. Load helper in the controller
 * or autoload and call piwik_tag() before closing body tag.
 *
 * @package       CodeIgniter
 * @subpackage    Helpers
 * @category      Helpers
 * @author        Bryce Johnston bryce@wingdspur.com
 */

function piwik_tag()
{
    $CI =& get_instance();
    $CI->load->config('piwik');
    
    $piwik_url = $CI->config->item('piwik_url');
    $piwik_url_ssl = $CI->config->item('piwik_url_ssl');
    $site_id = $CI->config->item('site_id');
    $tag_on = $CI->config->item('tag_on');
       
    if($tag_on)
    {
        $tag = '<script type="text/javascript">
        var pkBaseURL = (("https:" == document.location.protocol) ? "'.$piwik_url_ssl.'/" : "'.$piwik_url.'/");
        document.write(unescape("%3Cscript src=\'" + pkBaseURL + "piwik.js\' type=\'text/javascript\'%3E%3C/script%3E"));
        </script><script type="text/javascript">
        try {
        var piwikTracker = Piwik.getTracker(pkBaseURL + "piwik.php", '.$site_id.');
        piwikTracker.trackPageView();
        piwikTracker.enableLinkTracking();
        } catch( err ) {}
        </script><noscript><p><img src="'.$piwik_url.'/piwik.php?idsite='.$site_id.'" style="border:0" alt="" /></p></noscript>';
        
        echo stripslashes($tag);
    }
}

?>