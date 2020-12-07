<?php

add_action('wp_ajax_formular', 'get_formular');
add_action('wp_ajax_nopriv_formular', 'get_formular');

function get_formular() {
    $type = $_GET['type'];
    $lang = $_GET['lang']; 
    // if(!$lang) {
    //     $lang = pll_current_language();
    // }
    ob_start(); ?>

    <div class="formular-block col-lg-7 loading">

    
    <?php
    $header = ob_get_clean();

    ob_start(); ?>
    <div class="formular-block_controlls">
        <button data-btn="prev"><span class="arrow"></span></button>
        <button data-btn="next"><?php echo get_field('кнопка_дальше', 'option')['текст_'.$lang]; ?><span class="arrow"></span></button>
    </div>
    <div class="formular-block_progress">
        <span class="formular-block_progress-target"></span>
    </div>

    </div>
    <?php
    $footer = ob_get_clean();

    if($type == 'wohnung'):
        $content = get_wohnung($lang);    
    elseif($type == 'haus'):
        $content = get_haus($lang); 
    elseif($type == 'grundstück'): 
        $content = get_grundstuck($lang);
    elseif($type == 'mehrfamilienhaus'):
        $content = get_mehrfamilienhaus($lang);
    endif;

    echo json_encode(array(
        'header' => $header,
        'footer' => $footer,
        'content' => $content,
        'lang' => $lang
    ));
    die;
}
function get_haus($lang) {
    ob_start();
    $step = 0;
    ?>
    <!---- START HTML ------>
    <?php if(have_rows('параметры_haus', 'option')): ?>
    <div class="formular-step active" data-step="<?php echo $step; $step += 1; ?>">
        <div class="title type-1 text-center">
            <h2><?php the_field('параметры_заголовок_'.$lang, 'option'); ?></h2>
        </div>
        <div class="formular-form">
        <?php while(have_rows('параметры_haus', 'option')): the_row(); ?>
        <div class="formular-form_input">
            <div class="formular-form_input-image">
                <img src="<?php the_sub_field('изображение'); ?>" alt="<?php the_sub_field('текст_'.$lang); ?>">
            </div>
            <div class="formular-form_input-input">
                <label for="">
                    <p class="label"><?php the_sub_field('текст_'.$lang); ?></p>
                    <input type="number" min="1" placeholder="<?php the_sub_field('default'); ?>">
                </label>
            </div>
        </div>
        <?php endwhile; ?>
        </div>
    </div>
    <?php endif; ?>

    <?php if(have_rows('элементы', 'option')): ?>
    <div class="formular-step" data-step="<?php echo $step; $step += 1; ?>">
        <div class="title type-1 text-center">
            <h2><?php the_field('состояние_заголовок_'.$lang, 'option'); ?></h2>
        </div>
        <div class="formular-form radio">
            
        <div class="formular-form_radio">
            <?php if(have_rows('критерии', 'option')): ?>
                <p></p>
            <?php while(have_rows('критерии', 'option')): the_row(); ?>
                <p class="formular-form_radio-title  head"><?php the_sub_field('текст_'.$lang); ?></p>
            <?php endwhile; ?>
        
        <?php endif; ?>
        </div>

        <?php while(have_rows('элементы', 'option')): the_row(); 
        $index = get_row_index(); ?>
        <div class="formular-form_radio">
            <div class="formular-form_radio-title"><?php the_sub_field('элемент_'.$lang); ?></div>
            <?php if(have_rows('критерии', 'option')): ?>
            <!-- <div class="formular-form_radio-wrap"> -->
            <?php while(have_rows('критерии', 'option')): the_row(); ?>
            <div class="input-radio">
                <input type="radio" name="<?php echo $index.'_'.$lang; ?>" value="<?php the_sub_field('текст_'.$lang); ?>" title="<?php the_sub_field('текст_'.$lang); ?>">
                <div class="input-radio_circle"></div>
            </div>
            <?php endwhile; ?>
            <!-- </div> -->
        <?php endif; ?>
        </div>
        <?php endwhile; ?>
        </div>
    </div>
    <?php endif; ?>

    <div class="formular-step" data-step="<?php echo $step; $step += 1; ?>">
        <div class="title type-1 text-center">
            <h2><?php the_field('место_расположения_заголовок_'.$lang, 'option'); ?></h2>
        </div>
        <div class="formular-form lage">
            <div class="lage-bg">
                <img src="<?php the_field('изображение_lage', 'option') ?>" alt="">
            </div>
            <div class="lage-form">
                <div class="lage-form_input">
                    <input type="text" placeholder="<?php echo get_field('индекс', 'option')['текст_'.$lang]; ?>">
                </div>
                <div class="lage-form_input">
                    <input type="text" placeholder="<?php echo get_field('город', 'option')['текст_'.$lang]; ?>">
                </div>
                <div class="lage-form_input">
                    <input type="text" placeholder="<?php echo get_field('улица', 'option')['текст_'.$lang]; ?>">
                </div>
                <div class="lage-form_input">
                    <input type="text" placeholder="<?php echo get_field('дом', 'option')['текст_'.$lang]; ?>">
                </div>
            </div>
            <div class="lage-text">
                <?php echo get_field('место_расположения_текст', 'option')['текст_'.$lang]; ?>
            </div>
        </div>
    </div>
    <div class="formular-step" data-step="<?php echo $step; $step += 1; ?>">
        <div class="title type-1 text-center">
            <h2><?php echo get_field('контактные_данные_заголовок', 'option')['текст_'.$lang]; ?></h2>
        </div>
        <div class="formular-form">
            <?php echo do_shortcode('[contact-form-7 id="469" title="Формуляр DE"]'); ?>    
        </div>
        <script>
            wpcf7.initForm( jQuery('.wpcf7-form') );
        </script>
    </div>

    <!---- END HTML -------->
    <?php
    $html = ob_get_clean();
    return $html;
}

