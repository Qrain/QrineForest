<?php

/* ===================================================
    Theme Language
 * =================================================== */

add_action('after_setup_theme', function (){
    load_theme_textdomain('wordit', get_template_directory() . '/languages');
});


/* ===================================================
    Theme supports
 * =================================================== */

add_action('after_setup_theme', function () {
    add_theme_support('post-thumbnails');
    add_theme_support('automatic-feed-links');
    add_theme_support("title-tag");
    add_theme_support('custom-background', array(
        'default-color' => '#f5f4f2',
    ));
});


/* ===================================================
    Set Content width
 * =================================================== */

if (!isset($content_width)) {
    $content_width = 670;
}

/* ===================================================
    Load Front-end javascript and style
 * =================================================== */

if(is_admin()){
     // 管理画面の場合
    add_action("admin_enqueue_scripts", function () {
        $home = get_template_directory_uri ();
        //数式表示プラグイン 
        //wp_register_script ( 'MathJax.js', '//cdn.mathjax.org/mathjax/latest/MathJax.js?config=TeX-AMS-MML_SVG' );
        //wp_enqueue_script ( 'MathJax.js' );
        // コートハイライトプラグイン
        //wp_register_script ( 'highlight.js', $home . '/js/highlight.pack.js' );
        //wp_enqueue_script ( 'highlight.js' );
        //wp_register_style ( 'highlight.css', $home . '/css/highlight-js-8.6/ir_black.css' );
        //wp_enqueue_style ( 'highlight.css' );
        //wp_register_script ( 'Config.js', $home . '/js/config.js' );
        //wp_enqueue_script ( 'Config.js' );
    });

} else {
     // 管理画面じゃない場合
    // フッターに追加する場合は wp_print_footer_scripts を使用
    add_action("wp_enqueue_scripts", function () {
        
        if (is_singular() && get_option('thread_comments')) {
            wp_enqueue_script('comment-reply'); 
        }
        
        $home = get_template_directory_uri ();
        $css_home = $home . '/css/';
        //$plugin_home = $home . '/js/';
        $js_home = $home . '/js/';

        //wp_enqueue_style("wordit-font-awesome", $css_home . "font-awesome-4.2.0/css/font-awesome.min.css");
        wp_enqueue_style("wordit-font-awesome", "https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css");

        //wp_enqueue_style("wordit-css", get_stylesheet_uri());
        wp_enqueue_style("wordit-css", $css_home . "style.css");

        // Googleフォントは href='http://fonts.googleapis.com/css?family=XXX' の XXX部分を ↓ に追加する
        wp_enqueue_style("wordit-google-fonts", "//fonts.googleapis.com/css?family=Dancing+Script|Bree+Serif|Roboto|Orbitron:400,500,700|Fredericka+the+Great");
        //Noto Sans Japanese とかいう日本語フォント 但しサイズがおもすぎる
        //wp_enqueue_style("wordit-google-fonts2", "//fonts.googleapis.com/earlyaccess/notosansjapanese.css");
        
        // コートハイライトプラグイン
        wp_register_script ( 'highlight.js', $js_home . 'highlight.pack.js' );
        wp_enqueue_script ( 'highlight.js' );
        wp_register_style ( 'highlight.css', $css_home . 'highlight-js-9.4.0/ir_black.css' );
        wp_enqueue_style ( 'highlight.css' );
        
        //数式表示プラグイン 
        wp_register_script ( 'MathJax.js', '//cdn.mathjax.org/mathjax/latest/MathJax.js?config=TeX-AMS-MML_SVG' );
        //wp_register_script ( 'MathJax.js', '//cdn.mathjax.org/mathjax/latest/MathJax.js?config=TeX-AMS_HTML' );
        wp_enqueue_script ( 'MathJax.js' );

        //wp_register_script ( 'Config.js', $js_home . 'config.js' );
        //wp_enqueue_script ( 'Config.js' );

        // jQuery で要素を回転させるためのプラグイン
        wp_register_script ( 'jQueryRotate.js', $js_home . 'jQueryRotate.js' );
        wp_enqueue_script ( 'jQueryRotate.js' );

        wp_enqueue_script("my-js", $js_home . "my.js", array("jquery"));
    });
}


/* ===================================================
  Register Header Menu
 * =================================================== */
add_action('after_setup_theme', function () {
    register_nav_menu('header_menu', __('Header Menu', 'wordit'));
});


/* ===================================================
    記事抜粋関連（About Post excerpt）
 * =================================================== */
// 抜粋内容の文字数を設定する
add_filter('excerpt_length', function ($length) {
    return 80;
});

// WP本家Docsより： "get_the_excerpt" フィルターは投稿の抜粋がデータベースから読み出され、 get_the_filter() 関数から返される前にフィルターするために用いられます。 
add_filter('get_the_excerpt', function ($excerpt) {
    // 抜粋が未設定ならば本文一部を表示する
    if (empty($excerpt)){
        return "Oh, yeah!!";
    }
    return $excerpt;
});

/* ===================================================
    Comments loop
 * =================================================== */

