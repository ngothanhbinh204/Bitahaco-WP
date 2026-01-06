<?php
/**
 * Template Name: Lĩnh vực hoạt động
 */
?>

<?php get_header(); ?>

<div class="space-header pt-[var(--header-height)]"></div>

<?php echo get_template_part('modules/common/breadcrumb'); ?>

<?php $updating = get_field('updating'); ?>

<?php if(get_field('banner')): ?>
    <?php
    $banner = get_field('banner');
    $image = $banner['image'];
    $title = $banner['title'];
    $description = $banner['description'];
    ?>
    <section class="section-banner-operation pt-10">
        <div class="container-1600">
            <div class="banner-operation relative">
                <div class="banner-img img-ratio ratio:pt-[1_2] md:ratio:pt-[716_1600] rounded-lg">
                    <img class="lozad undefined" data-src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>"/>
                </div>
                <div class="banner-info md:absolute md:bottom-0 md:left-0 -xl:w-full xl:bottom-10 xl:left-10 -md:mt-base md:p-8 xl:py-16 xl:px-15 rounded-lg md:bg-[linear-gradient(to_bottom,rgba(10,59,97,0),rgba(10,59,97,1))] xl:bg-primary-2 w-[calc(600/1600*100%)]">
                    <h1 class="title heading-1 md:text-white"><?php echo $title ? $title : __('Bất động sản ','canhcamtheme'); ?></h1>
                    <?php if($updating): ?>
                        <div class="info flex flex-col gap-y-3 mt-5.5 heading-2 md:text-white ">
                            <p><?php echo __('Đang cập nhật...', 'canhcamtheme'); ?></p>
                        </div>
                    <?php else: ?>
                        <?php if($description): ?>
                            <div class="info flex flex-col gap-y-3 mt-5.5 text-body-1 md:text-white md:text-opacity-60">
                                <?php echo $description; ?>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>
                    
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>

