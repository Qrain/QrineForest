<?php
//$adjacent_post = get_adjacent_post(true, '', false);
// �אڂ��鎟�̋L�����擾����
//$adjacent_post = get_adjacent_post(false, '', false);
$adjacent_post = get_next_post();

if ($adjacent_post) {
    //�@�A�C�L���b�`���邩�m�F����
    if (!has_post_thumbnail( $adjacent_post->ID)) {
        $postClass = " no-image-post";
    }
?>
    <div class="adjacent-pre-post">
        <a class="post-permalink" href="<?php echo get_the_permalink( $adjacent_post->ID); ?>">
            <i class="fa fa-reply"></i>
            <h1 class="post-title"><?php echo $adjacent_post->post_title; ?></h1>
            <div class="post-excerpt">
                <!-- �t�B���^�[�g���ĕ������𐧌�����-->
                <p><?php echo apply_filters('_my_make_excerpt', $adjacent_post->post_content, 50); ?></p>
            </div>
        </a>
    </div>
<?php
}
?>
<?php
$adjacent_post = get_previous_post();

if ($adjacent_post) {
?>
    <div class="adjacent-next-post">
        <a class="post-permalink" href="<?php echo get_the_permalink( $adjacent_post->ID); ?>">
            <i class="fa fa-share"></i>
            <h1 class="post-title"><?php echo $adjacent_post->post_title; ?></h1>
            <div class="post-excerpt">
                <p><?php echo apply_filters('_my_make_excerpt', $adjacent_post->post_content, 50); ?></p>
            </div>
        </a>
    </div>
<?php
}
?>