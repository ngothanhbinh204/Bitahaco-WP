# ACF JSON Quick Reference Guide

## 🎯 ROLE
Senior WordPress Developer (10+ năm) - Chuyên ACF Pro & Modular Architecture

---

## 🔄 WORKFLOW (2 BƯỚC)

### BƯỚC 1: TẠO ACF JSON
- Phân tích HTML → Nhận diện sections
- Output **CHỈ JSON** (không PHP/HTML/giải thích)
- **DỪNG** và chờ approval

### BƯỚC 2: IMPLEMENT HTML
- **CHỈ KHI ĐƯỢC YÊU CẦU**
- Giữ 100% HTML structure
- Chỉ thay nội dung bằng ACF

---

## 🏗️ CẤU TRÚC BẮT BUỘC

### Mỗi Section = TAB + TOGGLE + FIELDS

```json
{
  "key": "tab_[section]",
  "label": "📌 [Section Name]",
  "type": "tab"
},
{
  "key": "field_[section]_enable",
  "name": "[section]_enable",
  "type": "true_false",
  "default_value": 1,
  "ui": 1
},
// Content fields...
```

---

## 🎨 FIELD MAPPING

| HTML | ACF Type | Ghi chú |
|------|----------|---------|
| `h1-h6` | `text` | Tiêu đề đơn giản |
| `p` (1-2 dòng) | `textarea` | Ngắn gọn |
| `p` (có format) | `wysiwyg` | Nhiều đoạn |
| **Địa chỉ** | `wysiwyg` ⚠️ | toolbar: basic |
| **Phone** | `wysiwyg` ⚠️ | toolbar: basic |
| **Email** | `wysiwyg` ⚠️ | toolbar: basic |
| `img` | `image` | return: array |
| `a` | `link` | return: array |
| Background | `image` | return: array |
| Slider/List | `repeater` | + sub_fields |
| Nested | `group` | + sub_fields |

---

## WYSIWYG - BẮT BUỘC CHO:
✅ Địa chỉ (có `<br>`, nhiều dòng)  
✅ Phone (có `<a href="tel:">`)  
✅ Email (có `<a href="mailto:">`)  
✅ Nội dung có HTML tags  
✅ Cần format (bold, italic, link)

**Config:**
```json
{
  "type": "wysiwyg",
  "toolbar": "basic",
  "media_upload": 0
}
```

---

## 🏷️ NAMING CONVENTIONS

| Element | Format | Example |
|---------|--------|---------|
| Field key | `field_[section]_[name]` | `field_hero_title` |
| Field name | `snake_case` | `hero_title` |
| Tab key | `tab_[section]` | `tab_hero` |
| Toggle | `[section]_enable` | `hero_enable` |
| Background | `[section]_background_image` | `hero_background_image` |
| Icon | `[section]_icon_image` | `service_icon_image` |

---

## 📝 FORM = CF7 (KHÔNG ACF)

❌ **KHÔNG** tạo ACF fields cho form  
✅ Output **CF7 syntax**

```html
<div class="form-group">
  <label>Họ và tên *</label>
  [text* ho-va-ten placeholder "Nhập họ tên"]
</div>

<div class="form-group">
  <label>Email *</label>
  [email* email placeholder "example@email.com"]
</div>

<div class="form-group">
  <label>Số điện thoại *</label>
  [tel* so-dien-thoai placeholder "0912345678"]
</div>

<div class="form-group">
  <label>Nội dung</label>
  [textarea noi-dung placeholder "Tin nhắn..."]
</div>

<div class="frm-btnwrap">
  [submit class:btn class:btn-primary "GỬI"]
</div>
```

---

## 🔁 REPEATER

✅ **Dùng khi:** Slider, list, cards, items lặp

```json
{
  "type": "repeater",
  "layout": "block",
  "button_label": "Thêm item",
  "collapsed": "title",
  "min": 0,
  "max": 0,
  "sub_fields": []
}
```

**Layout:**
- `block`: Mặc định
- `row`: 2-3 fields đơn giản
- `table`: Chỉ text fields

---

## 📁 FILE STRUCTURE

```
page-[page_name].php
modules/
  └── [page_name]/
      ├── hero.php
      ├── about.php
      └── services.php
```

### Main Template:
```php
<?php
/**
 * Template Name: Page - [Name]
 */
get_header();

if (get_field('hero_enable')):
  get_template_part('modules/[page]/hero');
endif;

if (get_field('about_enable')):
  get_template_part('modules/[page]/about');
endif;

get_footer();
```

