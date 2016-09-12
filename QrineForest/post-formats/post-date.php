<!--
<table>
    <tr>
        <td colspan="2" class="post-date-Y"><?php echo get_the_date("Y"); ?>年</td>
    </tr>
    <tr>
        <td class="post-date-M"><?php echo get_the_date("n"); ?>月</td>
        <td class="post-date-d"><?php echo get_the_date("j"); ?>日</td>
    </tr>
</table>
-->
<?php printf("%s年%s月%s日",get_the_date("Y"),get_the_date("n"),get_the_date("j")); ?>