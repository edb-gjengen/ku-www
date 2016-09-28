<?php
/*
Template Name: Forside

@package ku2015
*/


get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<div id="program" class="grid whole">
				<div id="next-three-events"></div>
			</div>

			<div id="blog" class="grid whole">
				<div class="whole"><h2 class="section-header">Siste innlegg</h2></div>
				<div class="grid whole">
						<!--<h4>Generelt</h4>-->
						<div class="front-page-blog-wrap">
						<?php 
						query_posts(array('posts_per_page' => 6));
						while ( have_posts() ) : the_post(); ?>
							<?php get_template_part( 'content', 'singlefrontpage' ); ?>
						<?php endwhile; ?>
						</div>

						<div id="social" class="grid whole">
							<div id="social-icons">
								<a href="https://www.facebook.com/kulturutvalget"><img src="/wp-content/themes/ku2015/img/facebook.png" /></a>
								<a href="https://instagram.com/kulturutvalget"><img src="/wp-content/themes/ku2015/img/instagram.png" /></a>
								<a href="https://twitter.com/kulturutvalget"><img src="/wp-content/themes/ku2015/img/twitter.png" /></a>
							</div>
							<div id="instagram"></div>
						</div>
				</div>
			</div>

			<div id="concepts" class="grid whole">

				<div class="whole"><h2 class="concepts-header section-header">Kulturutvalgets konsepter</h2></div>

				<div id="onsdagsdebatten" class="concept grid third">
					<div class="concept-inner">
						<h2><a href="/om-oss/">Onsdagsdebatten</a></h2>
						<p>
							Onsdagsdebatten inviterer til å la seg engasjere av skarpt, fritt ordskifte i debattsammenheng, til å konfrontere
							og samtidig gå i dybden. Publikum er vekommen til å røske opp i ordskiftet på Landets frieste talerstol, det være
							seg diskusjoner av politisk, kulturell eller akademisk art.
						</p>
						<span class="next-header">Neste arrangement:</span><br>
						<div class="next-event fadein"></div>
					</div>
				</div>

				<div id="boktorsdag" class="concept grid third">
					<div class="concept-inner">
						<h2><a href="/om-oss/">BokTorsdag</a></h2>
						<p>
							BokTorsdag ønsker å belyse sentrale problemstillinger tilknyttet litteratur, å vie oppmerksomhet til interessante
							stemmer i bokbransjen, samt å være til inspirasjon og nytte for de med litterære interesser og ambisjoner.
							BokTorsdag balanserer mellom litteraturvitenskapelig refleksjon og pur underholdning, mellom smalt og populært. 
						</p>
						<span class="next-header">Neste arrangement:</span><br>
						<div class="next-event fadein"></div>
					</div>
				</div>

				<div id="akademisk-vorspiel" class="concept grid third">
					<div class="concept-inner">
						<h2><a href="/om-oss/">Akademisk vorspiel</a></h2>
						<p>
							På Akademisk vorspiel presenteres tema og personligheter som preger og har preget akademia og samfunnet.
							Foredrag, intervjuer og samtaler om alt fra semesterets mest aktuelle temaer til det mer sære og smale.
						</p>
						<span class="next-header">Neste arrangement:</span><br>
						<div class="next-event fadein"></div>
					</div>
				</div>
			</div>

		</main><!-- #main -->
	</div><!-- #primary -->
<?php get_footer(); ?>
