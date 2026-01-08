<?php
define('GENERATE_VERSION', '1.1.0');
require get_template_directory() . '/inc/function-root.php';
require get_template_directory() . '/inc/function-custom.php';
require get_template_directory() . '/inc/function-field.php';
require get_template_directory() . '/inc/function-pagination.php';
require get_template_directory() . '/inc/function-setup.php';
require get_template_directory() . '/inc/function-post-types.php';

/**
 * Enqueue AJAX scripts and localize data for specific templates
 */
add_action('wp_enqueue_scripts', function() {
	global $post;

	// Common AJAX URL for all scripts
	$ajax_url = admin_url('admin-ajax.php');
	
	// Career archive page scripts
	if(is_post_type_archive('tuyen-dung') || is_archive('tuyen-dung')) {
		wp_enqueue_script('career-ajax', get_template_directory_uri() . '/scripts/career-ajax.js', ['jquery'], GENERATE_VERSION, true);
		wp_localize_script('career-ajax', 'ajax_object', [
			'ajax_url' => $ajax_url,
			'nonce'    => wp_create_nonce('career_filter_nonce'),
		]);
	}

	// Taxonomy co-dong-category page scripts
	if (is_tax('co-dong-category')) {
		$term = get_queried_object();
		wp_enqueue_script('document-ajax', get_template_directory_uri() . '/scripts/document-ajax.js', ['jquery'], GENERATE_VERSION, true);
		wp_localize_script('document-ajax', 'ajax_object', [
			'ajax_url' => $ajax_url,
			'term_id'  => $term ? $term->term_id : 0,
			'nonce'    => wp_create_nonce('document_filter_nonce'),
		]);
	}
});

/**
 * Modify posts per page for 'du-an' post type archive
 */
add_action('pre_get_posts', function($query) {
	if (!is_admin() && $query->is_main_query()) {
		// Cổ đông: 10 items (to match render_document_table_and_pagination hardcoded limit)
		if (is_post_type_archive('co-dong') || is_tax('co-dong-category')) {
			$query->set('posts_per_page', 10);
		}
	}
});

/**
 * Validate phone number field in Contact Form 7
 * Ensures the phone number contains only digits and is between 10-12 characters
 */
function custom_tel_validation_filter($result, $tag) {
	$tag = new WPCF7_FormTag($tag);

	if ( 'tel' === $tag->basetype || 'tel*' === $tag->basetype ) {
		$tel = isset($_POST[$tag->name]) ? trim( wp_unslash( $_POST[$tag->name] ) ) : '';

		// Nếu người dùng để trống (với trường không bắt buộc) thì không kiểm tiếp
		if ( $tel === '' ) {
			return $result;
		}

		// Không chấp nhận chỉ một ký tự "0"
		if ( $tel === '0' ) {
			$result->invalidate( $tag, __( 'Số điện thoại không hợp lệ.', 'canhcamtheme' ) );
			return $result;
		}

		// Chỉ cho phép chữ số
		if ( ! preg_match( '/^[0-9]+$/', $tel ) ) {
			$result->invalidate( $tag, __( 'Vui lòng chỉ nhập số điện thoại.', 'canhcamtheme' ) );
			return $result;
		}

		// Độ dài hợp lệ (10-12 chữ số)
		$length = strlen( $tel );
		if ( $length < 10 || $length > 12 ) {
			$result->invalidate( $tag, __( 'Số điện thoại phải từ 10 đến 12 số.', 'canhcamtheme' ) );
			return $result;
		}
	}

	return $result;
}
add_filter( 'wpcf7_validate_tel', 'custom_tel_validation_filter', 10, 2 );
add_filter( 'wpcf7_validate_tel*', 'custom_tel_validation_filter', 10, 2 );


/**
 * Display file name after selecting a file in Contact Form 7
 */
