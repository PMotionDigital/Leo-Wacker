
<section class="wp-block fullcover-block dis-flex flex-direction-col align-items-center mgn-t mgn-b">
    <div class="fullcover-block_bg media-wrapper">
        <img data-parallax-cover="25" src="<?php echo wp_get_attachment_image_url( get_field('фон'), 'full'); ?>" alt="">
    </div>
    <?php 
    $cols = 6;
    if(get_field('заголовок_колонки')): 
        $cols = get_field('заголовок_колонки'); 
    endif; ?>
    <div class="fullcover-block_title title type-1 text-center col-lg-<?php echo $cols; ?> col-xs-12">
        <h2><?php the_field('заголовок'); ?></h2>
    </div>
    <div class="fullcover-block_subtitle text-center col-lg-6 col-xs-12">
        <p><?php the_field('подзаголовок'); ?></p>
    </div>
    <div class="fullcover-block_button">
        <a href="<?php the_field('ссылка_url'); ?>" class="button trans"><?php the_field('ссылка_текст'); ?></a>
    </div>
</section>