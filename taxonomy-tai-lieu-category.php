<?php get_header(); ?>
<?php 
$term = get_queried_object(); 
$current_term_id = $term->term_id;
$selected_year = isset($_GET['d_year']) ? sanitize_text_field($_GET['d_year']) : '';
$current_page = get_query_var('paged') ? get_query_var('paged') : 1;
?>

<?php echo get_template_part('modules/common/banner'); ?>


<section class="section-shareholder section-py">
	<div class="container-fluid">
		<h2 class="title text-Primary-1 heading-1 font-bold text-center mb-base">
			<?php
				$subtitle = get_field('subtitle', $term);
				if($subtitle){
					echo esc_html($subtitle);
				} else {
					echo single_term_title('', false);
				}
			?>
		</h2>
		<div class="wrap-heading flex items-center justify-between mb-base">
			<ul class="nav-secondary">
				<?php 
				$pages = get_pages(array(
					'meta_key' => '_wp_page_template',
					'meta_value' => 'templates/template_document.php' 
				));
				$tailieu_url = ($pages) ? get_permalink($pages[0]->ID) : home_url('/');
				?>

				<li>
					<a href="<?php echo esc_url($tailieu_url); ?>">
						<?php _e('Tất cả', 'canhcamtheme'); ?>
					</a>
				</li>
				<?php
                $categories = get_terms(array(
                    'taxonomy' => 'tai-lieu-category',
                    'hide_empty' => false,
                ));
                
                if (!empty($categories) && !is_wp_error($categories)) :
                    foreach ($categories as $category) :
                        $is_active = ($current_term_id == $category->term_id) ? 'active' : ''; 
                ?>
				<li class="<?php echo $is_active; ?>"> <a
						href="<?php echo get_term_link($category); ?>"><?php echo $category->name; ?></a></li>
				<?php
                    endforeach;
                endif;
                ?>
			</ul>
			<div class="wrapper-year">
				<div class="label"><?php _e('Năm', 'canhcamtheme'); ?></div>
				<div class="select-year">
					<?php
                    // Get years
                    $years = [];
                    $posts_array = get_posts(array(
                        'post_type' => 'tai-lieu',
                        'posts_per_page' => -1,
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'tai-lieu-category',
                                'field'    => 'term_id',
                                'terms'    => $current_term_id,
                            ),
                        ),
                        'fields' => 'ids',
                    ));
                    foreach ($posts_array as $pid) {
                        $y = get_the_date('Y', $pid);
                        if ($y) $years[] = $y;
                    }
                    $years = array_unique($years);
                    rsort($years);
                    ?>
					<form method="get" id="document-filter-form">
						<select name="d_year" onchange="this.form.submit()">
							<option value=""><?php _e('Tất cả', 'canhcamtheme'); ?></option>
							<?php foreach ($years as $y): ?>
							<option value="<?php echo esc_attr($y); ?>" <?php selected($selected_year, $y); ?>>
								<?php echo esc_html($y); ?></option>
							<?php endforeach; ?>
						</select>
					</form>
				</div>
			</div>
		</div>
		<div class="wrapper-table table-responsive mt-5" id="document-table-ajax"
			data-term-id="<?php echo esc_attr($current_term_id); ?>" data-per-page="10" data-post-type="tai-lieu"
			data-taxonomy="tai-lieu-category">
			<?php
            if (function_exists('render_document_table_and_pagination')) {
                echo render_document_table_and_pagination($current_term_id, $selected_year, 10, $current_page, 'tai-lieu', 'tai-lieu-category');
            }
            ?>
		</div>
	</div>
</section>

<?php get_footer(); ?>