function get_mehrfamilienhaus($lang) {
    ob_start();
    $step = 0;
    ?>
    <!---- START HTML ------>
    <?php if(have_rows('параметры_mehrfamilienhaus', 'option')): ?>
    <div class="formular-step active" data-step="<?php echo $step; $step += 1; ?>">
        <div class="title type-1 text-center">
            <h2><?php the_field('параметры_заголовок_'.$lang, 'option'); ?></h2>
        </div>
        <div class="formular-form">
        <?php while(have_rows('параметры_mehrfamilienhaus', 'option')): the_row(); ?>
        <div class="formular-form_input">
            <div class="formular-form_input-image">
                <img src="<?php the_sub_field('изображение'); ?>" alt="<?php the_sub_field('текст_'.$lang); ?>">
            </div>
            <div class="formular-form_input-input">
                <label for="">
                    <p class="label"><?php the_sub_field('текст_'.$lang); ?></p>
                    <input type="number" min="1" placeholder="<?php the_sub_field('default'); ?>">
                </label>
            </div>
        </div>
        <?php endwhile; ?>
        </div>
    </div>
    <?php endif; ?>

    <?php if(have_rows('элементы', 'option')): ?>
    <div class="formular-step" data-step="<?php echo $step; $step += 1; ?>">
        <div class="title type-1 text-center">
            <h2><?php the_field('состояние_заголовок_'.$lang, 'option'); ?></h2>
        </div>
        <div class="formular-form radio">
            
        <div class="formular-form_radio">
            <?php if(have_rows('критерии', 'option')): ?>
                <p></p>
            <?php while(have_rows('критерии', 'option')): the_row(); ?>
                <p class="formular-form_radio-title  head"><?php the_sub_field('текст_'.$lang); ?></p>
            <?php endwhile; ?>
        
        <?php endif; ?>
        </div>

        <?php while(have_rows('элементы', 'option')): the_row(); 
        $index = get_row_index(); ?>
        <div class="formular-form_radio">
            <div class="formular-form_radio-title"><?php the_sub_field('элемент_'.$lang); ?></div>
            <?php if(have_rows('критерии', 'option')): ?>
            <!-- <div class="formular-form_radio-wrap"> -->
            <?php while(have_rows('критерии', 'option')): the_row(); ?>
            <div class="input-radio">
                <input type="radio" name="<?php echo $index.'_'.$lang; ?>" value="<?php the_sub_field('текст_'.$lang); ?>" title="<?php the_sub_field('текст_'.$lang); ?>">
                <div class="input-radio_circle"></div>
            </div>
            <?php endwhile; ?>
            <!-- </div> -->
        <?php endif; ?>
        </div>
        <?php endwhile; ?>
        </div>
    </div>
    <?php endif; ?>

    <div class="formular-step" data-step="<?php echo $step; $step += 1; ?>">
        <div class="title type-1 text-center">
            <h2><?php the_field('место_расположения_заголовок_'.$lang, 'option'); ?></h2>
        </div>
        <div class="formular-form lage">
            <div class="lage-bg">
                <img src="<?php the_field('изображение_lage', 'option') ?>" alt="">
            </div>
            <div class="lage-form">
                <div class="lage-form_input">
                    <input type="text" placeholder="<?php echo get_field('индекс', 'option')['текст_'.$lang]; ?>">
                </div>
                <div class="lage-form_input">
                    <input type="text" placeholder="<?php echo get_field('город', 'option')['текст_'.$lang]; ?>">
                </div>
                <div class="lage-form_input">
                    <input type="text" placeholder="<?php echo get_field('улица', 'option')['текст_'.$lang]; ?>">
                </div>
                <div class="lage-form_input">
                    <input type="text" placeholder="<?php echo get_field('дом', 'option')['текст_'.$lang]; ?>">
                </div>
            </div>
            <div class="lage-text">
                <?php echo get_field('место_расположения_текст', 'option')['текст_'.$lang]; ?>
            </div>
        </div>
    </div>
    <div class="formular-step" data-step="<?php echo $step; $step += 1; ?>">
        <div class="title type-1 text-center">
            <h2><?php echo get_field('контактные_данные_заголовок', 'option')['текст_'.$lang]; ?></h2>
        </div>
        <div class="formular-form">
            <?php echo do_shortcode('[contact-form-7 id="469" title="Формуляр DE"]'); ?>    
        </div>
        <script>
            wpcf7.initForm( jQuery('.wpcf7-form') );
        </script>
    </div>

    <!---- END HTML -------->
    <?php
    $html = ob_get_clean();
    return $html;
}

