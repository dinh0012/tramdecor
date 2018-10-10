<header id="mobile">
	<button href="" title="" class="nav-toggle ml-auto">
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
	</button>

	<div class="Mobile-overlay">
		<div class="Mobile-overlay-menu" data-controller="MobileOverlayFolders"
			 data-controllers-bound="MobileOverlayFolders">
			<?php get_template_part('template-parts/header/primary-menu-mobile'); ?>
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