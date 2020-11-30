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