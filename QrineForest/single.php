<?php get_header(); ?>

<div class="container">
    <?php
    
    if (have_posts()) {
        // 投稿記事本体をテンプレート適用して表示
        while (have_posts()) : the_post();
            get_template_part('post-formats/single', get_post_format());
        endwhile;

        // 次の記事、前の記事を表示
        get_template_part('post-formats/adjacent-post');
        
        // コメント欄を表示する
        comments_template();
    }
    ?>
</div>

<?php get_footer(); ?>