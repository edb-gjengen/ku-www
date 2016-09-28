<?php
/**
 * The template for the program page.
 *
 * @package ku2015
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php the_content(); ?>

			<div class="program-upcoming">
				<div class="program-list-wrap">
					<div class="program-list-loading"></div>
				</div>
			</div>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>
