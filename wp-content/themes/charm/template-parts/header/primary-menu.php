<?php
/**
 * Primary Menu
 *
 * @package Smart Blog
 * @since 1.0
 */
?>
<span class="Header-nav-item Header-nav-item--folder">
			<a href="/thiet-ke-noi-that/" class="Header-nav-folder-title" data-controller="HeaderNavFolderTouch"
			   data-controllers-bound="HeaderNavFolderTouch">Thiết kế</a>
			<span class="Header-nav-folder">
				<a href="/vn/thiet-ke-noi-that" class="Header-nav-folder-item">THIẾT KẾ NỘI THẤT</a>
				<a href="/vn/thiet-ke-quan-cafe/" class="Header-nav-folder-item"
				   data-test="template-nav">THIẾT KẾ QUÁN CAFE</a>

				<a href="/vn/thiet-ke-nha-hang/" class="Header-nav-folder-item"
				   data-test="template-nav">THIẾT KẾ NHÀ HÀNG</a>

				<a href="/vn/thiet-ke-cua-hang/" class="Header-nav-folder-item"
				   data-test="template-nav">THIẾT KẾ CỬA HÀNG</a>

				<a href="/vn/thiet-ke-quan-tra-sua/" class="Header-nav-folder-item" data-test="template-nav">THIẾT KẾ QUÁN TRÀ SỮA</a>

				<a href="/vn/thiet-ke-nha/" class="Header-nav-folder-item" data-test="template-nav">THIẾT KẾ NHÀ</a>

				<a href="/vn/thiet-ke-nhan-dien-thuong-hieu/" class="Header-nav-folder-item" data-test="template-nav">THIẾT KẾ LOGO&nbsp;&amp; NHẬN DIỆN THƯƠNG HIỆU</a>

				<a href="/vn/blog/" class="Header-nav-folder-item" data-test="template-nav">BLOG</a>

				<a href="/vn/lien-he/" class="Header-nav-folder-item" data-test="template-nav">Liên hệ</a>
			</span>
		</span>
<span class="Header-nav-item Header-nav-item--folder">
			<a href="/design/" class="Header-nav-folder-title" data-controller="HeaderNavFolderTouch"
			   data-controllers-bound="HeaderNavFolderTouch">Design</a>
			<span class="Header-nav-folder">
				<a href="/en/design" class="Header-nav-folder-item">DESIGN</a>
				<a href="/en/home-designs/" class="Header-nav-folder-item" data-test="template-nav">HOME DESIGNS</a>
				<a href="/en/office-designs/" class="Header-nav-folder-item" data-test="template-nav">OFFICE DESIGNS</a>
				<a href="/en/cafe-designs/" class="Header-nav-folder-item" data-test="template-nav">CAFE DESIGNS</a>
				<a href="/en/restaurant-designs/" class="Header-nav-folder-item"
				   data-test="template-nav">RESTAURANT DESIGNS</a>
				<a href="/en/shop-designs/" class="Header-nav-folder-item" data-test="template-nav">SHOP DESIGNS</a>
				<a href="/en/logo-design/" class="Header-nav-folder-item" data-test="template-nav">LOGO DESIGNS</a>
				<a href="/en/brand-design/" class="Header-nav-folder-item" data-test="template-nav">BRAND DESIGNS</a>
			</span>
		</span>
<span class="Header-nav-item Header-nav-item--folder">
			<a href="/suunnittelu/" class="Header-nav-folder-title" data-controller="HeaderNavFolderTouch"
			   data-controllers-bound="HeaderNavFolderTouch">Suunnittelu</a>
			<span class="Header-nav-folder">
				<a href="/fi/suunnittelu" class="Header-nav-folder-item">SUUNNITTELU</a>
				<a href="/fi/kodin-sisustus/" class="Header-nav-folder-item" data-test="template-nav">KODIN SISUSTUS</a>
				<a href="/fi/toimiston-sisustus/" class="Header-nav-folder-item"
				   data-test="template-nav">TOIMISTON SISUSTUS</a>
				<a href="/fi/kaupan-sisustus/" class="Header-nav-folder-item" data-test="template-nav">KAUPAN SISUSTUS</a>
				<a href="/fi/kahvilan-sisustus/" class="Header-nav-folder-item"
				   data-test="template-nav">KAHVILAN SISUSTUS</a>
				<a href="/fi/ravintolan-sisustus/" class="Header-nav-folder-item" data-test="template-nav">RAVINTOLAN SISUSTUS</a>
				<a href="/fi/logo-suunnittelu/" class="Header-nav-folder-item" data-test="template-nav">LOGO SUUNNITTELU</a>
				<a href="/fi/graafinen-suunnittelu/" class="Header-nav-folder-item" data-test="template-nav">GRAAFINEN SUUNNITTELU</a>
			</span>
		</span>

<div class="col-md-9 col-sm-9 ">
	<div class="menu_head_m">
		<nav class="navbar menu-navar ">
			<div class="container-fluid item">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
				</div>
				<div id="navbar" class="navbar-collapse collapse">
					<ul class="nav navbar-nav" id="mmenu">
						<?php if ( has_nav_menu( 'primary_menu' ) ) { ?>
							<?php wp_nav_menu( array(
								'theme_location' => 'primary_menu',
								'menu_class' => 'nav navbar-nav',
								'menu_id' => 'mmenu',
								'container' => 'false',
								'walker' => new Custom_Walker_Nav_Menu_Top
							)); ?>
						<?php } ?>
					</ul>
					<!--<ul class="nav navbar-nav" id="mmenu">
						<li class="active"><a href="index.php"><span>HOME</span></a></li>
						<li><a href="service.php"><span>SERVICES</span> </a></li>
						<li><a href="team.php"><span>TEAM</span></a></li>
						<li><a href="blog.php"><span>BLOG</span></a></li>
						<li><a href=""><span>TRAINING</span></a></li>
						<li><a href=""><span>MEMBERS</span></a></li>
						<li><a href="contact.php"><span>CONTACT US</span></a></li>
					</ul>-->
				</div>
			</div>
		</nav>
	</div>
</div>