<?php if(!is_page('immobilie-verkaufen')): ?>
 <section class="footer-block dis-flex justify-content-center mgn-t" >
        <div class="footer-block_image media-wrapper" style="background: <?php echo get_field('цвет_фона'); ?>">
            <img src="<?php the_field('футер__изображение', pll_current_language()); ?>" alt="">
        </div>
        <div class="wrapper dis-flex justify-content-center">
            <div class="footer-block_text col-lg-10 col-xs-12">
                <p><?php the_field('футер_текст', pll_current_language()); ?>
                </p>
            </div>
        </div>
    </section>
<?php endif; ?>
    <footer class="site-footer">
        <div class="site-footer_copyrights"><?php the_field('футер_copyright', pll_current_language()); ?></div>
        <?php if(have_rows('футер_контакты', pll_current_language())): ?>
        <ul class="site-footer_menu">
        <?php while(have_rows('футер_контакты', pll_current_language())): the_row(); ?>
            <li class="site-footer_menu-item">
                <a href="<?php the_sub_field('ссылка'); ?>"><?php the_sub_field('текст'); ?></a>
            </li>
        <?php endwhile; ?>
        </ul>
        <?php endif; ?>
    </footer>
    <?php if(!wp_is_mobile()): ?>
    </section>
    <?php endif; ?>
    <?php 
    get_template_part('templates/modals/modal-formular');
    wp_footer(); ?>
    </body>
</html>