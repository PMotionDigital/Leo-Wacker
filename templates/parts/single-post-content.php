<?php
/* Single Post Content */ 
?>
<div class="post_fields-wrap">
    <div class="post_fields--selected"></div>
    <div class="post_fields">

    <?php
    $fields = array(
        'area' => array(
            'ru' => 'Округ Берлина',
            'en' => 'Berlin area',
            'de' => 'Bezirk',
            'price' => false
        ),
        'address' => array(
            'ru' => 'Адрес объекта',
            'en' => 'Address',
            'de' => 'Adresse',
            'price' => false
        ),
        'year_built' => array(
            'ru' => 'Год постройки',
            'en' => 'Construction year',
            'de' => 'Baujahr',
            'price' => false
        ),
        'renovation_year' => array(
            'ru' => 'Год ремонта',
            'en' => 'Year of renovation',
            'de' => 'Sanierung',
            'price' => false
        ),
        'floor' => array(
            'ru' => 'Этаж',
            'en' => 'Floor',
            'de' => 'Fußboden',
            'price' => false
        ),
        'art_of_energy_certificates' => array(
            'ru' => '',
            'en' => 'Art of energy certificates',
            'de' => 'Energieausweis Art',
            'price' => false
        ),
        'energy_certificate' => array(
            'ru' => 'Энергосертификат',
            'en' => 'Energy certificates',
            'de' => 'Energieausweis',
            'price' => false
        ),
        'cold_rent_p_m' => array(
            'ru' => '',
            'price' => true
        ),
        'rent_incl_operations_cost' => array(
            'ru' => '',
            'price' => true
        ),
        'rent_including_heating_pm' => array(
            'ru' => '',
            'price' => true
        ),
        'montly_payments' => array(
            'ru' => 'Ком. платежи',
            'en' => 'Montly payments',
            'de' => 'Hausgeld',
            'price' => true
        ),
        'buyers_fee' => array(
            'ru' => 'Размер комиссионных',
            'en' => 'Buyer\'s fee',
            'de' => 'käuferprovision',
            'price' => false
        )
    );
    $lang = pll_get_post_language( $post, 'slug' );
    $areas = get_field('area_-_translations', 'options');


    foreach($fields as $field => $names):
        if(get_field($field)): ?>
        <div class="post_fields-item">
            <span class="name"><?php echo $names[$lang] ?>:</span>
            <span class="value"><?php 
                if($field == 'area'):
                    foreach($areas as $area){
                        if($area['slug'] == get_field($field)){
                            echo $area[$lang];
                        }
                    }
                elseif($names['price'] == true):
                    echo number_format(get_field($field), 2, ',', ' '). ' €';
                else:
                    the_field($field); 
                endif;
            ?></span>
        </div> <?php
        endif; 
    endforeach;
    if(have_rows('other_fields')):
        while(have_rows('other_fields')): the_row(); ?>
        <div class="post_fields-item">
            <span class="name"><?php the_sub_field('name') ?>:</span>
            <span class="value"><?php the_sub_field('value') ?></span>
        </div> <?php 
        endwhile;
    endif;
    ?>
    </div>
</div>

<div class="post_text-content">
    <?php the_content(); ?>
</div>
