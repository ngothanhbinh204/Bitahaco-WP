<?php get_header(); ?>

<?php $banner = get_field('career_banner', 'option'); ?>
<section class="section-banner-secondary pt-[var(--header-height)]"> 
    <div class="block-banner img-ratio ratio:pt-[1_2] md:ratio:pt-[600_1920]"> 
        <img class="lozad undefined" data-src="<?php echo $banner && isset($banner['url']) ? $banner['url'] : get_stylesheet_directory_uri() . '/img/banner-secondary-1.svg'; ?>" alt="<?php echo $banner && isset($banner['alt']) ? $banner['alt'] : ''; ?>"/>
    </div>
</section>

<?php echo get_template_part('modules/common/breadcrumb'); ?>

<?php if(get_field('career_intro', 'option')) : ?>
    <?php
    $intro = get_field('career_intro', 'option');
    $title = $intro['title'];
    $description = $intro['description'];
    ?>
    <section class="section-recruitment section-py !pb-10 relative">
        <div class="container-1600"> 
            <div class="recruitment">
                <div class="recruitment-introduce w-full lg:w-1/2">
                    <?php if($title) : ?>
                        <h2 class="title heading-1"><?php echo $title; ?></h2>
                    <?php endif; ?>
                    <?php if($description) : ?>
                        <div class="desc mt-5 text-body-1"><?php echo $description; ?></div>
                    <?php endif; ?>
                </div>
            </div>
        </div><img class="absolute right-[8%] bottom-0 w-[120px] md:w-[180px] lg:rem:w-[361px] lg:rem:h-[274px]" src="<?php echo get_stylesheet_directory_uri(); ?>/img/bg-recruitment-list-1.svg">
    </section>
<?php endif; ?>

<?php if(get_field('career_image', 'option')) : ?>
    <?php
    $image = get_field('career_image', 'option');
    ?>
    <section class="section-journey">
        <div class="journey relative">
            <div class="hero-img img-ratio ratio:pt-[760_1920]"><img class="lozad undefined" data-src="<?php echo $image ? $image['url'] : get_stylesheet_directory_uri() . '/img/journey-img-1.svg'; ?>" alt="<?php echo $image['alt'] ? $image['alt'] : ''; ?>"/>
            </div>
        </div>
    </section>
<?php endif; ?>

<section class="section-career-opportunities section-py"> 
    <div class="container-1600"> 
        <div class="career-opportunities flex flex-col gap-base"> 
            <h2 class="career-opportunities-title heading-1 text-center"><?php _e('Cơ hội nghề nghiệp', 'canhcamtheme'); ?></h2>
            <div class="block-job-tb overflow-x-auto"> 
                <table class="job-tb w-full ">
                    <thead class="-md:hidden"> 
                        <tr class="row-title uppercase text-body-1 text-white bg-primary-2">
                            <th class="w-[calc(70/1600*100%)] font-normal p-1.5">STT</th>
                            <th class="w-[calc(676/1600*100%)] font-normal text-left py-3 px-4"><?php _e('Tiêu đề', 'canhcamtheme'); ?></th>
                            <th class="w-[calc(285/1600*100%)] font-normal text-center py-3 px-4 whitespace-nowrap"><?php _e('Hạn nộp hồ sơ', 'canhcamtheme'); ?></th>
                            <th class="w-[calc(285/1600*100%)] font-normal text-center py-3 px-4"><?php _e('Địa điểm', 'canhcamtheme'); ?></th>
                            <th class="w-[calc(285/1600*100%)] font-normal py-3 px-4"></th>
                        </tr>

                    </thead>
                    <tbody id="career-list" data-per-page="10" class="-md:flex -md:flex-col -md:gap-y-3">
                        <?php
                        $args = array(
                            'post_type' => 'tuyen-dung',
                            'posts_per_page' => 10,
                            'post_status' => 'publish',
                            'paged' => 1
                        );
                        $query = new WP_Query($args);
                        $count = 1;
                        if ($query->have_posts()) :
                            while ($query->have_posts()) : $query->the_post();
                                $information = get_field('information');
                                $location = $information['location'];
                                $deadline = $information['application_deadline'];
                        ?>
                        <tr class="row-job -md:grid -md:grid-cols-1 -md:p-2 text-body-1 -md:rounded-1 border border-utility-gray-10 bg-secondary-1 bg-opacity-[0.05]">
                            <td class="text-center -md:hidden"><?php echo sprintf("%02d", $count); ?></td>
                            <td class="p-2 px-4 py-2 md:py-3 -md:font-semibold"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></td>
                            <td class="p-2 px-4 py-2 md:py-3 -md:order-3"><?php echo $deadline ? $deadline : ''; ?></td>
                            <td class="p-2 px-4 py-2 md:py-3"><?php echo $location ? $location : ''; ?></td>
                            <td class="p-2 px-4 py-2 md:py-3 -md:order-4"> 
                                <div class="flex-center h-full -md:justify-start"><a class="flex items-center gap-x-2.5 text-utility-gray-500" href="<?php the_permalink(); ?>"><span class="text-body-1"><?php _e('Ứng tuyển ngay', 'canhcamtheme'); ?></span><i class="fa-light fa-angle-right text-base"></i></a></div>
                            </td>
                        </tr>
                        <?php
                            $count++;
                            endwhile;
                            wp_reset_postdata();
                        endif;
                        ?>

                    </tbody>
                    
                </table>
            </div>
            <?php
            $total_posts = wp_count_posts('tuyen-dung')->publish;
            if ($total_posts > 10) :
            ?>  
            <div class="flex justify-center" id="load-more-container">
                <a class="btn-primary btn undefined" href="#" id="load-more-btn"><span><?php _e('Xem thêm', 'canhcamtheme'); ?></span></a>
            </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php get_footer(); ?>