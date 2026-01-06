<?php
/**
 * Template Name: Giới thiệu
 */
?>

<?php get_header(); ?>

<?php $banner = get_field('banner'); ?>
<section class="section-banner-secondary pt-[var(--header-height)]"> 
    <div class="block-banner img-ratio ratio:pt-[1_2] md:ratio:pt-[600_1920]"> <img class="lozad undefined" data-src="<?php echo $banner ? $banner['url'] : get_stylesheet_directory_uri() . "/img/banner-secondary-2.svg"; ?>" alt="<?php echo $banner ? $banner['alt'] : ''; ?>"/>
    </div>
</section>

<?php echo get_template_part('modules/common/breadcrumb'); ?>

<?php if(get_field('intro')) : ?>
    <?php
        $intro = get_field('intro');
        $title = $intro['title'];
        $description = $intro['description'];
        $image = $intro['image'];
    ?>
    <section class="section-about-us section-py">
        <div class="container-1600"> 
            <div class="about-us flex -lg:flex-col items-stretch">
                <div class="about-us-content w-full lg:w-[calc(680/1600*100%)] flex flex-col gap-y-6 py-5 lg:pr-base xl:rem:pr-[calc(80px-12px)] xl:rem:py-[57px]"> 
                    <h1 class="about-us-title heading-1"><?php echo $title ? $title : __('Về chúng tôi','canhcamtheme'); ?></h1>
                    <?php if($description): ?>
                    <div class="block-content lg:flex-[1_1_0] lg:overflow-auto overflow-scroll-1 lg:pr-3"> 
                        <div class="flex flex-col gap-y-3 text-body-1"> 
                            <?php echo $description; ?>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
                <?php if($image): ?>
                    <div class="about-us-img w-full lg:w-[calc(920/1600*100%)]"> 
                        <div class="block-img img-ratio ratio:pt-[613.33_920] rounded-lg">
                            <img class="lozad undefined" data-src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>"/>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>
<?php endif; ?>

<?php if(get_field('vision_and_mission')) : ?>
    <?php
        $vision_and_mission = get_field('vision_and_mission');
        $background = $vision_and_mission['background'];
        $items = $vision_and_mission['items'];
    ?>
    <section class="section-vision-mission">
        <div setBackground="<?php echo $background['url']; ?>" class="vision-mission bg-cover bg-center bg-no-repeat">
            <div class="container-1600">
                <div class="vision-mission-content grid grid-cols-1 md:grid-cols-2 rem:min-h-[611px] relative z-2">
                    <?php foreach($items as $item): ?>
                        <div class="vision-mission-item flex-center flex-col text-center">
                            <div class="block-icon w-20 h-20 lg:w-25 lg:h-25">
                                <img class="lozad undefined max-w-full" data-src="<?php echo $item['icon']['url']; ?>" alt="<?php echo $item['icon']['alt']; ?>"/>
                            </div>
                            <h2 class="vision-title heading-1 text-white mt-10"><?php echo $item['title']; ?></h2>
                            <div class="vision-desc text-body-1 mt-4 line-clamp-5 text-white"><?php echo $item['description']; ?></div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>

<?php if(get_field('history')) : ?>
    <?php 
    $history = get_field('history');
    $title = $history['title'];
    $timeline = $history['history_line'];
    ?>
    <section class="section-his-formation section-py">
        <div class="container-1600">  
            <div class="his-formation flex flex-col gap-base">
                <h2 class="his-formation-title heading-1 text-center"><?php echo $title ? $title : __('Lịch sử hình thành và phát triển','canhcamtheme'); ?></h2>
                <?php if($timeline): ?>
                    <div class="swiper swiper-thumb-timeline w-full before:content-[''] before:block before:absolute before:rem:top-[calc(28px/2)] before:left-0 before:-z-1 before:w-full before:border-t before:border-utility-gray-200">
                        <ul class="swiper-wrapper timeline-list">
                            <?php foreach($timeline as $item): ?>
                                <li class="swiper-slide timeline-item">
                                    <div class="child group flex-center flex-col gap-y-4 select-none cursor-pointer "> 
                                        <span class="icon-round flex-center w-7 h-7 rounded-full group-hover:bg-primary-2 transition-300 before:content-[''] before:block before:w-4 before:h-4 before:rounded-full before:bg-utility-gray-200"></span>
                                        <span class="content heading-2 text-utility-gray-300 transition-300 group-hover:text-primary-2"><?php echo $item['year']; ?></span>
                                    </div>
                                </li>
                            <?php endforeach; ?> 
                        </ul>
                    </div>
                    <div class="block-his-formation-slide relative">
                        <div class="swiper swiper-his-formation w-full relative">
                            <ul class="swiper-wrapper"> 
                                <?php foreach($timeline as $item): ?>
                                    <li class="swiper-slide history-item">
                                        <div class="child grid grid-cols-1 md:grid-cols-2 items-center p-5 md:p-8 rounded-lg bg-utility-gray-50">
                                            <div class="img-thumb img-ratio ratio:pt-[512_768] rounded-lg">
                                                <img class="lozad undefined" data-src="<?php echo $item['image']['url']; ?>" alt="<?php echo $item['image']['alt']; ?>"/>
                                            </div>
                                            <div class="block-info -md:pt-5 md:pl-10 lg:pl-16">
                                                <h3 class="history-title heading-3 -md:text-body-5"><?php echo $item['date']; ?></h3>
                                                <div class="history-desc text-body-1 mt-6 -md:mt-4">
                                                    <p><?php echo $item['description']; ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                            
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