---

---

## 🎨 HEADER & FOOTER STRUCTURE

### Phân tích & Tái cấu trúc

Khi nhận HTML có header/footer:

#### ✅ BẮT BUỘC:
1. **Phân tích cấu trúc HTML** header/footer hiện tại
2. **Tách riêng** `header.php` và `footer.php`
3. **Giữ nguyên 100%** HTML structure và classes
4. **Chuyển đổi menu** sang `wp_nav_menu()` với custom walker
5. **ACF Options Page** cho logo, thông tin liên hệ, social links

---

### 📋 Header Structure

#### File: `header.php`
```php
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="[original-header-class]">
    <!-- Giữ nguyên HTML structure -->
    
    <!-- Logo -->
    <?php 
    $logo = get_field('header_logo', 'option');
    if ($logo): ?>
        <a href="<?php echo home_url('/'); ?>" class="logo">
            <img src="<?php echo get_image_attrachment($logo, 'url'); ?>" 
                 alt="<?php bloginfo('name'); ?>">
        </a>
    <?php endif; ?>
    
    <!-- Menu -->
    <?php
    wp_nav_menu(array(
        'theme_location' => 'primary',
        'container'      => 'nav',
        'container_class'=> '[original-nav-class]',
        'menu_class'     => '[original-menu-class]',
        'walker'         => new Custom_Menu_Walker()
    ));
    ?>
    
    <!-- Phone/CTA từ ACF Options -->
    <?php $phone = get_field('header_phone', 'option'); ?>
    <?php if ($phone): ?>
        <a href="tel:<?php echo preg_replace('/[^0-9+]/', '', $phone); ?>" 
           class="[phone-class]">
            <?php echo $phone; ?>
        </a>
    <?php endif; ?>
</header>
```

---

### 📋 Footer Structure

#### File: `footer.php`
```php
<footer class="[original-footer-class]">
    <!-- Giữ nguyên HTML structure -->
    
    <!-- Logo Footer -->
    <?php 
    $footer_logo = get_field('footer_logo', 'option');
    if ($footer_logo): ?>
        <img src="<?php echo get_image_attrachment($footer_logo, 'url'); ?>" 
             alt="<?php bloginfo('name'); ?>">
    <?php endif; ?>
    
    <!-- Footer Menu -->
    <?php
    wp_nav_menu(array(
        'theme_location' => 'footer',
        'container'      => 'nav',
        'container_class'=> '[footer-nav-class]',
        'menu_class'     => '[footer-menu-class]',
        'walker'         => new Custom_Menu_Walker()
    ));
    ?>
    
    <!-- Social Links (ACF Repeater) -->
    <?php if (have_rows('social_links', 'option')): ?>
        <div class="social-links">
            <?php while (have_rows('social_links', 'option')): the_row(); ?>
                <?php 
                $icon = get_sub_field('icon');
                $link = get_sub_field('link');
                ?>
                <a href="<?php echo $link['url']; ?>" 
                   target="<?php echo $link['target']; ?>"
                   class="[social-icon-class]">
                    <i class="<?php echo $icon; ?>"></i>
                </a>
            <?php endwhile; ?>
        </div>
    <?php endif; ?>
    
    <!-- Copyright -->
    <p class="copyright">
        &copy; <?php echo date('Y'); ?> 
        <?php echo get_field('copyright_text', 'option') ?: bloginfo('name'); ?>
    </p>
</footer>

<?php wp_footer(); ?>
</body>
</html>
```

---

### 🎛️ ACF Options Page

#### Tạo Options Page trong `functions.php`:
```php
// ACF Options Page
if (function_exists('acf_add_options_page')) {
    acf_add_options_page(array(
        'page_title' => 'Theme Settings',
        'menu_title' => 'Theme Settings',
        'menu_slug'  => 'theme-settings',
        'capability' => 'edit_posts',
        'icon_url'   => 'dashicons-admin-settings',
        'position'   => 60
    ));
}
```

