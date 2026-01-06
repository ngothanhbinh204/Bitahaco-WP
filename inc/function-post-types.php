<?php
/**
 * Register Custom Post Type: Dự án
 */
function create_du_an_post_type() {
    $labels = array(
        'name'                  => __('Dự án', 'canhcamtheme'),
        'singular_name'         => __('Dự án', 'canhcamtheme'),
        'menu_name'             => __('Dự án', 'canhcamtheme'),
        'name_admin_bar'        => __('Dự án', 'canhcamtheme'),
        'archives'              => __('Lưu trữ Dự án', 'canhcamtheme'),
        'attributes'            => __('Thuộc tính Dự án', 'canhcamtheme'),
        'parent_item_colon'     => __('Dự án cha:', 'canhcamtheme'),
        'all_items'             => __('Tất cả Dự án', 'canhcamtheme'),
        'add_new_item'          => __('Thêm Dự án mới', 'canhcamtheme'),
        'add_new'               => __('Thêm mới', 'canhcamtheme'),
        'new_item'              => __('Dự án mới', 'canhcamtheme'),
        'edit_item'             => __('Sửa Dự án', 'canhcamtheme'),
        'update_item'           => __('Cập nhật Dự án', 'canhcamtheme'),
        'view_item'             => __('Xem Dự án', 'canhcamtheme'),
        'view_items'            => __('Xem các Dự án', 'canhcamtheme'),
        'search_items'          => __('Tìm kiếm Dự án', 'canhcamtheme'),
        'not_found'             => __('Không tìm thấy', 'canhcamtheme'),
        'not_found_in_trash'    => __('Không tìm thấy trong thùng rác', 'canhcamtheme'),
        'featured_image'        => __('Ảnh đại diện', 'canhcamtheme'),
        'set_featured_image'    => __('Đặt ảnh đại diện', 'canhcamtheme'),
        'remove_featured_image' => __('Xóa ảnh đại diện', 'canhcamtheme'),
        'use_featured_image'    => __('Sử dụng làm ảnh đại diện', 'canhcamtheme'),
        'insert_into_item'      => __('Chèn vào Dự án', 'canhcamtheme'),
        'uploaded_to_this_item' => __('Đã tải lên cho Dự án này', 'canhcamtheme'),
        'items_list'            => __('Danh sách Dự án', 'canhcamtheme'),
        'items_list_navigation' => __('Điều hướng danh sách Dự án', 'canhcamtheme'),
        'filter_items_list'     => __('Lọc danh sách Dự án', 'canhcamtheme'),
    );
    
    $args = array(
        'labels'              => $labels,
        'public'              => true,
        'publicly_queryable'  => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'query_var'           => true,
        'rewrite'             => array('slug' => 'du-an'),
        'capability_type'     => 'post',
        'has_archive'         => true,
        'hierarchical'        => false,
        'menu_position'       => null,
        'supports'            => array('title', 'editor', 'thumbnail', 'excerpt'),
        'menu_icon'           => 'dashicons-portfolio',
    );

    register_post_type('du-an', $args);
}
add_action('init', 'create_du_an_post_type');

/**
 * Register Custom Post Type for Tin cổ đông
 */
function create_co_dong_post_type() {
    $labels = array(
        'name'                  => __('Tin cổ đông', 'canhcamtheme'),
        'singular_name'         => __('Tin cổ đông', 'canhcamtheme'),
        'menu_name'             => __('Tin cổ đông', 'canhcamtheme'),
        'name_admin_bar'        => __('Tin cổ đông', 'canhcamtheme'),
        'archives'              => __('Lưu trữ Tin cổ đông', 'canhcamtheme'),
        'attributes'            => __('Thuộc tính Tin cổ đông', 'canhcamtheme'),
        'parent_item_colon'     => __('Tin cổ đông cha:', 'canhcamtheme'),
        'all_items'             => __('Tất cả Tin cổ đông', 'canhcamtheme'),
        'add_new_item'          => __('Thêm Tin cổ đông mới', 'canhcamtheme'),
        'add_new'               => __('Thêm mới', 'canhcamtheme'),
        'new_item'              => __('Tin cổ đông mới', 'canhcamtheme'),
        'edit_item'             => __('Sửa Tin cổ đông', 'canhcamtheme'),
        'update_item'           => __('Cập nhật Tin cổ đông', 'canhcamtheme'),
        'view_item'             => __('Xem Tin cổ đông', 'canhcamtheme'),
        'view_items'            => __('Xem các Tin cổ đông', 'canhcamtheme'),
        'search_items'          => __('Tìm kiếm Tin cổ đông', 'canhcamtheme'),
        'not_found'             => __('Không tìm thấy', 'canhcamtheme'),
        'not_found_in_trash'    => __('Không tìm thấy trong thùng rác', 'canhcamtheme'),
        'featured_image'        => __('Ảnh đại diện', 'canhcamtheme'),
        'set_featured_image'    => __('Đặt ảnh đại diện', 'canhcamtheme'),
        'remove_featured_image' => __('Xóa ảnh đại diện', 'canhcamtheme'),
        'use_featured_image'    => __('Sử dụng làm ảnh đại diện', 'canhcamtheme'),
        'insert_into_item'      => __('Chèn vào Tin cổ đông', 'canhcamtheme'),
        'uploaded_to_this_item' => __('Đã tải lên cho Tin cổ đông này', 'canhcamtheme'),
        'items_list'            => __('Danh sách Tin cổ đông', 'canhcamtheme'),
        'items_list_navigation' => __('Điều hướng danh sách Tin cổ đông', 'canhcamtheme'),
        'filter_items_list'     => __('Lọc danh sách Tin cổ đông', 'canhcamtheme'),
    );
    
    $args = array(
        'labels'              => $labels,
        'public'              => true,
        'publicly_queryable'  => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'query_var'           => true,
        'rewrite'             => array('slug' => 'quan-he-co-dong'),
        'capability_type'     => 'post',
        'has_archive'         => true,
        'hierarchical'        => false,
        'menu_position'       => null,
        'supports'            => array('title', 'editor', 'thumbnail', 'excerpt'),
        'menu_icon'           => 'dashicons-groups',
        'taxonomies'          => array('co-dong-category'),
    );

    register_post_type('co-dong', $args);
    
    // Register taxonomy for Tin cổ đông
    $taxonomy_labels = array(
        'name'              => __('Danh mục Tin cổ đông', 'canhcamtheme'),
        'singular_name'     => __('Danh mục Tin cổ đông', 'canhcamtheme'),
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
        'has_archive'         => true,
        'hierarchical'        => false,
        'menu_position'       => null,
        'supports'            => array('title', 'editor' , 'thumbnail', 'excerpt'),
        'menu_icon'           => 'dashicons-businessman',
    );

    register_post_type('tuyen-dung', $args);
}
add_action('init', 'create_tuyen_dung_post_type');