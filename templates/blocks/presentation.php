<section class="wp-block presentation-block">
    <div class="presentation-block_bg media-wrapper">
    <?php echo wp_get_attachment_image( get_field('фон'), 'full'); ?>
    </div>
    <div class="presentation-block_title">
        <h1><?php 
        if(get_field('заголовок')): 
            the_field('заголовок');
        else: 
            the_title(); 
        endif; ?></h1>
    </div>
    <div class="presentation-block_wrap dis-flex justify-content-end">
        <div class="col-lg-6 col-xs-12">
            <div class="presentation-block_subtitle">
                <p><?php the_field('подзаголовок'); ?></p>
            </div>
            <?php if(have_rows('список')): ?>
            <div class="presentation-block_list-wrap">
                <div class="presentation-block_list-title"><?php the_field('список_заголовок'); ?></div>
                <ul class="presentation-block_list">
                    <?php while(have_rows('список')):the_row(); ?>
                    <li class="presentation-block_list-item"><?php the_sub_field('текст'); ?></li>
                    <?php endwhile; ?>
                </ul>  
            </div>
        </div>
    </div>
    <?php endif; ?>
</section>