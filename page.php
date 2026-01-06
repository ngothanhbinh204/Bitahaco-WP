<?php get_header() ?>

<section class="single-page pt-[var(--header-height)]">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1><?php the_title() ?></h1>
                <div class="format-content">
                    <?php the_content() ?>
                </div>
            </div>
        </div>
    </div>
</section>

<?php get_footer() ?>

