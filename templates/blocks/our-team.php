<?php 

$cat_id = 16;
$cat_name = get_cat_name(pll_get_term($cat_id));
$args = array(
    'numberposts' => -1,
    'category' => $cat_id
);
$posts = get_posts($args);

global $post;
if(count($posts)): ?>
<section class="wp-block team-block dis-flex justify-content-center pad-t pad-b">
    <div class="team-block_bg-display"></div>
    <div class="wrapper padding">
        <div class="team-block_title title type-1 text-center" data-title-animate>
            <h2><?php echo $cat_name; ?></h2>
        </div>
        <div class="glide-slider" data-slider>
            <div class="team-block_slider-wrap" data-glide-el="track">
                <div class="team-block_slider">
                <?php foreach($posts as $post): setup_postdata($post->ID); ?>
                    <div class="team-block_slider-item" data-title="<?php the_title(); ?>">
                        <div class="team-block_slider-item-wrap">
                            <div class="team-block_slider-item-image media-wrapper col-lg-4 col-xs-12" data-image-animate>
                                <?php the_post_thumbnail(); ?>
                            </div>
                            <div class="team-block_slider-item-content col-lg-8 col-xs-12">
                                <div class="team-date">
                                    <?php the_field('дата_рождения', $post->ID); ?>
                                </div>
                                <div class="team-content">
                                    <?php the_content(); ?>
                                </div>
                                <div class="team-desc">
                                <?php the_field('описание', $post->ID); ?>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                <?php endforeach; wp_reset_postdata(); ?>
                </div>
            </div>
            <div class="glide-slider_arrows" data-glide-el="controls">
                <button class="glide-slider_arrow glide-slider_arrow--left" data-glide-dir="&lt;">prev</button>
                <button class="glide-slider_arrow glide-slider_arrow--right" data-glide-dir="&gt;">next</button>
            </div>
        </div>
        <div class="team-block_slider-arrows"></div>
    </div>
</section>
<?php endif; ?>