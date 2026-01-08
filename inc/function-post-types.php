<?php

/**
 * Register Custom Post Type for Cổ đông
 */
function create_co_dong_post_type() {
    $labels = array(
        'name'                  => __('Cổ đông', 'canhcamtheme'),
        'singular_name'         => __('Cổ đông', 'canhcamtheme'),
        'menu_name'             => __('Cổ đông', 'canhcamtheme'),
        'name_admin_bar'        => __('Cổ đông', 'canhcamtheme'),
        'archives'              => __('Lưu trữ Cổ đông', 'canhcamtheme'),
        'attributes'            => __('Thuộc tính Cổ đông', 'canhcamtheme'),
        'parent_item_colon'     => __('Cổ đông cha:', 'canhcamtheme'),
        'all_items'             => __('Tất cả Cổ đông', 'canhcamtheme'),
        'add_new_item'          => __('Thêm Cổ đông mới', 'canhcamtheme'),
        'add_new'               => __('Thêm mới', 'canhcamtheme'),
        'new_item'              => __('Cổ đông mới', 'canhcamtheme'),
        'edit_item'             => __('Sửa Cổ đông', 'canhcamtheme'),
        'update_item'           => __('Cập nhật Cổ đông', 'canhcamtheme'),
        'view_item'             => __('Xem Cổ đông', 'canhcamtheme'),
        'view_items'            => __('Xem các Cổ đông', 'canhcamtheme'),
        'search_items'          => __('Tìm kiếm Cổ đông', 'canhcamtheme'),
        'not_found'             => __('Không tìm thấy', 'canhcamtheme'),
        'not_found_in_trash'    => __('Không tìm thấy trong thùng rác', 'canhcamtheme'),
        'featured_image'        => __('Ảnh đại diện', 'canhcamtheme'),
        'set_featured_image'    => __('Đặt ảnh đại diện', 'canhcamtheme'),
        'remove_featured_image' => __('Xóa ảnh đại diện', 'canhcamtheme'),
        'use_featured_image'    => __('Sử dụng làm ảnh đại diện', 'canhcamtheme'),
        'insert_into_item'      => __('Chèn vào Cổ đông', 'canhcamtheme'),
        'uploaded_to_this_item' => __('Đã tải lên cho Cổ đông này', 'canhcamtheme'),
        'items_list'            => __('Danh sách Cổ đông', 'canhcamtheme'),
        'items_list_navigation' => __('Điều hướng danh sách Cổ đông', 'canhcamtheme'),
        'filter_items_list'     => __('Lọc danh sách Cổ đông', 'canhcamtheme'),
    );
    
    $args = array(
        'labels'              => $labels,
        'public'              => true,
        'publicly_queryable'  => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'query_var'           => true,
        'rewrite'             => array('slug' => 'co-dong'),
        'capability_type'     => 'post',
        'has_archive'         => true,
        'hierarchical'        => false,
        'menu_position'       => null,
        'supports'            => array('title', 'editor', 'thumbnail', 'excerpt'),
        'menu_icon'           => 'dashicons-groups',
        'taxonomies'          => array('co-dong-category'),
    );

    register_post_type('co-dong', $args);
    
    // Register taxonomy for Cổ đông
    $taxonomy_labels = array(
        'name'              => __('Danh mục Cổ đông', 'canhcamtheme'),
        'singular_name'     => __('Danh mục Cổ đông', 'canhcamtheme'),
        'search_items'      => __('Tìm kiếm Danh mục', 'canhcamtheme'),
        'all_items'         => __('Tất cả Danh mục', 'canhcamtheme'),
        'parent_item'       => __('Danh mục cha', 'canhcamtheme'),
        'parent_item_colon' => __('Danh mục cha:', 'canhcamtheme'),
        'edit_item'         => __('Sửa Danh mục', 'canhcamtheme'),
        'update_item'       => __('Cập nhật Danh mục', 'canhcamtheme'),
        'add_new_item'      => __('Thêm Danh mục mới', 'canhcamtheme'),
        'new_item_name'     => __('Tên Danh mục mới', 'canhcamtheme'),
        'menu_name'         => __('Danh mục', 'canhcamtheme'),
    );

    $taxonomy_args = array(
        'labels'            => $taxonomy_labels,
        'hierarchical'      => true,
        'public'            => true,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array('slug' => 'danh-muc-co-dong'),
    );

    register_taxonomy('co-dong-category', array('co-dong'), $taxonomy_args);
}
add_action('init', 'create_co_dong_post_type');