add_action('wp_footer', 'custom_cf7_file_display_script');
function custom_cf7_file_display_script() {
	?>
<script>
document.addEventListener('DOMContentLoaded', function() {
	// Find all file inputs in CF7 forms
	const fileInputs = document.querySelectorAll('.wpcf7-file');

	fileInputs.forEach(function(input) {
		// Create a display element for the file name
		const fileDisplay = document.createElement('div');
		fileDisplay.className = 'file-name-display';
		fileDisplay.style.marginTop = '5px';
		fileDisplay.style.fontSize = '14px';

		// Insert the display element after the input
		input.parentNode.insertBefore(fileDisplay, input.nextSibling);

		// Add change event listener to the file input
		input.addEventListener('change', function() {
			if (this.files && this.files.length > 0) {
				// Display the file name
				const fileName = this.files[0].name;
				fileDisplay.textContent = fileName;
			} else {
				// Clear the display if no file is selected
				fileDisplay.textContent = '';
			}
		});
	});
});
</script>
<?php
}


/**
 * Render document table and pagination
 * 
 * @param int $term_id Taxonomy term ID
 * @param string $selected_year Selected year for filtering
 * @param int $per_page Number of items per page
 * @param int $current_page Current page number
 * @return string HTML output
 */
function render_document_table_and_pagination($term_id, $selected_year, $per_page, $current_page) {
	// Determine whether to allow empty term_id (for "All")
	$is_all = ($term_id === 0 || $term_id === '0' || $term_id === false || $term_id === null);

	// If not "All", validate term
	if (!$is_all) {
		$term = get_term($term_id, 'co-dong-category');
		if (is_wp_error($term) || !$term) {
			 ob_start();
			?>
<table>
	<thead>
		<tr>
			<th class="text-left"><?php _e('STT', 'canhcamtheme'); ?></th>
			<th class="text-left"><?php _e('Nội dung công bố', 'canhcamtheme'); ?></th>
			<th class="text-center"><?php _e('Ngày đăng tải', 'canhcamtheme'); ?></th>
			<th class="text-center"> </th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td colspan="4" style="text-align:center;"><?php esc_html_e('Không có tài liệu nào.', 'canhcamtheme'); ?>
			</td>
		</tr>
	</tbody>
</table>
<?php
			return ob_get_clean();
		}
	}
	
	// Query posts
	$args = array(
		'post_type' => 'co-dong',
		'posts_per_page' => -1, // Get all posts first to filter by year
		'post_status' => 'publish',
		'orderby' => 'date',
		'order' => 'DESC',
	);

	// Add tax_query only if not "All"
	if (!$is_all) {
		$args['tax_query'] = array(
			array(
				'taxonomy' => 'co-dong-category',
				'field' => 'term_id',
				'terms' => $term_id,
				'operator' => 'IN', 
			),
		);
	}
	
	$query = new WP_Query($args);
	$filtered_posts = [];
	
	// Filter posts by year
	if ($query->have_posts()) {
		while ($query->have_posts()) {
			$query->the_post();
			$post_year = get_the_date('Y');
			
			if ($selected_year) {
				if ($post_year == $selected_year) {
					$filtered_posts[] = get_the_ID();
				}
			} else {
				$filtered_posts[] = get_the_ID();
			}
		}
		wp_reset_postdata();
	}
	
	// Calculate pagination
	$total = count($filtered_posts);
	$total_pages = ceil($total / $per_page);
	$start = ($current_page - 1) * $per_page;
	$paged_post_ids = array_slice($filtered_posts, $start, $per_page);
	
	// Query the paged posts - only if we have posts to query
	if (empty($paged_post_ids)) {
		// Create an empty query result if no posts
		$paged_query = new WP_Query(array('post__in' => array(0))); // Query with non-existent ID to return empty
	} else {
		$paged_args = array(
			'post_type' => 'co-dong',
			'post__in' => $paged_post_ids,
			'posts_per_page' => $per_page,
			'post_status' => 'publish',
			'orderby' => 'post__in', // Maintain the order from filtered_posts
			'order' => 'DESC',
			
		);
		
		$paged_query = new WP_Query($paged_args);
	}
	
	// Start output buffer
	ob_start();
	?>
<table>
	<thead>
		<tr>
			<th class="text-left"><?php _e('STT', 'canhcamtheme'); ?></th>
			<th class="text-left"><?php _e('Nội dung công bố', 'canhcamtheme'); ?></th>
			<th class="text-center"><?php _e('Ngày đăng tải', 'canhcamtheme'); ?></th>
			<th class="text-center"> </th>
		</tr>
	</thead>
	<tbody>
		<?php if ($paged_query->have_posts()) : ?>
		<?php 
			$index = 0;
			while ($paged_query->have_posts()) : 
				$paged_query->the_post();
				$post_id = get_the_ID();
				$file = get_field('file', $post_id); // Get file field from ACF
				$post_date = get_the_date('d/m/Y');
				
				$file_url = '';
				$file_title = get_the_title(); // Use post title as file title
				
				if (is_array($file)) {
					$file_url = isset($file['url']) ? $file['url'] : '';
					if (empty($file_title) && isset($file['title'])) {
						$file_title = $file['title'];
					}
					if (empty($file_title) && isset($file['filename'])) {
						$file_title = $file['filename'];
					}
				} elseif (is_string($file)) {
					$file_url = $file;
				}
			?>
		<tr>
			<td><?php echo str_pad($start + $index + 1, 2, '0', STR_PAD_LEFT); ?></td>
			<td>
				<a href="<?php echo esc_url(get_permalink()); ?>"><?php echo esc_html($file_title); ?></a>
			</td>
			<td>
				<?php echo esc_html($post_date); ?>
			</td>
			<td>
				<?php if ($file_url): ?>
				<a href="<?php echo esc_url($file_url); ?>" download target="_blank" rel="noopener">
					<span><?php _e('Tải về', 'canhcamtheme'); ?></span><i class="fa-light fa-download"></i>
				</a>
				<?php else: ?>
				<a href="<?php echo esc_url(get_permalink()); ?>" target="_blank" rel="noopener">
					<span><?php _e('Xem chi tiết', 'canhcamtheme'); ?></span><i class="fa-light fa-arrow-right"></i>
				</a>
				<?php endif; ?>

			</td>
		</tr>
		<?php 
				$index++;
			endwhile; 
			wp_reset_postdata();
			?>
		<?php else: ?>
		<tr>
			<td colspan="4" style="text-align:center;"><?php esc_html_e('Không có tài liệu nào.', 'canhcamtheme'); ?>
			</td>
		</tr>
		<?php endif; ?>

	</tbody>
</table>

<?php if ($total_pages > 1): ?>
<ul class="pagination justify-center mt-base">
	<?php
		// Helper to generate pagination URL
		$get_pag_link = function($p) use ($selected_year) {
			$link = get_pagenum_link($p);
			return $selected_year ? add_query_arg('d_year', $selected_year, $link) : $link;
		};

		// Previous
		if ($current_page > 1):
			$prev_page = max(1, $current_page - 1);
		?>
	<li
		class="pagination-item flex-center w-10 md:w-12 h-10 md:h-12 border-2 border-Primary-2 rounded-1 heading-4 transition-300 hover:bg-Primary-1 hover:border-Primary-1 cursor-pointer">
		<a href="<?php echo esc_url($get_pag_link($prev_page)); ?>" class="flex-center w-full h-full"><i
				class="fa-regular fa-chevron-left"></i></a>
	</li>
	<?php endif; ?>

	<?php
		// Page numbers
		for ($i = 1; $i <= $total_pages; $i++) {
			$active = $i == $current_page ? 'active' : '';
			?>
	<li
		class="pagination-item flex-center w-10 md:w-12 h-10 md:h-12 border-2 border-Primary-2 rounded-1 heading-4 transition-300 hover:bg-Primary-1 hover:border-Primary-1 cursor-pointer <?php echo $active; ?>">
		<a href="<?php echo esc_url($get_pag_link($i)); ?>" class="flex-center w-full h-full"><?php echo $i; ?></a>
	</li>
	<?php
		}
		
		// Next
		if ($current_page < $total_pages):
			$next_page = min($total_pages, $current_page + 1);
		?>
	<li
		class="pagination-item flex-center w-10 md:w-12 h-10 md:h-12 border-2 border-Primary-2 rounded-1 heading-4 transition-300 hover:bg-Primary-1 hover:border-Primary-1 cursor-pointer">
		<a href="<?php echo esc_url($get_pag_link($next_page)); ?>" class="flex-center w-full h-full"><i
				class="fa-regular fa-chevron-right"></i></a>
	</li>
	<?php endif; ?>
</ul>
<?php endif; ?>
<?php
	return ob_get_clean();
}

