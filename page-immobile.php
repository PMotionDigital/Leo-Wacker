<?php
/* 
Template name: Page Immobile
*/
get_header(); 

#--------------#
#              #
#  VUE JS APP  #
#              #
#--------------#

?> 
<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/immobilien-app/dist/css/app.css">
<input type="hidden" id="current_url_" value="<?php echo get_site_url(); ?>">
<div class="app-wrapper">
    <immobilien-app></immobilien-app>
</div>

<?php  wp_footer(); ?>
<script src="<?php bloginfo('template_url'); ?>/immobilien-app/dist/js/app.js"></script> 