# Track OER -- challenges & lessons #

* **Author**: NDF, 14 August-16 October 2012
* **Tags**: analytics  challenges  jisc  jiscri  lessonslearnt  oer  piwik  project  TrackOER  ukoer
* **Link**: <http://cloudworks.ac.uk/cloud/view/6431>


NOTE: a work-in-progress!

We'll be documenting the various challenges we're experiencing, and the lessons learnt.

<!-- Extra content -->


## Re-purposing analytics software (Google Analytics, Piwik) ##

Problem type:  technical/ user-interface

Problem:  Analytics tools are conventionally used in scenarios where the person viewing the reports knows the URL where the pages reside. In trying to track OER re-use, we present a different scenario where the destination URL is unknown (and the server component is variable).

Solutions:  For Piwik, creative use of the '`url`' and '`urlref`' parameters in the [tracking API][track-api]. For Google Analytics, creating and documenting custom reports, which reveal for example the destination 'hostname' (not reported by default).

## Acommodating the OpenLearn test and release cycle ##

Problem type: technical/ management

Problem:  We are demonstrating the Track OER technologies on OpenLearn-LabSpace, and this needs some technical changes to LabSpace, which need testing before deployment.

Solution:  Schedule testing early, plan, liase with OpenLearn colleagues.

## Lessons learnt -- short intense projects can be productive ##

_"towards of the end of the project, a list of lessons that someone like you would find useful"_

Like many development teams we are currently very busy, so we planned the development for Track OER as a classic _"short intense"_ project (aka, short fat project) ([KENDRICK, Tom. (2011). 11. How should I manage short, complex, dynamic projects?. In: - _101 Project Management Problems and How to Solve Them: Practical Advice for ..._ -: Amacom. p28.][book-pm]). Having a developer working at nearly 100% on the project in a relatively short burst (first commit 8 or 9 August -- development tailing off in the third week of September 2012) ([Project activity graph on Github][toer-graph]) proved to be effective. So one of my big lessons learnt is that scheduling a short intense project, with planning and preparation beforehand, can be a good idea.

[![Project activity graph on Github][toer-graph-img]][toer-graph]


[track-api]: http://piwik.org/docs/tracking-api/reference/ "Piwik tracking interface documentation"
[book-pm]: http://books.google.co.uk/books?id=6KXOxHIQEwIC&pg=PA28&dq=short+intense+project+management
[toer-graph]: https://github.com/IET-OU/trackoer-core/graphs/commit-activity "Project activity graph on Github"
[toer-graph-img]: https://lh4.googleusercontent.com/grsNsFUomahiKJqpRRFed9ZcLnWTxOXGKaeWfX--yRlEf7i0pcQjS5dBfJhNxUhId9ROR8bx3NSQLQYNNNK5BQlDDdTnWe4vMBPf-bi1i8889qTGYyQM

<!--
 Extra Content
 http://cloudworks.ac.uk/content/edit/1499
 ..
 http://cloudworks.ac.uk/content/edit/1524
-->