/**
 * AJAX handler for document filtering and pagination
 */
add_action('wp_ajax_filter_documents', 'ajax_filter_documents');
add_action('wp_ajax_nopriv_filter_documents', 'ajax_filter_documents');

/**
 * Handle AJAX request for document filtering and pagination
 */
function ajax_filter_documents() {
	// Verify nonce for security
	if (isset($_REQUEST['nonce']) && !wp_verify_nonce($_REQUEST['nonce'], 'document_filter_nonce')) {
		wp_die('Security check failed');
	}
	
	// Get parameters
	$term_id = isset($_REQUEST['term_id']) ? intval($_REQUEST['term_id']) : 0;
	$selected_year = isset($_REQUEST['year']) ? sanitize_text_field($_REQUEST['year']) : '';
	$current_page = isset($_REQUEST['paged']) ? max(1, intval($_REQUEST['paged'])) : 1;
	
	// Get per_page from AJAX request or use constant if available
	$per_page = isset($_REQUEST['per_page']) ? intval($_REQUEST['per_page']) : 10;
	
	if (!$term_id) {
		echo '<div class="error-message">Invalid term ID</div>';
		wp_die();
	}
	
	// Render the table and pagination
	if (function_exists('render_document_table_and_pagination')) {
		echo render_document_table_and_pagination($term_id, $selected_year, $per_page, $current_page);
	} else {
		echo '<div class="error-message">Error: Document rendering function not available.</div>';
	}
	
	wp_die();
}

