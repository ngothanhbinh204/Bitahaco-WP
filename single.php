<?php get_header(); ?>

<?php
	$banner = get_field('banner');
	$banner_url = isset($banner['url']) ? $banner['url'] : '';
	$banner_title = isset($banner['title']) ? $banner['title'] : '';
	$top_category_name = get_top_level_term_name(get_the_ID(), 'category');
?>
<section class="section-banner-secondary">
	<div class="block-banner img-ratio ratio:pt-[1_2] md:ratio:pt-[640_1920]">
		<?php if($banner): ?>
		<img class="lozad" data-src="<?php echo esc_url($banner_url); ?>"
			alt="<?php echo esc_attr($banner_title); ?>" />
		<?php endif; ?>
		<div class="content">
			<div class="container-fluid">
				<h2 class="title">
					<?php echo $top_category_name ?>
				</h2>
				<div class="global-breadcrumb">
					<?php if(function_exists('rank_math_the_breadcrumbs')) rank_math_the_breadcrumbs(); ?>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="section-detail-news section-py">
	<div class="container-fluid">
		<div class="detail-news grid grid-cols-12 gap-base">
			<div class="detail-news-main col-span-full lg:col-span-8">
				<div class="block-detail flex flex-col gap-y-8">
					<div class="detail-header">
						<h1 class="title heading-3 text-black"><?php the_title(); ?></h1>
						<div class="block-date-notice flex items-center gap-x-2 mt-4.75">
							<span class="date body-1 text-Utility-gray-500"><?php the_time('d/m/Y'); ?></span>
							<span class="body-1 text-Utility-gray-500">|</span>
							<span class="notice body-1 text-Primary-2">
								<?php 
                                $categories = get_the_category();
                                if (!empty($categories)) {
                                    echo esc_html($categories[0]->name);
                                }
                                ?>
							</span>
						</div>
					</div>

					<div class="detail-content-main">
						<div class="format-content">
							<?php if (has_post_thumbnail()) : ?>
							<img class="lozad w-full rounded-5 mb-8" data-src="<?php the_post_thumbnail_url('full'); ?>"
								alt="<?php the_title_attribute(); ?>" />
							<?php endif; ?>
							<?php the_content(); ?>
						</div>
					</div>

					<div class="block-social flex items-center gap-x-4">
						<span class="title body-1"><?php _e('Chia sẻ', 'canhcamtheme'); ?>:</span>
						<ul class="social-list flex gap-x-3">
							<li class="social-item">
								<a class="flex-center w-10 h-10 rounded-full bg-[rgba(10,59,97,1)] text-base text-white"
									href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(get_permalink()); ?>"
									target="_blank" rel="noopener noreferrer">
									<i class="fa-brands fa-facebook-f"></i>
								</a>
							</li>
							<!-- Có thể thêm các mạng xã hội khác ở đây nếu cần -->
						</ul>
					</div>
				</div>
			</div>

			<div class="detail-related-news col-span-full lg:col-span-4">
				<h2
					class="related-news-title relative pb-3 heading-3 after:content-[''] after:block after:absolute after:bottom-0 after:left-0 after:w-[15%] after:border-b-2 after:border-Primary-2">
					<?php _e('Tin tức liên quan', 'canhcamtheme'); ?>
				</h2>
				<ul class="related-news-list flex flex-col gap-y-6 mt-6">
					<?php
                    $current_post_id = get_the_ID();
                    $categories = get_the_category($current_post_id);
                    $category_ids = wp_list_pluck($categories, 'term_id');

                    $args = array(
                        'post_type'      => 'post',
                        'posts_per_page' => 4,
                        'post__not_in'   => array($current_post_id),
                        'category__in'   => $category_ids,
                        'orderby'        => 'date',
                        'order'          => 'DESC'
                    );

                    $related_posts = new WP_Query($args);

                    if ($related_posts->have_posts()) :
                        while ($related_posts->have_posts()) : $related_posts->the_post();
                    ?>
					<li class="related-news-item group flex items-center">
						<div class="img-thumb w-[calc(185/506*100%)] shrink-0">
							<a class="img-ratio ratio:pt-[134_185]" href="<?php the_permalink(); ?>">
								<?php 
                                $thumbnail_url = get_the_post_thumbnail_url(get_the_ID(), 'medium');
                                if (!$thumbnail_url) {
                                    $custom_logo_id = get_theme_mod('custom_logo');
                                    $logo_url = wp_get_attachment_image_url($custom_logo_id, 'full');
                                    $thumbnail_url = $logo_url ?: get_stylesheet_directory_uri() . '/img/news-cc-1.svg';
                                }
                                ?>
								<img class="lozad transition-300 group-hover:scale-105 will-change-transform"
									data-src="<?php echo esc_url($thumbnail_url); ?>"
									alt="<?php the_title_attribute(); ?>" />
							</a>
						</div>
						<div class="block-info pl-5 grow">
							<span class="date body-1 text-Utility-gray-500"><?php the_time('d/m/Y'); ?></span>
							<h3
								class="title heading-4 mt-2.5 text-black line-clamp-3 transition-300 group-hover:text-Primary-2">
								<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
							</h3>
						</div>
					</li>
					<?php
                        endwhile;
                        wp_reset_postdata();
                    else :
                    ?>
					<li class="related-news-item">
						<p class="body-1 text-Utility-gray-500">
							<?php _e('Không có bài viết liên quan.', 'canhcamtheme'); ?></p>
					</li>
					<?php endif; ?>
				</ul>
			</div>
		</div>
	</div>
</section>

<?php get_footer(); ?>