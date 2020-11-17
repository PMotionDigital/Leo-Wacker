<section class="wp-block sidelist-block dis-flex justify-content-center pad-t pad-b">
    <div class="wrapper dis-flex flex-wrap-wrap">
        <div class="col-lg-6 col-xs-12">
            <div class="sidelist-block_image">
                <?php echo wp_get_attachment_image( get_field('изображение'), 'full'); ?>
            </div>
        </div>
        <div class="col-lg-6 col-xs-12 sidelist-block_right">
            <div class="sidelist-block_title title type-1">
                <h2><?php the_field('заголовок'); ?></h2>
            </div>
            <?php if(have_rows('список')): ?>
            <div class="about-block_list-wrap">
                <div class="about-block_list-title"><?php the_field('список_заголовок'); ?></div>
                <ul class="about-block_list">
                <?php while(have_rows('список')):the_row(); ?>
                    <li class="about-block_list-item"><?php the_sub_field('текст'); ?></li>
              
                <?php endwhile; ?>
                </ul>  
            </div>
            <?php endif; ?>
        </div>
    </div>
</section>