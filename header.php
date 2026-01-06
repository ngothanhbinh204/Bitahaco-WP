<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&amp;display=swap" rel="stylesheet">

	<?php wp_head(); ?>

	<?= get_field('field_config_head', 'options') ?>
</head>

<body <?php body_class(get_field('add_class_body', get_the_ID())) ?>>
	<header class="header"> 
		<div class="container-1600"> 
			<div class="header-child flex-between py-2.5 lg:py-3.5">
				<div class="logo"> 
					<?php echo get_custom_logo(); ?>
				</div>
				<div class="list-menu-header -lg:hidden">
					<?php
						// Define the Walker class first before using it
						if (!class_exists('Walker_Nav_Menu_Custom')) {
							class Walker_Nav_Menu_Custom extends Walker_Nav_Menu {
								function start_lvl(&$output, $depth = 0, $args = array()) {
									$indent = str_repeat("\t", $depth);
									$output .= "\n$indent<ul class=\"sub-menu header-mega-menu\">\n";
								}
							}
						}
						
						// Then use it in wp_nav_menu
						wp_nav_menu(array(
							'theme_location' => 'header-menu',
							'container' => false,
							'menu_class' => '',
							'fallback_cb' => false,
							'items_wrap' => '<ul>%3$s</ul>',
							'depth' => 2,
							'walker' => new Walker_Nav_Menu_Custom(),
						));
					?>
				</div>
				<div class="header-action flex items-center gap-x-5">
					<div class="flex items-center gap-x-3">
						<div class="header-language">
							<?php 
							if (function_exists('icl_get_languages')) {
								$languages = icl_get_languages('skip_missing=0&orderby=code');
								if (!empty($languages)) {
									// Active language display
									echo '<div class="header-language-active">';
									echo '<ul>';
									foreach ($languages as $lang) {
										if ($lang['active']) {
											echo '<li class="wpml-ls-current-language">';
											echo '<a href="' . esc_url($lang['url']) . '">';
											if (isset($lang['country_flag_url'])) {
												echo '<img class="lozad" data-src="' . esc_url($lang['country_flag_url']) . '" alt="' . esc_attr($lang['tag']) . '"/>';
											}
											echo '<span class="wpml-ls-native">' . esc_html(strtoupper($lang['tag'])) . '</span>';
											echo '</a>';
											echo '</li>';
										}
									}
									echo '</ul>';
									echo '</div>';
									
									// Language dropdown list
									echo '<div class="header-language-list">';
									echo '<ul>';
									foreach ($languages as $lang) {
										if ($lang['active']) {
											echo '<li class="wpml-ls-current-language">';
											echo '<a href="' . esc_url($lang['url']) . '">';
											echo '<span class="wpml-ls-native">' . esc_html(strtoupper($lang['tag'])) . '</span>';
											echo '</a>';
											echo '</li>';
										}
									}
									echo '<ul>';
									foreach ($languages as $lang) {
										if (!$lang['active']) {
											echo '<li>';
											echo '<a href="' . esc_url($lang['url']) . '">';
											echo '<span>' . esc_html(strtoupper($lang['tag'])) . '</span>';
											echo '</a>';
											echo '</li>';
										}
									}
									echo '</ul>';
									echo '</ul>';
									echo '</div>';
								}
							}
							?>
						</div>
						<button class="header-search header-search-btn text-body-1 text-primary-3"><i class="fa-light fa-magnifying-glass"></i></button>
					</div>
					<div class="header-hamburger"><span></span><span></span><span></span>
						<div id="pulseMe">
							<div class="bar left"></div>
							<div class="bar top"></div>
							<div class="bar right"></div>
							<div class="bar bottom"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</header>
	<main>