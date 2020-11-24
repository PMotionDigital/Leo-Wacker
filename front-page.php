<?php 
/*
Template name: Main page
*/
get_header(); ?>

<section class="block-front" data-change-header>
    <div class="block-front_video media-wrapper">
        <video data-parallax-cover="30" src="<?php the_field('видео'); ?>" autoplay="true" loop="true" muted="true" controlls="false">
    </div>
    <?php if(have_rows('ссылки')): ?>
    <div class="block-front_links">
        <?php while(have_rows('ссылки')):the_row(); ?>
        <div class="table">
            <a href="<?php the_sub_field('ссылка'); ?>" class="block-front_links-item" data-parallax="-10">
                <span class="preffix"><?php the_sub_field('префикс'); ?></span>
                <span class="text"><?php the_sub_field('текст'); ?></span>
            </a>
        </div>
        <?php endwhile; ?>
    </div>
    <?php endif; ?>
</section>
<?php the_content(); ?>

<?php get_footer(); ?>