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


    public function getSitesIdFromSiteUrl($params = array())
    {
        $params = is_array($params) ? $params : array('url' => $params);
        $url = $this->_piwik_url('SitesManager.getSitesIdFromSiteUrl', $params);
        return $this->_get_decoded($url);
    }


    /**
     * Given a method and optional params generate a URL for the Piwik API.
     * @return string URL
     */
    protected function _piwik_url($method, $params = array(), $module = 'API')
    {
        $url = $this->piwik_url.'/index.php?'
            . http_build_query(array_merge(array(
                'module' => $module,
                'method' => $method,
                'format' => 'JSON',
                'token_auth' => $this->token,
            ),
            $params
        ));

        $obscure_token = substr($this->token, 0, strlen($this->token) - 4);
        @header('X-Piwik-Api-Url: '. str_replace($obscure_token, '***', $url));

        return $url;
    }


	protected function _extend_get_decoded($url) {
	    $this->_ci->load->library('Http');
		return json_decode($this->_ci->http->request($url));
	}
}

