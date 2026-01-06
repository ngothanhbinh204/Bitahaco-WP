<?php get_header(); ?>

<?php $banner = get_field('shareholder_banner', 'option'); ?>
<section class="section-banner-secondary pt-[var(--header-height)]"> 
    <div class="block-banner img-ratio ratio:pt-[1_2] md:ratio:pt-[600_1920]"> <img class="lozad undefined" data-src="<?php echo $banner['url'] ? $banner['url'] : get_stylesheet_directory_uri() . '/img/banner-secondary-1.svg'; ?>" alt="<?php echo $banner['alt'] ? $banner['alt'] : ''; ?>"/>
    </div>
</section>

<?php echo get_template_part('modules/common/breadcrumb'); ?>

<section class="section-shareholder-rel">
    <div class="shareholder-rel"> 
        <ul class="shareholder-rel-list">
            <?php
            // Get all co-dong-category terms
            $categories = get_terms(array(
                'taxonomy' => 'co-dong-category',
                'hide_empty' => true,
                'orderby' => 'name',
                'order' => 'ASC'
            ));
            
            if (!empty($categories) && !is_wp_error($categories)) :
                foreach ($categories as $category) :
                    // Get posts in this category
                    $args = array(
                        'post_type' => 'co-dong',
                        'posts_per_page' => 3, // Get 3 latest posts
                        'order' => 'DESC',
                        'orderby' => 'date',
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'co-dong-category',
                                'field' => 'term_id',
                                'terms' => $category->term_id,
                            ),
                        ),
                    );
                    
                    $query = new WP_Query($args);
                    
                    if ($query->have_posts()) :
                        // Get the first post for display
                        $query->the_post();
                        $category_thumbnail = get_field('thumbnail', $category);
                        $title = $category->name; // Use category name as title
                        $permalink = get_term_link($category); // Link to category archive
                        ?>
                        <li class="shareholder-rel-item">
                            <div class="container-1600"> 
                                <div class="child grid grid-cols-1 lg:grid-cols-2 gap-x-16 py-15"> 
                                    <div class="img-thumb img-ratio ratio:pt-[2_3] md:ratio:pt-[612_768] rounded-lg">
                                        <img class="lozad undefined" data-src="<?php echo $category_thumbnail['url']; ?>" alt="<?php echo $category_thumbnail['alt']; ?>"/>
                                    </div>
                                    <div class="block-info flex flex-col gap-base items-start h-full -lg:pt-4">
                                        <h2 class="shareholder-rel-title heading-1"><?php echo $title; ?></h2>
                                        <div class="overflow-scroll-1 w-full lg:flex-[1_1_0] lg:overflow-auto lg:pr-3">
                                            <ul class="document-list flex flex-col">
                                                <?php
                                                // Reset and start over to show all 3 posts
                                                $query->rewind_posts();
                                                
                                                while ($query->have_posts() && $query->current_post < 3) : $query->the_post();
                                                    $post_date = get_the_date('d/m/Y');
                                                    $post_title = get_the_title();
                                                    $post_url = get_permalink();
                                                ?>
                                                <li class="document-item flex gap-x-5 py-5 border-b border-utility-gray-100 first:border-t first:border-utility-gray-100 undefined">
                                                    <div class="block-icon w-10 h-10 shrink-0">
                                                        <svg viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <g clip-path="url(#clip0_20147_18)">
                                                                <path d="M29.7559 8.5775L21.4225 0.244141C21.2663 0.0878906 21.0547 0 20.8333 0H3.33328C1.49492 0 0 1.49492 0 3.33336V36.6667C0 38.5051 1.49492 40 3.33336 40H26.6667C28.5051 40 30 38.5051 30 36.6666V9.16664C30 8.94531 29.9121 8.73375 29.7559 8.5775ZM21.6666 2.84508L27.1549 8.33336H23.3333C22.4145 8.33336 21.6666 7.58547 21.6666 6.66672V2.84508ZM28.3334 36.6666C28.3334 37.5854 27.5855 38.3333 26.6667 38.3333H3.33336C2.41461 38.3333 1.66672 37.5854 1.66672 36.6666V3.33336C1.66672 2.41461 2.41461 1.66672 3.33336 1.66672H20V6.66672C20 8.50508 21.4949 10 23.3334 10H28.3334V36.6666Z" fill="#0A3B61"></path>
                                                                <path d="M19.2488 24.4636C18.4773 23.8565 17.7441 23.2324 17.2559 22.7441C16.6211 22.1093 16.0555 21.4941 15.564 20.9082C16.3306 18.5392 16.6667 17.3177 16.6667 16.6666C16.6667 13.9005 15.6673 13.3333 14.1667 13.3333C13.0266 13.3333 11.6667 13.9257 11.6667 16.7464C11.6667 17.9899 12.3479 19.4995 13.698 21.254C13.3676 22.2623 12.9794 23.4253 12.5432 24.7363C12.3332 25.3654 12.1054 25.948 11.8645 26.4868C11.6723 26.5717 11.4821 26.6609 11.294 26.7545C10.6316 27.0858 10.0025 27.3836 9.41898 27.6603C6.75781 28.92 5 29.7534 5 31.3989C5 32.5936 6.29805 33.3333 7.5 33.3333C9.04945 33.3333 11.3891 31.2637 13.0981 27.7774C14.8722 27.0775 17.0777 26.5591 18.8184 26.2344C20.2132 27.307 21.7537 28.3333 22.5 28.3333C24.5662 28.3333 25 27.1386 25 26.1368C25 24.1665 22.749 24.1665 21.6666 24.1665C21.3305 24.1666 20.4289 24.2659 19.2488 24.4636ZM7.5 31.6666C7.02391 31.6666 6.70164 31.442 6.66664 31.3989C6.66664 30.808 8.42852 29.9731 10.1327 29.1658C10.2409 29.1146 10.3508 29.0633 10.4623 29.0104C9.21063 30.8252 7.97281 31.6666 7.5 31.6666ZM13.3334 16.7464C13.3334 15 13.8754 15 14.1667 15C14.7559 15 15.0001 15 15.0001 16.6666C15.0001 17.0182 14.7657 17.8971 14.3368 19.2692C13.6824 18.2617 13.3334 17.3983 13.3334 16.7464ZM13.9722 25.7031C14.0246 25.5573 14.0751 25.4108 14.1236 25.2636C14.4328 24.3359 14.7112 23.5025 14.9594 22.7522C15.3052 23.1331 15.678 23.5229 16.0776 23.9225C16.2338 24.0787 16.6212 24.4303 17.1372 24.8705C16.11 25.0943 15.0171 25.3718 13.9722 25.7031ZM23.3334 26.1368C23.3334 26.5112 23.3334 26.6666 22.5602 26.6715C22.3332 26.6227 21.8083 26.3135 21.1605 25.8724C21.3956 25.8464 21.569 25.8333 21.6666 25.8333C22.898 25.8333 23.2471 25.9537 23.3334 26.1368Z" fill="#0A3B61"></path>
                                                            </g>
                                                            <defs>
                                                                <clipPath id="clip0_20147_18">
                                                                    <rect width="40" height="40" fill="white"></rect>
                                                                </clipPath>
                                                            </defs>
                                                        </svg>
                                                    </div>
                                                    <div class="block-info">
                                                        <span class="document-date text-body-3 font-normal text-utility-gray-500"><?php echo $post_date; ?></span>
                                                        <h3 class="title heading-4 font-normal mt-1 transition-300 hover:text-primary-1 line-clamp-2"><a href="<?php echo $post_url; ?>" target="_blank" rel="noopener"><?php echo $post_title; ?></a></h3>
                                                        <a class="document-dowload-btn flex gap-x-3 text-utility-gray-500 mt-3 cursor-pointer select-none" href="<?php echo $post_url; ?>" target="_blank" rel="noopener">
                                                            <div class="block-icon text-xl"><i class="fa-light fa-arrow-right"></i></div>
                                                            <div class="content text-body-1 font-normal"><?php _e('Xem chi tiết', 'canhcamtheme'); ?></div>
                                                        </a>
                                                    </div>
                                                </li>
                                                <?php endwhile; ?>
                                            </ul>
                                        </div>
                                        <a class="btn-primary btn undefined" href="<?php echo $permalink; ?>"><span><?php _e('Tìm hiểu thêm', 'canhcamtheme'); ?></span></a>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <?php
                        wp_reset_postdata();
                    endif;
                endforeach;
            else:
            ?>
            <li class="shareholder-rel-item">
                <div class="container-1600">
                    <div class="child py-15 text-center">
                        <p>Không có thông tin cổ đông.</p>
                    </div>
                </div>
            </li>
            <?php endif; ?>
        </ul>
    </div>
</section>

<?php get_footer(); ?>