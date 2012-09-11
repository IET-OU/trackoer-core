<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Track OER
 *
 * A web application to facilitate analytics for Open Educational Resources.
 *
 * @package		trackoer-core
 * @copyright	Copyright 2012 The Open University.
 * @author		N.D.Freear, 11 August 2012 (21:28)
 * @license
 * @filesource
 */


// http://openlearn.open.ac.uk/course/view.php?id=2355&format=rdf
class Openlearn_track_serv extends Moodle_rdf_serv {

  public $regex = 'http://(openlearn|labspace).open.ac.uk/*';
  public $about = <<<EOT
  Explore | Try | Study
  Get the tracker-enabled Creative Commons license snippet for an OpenLearn/LearningSpace/LabSpace OER. [For JISC Track OER. Public access.]';
EOT;
  public $displayname = 'OpenLearn';
  public $domain = 'openlearn|labspace).open.ac.uk';
  public $subdomains = array('labspace).open.ac.uk');
  public $favicon = 'http://openlearn.open.ac.uk/theme/oci/favicon.ico';
  public $type = 'rich';

  public $_about_url= 'http://open.edu/openlearn';
  public $_logo_url = 'http://open.edu/includes/headers-footers/oulogo-56.jpg';

  public $_regex_real = ':\/\/(openlearn|labspace|openlearnacct|labspaceacct).open.ac.uk\/(([\w_\.]+)|(course)\/view.php\?.+|(mod)\/oucontent\/view.php\?.+)$';
  #public $_regex_real = ':\/\/(openlearn|labspace).open.ac.uk\/(course|mod)\/(oucontent\/)?view(.php)?\?.+';
  public $_examples = array(
    'Course: Learning to Learn - B2S on LabSpace'
        => 'http://labspace.open.ac.uk/Learning_to_Learn_1.0',
    'Course: Learning to Learn - B2S on LabSpace (name)'
    => 'http://labspace.open.ac.uk/course/view.php?name=Learning_to_Learn_1.0',
    'Course: Learning to Learn - B2S on LabSpace (id)'
        => 'http://labspace.open.ac.uk/course/view.php?id=7442',
    'Page: Learning to Learn ► 2.3 Gathering Evidence—Your... - B2S on LabSpace'
    => 'http://labspace.open.ac.uk/mod/oucontent/view.php?id=471422&section=3',
    '_RDF' => 'http://labspace.open.ac.uk/course/view.php?id=7442&format=rdf',
    '_OEM' => '/oembed?url=http%3A//labspace.open.ac.uk/Learning_to_Learn_1.0',
    '_OEM_2' => '/oembed?url=http%3A//labspace.open.ac.uk/mod/oucontent/view.php%3Fid=471422%26section=3',
    '_USE' =>
'http://reuser.example.edu/a/page#!Learning_to_Learn_1.0!mod/oucontent/view.php?id=471422&section=3',
  );
  public $_access = 'public';


  // 'call' is implemented in the parent..


  protected function _get_attribution($rdf) {
    $url = $rdf->original_url;

    if ('B2S' == $rdf->subject) {
      $rdf->attribution_name = 'OpenLearn-LabSpace / Bridge to Success (B2S)'; #' / ' . $rdf->contributor;
      $rdf->attribution_url = 'http://labspace.open.ac.uk/b2s';
    }
    elseif (FALSE !== strpos($url, 'labspace.open.ac.uk')) {
      $rdf->attribution_name = 'OpenLearn-LabSpace / '. $rdf->publisher;
      $rdf->attribution_url = 'http://labspace.open.ac.uk/';
    }
    elseif (FALSE !== strpos($url, 'openlearn.open.ac.uk')) {
      $rdf->attribution_name = 'OpenLearn-LearningSpace / '. $rdf->publisher;
      $rdf->attribution_url = 'http://openlearn.open.ac.uk/';
    }
    elseif (FALSE !== strpos($url, 'open.edu/openlearn')) {
      $rdf->attribution_name = 'OpenLearn / The Open University';
      $rdf->attribution_url = 'http://www.open.edu/openlearn/';
    }
    else {
      $rdf->attribution_name = 'The Open University';
      $rdf->attribution_url = 'http://www.open.ac.uk/';
    }
    return $rdf;
  }
}

