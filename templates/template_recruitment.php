<?php
/*
 Template Name: Tuyển dụng
 */
get_header(); ?>

<?php include get_template_directory() . '/modules/common/banner.php'; ?>
<?php 
$intro = get_field('career_intro'); 
if($intro) :
    $title = isset($intro['title']) ? $intro['title'] : '';
    $description = isset($intro['description']) ? $intro['description'] : '';
?>
<section class="section-recruitment section-py !pb-10 relative">
	<div class="container-fluid">
		<div class="recruitment">
			<div class="recruitment-introduce w-full lg:w-1/2">
				<?php if($title) : ?>
				<h2 class="title heading-1 text-Primary-1"><?php echo $title; ?></h2>
				<?php endif; ?>
				<?php if($description) : ?>
				<div class="desc mt-5 body-1"><?php echo $description; ?></div>
				<?php endif; ?>
			</div>
		</div>
	</div>
	<!-- <img class="absolute right-[8%] bottom-0 w-[120px] md:w-[180px] lg:rem:w-[361px] lg:rem:h-[274px]"
		src="<?php echo get_stylesheet_directory_uri(); ?>/img/bg-recruitment-list-1.svg"> -->
</section>
<?php endif; ?>

<?php 
$image = get_field('career_image');
if($image) :
?>
<section class="section-journey">
	<div class="journey relative">
		<div class="hero-img img-ratio ratio:pt-[760_1920]"><img class="lozad"
				data-src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
		</div>
	</div>
</section>
<?php endif; ?>

<section class="section-career-opportunities section-py">
	<div class="container-fluid">
		<div class="career-opportunities flex flex-col gap-base">
			<h2 class="career-opportunities-title heading-1 text-center text-Primary-1 font-bold">
				<?php _e('Cơ hội nghề nghiệp', 'canhcamtheme'); ?></h2>
			<div class="block-job-tb">
				<table class="job-tb w-full">
					<thead class="-md:hidden">
						<tr class="row-title uppercase body-1 text-white bg-Primary-2">
							<th class="w-[calc(70/1600*100%)] font-normal p-1.5">STT</th>
							<th class="w-[calc(676/1600*100%)] font-normal text-left py-3 px-4">
								<?php _e('Tiêu đề', 'canhcamtheme'); ?></th>
							<th class="w-[calc(285/1600*100%)] font-normal text-center py-3 px-4 whitespace-nowrap">
								<?php _e('HẠN NỘP HỒ SƠ', 'canhcamtheme'); ?></th>
							<th class="w-[calc(285/1600*100%)] font-normal text-center py-3 px-4">
								<?php _e('ĐỊA ĐIỂM', 'canhcamtheme'); ?></th>
							<th class="w-[calc(285/1600*100%)] font-normal py-3 px-4"></th>
						</tr>
					</thead>
					<tbody id="career-list" class="-md:flex -md:flex-col -md:gap-y-3" data-per-page="10" data-current-page="<?php echo $paged; ?>">

						<?php
                        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                        $args = array(
                            'post_type' => 'tuyen-dung',
                            'posts_per_page' => 10,
                            'post_status' => 'publish',
                            'paged' => $paged
                        );
                        $query = new WP_Query($args);
                        $count = ($paged - 1) * 10 + 1;
                        if ($query->have_posts()) :
                            while ($query->have_posts()) : $query->the_post();
                                $information = get_field('information');
                                $location = isset($information['location']) ? $information['location'] : '';
                                $deadline = isset($information['application_deadline']) ? $information['application_deadline'] : '';
                                // Format deadline? User sample: 15/07/2025.
                        ?>
						<tr
							class="row-job -md:grid -md:grid-cols-1 -md:p-2 body-1 -md:rounded-1 border border-Utility-gray-100">
							<td class="text-center -md:hidden"><?php echo sprintf("%02d", $count); ?></td>
							<td class="p-2 px-4 py-2 md:py-3 -md:font-semibold"><?php the_title(); ?></td>
							<td class="p-2 px-4 py-2 md:py-3 -md:order-3"><?php echo $deadline; ?></td>
							<td class="p-2 px-4 py-2 md:py-3"><?php echo $location; ?></td>
							<td class="p-2 px-4 py-2 md:py-3 -md:order-4">
								<div class="flex-center h-full -md:justify-start"><a
										class="flex items-center gap-x-2.5 text-Utility-gray-500"
										href="<?php the_permalink(); ?>"> <span
											class="body-1"><?php _e('Ứng tuyển ngay', 'canhcamtheme'); ?> </span><i
											class="fa-light fa-angle-right text-base"></i></a></div>
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
            $total_posts = $query->found_posts;
            if ($total_posts > 10) :
            ?>
			<div class="flex justify-center" id="load-more-container">
				<a class="btn-primary btn" href="" id="load-more-btn"> <span
						data-text="<?php _e('Tìm hiểu thêm', 'canhcamtheme'); ?>"><?php _e('Tìm hiểu thêm', 'canhcamtheme'); ?></span></a>
			</div>
			<?php endif; ?>
		</div>
	</div>
</section>

<?php get_footer(); ?>