function get_grundstuck($lang) {
    ob_start();
    $step = 0;
    ?>
    <!---- START HTML ------>
    <?php if(have_rows('тип_участка', 'option')): ?>
    <div class="formular-step active" data-step="<?php echo $step; $step += 1; ?>">
        <div class="title type-1 text-center">
            <h2><?php the_field('тип_участка_заголовок_'.$lang, 'option'); ?></h2>
        </div>
        <div class="formular-form">
        <?php while(have_rows('тип_участка', 'option')): the_row(); ?>
            <div class="formular-form_item">
                <div class="formular-form_item-image">
                    <img src="<?php the_sub_field('изображение'); ?>" alt="<?php the_sub_field('текст_'.$lang); ?>">
                </div>
                <div class="formular-form_item-title">
                    <?php the_sub_field('текст_'.$lang); ?>
                </div>
            </div>
        <?php endwhile; ?>
        </div>
    </div>
    <?php endif; ?>

    <?php if(have_rows('параметры_ grundstuck', 'option')): ?>
    <div class="formular-step" data-step="<?php echo $step; $step += 1; ?>">
        <div class="title type-1 text-center">
            <h2><?php the_field('параметры_заголовок_'.$lang, 'option'); ?></h2>
        </div>
        <div class="formular-form">
        <?php while(have_rows('параметры_ grundstuck', 'option')): the_row(); ?>
        <div class="formular-form_input">
            <div class="formular-form_input-image">
                <img src="<?php the_sub_field('изображение'); ?>" alt="<?php the_sub_field('текст_'.$lang); ?>">
            </div>
            <div class="formular-form_input-input">
            <?php if(get_sub_field('радио', 'option') == 'true'): ?>
                <div class="radio-wrap">
                    <p class="label"><?php the_sub_field('текст_'.$lang); ?></p>
                    <div class="radio">
                    <?php 
                    $ind = get_row_index();
                    if(have_rows('варианты', 'option')):
                        while(have_rows('варианты', 'option')): the_row(); ?>
                    <label for="">
                        <input type="radio" name="<?php echo $ind.'_var'; ?>">
                        <p><?php the_sub_field('текст_'.$lang); ?></p>
                    </label>
                    <?php endwhile;
                    endif; ?>
                    </div>
                </div>
                <?php else: ?>
                <label for="">
                    <p class="label"><?php the_sub_field('текст_'.$lang); ?></p>
                    <input type="number" min="1" placeholder="<?php the_sub_field('default'); ?>">
                </label>
                <?php endif; ?>
            </div>
        </div>
        <?php endwhile; ?>
        </div>
    </div>
    <?php endif; ?>

    <div class="formular-step" data-step="<?php echo $step; $step += 1; ?>">
        <div class="title type-1 text-center">
            <h2><?php the_field('место_расположения_заголовок_'.$lang, 'option'); ?></h2>
        </div>
        <div class="formular-form lage">
            <div class="lage-bg">
                <img src="<?php the_field('изображение_lage', 'option') ?>" alt="">
            </div>
            <div class="lage-form">
                <div class="lage-form_input">
                    <input type="text" placeholder="<?php echo get_field('индекс', 'option')['текст_'.$lang]; ?>">
                </div>
                <div class="lage-form_input">
                    <input type="text" placeholder="<?php echo get_field('город', 'option')['текст_'.$lang]; ?>">
                </div>
                <div class="lage-form_input">
                    <input type="text" placeholder="<?php echo get_field('улица', 'option')['текст_'.$lang]; ?>">
                </div>
                <div class="lage-form_input">
                    <input type="text" placeholder="<?php echo get_field('дом', 'option')['текст_'.$lang]; ?>">
                </div>
            </div>
            <div class="lage-text">
                <?php echo get_field('место_расположения_текст', 'option')['текст_'.$lang]; ?>
            </div>
        </div>
    </div>
    <div class="formular-step" data-step="<?php echo $step; $step += 1; ?>">
        <div class="title type-1 text-center">
            <h2><?php echo get_field('контактные_данные_заголовок', 'option')['текст_'.$lang]; ?></h2>
        </div>
        <div class="formular-form">
            <?php echo do_shortcode('[contact-form-7 id="469" title="Формуляр DE"]'); ?>    
        </div>
        <script>
            wpcf7.initForm( jQuery('.wpcf7-form') );
        </script>
    </div>

    <!---- END HTML -------->
    <?php
    $html = ob_get_clean();
    return $html;
}

