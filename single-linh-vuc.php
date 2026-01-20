<?php get_header(); ?>
<main>
	<?php while(have_posts()): the_post(); 
        // Get Fields
        $intro_text = get_field('service_intro_text');
        $gallery = get_field('service_gallery');
        
        $role_title = get_field('service_role_title');
        $role_desc = get_field('service_role_desc');
        $role_img = get_field('service_role_image');
        $role_group = get_field('service_role_group_title');
        $role_items = get_field('service_role_items');
    ?>
	<section class="service-detail bg-[#F3F3FD]">
		<div class="container-fluid default-container-js">
			<div class="wrapper flex items-center lg:flex-row flex-col">
				<div class="col-left flex flex-col justify-center lg:rem:max-w-[640px] w-full py-10">
					<h2 class="title heading-1 text-Primary-1 font-bold pb-5">
						<?php _e("Lĩnh vực hoạt động", "canhcamtheme") ?>
					</h2>
					<div class="line w-15 rem:h-[2px] bg-Primary-1 mb-5"></div>
					<div class="sub-title heading-2 font-normal mb-5"><?php the_title(); ?></div>
					<?php if($intro_text): ?>
					<div class="text body-1 font-normal"><?php echo nl2br(esc_html($intro_text)); ?></div>
					<?php endif; ?>
				</div>
				<?php if($gallery): ?>
				<div class="swiper-column-auto relative flex-1 lg:pl-5 w-full xl:rem:h-[640px]" stick-to-edge="right"
					unstick-min="1024">
					<div class="swiper">
						<div class="swiper-wrapper">
							<?php foreach($gallery as $img): ?>
							<div class="swiper-slide">
								<div class="img">
									<a class="img-ratio ratio:pt-[640_1060]" href="<?php echo esc_url($img['url']); ?>"
										data-fancybox="gallery">
										<img class="lozad" data-src="<?php echo esc_url($img['url']); ?>"
											alt="<?php echo esc_attr($img['alt']); ?>" />
									</a>
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

	<section class="service-detail-2 section-py">
		<div class="container-fluid">
			<div class="wrapper rem:max-w-[1000px] w-full mx-auto">
				<div class="format-content pl-10 border-l-2 border-l-Primary-1 body-1 font-normal">
					<?php the_content(); ?>
				</div>
			</div>
		</div>
	</section>
	<?php 
            $tabs = get_field('service_tabs');
            if($tabs):
            ?>
	<section class="service-detail-3 section-py bg-[#F3F3FD]">
		<div class="container-fluid">

			<div class="wrap-tabslet" data-toggle="tabslet">
				<div class="wrap-heading mb-base">
					<ul class="tabslet-tab nav-primary">
						<?php foreach($tabs as $index => $tab): ?>
						<li class="<?php echo $index === 0 ? 'active' : ''; ?>">
							<a href="#tab-service-<?php echo $index; ?>"><?php echo esc_html($tab['tab_title']); ?></a>
						</li>
						<?php endforeach; ?>
					</ul>
				</div>

				<?php foreach($tabs as $index => $tab): 
                    $t_heading = $tab['tab_heading'];
                    $t_content = $tab['tab_content'];
                    $t_img = $tab['tab_image'];
                    $t_sub_heading = $tab['tab_sub_heading'];
					$sub_content = $tab['tab_sub_content'];
                ?>
				<div class="tabslet-content <?php echo $index === 0 ? 'active' : ''; ?>"
					id="tab-service-<?php echo $index; ?>">
					<div class="wrap-content mb-base">
						<?php if($t_heading): ?>
						<h2 class="title heading-1 text-Primary-1 font-bold mb-8"><?php echo esc_html($t_heading); ?>
						</h2>
						<?php endif; ?>
						<?php if($t_content): ?>
						<div class="sub-title body-1 font-normal"><?php echo $t_content; ?></div>
						<?php endif; ?>
					</div>
					<div class="wrapper grid md:grid-cols-2 grid-cols-1 items-center xl:gap-20 gap-base">
						<div class="col-left">
							<?php if($t_img): ?>
							<div class="img">
								<a class="img-ratio ratio:pt-[480_820]" href="<?php echo esc_url($t_img['url']); ?>"
									data-fancybox>
									<img class="lozad" data-src="<?php echo esc_url($t_img['url']); ?>"
										alt="<?php echo esc_attr($t_img['alt']); ?>" />
								</a>
							</div>
							<?php endif; ?>
						</div>
						<div class="col-right">
							<?php if($t_sub_heading): ?>
							<div class="title heading-40 font-light mb-base"><?php echo esc_html($t_sub_heading); ?>
							</div>
							<?php endif; ?>
							<?php if($sub_content): ?>
							<div class="sub_content flex flex-col gap-3">
								<?php echo wp_kses_post(wpautop($sub_content)); ?>
							</div>
							<?php endif; ?>
						</div>
					</div>
				</div>
				<?php endforeach; ?>
			</div>
		</div>
	</section>
	<?php endif; ?>

	<?php 
    // Other Services Query
    $args_other = array(
        'post_type' => 'linh-vuc',
        'posts_per_page' => 6,
        'post__not_in' => array(get_the_ID())
    );
    $query_other = new WP_Query($args_other);
    if($query_other->have_posts()):
    ?>
	<section class="service-detail-4 section-py">
		<div class="container-fluid">
			<div class="wrap-heading mb-base flex items-center justify-between">
				<h2 class="title heading-1 text-Primary-1 font-bold"><?php _e('Other Services', 'canhcamtheme'); ?></h2>
				<div class="arrow-button flex items-center gap-3">
					<div class="btn btn-sw-1 btn-prev"></div>
					<div class="btn btn-sw-1 btn-next"></div>
				</div>
			</div>
			<div class="field-op">
				<div class="swiper swiper-field-op">
					<ul class="swiper-wrapper field-op-list">
						<?php while($query_other->have_posts()): $query_other->the_post(); 
                             $thumb_url = get_the_post_thumbnail_url(get_the_ID(), 'full');
                             $excerpt = get_the_excerpt();
                        ?>
						<li
							class="swiper-slide field-op-item relative rem:!h-[480px] overflow-hidden group transition-500">
							<div class="thumb img-full w-full h-full">
								<?php if($thumb_url): ?>
								<img class="lozad" data-src="<?php echo esc_url($thumb_url); ?>"
									alt="<?php the_title(); ?>" />
								<?php else: ?>
								<img class="lozad"
									data-src="<?php echo get_template_directory_uri(); ?>/img/default-service.jpg"
									alt="<?php the_title(); ?>" />
								<?php endif; ?>
							</div>
							<div
								class="wrap-content-top absolute top-0 left-0 md:p-8 p-4 w-full flex items-center justify-between gap-4">
								<h3 class="title heading-3 font-bold transition-all-500-linear text-white">
									<?php the_title(); ?></h3>
								<a class="icon" href="<?php the_permalink(); ?>"> </a>
							</div>
							<div
								class="info absolute bottom-0 left-0 z-2 w-full md:p-7 p-4 text-white transition-all-500-linear">
								<div class="content body-1 mt-2.25 xl:opacity-0 xl:invisible transition-all-500-linear">
									<p><?php echo wp_trim_words($excerpt, 30); ?></p>
								</div>
							</div>
						</li>
						<?php endwhile; wp_reset_postdata(); ?>
					</ul>
				</div>
			</div>
		</div>
	</section>
	<?php endif; ?>

	<?php endwhile; ?>
</main>

<?php get_footer(); ?>