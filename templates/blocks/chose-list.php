<section class="wp-block choselist-block dis-flex justify-content-center pad-t pad-b">
    <div class="wrapper">
        <div class="choselist-block_title title type-1 text-center" data-title-animate>
            <h2><?php the_field('заголовок'); ?></h2>
        </div>
        <?php if(have_rows('список')): ?>
        <div class="choselist-block_list dis-flex flex-wrap-wrap">
            <?php while(have_rows('список')):the_row(); ?>
            <a href="<?php the_sub_field('ссылка'); ?>" class="choselist-block_list-item col-lg-3 col-lm-6 col-xs-12">
                <div class="choselist-block_list-item-image media-wrapper" data-image-animate>
                    <?php echo wp_get_attachment_image( get_sub_field('изображение'), 'large'); ?>
                </div>
                <div class="choselist-block_list-item-title"><?php the_sub_field('текст'); ?></div>
            </a>
            <?php endwhile; ?>
        </div>
        <?php endif; ?>
        <div class="dis-flex justify-content-center">
            <div class="col-lg-7 col-xs-12 text-center">
                <p class="choselist-block_desc"><?php the_field('описание'); ?></p>
            </div>
        </div>
    </div>
</section>