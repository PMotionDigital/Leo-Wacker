<section class="wp-block listcover-block dis-flex justify-content-center mgn-t mgn-b pad-t pad-b">
    <div class="listcover-block_bg media-wrapper">
        <img data-parallax-cover="50" src="<?php echo wp_get_attachment_image_url( get_field('фон'), 'full'); ?>" alt="">
    </div>
    <div class="wrapper">
        <div class="col-lg-5 col-xs-12">
            <div class="title type-1" data-title-animate>
                <h2><?php the_field('заголовок'); ?></h2>
            </div>
            <?php 
            if(have_rows('список')): ?>
            <ul class="listcover-block_list">
            <?php while(have_rows('список')):the_row(); ?>
                <li class="listcover-block_list-item">
                    <h4><?php the_sub_field('заголовок'); ?></h4>
                    <p><?php the_sub_field('текст'); ?></p>
                </li>
            <?php endwhile; ?>
            </ul>
            <?php endif; ?>
        </div>
    </div>
</section>
 