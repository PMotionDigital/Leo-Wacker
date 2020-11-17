<section class="wp-block about-block dis-flex flex-direction-col align-items-center pad-t pad-b">
    <div class="about-block_pretitle">
        <span class="about-block_pretitle-icon">
            <img src="<?php the_field('иконка'); ?>" alt="">
        </span>
        <p class="about-block_pretitle-text"><?php the_field('надзаголовок'); ?></p>
    </div>
    <div class="about-block_title title type-1 wrapper text-center">
        <h2><?php the_field('заголовок'); ?></h2>
    </div>
    <div class="about-block_image">
        <div class="about-block_image-bg"><?php the_field('фоновый_текст'); ?></div>
        <?php echo wp_get_attachment_image( get_field('изображение'), 'full'); ?>
    </div>
    <div class="about-block_wrap wrapper">
        <div class="col-lg-6 col-xs-12">
        <?php if(have_rows('услуги')): ?>
            <div class="about-block_list-wrap">
                <div class="about-block_list-title"><?php the_field('услуги_заголовок'); ?></div>
                <ul class="about-block_list">
                <?php while(have_rows('услуги')):the_row(); ?>
                    <li class="about-block_list-item"><?php the_sub_field('услуга'); ?></li>
                <?php endwhile; ?>
                </ul>  
            </div>
            <div class="about-block_link">
                <a href="<?php the_field('ссылка_url'); ?>"><?php the_field('ссылка_текст'); ?></a>
            </div>  
        <?php endif; ?>
        </div>
        <div class="col-lg-6 col-xs-12 relative">
            <div class="about-block_text">
                <p><?php the_field('текст'); ?></p>
            </div>
        </div>
    </div>
</section>


