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
								$title_attr = wp_strip_all_tags($title);
                                if (!$image) continue;
                            ?>
					<div class="swiper-slide">
						<div class="home-1-banner relative">
							<a class="img-ratio ratio:pt-[896_1920]" href="#"
								title="<?php echo esc_html( $title_attr ); ?>">
								<img class="lozad" data-src="<?php echo esc_url($image['url']); ?>"
									alt="<?php echo esc_html($image['alt']); ?>" />
							</a>
							<div class="home-1-content">
								<div class="container">
									<div class="heading-title heading-banner text-white font-bold uppercase"
										data-aos="fade-up" data-aos-delay="100" data-aos-duration="1000">
										<?php echo wp_kses_post( $title ); ?>
									</div>
								</div>
							</div>
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
							<i class="fa-solid fa-pause"></i>
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
						data-aos-duration="1000"><?php echo $news_title; ?></h2>
					<?php endif; ?>

					<ul class="tabslet-tab nav-primary" data-aos="fade-up" data-aos-delay="200"
						data-aos-duration="1000">
						<li class="active"><a href="#tab-all" data-tab="all"><?php _e('Tất cả', 'canhcamtheme'); ?></a>
						</li>
						<?php if ($categories): ?>
						<?php foreach ($categories as $index => $term): ?>
						<li><a href="#tab-cat-<?php echo $term->term_id; ?>"
								data-tab="cat-<?php echo $term->term_id; ?>"><?php echo $term->name; ?></a>
						</li>
						<?php endforeach; ?>
						<?php endif; ?>
					</ul>
				</div>

				<!-- Tab All -->
				<div class="tabslet-content active" id="tab-all" data-aos="fade-up" data-aos-delay="300"
					data-aos-duration="1000">
					<div class="block-news w-full">
						<div class="swiper-column-auto relative swiper-loop autoplay" data-swiper="swiper-all">
							<div class="swiper swiper-news-all">
								<ul class="swiper-wrapper list-news">
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
									<li class="swiper-slide">
										<div class="news-item zoom-img-parent flex flex-col h-full">
											<div class="news-thumb">
												<a class="img-ratio sha ratio:pt-[256_385] rounded-5 img-zoom"
													href="<?php the_permalink(); ?>">
													<img class="lozad"
														data-src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'large'); ?>"
														alt="<?php the_title(); ?>" />
												</a>
												<div class="category">
													<span><?php 
                                                        $cats = get_the_category();
                                                        if ($cats) echo $cats[0]->name;
                                                    ?></span>
												</div>
											</div>
											<div class="content py-5">
												<h3 class="title heading-3 font-bold text-Primary-1 line-clamp-3 mb-3">
													<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
												</h3>
												<div
													class="desc text-Utility-gray-950-maintext font-normal line-clamp-4">
													<p><?php echo wp_trim_words(get_the_excerpt(), 20); ?></p>
												</div>
												<div
													class="date body-4 text-Utility-gray-600-secondarytext font-normal">
													<?php echo get_the_date('d/m/Y'); ?></div>
											</div>
										</div>
									</li>
									<?php 
                                            endwhile;
                                            wp_reset_postdata();
                                        endif;
                                        ?>
								</ul>
							</div>
							<div class="arrow-button mt-base flex-center gap-2" data-aos="fade-up" data-aos-delay="600"
								data-aos-duration="1000">
								<div class="btn btn-sw-1 btn-prev swiper-button-prev-all"></div>
								<div class="btn btn-sw-1 btn-next swiper-button-next-all"></div>
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
						<div class="swiper-column-auto relative swiper-loop autoplay"
							data-swiper="swiper-cat-<?php echo $term->term_id; ?>">
							<div class="swiper swiper-news-cat-<?php echo $term->term_id; ?>">
								<ul class="swiper-wrapper list-news">
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
									<li class="swiper-slide">
										<div class="news-item zoom-img-parent flex flex-col h-full">
											<div class="news-thumb">
												<a class="img-ratio sha ratio:pt-[256_385] rounded-5 img-zoom"
													href="<?php the_permalink(); ?>">
													<img class="lozad"
														data-src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'large'); ?>"
														alt="<?php the_title(); ?>" />
												</a>
												<div class="category">
													<span><?php echo $term->name; ?></span>
												</div>
											</div>
											<div class="content py-5">
												<h3 class="title heading-3 font-bold text-Primary-1 line-clamp-3 mb-3">
													<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
												</h3>
												<div
													class="desc text-Utility-gray-950-maintext font-normal line-clamp-4">
													<p><?php echo wp_trim_words(get_the_excerpt(), 20); ?></p>
												</div>
												<div
													class="date body-4 text-Utility-gray-600-secondarytext font-normal">
													<?php echo get_the_date('d/m/Y'); ?></div>
											</div>
										</div>
									</li>
									<?php 
                                                endwhile;
                                                wp_reset_postdata();
                                            endif;
                                            ?>
								</ul>
							</div>
							<?php
							if($query->found_posts > 5):
							?>
							<div class="arrow-button mt-base flex-center gap-2" data-aos="fade-up" data-aos-delay="600"
								data-aos-duration="1000">
								<div class="btn btn-sw-1 btn-prev swiper-button-prev-cat-<?php echo $term->term_id; ?>">
								</div>
								<div class="btn btn-sw-1 btn-next swiper-button-next-cat-<?php echo $term->term_id; ?>">
								</div>
							</div>
							<?php endif; ?>
						</div>
					</div>
				</div>
				<?php endforeach; ?>
				<?php endif; ?>

			</div>
		</div>
	</section>

	<script>
	document.addEventListener('DOMContentLoaded', function() {
		// Object lưu trữ tất cả Swiper instances
		const swiperInstances = {};

		// Hàm khởi tạo Swiper
		function initSwiper(container, navigation) {
			return new Swiper(container, {
				slidesPerView: 1,
				spaceBetween: 20,
				loop: true,
				autoplay: {
					delay: 3000,
					disableOnInteraction: false,
					pauseOnMouseEnter: true
				},
				speed: 600,
				navigation: {
					nextEl: navigation.nextEl,
					prevEl: navigation.prevEl,
				},
				breakpoints: {
					640: {
						slidesPerView: 2,
						spaceBetween: 20
					},
					768: {
						slidesPerView: 3,
						spaceBetween: 24
					},
					1024: {
						slidesPerView: 4,
						spaceBetween: 24
					},
					1280: {
						slidesPerView: 5,
						spaceBetween: 30
					}
				},
				on: {
					init: function() {
						// Lazy load images khi init
						const images = this.el.querySelectorAll('img.lozad');
						if (window.lozad) {
							const observer = lozad(images);
							observer.observe();
						}
					},
					slideChange: function() {
						// Lazy load images khi slide change
						const activeSlides = this.slides.filter((slide, index) => {
							return index >= this.activeIndex - 1 && index <= this.activeIndex +
								this.params.slidesPerView;
						});
						activeSlides.forEach(slide => {
							const images = slide.querySelectorAll('img.lozad');
							images.forEach(img => {
								if (img.dataset.src && !img.src) {
									img.src = img.dataset.src;
									img.classList.remove('lozad');
								}
							});
						});
					}
				}
			});
		}

		// Khởi tạo Swiper cho tab "Tất cả"
		swiperInstances['all'] = initSwiper('.swiper-news-all', {
			nextEl: '.swiper-button-next-all',
			prevEl: '.swiper-button-prev-all'
		});

		// Khởi tạo Swiper cho các category tabs
		<?php if ($categories): ?>
		<?php foreach ($categories as $term): ?>
		swiperInstances['cat-<?php echo $term->term_id; ?>'] = initSwiper(
			'.swiper-news-cat-<?php echo $term->term_id; ?>', {
				nextEl: '.swiper-button-next-cat-<?php echo $term->term_id; ?>',
				prevEl: '.swiper-button-prev-cat-<?php echo $term->term_id; ?>'
			});
		<?php endforeach; ?>
		<?php endif; ?>

		// Xử lý tab switching
		const tabLinks = document.querySelectorAll('.tabslet-tab a');
		const tabContents = document.querySelectorAll('.tabslet-content');

		tabLinks.forEach(link => {
			link.addEventListener('click', function(e) {
				e.preventDefault();

				// Remove active từ tất cả tabs và contents
				tabLinks.forEach(l => l.parentElement.classList.remove('active'));
				tabContents.forEach(c => c.classList.remove('active'));

				// Add active cho tab được click
				this.parentElement.classList.add('active');

				// Show content tương ứng
				const targetId = this.getAttribute('href');
				const targetContent = document.querySelector(targetId);
				if (targetContent) {
					targetContent.classList.add('active');

					// Update swiper khi chuyển tab
					const tabName = this.getAttribute('data-tab');
					if (swiperInstances[tabName]) {
						setTimeout(() => {
							swiperInstances[tabName].update();
							swiperInstances[tabName].autoplay.start();
						}, 100);
					}
				}
			});
		});

		// Pause autoplay khi tab không active
		const observer = new MutationObserver(function(mutations) {
			mutations.forEach(function(mutation) {
				if (mutation.attributeName === 'class') {
					const target = mutation.target;
					const isActive = target.classList.contains('active');
					const swiperContainer = target.querySelector('[data-swiper]');

					if (swiperContainer) {
						const swiperName = swiperContainer.getAttribute('data-swiper').replace(
							'swiper-', '');
						if (swiperInstances[swiperName]) {
							if (isActive) {
								swiperInstances[swiperName].autoplay.start();
							} else {
								swiperInstances[swiperName].autoplay.stop();
							}
						}
					}
				}
			});
		});

		// Observe tất cả tab contents
		tabContents.forEach(content => {
			observer.observe(content, {
				attributes: true
			});
		});
	});
	</script>
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
						<?php if ($about_bg): ?>setBackground="<?php echo esc_url(get_image_attrachment($about_bg, 'url')); ?>"
						<?php endif; ?>>
						<?php if ($about_title): ?>
						<h2 class="title heading-1 font-bold text-white mb-4" data-aos="fade-up" data-aos-delay="100"
							data-aos-duration="1000"><?php echo $about_title; ?></h2>
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
								<?php if ($about_btn['target']): ?>target="<?php echo esc_attr($about_btn['target']); ?>"
								<?php endif; ?>>
								<span
									data-text="<?php echo esc_attr($about_btn['title']); ?>"><?php echo $about_btn['title']; ?></span>
							</a>
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
                                $class_w = $index === 0 ? 'md:rem:w-[480px] w-full' : 'flex-1';
                            ?>
						<div class="item rounded-5 bg-Utility-gray-50 xl:px-8 xl:py-7 p-5 <?php echo $class_w; ?> xl:rem:h-[320px] h-full"
							data-aos="flip-down" data-aos-duration="1000">
							<div class="wrap-count-top">
								<div
									class="icon sq-20 inline-flex items-center justify-center rem:px-[10px] rem:py-[12px]">
									<img class="img-svg"
										src="<?php echo esc_url(get_image_attrachment($stat['stat_icon'], 'url')); ?>"
										alt="<?php echo esc_attr($stat['stat_title']); ?>">
								</div>
								<div
									class="count-statistical flex heading-banner text-Primary-3 font-bold tabular-nums">
									<span class="countup"
										data-number="<?php echo esc_attr($stat['stat_number']); ?>"></span>
									<span><?php echo $stat['stat_suffix']; ?></span>
								</div>
								<div class="title heading-4 font-semibold text-Utility-gray-950-maintext">
									<?php echo $stat['stat_title']; ?>
								</div>
							</div>
							<div class="home-about-info">
								<div class="desc">
									<p><?php echo $stat['stat_description']; ?></p>
								</div>
							</div>
						</div>
						<?php endforeach; ?>
					</div>
					<?php endif; ?>

					<?php 
                        // Second Row (Items 2 and 3)
                        $second_row = array_slice($about_stats, 2, 2);
                        if ($second_row):
                        ?>
					<div class="wrap flex md:flex-row flex-col gap-5">
						<?php foreach ($second_row as $index => $stat): 
                                $class_w = $index === 0 ? 'md:rem:w-[480px] w-full' : 'flex-1';
                            ?>
						<div class="item rounded-5 bg-Utility-gray-50 xl:px-8 xl:py-7 p-5 <?php echo $class_w; ?> xl:rem:h-[320px] h-full"
							data-aos="flip-down" data-aos-duration="1000">
							<div class="wrap-count-top">
								<div
									class="icon sq-20 inline-flex items-center justify-center rem:px-[10px] rem:py-[12px]">
									<img class="img-svg"
										src="<?php echo esc_url(get_image_attrachment($stat['stat_icon'], 'url')); ?>"
										alt="<?php echo esc_attr($stat['stat_title']); ?>">
								</div>
								<div
									class="count-statistical flex heading-banner text-Primary-3 font-bold tabular-nums">
									<span class="countup"
										data-number="<?php echo esc_attr($stat['stat_number']); ?>"></span>
									<span><?php echo $stat['stat_suffix']; ?></span>
								</div>
								<div class="title heading-4 font-semibold text-Utility-gray-950-maintext">
									<?php echo $stat['stat_title']; ?>
								</div>
							</div>
							<div class="home-about-info">
								<div class="desc">
									<p><?php echo $stat['stat_description']; ?></p>
								</div>
							</div>
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
                                $title = $item['field_title'];
                                $desc = $item['field_description'];
                                $link = $item['link'];
                            ?>
						<li
							class="swiper-slide field-op-item relative xl:flex-1 rem:!h-[480px] overflow-hidden group transition-500">
							<div class="thumb img-full w-full h-full">
								<img class="lozad" data-src="<?php echo esc_url($bg_img['url']); ?>"
									alt="<?php echo esc_attr($title); ?>" />
							</div>
							<div
								class="wrap-content-top absolute top-0 left-0 p-8 w-full flex items-center justify-between gap-4">
								<h3 class="title heading-3 font-bold transition-all-500-linear text-white">
									<?php echo esc_html($title); ?></h3>
								<a class="icon" href="<?php echo $link ? esc_url($link['url']) : '#'; ?>"
									target="<?php echo $link ? esc_attr($link['target']) : ''; ?>"> </a>
							</div>
							<div
								class="info absolute bottom-0 left-0 z-2 w-full p-7 text-white transition-all-500-linear">
								<div class="content body-1 mt-2.25 xl:opacity-0 xl:invisible transition-all-500-linear">
									<p><?php echo wp_kses_post( $desc ); ?></p>
								</div>
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
						<?php foreach ($partner_logos as $index => $logo_item): ?>
						<div class="swiper-slide">
							<div class="item-logo" data-aos="flip-up" data-aos-duration="1000"
								data-aos-delay="<?php echo $index * 100; ?>">
								<div class="img img-ratio"><img class="lozad"
										data-src="<?php echo esc_url($logo_item['partner_logo']['url']); ?>"
										alt="<?php echo esc_attr($logo_item['partner_logo']['alt']); ?>" />
								</div>
							</div>
						</div>
						<?php endforeach; ?>
					</div>
				</div>
			</div>
			<div class="slide-bottom">
				<div class="swiper">
					<div class="swiper-wrapper">
						<?php foreach ($partner_logos as $index => $logo_item): ?>
						<div class="swiper-slide">
							<div class="item-logo" data-aos="flip-up" data-aos-duration="1000"
								data-aos-delay="<?php echo $index * 100; ?>">
								<div class="img img-ratio"><img class="lozad"
										data-src="<?php echo esc_url($logo_item['partner_logo']['url']); ?>"
										alt="<?php echo esc_attr($logo_item['partner_logo']['alt']); ?>" />
								</div>
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

	<?php if (get_field('home_connect_enable')): ?>
	<?php
        $connect_bg = get_field('home_connect_background');
        $connect_title = get_field('home_connect_title');
        $connect_desc = get_field('home_connect_description');
        $connect_btn = get_field('home_connect_button');
        $connect_map = get_field('home_connect_map');
    ?>
	<section class="home-6">
		<div class="wrapper grid md:grid-cols-2 grid-cols-1">
			<div class="col-left xl:rem:pr-[210px] px-5 xl:pl-25 xl:rem:min-h-[560px] h-full flex flex-col justify-center py-10"
				<?php echo $connect_bg ? 'setBackground="' . esc_url($connect_bg['url']) . '"' : ''; ?>>
				<div class="wrap-content text-white mb-base">
					<?php if ($connect_title): ?>
					<h2 class="title heading-1 font-bold mb-4" data-aos="fade-right" data-aos-delay="200"
						data-aos-duration="1000"><?php echo esc_html($connect_title); ?></h2>
					<?php endif; ?>
					<?php if ($connect_desc): ?>
					<div class="sub-title body-1 font-normal" data-aos="fade-right" data-aos-delay="400"
						data-aos-duration="1000">
						<?php echo wp_kses_post($connect_desc); ?>
					</div>
					<?php endif; ?>
				</div>
				<?php if ($connect_btn): ?>
				<div class="button" data-aos="fade-right" data-aos-delay="600" data-aos-duration="1000"><a
						class="btn btn-secondary" href="<?php echo esc_url($connect_btn['url']); ?>"
						target="<?php echo esc_attr($connect_btn['target']); ?>"> <span
							data-text="<?php echo esc_attr($connect_btn['title']); ?>"><?php echo esc_html($connect_btn['title']); ?></span></a>
				</div>
				<?php endif; ?>
			</div>
			<div class="col-right" data-aos="zoom-in" data-aos-delay="200" data-aos-duration="1000">
				<?php if ($connect_map): ?>
				<?php echo $connect_map; ?>
				<?php endif; ?>
			</div>
		</div>
	</section>
	<?php endif; ?>

</main>

<?php get_footer(); ?>