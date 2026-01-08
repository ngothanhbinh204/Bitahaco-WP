<!-- <?php
    $banner_image = '';
    $banner_alt = '';
    $banner_title = '';

    // 1. Xác định Context (Page, Post, hay Category/Taxonomy)
    $queried_object = get_queried_object();
    $acf_id = false;

    if ( $queried_object ) {
        if ( isset($queried_object->taxonomy) ) {
            // Là Category / Taxonomy
            $acf_id = $queried_object->taxonomy . '_' . $queried_object->term_id;
            $banner_title = single_term_title('', false);
        } elseif ( isset($queried_object->post_type) ) {
            // Là Post / Page
            $acf_id = $queried_object->ID;
            $banner_title = get_the_title($acf_id);
        }
    }
    
    // Fallback: nếu không xác định được (ví dụ trang 404), dùng ID hiện tại
    if ( !$acf_id ) {
        $acf_id = get_the_ID();
        $banner_title = get_the_title();
    }

    // 2. Lấy Banner từ ACF
    $banners = get_field('banner_select_page', $acf_id);

    // Ưu tiên lấy từ Banner CPT được chọn
    if ($banners) {
        $banner_post = is_array($banners) ? $banners[0] : $banners;
        if ($banner_post) {
            $banner_image = get_the_post_thumbnail_url($banner_post->ID, 'full');
            $thumb_id = get_post_thumbnail_id($banner_post->ID);
            $banner_alt = get_post_meta($thumb_id, '_wp_attachment_image_alt', true);
            
            // Nếu muốn override title bằng title của Banner Post thì mở comment dưới
            // $banner_title = get_the_title($banner_post->ID); 
        }
    } else {
        // Fallback: Lấy Featured Image (Thumbnail) của đối tượng hiện tại
        // Nếu là Term (Category), cần plugin hỗ trợ hoặc logic riêng, default ACF không có thumbnail cho term core.
        // Ở đây ta fallback về thumbnail của bài viết nếu là bài viết.
        
        if ( !empty($queried_object->post_type) && has_post_thumbnail($queried_object->ID) ) {
             $banner_image = get_the_post_thumbnail_url($queried_object->ID, 'full');
             $thumb_id = get_post_thumbnail_id($queried_object->ID);
             $banner_alt = get_post_meta($thumb_id, '_wp_attachment_image_alt', true);
        }
    }
?>

<section class="section-banner-secondary">
    <div class="block-banner img-ratio ratio:pt-[1_2] md:ratio:pt-[640_1920]"> 
        <?php if($banner_image): ?>
        <img class="lozad" data-src="<?php echo esc_url($banner_image); ?>" alt="<?php echo esc_attr($banner_alt); ?>"/>
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
</section> -->