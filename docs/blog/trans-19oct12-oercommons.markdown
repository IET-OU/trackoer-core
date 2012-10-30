# Track OER/ OER Commons bookmarklet service #

* **Author**: [NDF][@ndf], 18-19 October 2012
* **Tags**:
* **Link**: <http://cloudworks.ac.uk/cloud/view/6569>


Transcript for a [screen cast on OU Podcasts][pod]. Also available [via YouTube][youtube-list].

[![Watch the screen cast on YouTube][youtube-img]][youtube-vid]

## Transcript ##

[Track OER][toer] is a JISC-funded project to demonstrate technical solutions to the problem of tracking OER (Open Educational Resources). As part of the Track OER project we have developed a service to add license-tracker snippets to resources available through the [OER Commons][oerc] portal.

And, here's how it works:

 1. First visit the link track dot olnet dot org and put at the end a question mark, edge equals one, <http://track.olnet.org/?edge=1> (this just means use experimental features)
 2. Then make sure your browser's bookmarklets/ bookmarks bar is available
 3. Then drag the bookmarklet that's in the bottom-left of the site to your bookmarks or favourites bar,
 4. Now visit OER Commons, <http://oercommons.org>
 5. Browse using the menus on the left, among the materials. I'll choose something from the Arts section. Here's a resource available through OER Commons, the Aaron Copland Collection,
 6. Then simply click on the bookmarklet you saved previously..
 7. Wait a few [moments]…
 8. And view the resulting license-snippet. You get a preview here, and some copy and paste here.

By default the snippet uses [Piwik][piwik] no-Javascript tracking and a [Creative Commons Attribution License][cc-by]. You can switch to Google Analytics, here, like so… Here's the Google Analytics [Java]script…

Additionally, you can change the license, for example using… the Attribution-NonCommercial-ShareAlike [License] like so.

Currently the Track OER bookmarklet service is mostly a demonstration. It can be used by a publisher on small batches of OERs. Download the [Track OER code][code] and consider integrating it into your publishing workflow for full scale integration of tracking. We are considering extending the current functionality into an “*Embed Me*” or “*Embed 'n' Track*” service for OpenLearn and OER Commons.

[*Watch this space*][toer]!


[pod]: http://podcast.open.ac.uk/pod/trackoer#!b9379af9b7
[youtube-vid]: http://youtu.be/UWCBAt8_UH4 "Watch the screen cast on YouTube"
[youtube-img]: http://i2.ytimg.com/vi/UWCBAt8_UH4/hqdefault.jpg
[youtube-list]: http://youtube.com/playlist?list=PLbk9PlEH5tn1tLS3oXh_zYUJ5AczPOCpM
[toer]: http://track.olnet.org/
[blog]: http://cloudworks.ac.uk/tag/view/TrackOER
[code]: https://github.com/IET-OU/trackoer-core
[b2s]: http://labspace.open.ac.uk/b2s
[capret]: http://capret.mitoeit.org/
[piwik]: http://piwik.org/
[oerc]: http://oercommons.org/
[ccapi]: http://api.creativecommons.org/
[ccfm]: http://creativecommons.org/choose/
[cc-by]: http://creativecommons.org/licenses/by/3.0/
[ci]: http://codeigniter.com/
[@ndf]: http://twitter.com/nfreear

