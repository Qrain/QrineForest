<?php get_header(); ?>

<div class="container">
    <?php
    
    if (have_posts()) {
        // ���e�L���{�̂��e���v���[�g�K�p���ĕ\��
        while (have_posts()) : the_post();
            get_template_part('post-formats/single', get_post_format());
        endwhile;

        // ���̋L���A�O�̋L����\��
        get_template_part('post-formats/adjacent-post');
        
        // �R�����g����\������
        comments_template();
    }
    ?>
</div>

<?php get_footer(); ?>