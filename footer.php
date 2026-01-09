</main>
<?php
$footer_logo = get_field('footer_logo', 'option');
$footer_company_title = get_field('footer_company_title', 'option');

// Column 1
$col1_title = get_field('footer_col1_title', 'option');
$address = get_field('footer_address', 'option');
$google_map_link = get_field('footer_google_map_link', 'option');
$contact_title = get_field('footer_contact_title', 'option');
$contact_info = get_field('footer_contact_info', 'option');
$business_license = get_field('footer_business_license', 'option');

$link_contact = get_field('footer_contact_link', 'option');

// Column 2
$col2_title = get_field('footer_col2_title', 'option');
$phones = get_field('footer_phones', 'option');
$social_title = get_field('footer_social_title', 'option');
$social_links = get_field('footer_social_links', 'option');

// Column 3
$menu_title = get_field('footer_menu_title', 'option');

// Footer Bottom
$copyright = get_field('copyright', 'option');
$policy_links = get_field('footer_policy_links', 'option');
?>

<footer class="footer xl:pt-9 xl:pb-3 py-10">
	<div class="container-fluid">

		<!-- Footer Top -->
		<div class="footer-top flex items-center md:flex-row flex-col gap-6 pb-6 mb-6 border-b border-white/20">
			<?php if ($footer_logo): ?>
			<div class="footer-logo">
				<a href="<?php echo home_url('/'); ?>">
					<img class="lozad" data-src="<?php echo get_image_attrachment($footer_logo, 'url'); ?>"
						alt="<?php bloginfo('name'); ?>" />
				</a>
			</div>
			<?php endif; ?>

			<?php if ($footer_company_title): ?>
			<div class="company-title heading-2 font-bold uppercase md:text-left text-center">
				<?php echo $footer_company_title; ?>
			</div>
			<?php endif; ?>
		</div>

		<!-- Footer Mid -->
		<div class="footer-mid grid md:grid-cols-3 grid-cols-1 gap-base pb-6 mb-3 border-b border-white/20">

			<!-- Column 1: Địa chỉ & Thông tin liên hệ -->
			<div class="footer-column">
				<?php if ($col1_title): ?>
				<h3 class="title"><?php echo $col1_title; ?></h3>
				<?php endif; ?>

				<?php if ($address || $google_map_link): ?>
				<div class="footer-address flex flex-col gap-2">
					<?php if ($address): ?>
					<div class="address"><?php echo $address; ?></div>
					<?php endif; ?>

					<?php if ($google_map_link): ?>
					<a class="view-map text-Primary-2 body-4 underline" href="<?php echo esc_url($google_map_link); ?>"
						target="_blank">
						<?php _e('View on Google Map', 'canhcamtheme'); ?>
					</a>
					<?php endif; ?>
				</div>
				<?php endif; ?>

				<?php if ($contact_title || $contact_info || $business_license): ?>
				<div class="footer-contact mt-6">
					<?php if ($contact_title): ?>
					<h3 class="title"><?php echo $contact_title; ?></h3>
					<?php endif; ?>

					<?php if ($contact_info): ?>
					<div class="infos flex flex-col rem:gap-[6px]">
						<?php foreach ($contact_info as $info): ?>
						<div class="item flex items-center gap-1">
							<?php if ($info['label']): ?>
							<div class="label"><?php echo $info['label']; ?></div>
							<?php endif; ?>

							<?php if ($info['link_contact']): ?>
							<?php
									$link_contact_url = $info['link_contact']['url'];
									$link_contact_label = $info['link_contact']['title'];	
								?>
							<a class="font-bold" href="<?php echo esc_url($link_contact_url); ?>">
								<?php echo esc_html($link_contact_label); ?>
							</a>
							<?php else: ?>
							<span class="font-bold"><?php echo $info['value']; ?></span>
							<?php endif; ?>
						</div>
						<?php endforeach; ?>
					</div>
					<?php endif; ?>

					<?php if ($business_license): ?>
					<div class="cta font-normal rem:mt-[6px]">
						<?php echo $business_license; ?>
					</div>
					<?php endif; ?>
				</div>
				<?php endif; ?>
			</div>

			<!-- Column 2: Điện thoại & Social Media -->
			<div class="footer-column">
				<?php if ($col2_title): ?>
				<h3 class="title"><?php echo $col2_title; ?></h3>
				<?php endif; ?>

				<?php if ($phones): ?>
				<div class="footer-contact mt-6">
					<div class="infos flex flex-col rem:gap-[6px]">
						<?php foreach ($phones as $phone): ?>
						<?php $link = $phone['number']; ?>
						<?php if ($link): ?>
						<div class="item flex items-center gap-1">
							<?php if ($phone['label']): ?>
							<div class="label"><?php echo $phone['label']; ?></div>
							<?php endif; ?>

							<a class="font-bold" href="<?php echo esc_url($link['url']); ?>"
								target="<?php echo esc_attr($link['target'] ?: '_self'); ?>">
								<?php echo $link['title']; ?>
							</a>
						</div>
						<?php endif; ?>
						<?php endforeach; ?>
					</div>
				</div>
				<?php endif; ?>

				<?php if ($social_title || $social_links): ?>
				<div class="footer-social mt-6">
					<?php if ($social_title): ?>
					<h3 class="title mb-4"><?php echo $social_title; ?></h3>
					<?php endif; ?>

					<?php if ($social_links): ?>
					<ul>
						<?php foreach ($social_links as $social): ?>
						<li>
							<a href="<?php echo esc_url($social['url']); ?>" target="_blank" rel="noopener noreferrer">
								<?php if(strpos($social['icon'], 'facebook') !== false) : ?>
								<i class="fa-brands fa-<?php echo $social['icon']; ?>"></i>
								<?php else : ?>
								<i class="fa-brands fa-<?php echo $social['icon']; ?>"></i>
								<?php endif; ?>
							</a>
						</li>
						<?php endforeach; ?>
					</ul>
					<?php endif; ?>
				</div>
				<?php endif; ?>
			</div>

			<!-- Column 3: Menu Footer -->
			<div class="footer-column">
				<?php if ($menu_title): ?>
				<h3 class="title mb-4"><?php echo $menu_title; ?></h3>
				<?php endif; ?>

				<div class="footer-menu">
					<?php
					wp_nav_menu(array(
						'theme_location' => 'menu-quicklink',
						'container'      => false,
						'menu_class'     => '',
						'fallback_cb'    => false,
						'depth'          => 1
					));
					?>
				</div>
			</div>

		</div>

		<!-- Footer Bottom -->
		<div class="footer-bottom flex items-center justify-between py-2 md:flex-row flex-col gap-4">
			<?php if ($copyright): ?>
			<div class="footer-copyright text-white/80 body-4 font-normal md:text-left text-center">
				<?php echo $copyright; ?>
			</div>
			<?php endif; ?>

			<?php if ($policy_links): ?>
			<div class="footer-policy">
				<!-- get menu by menu-policy location -->
				<?php
				wp_nav_menu(array(
					'theme_location' => 'menu-policy',
					'container'      => false,
					'menu_class'     => '',
					'fallback_cb'    => false,
					'depth'          => 1
				));
				?>
			</div>
			<?php endif; ?>
		</div>

	</div>