#### ACF JSON cho Options:
```json
{
  "key": "group_theme_options",
  "title": "Theme Settings - Header & Footer",
  "fields": [
    {
      "key": "tab_header",
      "label": "📌 Header Settings",
      "type": "tab"
    },
    {
      "key": "field_header_logo",
      "label": "Logo",
      "name": "header_logo",
      "type": "image",
      "return_format": "array"
    },
    {
      "key": "field_header_phone",
      "label": "Số điện thoại (Header)",
      "name": "header_phone",
      "type": "text"
    },
    {
      "key": "tab_footer",
      "label": "📌 Footer Settings",
      "type": "tab"
    },
    {
      "key": "field_footer_logo",
      "label": "Logo Footer",
      "name": "footer_logo",
      "type": "image",
      "return_format": "array"
    },
    {
      "key": "field_social_links",
      "label": "Social Media Links",
      "name": "social_links",
      "type": "repeater",
      "layout": "table",
      "button_label": "Thêm link",
      "sub_fields": [
        {
          "key": "field_social_icon",
          "label": "Icon Class",
          "name": "icon",
          "type": "text",
          "placeholder": "fa-brands fa-facebook"
        },
        {
          "key": "field_social_link",
          "label": "Link",
          "name": "link",
          "type": "link"
        }
      ]
    },
    {
      "key": "field_copyright_text",
      "label": "Copyright Text",
      "name": "copyright_text",
      "type": "text",
      "default_value": "All rights reserved"
    }
  ],
  "location": [
    [
      {
        "param": "options_page",
        "operator": "==",
        "value": "theme-settings"
      }
    ]
  ]
}
```

---

## 🎯 CUSTOM MENU WALKER

### File: `inc/class-custom-menu-walker.php`
```php
<?php
/**
 * Custom Menu Walker
 * - Hỗ trợ phân cấp cha-con không giới hạn
 * - Active states: current-menu-item, current-menu-parent, current-menu-ancestor
 * - Active cho post type đang xem chi tiết
 */

class Custom_Menu_Walker extends Walker_Nav_Menu {
    
    /**
     * Start Level - Open submenu wrapper
     */
    function start_lvl(&$output, $depth = 0, $args = null) {
        $indent = str_repeat("\t", $depth);
        $classes = 'sub-menu';
        
        // Thêm class theo depth level
        if ($depth >= 1) {
            $classes .= ' sub-menu-' . ($depth + 1);
        }
        
        $output .= "\n$indent<ul class=\"$classes\">\n";
    }
    
    /**
     * Start Element - Menu item
     */
    function start_el(&$output, $item, $depth = 0, $args = null, $id = 0) {
        $indent = ($depth) ? str_repeat("\t", $depth) : '';
        
        // Classes
        $classes = empty($item->classes) ? array() : (array) $item->classes;
        $classes[] = 'menu-item-' . $item->ID;
        
        // Active states
        $classes = $this->add_active_classes($classes, $item);
        
        // Has children
        if (in_array('menu-item-has-children', $classes)) {
            $classes[] = 'has-dropdown';
        }
        
        // Depth class
        $classes[] = 'depth-' . $depth;
        
        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args, $depth));
        $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';
        
        // ID
        $id = apply_filters('nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args, $depth);
        $id = $id ? ' id="' . esc_attr($id) . '"' : '';
        
        // Output <li>
        $output .= $indent . '<li' . $id . $class_names .'>';
        
        // Link attributes
        $atts = array();
        $atts['title']  = !empty($item->attr_title) ? $item->attr_title : '';
        $atts['target'] = !empty($item->target) ? $item->target : '';
        $atts['rel']    = !empty($item->xfn) ? $item->xfn : '';
        $atts['href']   = !empty($item->url) ? $item->url : '';
        
        // Add aria-haspopup for parent items
        if (in_array('menu-item-has-children', $classes)) {
            $atts['class'] = 'has-children';
            $atts['aria-haspopup'] = 'true';
        }
        
        $atts = apply_filters('nav_menu_link_attributes', $atts, $item, $args, $depth);
        
        $attributes = '';
        foreach ($atts as $attr => $value) {
            if (!empty($value)) {
                $value = ('href' === $attr) ? esc_url($value) : esc_attr($value);
                $attributes .= ' ' . $attr . '="' . $value . '"';
            }
        }
        
        // Menu item content
        $title = apply_filters('the_title', $item->title, $item->ID);
        $title = apply_filters('nav_menu_item_title', $title, $item, $args, $depth);
        
        // Build item output
        $item_output = $args->before;
        $item_output .= '<a'. $attributes .'>';
        $item_output .= $args->link_before . $title . $args->link_after;
        
        // Add dropdown icon for parent items
        if (in_array('menu-item-has-children', $classes)) {
            $item_output .= '<span class="dropdown-icon"><i class="fa-solid fa-chevron-down"></i></span>';
        }
        
        $item_output .= '</a>';
        $item_output .= $args->after;
        
        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }
    
    /**
     * Add active classes for current page and ancestors
     */
    private function add_active_classes($classes, $item) {
        global $post;
        
        // Current page/post
        if (in_array('current-menu-item', $classes) || 
            in_array('current_page_item', $classes)) {
            $classes[] = 'active';
        }
        
        // Current parent
        if (in_array('current-menu-parent', $classes) || 
            in_array('current_page_parent', $classes)) {
            $classes[] = 'active-parent';
        }
        
        // Current ancestor
        if (in_array('current-menu-ancestor', $classes) || 
            in_array('current_page_ancestor', $classes)) {
            $classes[] = 'active-ancestor';
        }
        
        // Custom Post Type archive active
        if ($post && is_singular()) {
            $post_type = get_post_type();
            $post_type_obj = get_post_type_object($post_type);
            
            if ($post_type_obj && $item->object == 'page') {
                // Check if menu item links to CPT archive
                $archive_link = get_post_type_archive_link($post_type);
                if ($archive_link && $item->url == $archive_link) {
                    $classes[] = 'current-menu-parent';
                    $classes[] = 'active-parent';
                }
            }
            
            // Check if menu item is parent page of current post type
            if ($item->object == 'page') {
                $cpt_parent = get_option('cpt_parent_page_' . $post_type);
                if ($cpt_parent && $item->object_id == $cpt_parent) {
                    $classes[] = 'current-menu-parent';
                    $classes[] = 'active-parent';
                }
            }
        }
        
        // Taxonomy archive active
        if (is_tax() || is_category() || is_tag()) {
            $term = get_queried_object();
            if ($term && $item->object_id == $term->term_id) {
                $classes[] = 'current-menu-item';
                $classes[] = 'active';
            }
        }
        
        return $classes;
    }
}
```

