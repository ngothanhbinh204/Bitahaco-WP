<?php
/**
 * Template Name: Sitemap Template
 */
get_header(); 

?>
<main>
	<div class="sitemap-tree-container">
		<ul class="sitemap-root">
			<li class="sitemap-item">
				<div class="sitemap-card bg-white border-0 !shadow-none !p-0">
					<button class="sitemap-toggle"><span>+</span></button><img
						src="https://bitahaco.webcanhcam.vn/wp-content/uploads/2026/01/logo.png" alt="Bitahaco">
				</div>
				<ul class="sitemap-children">
					<li class="sitemap-item">
						<div class="sitemap-card bg-blue-900"><a class="sitemap-link" href="javascript:void(0)">Trang
								chủ</a>
						</div>
					</li>
					<li class="sitemap-item">
						<div class="sitemap-card bg-blue-900"><a class="sitemap-link" href="javascript:void(0)">Giới
								thiệu</a>
						</div>
					</li>
					<li class="sitemap-item">
						<div class="sitemap-card bg-blue-900">
							<button class="sitemap-toggle"><span>+</span></button><a class="sitemap-link"
								href="javascript:void(0)">Tin tức</a>
						</div>
						<ul class="sitemap-children">
							<li class="sitemap-item">
								<div class="sitemap-card bg-blue-700">
									<button class="sitemap-toggle"><span>+</span></button><a class="sitemap-link"
										href="javascript:void(0)">Danh sách tin tức</a>
								</div>
								<ul class="sitemap-children">
									<li class="sitemap-item">
										<div class="sitemap-card bg-blue-500"><a class="sitemap-link"
												href="javascript:void(0)">Chi tiết tin tức</a>
										</div>
									</li>
								</ul>
							</li>
						</ul>
					</li>
					<li class="sitemap-item">
						<div class="sitemap-card bg-blue-900">
							<button class="sitemap-toggle"><span>+</span></button><a class="sitemap-link"
								href="javascript:void(0)">Lĩnh vực hoạt động</a>
						</div>
						<ul class="sitemap-children">
							<li class="sitemap-item">
								<div class="sitemap-card bg-blue-700">
									<button class="sitemap-toggle"><span>+</span></button><a class="sitemap-link"
										href="javascript:void(0)">Danh sách lĩnh vực</a>
								</div>
								<ul class="sitemap-children">
									<li class="sitemap-item">
										<div class="sitemap-card bg-blue-500"><a class="sitemap-link"
												href="javascript:void(0)">Chi tiết lĩnh vực</a>
										</div>
									</li>
								</ul>
							</li>
						</ul>
					</li>
					<li class="sitemap-item">
						<div class="sitemap-card bg-blue-900">
							<button class="sitemap-toggle"><span>+</span></button><a class="sitemap-link"
								href="javascript:void(0)">Cổ đông</a>
						</div>
						<ul class="sitemap-children">
							<li class="sitemap-item">
								<div class="sitemap-card bg-blue-700">
									<button class="sitemap-toggle"><span>+</span></button><a class="sitemap-link"
										href="javascript:void(0)">Danh sách cổ đông</a>
								</div>
								<ul class="sitemap-children">
									<li class="sitemap-item">
										<div class="sitemap-card bg-blue-500"><a class="sitemap-link"
												href="javascript:void(0)">Chi tiết cổ đông</a>
										</div>
									</li>
								</ul>
							</li>
						</ul>
					</li>
					<li class="sitemap-item">
						<div class="sitemap-card bg-blue-900">
							<button class="sitemap-toggle"><span>+</span></button><a class="sitemap-link"
								href="javascript:void(0)">Tài liệu</a>
						</div>
						<ul class="sitemap-children">
							<li class="sitemap-item">
								<div class="sitemap-card bg-blue-700">
									<button class="sitemap-toggle"><span>+</span></button><a class="sitemap-link"
										href="javascript:void(0)">Danh sách tài liệu</a>
								</div>
								<ul class="sitemap-children">
									<li class="sitemap-item">
										<div class="sitemap-card bg-blue-500"><a class="sitemap-link"
												href="javascript:void(0)">Chi tiết tài liệu</a>
										</div>
									</li>
								</ul>
							</li>
						</ul>
					</li>
					<li class="sitemap-item">
						<div class="sitemap-card bg-blue-900"><a class="sitemap-link" href="javascript:void(0)">Liên
								hệ</a>
						</div>
					</li>
				</ul>
			</li>
		</ul>
	</div>
</main>

<?php get_footer(); ?>