<form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>">
    <label>
        <input type="search" class="search-field" placeholder="<?php esc_attr_e('Search', 'wordit') ?>" value="<?php echo get_search_query() ?>" name="s" title="<?php echo esc_attr_x('Search for:', 'label') ?>" />
    </label>
    <input type="submit" value="<?php echo esc_attr_x('GO!', 'submit button') ?>" />
</form>