---

### 🔧 Đăng ký Menu Locations

#### Thêm vào `functions.php`:
```php
// Register Navigation Menus
function theme_register_menus() {
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'textdomain'),
        'footer'  => __('Footer Menu', 'textdomain'),
    ));
}
add_action('after_setup_theme', 'theme_register_menus');

// Include Custom Walker
require_once get_template_directory() . '/inc/class-custom-menu-walker.php';
```

---

## 🎯 CUSTOM POST TYPE ACTIVE STATE

### Setup Parent Page cho CPT

Thêm vào `functions.php`:
```php
/**
 * Set parent page for Custom Post Type
 * Để menu item active khi xem single CPT
 */
function set_cpt_parent_page() {
    // Ví dụ: Post type 'portfolio' có parent page ID là 123
    update_option('cpt_parent_page_portfolio', 123);
    
    // Ví dụ: Post type 'product' có parent page ID là 456
    update_option('cpt_parent_page_product', 456);
}
add_action('after_switch_theme', 'set_cpt_parent_page');
```

---

## ✅ CHECKLIST - Header & Footer

### Phân tích:
- [ ] Nhận diện cấu trúc header HTML
- [ ] Nhận diện cấu trúc footer HTML
- [ ] Xác định vị trí menu
- [ ] Xác định logo, phone, CTA positions
- [ ] Xác định social links structure

### ACF Options:
- [ ] Tạo Options Page
- [ ] ACF JSON cho header settings
- [ ] ACF JSON cho footer settings
- [ ] ACF JSON cho social links (repeater)

### Menu Walker:
- [ ] Tạo Custom Walker class
- [ ] Hỗ trợ phân cấp không giới hạn
- [ ] Active states: current, parent, ancestor
- [ ] CPT single page active parent
- [ ] Taxonomy archive active
- [ ] Dropdown icons cho parent items

### Implementation:
- [ ] Tách `header.php` với HTML gốc
- [ ] Tách `footer.php` với HTML gốc
- [ ] 100% giữ nguyên classes
- [ ] Đăng ký menu locations
- [ ] CSS cho menu structure
- [ ] JavaScript cho mobile menu
- [ ] Test phân cấp 3+ levels
- [ ] Test active states tất cả scenarios

---

## 🚨 LƯU Ý QUAN TRỌNG

### Menu Walker:
- ✅ Phải handle **unlimited depth** (3+ levels)
- ✅ Phải có active class cho **current page**
- ✅ Phải có active class cho **parent** của current
- ✅ Phải có active class cho **ancestors** (tất cả cấp cha)
- ✅ Phải active khi xem **single CPT** (parent page active)
- ✅ Phải active khi xem **taxonomy archive**

