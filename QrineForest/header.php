<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo('charset'); ?>" />
        <link rel="profile" href="http://gmpg.org/xfn/11" />
        <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
        <?php wp_head(); ?>
    </head>
    
    <body <?php body_class(); ?>>
    
    <div class="header">
        <div class="header-inner">
            <div class="header-logo"><a href="<?php echo esc_url(home_url('/')); ?>"><?php echo bloginfo('name'); ?></a></div>
            <?php 
                if (has_nav_menu("header_menu")) {
                    get_template_part("header_menu"); 
                }
            ?>
            <div id="header-show" class="header-show"><i class="fa fa-arrow-down"></i></div>

            <form role="search" method="get" class="search-form header-search" action="<?php echo esc_url(home_url('/')); ?>">
                <input type="search" class="search-field" placeholder="<?php esc_attr_e('Search', 'wordit') ?>" value="<?php echo get_search_query() ?>" name="s" title="<?php echo esc_attr_x('Search for:', 'label') ?>" />
                <button name="submit" type="submit" class="search-btn"><i id="header-search" class="fa fa-search"></i></button>
            </form>
  
            <div class="sidebar-wrap">
                <?php get_sidebar(); //※上下スライドするヘッダメニュー ?>
            </div>
        </div>
    </div>
    
