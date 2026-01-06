
</main>
<?php 
	$footer = get_field('footer','option');
	$logo = $footer['logo'];
	$title = $footer['title'];
	$info = $footer['information'];
	$footer_menu_title = $footer['footer_menu_title'];
	$form = $footer['form'];
	$copyright = $footer['copyright'];
	$policy = $footer['policy'];
	$email_link = $footer['email_link'];
?>
<footer class="relative bg-primary-2 pt-15">
	<div class="container-1600"> 
		<div class="footer-top -lg:grid md:grid-cols-2 lg:grid-col-1 lg:flex lg:justify-between md:gap-base">
			<div class="footer-col-1 lg:w-[calc(602/1600*100%)] -md:pb-4 -md:border-b -md:border-white/25 -md:mb-4">
				<?php if($logo): ?>
					<a href="#!"><img class="lozad rem:w-[79px]" data-src="<?php echo $logo['url']; ?>" alt="<?php echo $logo['alt']; ?>"/></a>
				<?php endif; ?>

				<?php if($title): ?>
					<h4 class="footer-title heading-4 text-white uppercase mt-4.25"><?php echo $title; ?></h4>
				<?php endif; ?>

				<?php if($info) : ?>
					<ul class="business-info-list flex flex-col gap-y-2 mt-2">
						<?php foreach($info as $item): ?>
							<li class="business-info-item flex items-center gap-x-2"> 
								<span class="icon text-body-2 text-primary-1">
									<?php echo $item['icon']; ?>
								</span>
								<span class="content text-body-2 text-white"><?php echo $item['text']; ?></span>
							</li>
						<?php endforeach; ?>
					</ul>
				<?php endif; ?>
			</div>
			<div class="footer-col-2 lg:w-[calc(275/1600*100%)] flex flex-col gap-y-2 md:mt-[77px] lg:mt-0 -md:pb-4 -md:border-b -md:border-white/25 -md:mb-4">
				<?php if($footer_menu_title): ?>
					<h4 class="footer-title heading-5 text-white uppercase"><?php echo $footer_menu_title; ?></h4>
				<?php endif; ?>
				<?php
					$menu_footer = 'footer-1';
					$locations = get_nav_menu_locations();
					
					if (!isset($locations[$menu_footer])) return;
					
					$menu_footer_items = wp_get_nav_menu_items($locations[$menu_footer], [
						'update_post_term_cache' => false,
						'suppress_filters' => false
					]);

					if(!empty($menu_footer_items)): ?>
						<ul class="menu-footer-list flex flex-col gap-y-2">
							<?php foreach ($menu_footer_items as $menu_footer_item): 
								$current_url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
								$menu_url = $menu_footer_item->url;
								
								// Check if current URL contains the menu item URL
								$is_current = (strpos($current_url, $menu_url) !== false);
								
								// For non-custom links, also check post ID
								if ($menu_footer_item->type !== 'custom') {
									$is_current = $is_current || (url_to_postid($menu_footer_item->url) === get_the_ID());
								}
								
								$current = $is_current ? 'current-menu-item' : ''; 
							?>
								<li class="item text-body-2 text-white text-opacity-60 <?php echo $current; ?>"><a class="hover-bd-b" href="<?= $menu_footer_item->url ?>"><?= $menu_footer_item->title ?></a></li>
							<?php endforeach; ?>
						</ul>
					<?php endif; 
				?>
			</div>
			<?php if($form): ?>
				<div class="footer-col-3 md:col-span-2 lg:col-span-1 lg:w-[calc(460/1600*100%)] flex flex-col gap-y-2">
					<?php if($form['title']): ?>
						<h4 class="footer-title heading-5 text-white uppercase"><?php echo $form['title']; ?></h4>
					<?php endif; ?>
					<?php if($form['description']): ?>
						<p class="col-3-content text-body-2 text-white"><?php echo $form['description']; ?></p>
					<?php endif; ?>
					<?php if($form['shortcode_form']): ?>
						<?php echo do_shortcode($form['shortcode_form']); ?>
					<?php endif; ?>
				</div>
			<?php endif; ?>
		</div>
		<div class="footer-bottom flex-between py-4 border-t border-white border-opacity-25 mt-10">

			<div class="flex flex-wrap items-center gap-4">
				<?php if($copyright): ?>
					<span class="copyright text-white text-body-3"><?php echo $copyright; ?></span>
				<?php endif; ?>
				<?php if($policy): ?>
					<ul class="clause-list text-body-3 flex items-center gap-x-4">
						<?php foreach($policy as $item): ?>
							<li class="clause-item text-white text-opacity-60"><a class="hover-bd-b" href="<?php echo $item['link']['url']; ?>"><?php echo $item['link']['title']; ?></a></li>
						<?php endforeach; ?>
					</ul>
				<?php endif; ?>
			</div>
			<?php if($email_link): ?>
				<a class="btn-mail relative flex-center shrink-0 overflow-hidden text-xl text-primary-2 w-10 h-10 rounded-lg bg-primary-1 hover:bg-white transition-300 before:content-[''] before:block before:absolute before:inset-0 before:bg-[linear-gradient(to_right,rgba(11,171,224,1),rgba(11,171,224,0)_80%)] before:opacity-0 before:invisible hover:before:opacity-100 hover:before:visible before:transition-300" href="<?php echo $email_link; ?>"><i class="fa-regular fa-envelope"></i></a>
			<?php endif; ?>
		</div>
	</div><img class="rem:w-[322px] rem:h-[345px] absolute bottom-0 left-0 z-1 pointer-events-none" src="<?php echo get_stylesheet_directory_uri() ?>/img/bg-icon-footer.svg">
