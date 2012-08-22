
<h1>Embedding Piwik widgets</h1>

<p>Visitor countries map (period: day; date: today; idSite:<?php echo $idsite ?> "Nick's test").


<p>
<div id="piwik-widgetIframe">
<iframe
 width="100%" height="350" src=
"<?php echo $piwik_url ?>?module=Widgetize&amp;action=iframe&amp;moduleToWidgetize=UserCountryMap&amp;actionToWidgetize=worldMap&amp;idSite=<?php echo $idsite ?>&amp;period=day&amp;date=today&amp;disableLink=1&amp;widget=1"
 scrolling="no"
 frameborder="0"
 x-marginheight="0" x-marginwidth="0"
 ></iframe>
</div>


<p><a href=
"<?php echo $piwik_url ?>?module=Widgetize&amp;action=iframe&amp;moduleToWidgetize=UserCountryMap&amp;actionToWidgetize=worldMap&amp;idSite=<?php echo $idsite ?>&amp;period=day&amp;date=today&amp;disableLink=1&amp;widget=1"
>(Iframe link: visitor countries map)</a>


<p class=cc-code><img title="Static graph" src=
"<?php echo $piwik_url ?>?module=API&amp;method=ImageGraph.get&amp;idSite=<?php echo $idsite ?>&amp;apiModule=VisitsSummary&amp;apiAction=get&amp;token_auth=anonymous&amp;graphType=evolution&amp;period=day&amp;date=previous30&amp;width=500&amp;height=250"
/>

