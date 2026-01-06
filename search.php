<?php get_header() ?>

<?php
	$custom_logo_id = get_theme_mod('custom_logo');
	$logo_url = wp_get_attachment_image_url($custom_logo_id, 'full');	
?>

<div class="space-header pt-[var(--header-height)]"></div>

<div class="single-frame">
	<section class="search-page section" setbackground="/wp-content/themes/forestBay/img/TinTuc/news-bg.jpg">
		<div class="container max-w-screen-2xl">
			<h1 class="block-title text-center mb-30px"><?php _e('Tìm kiếm', 'canhcamtheme'); ?></h1>
			<div class="search-query">
				<?php 
				global $wp_query;
				$total_results = $wp_query->found_posts;
				printf(
					__('Kết quả tìm kiếm từ khóa:', 'canhcamtheme') . ' " <span>%s</span> " (%d kết quả)', 
					get_search_query(),
					$total_results
				);
				?>
			</div>
			<?php if (have_posts()) : ?>
				<ul class="list-news grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-base mt-2">
					<?php while (have_posts()) : the_post() ?>
						<li class="news-itemcc zoom-img-parent">
							<div class="img-thumb"><a class="img-ratio ratio:pt-[269_370] img-zoom" href="<?php the_permalink(); ?>"> <img class="lozad" data-src="<?php 
								if (get_the_post_thumbnail_url()) {
									echo get_the_post_thumbnail_url();
								} elseif ($logo_url) {
									echo $logo_url;
								} else {
									echo get_stylesheet_directory_uri() . '/img/news-cc-1.svg';
								}
							?>" alt="<?php the_title(); ?>"/></a></div>
							<div class="block-info p-2.5 md:p-6">
								<h3 class="title heading-4 line-clamp-2 transition-300 group-hover:text-primary-2"> <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3><a class="seemore-btn inline-flex items-center gap-x-3 mt-5 transition-300 hover:text-primary-2 text-utility-gray-500" href="<?php the_permalink(); ?>"><span class="text-body-2"><?php _e('Xem thêm', 'canhcamtheme'); ?></span>
									<div class="block-icon leading-[0] text-lg"><i class="fa-light fa-arrow-right "></i> </div></a>
							</div>
						</li>
					<?php endwhile; ?>
				</ul>
			<?php else : ?>
				<p><?php _e('Không có bài viết nào tương ứng với từ khoá:', 'canhcamtheme'); ?> "<?php echo get_search_query() ?> "</p>
			<?php endif; ?>
			
		</div>
	</section>
</div>
<?php get_footer() ?>