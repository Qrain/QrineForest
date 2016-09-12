<?php if (comments_open()) : ?>

<div class="comments">

<?php if (have_comments()) : ?>	

    <h3 id="comments"><?php comments_number(__('Comments', 'wordit'), __('1 Comments', 'wordit'), __('% Comments', 'wordit')); ?></h3>

    <ol class="commentlist">
        <?php wp_list_comments( 'type=comment&callback=wordit_comments' ); ?>
    </ol>

    <?php if (get_comment_pages_count() > 1 && get_option('page_comments')) : ?>
        <div class="comments-navigation">
            <div class="comments-navigation-next">
                <?php previous_comments_link(__('Older Comments', 'wordit') . '<i class="fa fa-chevron-right"></i>', 0); ?>
            </div>

            <div class="comments-navigation-prev">
                <?php next_comments_link('<i class="fa fa-chevron-left"></i>' . __('Newer Comments', 'wordit'), 0); ?>
            </div>
        </div>
    <?php endif; ?>

<?php endif; ?>

<?php
    $aria_req = get_option( 'require_name_email' );
    
    $fields   =  array(
            'author' => '<input placeholder="'.__("Name","wordit").'" id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" ' . $aria_req . ' /></p>',
            'email'  => '<input placeholder="'.__("E-Mail","wordit").'" id="email" name="email" type="email" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" ' . $aria_req . ' /></p>',
            'url'    => '<input placeholder="'.__("Website","wordit").'" id="url" name="url" type="url" value="' . esc_attr( $commenter['comment_author_url'] ) . '" /></p>',
    );
    
    $args = array(
        'fields'               => $fields,
        'comment_field'        => '<textarea placeholder="'.__("Message (Required)","wordit").'" id="comment" name="comment" aria-required="true"></textarea>',
        'comment_notes_before' => '',
        'comment_notes_after'  => '',
        "title_reply"          => __( 'Leave a comment', 'wordit'),
        'title_reply_to'       => __( ' Reply to %s', 'wordit' ),
        'cancel_reply_link'    => __( 'Cancel reply', 'wordit' ),
        'label_submit'         => __( 'Submit', 'wordit' )
    );
    
    comment_form($args);
?>

</div>

<?php endif; ?>