function load_more_careers() {
	// Verify nonce for security
	if (!wp_verify_nonce($_POST['nonce'], 'career_filter_nonce')) {
		wp_die('Security check failed');
	}
	
	$page = intval($_POST['page']);
	$start_count = intval($_POST['count']);
	$per_page = intval($_POST['per_page']);
	
	// Ensure per_page has a valid value
	if ($per_page <= 0) {
		$per_page = 4; // Default fallback
	}
	
	$args = array(
		'post_type' => 'tuyen-dung',
		'posts_per_page' => $per_page,
		'post_status' => 'publish',
		'paged' => $page
	);
	
	$query = new WP_Query($args);
	$count = $start_count + 1;
	$posts_returned = 0;
	
	if ($query->have_posts()) {
		while ($query->have_posts()) : $query->the_post();
			$information = get_field('information');
			$location = $information['location'];
			$deadline = $information['application_deadline'];
			?>
<tr
	class="row-job -md:grid -md:grid-cols-2 -md:w-full text-body-1 border border-utility-gray-100 bg-secondary-1 bg-opacity-[0.05]">
	<td class="text-center -md:col-span-full -md:font-medium -md:text-left -md:p-2">
		<?php echo sprintf("%02d", $count); ?></td>
	<td class="p-2 px-4 py-2 md:py-3 -md:col-span-full"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
	</td>
	<td class="p-2 px-4 py-2 md:py-3 md:text-center"><?php echo $deadline ? $deadline : ''; ?></td>
	<td class="p-2 px-4 py-2 md:py-3 md:text-center "><?php echo $location ? $location : ''; ?></td>
	<td class="p-2 px-4 py-2 md:py-3">
		<div class="flex-center h-full -md:justify-start"><a class="flex items-center gap-x-2.5 text-utility-gray-500"
				href="<?php the_permalink(); ?>"><span
					class="text-body-1"><?php _e('Ứng tuyển ngay', 'canhcamtheme'); ?></span><i
					class="fa-light fa-angle-right text-base"></i></a></div>
	</td>
</tr>
<?php
			$count++;
			$posts_returned++;
		endwhile;
		wp_reset_postdata();
		
		// If we returned less than the expected per_page posts, it means we've reached the end
		if ($posts_returned < $per_page) {
			echo '<script>jQuery("#load-more-container").hide();</script>';
		}
	} else {
		// No posts found, hide the button
		echo '<script>jQuery("#load-more-container").hide();</script>';
	}
	wp_die();
}
add_action('wp_ajax_load_more_careers', 'load_more_careers');
add_action('wp_ajax_nopriv_load_more_careers', 'load_more_careers');

/* ----------------------------
 * WPML: register strings (admin only)
 * ---------------------------- */
