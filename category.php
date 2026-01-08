<?php get_header(); ?>

<?php 
$term = get_queried_object(); 
?>

<?php echo get_template_part('modules/common/banner'); ?>

<section class="section-news section-py">
	<div class="container-fluid">
		<div class="news flex flex-col gap-base">
			<div class="news-heading-and-tab flex-between flex-wrap gap-4">
				<h1 class="heading-1 text-Primary-1"><?php echo esc_html($term->name); ?></h1>
				<ul class="nav-news">
					<?php
                    add_filter('nav_menu_link_attributes', function($atts, $item, $args) {
                        if (isset($args->theme_location) && $args->theme_location == 'menu-category') {
                            $atts['class'] = 'body-1'; 
                            $term = get_queried_object();
                            if ($term && isset($term->term_id) && $item->object_id == $term->term_id) {
                                $atts['class'] .= ' active';
                            }
                        }
                        return $atts;
                    }, 10, 3);

                    add_filter('nav_menu_css_class', function($classes, $item, $args) {
                        if (isset($args->theme_location) && $args->theme_location == 'menu-category') {
                            $classes[] = 'nav-news-item';
                        }
                        return $classes;
                    }, 10, 3);

                    wp_nav_menu(array(
                        'theme_location'  => 'menu-category',
                        'container'       => false,
                        'menu_class'      => false,
                        'items_wrap'      => '%3$s', // chỉ xuất <li> và <a>, không wrap ul
                        'fallback_cb'     => false,
                        'depth'           => 1,
                        'walker'          => new class extends Walker_Nav_Menu {
                            public function start_el(&$output, $item, $depth = 0, $args = null, $id = 0) {
                                $classes = empty($item->classes) ? array() : (array) $item->classes;
                                $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args));
                                $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';

                                $attributes = '';
                                if (!empty($item->attr_title)) {
                                    $attributes .= ' title="' . esc_attr($item->attr_title) . '"';
                                }
                                if (!empty($item->target)) {
                                    $attributes .= ' target="' . esc_attr($item->target) . '"';
                                }
                                if (!empty($item->xfn)) {
                                    $attributes .= ' rel="' . esc_attr($item->xfn) . '"';
                                }
                                if (!empty($item->url)) {
                                    $attributes .= ' href="' . esc_attr($item->url) . '"';
                                }

                                $item_output = '<li>';
                                $item_output .= '<a' . $attributes . '>';
                                $item_output .= apply_filters('the_title', $item->title, $item->ID);
                                $item_output .= '</a>';
                                $item_output .= '</li>';

                                $output .= $item_output;
                            }
                        },
                    ));
                    ?>
				</ul>
			</div>

			<?php if (have_posts()) : ?>
			<?php 
                $post_count = 0;
                while (have_posts()) : the_post(); 
                    $post_count++;
                    if ($post_count == 1) : // Bài viết đầu tiên - nổi bật
                ?>
			<div class="tab-news-item flex -lg:flex-col items-stretch rounded-5 overflow-hidden">
				<div class="img-thumb w-full lg:shrink-0 lg:w-[calc(1184/1600*100%)]">
					<a class="img-ratio ratio:pt-[652_1184]" href="<?php the_permalink(); ?>">
						<?php 
                            $thumbnail_url = get_the_post_thumbnail_url(get_the_ID(), 'full');
                            if (!$thumbnail_url) {
                                $custom_logo_id = get_theme_mod('custom_logo');
                                $logo_url = wp_get_attachment_image_url($custom_logo_id, 'full');
                                $thumbnail_url = $logo_url ?: get_stylesheet_directory_uri() . '/img/news-cc-1.svg';
                            }
                            ?>
						<img class="lozad" data-src="<?php echo esc_url($thumbnail_url); ?>"
							alt="<?php the_title_attribute(); ?>" />
					</a>
				</div>
				<div class="block-info flex flex-col justify-center p-10 bg-Primary-1">
					<span class="date body-4 text-white"><?php echo get_the_date('d/m/Y'); ?></span>
					<h3 class="title heading-3 mt-2 text-white -xl:line-clamp-3 line-clamp-4">
						<a href="<?php the_permalink(); ?>"
							class="text-white hover:opacity-80"><?php the_title(); ?></a>
					</h3>
					<p class="desc body-1 mt-6 text-white -xl:line-clamp-4 line-clamp-7">
						<?php echo wp_trim_words(get_the_excerpt() ?: get_the_content(), 80, '...'); ?>
					</p>
					<a class="inline-block body-1 text-Primary-1 mt-10" href="<?php the_permalink(); ?>">
						Thông báo tuyển sinh
					</a>
				</div>
			</div>
			<?php 
                    endif;
                endwhile; 
                ?>

			<ul class="list-news grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-base">
				<?php 
                    rewind_posts();
                    $post_counter = 0;
                    while (have_posts()) : the_post(); 
                        $post_counter++;
                        if ($post_counter > 1) : // Các bài từ bài thứ 2 trở đi
                    ?>
				<li class="news-itemcc zoom-img-parent">
					<div class="img-thumb">
						<a class="img-ratio ratio:pt-[269_370] img-zoom rounded-5" href="<?php the_permalink(); ?>">
							<?php 
                                $thumbnail_url = get_the_post_thumbnail_url(get_the_ID(), 'full');
                                if (!$thumbnail_url) {
                                    $custom_logo_id = get_theme_mod('custom_logo');
                                    $logo_url = wp_get_attachment_image_url($custom_logo_id, 'full');
                                    $thumbnail_url = $logo_url ?: get_stylesheet_directory_uri() . '/img/news-cc-1.svg';
                                }
                                ?>
							<img class="lozad" data-src="<?php echo esc_url($thumbnail_url); ?>"
								alt="<?php the_title_attribute(); ?>" />
						</a>
					</div>
					<div class="block-info p-2.5 md:p-6">
						<h3 class="title heading-4 line-clamp-2">
							<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
						</h3>
						<a class="seemore-btn inline-flex items-center gap-x-3 mt-5 transition-300 hover:text-Primary-2 text-Utility-gray-500"
							href="<?php the_permalink(); ?>">
							<span class="body-1">Xem thêm</span>
							<div class="block-icon leading-[0] text-lg">
								<i class="fa-light fa-arrow-right"></i>
							</div>
						</a>
					</div>
				</li>
				<?php 
                        endif;
                    endwhile; 
                    ?>
			</ul>

			<?php 
                global $wp_query;
                $total_pages = $wp_query->max_num_pages;
                $current_page = max(1, get_query_var('paged'));

                if ($total_pages > 1) : 
                ?>
			<ul class="pagination justify-center">
				<?php 
                // Previous
                if ($current_page > 1):
                    $prev_page = max(1, $current_page - 1);
                ?>
				<li
					class="pagination-item flex-center w-10 md:w-12 h-10 md:h-12 border-2 border-Primary-2 rounded-1 heading-4 transition-300 hover:bg-Primary-1 hover:border-Primary-1 cursor-pointer">
					<a href="<?php echo esc_url(get_pagenum_link($prev_page)); ?>" class="flex-center w-full h-full"><i
							class="fa-regular fa-chevron-left"></i></a>
				</li>
				<?php endif; ?>

				<?php for ($i = 1; $i <= $total_pages; $i++) : 
                    $active = ($i == $current_page) ? 'active' : '';
                ?>
				<li
					class="pagination-item flex-center w-10 md:w-12 h-10 md:h-12 border-2 border-Primary-2 rounded-1 heading-4 transition-300 hover:bg-Primary-1 hover:border-Primary-1 cursor-pointer <?php echo $active; ?>">
					<a href="<?php echo esc_url(get_pagenum_link($i)); ?>"
						class="flex-center w-full h-full"><?php echo $i; ?></a>
				</li>
				<?php endfor; ?>

				<?php 
                 // Next
                 if ($current_page < $total_pages):
                    $next_page = min($total_pages, $current_page + 1);
                ?>
				<li
					class="pagination-item flex-center w-10 md:w-12 h-10 md:h-12 border-2 border-Primary-2 rounded-1 heading-4 transition-300 hover:bg-Primary-1 hover:border-Primary-1 cursor-pointer">
					<a href="<?php echo esc_url(get_pagenum_link($next_page)); ?>" class="flex-center w-full h-full"><i
							class="fa-regular fa-chevron-right"></i></a>
				</li>
				<?php endif; ?>
			</ul>
			<?php endif; ?>

			<?php endif; ?>
		</div>
	</div>
</section>

<?php get_footer(); ?>