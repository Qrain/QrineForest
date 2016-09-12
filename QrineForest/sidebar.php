<?php
if (is_active_sidebar("wordit-bottom-13-sidebar") || is_active_sidebar("wordit-bottom-23-sidebar") || is_active_sidebar("wordit-bottom-33-sidebar")) :
    ?>
    <div class="sidebar">
        <div class="sidebar-13">
            <?php dynamic_sidebar("wordit-bottom-13-sidebar"); ?>
        </div>
        <div class="sidebar-23">
            <?php dynamic_sidebar("wordit-bottom-23-sidebar"); ?>
        </div>
        <div class="sidebar-33">
            <?php dynamic_sidebar("wordit-bottom-33-sidebar"); ?>
        </div>
    </div>
    <?php
endif;
?>