// Register Tuyển Dụng Custom Post Type
function create_tuyen_dung_post_type() {
    $labels = array(
        'name'                  => __('Tuyển Dụng', 'canhcamtheme'),
        'singular_name'         => __('Tuyển Dụng', 'canhcamtheme'),
        'menu_name'             => __('Tuyển Dụng', 'canhcamtheme'),
        'name_admin_bar'        => __('Tuyển Dụng', 'canhcamtheme'),
        'archives'              => __('Lưu trữ Tuyển Dụng', 'canhcamtheme'),
        'attributes'            => __('Thuộc tính Tuyển Dụng', 'canhcamtheme'),
        'parent_item_colon'     => __('Tuyển Dụng cha:', 'canhcamtheme'),
        'all_items'             => __('Tất cả Tuyển Dụng', 'canhcamtheme'),
        'add_new_item'          => __('Thêm Tuyển Dụng mới', 'canhcamtheme'),
        'add_new'               => __('Thêm mới', 'canhcamtheme'),
        'new_item'              => __('Tuyển Dụng mới', 'canhcamtheme'),
        'edit_item'             => __('Sửa Tuyển Dụng', 'canhcamtheme'),
        'update_item'           => __('Cập nhật Tuyển Dụng', 'canhcamtheme'),
        'view_item'             => __('Xem Tuyển Dụng', 'canhcamtheme'),
        'view_items'            => __('Xem các Tuyển Dụng', 'canhcamtheme'),
        'search_items'          => __('Tìm kiếm Tuyển Dụng', 'canhcamtheme'),
        'not_found'             => __('Không tìm thấy', 'canhcamtheme'),
        'not_found_in_trash'    => __('Không tìm thấy trong thùng rác', 'canhcamtheme'),
        'featured_image'        => __('Ảnh đại diện', 'canhcamtheme'),
        'set_featured_image'    => __('Đặt ảnh đại diện', 'canhcamtheme'),
        'remove_featured_image' => __('Xóa ảnh đại diện', 'canhcamtheme'),
        'use_featured_image'    => __('Sử dụng làm ảnh đại diện', 'canhcamtheme'),
        'insert_into_item'      => __('Chèn vào Tuyển Dụng', 'canhcamtheme'),
        'uploaded_to_this_item' => __('Đã tải lên cho Tuyển Dụng này', 'canhcamtheme'),
        'items_list'            => __('Danh sách Tuyển Dụng', 'canhcamtheme'),
        'items_list_navigation' => __('Điều hướng danh sách Tuyển Dụng', 'canhcamtheme'),
        'filter_items_list'     => __('Lọc danh sách Tuyển Dụng', 'canhcamtheme'),
    );
    
    $args = array(
        'labels'              => $labels,
        'public'              => true,
        'publicly_queryable'  => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'query_var'           => true,
        'rewrite'             => array('slug' => 'tuyen-dung'),
        'capability_type'     => 'post',
        'has_archive'         => false,
        'hierarchical'        => false,
        'menu_position'       => null,
        'supports'            => array('title', 'editor' , 'thumbnail', 'excerpt'),
        'menu_icon'           => 'dashicons-businessman',
    );

    register_post_type('tuyen-dung', $args);
}
add_action('init', 'create_tuyen_dung_post_type');

/**
 * Register Custom Post Type: Lĩnh vực hoạt động
 */
function create_linh_vuc_post_type() {
    $labels = array(
        'name'                  => __('Lĩnh vực hoạt động', 'canhcamtheme'),
        'singular_name'         => __('Lĩnh vực', 'canhcamtheme'),
        'menu_name'             => __('Lĩnh vực hoạt động', 'canhcamtheme'),
        'name_admin_bar'        => __('Lĩnh vực hoạt động', 'canhcamtheme'),
        'archives'              => __('Lưu trữ Lĩnh vực', 'canhcamtheme'),
        'attributes'            => __('Thuộc tính Lĩnh vực', 'canhcamtheme'),
        'parent_item_colon'     => __('Lĩnh vực cha:', 'canhcamtheme'),
        'all_items'             => __('Tất cả Lĩnh vực', 'canhcamtheme'),
        'add_new_item'          => __('Thêm Lĩnh vực mới', 'canhcamtheme'),
        'add_new'               => __('Thêm mới', 'canhcamtheme'),
        'new_item'              => __('Lĩnh vực mới', 'canhcamtheme'),
        'edit_item'             => __('Sửa Lĩnh vực', 'canhcamtheme'),
        'update_item'           => __('Cập nhật Lĩnh vực', 'canhcamtheme'),
        'view_item'             => __('Xem Lĩnh vực', 'canhcamtheme'),
        'view_items'            => __('Xem các Lĩnh vực', 'canhcamtheme'),
        'search_items'          => __('Tìm kiếm Lĩnh vực', 'canhcamtheme'),
        'not_found'             => __('Không tìm thấy', 'canhcamtheme'),
        'not_found_in_trash'    => __('Không tìm thấy trong thùng rác', 'canhcamtheme'),
        'featured_image'        => __('Ảnh đại diện', 'canhcamtheme'),
        'set_featured_image'    => __('Đặt ảnh đại diện', 'canhcamtheme'),
        'remove_featured_image' => __('Xóa ảnh đại diện', 'canhcamtheme'),
        'use_featured_image'    => __('Sử dụng làm ảnh đại diện', 'canhcamtheme'),
        'insert_into_item'      => __('Chèn vào Lĩnh vực', 'canhcamtheme'),
        'uploaded_to_this_item' => __('Đã tải lên cho Lĩnh vực này', 'canhcamtheme'),
        'items_list'            => __('Danh sách Lĩnh vực', 'canhcamtheme'),
        'items_list_navigation' => __('Điều hướng danh sách Lĩnh vực', 'canhcamtheme'),
        'filter_items_list'     => __('Lọc danh sách Lĩnh vực', 'canhcamtheme'),
    );
    
    $args = array(
        'labels'              => $labels,
        'public'              => true,
        'publicly_queryable'  => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'query_var'           => true,
        'rewrite'             => array('slug' => 'linh-vuc'),
        'capability_type'     => 'post',
        'has_archive'         => true,
        'hierarchical'        => false,
        'menu_position'       => null,
        'supports'            => array('title', 'editor', 'thumbnail', 'excerpt'),
        'menu_icon'           => 'dashicons-hammer',
    );

    register_post_type('linh-vuc', $args);
}
add_action('init', 'create_linh_vuc_post_type');