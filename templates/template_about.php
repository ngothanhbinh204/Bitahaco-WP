<?php
/**
 * Template Name: Giới thiệu
 */
get_header(); 

$anchors = get_field('about_menu_anchors');

$id_section_intro = get_field('id_section_intro') ?: '';
$id_section_vision = get_field('id_section_vision') ?: '';
$id_section_history = get_field('id_section_history') ?: '';
$id_section_chart = get_field('id_section_chart') ?: '';
$id_section_management = get_field('id_section_management') ?: '';
$id_section_partners = get_field('id_section_partner') ?: '';
$id_section_award = get_field('id_section_award') ?: '';
	

?>

<main>
	<?php include get_template_directory() . '/modules/common/banner.php'; ?>
	<?php if($anchors): ?>
	<section class="section-scrollTo-active" id="menu-spy">
		<div class="container-fluid">
			<ul>
				<?php foreach($anchors as $anchor): ?>
				<li> <a
						href="#<?php echo esc_attr($anchor['anchor_id']); ?>"><?php echo esc_html($anchor['anchor_label']); ?></a>
				</li>
				<?php endforeach; ?>
			</ul>
		</div>
	</section>
	<?php endif; ?>

	<?php
    $intro_title = get_field('about_intro_title');
    $intro_content = get_field('about_intro_content');
    $intro_gallery = get_field('about_intro_gallery');
    ?>
	<section class="section-introduce-2 section-py bg-[#F3F3FD]" id="<?php echo esc_attr($id_section_intro); ?>">
		<div class="wrap-container max-w-full w-full xl:rem:px-[111px] px-[16px] mx-auto">
			<div class="wrapper flex items-center xl:gap-0 gap-base">
				<div class="col-left lg:w-6/12 xl:pr-[1.4rem]">
					<?php if($intro_title): ?>
					<h2 class="title heading-1 text-Primary-1 font-bold mb-base"><?php echo esc_html($intro_title); ?>
					</h2>
					<?php endif; ?>
					<?php if($intro_content): ?>
					<div class="format-content body-1 font-normal">
						<?php echo $intro_content; ?>
					</div>
					<?php endif; ?>
				</div>
				<?php if($intro_gallery): ?>
				<div class="col-right lg:w-6/12 xl:pl-[8.7rem] xl:mr-[2.2rem]">
					<div class="swiper slider-introduce relative">
						<div class="swiper-wrapper">
							<?php foreach($intro_gallery as $img): ?>
							<div class="swiper-slide">
								<div class="img img-ratio ratio:pt-[453_680]">
									<img class="lozad" data-src="<?php echo esc_url($img['url']); ?>"
										alt="<?php echo esc_attr($img['alt']); ?>" />
								</div>
							</div>
							<?php endforeach; ?>
						</div>
						<div class="wrap-button-slide">
							<div class="btn btn-sw-1 btn-prev"></div>
							<div class="btn btn-sw-1 btn-next"></div>
						</div>
					</div>
				</div>
				<?php endif; ?>
			</div>
		</div>
	</section>

	<?php
    $stats_title = get_field('about_stats_title');
    $stats_list = get_field('about_stats_list');
    if($stats_list):
    ?>
	<section class="section-introduce-3 section-py">
		<div class="container-fluid">
			<?php if($stats_title): ?>
			<h2 class="title heading-1 text-Primary-1 font-bold mb-base text-center">
				<?php echo esc_html($stats_title); ?></h2>
			<?php endif; ?>
			<div class="wrapper grid lg:grid-cols-4 grid-cols-2 gap-base">
				<?php foreach($stats_list as $stat): 
                    $s_icon = $stat['stat_icon'];
                ?>
				<div
					class="item rounded-5 bg-Utility-gray-50 xl:px-8 xl:py-7 p-5 rem:w-[480px] xl:rem:h-[320px] h-full">
					<div class="wrap-count-top">
						<div class="icon sq-20 inline-flex items-center justify-center rem:px-[10px] rem:py-[12px]">
							<?php if($s_icon): ?><img class="img-svg" src="<?php echo esc_url($s_icon['url']); ?>"
								alt="" /><?php endif; ?>
						</div>
						<div class="count-statistical flex heading-banner text-Primary-3 font-bold tabular-nums">
							<span class="countup"
								data-number="<?php echo esc_attr($stat['stat_number']); ?>"></span><span><?php echo esc_html($stat['stat_suffix']); ?></span>
						</div>
						<div class="title heading-4 font-semibold text-Utility-gray-950-maintext">
							<?php echo esc_html($stat['stat_label']); ?></div>
					</div>
					<div class="home-about-info">
						<div class="desc">
							<p><?php echo esc_html($stat['stat_desc']); ?></p>
						</div>
					</div>
				</div>
				<?php endforeach; ?>
			</div>
		</div>
	</section>
	<?php endif; ?>

	<?php
    $vis_bg = get_field('about_vision_bg');
    $vis_list = get_field('about_vision_list');
    if($vis_list):
    ?>
	<section class="section-introduce-4 section-py" id="<?php echo esc_attr($id_section_vision); ?>"
		<?php echo $vis_bg ? 'setBackground="'.esc_url($vis_bg['url']).'"' : ''; ?>>
		<div class="container">
			<div class="wrapper grid grid-cols-2 gap-base">
				<?php foreach($vis_list as $vis): 
                    $v_icon = $vis['vision_icon'];
                ?>
				<div class="item flex flex-col justify-center items-center text-center">
					<div class="icon mb-5 sq-24 inline-flex items-center justify-center">
						<?php if($v_icon): ?><img class="img-svg w-full h-full object-contain"
							src="<?php echo esc_url($v_icon['url']); ?>" alt=""><?php endif; ?>
					</div>
					<div class="content mt-5">
						<div class="title heading-2 text-Primary-1 font-bold mb-5">
							<?php echo esc_html($vis['vision_title']); ?></div>
						<div class="desc body-1 font-normal">
							<p><?php echo wp_kses_post($vis['vision_desc']); ?></p>
						</div>
					</div>
				</div>
				<?php endforeach; ?>
			</div>
		</div>
	</section>
	<?php endif; ?>

	<?php
    $his_title = get_field('about_history_title');
    $his_list = get_field('about_history_list');
    if($his_list):
    ?>
	<section class="section-his-formation section-py bg-Primary-1" id="<?php echo esc_attr($id_section_history); ?>">
		<div class="container-fluid default-container-js">
			<div class="his-formation flex flex-col gap-base">
				<?php if($his_title): ?>
				<h2 class="text-white font-bold heading-1 text-center"><?php echo esc_html($his_title); ?></h2>
				<?php endif; ?>
				<div class="block-his-formation-slide relative" stick-to-edge="right" unstick-min="1024">
					<div class="swiper swiper-his-formation w-full">
						<ul class="swiper-wrapper">
							<?php foreach($his_list as $his): 
                                $h_img = $his['history_image'];
                            ?>
							<li class="swiper-slide history-item">
								<div
									class="child grid md:grid-cols-[41.21%_1fr] grid-cols-1 items-center rounded-6 overflow-hidden p-4 md:p-0">
									<div class="img-thumb img-ratio">
										<?php if($h_img): ?><img class="lozad"
											data-src="<?php echo esc_url($h_img['url']); ?>" alt="" /><?php endif; ?>
									</div>
									<div class="block-info -md:pt-5 md:pl-10 lg:rem:pl-[53px] text-white lg:pr-10 pr-4">
										<h3 class="history-title heading-banner font-bold mb-4">
											<?php echo esc_html($his['history_year']); ?></h3>
										<p class="history-desc body-2 font-normal">
											<?php echo wp_kses_post($his['history_desc']); ?>
										</p>
									</div>
								</div>
							</li>
							<?php endforeach; ?>
						</ul>
					</div>
					<div class="wrap-button-slide">
						<div class="btn btn-sw-1 btn-prev secondary"></div>
						<div class="btn btn-sw-1 btn-next secondary"></div>
					</div>
				</div>
				<div class="swiper swiper-thumb-timeline w-full relative">
					<ul class="swiper-wrapper timeline-list">
						<?php foreach($his_list as $his): ?>
						<li class="swiper-slide timeline-item">
							<div class="child group flex items-center flex-col gap-y-4 select-none cursor-pointer ">
								<span
									class="icon-round flex-center bg-transparent w-7 h-7 rounded-full transition-300 before:content-[''] before:block before:w-2 before:h-2 before:rounded-full before:bg-white"></span>
							</div>
						</li>
						<?php endforeach; ?>
					</ul>
				</div>
			</div>
		</div>
	</section>
	<?php endif; ?>

	<?php
    $chart_title = get_field('about_chart_title');
    $chart_img = get_field('about_chart_image');
    if($chart_img):
    ?>
	<section class="section-introduce-6 section-py" id="<?php echo esc_attr($id_section_chart); ?>">
		<div class="container-fluid">
			<?php if($chart_title): ?>
			<h2 class="title heading-1 text-Primary-1 text-center font-bold mb-base">
				<?php echo esc_html($chart_title); ?></h2>
			<?php endif; ?>
			<div class="img-chart">
				<div class="img img-ratio ratio:pt-[413_1426]">
					<img class="lozad" data-src="<?php echo esc_url($chart_img['url']); ?>"
						alt="<?php echo esc_attr($chart_title); ?>" />
				</div>
			</div>
		</div>
	</section>
	<?php endif; ?>

	<?php
    $manage_title = get_field('about_manage_title');
    $manage_groups = get_field('about_manage_groups');
    if($manage_groups):
    ?>
	<section class="section-introduce-7 section-py" id="<?php echo esc_attr($id_section_management); ?>">
		<div class="container-fluid">
			<h2 class="title heading-1 text-Primary-1 text-center font-bold mb-base">
				<?php echo $manage_title ? esc_html($manage_title) : 'Ban lãnh đạo'; ?></h2>
			<div class="wrapper-main rem:max-w-[1320px] w-full mx-auto flex flex-col gap-base">
				<?php foreach($manage_groups as $group): ?>
				<div class="column col-12" data-aos="fade-up" data-aos-delay="200">
					<div class="title-role heading-3 text-Primary-3 text-center font-bold mb-5">
						<?php echo esc_html($group['group_title']); ?></div>
					<?php if($group['group_members']): ?>
					<div class="row justify-center w-full">
						<?php foreach($group['group_members'] as $member): 
                             $mem_img = $member['member_image'];
                        ?>
						<div class="item-manage group col-lg-4">
							<div class="item-inner p-5 bg-white rounded-6 overflow-hidden">
								<div class="img img-ratio zoom-img rounded-4">
									<?php if($mem_img): ?>
									<img class="lozad" data-src="<?php echo esc_url($mem_img['url']); ?>"
										alt="<?php echo esc_attr($member['member_name']); ?>" />
									<?php endif; ?>
								</div>
								<div class="content pt-6 text-center">
									<div class="title-wrapper">
										<div class="title heading-3 font-bold text-Primary-1">
											<?php echo esc_html($member['member_name']); ?></div>
									</div>
									<div class="role mt-2 text-Primary-3 font-normal">
										<?php echo esc_html($member['member_role']); ?></div>
								</div>
							</div>
						</div>
						<?php endforeach; ?>
					</div>
					<?php endif; ?>
				</div>
				<?php endforeach; ?>
			</div>
		</div>
	</section>
	<?php endif; ?>

	<?php
    $part_title = get_field('about_partner_title');
    $part_desc = get_field('about_partner_desc');
    $part_list = get_field('about_partner_list');
    if($part_list):
    ?>
	<section class="sectionn-parter section-py" id="<?php echo esc_attr($id_section_partners); ?>"
		setBackground="<?php echo get_template_directory_uri(); ?>/UI/img/bg-partner.png">
		<div class="container-fluid">
			<div class="wrap-heading rem:max-w-[1000px] w-full text-center mb-base mx-auto">
				<h2 class="title heading-1 text-Primary-1 font-bold mb-4">
					<?php echo $part_title ? esc_html($part_title) : 'Khách hàng - Đối tác'; ?></h2>
				<?php if($part_desc): ?>
				<div class="desc body-1 font-normal">
					<p><?php echo wp_kses_post($part_desc); ?></p>
				</div>
				<?php endif; ?>
			</div>
			<div class="slide-top">
				<div class="swiper">
					<div class="swiper-wrapper">
						<?php foreach($part_list as $part): ?>
						<div class="swiper-slide">
							<div class="item-logo">
								<div class="img img-ratio">
									<img class="lozad" data-src="<?php echo esc_url($part['partner_logo']['url']); ?>"
										alt="" />
								</div>
							</div>
						</div>
						<?php endforeach; ?>
					</div>
				</div>
			</div>
			<div class="slide-bottom">
				<div class="swiper">
					<div class="swiper-wrapper">
						<?php foreach($part_list as $part): ?>
						<div class="swiper-slide">
							<div class="item-logo">
								<div class="img img-ratio">
									<img class="lozad" data-src="<?php echo esc_url($part['partner_logo']['url']); ?>"
										alt="" />
								</div>
							</div>
						</div>
						<?php endforeach; ?>
					</div>
				</div>
			</div>
		</div>
	</section>
	<?php endif; ?>

	<?php
    $awar_title = get_field('about_award_title');
    $awar_desc = get_field('about_award_desc');
    $awar_list = get_field('about_award_list');
    if($awar_list):
    ?>
	<section class="section-introduce-9 section-py" id="<?php echo esc_attr($id_section_award); ?>">
		<div class="container-fluid">
			<div class="wrap-heading text-center mb-base">
				<h2 class="title heading-1 font-bold text-Primary-1 mb-4">
					<?php echo $awar_title ? esc_html($awar_title) : 'Bằng khen - Giải thưởng'; ?></h2>
				<?php if($awar_desc): ?>
				<div class="desc body-2 font-normal">
					<p><?php echo wp_kses_post($awar_desc); ?> </p>
				</div>
				<?php endif; ?>
			</div>
			<div class="swiper-column-auto relative swiper-loop autoplay">
				<div class="swiper">
					<div class="swiper-wrapper">
						<?php foreach($awar_list as $aw): 
                            $a_img = $aw['award_image'];
                        ?>
						<div class="swiper-slide">
							<div class="item-award rounded-6 bg-Utility-gray-50 p-4 group">
								<div class="img">
									<?php if($a_img): ?>
									<a class="img-ratio ratio:pt-[260_368] rounded-5 zoom-img"
										href="<?php echo esc_url($a_img['url']); ?>" data-fancybox>
										<img class="lozad" data-src="<?php echo esc_url($a_img['url']); ?>"
											alt="<?php echo esc_attr($aw['award_title']); ?>" />
									</a>
									<?php endif; ?>
								</div>
								<div class="content mt-6 text-center">
									<div class="title heading-4 font-semibold group-hover:text-Primary-3"> <a
											href="#"><?php echo esc_html($aw['award_title']); ?></a></div>
								</div>
							</div>
						</div>
						<?php endforeach; ?>
					</div>
				</div>
				<div class="arrow-button flex-center mt-base gap-2">
					<div class="btn btn-sw-1 btn-prev"></div>
					<div class="btn btn-sw-1 btn-next"></div>
				</div>
			</div>
		</div>
	</section>
	<?php endif; ?>
</main>

<?php get_footer(); ?>