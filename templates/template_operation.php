<?php
/**
 * Template Name: Lĩnh vực hoạt động
 */
get_header();

echo get_template_part('modules/common/banner');

$title_page = get_the_title();
?>

<section class="section-field-op py-10">
	<div class="container-fluid">
		<div class="field-op">
			<div class="wrap-heading rem:max-w-[1000px] w-full mx-auto text-center mb-base">
				<h2 class="title heading-1 text-Primary-1 font-bold mb-4" data-aos="fade-up" data-aos-delay="100"
					data-aos-duration="1000">
					<?php echo esc_html($title_page); ?>
				</h2>
			</div>

			<?php
            $args = array(
                'post_type'      => 'linh-vuc',   
                'posts_per_page' => -1,             
                'post_status'    => 'publish',
                'orderby'        => 'menu_order title',
                'order'          => 'ASC',
            );

            $all_fields_query = new WP_Query($args);

            if ($all_fields_query->have_posts()):
            ?>
			<div class="swiper swiper-field-op" data-aos="zoom-in" data-aos-delay="300" data-aos-duration="1000">
				<ul class="swiper-wrapper field-op-list">
					<?php while ($all_fields_query->have_posts()): $all_fields_query->the_post(); 
                        $bg_img_url = get_the_post_thumbnail_url(get_the_ID(), 'full') ?: '';
                        $title      = get_the_title();
                        $desc       = $post->post_excerpt;

                        if (empty($desc)) {
                            $desc = wp_trim_words(get_the_content(), 999, '...');
                        }
                        $expert_custom = get_field('service_intro_text', get_the_ID());
                        if ($expert_custom) {
                            $desc = $expert_custom;
                        }

                        $link = get_permalink();
                    ?>
					<li
						class="swiper-slide field-op-item relative xl:flex-1 rem:!h-[480px] overflow-hidden group transition-500">
						<?php if ($bg_img_url): ?>
						<div class="thumb img-full w-full h-full">
							<img class="lozad" data-src="<?php echo esc_url($bg_img_url); ?>"
								alt="<?php echo esc_attr($title); ?>" />
						</div>
						<?php endif; ?>

						<div
							class="wrap-content-top absolute top-0 left-0 p-8 w-full flex items-center justify-between gap-4">
							<h3 class="title heading-3 font-bold transition-all-500-linear text-white">
								<?php echo esc_html($title); ?>
							</h3>
							<a class="icon" href="<?php echo esc_url($link); ?>"
								aria-label="Xem chi tiết <?php echo esc_attr($title); ?>"></a>
						</div>

						<?php if ($desc): ?>
						<div class="info absolute bottom-0 left-0 z-2 w-full p-7 text-white transition-all-500-linear">
							<div class="content body-1 mt-2.25 xl:opacity-0 xl:invisible transition-all-500-linear">
								<p><?php echo wp_kses_post($desc); ?></p>
							</div>
						</div>
						<?php endif; ?>
					</li>
					<?php endwhile; ?>
				</ul>
			</div>
			<?php 
                wp_reset_postdata();
            else: 
            ?>
			<p class="text-center"><?php _e('Chưa có lĩnh vực hoạt động nào.', 'canhcamtheme'); ?></p>
			<?php endif; ?>
		</div>
	</div>
</section>

<?php get_footer(); ?>