function get_wohnung($lang) {
    ob_start();
    $step = 0;
    ?>
    <!---- START HTML ------>
    <?php if(have_rows('вид_квартиры', 'option')): ?>
    <div class="formular-step active" data-step="<?php echo $step; $step += 1; ?>">
        <div class="title type-1 text-center">
            <h2><?php the_field('вид_квартиры_заголовок_'.$lang, 'option'); ?></h2>
        </div>
        <div class="formular-form">
        <?php while(have_rows('вид_квартиры', 'option')): the_row(); ?>
            <div class="formular-form_item">
                <div class="formular-form_item-image">
                    <img src="<?php the_sub_field('изображение'); ?>" alt="<?php the_sub_field('текст_'.$lang); ?>">
                </div>
                <div class="formular-form_item-title">
                    <?php the_sub_field('текст_'.$lang); ?>
                </div>
            </div>
        <?php endwhile; ?>
        </div>
    </div>
    <?php endif; ?>

    <?php if(have_rows('параметры', 'option')): ?>
    <div class="formular-step" data-step="<?php echo $step; $step += 1; ?>">
        <div class="title type-1 text-center">
            <h2><?php the_field('параметры_заголовок_'.$lang, 'option'); ?></h2>
        </div>
        <div class="formular-form">
        <?php while(have_rows('параметры', 'option')): the_row(); ?>
        <div class="formular-form_input">
            <div class="formular-form_input-image">
                <img src="<?php the_sub_field('изображение'); ?>" alt="<?php the_sub_field('текст_'.$lang); ?>">
            </div>
            <div class="formular-form_input-input">
                <label for="">
                    <p class="label"><?php the_sub_field('текст_'.$lang); ?></p>
                    <input type="number" min="1" placeholder="<?php the_sub_field('default'); ?>">
                </label>
            </div>
        </div>
        <?php endwhile; ?>
        </div>
    </div>
    <?php endif; ?>

    <div class="formular-step" data-step="<?php echo $step; $step += 1; ?>">
        <div class="title type-1 text-center">
            <h2><?php the_field('арендованный_заголовок_'.$lang, 'option'); ?></h2>
        </div>
        <div class="formular-form">
            <div class="formular-form_item">
                <div class="formular-form_item-image">
                    <img src="<?php the_field('арендованый_да_изображение', 'option'); ?>" alt="<?php the_field('текст_'.$lang); ?>">
                </div>
                <div class="formular-form_item-title">
                    <?php the_field('арендованный_да_'.$lang, 'option'); ?>
                </div>
            </div>
            <div class="formular-form_item">
                <div class="formular-form_item-image">
                    <img src="<?php the_field('арендованый_нет_изображение', 'option'); ?>" alt="<?php the_field('текст_'.$lang); ?>">
                </div>
                <div class="formular-form_item-title">
                    <?php the_field('арендованный_нет_'.$lang, 'option'); ?>
                </div>
            </div>       
        </div>
    </div>

    <div class="formular-step" data-step="<?php echo $step; $step += 1; ?>">
        <div class="title type-1 text-center">
            <h2><?php the_field('аренда_'.$lang, 'option'); ?></h2>
        </div>
        <div class="formular-form">
            <div class="formular-form_input">
                <div class="formular-form_input-image">
                    <img src="<?php the_field('арендованый_да_изображение', 'option'); ?>" alt="<?php the_field('текст_'.$lang); ?>">
                </div>
                <div class="formular-form_input-input">
                    <label for="">
                        <p class="label"><?php the_field('аренда_текст_'.$lang, 'option'); ?></p>
                        <input type="number" min="<?php the_field('min', 'option'); ?>" max="<?php the_field('max', 'option'); ?>" placeholder="">
                    </label>
                </div>
            </div>
        </div>
    </div>

    <?php if(have_rows('элементы', 'option')): ?>
    <div class="formular-step" data-step="<?php echo $step; $step += 1; ?>">
        <div class="title type-1 text-center">
            <h2><?php the_field('состояние_заголовок_'.$lang, 'option'); ?></h2>
        </div>
        <div class="formular-form radio">
            
        <div class="formular-form_radio">
            <?php if(have_rows('критерии', 'option')): ?>
                <p></p>
            <?php while(have_rows('критерии', 'option')): the_row(); ?>
                <p class="formular-form_radio-title  head"><?php the_sub_field('текст_'.$lang); ?></p>
            <?php endwhile; ?>
        
        <?php endif; ?>
        </div>

        <?php while(have_rows('элементы', 'option')): the_row(); 
        $index = get_row_index(); ?>
        <div class="formular-form_radio">
            <div class="formular-form_radio-title"><?php the_sub_field('элемент_'.$lang); ?></div>
            <?php if(have_rows('критерии', 'option')): ?>
            <!-- <div class="formular-form_radio-wrap"> -->
            <?php while(have_rows('критерии', 'option')): the_row(); ?>
            <div class="input-radio">
                <input type="radio" name="<?php echo $index.'_'.$lang; ?>" value="<?php the_sub_field('текст_'.$lang); ?>" title="<?php the_sub_field('текст_'.$lang); ?>">
                <div class="input-radio_circle"></div>
            </div>
            <?php endwhile; ?>
            <!-- </div> -->
        <?php endif; ?>
        </div>
        <?php endwhile; ?>
        </div>
    </div>
    <?php endif; ?>

    <div class="formular-step" data-step="<?php echo $step; $step += 1; ?>">
        <div class="title type-1 text-center">
            <h2><?php the_field('место_расположения_заголовок_'.$lang, 'option'); ?></h2>
        </div>
        <div class="formular-form lage">
            <div class="lage-bg">
                <img src="<?php the_field('изображение_lage', 'option') ?>" alt="">
            </div>
            <div class="lage-form">
                <div class="lage-form_input">
                    <input type="text" placeholder="<?php echo get_field('индекс', 'option')['текст_'.$lang]; ?>">
                </div>
                <div class="lage-form_input">
                    <input type="text" placeholder="<?php echo get_field('город', 'option')['текст_'.$lang]; ?>">
                </div>
                <div class="lage-form_input">
                    <input type="text" placeholder="<?php echo get_field('улица', 'option')['текст_'.$lang]; ?>">
                </div>
                <div class="lage-form_input">
                    <input type="text" placeholder="<?php echo get_field('дом', 'option')['текст_'.$lang]; ?>">
                </div>
            </div>
            <div class="lage-text">
                <?php echo get_field('место_расположения_текст', 'option')['текст_'.$lang]; ?>
            </div>
        </div>
    </div>
    <div class="formular-step" data-step="<?php echo $step; $step += 1; ?>">
        <div class="title type-1 text-center">
            <h2><?php echo get_field('контактные_данные_заголовок', 'option')['текст_'.$lang]; ?></h2>
        </div>
        <div class="formular-form">
            <?php echo do_shortcode('[contact-form-7 id="469" title="Формуляр DE"]'); ?>    
        </div>
        <script>
            wpcf7.initForm( jQuery('.wpcf7-form') );
        </script>
    </div>

    <!---- END HTML -------->
    <?php
    $html = ob_get_clean();
    return $html;
}
