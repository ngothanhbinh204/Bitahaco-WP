<?php
/**
 * Template Name: Trang chủ
 */
get_header(); 
?>

<main>
	<?php if (get_field('home_banner_enable')): ?>
	<?php $banner_slides = get_field('home_banner_slides'); ?>
	<?php if ($banner_slides): ?>
	<section class="home-1 relative">
		<div class="home-1-slide relative">
			<div class="swiper">
				<div class="swiper-wrapper">
					<?php foreach ($banner_slides as $slide): 
                                $image = $slide['banner_image'];
                                $title = $slide['banner_title'];
                                if (!$image) continue;
                            ?>
					<div class="swiper-slide">
						<div class="home-1-banner relative">
							<a class="img-ratio ratio:pt-[896_1920]" href="#" title="<?php echo esc_attr($title); ?>">
								<img class="lozad" data-src="<?php echo esc_url($image['url']); ?>"
									alt="<?php echo esc_attr($image['alt']); ?>" />
							</a>
						</div>
					</div>
					<?php endforeach; ?>
				</div>
				<div class="wrap-pagination flex items-center justify-center gap-8">
					<div class="arrow-left"><img src="<?php echo get_template_directory_uri(); ?>/UI/img/arrow-left.svg"
							alt=""></div>
					<div class="pagination-main flex items-center gap-2">
						<div class="swiper-pagination"></div>
						<div class="play">
							<div class="paused-slide hidden cursor-pointer"><i class="fa-light fa-play"></i></div>
							<div class="playing-slide cursor-pointer"><i class="fa-light fa-pause"></i></div>
						</div>
					</div>
					<div class="arrow-right"> <img
							src="<?php echo get_template_directory_uri(); ?>/UI/img/arrow-right.svg" alt=""></div>
				</div>
			</div>
		</div>
	</section>
	<?php endif; ?>
	<?php endif; ?>

	<?php if (get_field('home_news_enable')): ?>
	<?php 
        $news_title = get_field('home_news_title');
        $categories = get_field('home_news_categories');
        ?>
	<section class="home-2 section-py">
		<div class="container-fluid">
			<div class="wrap-tabslet" data-toggle="tabslet">
				<div class="wrap-heading text-center mb-base">
					<?php if ($news_title): ?>
					<h2 class="news-title heading-1 text-Primary-1 mb-4" data-aos="fade-up" data-aos-delay="100"
						data-aos-duration="1000"><?php echo esc_html($news_title); ?></h2>
					<?php endif; ?>

					<ul class="tabslet-tab nav-primary" data-aos="fade-up" data-aos-delay="200"
						data-aos-duration="1000">
						<li class="active"><a href="#tab-all"><?php _e('Tất cả', 'canhcamtheme'); ?></a></li>
						<?php if ($categories): ?>
						<?php foreach ($categories as $index => $term): ?>
						<li><a href="#tab-cat-<?php echo $term->term_id; ?>"><?php echo esc_html($term->name); ?></a>
						</li>
						<?php endforeach; ?>
						<?php endif; ?>
					</ul>
				</div>

				<!-- Tab All -->
				<div class="tabslet-content active" id="tab-all" data-aos="fade-up" data-aos-delay="300"
					data-aos-duration="1000">
					<div class="block-news w-full">
						<div class="swiper-column-auto relative swiper-loop autoplay">
							<div class="swiper-wrapper">
								<?php 
                                    $args = array(
                                        'post_type' => 'post',
                                        'posts_per_page' => 10,
                                        'post_status' => 'publish'
                                    );
                                    $query = new WP_Query($args);
                                    if ($query->have_posts()):
                                        while ($query->have_posts()): $query->the_post();
                                    ?>
								<div class="swiper-slide">
									<div
										class="news-item flex flex-col h-full rounded-2 overflow-hidden bg-Utility-gray-50 border border-Utility-gray-200 transition-300 hover:shadow-hover-card group">
										<div class="img overflow-hidden"><a
												class="img-ratio ratio:pt-[240_426] block overflow-hidden"
												href="<?php the_permalink(); ?>"> <img
													class="grayscale group-hover:grayscale-0 transition-500 lozad"
													data-src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'large'); ?>"
													alt="<?php the_title(); ?>" /></a></div>
										<div class="content p-5 flex-1 flex flex-col">
											<div class="info flex items-center gap-3 mb-3">
												<div class="date flex items-center gap-1"> <i
														class="fa-sharp fa-light fa-calendar text-Primary-1"></i><span
														class="body-3 text-Utility-gray-500"><?php echo get_the_date('d/m/Y'); ?></span>
												</div>
												<div class="cat flex items-center gap-1 uppercase"> <i
														class="fa-light fa-folder-open text-Primary-1"></i><span
														class="body-3 text-Utility-gray-500"><?php 
                                                                $cats = get_the_category();
                                                                if ($cats) echo esc_html($cats[0]->name);
                                                            ?></span></div>
											</div>
											<h3
												class="title heading-5 font-semibold text-Utility-gray-900 line-clamp-2 mb-3">
												<a class="transition-300 group-hover:text-Primary-1"
													href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
											</h3>
											<div class="desc body-3 text-Utility-gray-600 line-clamp-3 mb-6">
												<?php echo wp_trim_words(get_the_excerpt(), 20); ?></div>
											<div class="button mt-auto"><a
													class="flex items-center gap-1 transition-300 group-hover:text-Primary-1 group-hover:gap-2"
													href="<?php the_permalink(); ?>"> <span
														class="text-button-s font-bold text-Utility-gray-500 transition-300 group-hover:text-Primary-1">Xem
														chi tiết</span><i
														class="fa-light fa-arrow-right text-Utility-gray-500 transition-300 group-hover:text-Primary-1"></i></a>
											</div>
										</div>
									</div>
								</div>
								<?php 
                                        endwhile;
                                        wp_reset_postdata();
                                    endif;
                                    ?>
							</div>
						</div>
					</div>
				</div>

				<!-- Category Tabs -->
				<?php if ($categories): ?>
				<?php foreach ($categories as $index => $term): ?>
				<div class="tabslet-content" id="tab-cat-<?php echo $term->term_id; ?>" data-aos="fade-up"
					data-aos-delay="400" data-aos-duration="1000">
					<div class="block-news w-full">
						<div class="swiper-column-auto relative swiper-loop autoplay">
							<div class="swiper-wrapper">
								<?php 
                                            $args = array(
                                                'post_type' => 'post',
                                                'posts_per_page' => 10,
                                                'post_status' => 'publish',
                                                'tax_query' => array(
                                                    array(
                                                        'taxonomy' => 'category',
                                                        'field' => 'term_id',
                                                        'terms' => $term->term_id
                                                    )
                                                )
                                            );
                                            $query = new WP_Query($args);
                                            if ($query->have_posts()):
                                                while ($query->have_posts()): $query->the_post();
                                            ?>
								<div class="swiper-slide">
									<div
										class="news-item flex flex-col h-full rounded-2 overflow-hidden bg-Utility-gray-50 border border-Utility-gray-200 transition-300 hover:shadow-hover-card group">
										<div class="img overflow-hidden"><a
												class="img-ratio ratio:pt-[240_426] block overflow-hidden"
												href="<?php the_permalink(); ?>"> <img
													class="grayscale group-hover:grayscale-0 transition-500 lozad"
													data-src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'large'); ?>"
													alt="<?php the_title(); ?>" /></a></div>
										<div class="content p-5 flex-1 flex flex-col">
											<div class="info flex items-center gap-3 mb-3">
												<div class="date flex items-center gap-1"> <i
														class="fa-sharp fa-light fa-calendar text-Primary-1"></i><span
														class="body-3 text-Utility-gray-500"><?php echo get_the_date('d/m/Y'); ?></span>
												</div>
												<div class="cat flex items-center gap-1 uppercase"> <i
														class="fa-light fa-folder-open text-Primary-1"></i><span
														class="body-3 text-Utility-gray-500"><?php echo esc_html($term->name); ?></span>
												</div>
											</div>
											<h3
												class="title heading-5 font-semibold text-Utility-gray-900 line-clamp-2 mb-3">
												<a class="transition-300 group-hover:text-Primary-1"
													href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
											</h3>
											<div class="desc body-3 text-Utility-gray-600 line-clamp-3 mb-6">
												<?php echo wp_trim_words(get_the_excerpt(), 20); ?></div>
											<div class="button mt-auto"><a
													class="flex items-center gap-1 transition-300 group-hover:text-Primary-1 group-hover:gap-2"
													href="<?php the_permalink(); ?>"> <span
														class="text-button-s font-bold text-Utility-gray-500 transition-300 group-hover:text-Primary-1">Xem
														chi tiết</span><i
														class="fa-light fa-arrow-right text-Utility-gray-500 transition-300 group-hover:text-Primary-1"></i></a>
											</div>
										</div>
									</div>
								</div>
								<?php 
                                                endwhile;
                                                wp_reset_postdata();
                                            endif;
                                            ?>
							</div>
						</div>
					</div>
				</div>
				<?php endforeach; ?>
				<?php endif; ?>

			</div>
		</div>
	</section>
	<?php endif; ?>

	<?php if (get_field('home_about_enable')): ?>
	<?php
        $about_bg = get_field('home_about_background');
        $about_title = get_field('home_about_title');
        $about_desc = get_field('home_about_description');
        $about_btn = get_field('home_about_button');
        $about_stats = get_field('home_about_stats');
        ?>
	<section class="home-3 xl:pb-15 pb-10">
		<div class="container-fluid">
			<div class="wrapper grid xl:grid-cols-2 grid-cols-1 gap-base">
				<div class="col-left">
					<div class="box text-center text-white xl:p-16 p-4 rounded-5"
						<?php echo $about_bg ? 'setBackground="' . esc_url($about_bg['url']) . '"' : ''; ?>>
						<?php if ($about_title): ?>
						<h2 class="title heading-1 font-bold text-white mb-4" data-aos="fade-up" data-aos-delay="100"
							data-aos-duration="1000"><?php echo esc_html($about_title); ?></h2>
						<?php endif; ?>
						<?php if ($about_desc): ?>
						<div class="format-content body-1 font-normal" data-aos="fade-up" data-aos-delay="200"
							data-aos-duration="1000">
							<?php echo $about_desc; ?>
						</div>
						<?php endif; ?>
						<?php if ($about_btn): ?>
						<div class="button-more mt-base flex-centers" data-aos="fade-up" data-aos-delay="300"
							data-aos-duration="1000">
							<a class="btn-primary btn" href="<?php echo esc_url($about_btn['url']); ?>"
								target="<?php echo esc_attr($about_btn['target']); ?>"> <span
									data-text="<?php echo esc_attr($about_btn['title']); ?>"><?php echo esc_html($about_btn['title']); ?></span></a>
						</div>
						<?php endif; ?>
					</div>
				</div>
				<?php if ($about_stats): ?>
				<div class="col-right">
					<?php 
                        // First Row (Items 0 and 1)
                        $first_row = array_slice($about_stats, 0, 2);
                        if ($first_row):
                        ?>
					<div class="wrap flex md:flex-row flex-col gap-5">
						<?php foreach ($first_row as $index => $stat): 
                                $is_large = ($index === 1); 
                                $class_w = $index === 0 ? 'md:rem:w-[480px] w-full' : 'flex-1';
                            ?>
						<div class="item rounded-5 bg-Utility-gray-50 xl:px-8 xl:py-7 p-5 <?php echo $class_w; ?> xl:rem:h-[320px] h-full"
							data-aos="flip-down" data-aos-duration="1000">
							<div class="icon w-12 h-12 mb-5"> <img class="w-full h-full object-contain"
									src="<?php echo esc_url($stat['stat_icon']['url']); ?>"
									alt="<?php echo esc_attr($stat['stat_title']); ?>"></div>
							<div class="number heading-1 font-bold text-Primary-1 mb-2"> <span class="counter"
									data-count="<?php echo esc_attr($stat['stat_number']); ?>"><?php echo esc_html($stat['stat_number']); ?></span><span><?php echo esc_html($stat['stat_suffix']); ?></span>
							</div>
							<div class="title heading-5 font-bold text-Utility-gray-900 mb-2">
								<?php echo esc_html($stat['stat_title']); ?></div>
							<div class="desc body-1 font-normal text-Utility-gray-600">
								<?php echo esc_html($stat['stat_description']); ?></div>
						</div>
						<?php endforeach; ?>
					</div>
					<?php endif; ?>

					<?php 
                        // Second Row (Items 2 and 3)
                        $second_row = array_slice($about_stats, 2, 2);
                        if ($second_row):
                        ?>
					<div class="wrap flex md:flex-row flex-col gap-5 <?php echo (!empty($first_row)) ? 'mt-5' : ''; ?>">
						<?php foreach ($second_row as $index => $stat): 
                                $class_w = $index === 0 ? 'md:rem:w-[480px] w-full' : 'flex-1';
                            ?>
						<div class="item rounded-5 bg-Utility-gray-50 xl:px-8 xl:py-7 p-5 <?php echo $class_w; ?> xl:rem:h-[320px] h-full"
							data-aos="flip-down" data-aos-duration="1000">
							<div class="icon w-12 h-12 mb-5"> <img class="w-full h-full object-contain"
									src="<?php echo esc_url($stat['stat_icon']['url']); ?>"
									alt="<?php echo esc_attr($stat['stat_title']); ?>"></div>
							<div class="number heading-1 font-bold text-Primary-1 mb-2"> <span class="counter"
									data-count="<?php echo esc_attr($stat['stat_number']); ?>"><?php echo esc_html($stat['stat_number']); ?></span><span><?php echo esc_html($stat['stat_suffix']); ?></span>
							</div>
							<div class="title heading-5 font-bold text-Utility-gray-900 mb-2">
								<?php echo esc_html($stat['stat_title']); ?></div>
							<div class="desc body-1 font-normal text-Utility-gray-600">
								<?php echo esc_html($stat['stat_description']); ?></div>
						</div>
						<?php endforeach; ?>
					</div>
					<?php endif; ?>
				</div>
				<?php endif; ?>
			</div>
		</div>
	</section>
	<?php endif; ?>

	<?php if (get_field('home_field_operation_enable')): ?>
	<?php
        $field_title = get_field('home_field_operation_title');
        $field_desc = get_field('home_field_operation_description');
        $field_items = get_field('home_field_operation_items');
        ?>
	<section class="section-field-op py-10">
		<div class="container-fluid">
			<div class="field-op">
				<div class="wrap-heading rem:max-w-[1000px] w-full mx-auto text-center mb-base">
					<?php if ($field_title): ?>
					<h2 class="title heading-1 text-Primary-1 font-bold mb-4" data-aos="fade-up" data-aos-delay="100"
						data-aos-duration="1000"><?php echo esc_html($field_title); ?></h2>
					<?php endif; ?>
					<?php if ($field_desc): ?>
					<div class="desc body-1 font-normal" data-aos="fade-up" data-aos-delay="200"
						data-aos-duration="1000">
						<p><?php echo esc_html($field_desc); ?></p>
					</div>
					<?php endif; ?>
				</div>
				<?php if ($field_items): ?>
				<div class="swiper swiper-field-op" data-aos="zoom-in" data-aos-delay="300" data-aos-duration="1000">
					<ul class="swiper-wrapper field-op-list">
						<?php foreach ($field_items as $item): 
                                $bg_img = $item['field_image'];
                                $icon = $item['field_icon'];
                                $title = $item['field_title'];
                                $desc = $item['field_description'];
                            ?>
						<li
							class="swiper-slide field-op-item relative xl:flex-1 rem:!h-[480px] overflow-hidden group transition-500">
							<div class="img-bg absolute top-0 left-0 w-full h-full -z-1 overflow-hidden">
								<img class="w-full h-full object-cover transition-500 group-hover:scale-105 lozad"
									data-src="<?php echo esc_url($bg_img['url']); ?>"
									alt="<?php echo esc_attr($title); ?>">
								<div
									class="layout-bg absolute top-0 left-0 w-full h-full bg-linear-gradient-5 opacity-50">
								</div>
							</div>
							<div class="content absolute bottom-0 left-0 w-full xl:rem:p-[40px] p-5 z-2">
								<div
									class="icon w-20 h-20 rounded-full bg-white/20 backdrop-blur-[20px] flex-center mb-5 border border-white/40 xl:translate-y-[150%] transition-500 group-hover:translate-y-0">
									<img class="w-10 h-10 object-contain" src="<?php echo esc_url($icon['url']); ?>"
										alt="<?php echo esc_attr($title); ?>">
								</div>
								<div
									class="title heading-3 font-semibold text-white mb-2 xl:translate-y-[150%] transition-500 group-hover:translate-y-0">
									<?php echo esc_html($title); ?></div>
								<div
									class="desc body-1 font-normal text-white xl:opacity-0 xl:invisible transition-500 group-hover:opacity-100 group-hover:visible translate-y-[20px] group-hover:translate-y-0">
									<?php echo esc_html($desc); ?></div>
							</div>
						</li>
						<?php endforeach; ?>
					</ul>
				</div>
				<?php endif; ?>
			</div>
		</div>
	</section>
	<?php endif; ?>

	<?php if (get_field('home_partner_enable')): ?>
	<?php
        $partner_bg = get_field('home_partner_background');
        $partner_title = get_field('home_partner_title');
        $partner_desc = get_field('home_partner_description');
        $partner_logos = get_field('home_partner_logos');
        ?>
	<section class="sectionn-parter section-py"
		<?php echo $partner_bg ? 'setBackground="' . esc_url($partner_bg['url']) . '"' : ''; ?>>
		<div class="container-fluid">
			<div class="wrap-heading rem:max-w-[1000px] w-full text-center mb-base mx-auto">
				<?php if ($partner_title): ?>
				<h2 class="title heading-1 text-Primary-1 font-bold mb-4" data-aos="fade-up" data-aos-delay="100"
					data-aos-duration="1000"><?php echo esc_html($partner_title); ?></h2>
				<?php endif; ?>
				<?php if ($partner_desc): ?>
				<div class="desc body-1 font-normal" data-aos="fade-up" data-aos-delay="200" data-aos-duration="1000">
					<p><?php echo esc_html($partner_desc); ?></p>
				</div>
				<?php endif; ?>
			</div>

			<?php if ($partner_logos): ?>
			<div class="slide-top">
				<div class="swiper">
					<div class="swiper-wrapper">
						<?php foreach ($partner_logos as $logo_item): ?>
						<div class="swiper-slide">
							<div
								class="item bg-white flex-center w-full rem:h-[120px] rounded-2 border border-Utility-gray-200">
								<a class="img-ratio ratio:pt-[44_146] block w-full max-w-[146px]" href="#">
									<img class="object-contain lozad"
										data-src="<?php echo esc_url($logo_item['partner_logo']['url']); ?>"
										alt="<?php echo esc_attr($logo_item['partner_logo']['alt']); ?>" />
								</a>
							</div>
						</div>
						<?php endforeach; ?>
					</div>
				</div>
			</div>
			<div class="slide-bottom">
				<div class="swiper">
					<div class="swiper-wrapper">
						<?php foreach ($partner_logos as $logo_item): ?>
						<div class="swiper-slide">
							<div
								class="item bg-white flex-center w-full rem:h-[120px] rounded-2 border border-Utility-gray-200">
								<a class="img-ratio ratio:pt-[44_146] block w-full max-w-[146px]" href="#">
									<img class="object-contain lozad"
										data-src="<?php echo esc_url($logo_item['partner_logo']['url']); ?>"
										alt="<?php echo esc_attr($logo_item['partner_logo']['alt']); ?>" />
								</a>
							</div>
						</div>
						<?php endforeach; ?>
					</div>
				</div>
			</div>
			<?php endif; ?>
		</div>
	</section>
	<?php endif; ?>

	<section class="home-6">
		<div class="wrapper grid md:grid-cols-2 grid-cols-1">
			<div class="col-left xl:rem:pr-[210px] px-5 xl:pl-25 xl:rem:min-h-[560px] h-full flex flex-col justify-center py-10"
				setBackground="<?php echo get_template_directory_uri(); ?>/UI/img/1.jpg">
				<div class="wrap-content text-white mb-base">
					<h2 class="title heading-1 font-bold mb-4" data-aos="fade-right" data-aos-delay="200"
						data-aos-duration="1000"><?php _e('Kết nối với chúng tôi', 'canhcamtheme'); ?></h2>
					<div class="sub-title body-1 font-normal" data-aos="fade-right" data-aos-delay="400"
						data-aos-duration="1000">
						<?php _e('Đồng hành cùng chúng tôi trong hành trình phát triển bền vững.', 'canhcamtheme'); ?>
					</div>
				</div>
				<div class="button" data-aos="fade-right" data-aos-delay="600" data-aos-duration="1000"><a
						class="btn btn-secondary" href="#"> <span
							data-text="ĐĂNG KÝ NGAY"><?php _e('ĐĂNG KÝ NGAY', 'canhcamtheme'); ?></span></a></div>
			</div>
			<div class="col-right" data-aos="zoom-in" data-aos-delay="200" data-aos-duration="1000">
				<iframe
					src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3919.8005042227346!2d106.6387975759276!3d10.74985305968154!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752e880c1fa687%3A0xc077ff1ae7920516!2zMjIyLTIyMkEgxJAuIEjhuq11IEdpYW5nLCBQaMaw4budbmcgOSwgUXXhuq1uIDYsIFRow6BuaCBwaOG7kSBI4buTIENow60gTWluaCwgVmnhu4d0IE5hbQ!5e0!3m2!1svi!2s!4v1767167017482!5m2!1svi!2s"
					width="800" height="600" style="border:0;" allowfullscreen loading="lazy"
					referrerpolicy="no-referrer-when-downgrade"></iframe>
			</div>
		</div>
	</section>

</main>

<?php get_footer(); ?>