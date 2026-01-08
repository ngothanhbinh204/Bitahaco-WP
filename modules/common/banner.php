<?php
$queried_object = get_queried_object();
$id_category = 0;
$taxonomy = '';

// Kiểm tra nếu là Term (Danh mục)
if ($queried_object instanceof WP_Term) {
    $id_category = $queried_object->term_id;
    $taxonomy = $queried_object->taxonomy;
}

$banner_image = '';
$banner_alt = '';
$banner_title = '';
$banners = false;

// Xử lý logic cho từng loại trang
if ($id_category) {
    // Trang taxonomy/category
    $id = $taxonomy . '_' . $id_category;
    $banners = get_field('banner_select_page', $id);
    $banner_title = $queried_object->name;
} elseif (is_post_type_archive()) {
    // Trang Archive Post Type
    $banner_title = post_type_archive_title('', false);
    
    // Trường hợp đặc biệt: Archive Cổ đông dùng banner từ Option Page
    if (is_post_type_archive('co-dong')) {
        $banner_option = get_field('shareholder_banner', 'option');
        if ($banner_option) {
            $banner_image = isset($banner_option['url']) ? $banner_option['url'] : '';
            $banner_alt = isset($banner_option['alt']) ? $banner_option['alt'] : '';
        }
    }
} elseif (is_home()) {
    // Trang Blog
    $id = get_option('page_for_posts');
    $banners = get_field('banner_select_page', $id);
    $banner_title = get_the_title($id);
} else {
    // Trang đơn (Page/Single)
    $id = get_the_ID();
    $banners = get_field('banner_select_page', $id);
    $banner_title = get_the_title();
}

    // Ưu tiên lấy từ Banner CPT được chọn (nếu chưa có ảnh từ option)
    if (empty($banner_image) && $banners) {
        // Lấy banner đầu tiên nếu chọn nhiều
        $banner_post = is_array($banners) ? $banners[0] : $banners;
        if ($banner_post) {
            $banner_image = get_the_post_thumbnail_url($banner_post->ID, 'full');
            $thumb_id = get_post_thumbnail_id($banner_post->ID);
            $banner_alt = get_post_meta($thumb_id, '_wp_attachment_image_alt', true);
            // $banner_title = get_the_title($banner_post->ID); 
			// $banner_title = get_the_title();
        }
    } 
    
    // Fallback: Lấy Featured Image của Page hiện tại nếu chưa có banner
    if (empty($banner_image) && is_singular() && has_post_thumbnail()) {
        $banner_image = get_the_post_thumbnail_url(get_the_ID(), 'full');
        $thumb_id = get_post_thumbnail_id(get_the_ID());
        $banner_alt = get_post_meta($thumb_id, '_wp_attachment_image_alt', true);
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