<?php if(!$updating): ?>

    <?php if(get_field('products')): ?>
        <?php 
        $products = get_field('products');
        $title = $products['title'];
        $description = $products['description'];
        $items = $products['items'];
        ?>
        <section class="section-product-realization section-py">
            <div class="product-realization -xl:container-1600">
                <div class="swiper-column-auto auto-225-column flex flex-wrap "> 
                    <div class="content-action-slide w-full xl:w-[calc(707/1920*100%)] xl:rem:pl-[160px] xl:pr-base">
                        <h2 class="title heading-1"><?php echo $title ? $title : __('Sản phẩm thực hiện ','canhcamtheme'); ?></h2>
                        <?php if($description): ?>
                            <div  class="content mt-2 text-body-1">
                                <p><?php echo $description; ?></p>
                            </div>
                        <?php endif; ?>
                        <div class="wrap-button-slide -xl:!justify-end">
                            <button class="btn slide btn-prev"><i class="fa-regular fa-arrow-left"></i>
                            </button>
                            <button class="btn slide btn-next"><i class="fa-regular fa-arrow-right"></i>	
                            </button>
                        </div>
                    </div>
                    <?php if($items): ?>
                        <div class="product-realization-slide w-full xl:w-[calc(1213/1920*100%)] -xl:mt-base">
                            <div class="swiper">
                                <div class="swiper-wrapper">
                                    <?php foreach($items as $item): ?>
                                        <div class="swiper-slide">
                                            <div class="product-realization-item"> 
                                                <div class="img-thumb">
                                                    <a class="img-ratio ratio:pt-[379.5_506] rounded-lg" href="<?php echo $item['link']; ?>" > 
                                                        <img class="lozad undefined" data-src="<?php echo $item['image']['url']; ?>" alt="<?php echo $item['image']['alt']; ?>"/>
                                                    </a>
                                                </div>
                                                <div class="info pt-6">
                                                    <h3 class="title heading-2 line-clamp-2"> <a href="<?php echo $item['link']; ?>"><?php echo $item['title']; ?></a></h3>
                                                    <?php if($item['description']): ?>
                                                        <div class="desc text-body-1 line-clamp-4"><?php echo $item['description']; ?></div>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <?php if(get_field('projects')) : ?>
        <?php 
        $projects = get_field('projects');
        $title = $projects['title'];
        $select_project = $projects['select_project'];
        ?>
        <section class="section-related-projects-operation bg-utility-gray-50 section-py">
            <div class="container-1600"> 
                <div class="related-projects">
                    <h2 class="title heading-1 text-center"><?php echo $title ? $title : __('Dự án liên quan ','canhcamtheme'); ?></h2>
                    <?php if($select_project): ?>
                        <div class="related-projects-block swiper-column-auto auto-3-column relative mt-base">
                            <div class="swiper">
                                <div class="swiper-wrapper"> 
                                    <?php foreach($select_project as $item): ?>
                                        <?php
                                        $information = get_field('information', $item->ID);
                                        $address = $information['address'];
                                        ?>
                                        <div class="swiper-slide"> 
                                            <li class="projects-out-item">
                                                <div class="projects-out-thumb relative rounded-lg overflow-hidden before:content-[''] before:block before:absolute before:bottom-0 before:z-1 before:w-full before:h-[10%] before:-lg:h-[50%] before:bg-[linear-gradient(to_bottom,rgba(0,0,0,0),rgba(0,0,0,0.5))] before:transition-300">
                                                    <a class="img-ratio ratio:pt-[556_517.33]" href="<?php echo get_permalink($item->ID); ?>">
                                                        <img class="lozad undefined" data-src="<?php echo get_the_post_thumbnail_url($item->ID); ?>" alt="<?php echo get_the_title($item->ID    ); ?>"/>
                                                    </a>
                                                    <div class="info-thumb absolute bottom-0 left-0 z-2 p-6 text-white lg:opacity-0 lg:invisible transition-300">
                                                        <p class="text-body-2 line-clamp-3"><?php echo get_the_excerpt($item->ID); ?></p>
                                                    </div>
                                                </div>
                                                <div class="projects-out-info mt-6">
                                                    <h3 class="info-name heading-4 line-clamp-2 transition-300"> 
                                                        <a href="<?php echo get_permalink($item->ID); ?>"><?php echo get_the_title($item->ID); ?></a>
                                                    </h3>
                                                    <div class="info-location items-baseline mt-2 flex gap-x-2">
                                                        <i class="fa-solid fa-location-dot text-base text-utility-gray-500"></i>
                                                        <div class="text-body-2 text-utility-gray-500"><?php echo $address; ?></div>
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
                    <?php endif; ?>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <?php if(get_field('other')) : ?>
        <?php 
        $other = get_field('other');
        $title = $other['title'];
        $items = $other['items'];
        ?>
        <section class="section-activity-other section-py"> 
            <div class="container-1600"> 
                <div class="activity-other"> 
                    <h2 class="title heading-1 text-center"><?php echo $title ? $title : __('Lĩnh vực hoạt động khác ','canhcamtheme'); ?></h2>
                    <?php if($items): ?>
                        <ul class="activity-other-list grid grid-cols-1 sm:grid-cols-2 gap-base mt-base">
                            <?php foreach($items as $item): ?>
                                <li class="activity-other-item flex -lg:flex-col lg:items-center gap-base p-4 rounded-lg bg-utility-gray-50">
                                    <div class="img-thumb shrink-0 w-full lg:rem:w-[calc(300/748*100%)]">
                                        <a class="img-ratio ratio:pt-[379.5_506] lg:ratio:pt-[200_300]" href="<?php echo $item['link']; ?>">
                                            <img class="lozad undefined" data-src="<?php echo $item['image']['url']; ?>" alt="<?php echo $item['image']['alt']; ?>"/>
                                        </a>
                                    </div>
                                    <div class="info"> 
                                        <a href="<?php echo $item['link']; ?>">
                                            <h3 class="title heading-2"><?php echo $item['title']; ?></h3>
                                        </a>
                                        <?php if($item['description']): ?>
                                            <div class="mt-2 text-body-1 line-clamp-4"><?php echo $item['description']; ?></div>
                                        <?php endif; ?>
                                    </div>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </div>
            </div>
        </section>
    <?php endif; ?>

<?php endif; ?>

<?php get_footer(); ?>