function my_register_pagination_and_slugs_with_wpml() {
	if ( ! is_admin() ) {
		return; // register strings only in admin to avoid front-end overhead
	}

	if ( empty( $GLOBALS['wp_rewrite'] ) ) {
		return;
	}

	$wp_rewrite = $GLOBALS['wp_rewrite'];
	$pagination_base = $wp_rewrite->pagination_base;

	// Register pagination base
	if ( function_exists( 'icl_register_string' ) || did_action( 'wpml_loaded' ) || has_action( 'wpml_register_single_string' ) ) {
		do_action( 'wpml_register_single_string', 'Pagination', 'pagination_base', $pagination_base );
	}

	// Register CPT/taxonomy slugs for translation (so user can translate CPT archive slug and taxonomy slugs)
	$post_types = get_post_types( array( 'public' => true, 'has_archive' => true ), 'objects' );
	foreach ( $post_types as $pt ) {
		if ( ! empty( $pt->rewrite['slug'] ) ) {
			do_action( 'wpml_register_single_string', 'CPT Slugs', "post_type_{$pt->name}_slug", $pt->rewrite['slug'] );
		}
		// register associated taxonomies' slugs (public)
		$taxes = get_object_taxonomies( $pt->name, 'objects' );
		foreach ( $taxes as $tax ) {
			if ( ! empty( $tax->rewrite['slug'] ) ) {
				do_action( 'wpml_register_single_string', 'Taxonomy Slugs', "taxonomy_{$tax->name}_slug", $tax->rewrite['slug'] );
			}
		}
	}
}
add_action( 'admin_init', 'my_register_pagination_and_slugs_with_wpml', 20 );


/* ----------------------------
 * Apply WPML translations to pagination & slugs (front & admin safe)
 * ---------------------------- */
function my_apply_wpml_translated_slugs() {
	global $wp_rewrite;
	if ( empty( $wp_rewrite ) ) {
		return;
	}

	$original_pagination = $wp_rewrite->pagination_base;
	$translated_pagination = $original_pagination;

	if ( function_exists( 'icl_t' ) ) {
		$translated_pagination = icl_t( 'Pagination', 'pagination_base', $original_pagination );
	} elseif ( has_filter( 'wpml_translate_single_string' ) ) {
		$translated_pagination = apply_filters( 'wpml_translate_single_string', $original_pagination, 'Pagination', 'pagination_base' );
	}

	if ( ! empty( $translated_pagination ) ) {
		$wp_rewrite->pagination_base = sanitize_title( $translated_pagination );
	}

	// Also translate registered CPT/taxonomy slugs so our rules use translated slugs:
	$post_types = get_post_types( array( 'public' => true, 'has_archive' => true ), 'objects' );
	foreach ( $post_types as $pt ) {
		if ( ! empty( $pt->rewrite['slug'] ) ) {
			$orig = $pt->rewrite['slug'];
			$translated = ( function_exists( 'icl_t' ) ) ? icl_t( 'CPT Slugs', "post_type_{$pt->name}_slug", $orig ) : ( has_filter( 'wpml_translate_single_string' ) ? apply_filters( 'wpml_translate_single_string', $orig, 'CPT Slugs', "post_type_{$pt->name}_slug" ) : $orig );
			if ( ! empty( $translated ) ) {
				// replace rewrite slug in object so later rules use translated slug
				$pt->rewrite['slug'] = sanitize_title( $translated );
				// update global registry so other code can read it if needed
				global $wp_post_types;
				if ( isset( $wp_post_types[ $pt->name ] ) ) {
					$wp_post_types[ $pt->name ]->rewrite['slug'] = $pt->rewrite['slug'];
				}
			}
		}

		$taxes = get_object_taxonomies( $pt->name, 'objects' );
		foreach ( $taxes as $tax ) {
			if ( ! empty( $tax->rewrite['slug'] ) ) {
				$orig = $tax->rewrite['slug'];
				$translated = ( function_exists( 'icl_t' ) ) ? icl_t( 'Taxonomy Slugs', "taxonomy_{$tax->name}_slug", $orig ) : ( has_filter( 'wpml_translate_single_string' ) ? apply_filters( 'wpml_translate_single_string', $orig, 'Taxonomy Slugs', "taxonomy_{$tax->name}_slug" ) : $orig );
				if ( ! empty( $translated ) ) {
					$tax->rewrite['slug'] = sanitize_title( $translated );
					global $wp_taxonomies;
					if ( isset( $wp_taxonomies[ $tax->name ] ) ) {
						$wp_taxonomies[ $tax->name ]->rewrite['slug'] = $tax->rewrite['slug'];
					}
				}
			}
		}
	}
}
// Run early enough that WP uses the translated slug for building rules
add_action( 'init', 'my_apply_wpml_translated_slugs', 15 );


