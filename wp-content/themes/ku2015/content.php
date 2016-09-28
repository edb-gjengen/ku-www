<?php
/**
 * @package ku2015
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<div class="entry-category">
			<?php ku2015_category(); ?>
		</div>

		<?php the_title( sprintf( '<h1 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' ); ?>

		<?php if ( 'post' == get_post_type() ) : ?>
		<div class="entry-meta">
			<?php ku2015_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-thumbnail">
		<?php the_post_thumbnail( 'medium' ); ?>
	</div>

	<div class="entry-content">
		<?php
			/* translators: %s: Name of current post */
			/*the_content( sprintf(
				__( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'ku2015' ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			) );*/
			the_excerpt();
		?>

		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'ku2015' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php ku2015_entry_footer(); ?>
		<span class="fleuron">&#9753;</span>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
