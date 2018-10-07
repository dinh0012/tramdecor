<header id="mobile">
	<button href="" title="" class="nav-toggle ml-auto">
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
	</button>

	<div class="Mobile-overlay">
		<div class="Mobile-overlay-menu" data-controller="MobileOverlayFolders"
			 data-controllers-bound="MobileOverlayFolders">
			<div class="Mobile-overlay-menu-main">
				<nav class="Mobile-overlay-nav Mobile-overlay-nav--primary" data-content-field="navigation">

					<button class="Mobile-overlay-nav-item Mobile-overlay-nav-item--folder"
							data-controller-folder-toggle="thiet-ke-noi-that">
						<span class="Mobile-overlay-nav-item--folder-label">Thiết kế</span>
					</button>

					<button class="Mobile-overlay-nav-item Mobile-overlay-nav-item--folder"
							data-controller-folder-toggle="design">
						<span class="Mobile-overlay-nav-item--folder-label">Design</span>
					</button>

					<button class="Mobile-overlay-nav-item Mobile-overlay-nav-item--folder"
							data-controller-folder-toggle="suunnittelu">
						<span class="Mobile-overlay-nav-item--folder-label">Suunnittelu</span>
					</button>

				</nav>
				<nav class="Mobile-overlay-nav Mobile-overlay-nav--secondary" data-content-field="navigation">

				</nav>
			</div>
			<div class="Mobile-overlay-folders" data-content-field="navigation">

				<div class="Mobile-overlay-folder" data-controller-folder="thiet-ke-noi-that">
					<button class="Mobile-overlay-folder-item Mobile-overlay-folder-item--toggle"
							data-controller-folder-toggle="thiet-ke-noi-that">
						<span class="Mobile-overlay-folder-item--toggle-label">Back</span>
					</button>

					<a href="/vn/thiet-ke-noi-that" class="Mobile-overlay-folder-item">
						THIẾT KẾ NỘI THẤT
					</a>

					<a href="/vn/thiet-ke-quan-cafe/" class="Mobile-overlay-folder-item">
						THIẾT KẾ QUÁN CAFE
					</a>

					<a href="/vn/thiet-ke-nha-hang/" class="Mobile-overlay-folder-item">
						THIẾT KẾ NHÀ HÀNG
					</a>

					<a href="/vn/thiet-ke-cua-hang/" class="Mobile-overlay-folder-item">
						THIẾT KẾ CỬA HÀNG
					</a>

					<a href="/vn/thiet-ke-quan-tra-sua/" class="Mobile-overlay-folder-item">
						THIẾT KẾ QUÁN TRÀ SỮA
					</a>

					<a href="/vn/thiet-ke-nha/" class="Mobile-overlay-folder-item">
						THIẾT KẾ NHÀ
					</a>

					<a href="/vn/thiet-ke-nhan-dien-thuong-hieu/" class="Mobile-overlay-folder-item">
						THIẾT KẾ LOGO&nbsp;&amp; NHẬN DIỆN THƯƠNG HIỆU
					</a>

					<a href="/vn/blog/" class="Mobile-overlay-folder-item">
						BLOG
					</a>

					<a href="/vn/lien-he/" class="Mobile-overlay-folder-item">
						Liên hệ
					</a>

				</div>

				<div class="Mobile-overlay-folder" data-controller-folder="design">
					<button class="Mobile-overlay-folder-item Mobile-overlay-folder-item--toggle"
							data-controller-folder-toggle="design">
						<span class="Mobile-overlay-folder-item--toggle-label">Back</span>
					</button>

					<a href="/en/design" class="Mobile-overlay-folder-item">
						DESIGN
					</a>

					<a href="/en/home-designs/" class="Mobile-overlay-folder-item">
						HOME DESIGNS
					</a>

					<a href="/en/office-designs/" class="Mobile-overlay-folder-item">
						OFFICE DESIGNS
					</a>

					<a href="/en/cafe-designs/" class="Mobile-overlay-folder-item">
						CAFE DESIGNS
					</a>

					<a href="/en/restaurant-designs/" class="Mobile-overlay-folder-item">
						RESTAURANT DESIGNS
					</a>

					<a href="/en/shop-designs/" class="Mobile-overlay-folder-item">
						SHOP DESIGNS
					</a>

					<a href="/en/logo-design/" class="Mobile-overlay-folder-item">
						LOGO DESIGNS
					</a>

					<a href="/en/brand-design/" class="Mobile-overlay-folder-item">
						BRAND DESIGNS
					</a>

				</div>

				<div class="Mobile-overlay-folder" data-controller-folder="suunnittelu">
					<button class="Mobile-overlay-folder-item Mobile-overlay-folder-item--toggle"
							data-controller-folder-toggle="suunnittelu">
						<span class="Mobile-overlay-folder-item--toggle-label">Back</span>
					</button>

					<a href="/fi/suunnittelu" class="Mobile-overlay-folder-item">
						SUUNNITTELU
					</a>

					<a href="/fi/kodin-sisustus/" class="Mobile-overlay-folder-item">
						KODIN SISUSTUS
					</a>

					<a href="/fi/toimiston-sisustus/" class="Mobile-overlay-folder-item">
						TOIMISTON SISUSTUS
					</a>

					<a href="/fi/kaupan-sisustus/" class="Mobile-overlay-folder-item">
						KAUPAN SISUSTUS
					</a>

					<a href="/fi/kahvilan-sisustus/" class="Mobile-overlay-folder-item">
						KAHVILAN SISUSTUS
					</a>

					<a href="/fi/ravintolan-sisustus/" class="Mobile-overlay-folder-item">
						RAVINTOLAN SISUSTUS
					</a>

					<a href="/fi/logo-suunnittelu/" class="Mobile-overlay-folder-item">
						LOGO SUUNNITTELU
					</a>

					<a href="/fi/graafinen-suunnittelu/" class="Mobile-overlay-folder-item">
						GRAAFINEN SUUNNITTELU
					</a>

				</div>

			</div>
		</div>
		<button class="Mobile-overlay-close" data-controller="MobileOverlayToggle"
				data-controllers-bound="MobileOverlayToggle">
			<svg class="Icon Icon--close" viewBox="0 0 16 16">
				<use xlink:href="<?php echo get_template_directory_uri() ?>/img/ui-icons.svg#close-icon"></use>
			</svg>
		</button>
		<div class="Mobile-overlay-back" data-controller="MobileOverlayToggle"
			 data-controllers-bound="MobileOverlayToggle"></div>
	</div>
</header>