</footer>
<?php
$footer_fixed_cta = get_field('footer_fixed_cta', 'option');
if (!$footer_fixed_cta) {
	return;
}
?>
<div class="tool-fixed-cta">
	<div class="btn button-to-top">
		<div class="btn-icon">
			<div class="icon"></div>
		</div>
	</div>

	<?php foreach ($footer_fixed_cta as $item): ?>
	<?php 
		$icon = $item['icon'];
		$link = $item['link'];
		?>

	<?php if ($link && $icon): ?>
	<a class="btn btn-content" href="<?php echo esc_url($link['url']); ?>"
		target="<?php echo esc_attr($link['target'] ?: '_self'); ?>" <?php if ($link['title']): ?>
		title="<?php echo esc_attr($link['title']); ?>" <?php endif; ?>>
		<div class="btn-icon">
			<div class="icon">
				<?php 
					$brands = ['facebook', 'twitter', 'instagram', 'youtube', 'linkedin', 'google', 'pinterest', 'tiktok', 'snapchat', 'reddit', 'tumblr', 'whatsapp', 'telegram'];
					$is_brand = false;
					foreach ($brands as $brand) {
						if (strpos($icon, $brand) !== false) {
							$is_brand = true;
							break;
						}
					}
					?>
				<i class="fa<?php echo $is_brand ? '-brands' : '-solid'; ?> fa-<?php echo $icon; ?>"></i>
			</div>
		</div>
	</a>
	<?php endif; ?>
	<?php endforeach; ?>
</div>

<?php wp_footer(); ?>
</body>

</html>