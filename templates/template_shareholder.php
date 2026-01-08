<?php
/**
 * Template Name: Quan hệ cổ đông
 */
get_header(); ?>

<?php // Banner sẽ tự động lấy từ ACF của Page hiện tại ?>
<?php echo get_template_part('modules/common/banner'); ?>

<?php 
$current_term_id = 0; // "All"
$selected_year = isset($_GET['d_year']) ? sanitize_text_field($_GET['d_year']) : '';
$current_page = get_query_var('paged') ? get_query_var('paged') : (get_query_var('page') ? get_query_var('page') : 1);
?>

<section class="section-shareholder section-py">
	<div class="container-fluid">
		<?php if(get_field('page_heading')): ?>
		<h2 class="title text-Primary-1 heading-1 font-bold text-center mb-base">
			<?php echo get_field('page_heading'); ?>
		</h2>
		<?php else: ?>
		<h2 class="title text-Primary-1 heading-1 font-bold text-center mb-base">
			<?php 
				$title_custom = get_field('title_custom');
				if($title_custom){
					echo $title_custom;
				} else {
					the_title();
				}
			?>
		</h2>
		<?php endif; ?>

		<?php if(get_the_content()): ?>
		<div class="page-intro text-center mb-base max-w-4xl mx-auto body-1">
			<?php the_content(); ?>
		</div>
		<?php endif; ?>

		<div class="wrap-heading flex items-center justify-between mb-base">
			<ul class="nav-secondary">
				<li class="active">
					<a href="<?php the_permalink(); ?>"><?php _e('Tất cả', 'canhcamtheme'); ?></a>
				</li>
				<?php
                $categories = get_terms(array(
                    'taxonomy' => 'co-dong-category',
                    'hide_empty' => false,
					'orderby' => 'name',
                	'order' => 'ASC'
                ));
                
                if (!empty($categories) && !is_wp_error($categories)) :
                    foreach ($categories as $category) :
                ?>
				<li>
					<a href="<?php echo get_term_link($category); ?>"><?php echo $category->name; ?></a>
				</li>
				<?php
                    endforeach;
                endif;
                ?>
			</ul>
			<div class="wrapper-year">
				<div class="label"><?php _e('Năm', 'canhcamtheme'); ?></div>
				<div class="select-year">
					<?php
                    // Get years from ALL posts
                    $years = [];
                    $posts_array = get_posts(array(
                        'post_type' => 'co-dong',
                        'posts_per_page' => -1,
                        'fields' => 'ids',
						'order' => 'DESC',
                        'orderby' => 'date',
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
			data-term-id="<?php echo esc_attr($current_term_id); ?>" data-per-page="10" data-post-type="co-dong"
			data-taxonomy="co-dong-category">
			<?php
            if (function_exists('render_document_table_and_pagination')) {
                echo render_document_table_and_pagination(0, $selected_year, 10, $current_page, 'co-dong', 'co-dong-category');
            }
            ?>
		</div>
	</div>
</section>

<?php get_footer(); ?>