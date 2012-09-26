
# Status, 26 September, CaPReT-GA, testing, performance - Track OER

Some further notes..:

 * Thu, 13 sep - Capret/MSIE - comment / help 'page',
 * Thu, 13 sep - Capret/-piwik/-ga - fixes for jQuery 1.3.2/ Drupal 6.x,
 * Thu, 13-14 sep - Capret-GA,
 * Wed, 12 sep - Nick/ Guy meeting, JISC RI team meeting,
 * Thu, 20 sep - Nick/ Laura Dewis meeting,
 * Tue, 25 sep - Test round 3,
 * Fri, 14 sep - Javascript compression/ minification - performance,
 * 28 aug, 13 sep, 25 sep - GA custom reports, location/ service provider
 * Markdown - ?


["What is meant by ip pools[?]", answer: BFD_Diplomacy, 11/05/2010](http://productforums.google.com/forum/#!topic/analytics/_KiE0C6gGtg)

>"
> Yes, it is a collection of ISP's. 
>
>  It's BT and the multitude of other ISP's who resell their ADSL infrastructure all bundled into one pot.
>"

---


I'm a bit behind with my blogging and I have lot's to talk about, so let's dive in...

Way back on the 12 September I had two very useful meetings, including one with the wider Track OER team/group. The response to our progress on the technical activities was positive. Some significant outcomes from the meetings were:

 * Can we take the [CaPReT][capret]-Piwik work and extend it to [Google Analytics][ga]? After some discussion we decided that this was my next high priority task.
 * A suggestion from [Guy Barrett][@:guybarrett] regarding the [CaPReT-MSIE problem][cloud:6474] - can we put a HTML comment into the pasted content, to offer the user some help? `<!--...-->`
 * Can we ensure that CaPReT/-Piwik/-GA works with Drupal 6 - jQuery 1.3.2 (ie. an old version of the jQuery Javascript library)?
 * Can we ensure that the CaPReT Javascripts do not degrade the page load-times for OpenLearn, LabSpace and so on? ([Performant isn't a word](http://weblogs.asp.net/jgalloway/archive/2007/05/10/performant-isn-t-a-word.aspx).. [it is now][Define:performant].)

I got stuck into Guy's suggestion straight away, and extended it to include a link to [further sources of help][Toer:help/capret/ie]. You can see an [example of the comment in this Google Doc][Gdoc:1aGNOPFACD5KUbSPHELy9CVlrj2AJUzY18YJIZgJjrqI/edit].

I'm pleased to say that we have at least a partial solution for CaPReT-GA. I've used [Google Analytics event tracking][Gdev:analytics/devguides/collection/gajs/eventTrackerGuide], with actions of 'copy' and 'view', the copied text as the event label, and the length of the copied text as the event value (for copy only). The copy action is fully tracked (source host and URL), but we haven't been able to get the destination host/URL. This seems to be a limitation of Google Analytics. A CaPReT copy uses Javascript, while the tracker that is added to the copied text and used to track views of the pasted content is a no-Javascript web beacon (web bug). You may like to view an [example of CaPReT-GA][Toer:test/capret/math/course-ga] - and try copying.

We've done some work on performance too, using Google's [online Closure Compiler][closure] to [compress the CaPReT Javascripts][Toer:build/capret]. If you wish to add a version of jQuery and change "whitespace-only" to "simple optimizations", [try this build script][Toer:build/capret/simple/1.8.0]. The [minified CaPReT-GA Javascript is here][Toer:capret/build/capret-ga.min.js]

The third round of technical testing was put back a week, but I'm happy to say that Roger Moore and Mick Deal have shown great flexibility. Testing is underway this week, [using this test script][Gdoc:1-NUFoxRB2U2xha1TvHC5D25ZYTUPwIv5EDFLf9dVN5M/edit]. It concentrates on B2S testing with campaign tracking, CaPReT-GA testing, and a new strand C, testing the [OER Form service and bookmarklet][Toer:oerform?edge=1]. I haven't talked much about this last point, but I'll leave that for a future post.

Nick, signing off. Over and out..


---

[closure]: http://closure-compiler.appspot.com/home
[blog-perf]: http://weblogs.asp.net/jgalloway/archive/2007/05/10/performant-isn-t-a-word.aspx

[define:*]: http://google.com/search?q=define%3A

