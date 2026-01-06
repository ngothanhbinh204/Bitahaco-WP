<?php
$id_category = get_queried_object()->term_id;
$taxonomy = get_queried_object()->taxonomy;
if ($id_category) {
	$id = $taxonomy . '_' . $id_category;
} else {
	$id = get_the_ID();
}
    $banners = get_field('banner_select_page', $id);
    $banner_image = '';
    $banner_alt = '';
    $banner_title = get_the_title();

    // Ưu tiên lấy từ Banner CPT được chọn
    if ($banners) {
        // Lấy banner đầu tiên nếu chọn nhiều
        $banner_post = is_array($banners) ? $banners[0] : $banners;
        if ($banner_post) {
            $banner_image = get_the_post_thumbnail_url($banner_post->ID, 'full');
            $thumb_id = get_post_thumbnail_id($banner_post->ID);
            $banner_alt = get_post_meta($thumb_id, '_wp_attachment_image_alt', true);
            // $banner_title = get_the_title($banner_post->ID); 
			// $banner_title = get_the_title();
        }
    } else {
        // Fallback: Lấy Featured Image của Page hiện tại nếu không chọn Banner
        if (has_post_thumbnail()) {
            $banner_image = get_the_post_thumbnail_url(get_the_ID(), 'full');
            $thumb_id = get_post_thumbnail_id(get_the_ID());
            $banner_alt = get_post_meta($thumb_id, '_wp_attachment_image_alt', true);
        }
    }
?>

<section class="section-banner-secondary">
	<div class="block-banner img-ratio ratio:pt-[1_2] md:ratio:pt-[640_1920]">
		<?php if($banner_image): ?>
		<img class="lozad" data-src="<?php echo esc_url($banner_image); ?>"
			alt="<?php echo esc_attr($banner_alt); ?>" />
		<?php endif; ?>
		<div class="content">
			<div class="container-fluid">
				<h2 class="title"><?php echo esc_html($banner_title); ?></h2>
				<div class="global-breadcrumb">
					<?php if(function_exists('rank_math_the_breadcrumbs')) rank_math_the_breadcrumbs(); ?>
				</div>
			</div>
		</div>
	</div>
</section>