<section class="wp-block projects-block pad-t">
    <div class="projects-block_title title type-1 text-center" data-title-animate>
        <h2>
        <?php if(get_field('заголовок')): 
            the_field('заголовок');
        else: 
            echo 'Aktuelle Projekte:';
        endif; ?>

        </h2>
    </div>
    <?php if(have_rows('проекты')): ?>
    <div class="projects-block_projects">
        <?php while(have_rows('проекты')):the_row(); ?>
        <div class="projects-block_projects-item">
            <div class="projects-block_projects-item-image media-wrapper">
                <img  data-parallax-cover="30" src="<?php echo wp_get_attachment_image_url( get_sub_field('изображение'), 'full'); ?>" alt="">
            </div>
            <div class="projects-block_projects-item-title">
                <?php the_sub_field('текст'); ?>
            </div>
        </div>
        <?php endwhile; ?>
    </div>
    <?php endif; ?>
</section>