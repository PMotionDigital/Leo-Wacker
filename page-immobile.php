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
<input type="hidden" id="current_locale_" value="<?php echo pll_current_language(); ?>">
<div class="app-wrapper">
    <immobilien-app></immobilien-app>
</div>

<?php  wp_footer(); ?>
<script src="<?php bloginfo('template_url'); ?>/immobilien-app/dist/js/app.js"></script> 