function wordit_comments($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment;
    // Note </li> is omitted on purpose
    ?>
        <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
            <div id="comment-<?php comment_ID(); ?>">
                <div class="comment-body">
                    <div class="comment-top">
                        <?php echo get_avatar($comment, 50); ?>
                        <span class="comment-author"><?php comment_author(); ?></span>
                        <br />
                        <span class="comment-date"><?php comment_date(); ?></span>
                    </div>

                    <div class="comment-content">
                        
                        <?php if ($comment->comment_approved == '0') : ?>
                            <p class="comment-awaiting-approval"><?php _e('Pending approval', 'wordit') ?></p><br />
                        <?php endif; ?>
                        <?php comment_text(); ?>
                    </div>

                    <div class="comment-reply">
                        <?php
                            comment_reply_link(array_merge(array('reply_text' => __('Reply', 'wordit')), array('depth' => $depth, 'max_depth' => $args['max_depth'])))
                        ?>
                        <span>&nbsp;</span>
                        <?php edit_comment_link(__('Edit', 'wordit')); ?>
                    </div>
                </div>
            </div>
    <?php
}



/* ===================================================
    Sidebars
 * =================================================== */

function wordit_register_sidebars() {

    register_sidebar( array(
        'name'          => __( 'Bottom 1 of 3 Sidebar', 'wordit' ),
        'id'            => 'wordit-bottom-13-sidebar',
        'description'   => __('Wordit bottom left sidebar widget area', 'wordit'),
        'class'         => '',
        'before_widget' => '<div id="%1$s" class="%2$s sidebar_widget">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2 class="sidebar_widgettitle">',
        'after_title'   => '</h2>' )
    );

    register_sidebar( array(
        'name'          => __( 'Bottom 2 of 3 Sidebar', 'wordit' ),
        'id'            => 'wordit-bottom-23-sidebar',
        'description'   => __('Wordit bottom center sidebar widget area', 'wordit'),
        'class'         => '',
        'before_widget' => '<div id="%1$s" class="%2$s sidebar_widget">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2 class="sidebar_widgettitle">',
        'after_title'   => '</h2>' )
    );

    register_sidebar( array(
        'name'          => __( 'Bottom 3 of 3 Sidebar', 'wordit' ),
        'id'            => 'wordit-bottom-33-sidebar',
        'description'   => __('Wordit bottom right sidebar widget area', 'wordit'),
        'class'         => '',
        'before_widget' => '<div id="%1$s" class="%2$s sidebar_widget">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2 class="sidebar_widgettitle">',
        'after_title'   => '</h2>' )
    ); 

} 
add_action( 'widgets_init', 'wordit_register_sidebars' );


// Disables hardcodes style.css in wp-inclues/media.php
add_filter( 'use_default_gallery_style', '__return_false' );


/* ===================================================
    以降、追記部分
 * =================================================== */

//アンパサンドが自動的に &amp; に変換されてしまうのを防止する
//add_filter('the_content', function ($content) {
//    return str_replace('&amp;', '&', $content);
//});
// function.phpに書きます。


// WordPressエディタ（TinyMCE）のカスタム設定
add_filter('tiny_mce_before_init', function ($arr) {
    //参考 http://yokotakenji.me/log/cms/wordpress/3139/

    // if 'HTML' <br/> → <br>
    //$arr['element_format'] = 'HTML';
    // コピペしたときにテキストからタグを削除 ※テキストとしてコピーのデフォルト値
    // $arr['paste_as_text'] = true;
    // bodyタグにクラスを追加
    //$arr['body_class'] = 'module__post-cnt';
  
    // pタグ、brタグの自動削除
    //$arr['wpautop'] = false;
    // リサイズ禁止
    $arr['object_resizing'] = false;
    // CSSの変更
    $arr['content_css'] = get_template_directory_uri() . "/css/editor-style.css";

    // ブロックフォーマットを追加
    // "p,pre,address,h1,h2,h3,h4,h5,h6"
    $arr['block_formats'] = "段落=p;見出し１=h2;見出し２=h3;見出し３=h4;コード=pre";  

    // https://highlightjs.org/static/demo/
    //$style_formats = array (
    //    array( 'title' => 'Bold text', 'inline' => 'b' ),
    //    array( 'title' => 'Red text', 'inline' => 'span', 'styles' => array( 'color' => '#ff0000' ) ),
    //    array( 'title' => 'Highlight BASH', 'block' => 'code', 'classes' => 'bash' ),
    //    array( 'title' => 'Highlight SQL', 'block' => 'code', 'classes' => 'sql' ),
    //    array( 'title' => 'Highlight C#', 'block' => 'code', 'classes' => 'cs' )
    //);
    // 既存のスタイルフォーマットにカスタムフォーマットを統合する設定
    //$ary['style_formats_merge'] = false;
    // フォーマットの設定
    //$arr['style_formats'] = json_encode($style_formats);

    return $arr;
});


add_filter('_my_make_excerpt', function ($str, $len) {
    $str = strip_tags($str);            // HTMLタグを除去
    $str = strip_shortcodes($str);      // ショートコードを除去
    $str = mb_substr($str, 0, $len);    // 先頭ｎ文字を抜き出し
    return $str;
}, 10, 2);

/* ===================================================
    ショートコード
 * =================================================== */

// 目次メニューを作成するためのショートコード
add_shortcode('index', function (){
    // [index] を JavaScript用の要素に置き換える
    return '<div class="myindex-sG2iQkP8"></div>';
});

// highlight.js のBashモード
add_shortcode('bash', function ( $atts, $content = null ) {
    return '<pre><code class="bash">' . $content . '</code></pre>';
});