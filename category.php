<?php get_header(); ?>

<?php 
$term = get_queried_object(); 
$banner = get_field('banner', $term);
?>

<section class="section-banner-secondary pt-[var(--header-height)]"> 
    <div class="block-banner img-ratio ratio:pt-[1_2] md:ratio:pt-[600_1920]"> 
        <img class="lozad undefined" data-src="<?php echo $banner['url'] ? $banner['url'] : get_stylesheet_directory_uri() . '/img/banner-secondary-1.svg'; ?>" alt="<?php echo $banner['alt'] ? $banner['alt'] : ''; ?>"/>
    </div>
</section>

<?php echo get_template_part('modules/common/breadcrumb'); ?>

<section class="section-news section-py">
    <div class="container-1600">
        <div class="news flex flex-col gap-base">
            <div class="news-heading-and-tab flex-between flex-wrap gap-4">
                <h1 class="heading-1"><?php echo $term->name; ?></h1>
                <div class="swiper-column-auto block-news-tab">
                    <div class="swiper">
                        <?php
                        // Add filter to add classes to menu links
                        add_filter('nav_menu_link_attributes', function($atts, $item, $args) {
                            if(isset($args->theme_location) && $args->theme_location == 'menu-category') {
                                $atts['class'] = 'btn-secondary btn';
                                
                                // Add active class if this is the current category
                                $term = get_queried_object();
                                if ($term && isset($term->term_id) && $item->object_id == $term->term_id) {
                                    $atts['class'] .= ' active';
                                }
                            }
                            return $atts;
                        }, 10, 3);
                        
                        // Add filter to add classes to menu items
                        add_filter('nav_menu_css_class', function($classes, $item, $args) {
                            if(isset($args->theme_location) && $args->theme_location == 'menu-category') {
                                $classes[] = 'swiper-slide';
                                $classes[] = 'news-tab-item';
                                $classes[] = '!mr-6';
                                $classes[] = 'last:!mr-0';
                                $classes[] = '!w-auto';
                            }
                            return $classes;
                        }, 10, 3);
                        
                        wp_nav_menu(array(
                            'theme_location' => 'menu-category',
                            'container' => false,
                            'menu_class' => 'swiper-wrapper news-tab-list',
                            'menu_id' => '',
                            'echo' => true,
                            'fallback_cb' => 'wp_page_menu',
                        ));
                        ?>
                    </div>
                </div>

            </div>
            <?php if(have_posts()) : ?>
                <?php 
                $post_count = 0;
                while(have_posts()) : the_post(); 
                    $post_count++;
                    if($post_count == 1) : // Only display the first post
                    ?>
                    <div class="tab-news-item flex -lg:flex-col items-stretch">
                        <div class="img-thumb <?php echo !get_the_post_thumbnail_url() ? 'thumb-logo' : ''; ?> w-full lg:shrink-0 lg:w-[calc(1184/1600*100%)]">
                            <a class="img-ratio ratio:pt-[652_1184]" href="<?php the_permalink(); ?>">
                                <?php 
                                $thumbnail_url = get_the_post_thumbnail_url();
                                if (!$thumbnail_url) {
                                    $custom_logo_id = get_theme_mod('custom_logo');
                                    $logo_url = wp_get_attachment_image_url($custom_logo_id, 'full');
                                    $thumbnail_url = $logo_url ? $logo_url : get_stylesheet_directory_uri() . '/img/news-cc-1.svg';
                                }
                                ?>
                                <img class="lozad undefined" data-src="<?php echo $thumbnail_url; ?>" alt="<?php the_title(); ?>"/>
                            </a>
                        </div>
                        <div class="block-info flex flex-col justify-center p-10 bg-primary-2">
                            <span class="date text-body-3 text-white"><?php echo get_the_date('d/m/Y'); ?></span>
                            <h3 class="title heading-2 mt-2 text-white -xl:line-clamp-3 line-clamp-4"><?php the_title(); ?></h3>
                            <p class="desc text-body-2 mt-6 text-white -xl:line-clamp-4 line-clamp-7"><?php echo wp_trim_words(get_the_content(), 50, '...'); ?></p>
                            <a class="inline-block text-body-2 text-primary-1 mt-10" href="<?php the_permalink(); ?>"><?php _e('Xem thêm', 'canhcamtheme'); ?></a>
                        </div>
                    </div>
                    <?php endif;
                endwhile; 
                ?>
                <ul class="list-news grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-base">
                    <?php 
                    rewind_posts(); // Reset the post query to start from the beginning
                    $post_counter = 0;
                    while(have_posts()) : the_post(); 
                        $post_counter++;
                        if($post_counter > 1) : // Skip the first post since it's already displayed above
                        ?>
                        <li class="news-itemcc zoom-img-parent">
                            <div class="img-thumb <?php echo !get_the_post_thumbnail_url() ? 'thumb-logo' : ''; ?>"><a class="img-ratio ratio:pt-[269_370] img-zoom" href="<?php the_permalink(); ?>"> 
                                <?php 
                                $thumbnail_url = get_the_post_thumbnail_url();
                                if (!$thumbnail_url) {
                                    $custom_logo_id = get_theme_mod('custom_logo');
                                    $logo_url = wp_get_attachment_image_url($custom_logo_id, 'full');
                                    $thumbnail_url = $logo_url ? $logo_url : get_stylesheet_directory_uri() . '/img/news-cc-1.svg';
                                }
                                ?>
                                <img class="lozad" data-src="<?php echo $thumbnail_url; ?>" alt="<?php the_title(); ?>"/></a>
                            </div>
                            <div class="block-info p-2.5 md:p-6">
                                <h3 class="title heading-4 line-clamp-2"> <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3><a class="seemore-btn inline-flex items-center gap-x-3 mt-5 transition-300 hover:text-primary-2 text-utility-gray-500" href="<?php the_permalink(); ?>"><span class="text-body-2"><?php _e('Xem thêm', 'canhcamtheme'); ?></span>
                                    <div class="block-icon leading-[0] text-lg"><i class="fa-light fa-arrow-right "></i> </div></a>
                            </div>
                        </li>
                        <?php endif;
                    endwhile; 
                    ?>
                    
                </ul>
                <?php 
                global $wp_query;
                $total_pages = $wp_query->max_num_pages;
                $current_page = max(1, get_query_var('paged'));
                
                if ($total_pages > 1) : ?>
                <ul class="pagination justify-center">
                    <?php
                    if ($total_pages <= 5) {
                        for ($i = 1; $i <= $total_pages; $i++) {
                            $active_class = ($i == $current_page) ? 'active' : '';
                            echo '<li class="pagination-item flex-center w-10 md:w-12 h-10 md:h-12 border-2 border-primary-2 rounded-1 heading-4 transition-300 hover:bg-primary-1 hover:border-primary-1 cursor-pointer ' . $active_class . '"><a href="' . esc_url(get_pagenum_link($i)) . '">' . $i . '</a></li>';
                        }
                    } else {
                        // Always show first page
                        $active_class = (1 == $current_page) ? 'active' : '';
                        echo '<li class="pagination-item flex-center w-10 md:w-12 h-10 md:h-12 border-2 border-primary-2 rounded-1 heading-4 transition-300 hover:bg-primary-1 hover:border-primary-1 cursor-pointer ' . $active_class . '"><a href="' . get_pagenum_link(1) . '">1</a></li>';
                        
                        // Calculate range
                        $start_page = max(2, $current_page - 1);
                        $end_page = min($total_pages - 1, $current_page + 1);
                        
                        // Show dots if needed
                        if ($start_page > 2) {
                            echo '<li class="pagination-item flex-center w-10 md:w-12 h-10 md:h-12 border-2 border-primary-2 rounded-1 heading-4 transition-300">...</li>';
                        }
                        
                        // Show middle pages
                        for ($i = $start_page; $i <= $end_page; $i++) {
                            $active_class = ($i == $current_page) ? 'active' : '';
                            echo '<li class="pagination-item flex-center w-10 md:w-12 h-10 md:h-12 border-2 border-primary-2 rounded-1 heading-4 transition-300 hover:bg-primary-1 hover:border-primary-1 cursor-pointer ' . $active_class . '"><a href="' . esc_url(get_pagenum_link($i)) . '">' . $i . '</a></li>';
                        }
                        
                        // Show dots if needed
                        if ($end_page < $total_pages - 1) {
                            echo '<li class="pagination-item flex-center w-10 md:w-12 h-10 md:h-12 border-2 border-primary-2 rounded-1 heading-4 transition-300">...</li>';
                        }
                        
                        // Always show last page
                        $active_class = ($total_pages == $current_page) ? 'active' : '';
                        echo '<li class="pagination-item flex-center w-10 md:w-12 h-10 md:h-12 border-2 border-primary-2 rounded-1 heading-4 transition-300 hover:bg-primary-1 hover:border-primary-1 cursor-pointer ' . $active_class . '"><a href="' . get_pagenum_link($total_pages) . '">' . $total_pages . '</a></li>';
                    }
                    ?>
                </ul>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php get_footer(); ?>