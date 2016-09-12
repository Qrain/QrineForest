<?php get_header(); ?>

<div class="container">
    <?php
    
    if (have_posts()) :
        
        $postCount = 0;
        
        while (have_posts()) : the_post();
        
            get_template_part('post-formats/content', get_post_format());
            
            $postCount++;
            
        endwhile;

        get_template_part('post-formats/pagination');
        
    else:
        
        ?>
    
        <p class="search-result-null-text"><?php _e('Sorry, no results found', 'wordit'); ?></p>
    
        <?php
    endif;
    
    ?>
</div>

<?php get_footer(); ?>