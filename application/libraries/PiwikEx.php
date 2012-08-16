<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter Piwik Class - extended.
 *
 * Library for retrieving stats from Piwik Open Source Analytics API
 * with geoip capabilities using the free MaxMind GeoLiteCity database
 *
 * @package       CodeIgniter
 * @subpackage    Libraries
 * @category      Libraries
 * @author
 * @license       MIT
 *
 * @link  https://github.com/wingdspur/codeigniter-piwik
 * @link  http://piwik.org/docs/analytics-api/reference/#toc-module-sitesmanager
 */
require_once APPPATH .'/libraries/Piwik.php';


class PiwikEx extends Piwik {

    /**
     * version
     * Get the version of Piwik.
     *
     * @access  public
     * @return  string
     */
    public function getVersion()
    {
        $url = $this->_piwik_url('API.getPiwikVersion');
        $result = $this->_get_decoded($url);
        return isset($result['value']) ? $result['value'] : NULL;
    }

    /**
     * Get..
     *
     * @access  public
     * @return  array
     */
    public function getAllSites()
    {
        $url = $this->_piwik_url('SitesManager.getAllSites');
        return $this->_get_decoded($url);
    }


    public function getSitesIdFromSiteUrl($site_url)
    {
        $url = $this->_piwik_url('SitesManager.getSitesIdFromSiteUrl')
            .'&url='.urlencode($site_url);
        return $this->_get_decoded($url);
    }


    protected function _piwik_url($method, $module = 'API')
    {
        return $this->piwik_url.'/index.php?module='.$module
            .'&method='.$method.'&format=JSON&token_auth='.$this->token;
    }


	protected function _extend_get_decoded($url) {
	    $this->_ci->load->library('Http');
		return json_decode($this->_ci->http->request($url));
	}
}