/* ----------------------------
 * Add rewrite rules for CPT archives + CPT taxonomies pagination
 * ---------------------------- */
function my_add_cpt_and_taxonomy_pagination_rules() {
	global $wp_rewrite;

	if ( empty( $wp_rewrite ) ) {
		return;
	}

	$pagination_base = $wp_rewrite->pagination_base; // already translated if WPML active
	$front = trim( $wp_rewrite->front, '/' );

	// Collect public post types with archive
	$post_types = get_post_types( array( 'public' => true, 'has_archive' => true ), 'objects' );
	if ( empty( $post_types ) ) {
		return;
	}

	foreach ( $post_types as $pt ) {
		// Ensure we have a slug to match against
		$pt_slug = ! empty( $pt->rewrite['slug'] ) ? trim( $pt->rewrite['slug'], '/' ) : $pt->name;
		$pt_slug_escaped = preg_quote( $pt_slug, '/' );

		// ARCHIVE pagination rule: ^{pt_slug}/{pagination_base}/{page}/
		$pattern = "^{$pt_slug_escaped}/" . preg_quote( $pagination_base, '/' ) . "/([0-9]{1,})/?$";
		$query = 'index.php?post_type=' . $pt->name . '&paged=$matches[1]';
		add_rewrite_rule( $pattern, $query, 'top' );

		// If archive uses front, add a with_front pattern too
		if ( ! empty( $pt->rewrite['with_front'] ) && ! empty( $front ) ) {
			$front_escaped = preg_quote( $front, '/' );
			$pattern_front = "^{$front_escaped}/{$pt_slug_escaped}/" . preg_quote( $pagination_base, '/' ) . "/([0-9]{1,})/?$";
			add_rewrite_rule( $pattern_front, $query, 'top' );
		}

		// TAXONOMIES associated to this post type: add pagination rules
		$taxonomies = get_object_taxonomies( $pt->name, 'objects' );
		if ( empty( $taxonomies ) ) {
			continue;
		}

		foreach ( $taxonomies as $tax ) {
			if ( empty( $tax->rewrite ) || empty( $tax->rewrite['slug'] ) ) {
				continue;
			}

			$tax_slug = trim( $tax->rewrite['slug'], '/' );
			$tax_slug_escaped = preg_quote( $tax_slug, '/' );

			// For taxonomy terms we must support hierarchical term slugs (parent/child): use non-greedy match up to pagination base.
			$pattern_tax = "^{$tax_slug_escaped}/(.+?)/" . preg_quote( $pagination_base, '/' ) . "/([0-9]{1,})/?$";

			// Query var: category_name for built-in 'category' taxonomy (supports parents),
			// for others use 'term' + 'taxonomy' so WP resolves the correct term by slug path.
			if ( 'category' === $tax->name ) {
				$query_tax = 'index.php?category_name=$matches[1]&paged=$matches[2]';
			} else {
				// some WP versions accept 'term' as full path (parent/child). This is the best general approach.
				$query_tax = "index.php?taxonomy={$tax->name}&term=\$matches[1]&paged=\$matches[2]";
			}

			add_rewrite_rule( $pattern_tax, $query_tax, 'top' );

			// with_front for taxonomy
			if ( ! empty( $tax->rewrite['with_front'] ) && ! empty( $front ) ) {
				$pattern_tax_front = "^{$front}/{$tax_slug_escaped}/(.+?)/" . preg_quote( $pagination_base, '/' ) . "/([0-9]{1,})/?$";
				add_rewrite_rule( $pattern_tax_front, $query_tax, 'top' );
			}
		}
	}
}
add_action( 'init', 'my_add_cpt_and_taxonomy_pagination_rules', 99 );


/* ----------------------------
 * Utility: flush when theme switched (or you can add plugin activation hook)
 * ---------------------------- */
add_action( 'after_switch_theme', 'flush_rewrite_rules' );