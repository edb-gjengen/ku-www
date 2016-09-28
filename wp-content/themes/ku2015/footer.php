<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package ku2015
 */
?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div id="about" class="grid whole">
				<p>
					Kulturutvalget ble stiftet i 1947, men ivaretar det som har vært Det Norske Studentersamfunds kjernevirksomhet og viktigste tradisjon siden stiftelsen i 1813, nemlig meningsytring og kritisk tenkning blant Oslos studenter. Vi arrangerer ukentlige debatter, foredrag og samtaler om politikk, litteratur og vitenskap.<br>
					Lyst til å være med på forvalte arven videre? Ta kontakt!<br>
				</p>
				<a href="/bli-aktiv/">Bli aktiv</a>
				<a href="/om-oss/">Les mer</a>
			</div>
		<div id="home">
			<a href="/">Hjem</a>
			<a href="#">Til toppen</a>
		</div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<div id="site-info">
			Kulturutvalget er en del av <a href="https://studentersamfundet.no">Det Norske Studentersamfund</a><br>
			Laget med &hearts; av <a href="http://kak.neuf.no/">KAK</a> + <a href="http://elisejakob.no">elise</a><br>
			<a href="<?php echo admin_url(); ?>">Logg inn</a>
		</div><!-- .site-info -->

<?php wp_footer(); ?>

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-52914-20', 'auto');
  ga('send', 'pageview');
</script>

</body>
</html>
