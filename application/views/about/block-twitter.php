
<div id=twitter>
<?php /*
 https://twitter.com/about/resources/widgets/widget_search
*/ ?>
<script charset="utf-8" src="http://widgets.twimg.com/j/2/widget.js"></script>
<script>
new TWTR.Widget({
  version: 2,
  type: 'search',
  search: '<?php echo TWITTER_SEARCH ?>',
  interval: 30000,
  title: 'Track OER',
  subject: 'A JISC-funded project',
  width: 250,
  height: 300,
  theme: {
    shell: {
      background: '#52879e',
      color: '#ffffff'
    },
    tweets: {
      background: '#ffffff',
      color: '#444444',
      links: '#1985b5'
    }
  },
  features: {
    scrollbar: true,
    loop: true,
    live: true,
    behavior: 'default'
  }
}).render().start();
</script>
</div>