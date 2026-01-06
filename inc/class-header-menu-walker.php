<?php
/**
 * Custom Menu Walker for Header Menu
 * - Hỗ trợ icon house cho menu item đầu tiên
 * - Active states cho current page và ancestors
 * - Submenu unlimited depth
 */
class Header_Menu_Walker extends Walker_Nav_Menu {
    
    // Biến đếm để xác định item đầu tiên
    private $item_counter = 0;
    
    function start_lvl(&$output, $depth = 0, $args = array()) {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<ul class=\"sub-menu\">\n";
    }

    function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
        $indent = ($depth) ? str_repeat("\t", $depth) : '';

        // Tăng counter cho mỗi item (chỉ đếm ở level 0)
        if ($depth === 0) {
            $this->item_counter++;
        }

        $classes = empty($item->classes) ? array() : (array) $item->classes;
        $classes[] = 'menu-item-' . $item->ID;
        
        // Add active classes
        if ($item->current) {
            $classes[] = 'current-menu-item active';
        }
        if ($item->current_item_ancestor) {
            $classes[] = 'current-menu-ancestor active';
        }
        if ($item->current_item_parent) {
            $classes[] = 'current-menu-parent active';
        }

        // Check if item has children
        if (in_array('menu-item-has-children', $classes)) {
            $classes[] = 'has-dropdown';
        }

        $args = apply_filters('nav_menu_item_args', $args, $item, $depth);
        
        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args, $depth));
        $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';

        $id = apply_filters('nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args, $depth);
        $id = $id ? ' id="' . esc_attr($id) . '"' : '';

        $output .= $indent . '<li' . $id . $class_names .'>';

        // Link attributes
        $atts = array();
        $atts['title']  = !empty($item->attr_title) ? $item->attr_title : '';
        $atts['target'] = !empty($item->target) ? $item->target : '';
        $atts['rel']    = !empty($item->xfn) ? $item->xfn : '';
        $atts['href']   = !empty($item->url) ? $item->url : '';

        $atts = apply_filters('nav_menu_link_attributes', $atts, $item, $args, $depth);

        $attributes = '';
        foreach ($atts as $attr => $value) {
            if (!empty($value)) {
                $value = ('href' === $attr) ? esc_url($value) : esc_attr($value);
                $attributes .= ' ' . $attr . '="' . $value . '"';
            }
        }

        $title = apply_filters('the_title', $item->title, $item->ID);
        
        $item_output = $args->before;
        $item_output .= '<a'. $attributes .'>';
        
        // LOGIC CHO ICON HOUSE Ở ITEM ĐẦU TIÊN
        if ($depth === 0 && $this->item_counter === 1) {
            // Item đầu tiên ở level 0 → Hiển thị ICON thay vì text
            $item_output .= '<i class="fa-light fa-house"></i>';
        } else {
            // Các item còn lại → Hiển thị title bình thường
            $item_output .= $args->link_before . $title . $args->link_after;
        }
        
        $item_output .= '</a>';
        $item_output .= $args->after;

        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }
}