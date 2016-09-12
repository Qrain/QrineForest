<?php
$postClass = "first-post";
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
            <?php 
            the_content();
            wp_link_pages(array(
                'before'           => '<p class="post-content-pages">' . __( 'Pages:', 'wordit' ),
                'after'            => '</p>',
                'link_before'      => '',
                'link_after'       => '',
                'next_or_number'   => 'number',
                'separator'        => ' ',
                'nextpagelink'     => __( 'Next page', 'wordit' ),
                'previouspagelink' => __( 'Previous page', 'wordit' ),
                'pagelink'         => '%',
                'echo'             => 1
            ));
            ?>
        </div>
        
        <div class="post-bottom">
            <p>Written by <span><?php the_author_link(); ?></span> in <span><?php echo get_the_category_list(", "); ?></span></p>
            <p class="tags"><?php the_tags("","",""); ?></p>
        </div>
    </div>
    
    <?php
        $author_about = get_the_author_meta("description");
    ?>

    <?php if ($author_about) : ?>

    <div class="post-about-author">
        <?php echo get_avatar(get_the_author_meta("ID"), "50"); ?>
        <p><?php echo $author_about; ?></p>
    </div>

    <?php endif; ?>
    
    
</div>


