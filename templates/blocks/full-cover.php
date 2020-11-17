
<section class="wp-block fullcover-block dis-flex flex-direction-col align-items-center mgn-t mgn-b">
    <div class="fullcover-block_bg media-wrapper">
        <?php echo wp_get_attachment_image( get_field('фон'), 'large'); ?>
    </div>
    <div class="fullcover-block_title title type-1 text-center col-lg-6 col-xs-12">
        <h2><?php the_field('заголовок'); ?></h2>
    </div>
    <div class="fullcover-block_subtitle text-center col-lg-6 col-xs-12">
        <p><?php the_field('подзаголовок'); ?></p>
    </div>
    <div class="fullcover-block_button">
        <a href="<?php the_field('ссылка_url'); ?>" class="button trans"><?php the_field('ссылка_текст'); ?></a>
    </div>
</section>