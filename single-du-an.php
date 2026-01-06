<?php get_header(); ?>

<?php 
$banner = get_field('banner');
$image = $banner['image'];
$title = $banner['title'];
$description = $banner['description'];
?>
<section class="section-banner-detail-project pt-[var(--header-height)]">
    <div class="banner-main relative">
        <div class="banner-img img-ratio ratio:pt-[860_1920] before:content-[''] before:block before:absolute before:bottom-0 before:left-0 before:w-full lg:before:h-[55%] lg:before:bg-[linear-gradient(180deg,rgba(10,59,97,0)0%,rgba(10,59,97,0.936368)57.2%,#0A3B61_100%)] before:z-1 before:pointer-events-none">
            <?php 
            $thumbnail = get_the_post_thumbnail_url() ? get_the_post_thumbnail_url() : get_stylesheet_directory_uri() . '/img/banner-secondary-1.svg'
            ?>
            <img class="lozad undefined" data-src="<?php echo $image ? $image['url'] : $thumbnail; ?>" alt="<?php echo get_the_title(); ?>"/>
        </div>
        <div class="block-info lg:absolute-center-x lg:z-2 lg:bottom-0 w-full -lg:pt-4">
            <div class="container-1600">
                <div class="project-detail-header pb-5 lg:pb-10 -xl:w-full w-[55%]">
                    <h1 class="title heading-1 lg:text-white"><?php echo $title ? $title : get_the_title(); ?></h1>
                    <?php if ($description): ?>
                        <div class="project-subtitle mt-6 text-body-1 lg:text-white lg:text-opacity-60"><?php echo $description; ?></div>
                    <?php endif; ?>

                </div>
            </div>
            <?php if(get_field('information')['parameter']) : ?>
                <?php $parameter = get_field('information')['parameter']; ?>
                <div class="project-detail-stats md:border-t md:border-utility-gray-200 lg:border-white lg:border-opacity-20">
                    <div class="container-1600"> 
                        <ul class="project-detail-stats-list grid grid-cols-2 sm:grid-cols-3 md:grid-cols-5">
                            <?php foreach($parameter as $item) : ?>
                                <li class="project-detail-stats-item flex flex-col justify-between gap-y-4 items-center -md:p-3 md:px-base-24 md:first:pl-0 md:last:pr-0 py-8 -md:border md:border-r border-utility-gray-200 lg:border-white lg:border-opacity-20 md:last:border-none"> 
                                    <span class="stat-label text-body-1 lg:text-white lg:text-opacity-60"><?php echo $item['title']; ?></span>
                                    <span class="stat-value heading-2 lg:text-white"><?php echo $item['value']; ?></span>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<section class="section-detail-project-desc bg-utility-gray-50 section-py lg:py-16">
    <div class="container-1600"> 
        <div class="detail-project-desc w-full lg:w-[85%] xl:w-[calc(1332/1600*100%)] mx-auto">
            <div class="format-content text-center">
                <?php the_content(); ?>
            </div>
        </div>
    </div>
</section>

<section class="section-scale-proj-pg">
    <div class="scale-proj-pg">
        <ul class="scale-proj-pg-list flex flex-col -lg:gap-base">
        <?php if(get_field('scale')) : ?>
            <?php 
            $scale = get_field('scale'); 
            $image = $scale['image'];
            $title = $scale['title'];
            $content = $scale['content'];
            ?>
            <li class="scale-proj-pg-item item-scale grid grid-cols-1 lg:grid-cols-2"> 
                <div class="img-thumb"> 
                    <div class="img-ratio ratio:pt-[726_960]">
                        <?php if($image) : ?>
                            <img class="lozad undefined" data-src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>"/>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="block-info flex items-center h-full -lg:px-container -lg:py-6 xl:pl-16 lg:p-10 xl:pr-40 xl:rem:py-[93px]">
                    <div class="info-child w-full flex flex-col h-full">    
                        <?php if($title) : ?>
                            <h2 class="title heading-1"><?php echo $title; ?></h2>
                        <?php endif; ?>
                        <?php if($content) : ?>
                            <div class="overflow-scroll-1 lg:flex-[1_1_0] lg:overflow-auto mt-4">
                                <ul class="detail-main-list flex flex-col lg:pr-6">
                                    <?php foreach($content as $item) : ?>
                                        <li class="detail-main-item flex flex-col gap-y-4">
                                            <div class="title-detail flex-between gap-3">
                                                <?php if($item['title']) : ?>
                                                    <span class="title text-body-1 font-bold"><?php echo $item['title']; ?></span>
                                                <?php endif; ?>
                                                <?php if($item['value']) : ?>
                                                    <span class="parameter heading-2 whitespace-nowrap"><?php echo $item['value']; ?></span>
                                                <?php endif; ?>
                                            </div>
                                            <?php if($item['sub_infor']) : ?>
                                                <ul class="mega-content flex flex-col gap-y-4"> 
                                                    <?php foreach($item['sub_infor'] as $sub_item) : ?>
                                                        <li class="mega-content-item flex-between gap-3"> 
                                                            <?php if($sub_item['title']) : ?>
                                                                <span class="title text-body-1"><?php echo $sub_item['title']; ?></span>
                                                            <?php endif; ?>
                                                            <?php if($sub_item['value']) : ?>
                                                                <span class="content text-body-1 whitespace-nowrap"><?php echo $sub_item['value']; ?></span>
                                                            <?php endif; ?>
                                                        </li>
                                                    <?php endforeach; ?>                                                    </ul>
                                            <?php endif; ?>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </li>
        <?php endif; ?>
        <?php if(get_field('progress')) : ?>
            <?php
            $progress = get_field('progress');
            $image = $progress['image'];
            $title = $progress['title'];
            $content = $progress['content'];
            ?>
            <li class="scale-proj-pg-item grid grid-cols-1 lg:grid-cols-2">
                <div class="img-thumb lg:order-2"> 
                    <div class="img-ratio ratio:pt-[726_960]">
                        <?php if($image) : ?>
                            <img class="lozad undefined" data-src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>"/>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="block-info flex flex-col justify-center gap-y-4 xl:pr-13 -lg:px-container lg:order-1 -lg:py-6 lg:p-10 xl:rem:py-[157px] xl:pl-40 bg-utility-gray-50">
                    <?php if($title) : ?>
                        <h2 class="title heading-1"><?php echo $title; ?></h2>
                    <?php endif; ?>
                    <?php if($content) : ?>
                        <div class="flex-1 relative"> 
                            <div class="overflow-scroll-1 lg:absolute left-0 top-0 lg:overflow-auto w-full h-full ">
                                <ul class="progress-list flex flex-col gap-y-3 list-disc pl-7 lg:pr-6">
                                    <?php foreach($content as $item) : ?>
                                        <li class="progress-item text-body-1"><?php echo $item['text']; ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </li>
        <?php endif; ?>
        </ul>
    </div>
