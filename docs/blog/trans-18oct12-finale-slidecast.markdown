# Track OER - grand finale slide cast #

[![Three minute slide cast by lead developer, Dr Nick Freear, 2012-10-19][yt-img-freear]][yt-vid-freear]

## Transcript ##

* Slide 1

  TRACK OER was a project to demonstrate technical solutions to the problem of tracking Open Educational Resources (OERs). It was funded by JISC and undertaken at The Open University from March to October 2012.

* Slide 2: What problem were we trying to solve?

  Universities know who is viewing OERs when they are on their own servers. However, they lose track of them when they are taken elsewhere and reused.

  And that's bad for the continued funding and development of OERs.

* Slide 3: Early on we decided to pilot Track OER on the [Bridge to Success][b2s-site] content on The OU's [OpenLearn-LabSpace][b2s-site].

* Slide 4: The project comprised two strands...

  * A: To add license-tracker codes to downloadable Zip archives on LabSpace -- you can think of this as formal or bulk reuse,

  * B: To improve CaPRéT (cut and paste reuse tracking) and integrate it in LabSpace -- think of this as informal reuse.

* Slide 5: During the project we've used loads of software, mostly open source..

  ..Including [Piwik][piwik], Google Analytics, [CaPRéT][capret], the [Creative Commons API][ccapi], and [CodeIgniter][ci].

* Slide 6: We re-purposed Piwik analytics to track Zips and CaPReT/cut and paste..

  Here you can see a Piwik report for CaPReT. The highlighted bit shows tracking of the pasted content on Cloudworks. We can see where it is copied from, what was copied, where it was pasted to and so on.

* Slide 7: Although Piwik is interesting, Google Analytics is more widely used, including on OpenLearn..

  ..Here you can see a Google Analytics report for Zip re-use. The origin link is encoded within the destination URL.

* Slide 8: ..And we can get geographical data related to content reuse..

* Slide 9: For the geeks among you slide 9 gives an outline of a typical license-tracker snippet..

  ..With License RDFa and extended Google Analytics Javascript

* Slide 10: The [core Track OER software][code] combines three user-interfaces in one...

   ..That's Web, an [online] API and batch processing from the command line.

* Slide 11: There are many outputs from Track OER, all licensed under GPL-compatible open source licenses.

  See the [outputs register][outputslist] for details

* Slide 12: So, What have we learnt?

  Well, with careful planning, short intense projects can work. Oh and, book in plenty of testing.

* Slide 13: Next steps include deploying the tested and approved code to LabSpace, developing XSLT templates for OpenLearn based on our PHP specification and more dissemination work.

* Slide 14: Visit the Track OER project at, <http://track.olnet.org>

  Thanks for watching!


[toer]: http://track.olnet.org/
[blog]: http://cloudworks.ac.uk/tag/view/TrackOER
[outputslist]: http://cloudworks.ac.uk/cloud/view/6442
[code]: https://github.com/IET-OU/trackoer-core
[b2s]: http://labspace.open.ac.uk/b2s
[b2s-site]: http://b2s.aacc.edu/
[capret]: http://capret.mitoeit.org/
[piwik]: http://piwik.org/
[oerc]: http://oercommons.org/
[ccapi]: http://api.creativecommons.org/
[cc-by]: http://creativecommons.org/licenses/by/3.0/
[ci]: http://codeigniter.com/
[gpl2]: http://gnu.org/licenses/gpl-2.0.html "GNU General Public License v2 or later"
[@ndf]: http://twitter.com/nfreear

[pod-freear]: http://podcast.open.ac.uk/pod/trackoer#!811d8699eb "Finale slide cast by Nick Freear, on OU Podcasts"
[yt-list]: http://youtube.com/playlist?list=PLbk9PlEH5tn1tLS3oXh_zYUJ5AczPOCpM
[yt-vid-freear]: http://youtu.be/pKioYCPigCo "Finale slide cast by Nick Freear, on YouTube"
[yt-img-freear]: http://i1.ytimg.com/vi/pKioYCPigCo/hqdefault.jpg
[slides-freear]: https://docs.google.com/presentation/pub?id=1LmFrSDU5-jP1Ff34Vee8ug2D7-yq6Ut9nAULC2Ln2lY&start=false&loop=false&delayms=3000 "Slides on Google Docs"

