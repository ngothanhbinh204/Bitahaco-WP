<?php get_header(); ?>

<?php $banner = get_field('project_banner', 'option'); ?>
<section class="section-banner-secondary pt-[var(--header-height)]"> 
    <div class="block-banner img-ratio ratio:pt-[1_2] md:ratio:pt-[600_1920]"> 
        <img class="lozad undefined" data-src="<?php echo $banner['url'] ? $banner['url'] : get_stylesheet_directory_uri() . '/img/banner-secondary-1.svg'; ?>" alt="<?php echo $banner['alt'] ? $banner['alt'] : ''; ?>"/>
    </div>
</section>

<?php echo get_template_part('modules/common/breadcrumb'); ?>

<section class="section-project section-py">
    <div class="container-1600"> 
        <div class="project">
            <h1 class="project-title heading-1 text-center"><?php _e('Dự án', 'meyhomes'); ?></h1>
            <ul class="project-list grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-base-24 gap-y-7 mt-base">
                <?php if(have_posts()) :
                    while(have_posts()) : the_post();
                        $thumbnail = get_the_post_thumbnail_url(get_the_ID(), 'full');
                        $information = get_field('information');
                        $location = $information['address'];
                        $description = get_field('description');
                    ?>
                        <li class="projects-out-item">
                            <div class="projects-out-thumb relative rounded-lg overflow-hidden before:content-[''] before:block before:absolute before:bottom-0 before:z-1 before:w-full before:h-[10%] before:-lg:h-[50%] before:bg-[linear-gradient(to_bottom,rgba(0,0,0,0),rgba(0,0,0,0.5))] before:transition-300">
                                <a class="img-ratio ratio:pt-[556_517.33]" href="<?php the_permalink(); ?>">
                                    <img class="lozad undefined" data-src="<?php echo $thumbnail ? $thumbnail : get_stylesheet_directory_uri() . '/img/projects-out-1.svg'; ?>" alt="<?php the_title(); ?>"/>
                                </a>
                                <div class="info-thumb absolute bottom-0 left-0 z-2 p-6 text-white lg:opacity-0 lg:invisible transition-300">
                                    <p class="text-body-2 line-clamp-3"><?php echo $description ? $description : get_the_excerpt(); ?></p>
                                </div>
                            </div>
                            <div class="projects-out-info mt-6">
                                <h3 class="info-name heading-4 line-clamp-2 transition-300">
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </h3>
                                <div class="info-location items-baseline mt-2 flex gap-x-2">
                                    <i class="fa-solid fa-location-dot text-base text-utility-gray-500"></i>
                                    <div class="text-body-2 text-utility-gray-500"><?php echo $location ? $location : ''; ?></div>
                                </div>
                            </div>
                        </li>
                    <?php endwhile; ?>
                <?php endif; ?>
            </ul>
            
            <?php 
            global $wp_query;
            $total_pages = $wp_query->max_num_pages;
            $current_page = max(1, get_query_var('paged'));
            
            if ($total_pages > 1) : ?>
            <ul class="pagination mt-base justify-center">
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
        </div>
    </div>
</section>

<?php get_footer(); ?>