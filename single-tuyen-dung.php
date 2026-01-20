<?php get_header(); ?>
<?php include get_template_directory() . '/modules/common/banner.php'; ?>

<section class="section-recruitment-detail section-py">
	<div class="container-1600">
		<div class="recruitment-detail grid grid-cols-12 gap-base">
			<div class="block-main-content relative col-span-full lg:col-span-8">
				<h1 class="detail-title text-Primary-1 heading-1 font-bold pb-4 border-b border-utility-gray-200">
					<?php the_title(); ?></h1>
				<div class="main-detail-content mt-6 flex flex-col gap-base">
					<?php if(have_rows('recruitment_content')): ?>
					<?php while(have_rows('recruitment_content')): the_row(); ?>

					<div class="block-content flex flex-col gap-y-5">
						<?php if(get_sub_field('title')): ?>
						<h2 class="heading-3 text-Primary-1 font-bold uppercase"><?php the_sub_field('title'); ?></h2>
						<?php endif; ?>
						<div class="format-content">
							<?php the_sub_field('content'); ?>
						</div>
					</div>
					<?php endwhile; ?>
					<?php endif; ?>
				</div>
				<!-- <div class="social xl:absolute xl:right-full xl:top-0 -xl:mt-4 xl:mr-4.5 xl:h-full">
					<ul class="social-list sticky rem:top-[calc(var(--header-height)+12px)]">
						<li class="social-item">
							<a class="flex-center w-10 h-10 bg-Primary-2 text-base text-white rounded-full"
								href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(get_permalink()); ?>"
								target="_blank" rel="noopener noreferrer">
								<i class="fa-brands fa-facebook-f"></i>
							</a>
						</li>
					</ul>
				</div> -->
			</div>
			<div class="recruitment-detail-action col-span-full lg:col-span-4">
				<div class="sticky top-[var(--header-height)]">
					<div class="block-apply p-8 bg-Primary-1 text-white rounded-5 ">
						<h2 class="apply-title heading-3 text-white"><?php _e('Information', 'canhcamtheme'); ?></h2>
						<ul class="apply-list">
							<?php $information = get_field('information'); ?>
							<?php if($information) : ?>
							<?php if($information['application_deadline']) : ?>
							<li
								class="apply-item flex items-center gap-x-6 py-3 border-b border-white border-opacity-30">
								<span class="icon w-10 h-auto">
									<svg width="28" height="32" viewBox="0 0 28 32" fill="none"
										xmlns="http://www.w3.org/2000/svg">
										<path opacity="0.4"
											d="M7 0C7.5 0 8 0.5 8 1V4H20V1C20 0.5 20.4375 0 21 0C21.5 0 22 0.5 22 1V4H24C26.1875 4 28 5.8125 28 8V28C28 30.25 26.1875 32 24 32H4C1.75 32 0 30.25 0 28V8C0 5.8125 1.75 4 4 4H6V1C6 0.5 6.4375 0 7 0ZM26 12H2V28C2 29.125 2.875 30 4 30H24C25.0625 30 26 29.125 26 28V12ZM24 6H4C2.875 6 2 6.9375 2 8V10H26V8C26 6.9375 25.0625 6 24 6Z"
											fill="white" />
									</svg>
								</span>
								<div class="block-content text-white flex flex-col gap-y-1"><span
										class="top-content body-4"><?php _e('Expiration date', 'canhcamtheme'); ?></span><span
										class="bottom-content body-1"><?php echo $information['application_deadline']; ?></span>
								</div>
							</li>
							<?php endif; ?>
							<?php if($information['salary']) : ?>
							<li
								class="apply-item flex items-center gap-x-6 py-3 border-b border-white border-opacity-30">
								<span class="icon w-10 h-auto">
									<svg width="19" height="32" viewBox="0 0 19 32" fill="none"
										xmlns="http://www.w3.org/2000/svg">
										<path opacity="0.4"
											d="M10.1875 4.0625C12.125 4.25 14 4.625 15.375 5C15.9375 5.125 16.25 5.625 16.125 6.1875C16 6.75 15.4375 7.0625 14.9375 6.9375C12.875 6.4375 9.8125 5.8125 7.125 6.0625C5.8125 6.1875 4.6875 6.4375 3.875 7C3.0625 7.5625 2.5 8.3125 2.25 9.5C2.0625 10.4375 2.1875 11.125 2.4375 11.625C2.6875 12.1875 3.125 12.625 3.8125 13.0625C5.1875 13.9375 7.1875 14.4375 9.4375 15.0625H9.5C11.625 15.625 13.9375 16.25 15.5625 17.3125C16.4375 17.875 17.1875 18.5625 17.6875 19.5C18.125 20.5 18.25 21.625 18.0625 22.875C17.625 25 16.125 26.4375 14.125 27.25C12.9375 27.6875 11.625 27.9375 10.1875 28V31C10.1875 31.5625 9.6875 32 9.1875 32C8.625 32 8.1875 31.5625 8.1875 31V27.9375C7.75 27.875 7.375 27.875 7 27.8125C5.3125 27.5625 2.875 27 0.75 26.0625C0.25 25.875 0 25.25 0.25 24.75C0.4375 24.25 1.0625 24 1.5625 24.25C3.4375 25.0625 5.75 25.5625 7.25 25.8125C9.6875 26.1875 11.8125 26 13.375 25.375C14.9375 24.75 15.8125 23.8125 16.0625 22.5C16.25 21.5625 16.125 20.9375 15.875 20.375C15.625 19.875 15.1875 19.375 14.5 19C13.125 18.125 11.125 17.5625 8.875 17L8.8125 16.9375C6.6875 16.375 4.375 15.8125 2.75 14.75C1.875 14.1875 1.125 13.4375 0.625 12.5C0.1875 11.5625 0.0625 10.4375 0.25 9.125C0.625 7.375 1.5 6.1875 2.75 5.3125C4 4.5625 5.5 4.1875 7 4.0625C7.375 4 7.75 4 8.1875 4V1C8.1875 0.5 8.625 0 9.1875 0C9.6875 0 10.1875 0.5 10.1875 1V4.0625Z"
											fill="white" />
									</svg>
								</span>
								<div class="block-content text-white flex flex-col gap-y-1"><span
										class="top-content body-4"><?php _e('Salary', 'canhcamtheme'); ?></span><span
										class="bottom-content body-1"><?php echo $information['salary']; ?></span>
								</div>
							</li>
							<?php endif; ?>
							<?php if($information['gender']) : ?>
							<li
								class="apply-item flex items-center gap-x-6 py-3 border-b border-white border-opacity-30">
								<span class="icon w-10 h-auto">
									<svg width="28" height="32" viewBox="0 0 28 32" fill="none"
										xmlns="http://www.w3.org/2000/svg">
										<path opacity="0.4"
											d="M14 16C9.5625 16 6 12.4375 6 8C6 3.625 9.5625 0 14 0C18.375 0 22 3.625 22 8C22 12.4375 18.375 16 14 16ZM14 2C10.6875 2 8 4.75 8 8C8 11.3125 10.6875 14 14 14C17.25 14 20 11.3125 20 8C20 4.75 17.25 2 14 2ZM17.125 19C23.125 19 28 23.875 28 29.875C28 31.0625 27 32 25.8125 32H2.125C0.9375 32 0 31.0625 0 29.875C0 23.875 4.8125 19 10.8125 19H17.125ZM25.8125 30C25.875 30 26 29.9375 26 29.875C26 25 22 21 17.125 21H10.8125C5.9375 21 2 25 2 29.875C2 29.9375 2.0625 30 2.125 30H25.8125Z"
											fill="white" />
									</svg>
								</span>
								<div class="block-content flex flex-col gap-y-1"><span
										class="top-content text-body-3"><?php _e('Gender', 'canhcamtheme'); ?></span><span
										class="bottom-content body-1"><?php echo $information['gender']; ?></span>
								</div>
							</li>
							<?php endif; ?>
							<?php if($information['experience']) : ?>
							<li
								class="apply-item flex items-center gap-x-6 py-3 border-b border-white border-opacity-30">
								<span class="icon w-10 h-auto">
									<svg width="40" height="32" viewBox="0 0 40 32" fill="none"
										xmlns="http://www.w3.org/2000/svg">
										<path opacity="0.4"
											d="M31 14C35.9375 14 40 18.0625 40 23C40 28 35.9375 32 31 32C26 32 22 28 22 23C22 18.0625 26 14 31 14ZM31 30C34.8125 30 38 26.875 38 23C38 19.1875 34.8125 16 31 16C27.125 16 24 19.1875 24 23C24 26.875 27.125 30 31 30ZM34 22C34.5 22 35 22.5 35 23C35 23.5625 34.5 24 34 24H31C30.4375 24 30 23.5625 30 23V19C30 18.5 30.4375 18 31 18C31.5 18 32 18.5 32 19V22H34ZM21 28C21.5 28 22 28.5 22 29C22 29.5625 21.5 30 21 30H4C1.75 30 0 28.25 0 26V10C0 7.8125 1.75 6 4 6H8V3C8 1.375 9.3125 0 11 0H21C22.625 0 24 1.375 24 3V6H28C30.1875 6 32 7.8125 32 10V11C32 11.5625 31.5 12 31 12C30.4375 12 30 11.5625 30 11V10C30 8.9375 29.0625 8 28 8H4C2.875 8 2 8.9375 2 10V16H21C21.5 16 22 16.5 22 17C22 17.5625 21.5 18 21 18H13V21H19C19.5 21 20 21.5 20 22C20 22.5625 19.5 23 19 23H12C11.4375 23 11 22.5625 11 22V18H2V26C2 27.125 2.875 28 4 28H21ZM10 3V6H22V3C22 2.5 21.5 2 21 2H11C10.4375 2 10 2.5 10 3Z"
											fill="white" />
									</svg>
								</span>
								<div class="block-content flex flex-col gap-y-1"><span
										class="top-content text-body-3"><?php _e('Experience', 'canhcamtheme'); ?></span><span
										class="bottom-content body-1"><?php echo $information['experience']; ?></span>
								</div>
							</li>
							<?php endif; ?>
							<?php if($information['language']) : ?>
							<li
								class="apply-item flex items-center gap-x-6 py-3 border-b border-white border-opacity-30">
								<span class="icon w-10 h-auto">
									<svg width="40" height="32" viewBox="0 0 40 32" fill="none"
										xmlns="http://www.w3.org/2000/svg">
										<path opacity="0.4"
											d="M0 16C0 7.1875 7.125 0 16 0C24.8125 0 32 7.1875 32 16C32 24.875 24.8125 32 16 32C7.125 32 0 24.875 0 16ZM16 30C22.6875 30 28.3125 25.3125 29.6875 19L26.8125 18.25C25.8125 18 25 17.25 24.6875 16.3125L23.625 13.125C23.125 11.625 23.875 10 25.375 9.375L27.75 8.4375C25.3125 4.625 21.0625 2.125 16.1875 2.0625L16.625 2.8125C17.25 3.9375 17.125 5.3125 16.3125 6.25L15.0625 7.6875C14.875 7.875 14.875 8.1875 15.0625 8.375L16.1875 9.6875C16.8125 10.4375 16.875 11.5 16.3125 12.3125C15.75 13.125 14.75 13.5 13.8125 13.1875L12.25 12.6875C12.125 12.625 11.9375 12.625 11.8125 12.6875C11.5625 12.875 11.4375 13.1875 11.5625 13.5L11.625 13.5625C11.6875 13.6875 11.8125 13.8125 11.9375 13.875L14.8125 15.3125C15.0625 15.4375 15.375 15.5 15.6875 15.5H18.75C19.8125 15.5 20.8125 15.9375 21.5625 16.6875L21.8125 16.9375C22.5625 17.6875 23 18.6875 23 19.75V20.3125C23 21.75 22.1875 23.0625 20.9375 23.75L20.25 24.1875C19.6875 24.5 19.25 25.0625 19.0625 25.6875L18.8125 26.8125C18.5 28.125 17.3125 29 15.9375 29C14.3125 29 13 27.6875 13 26.0625V24.625C13 24.3125 12.8125 24.0625 12.5 23.9375C11.5625 23.4375 11 22.5 11 21.4375V20.5C11 19.4375 10.3125 18.5625 9.3125 18.25L5.375 17C4 16.5625 2.875 15.625 2.3125 14.25L2.125 13.875C2 14.5625 2 15.3125 2 16C2 23.75 8.25 30 16 30ZM3 10.8125L4.125 13.4375C4.5 14.25 5.1875 14.875 6 15.125L9.9375 16.375C11.75 16.9375 13 18.5625 13 20.5V21.4375C13 21.6875 13.125 22 13.4375 22.125C14.375 22.625 15 23.5625 15 24.625V26.0625C15 26.625 15.375 27 15.9375 27C16.375 27 16.75 26.75 16.875 26.3125L17.125 25.1875C17.4375 24.0625 18.1875 23.0625 19.25 22.4375L19.9375 22C20.5625 21.6875 21 21 21 20.3125V19.75C21 19.25 20.75 18.75 20.375 18.375L20.125 18.125C19.75 17.75 19.25 17.5 18.75 17.5H15.6875C15.0625 17.5 14.4375 17.375 13.875 17.125L11 15.6875C10.5 15.4375 10.0625 15 9.8125 14.5V14.375C9.125 13.125 9.6875 11.5625 10.9375 10.9375C11.5625 10.625 12.25 10.5625 12.9375 10.8125L14.4375 11.3125C14.5 11.3125 14.625 11.3125 14.625 11.1875C14.6875 11.125 14.6875 11.0625 14.625 11L13.5 9.625C12.75 8.6875 12.75 7.3125 13.5625 6.4375L14.8125 4.9375C15.0625 4.625 15.125 4.1875 14.875 3.8125L14 2.1875C8.9375 2.875 4.8125 6.25 3 10.8125ZM28.6875 10.1875L26.0625 11.25C25.625 11.4375 25.375 12 25.5 12.5L26.5625 15.6875C26.6875 16 26.9375 16.25 27.25 16.3125L29.9375 17C29.9375 16.6875 30 16.375 30 16C30 13.9375 29.5 12 28.6875 10.1875Z"
											fill="white" />
									</svg>
								</span>
								<div class="block-content flex flex-col gap-y-1"><span
										class="top-content text-body-3"><?php _e('Language', 'canhcamtheme'); ?></span><span
										class="bottom-content body-1"><?php echo $information['language']; ?></span>
								</div>
							</li>
							<?php endif; ?>
							<?php if($information['other']) : ?>
							<?php foreach($information['other'] as $item) : ?>
							<li
								class="apply-item flex items-center gap-x-6 py-3 border-b border-white border-opacity-30">
								<span class="icon w-10 h-auto">
									<img src="<?php echo $item['icon']['url']; ?>"
										alt="<?php echo $item['icon']['alt']; ?>">
								</span>
								<div class="block-content flex flex-col gap-y-1"><span
										class="top-content text-body-3"><?php echo $item['title']; ?></span><span
										class="bottom-content body-1"><?php echo $item['description']; ?></span>
								</div>
							</li>
							<?php endforeach; ?>
							<?php endif; ?>
							<?php endif; ?>
						</ul>
						<a href="#form-requirement" data-fancybox data-src="#form-requirement"
							class="btn w-full px-6 py-3.5 mt-3 btn-secondary "
							id="apply-now-btn"><?php _e('Ứng tuyển ngay', 'canhcamtheme'); ?></a>


					</div>
					<div class="block-similar-jobs rounded-5 p-5 shadow-[4px_4px_32px_16px_rgba(0,0,0,0.08)] mt-base">
						<h2 class="similar-jobs-title heading-3 text-Primary-1">
							<?php _e('Similar Jobs', 'canhcamtheme'); ?></h2>
						<ul class="similar-jobs-list">
							<?php
                            // Get current post ID
                            $current_post_id = get_the_ID();
                            
                            // Query to get 5 newest tuyen-dung posts excluding current one
                            $args = array(
                                'post_type' => 'tuyen-dung',
                                'posts_per_page' => 5,
                                'post__not_in' => array($current_post_id),
                                'orderby' => 'date',
                                'order' => 'DESC'
                            );
                            
                            $similar_jobs = new WP_Query($args);
                            
                            if ($similar_jobs->have_posts()) :
                                while ($similar_jobs->have_posts()) : $similar_jobs->the_post();
                                    $information = get_field('information');
                                    $dealine = $information['application_deadline'];
                                    // $dealine = date('d/m/Y', strtotime($dealine));
                                    ?>
							<li class="similar-jobs-item group py-5 border-b border-utility-gray-100">
								<h3
									class="title heading-4 mt-2.5 line-clamp-2 transition-300 group-hover:text-primary-2">
									<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
								</h3>
								<span class="date text-[#818181]"><?php _e('Hạn nộp:', 'canhcamtheme'); ?>
									<?php echo $dealine; ?></span>
							</li>
							<?php endwhile;
                                wp_reset_postdata();
                            else: ?>
							<li class="similar-jobs-item py-5">
								<p class="body-1"><?php _e('No similar jobs found', 'canhcamtheme'); ?></p>
							</li>
							<?php endif; ?>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- <div class="fixed z-[1001] w-full top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2" id="popup-applyNow">
	<div class="container-1600 relative">
		<div
			class="wrap-popup-applyNow absolute-center w-[calc(100%-30px)] md:w-[calc(1026/1600*100%)] flex flex-col gap-y-4 p-5 -md:pt-7 md:p-10 bg-white mx-auto">
			<div
				class="btn-close absolute right-0 top-0 flex-center w-7 h-7 md:w-10 md:h-10 bg-Primary-2 text-base md:text-xl text-white cursor-pointer">
				<i class="fa-light fa-xmark"></i>
			</div><span class="popup-applyNow-title heading-3 -md:heading-4"><?php the_title(); ?></span>
			<p class="subtitle text-body-1">
				<?php _e('Contact us for more information and be a part of the wonderful journey', 'canhcamtheme'); ?>
			</p>
			<?php if(get_field('career_form','option')) :
                $form = get_field('career_form','option');
                echo do_shortcode($form);
            endif; ?>
		</div>
	</div>
</div> -->

<div id="form-requirement" style="display: none;" data-fancybox-modal>

	<div class="wrap-popup-applyNow popup-content w-full relative z-50">
		<h3 class="title-job text-5xl text-Neutral-Black font-light mb-10"><?php echo get_the_title(); ?></h3>
		<?php $job_title = get_the_title(); 
        echo do_shortcode($form); ?>
	</div>

</div>



<?php get_footer(); ?>