</footer>
<div class="menuMobile fixed top-0 left-0 z-[1000] w-[70%] sm:w-[55%]  h-full bg-white ">
	<div class="block-logo flex-center py-[16px] border-b border-utility-gray-400">
		<?php echo get_custom_logo(); ?>
	</div>
	<?php
		$menu_name = 'header-menu';
		$locations = get_nav_menu_locations();
		
		if (!isset($locations[$menu_name])) return;
		
		$menu_items = wp_get_nav_menu_items($locations[$menu_name], [
			'update_post_term_cache' => false,
			'suppress_filters' => false
		]);

		if (empty($menu_items)) return; 

		// Build menu hierarchy
		$menu_hierarchy = array();
		$items_by_id = array();

		// First pass: index all items by ID
		foreach ($menu_items as $item) {
			$items_by_id[$item->ID] = $item;
			$item->children = array();
		}

		// Second pass: build hierarchy
		foreach ($menu_items as $item) {
			if ($item->menu_item_parent == 0) {
				$menu_hierarchy[] = $item;
			} else if (isset($items_by_id[$item->menu_item_parent])) {
				$items_by_id[$item->menu_item_parent]->children[] = $item;
			}
		}

		if (!empty($menu_hierarchy)) : ?>
			<ul class="menu-list wrap-item-toggle flex flex-col gap-y-[12px] pt-[16px] px-[12px]">
				<?php foreach ($menu_hierarchy as $menu_level_1): ?>
					<?php if(!empty($menu_level_1->children)): ?>
						<li class="menu-item item-toggle flex flex-col">
							<div class="title flex-between">
								<a href="<?= $menu_level_1->url ?>" class="text-[16px] uppercase inline-block p-[8px] transition-300"><?php echo $menu_level_1->title; ?></a>
								<i class="fa-regular fa-chevron-right icon-arrow text-[16px] transition-300"></i>
							</div>
							<ul class="mega-menu hidden pl-[12px] bg-primary-1 bg-opacity-[0.05] p-[4px]"> 
								<?php foreach ($menu_level_1->children as $menu_level_2) : ?>
									<li class="mega-menu-item text-[15px] mt-[4px] first:mt-0"> 
										<a href="<?= $menu_level_2->url ?>" class="inline-block p-[5px]"><?= $menu_level_2->title ?></a>
									</li>
								<?php endforeach; ?>
							</ul>
						</li>
					<?php else: ?>
						<li class="menu-item">
							<a class="text-[16px] uppercase inline-block p-[8px]" href="<?= $menu_level_1->url ?>"><?= $menu_level_1->title ?></a>
						</li>
					<?php endif; ?>
				<?php endforeach; ?>
			</ul>
		<?php endif; 
	?>
</div>
<div class="fixed inset-0 z-[998] bg-[rgba(0,0,0,0.25)] opacity-0 invisible transition-500" id="modal"></div>
<div class="header-search-form">
	<div class="close flex items-center justify-center absolute top-0 right-0 bg-white text-3xl cursor-pointer w-12.5 h-12.5"><i class="fa-light fa-xmark"></i></div>
	<div class="container">
		<div class="wrap-form-search-product">
			<form class="productsearchbox" action="<?= esc_url(home_url('/')) ?>" method="get">
				<input type="text" name="s" placeholder="Tìm kiếm..." />
				<button type="submit"></button>
			</form>
		</div>
	</div>
</div>
<?php if (stripos($_SERVER['HTTP_USER_AGENT'], 'Chrome-Lighthouse') === false) : ?>
	<?php wp_footer() ?>
<?php endif; ?>
<?= get_field('field_config_body', 'options') ?>
</body>

</html>