<?php
function log_dump($data)
{
	ob_start();
	var_dump($data);
	$dump = ob_get_clean();

	$highlighted = highlight_string("<?php\n" . $dump . "\n?>", true);

$formatted = '
<pre>' . substr($highlighted, 27, -8) . '</pre>';

$custom_css = 'pre {position: static;
background: #ffffff80;
// max-height: 50vh;
width: 100vw;
}
pre::-webkit-scrollbar{
width: 1rem;}';

$formatted_css = '<style>
' . $custom_css . '
</style>';
echo ($formatted_css . $formatted);
}

function empty_content($str)
{
return trim(str_replace('&nbsp;', '', strip_tags($str, '<img>'))) == '';
}

function get_top_level_term_name($post_id = null, $taxonomy = 'project_cat') {
if (!$post_id) {
$post_id = get_the_ID();
}

$terms = get_the_terms($post_id, $taxonomy);

if (empty($terms) || is_wp_error($terms)) {
return false;
}

$top_parent_name = '';

foreach ($terms as $term) {
$parent_id = $term->parent;
$current_term = $term;

while ($parent_id != 0) {
$parent_term = get_term($parent_id, $taxonomy);
if (is_wp_error($parent_term) || !$parent_term) {
break;
}
$current_term = $parent_term;
$parent_id = $parent_term->parent;
}

if (empty($top_parent_name) || $current_term->parent == 0) {
$top_parent_name = $current_term->name;
break;
}
}

return $top_parent_name ?: false;
}




/**
* Add active class to menu items for CPTs and Taxonomies
*/
function my_custom_active_menu_class($classes, $item) {
static $mapping = null;

if ($mapping === null) {
$mapping = array();

// Helper to find page ID by template
$find_page_id = function($template) {
$pages = get_pages(array(
'meta_key' => '_wp_page_template',
'meta_value' => $template,
'number' => 1
));
return (!empty($pages)) ? $pages[0]->ID : 0;
};

// Mapping Pages to Templates
$mapping['linh-vuc'] = $find_page_id('templates/template_operation.php');
$mapping['tuyen-dung'] = $find_page_id('templates/template_recruitment.php');
$mapping['co-dong'] = $find_page_id('templates/template_shareholder.php');
$mapping['tai-lieu'] = $find_page_id('templates/template_document.php');

// Standard Posts Page (News)
$mapping['post'] = (int) get_option('page_for_posts');
}

$object_id = (int) $item->object_id;

// 1. Lĩnh vực hoạt động (Archive page template)
if (is_singular('linh-vuc')) {
if ($object_id === $mapping['linh-vuc'] && $mapping['linh-vuc'] > 0) {
$classes[] = 'active';
$classes[] = 'current-menu-item';
}
}

// 2. Tuyển dụng
if (is_singular('tuyen-dung')) {
if ($object_id === $mapping['tuyen-dung'] && $mapping['tuyen-dung'] > 0) {
$classes[] = 'active';
$classes[] = 'current-menu-item';
}
}

// 3. Quan hệ cổ đông (Single + Taxonomy)
if (is_singular('co-dong') || is_tax('co-dong-category')) {
if ($object_id === $mapping['co-dong'] && $mapping['co-dong'] > 0) {
$classes[] = 'active';
$classes[] = 'current-menu-item';
}
}

// 4. Tài liệu (Single + Taxonomy)
if (is_singular('tai-lieu') || is_tax('tai-lieu-category')) {
if ($object_id === $mapping['tai-lieu'] && $mapping['tai-lieu'] > 0) {
$classes[] = 'active';
$classes[] = 'current-menu-item';
}
}

// 5. Bài viết (Post) + Category
if ((is_singular('post') || is_category()) && !is_front_page()) {
if ($object_id === $mapping['post'] && $mapping['post'] > 0) {
$classes[] = 'active';
$classes[] = 'current-menu-item';
}
}

return array_unique($classes);
}
add_filter('nav_menu_css_class', 'my_custom_active_menu_class', 10, 2);

?>