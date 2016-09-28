<?php
/**
 * @package ku2015
 */
?>
<div class="front-page-entry">
<h4><?php echo get_the_category_list($separator=', '); ?></h4>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( sprintf( '<h3 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' ); ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php
			the_excerpt();
		?>
	</div><!-- .entry-content -->
	<!--<div class="entry-meta">
			<div class="home-entry-date">
				<?php the_date(); ?>
			</div>
				<?php echo sprintf('<a href="%s"><div class="entry-read-more">Les mer</div></a>', esc_url( get_permalink() ) ); ?>
	</div>--><!-- .entry-meta -->
</article><!-- #post-## -->

</div>
