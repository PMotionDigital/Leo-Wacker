<?php if(!is_page('immobilie-verkaufen')): ?>
 <section class="footer-block dis-flex justify-content-center mgn-t" >
        <div class="footer-block_image media-wrapper" style="background: <?php echo get_field('цвет_фона'); ?>">
            <img src="<?php bloginfo('template_url'); ?>/dist/img/footer-image.png" alt="">
        </div>
        <div class="wrapper dis-flex justify-content-center">
            <div class="footer-block_text col-lg-10 col-xs-12">
                <p><?php the_field('футер_текст', 'option'); ?>
                </p>
            </div>
        </div>
    </section>
<?php endif; ?>
    <footer class="site-footer">
        <div class="site-footer_copyrights">© Leo Wacker Immobilien, 2020</div>
        <div class="site-footer_menu">fdsa</div>
    </footer>
    <?php wp_footer(); ?>
    </body>
</html>