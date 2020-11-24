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
<div class="app-wrapper">
    <immobilien-app></immobilien-app>
</div>

<?php get_footer(); ?>
<script src="<?php bloginfo('template_url'); ?>/immobilien-app/dist/js/app.js"></script> 