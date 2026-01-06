<?php get_header(); ?>

<?php $term = get_queried_object(); ?>

<style>
    /* Document table styles */
    #document-table-ajax.loading { position: relative; min-height: 100px; }
    #document-table-ajax .error-message {
        padding: 15px;
        margin: 20px 0;
        border: 1px solid #f5c6cb;
        border-radius: 4px;
        color: #721c24;
        background-color: #f8d7da;
        text-align: center;
    }
    #document-table-ajax .loader-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(255,255,255,0.7);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 10;
    }
    #document-table-ajax .loader {
        border: 5px solid #f3f3f3;
        border-top: 5px solid #3498db;
        border-radius: 50%;
        width: 40px;
        height: 40px;
        animation: spin 2s linear infinite;
    }
    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
</style>

<div class="space-header pt-[var(--header-height)]"></div>

<?php echo get_template_part('modules/common/breadcrumb'); ?>

<section class="section-shareholder-rel-detail section-py">
    <div class="container-1600"> 
        <div class="shareholder-rel-detail flex -lg:flex-col -lg:gap-base">
            <div class="block-action w-full lg:w-[calc(360/1600*100%)] lg:pr-base">
                <div class="block-action-child">
                    <button class="btn-show" fdprocessedid="nbdmfq9">
                        <i class="fa-solid fa-angles-left"></i>
                    </button>
                    <div class="action rounded-lg overflow-hidden bg-utility-gray-50"><span class="action-title block heading-5 text-white py-3 px-4 bg-primary-2"><?php _e('Quan hệ cổ đông', 'canhcamtheme'); ?></span>
                        <ul class="action-list p-4">
                            <?php
                            $current_term = get_queried_object();
                            $categories = get_terms(array(
                                'taxonomy' => 'co-dong-category',
                                'hide_empty' => false,
                            ));
                            
                            if (!empty($categories) && !is_wp_error($categories)) :
                                foreach ($categories as $category) :
                                    $is_active = ($current_term->term_id == $category->term_id) ? 'active' : '';
                            ?>
                                <li class="action-item <?php echo $is_active; ?>">
                                    <a href="<?php echo get_term_link($category); ?>"><?php echo $category->name; ?></a>
                                </li>
                            <?php
                                endforeach;
                            endif;
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="detail-main w-full lg:w-[calc(1241/1600*100%)] flex flex-col gap-base">  
                <?php
                // Get all co-dong posts for this term
                $term_id = $term->term_id;
                $args = array(
                    'post_type' => 'co-dong',
                    'posts_per_page' => -1, // Get all posts to extract years
                    'post_status' => 'publish',
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'co-dong-category',
                            'field' => 'term_id',
                            'terms' => $term_id,
                        ),
                    ),
                    'orderby' => 'date',
                    'order' => 'DESC',
                );
                
                $all_posts_query = new WP_Query($args);
                $years = [];
                
                if ($all_posts_query->have_posts()) {
                    while ($all_posts_query->have_posts()) {
                        $all_posts_query->the_post();
                        $post_year = get_the_date('Y');
                        if ($post_year) {
                            $years[] = $post_year;
                        }
                    }
                    wp_reset_postdata();
                }
                
                $years = array_unique($years);
                rsort($years);

                // Get selected year from GET param
                $selected_year = isset($_GET['year']) ? sanitize_text_field($_GET['year']) : '';

                // Pagination - Define this once here and it will be used in all functions
                $per_page = 10;
                $current_page = isset($_GET['paged']) ? max(1, intval($_GET['paged'])) : 1;
                ?>
                <div class="top-title-optionYear flex-between gap-6 flex-wrap document-filter">
                    <div id="current-term-id" data-term-id="<?php echo esc_attr($term->term_id); ?>" style="display:none;"><?php echo esc_html($term->term_id); ?></div>
                    <h1 class="detail-main-title heading-1"><?php echo $term->name; ?></h1>
                    <form method="get" class="form-group" id="document-filter-form">
                        <div class="block-optionYear flex items-center gap-x-4">
                            <span class="title-optionYear text-body-1"><?php _e('Năm', 'canhcamtheme'); ?>:</span>
                            <div class="block-optionYear">
                                <select class="optionYear py-2 pl-4 rem:pr-[49px] rounded-lg bg-utility-gray-50 -xl:text-base text-body-1 outline-none cursor-pointer select-none" name="year" id="year-filter">
                                    <option value=""><?php echo esc_html__('Tất cả', 'canhcamtheme'); ?></option>
                                    <?php foreach ($years as $year): ?>
                                        <option value="<?php echo esc_attr($year); ?>" <?php selected($selected_year, $year); ?>><?php echo esc_html($year); ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <input type="hidden" name="term_id" value="<?php echo esc_attr($term->term_id); ?>">
                            </div>
                        </div>
                    </form>
                </div>

                <div class="block-table lg:px-4 -lg:py-2 w-full bg-utility-gray-50 rounded-lg" id="document-table-ajax" data-per-page="<?php echo $per_page; ?>" data-term-id="<?php echo esc_attr($term->term_id); ?>">
                    <?php
                    // Use the rendering function to display documents with pagination
                    if (function_exists('render_document_table_and_pagination')) {
                        echo render_document_table_and_pagination($term_id, $selected_year, $per_page, $current_page);
                    } else {
                        echo '<div class="error-message">Error: Document rendering function not available.</div>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>