### HTML Structure:
- ❌ KHÔNG thay đổi HTML structure gốc
- ❌ KHÔNG thay đổi class names
- ✅ CHỈ replace nội dung bằng WP functions
- ✅ Giữ nguyên semantic HTML

### Mobile Menu:
- ✅ Phải có toggle button
- ✅ Submenu phải collapsible
- ✅ Touch-friendly (không rely vào hover)
- ✅ Smooth transitions

---

## 📤 OUTPUT ORDER

Khi được yêu cầu làm Header/Footer:

1. **header.php** - Full file với HTML gốc
2. **footer.php** - Full file với HTML gốc
3. **ACF Options JSON** - Settings fields
4. **Custom Walker** - `inc/class-custom-menu-walker.php`
5. **Functions.php** - Menu registration, walker include
6. **CSS** - Menu styling (optional, nếu cần)
7. **JavaScript** - Mobile menu (optional, nếu cần)

**KHÔNG output giải thích - CHỈ code.**

## 🔌 ACF FUNCTIONS

### Basic:
```php
<?php the_field('field_name'); ?>
<?php $value = get_field('field_name'); ?>
```

### Image (DÙNG UTILITY):
```php
// URL only
<?php echo get_image_attrachment($image, 'url'); ?>

// Full data
<?php $img = get_image_attrachment($image); ?>

// From post ID
<?php $img = get_image_post($id); ?>
```

### Link:
```php
<?php $link = get_field('link_field'); ?>
<a href="<?php echo $link['url']; ?>" 
   target="<?php echo $link['target']; ?>">
  <?php echo $link['title']; ?>
</a>
```

### Repeater:
```php
<?php if (have_rows('items')): ?>
  <?php while (have_rows('items')): the_row(); ?>
    <?php $title = get_sub_field('title'); ?>
    <?php $img = get_sub_field('image'); ?>
  <?php endwhile; ?>
<?php endif; ?>
```

### Group:
```php
<?php $group = get_field('content_group'); ?>
<?php echo $group['title']; ?>
<?php echo $group['description']; ?>
```

---

## ✅ VALIDATION CHECKLIST

### JSON:
- [ ] Mỗi section: TAB + TOGGLE
- [ ] Field keys: `field_[section]_[name]`
- [ ] WYSIWYG cho: địa chỉ, phone, email
- [ ] Image fields tên rõ ràng
- [ ] Repeater có `collapsed` + `button_label`
- [ ] Form = CF7 (không ACF)

### HTML:
- [ ] 100% giữ nguyên structure
- [ ] 100% giữ nguyên classes
- [ ] Không dùng `esc_html()` (trừ yêu cầu)
- [ ] Dùng utility functions cho images
- [ ] Conditional: `if (get_field('[section]_enable'))`

---

## 🚫 TUYỆT ĐỐI KHÔNG

❌ Thay đổi HTML structure  (phải sau khi hoàn thành 1 module, ví dụ như modules/home/about.php phải kiểm tra lại cấu trúc HTML của section đó có khớp không - CẤU TRÚC HTML đảm bảo khớp tuyệt đối 100%)
❌ Thêm/xóa/sửa CSS classes  
❌ Bỏ qua TAB/TOGGLE  
❌ Dùng `text` cho địa chỉ/phone/email  
❌ Tạo ACF cho form (phải CF7)  
❌ Output giải thích trong code  
❌ Tự ý implement HTML (chờ yêu cầu)  
❌ Đặt tên field không chuẩn  
❌ Hardcode giá trị trong JSON

---

## 💡 OUTPUT FORMAT

### Bước 1:
```json
{
  "key": "group_[page]",
  "title": "[Page] - Content Fields",
  "fields": [...],
  "location": [[{
    "param": "page_template",
    "operator": "==",
    "value": "template-[page].php"
  }]],
  "active": true
}
```

**Sau đó nói:**
> ✅ ACF JSON đã xong. Vui lòng kiểm tra và cho approval để làm Bước 2.

---

## 🎯 REMEMBER

**TAB + TOGGLE + WYSIWYG (formatted) + CLEAN = HAPPY EDITOR**

**2 BƯỚC - LUÔN CHỜ APPROVAL TRƯỚC KHI SANG BƯỚC 2**