<section class="wp-block contacts-block dis-flex flex-direction-col align-items-center pad-t pad-b">
    <div class="wrapper">
        <div class="dis-flex justify-content-center">
            <div class="col-lg-10 col-xs-12">
                <div class="contacts-block_title title type-1 text-center">
                    <h2><?php
                    if(get_field('заголовок')): 
                        the_field('заголовок'); 
                    else: 
                        the_field('заголовок', 'option');
                    endif;
                    ?></h2>
                </div>
            </div>
        </div>
        <div class="contacts-block_wrap mgn-t">
            <div class="contacts-block_image media-wrapper">
                <?php 
                if(get_field('изображение')):
                    echo wp_get_attachment_image( get_field('изображение'), 'full'); 
                else:
                    echo wp_get_attachment_image( get_field('изображение', 'option'), 'full'); 
                endif; ?>
            </div>
            <div class="contacts-block_contacts col-lg-6 col-xs-12">
                <?php if(have_rows('контакты')): 
                $prev_name = ''; ?>
                <ul class="contacts-block_list">
                    <?php while(have_rows('контакты')):the_row(); 
                    $cur_name = get_sub_field('текст'); 
                    $empty = '';
                    if($prev_name == $cur_name) {
                        $empty = 'empty';
                    } ?>
                    
                    <li class="contacts-block_list-item <?php echo $empty; ?>">
                   
                        <p class="name">
                            <?php if($prev_name !== $cur_name): ?>
                            <?php the_sub_field('текст'); ?>:
                            <?php endif; $prev_name = $cur_name; ?>
                        </p>
                        <p class="value"><?php the_sub_field('значение'); ?></p>
                    </li>
                    <?php endwhile; ?>
                </ul> 
                <?php elseif(have_rows('контакты', 'option')): 
                $prev_name = ''; ?>
                <ul class="contacts-block_list">
                    <?php while(have_rows('контакты', 'option')):the_row(); 
                    $cur_name = get_sub_field('текст'); 
                    $empty = '';
                    if($prev_name == $cur_name) {
                        $empty = 'empty';
                    } ?>
                    
                    <li class="contacts-block_list-item <?php echo $empty; ?>">
                   
                        <p class="name">
                            <?php if($prev_name !== $cur_name): ?>
                            <?php the_sub_field('текст'); ?>:
                            <?php endif; $prev_name = $cur_name; ?>
                        </p>
                        <p class="value"><?php the_sub_field('значение'); ?></p>
                    </li>
                    <?php endwhile; ?>
                </ul> 
                <?php endif; ?>
                <?php if(get_field('кнопка_1_текст') || get_field('кнопка_2_текст')): ?>
                <div class="contacts-block_buttons">
                    <a class="button blue" href="<?php the_field('кнопка_1_url') ?>"><?php the_field('кнопка_1_текст') ?></a>
                    <a class="button blue" href="<?php the_field('кнопка_2_url') ?>"><?php the_field('кнопка_2_текст') ?></a>
                </div>
                <?php elseif(get_field('кнопка_1_текст', 'option') || get_field('кнопка_2_текст', 'option')): ?>
                <div class="contacts-block_buttons">
                    <a class="button blue" href="<?php the_field('кнопка_1_url', 'option') ?>"><?php the_field('кнопка_1_текст', 'option') ?></a>
                    <a class="button blue" href="<?php the_field('кнопка_2_url', 'option') ?>"><?php the_field('кнопка_2_текст', 'option') ?></a>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>