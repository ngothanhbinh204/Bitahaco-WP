<?php
/**
 * Template Name: Liên hệ
 */
?>

<?php get_header(); ?>
<?php echo get_template_part('modules/common/banner'); ?>
<section class="section-contact section-py">
	<div class="container-fluid">
		<div class="contact flex -lg:flex-col-reverse -lg:gap-base">

			<?php if(get_field('form')) : ?>
			<?php
                $form = get_field('form'); 
                $title = $form['title'];
                $description = $form['description'];
                $form_shortcode = $form['form_shortcode'];
                ?>
			<div class="block-contact-form w-full lg:w-7/12 xl:w-[calc(1121/1600*100%)] lg:pr-8">
				<h1 class="contact-title heading-1 text-Primary-1 font-bold">
					<?php echo $title ? $title : __('Liên hệ', 'canhcamtheme'); ?></h1>
				<?php if($description) : ?>
				<div class="subtitle body-1 mt-6"><?php echo $description; ?></div>
				<?php endif; ?>
				<?php echo do_shortcode($form_shortcode); ?>
			</div>
			<?php endif; ?>

			<?php if(get_field('information')) : ?>
			<?php 
                $information = get_field('information'); 
                $title = $information['title'];
                $info = $information['info'];
                ?>
			<div class="block-contact-info w-full lg:w-5/12 xl:w-[calc(480/1600*100%)]">
				<div class="contact-info p-10 rounded-5 bg-Primary-1">
					<?php if($title) : ?>
					<h2 class="contact-info-title heading-2 text-white"><?php echo $title; ?></h2>
					<?php endif; ?>
					<?php if($info) : ?>
					<ul class="contact-info-list mt-6 flex flex-col gap-y-5">
						<?php foreach($info as $item) : ?>
						<li class="contact-info-item flex gap-x-2">
							<div class="icon text-lg text-white">
								<?php if(strpos($item['icon'], 'facebook') !== false) : ?>
								<i class="fa-brands fa-<?php echo $item['icon']; ?>"></i>
								<?php else : ?>
								<i class="fa-solid fa-<?php echo $item['icon']; ?>"></i>
								<?php endif; ?>
							</div>
							<span class="text-base text-white">|</span>
							<div class="block-content text-white">
								<span class="title body-1 font-bold"><?php echo $item['label']; ?></span>
								<div class="content body-1 mt-3 break-all"><?php echo $item['value']; ?></div>
							</div>
						</li>
						<?php endforeach; ?>
					</ul>
					<?php endif; ?>
				</div>
			</div>
			<?php endif; ?>
		</div>
		<?php if(get_field('map')) : ?>
		<div class="contact-map mt-16">
			<div class="block-map img-ratio ratio:pt-[560_1600]">
				<?php echo get_field('map'); ?>
			</div>
		</div>
		<?php endif; ?>
	</div>
</section>

<?php get_footer(); ?>