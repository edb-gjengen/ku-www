<?php
/**
 * The template for displaying Litteraturbloggen.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package ku2015
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php
		if ( have_posts() ) : ?>

			<header class="page-header">
				<h1 class="page-title">Litteraturblogg</h1>
				<?php
				
					if ( is_year() ) {
						$title = sprintf( __( 'Year: %s', 'ku2015' ), get_the_date( _x( 'Y', 'yearly archives date format', 'ku2015' ) ) );
						echo '<h1 class="page-title">' . $title . '</h1>';
					} elseif ( is_month() ) {
						$title = sprintf( __( 'Month: %s', 'ku2015' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'ku2015' ) ) );
						echo '<h1 class="page-title">' . $title . '</h1>';
					} elseif ( is_day() ) {
						$title = sprintf( __( 'Day: %s', 'ku2015' ), get_the_date( _x( 'F j, Y', 'daily archives date format', 'ku2015' ) ) );
						echo '<h1 class="page-title">' . $title . '</h1>';
					}

					the_archive_description( '<div class="taxonomy-description">', '</div>' );
				?>
			</header><!-- .page-header -->

			<?php /* Start the Loop */ ?>
			<?php
			while ( have_posts() ) : the_post(); ?>

				<?php
					/* Include the Post-Format-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
					get_template_part( 'content', 'singlecategory' );
				?>

			<?php endwhile; ?>

			<?php the_posts_navigation(); ?>

		<?php else : ?>

			<?php get_template_part( 'content', 'none' ); ?>

		<?php endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
