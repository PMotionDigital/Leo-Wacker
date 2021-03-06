<!DOCTYPE html>
<html lang="ru">
	<head>
		<meta charset="utf-8">
		<title><?php wp_title('')?></title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta content="telephone=no" name="format-detection">
		<meta name="HandheldFriendly" content="true">
		<?php wp_head(); ?>
	</head>
	<body <?php body_class(array('page')) ?> style="background: <?php echo get_field('цвет_фона'); ?>">
<?php if(!wp_is_mobile()): $mobile = false; ?>
	<header class="site-header transparent" style="<?php if(is_user_logged_in()){ echo 'top: 32px'; }; ?>">
		<div class="site-header_left col-lg-4">
			<a href="/" class="site-header_logo">
				<img src="<?php bloginfo('template_url'); ?>/dist/img/logo.png" alt="">
			</a>
		</div>
		<div class="site-header_nav">
			<?php echo do_shortcode('[widget id="nav_menu-2"]'); ?>
		</div>
		<div class="site-header_right col-lg-4">
			<a href="<?php echo get_page_link(pll_get_post(257)); ?>" class="header-link"><?php echo get_the_title(pll_get_post(257)); ?></a>
			<a href="tel:4903026035598" class="header-link">+49 (0) 30-260-355-98</a>
			<?php echo do_shortcode('[widget id="polylang-2"]'); ?>
		</div>
	</header>
<?php else: $mobile = true; ?>
	<header class="site-header--mobile">
		<div class="site-header_left col-lg-4">
			<a href="/" class="site-header_logo">
				<img src="<?php bloginfo('template_url'); ?>/dist/img/logo.png" alt="">
			</a>
		</div>
		<button area-label="Menu" data-menu class="site-header_burger">
			<span class="line"></span>
		</button>
	</header>
	<div class="mobile-menu" data-menu-container>
		<div class="mobile-menu-content" style="opacity: 0">
			<div class="site-header_nav--mobile">
				<?php echo do_shortcode('[widget id="nav_menu-2"]'); ?>
			</div>
			<div class="site-header_right col-xs-12">
				<a href="<?php echo get_page_link(pll_get_post(257)); ?>" class="header-link btn"><?php echo get_the_title(pll_get_post(257)); ?></a>
				<a href="tel:4903026035598" class="header-link phone">+49 (0) 30-260-355-98</a>
				<?php echo do_shortcode('[widget id="polylang-2"]'); ?>
			</div>
		</div>
	</div>
<?php endif; ?>
	<input type="hidden" id="is_mobile_" value="<?php print_r($mobile); ?>">
	<input type="hidden" id="current_locale_" value="<?php echo pll_current_language(); ?>">

	<?php if(!wp_is_mobile()): ?>
	<section id="my-scrollbar">
	<?php endif; ?>