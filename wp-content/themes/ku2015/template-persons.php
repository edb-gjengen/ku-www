<?php
/**
 * Template Name: Personer
 */
get_header();

$person = new WP_Query( array(
    'post_type' => 'person',
    'posts_per_page' => -1,
    'orderby' => 'title',
    'order' => 'asc'
));
?>
<div class="entry-content">
<div id="hovedkontakt" class="grid whole">
<?php
    the_post();
    the_content();
?>
</div>
<?php
while ($person->have_posts()):
    $person->the_post();
    $thumbnail = get_stylesheet_directory_uri() . '/img/ku-placeholder.png';
    if(get_the_post_thumbnail($post->ID)) {
        $thumbnail = get_the_post_thumbnail_url($post->ID, 'medium');
    }
    ?>
    <div class="grid third">
        <p><img src="<?php echo $thumbnail; ?>" /></p>
        <h3><?php the_title(); ?></h3>
        <h2><?php echo $post->position; ?></h2>
        <p>
            <?php if($post->email): ?>
                <a href="mailto:<?php echo $post->email; ?>"><?php echo $post->email; ?></a>
            <?php endif; ?>
        </p>
    </div>

<?php endwhile; ?>
</div>
<?php get_footer();