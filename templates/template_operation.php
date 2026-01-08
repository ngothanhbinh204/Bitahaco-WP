<?php
/**
 * Template Name: Lĩnh vực hoạt động
 */
?>

<?php get_header(); ?>

<?php echo get_template_part('modules/common/banner'); ?>

<?php 
// Lấy ID của trang Home để truy xuất dữ liệu
$home_id = get_option('page_on_front');
// Nếu chưa set page_on_front, tìm theo template
if (!$home_id) {
    $pages = get_pages(array(
        'meta_key' => '_wp_page_template',
        'meta_value' => 'templates/template_home.php',
        'number' => 1
    ));
    if ($pages) {
        $home_id = $pages[0]->ID;
    }
}
?>

<?php if (get_field('home_field_operation_enable', $home_id)): ?>
<?php
        $field_title = get_field('home_field_operation_title', $home_id);
        $field_desc = get_field('home_field_operation_description', $home_id);
        $field_items = get_field('home_field_operation_items', $home_id);
        ?>
<section class="section-field-op py-10">
	<div class="container-fluid">
		<div class="field-op">
			<div class="wrap-heading rem:max-w-[1000px] w-full mx-auto text-center mb-base">
				<?php if ($field_title): ?>
				<h2 class="title heading-1 text-Primary-1 font-bold mb-4" data-aos="fade-up" data-aos-delay="100"
					data-aos-duration="1000"><?php echo esc_html($field_title); ?></h2>
				<?php endif; ?>
				<!-- <?php if ($field_desc): ?>
				<div class="desc body-1 font-normal" data-aos="fade-up" data-aos-delay="200" data-aos-duration="1000">
					<p><?php echo esc_html($field_desc); ?></p>
				</div>
				<?php endif; ?> -->
			</div>
			<?php if ($field_items): ?>
			<div class="swiper swiper-field-op" data-aos="zoom-in" data-aos-delay="300" data-aos-duration="1000">
				<ul class="swiper-wrapper field-op-list">
					<?php foreach ($field_items as $item): 
                                $bg_img = $item['field_image'];
                                $title = $item['field_title'];
                                $desc = $item['field_description'];
                                $link = $item['link'];
                            ?>
					<li
						class="swiper-slide field-op-item relative xl:flex-1 rem:!h-[480px] overflow-hidden group transition-500">
						<div class="thumb img-full w-full h-full">
							<img class="lozad" data-src="<?php echo esc_url($bg_img['url']); ?>"
								alt="<?php echo esc_attr($title); ?>" />
						</div>
						<div
							class="wrap-content-top absolute top-0 left-0 p-8 w-full flex items-center justify-between gap-4">
							<h3 class="title heading-3 font-bold transition-all-500-linear text-white">
								<?php echo esc_html($title); ?></h3>
							<a class="icon" href="<?php echo $link ? esc_url($link['url']) : '#'; ?>"
								target="<?php echo $link ? esc_attr($link['target']) : ''; ?>"> </a>
						</div>
						<div class="info absolute bottom-0 left-0 z-2 w-full p-7 text-white transition-all-500-linear">
							<div class="content body-1 mt-2.25 xl:opacity-0 xl:invisible transition-all-500-linear">
								<p><?php echo wp_kses_post( $desc ); ?></p>
							</div>
						</div>
					</li>
					<?php endforeach; ?>
				</ul>
			</div>
			<?php endif; ?>
		</div>
	</div>
</section>
<?php endif; ?>


<?php get_footer(); ?>