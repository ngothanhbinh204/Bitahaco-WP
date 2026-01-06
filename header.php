<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Google+Sans+Flex:opsz,wght@6..144,1..1000&amp;display=swap"
		rel="stylesheet">

	<?php wp_head(); ?>

	<?= get_field('field_config_head', 'options') ?>
</head>

<body <?php body_class(get_field('add_class_body', get_the_ID())) ?>>
	<header class="header">
		<div class="header-top xl:block hidden">
			<div class="header-top-svg relative">
				<?php 
				$header_top_bg = get_field('svg_header_top', 'option');
				if($header_top_bg):
				?>
				<a class="img-ratio ratio:pt-[40_1920] lozad" href="#">
					<img class="object-contain" src="<?php echo esc_url($header_top_bg['url']); ?>" alt="">
				</a>
				<?php endif; ?>
				<div
					class="header-top-info absolute top-2/4 -translate-y-2/4 rem:right-[40px] flex items-center gap-6 text-white">
					<?php 
                    $career_link = get_field('header_career_link', 'option');
                    if($career_link): 
                    ?>
					<div class="carrer-link">
						<a href="<?php echo esc_url($career_link['url']); ?>"
							target="<?php echo esc_attr($career_link['target']); ?>"><?php echo esc_html($career_link['title']); ?></a>
					</div>
					<?php endif; ?>

					<div class="header-contact flex items-center gap-8">
						<?php 
                        $header_phone = get_field('header_phone', 'option');
                        if($header_phone):
                        ?>
						<div class="header-phone">
							<?php echo $header_phone; ?>
						</div>
						<?php endif; ?>
					</div>

					<div class="header-language flex items-center gap-3">
						<?php
                        // Check if WPML is active
                        if (function_exists('icl_get_languages')) {
                            $languages = icl_get_languages('skip_missing=0');
                            if(!empty($languages)){
                                foreach($languages as $l){
                                    $class = $l['active'] ? 'active' : ''; // You might want custom styles for active
                                    // Mapping flags from ACF options if needed, or use WPML flags
                                    // For this structure, let's use the ACF fields as requested or WPML default
                                    // HTML structure uses separate divs for icons.
                                    
                                    // To match HTML exactly: "icon-vn w-6" and "icon-en w-6"
                                    // We can try to map based on language code
                                    if($l['language_code'] == 'vi') {
                                         $flag_vn = get_field('header_language_vn', 'option');
                                         $img_src = $flag_vn ? $flag_vn['url'] : get_template_directory_uri() . '/UI/img/VN.svg';
                                         echo '<div class="icon-vn w-6"><a class="img-ratio" href="'.$l['url'].'"><img src="'.$img_src.'" alt="'.$l['native_name'].'"></a></div>';
                                    } elseif($l['language_code'] == 'en') {
                                         $flag_en = get_field('header_language_en', 'option');
                                         $img_src = $flag_en ? $flag_en['url'] : get_template_directory_uri() . '/UI/img/EN.svg';
                                         echo '<div class="icon-en w-6"><a class="img-ratio" href="'.$l['url'].'"><img src="'.$img_src.'" alt="'.$l['native_name'].'"></a></div>';
                                    }
                                }
                            }
                        } else {
                            // Fallback / Static (if WPML not active, show from options or static)
                            $flag_vn = get_field('header_language_vn', 'option');
                            $flag_en = get_field('header_language_en', 'option');
                             ?>
						<div class="icon-vn w-6"><a class="img-ratio " href="#"><img
									src="<?php echo $flag_vn ? $flag_vn['url'] : get_template_directory_uri() . '/UI/img/VN.svg'; ?>"
									alt=""></a></div>
						<div class="icon-en w-6"><a class="img-ratio " href="#"><img
									src="<?php echo $flag_en ? $flag_en['url'] : get_template_directory_uri() . '/UI/img/EN.svg'; ?>"
									alt=""></a></div>
						<?php } ?>
					</div>

					<?php 
                    $search_icon = get_field('header_search_icon_custom', 'option'); 
                    ?>
					<div class="header-search sq-6 flex-center">
						<img class="w-full h-full object-contain"
							src="<?php echo $search_icon ? $search_icon['url'] : get_template_directory_uri() . '/UI/img/icon-search.svg'; ?>"
							alt="">
					</div>
				</div>
			</div>
		</div>
		<div class="container-fluid">
			<div class="header-wrapper">
				<div class="header-left flex items-center gap-base">
					<div class="header-logo">
						<?php 
                        $logo = get_field('header_logo', 'option');
                        if($logo):
                        ?>
						<a class="img-ratio ratio:pt-[64_96]" href="<?php echo home_url(); ?>">
							<img class="lozad" data-src="<?php echo esc_url($logo['url']); ?>"
								alt="<?php echo esc_attr($logo['alt']); ?>" />
						</a>
						<?php else: 
                            if ( function_exists( 'the_custom_logo' ) ) {
                                the_custom_logo();
                            }
                        endif; ?>
					</div>
					<?php 
                    $slogan = get_field('header_slogan', 'option');
                    if($slogan):
                    ?>
					<div class="header-slogan swiper-column-auto swiper-loop autoplay w-full" data-time="0"
						data-speed="5500">
						<div class="swiper">
							<div class="swiper-wrapper">
								<?php 
                                // Assuming we want to repeat the slogan as per HTML example (5 times) or just once?
                                // The HTML shows multiple slides. If it's just one text field in options, we can repeat it or just show one.
                                // The JSON has "header_slogan" as "text".
                                // Let's Loop 5 times to mimic the effect or check if it's supposed to be a repeater. 
                                // JSON says "text". Let's assume it might be a single text repeated for the marquee effect.
                                for($i=0; $i<5; $i++):
                                ?>
								<div class="swiper-slide">
									<div class="slogan-item">
										<span
											class="body-4 font-bold text-Primary-1 uppercase"><?php echo esc_html($slogan); ?></span>
									</div>
								</div>
								<?php endfor; ?>
							</div>
						</div>
					</div>
					<?php endif; ?>
				</div>
				<div class="header-right">
					<div class="header-menu">
						<?php
                        if (class_exists('Header_Menu_Walker')) {
                            wp_nav_menu(array(
                                'theme_location' => 'header-menu',
                                'container' => false,
                                'menu_class' => 'header-nav',
                                'items_wrap' => '<ul class="%2$s">%3$s</ul>',
                                'depth' => 2,
                                'walker' => new Header_Menu_Walker(),
                            ));
                        } else {
                             wp_nav_menu(array(
                                'theme_location' => 'header-menu',
                                'container' => false,
                                'menu_class' => 'header-nav',
                                'items_wrap' => '<ul class="%2$s">%3$s</ul>',
                                'depth' => 2,
                            ));
                        }
                        ?>
					</div>
					<div class="header-language">
						<?php
                        // Mobile/Tablet View Language (Duplicate logic or just simplified)
                        if (function_exists('icl_get_languages')) {
                             // Same loop logic or reuse
                             $languages = icl_get_languages('skip_missing=0');
                             if(!empty($languages)){
                                 foreach($languages as $l){
                                     if($l['language_code'] == 'vi') {
                                         $flag_vn = get_field('header_language_vn', 'option');
                                         $img_src = $flag_vn ? $flag_vn['url'] : get_template_directory_uri() . '/UI/img/VN.svg';
                                         echo '<div class="icon-vn w-6"><a class="img-ratio" href="'.$l['url'].'"><img src="'.$img_src.'" alt="'.$l['native_name'].'"></a></div>';
                                     } elseif($l['language_code'] == 'en') {
                                         $flag_en = get_field('header_language_en', 'option');
                                         $img_src = $flag_en ? $flag_en['url'] : get_template_directory_uri() . '/UI/img/EN.svg';
                                         echo '<div class="icon-en w-6"><a class="img-ratio" href="'.$l['url'].'"><img src="'.$img_src.'" alt="'.$l['native_name'].'"></a></div>';
                                     }
                                 }
                             }
                        } else {
                            $flag_vn = get_field('header_language_vn', 'option');
                            $flag_en = get_field('header_language_en', 'option');
                        ?>
						<div class="icon-vn w-6"><a class="img-ratio " href="#"><img
									src="<?php echo $flag_vn ? $flag_vn['url'] : get_template_directory_uri() . '/UI/img/VN.svg'; ?>"
									alt=""></a></div>
						<div class="icon-en w-6"><a class="img-ratio " href="#"><img
									src="<?php echo $flag_en ? $flag_en['url'] : get_template_directory_uri() . '/UI/img/EN.svg'; ?>"
									alt=""></a></div>
						<?php } ?>
					</div>
					<div class="header-search">
						<img class="w-full h-full object-contain"
							src="<?php echo $search_icon ? $search_icon['url'] : get_template_directory_uri() . '/UI/img/icon-search.svg'; ?>"
							alt="">
					</div>
					<div class="header-bar">
						<i class="fa-solid fa-bars"></i>
					</div>
				</div>
			</div>
		</div>
	</header>
	<div class="header-overlay"></div>
	<div class="header-search-form">
		<div
			class="close flex items-center justify-center absolute top-0 right-0 bg-white text-3xl cursor-pointer w-12.5 h-12.5">
			<i class="fa-light fa-xmark"></i>
		</div>
		<div class="container">
			<div class="wrap-form-search-product">
				<form class="productsearchbox" action="<?php echo esc_url(home_url('/')); ?>" method="get">
					<input type="text" name="s" placeholder="Tìm kiếm thông tin"
						value="<?php echo get_search_query(); ?>">
					<button type="submit"><i class="fa-light fa-magnifying-glass"></i></button>
				</form>
			</div>
		</div>
	</div>
	<main>