<?php if(get_field('organization')) : ?>
    <?php
    $organization = get_field('organization');
    $title = $organization['title'];
    $image = $organization['image'];
    ?>
    <section class="section-org-structure section-py bg-utility-gray-50">
        <div class="container-1600"> 
            <div class="org-structure">
                <h2 class="org-structure-title heading-1 text-center"><?php echo $title ? $title : __('Cơ cấu tổ chức','canhcamtheme'); ?></h2>
                <div class="org-structure-img img-ratio ratio:pt-[496_1600] mt-base"><img class="lozad !object-contain" data-src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>"/>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>

<?php if(get_field('member')) : ?>
    <?php
    $members = get_field('member');
    $title = $members['title'];
    $tabs = $members['tabs'];
    ?>
    <section class="section-member-units section-py">
        <div class="container-1600">
            <div class="member-units wrap" data-toggle="tabslet">
                <h2 class="member-units-title heading-1 text-center"><?php echo $title ? $title : __('Đơn vị thành viên ','canhcamtheme'); ?></h2>
                <?php if($tabs): ?>
                    <ul class="member-tab-list tabslet-tab flex flex-wrap justify-center gap-6 mt-6">
                        <?php foreach($tabs as $index => $tab): ?>
                            <li class="member-tab-item <?php if($index == 0) echo 'active'; ?>"><a class="btn-secondary btn tab" href="#tab-<?php echo $index + 1 ;?>"><span><?php echo $tab['tab_name']; ?></span></a></li>
                        <?php endforeach; ?>
                    </ul>
                    <?php foreach($tabs as $index => $tab): ?>
                        <div class="member-unit-main tabslet-content -md:gap-base flex flex-wrap mt-base" id="tab-<?php echo $index + 1 ;?>">
                            <div class="member-content w-full md:w-[calc(667/1600*100%)] flex flex-col md:pr-base-24"> 
                                <div class="child overflow-scroll-2 md:flex-[1_1_0] md:overflow-auto md:pr-4">
                                    <ul class="member-content-list wrap-item-toggle active-first flex flex-col gap-y-4">
                                        <?php foreach($tab['tab_items'] as $key => $item): ?>
                                            <li class="member-content-item item-toggle p-6 rounded-lg bg-utility-gray-50 border border-transparent transition-300 <?php if($key == 0) echo 'active'; ?>">
                                                <div class="block-header title flex-between text-utility-gray-500 overflow-hidden transition-300 select-none cursor-pointer <?php if($key == 0) echo 'active'; ?>">
                                                    <span class="title-header heading-2 text-inherit"><?php echo $item['title']; ?></span>
                                                    <span class="icon text-xl text-inherit transition-300 "><i class="fa-light fa-angle-down"></i></span>
                                                </div>
                                                <div class="block-mega-content pt-4 mt-4 border-t border-primary-2">
                                                    <div class="flex flex-col gap-y-6">
                                                        <?php if($item['info']): ?>
                                                            <ul class="mega-content-list flex flex-col gap-y-2">
                                                                <?php foreach($item['info'] as $info): ?>
                                                                    <li class="mega-content-item flex gap-x-4">
                                                                        <div class="icon text-xl text-primary-2 max-w-full">
                                                                            <i class="fa-solid fa-<?php echo $info['icon']; ?>"></i>
                                                                        </div>
                                                                        <div class="content text-body-1">
                                                                            <?php echo $info['text']; ?>
                                                                        </div>
                                                                    </li>
                                                                <?php endforeach; ?>
                                                            </ul>
                                                        <?php endif; ?>
                                                        <?php if($item['mission']): ?>
                                                            <div class="mission flex flex-col gap-y-2">
                                                                <span class="mission-title heading-5 text-primary-2"><?php echo $item['mission']['title']; ?></span>
                                                                <?php if($item['mission']['content']): ?>
                                                                    <ul class="mission-content-list flex flex-col gap-y-2 pl-5 text-body-1 list-disc">
                                                                        <?php foreach($item['mission']['content'] as $content): ?>
                                                                            <li class="mission-content-item">
                                                                                <?php echo $content['text']; ?>
                                                                            </li>
                                                                        <?php endforeach; ?>
                                                                    </ul>
                                                                <?php endif; ?>
                                                            </div>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            </div>
                            <?php if($tab['image']): ?>
                                <div class="branch-image w-full md:w-[calc(933/1600*100%)]">
                                    <div class="block-img img-ratio ratio:pt-[524_933] rounded-2"><img class="lozad undefined" data-src="<?php echo $tab['image']['url']; ?>" alt="<?php echo $tab['image']['alt']; ?>"/>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>

                <?php endif; ?>

                
            </div>
        </div>
    </section>
<?php endif; ?>

<?php get_footer(); ?>