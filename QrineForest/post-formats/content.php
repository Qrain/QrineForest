<?php
global $postCount;
$postClass = "post";
if ($postCount == 0) {
    $postClass .= " first-post";
}
if (!has_post_thumbnail()) {
    $postClass .= " no-image-post";
}
?>
<div id="post-<?php the_ID(); ?>" <?php post_class($postClass); ?>>

    <?php if (has_post_thumbnail()) : ?>
        <div class="post-featured-image">
            <?php the_post_thumbnail('full'); ?>
        </div>
    <?php endif; ?>

    <div class="post-content-wrapper">

        <div class="post-date">
            <?php get_template_part('post-formats/post-date'); ?>
        </div>

        <h1 class="post-title"><?php the_title(); ?></h1>

        <div class="post-content">
            <?php the_excerpt(); ?>
        </div>

        <a class="post-permalink" href="<?php the_permalink(); ?>">[<?php _e("Continue Reading", "wordit"); ?>]</a>

        <a href="<?php comments_link(); ?>" class="post-comments-link">
            <i class="fa fa-comment"></i>
            <span class="post-comments-count"><?php echo get_comments_number(); ?></span>
        </a>
    </div>
</div>