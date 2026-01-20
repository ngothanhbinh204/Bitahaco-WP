<?php get_header(); ?>

<?php
$custom_logo_id = get_theme_mod('custom_logo');
$logo_url = wp_get_attachment_image_url($custom_logo_id, 'full');
?>

<div class="space-header pt-[var(--header-height)]"></div>

<div class="single-frame">
	<section class="search-page section" setbackground="/wp-content/themes/forestBay/img/TinTuc/news-bg.jpg">
		<div class="container max-w-screen-2xl">

			<h1 class="block-title text-center mb-30px">
				<?php _e('Tìm kiếm', 'canhcamtheme'); ?>
			</h1>

			<div class="search-query mb-6">
				<?php
                global $wp_query;
                printf(
                    __('Kết quả tìm kiếm từ khóa (%d kết quả): "<span>%s</span>"', 'canhcamtheme'),
                    (int) $wp_query->found_posts,
                    esc_html(get_search_query())
                );
                ?>
			</div>

			<?php if (have_posts()) : ?>
			<ul class="list-news grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-base mt-2">
				<?php while (have_posts()) : the_post(); ?>
				<li class="news-itemcc zoom-img-parent">
					<div class="img-thumb">
						<a class="img-ratio ratio:pt-[269_370] img-zoom" href="<?php the_permalink(); ?>">
							<img class="lozad" data-src="<?php
                                            if (has_post_thumbnail()) {
                                                echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'medium'));
                                            } elseif ($logo_url) {
                                                echo esc_url($logo_url);
                                            } else {
                                                echo esc_url(get_stylesheet_directory_uri() . '/img/news-cc-1.svg');
                                            }
                                        ?>" alt="<?php the_title_attribute(); ?>" />
						</a>
					</div>

					<div class="block-info p-2.5 md:p-6">
						<h3 class="title heading-4 line-clamp-2 transition-300 group-hover:text-primary-2">
							<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
						</h3>

						<a class="seemore-btn inline-flex items-center gap-x-3 mt-5 transition-300 hover:text-primary-2 text-utility-gray-500"
							href="<?php the_permalink(); ?>">
							<span class="text-body-2"><?php _e('Xem thêm', 'canhcamtheme'); ?></span>
							<i class="fa-light fa-arrow-right text-lg"></i>
						</a>
					</div>
				</li>
				<?php endwhile; ?>
			</ul>

			<?php
                // Pagination (nếu có)
                if (function_exists('micco_pagination')) {
                    micco_pagination();
                }
                ?>

			<?php else : ?>
			<p>
				<?php _e('Không có kết quả nào phù hợp với từ khóa:', 'canhcamtheme'); ?>
				"<strong><?php echo esc_html(get_search_query()); ?></strong>"
			</p>
			<?php endif; ?>

		</div>
	</section>
</div>

<?php get_footer(); ?>