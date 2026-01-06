<?php get_header(); ?>

<div class="space-header pt-[var(--header-height)]"></div>

<?php echo get_template_part('modules/common/breadcrumb'); ?>

<section class="section-detail-news section-py"> 
    <div class="container-1600">
        <div class="detail-news grid grid-cols-12 gap-base"> 
            <div class="detail-news-main col-span-full lg:col-span-8">
                <div class="block-detail flex flex-col gap-y-8">
                    <div class="detail-header"> 
                        <h1 class="title heading-3 text-black"><?php the_title(); ?></h1>
                        <div class="block-date-notice flex items-center gap-x-2 mt-4.75">
                            <span class="date text-body-1text-utility-gray-500"><?php the_time('d/m/Y'); ?></span>
                            <span class="text-body-3 text-utility-gray-500">|</span>
                            <span class="notice text-body-1 text-primary-2"><?php the_terms(get_the_ID(), 'co-dong-category', ' '); ?></span>
                        </div>
                    </div>
                    <div class="detail-content-main">
                        <div class="format-content"> 
                            <!-- <img class="lozad undefined" data-src="<?php the_post_thumbnail_url('full'); ?>" alt="<?php the_title(); ?>"/> -->
                            <?php the_content(); ?>
                        </div>
                    </div>
                    <div class="block-social flex items-center gap-x-4"><span class="title text-body-1"><?php _e('Chia sẻ','canhcamtheme'); ?>:</span>
                        <ul class="social-list flex gap-x-3">
                            <li class="social-item"> <a class="flex-center w-10 h-10 rounded-full bg-[rgba(10,59,97,1)] text-base text-white" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(get_permalink()); ?>" target="_blank" rel="noopener noreferrer"><i class="fa-brands fa-facebook-f"></i> </a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="detail-related-news col-span-full lg:col-span-4">
                <h2 class="related-news-title relative pb-3 heading-3 after:content-[''] after:block after:absolute after:bottom-0 after:left-0 after:w-[15%] after:border-b-2 after:border-primary-2"><?php _e('Tin tức liên quan', 'canhcamtheme'); ?></h2>
                <ul class="related-news-list flex flex-col gap-y-6 mt-6">
                    <?php
                    $current_post_id = get_the_ID();
                    $categories = get_the_category($current_post_id);
                    $category_ids = array();
                    foreach($categories as $category) {
                        $category_ids[] = $category->term_id;
                    }
                    
                    $args = array(
                        'post_type' => 'co-dong',
                        'posts_per_page' => 4,
                        'post__not_in' => array($current_post_id),
                        'category__in' => $category_ids,
                        'orderby' => 'date',
                        'order' => 'DESC'
                    );
                    
                    $related_posts = new WP_Query($args);
                    
                    if($related_posts->have_posts()) :
                        while($related_posts->have_posts()) : $related_posts->the_post();
                    ?>
                    <li class="related-news-item group flex items-center"> 
                        <div class="block-info grow">
                            <h3 class="title heading-4 mt-2.5 text-black line-clamp-3 transition-300 group-hover:text-primary-2">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h3>
                            <span class="date text-body-1 text-utility-gray-500"><?php the_time('d/m/Y'); ?></span>
                        </div>
                    </li>
                    <?php
                        endwhile;
                        wp_reset_postdata();
                    else:
                    ?>
                    <li class="related-news-item">
                        <p><?php _e('Không có tài liệu liên quan.', 'canhcamtheme'); ?></p>
                    </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>