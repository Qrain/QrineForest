<?php
//$adjacent_post = get_adjacent_post(true, '', false);
// 隣接する次の記事を取得する
//$adjacent_post = get_adjacent_post(false, '', false);
$adjacent_post = get_next_post();

if ($adjacent_post) {
    //　アイキャッチあるか確認する
    if (!has_post_thumbnail( $adjacent_post->ID)) {
        $postClass = " no-image-post";
    }
?>
    <div class="adjacent-pre-post">
        <a class="post-permalink" href="<?php echo get_the_permalink( $adjacent_post->ID); ?>">
            <i class="fa fa-reply"></i>
            <h1 class="post-title"><?php echo $adjacent_post->post_title; ?></h1>
            <div class="post-excerpt">
                <!-- フィルター使って文字数を制限する-->
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