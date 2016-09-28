<?php
/**
 * @package ku2015
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( sprintf( '<h1 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' ); ?>

		<div class="entry-meta">
			<?php ku2015_posted_on(); ?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<div class="entry-thumbnail">
		<?php the_post_thumbnail( 'medium' ); ?>
	</div>

	<div class="entry-content">
		<?php the_excerpt(); ?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php ku2015_entry_footer(); ?>
		<span class="fleuron">&#9753;</span>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
