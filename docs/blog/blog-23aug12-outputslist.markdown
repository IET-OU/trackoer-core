# Track OER -- outputs register #

* **Author**: NDF, 23 August-7 September 2012
* **Tags**: analytics   CaPReT   javascript   jisc   jiscri   oer   outputs   outputslist   php   piwik   project   TrackOER   ukoer
* **Link**: <http://cloudworks.ac.uk/cloud/view/6442>

We're developing re-usable software components at quite a rate. So I thought it best to note some meta-data as we go along. There will be technical detail, but I'll try to keep things readable for non-techies too!

### Useful tools ###

Note, these browser plugins are not just for developers!

* Get [Firebug][firebug] for the Firefox browser -- to view Javascript output, network activity and so on for the examples below,
* The [console in the Chrome][chrome-bug] browser,
* The [console in the Opera][opera-bug] browser,

<!-- Extra content -->

## AlternateImage -- Piwik plugin ##

* Purpose: To substitute a configurable graphic in place of [Piwik's][piwik] regular 1-pixel 'hidden' web-beacon ("web bug") GIF image. Currently supports/ includes Creative Commons License PNG images (88x31 pixels).
* Code link: [Github: IET-OU/ piwik-alternateimage-plugin][ietgit:piwik-alternateimage-plugin] 
* (Old code link: [Github: IET-OU/ piwik-trackoer/tree.../plugins/AlternateImage][piwikgit:tree/trackoer/plugins/AlternateImage])
* Example: <http://track.olnet.org/piwik/piwik.php?img=cc:by-sa&x=/2.0/uk/88x31&idsite=1&rec=0>
* Language: PHP, Piwik plugin.
* License: [GNU General Public License v2 or later][gpl2] (Piwik compatible)
* Date coded: 8 August 2012.
* Todos: 1. React to bug #4, [add hook in core/Tracker.php][piwikgit:issues/4]; 2. Separate out into an individual Git repository for submission to the Piwik plugins directory.
* Maturity: beta.
* Comments: The `img` GET parameter uses [Compact URI (CURIE)][curie] syntax, eg. `cc:by-sa/2.0/uk/88x31`. Now internationalized, and separated from "piwik-trackoer" fork.

## trackoer-page-url Javascript ##

* Purpose: To use the parsed License RDFa from "oer_license_parser.js" to form a custom page URL (path), suitable for use in "`_gat._trackPageview`" (Google Analytics), or the Piwik equivalent.
* Code link: [Github: IET-OU/trackoer-core/tree.../assets/public/js/trackoer-page-url.js][toergit:assets/public/js/trackoer-page-url.js]
* Example: <http://track.olnet.org/test/b2s_learn_gajs?parsedfa=1#cc-code> (View source, or output in Firebug, Chrome console etc.)
* Language: Javascript (not jQuery dependent).
* License:
* Date coded: 17 August 2012.
* Todos: None.
* Maturity: Beta
* Comments: Superceded by "trackoer-ga.js" (I realised the parsed-RDFa route was a bit complicated and not too robust!)

## trackoer-ga Javascript ##

* Purpose: To form a custom page URL from an input argument ('`custom_hash`') to be fed to "`_gat._trackPageview`" (Google Analytics), or Piwik equivalent.
* Code link: [Github: IET-OU/ trackoer-core/tree.../assets/public/js/trackoer-ga.js][toergit:assets/public/js/trackoer-ga.js]
* Example: <http://track.olnet.org/test/b2s_learn_gajs?param1=value1#cc-code> (View source, and/or use Firebug, Chrome console..)
* Language: Javascript (not jQuery).
* License:
* Date coded: 20 August 2012.
* Todos: Take the Google Analytics-insertion code out?
* Maturity: alpha
* Comments: Supercedes "trackoer-page-url.js" -- less complicated.

## capret-piwik Javascript ##

* Purpose: A slot-in replacement for "classic" capret.js, this Javascript inserts a Piwik web-beacon ("web bug") image in place of the CaPReT-hosted GIF image. Bridges the CaPReT cut and paste tracking into Piwik.
* Code link: [Github: IET-OU/ trackoer-core/ .../assets/capret/js/capret-piwik.js][toergit:assets/capret/js/capret-piwik.js]
* Example: <http://track.olnet.org/test/capret/math/course-piwik> (View source and/or use Firebug, Chrome console..)
* Language: Javascript (jQuery plugin)
* License: [MIT probably][mit] (CaPReT-compatible)
* Date coded: 21 August 2012.
* Todos: Deploy my fix for Internet Explorer.
* Maturity: Alpha.
* Comments: Currently in testing with the OU's LTS technical testing team! (Works with jquery.plugin.clipboard.js, oer_license_parse.js and optionally json2.js.)

## UML diagrams -- documentation ##

* Purpose: To help me work out interconnections, and to help explain the PHP class framework to others!
* Code link: [Github: IET-OU/trackoer-core/tree/master/docs][toergit:../docs]
* Example:  <http://track.olnet.org/docs/trackoer-controller-classes-yuml-v2.png>
* Language: Unified Modelling Language (UML).
* License: [Creative Commons Attribution 3.0 Unported License][cc-by] (or GNU FDL) - documentation.
* Date coded: 14-21 August 2012.
* Todos: incorporate in written documentation!
* Maturity: ongoing
* Comments: We use [yUML.me][yuml] - thanks guys!

![Track OER controller classes yUML][yuml-controller]


## Piwik_Tracker::track ##

* Purpose: To map/ redirect input parameters and HTTP Headers to a Piwik tracking URL that works for OERs. For no-Javascript tracking.
* Code link: [Github: IET-OU/trackoer-core .../trackers/Piwik_Tracker.php][toergit:libraries/trackers/Piwik_Tracker.php#L70]
* Example: [http://track.olnet.org/track/r/piwik/2/cc:by-nc-sa/labspace.open...&t=Learning..][toer-b2s-page] (Tracks a specific 'page' or course section)
* Language: PHP
* License:
* Date coded: 9 August 2012.
* Todos: Code the matching Google Analytics redirector/ tracking-URL generator?
* Maturity: beta.
* Comments: We need to evaluate the usefulness/ robustness of no-Script v. Javascript methods for the various scenarios - as [proposed by Tony Hirst][hirst-comment].

## ContentReuse -- Piwik plugin ##

* Purpose: A Piwik plugin to ensure that the HTTP referer header is read/used/logged (in the "`url`" parameter), even if the "`urlref`" Piwik parameter is present.
* Code link: [Github: IET-OU/ piwik-contentreuse-plugin][ietgit:piwik-contentreuse-plugin]
* Example: '..
* Language: PHP, Piwik plugin.
* License: [GPL v2 or later][gpl2] (Piwik compatible)
* Date coded: 24 August 2012.
* Todos:
* Maturity: beta.
* Comments: To be used with "capret-piwik.js" Javascript.

## CLI/ command line batch processor ##

* Purpose: An initial solution to inject a license-tracking snippet in the HTML pages in OpenLearn-LabSpace/ [B2S][b2s] download packages (Zip, SCORM etc.).
* Code link: [Github: IET-OU/ trackoer-core/ ...controllers/ Cli::batch][toergit:controllers/cli.php#L138]
* Example: [Github: .../config/ batch_config.sample][toergit:config/batch_config.sample.php] `$ php index.php cli/batch --url=http://labspace.open.ac.uk/..`
* Language: PHP
* License: free/open source license (TBD)
* Date coded: 21-28 August 2012.
* Todos: Initial testing this week (29 August).
* Maturity: beta.
* Comments: Currently inserts Google Analytics Javascript tracking. We are looking at XSLT solutions for production use on OpenLearn/LabSpace content.

## CaPReT -- pull request #10 ##

* Purpose: Merging some fixes and additions from IET-OU into the main CaPReT development.
* Code link: [Github: tatemae/capret/pull/10][github:tatemae/capret/pull/10] -- 6 commits
* Example: N/A
* Language: Javascript
* License: [MIT][mit] (CaPReT compatible)
* Date coded: 30 August 2012.
* Todos:
* Maturity:
* Comments:


## Code samples -- Gists ##

* [Example of CaPReT-Piwik Javscript plugin use, with Piwik configuration][gist:3437266]


[firebug]: http://getfirebug.com/
[chrome-bug]: https://developers.google.com/chrome-developer-tools/docs/console
[opera-bug]: http://www.opera.com/dragonfly/documentation/console/
[gpl2]: http://gnu.org/licenses/gpl-2.0.html "GNU General Public License v2 or later"
[mit]: http://opensource.org/licenses/MIT
[cc-by]: http://creativecommons.org/licenses/by/3.0/
[curie]: http://w3.org/TR/curie/
[yuml]: http://yuml.me/
[yuml-controller]: http://track.olnet.org/docs/trackoer-controller-classes-yuml-v2.png
[hirst-comment]: http://cloudworks.ac.uk/cloud/view/6433#comment-6111
[b2s]: http://labspace.open.ac.uk/b2s

[toer-b2s-page]: http://track.olnet.org/track/r/piwik/2/cc:by-nc-sa/labspace.open.ac.uk/Learning_to_Learn_1.0/?p=mod/oucontent/view.php?id=471422&section=3&t=Learning+to+Learn

[gist:*]: http://gist.github.com/
[github:*]: https://github.com/
[ietgit:*]: https://github.com/IET-OU/
[piwikgit:*]: https://github.com/IET-OU/piwik-trackoer/
[toergit:*]: https://github.com/IET-OU/trackoer-core/tree/master/application/

*[CaPReT]: CaPRéT - cut and paste reuse tracking
*[SCORM]: Sharable Content Object Reference Model
*[UML]: Unified Modelling Language
*[XSLT]: Extensible Stylesheet Language Transformations
*[OU]: The Open University
*[LTS]: Learning and Teaching Solutions

<!--
 Extra Content
 http://cloudworks.ac.uk/content/edit/1502
 ..
 http://cloudworks.ac.uk/content/edit/1514
-->