</section>

<?php if(get_field('gallery')) : ?>
    <?php $gallery = get_field('gallery'); ?>
    <section class="section-image-library section-py">
        <div class="image-library">
            <h2 class="image-library-title heading-1 text-center"><?php _e('Thư viện hình ảnh', 'meyhomes'); ?></h2>
            <div class="swiper swiper-image-library mt-base relative">
                <div class="swiper-wrapper"> 
                    <?php foreach($gallery as $item) : ?>
                        <div class="swiper-slide"> 
                            <div class="img-thumb img-ratio ratio:pt-[1_2] md:ratio:pt-[567_1134]">
                                <img class="lozad undefined" data-src="<?php echo $item['url']; ?>" alt="<?php echo $item['alt']; ?>"/>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="container-1600 block-action xl:absolute-center z-1 wrap-button-slide static-mobile">
                    <button class="btn slide swiper-btn-prev xl:absolute-center-y rem:left-[60px] md:rem:left-[125px]"><i class="fa-regular fa-arrow-left"></i>
                    </button>
                    <button class="btn slide swiper-btn-next xl:absolute-center-y rem:right-[60px] md:rem:right-[125px]"><i class="fa-regular fa-arrow-right"></i>	
                    </button>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>

<section class="section-related-projects-operation section-py">
    <div class="container-1600"> 
        <div class="related-projects">
            <h2 class="title heading-1 text-center"><?php _e('Dự án liên quan', 'meyhomes'); ?></h2>
            <div class="related-projects-block swiper-column-auto auto-4-column relative mt-base">
                <div class="swiper">
                    <div class="swiper-wrapper"> 
                        <?php
                        $related_projects = get_posts(array(
                            'post_type' => 'du-an',
                            'posts_per_page' => 5,
                            'post__not_in' => array(get_the_ID()),
                            'orderby' => 'rand'
                        ));
                        
                        foreach($related_projects as $project) :
                            $information = get_field('information', $project->ID);
                            $address = $information['address'];
                            $thumbnail = get_the_post_thumbnail_url($project->ID, 'full');
                            $excerpt = get_the_excerpt($project->ID);
                        ?>
                        <div class="swiper-slide"> 
                            <li class="projects-out-item">
                                <div class="projects-out-thumb relative rounded-lg overflow-hidden before:content-[''] before:block before:absolute before:bottom-0 before:z-1 before:w-full before:h-[10%] before:-lg:h-[50%] before:bg-[linear-gradient(to_bottom,rgba(0,0,0,0),rgba(0,0,0,0.5))] before:transition-300"><a class="img-ratio ratio:pt-[556_517.33] " href="<?php echo get_permalink($project->ID); ?>"><img class="lozad undefined" data-src="<?php echo $thumbnail; ?>" alt="<?php echo get_the_title($project->ID); ?>"/></a>
                                    <div class="info-thumb absolute bottom-0 left-0 z-2 p-6 text-white lg:opacity-0 lg:invisible transition-300">
                                        <p class="text-body-2 line-clamp-3"><?php echo $excerpt; ?></p>
                                    </div>
                                </div>
                                <div class="projects-out-info mt-6">
                                    <h3 class="info-name heading-4 line-clamp-2 transition-300"> <a href="<?php echo get_permalink($project->ID); ?>"><?php echo get_the_title($project->ID); ?></a></h3>
                                    <div class="info-location mt-2 flex items-baseline gap-x-2">
                                        <i class="fa-solid fa-location-dot text-base text-utility-gray-500"></i><span class="text-body-2 text-utility-gray-500"><?php echo $address; ?></span>
                                    </div>
                                </div>
                            </li>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="wrap-button-slide static-mobile">
                    <button class="btn slide btn-prev"><i class="fa-regular fa-arrow-left"></i>
                    </button>
                    <button class="btn slide btn-next"><i class="fa-regular fa-arrow-right"></i>	
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>