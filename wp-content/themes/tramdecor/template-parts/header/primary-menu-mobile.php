<?php
$locations = get_nav_menu_locations();
$menu = wp_get_nav_menu_object( $locations[ 'primary_menu' ] );
$menuitems = wp_get_nav_menu_items( $menu->term_id );
$itemsParent =  array_filter($menuitems, function ($itemParent){
	return !$itemParent->menu_item_parent;
});

$itemsMenu = array_map(function ($item) use($menuitems) {
	$data['parent'] = $item;
	$children = array_filter($menuitems, function ($child) use($item){
		return $child->menu_item_parent == $item->ID;
	});
	$data['children'] = $children;
	return $data;
}, $itemsParent);
?>

<div class="Mobile-overlay-menu-main">
	<nav class="Mobile-overlay-nav Mobile-overlay-nav--primary" data-content-field="navigation">
		<?php array_map(function ($menu) {
			$subMenu = $menu['children'];
			$menu = $menu['parent'];
			if (count($subMenu)) {
				$title =  $menu->title;
				?>
				<button class="Mobile-overlay-nav-item Mobile-overlay-nav-item--folder"
						data-controller-folder-toggle="<?php echo $menu->ID ?>">
					<span class="Mobile-overlay-nav-item--folder-label"><?php echo $title ?></span>
				</button>
			<?php } else {
				?>
				<a target="<?php echo $menu->target ?>" href="<?php echo $menu->url ?>"
				   class="Mobile-overlay-folder-item">
					<?php echo $menu->title ?>
				</a>
				<?php
			}
		}, $itemsMenu) ?>

	</nav>
	<nav class="Mobile-overlay-nav Mobile-overlay-nav--secondary" data-content-field="navigation">
	</nav>
</div>
<div class="Mobile-overlay-folders" data-content-field="navigation">
	<?php array_map(function ($menu) {
		$subMenu = $menu['children'];
		$menu = $menu['parent'];
		if (count($subMenu)) {
			?>
			<div class="Mobile-overlay-folder" data-controller-folder="<?php echo $menu->ID ?>">
				<button class="Mobile-overlay-folder-item Mobile-overlay-folder-item--toggle"
						data-controller-folder-toggle="<?php echo $menu->ID ?>">
					<span class="Mobile-overlay-folder-item--toggle-label">Back</span>
				</button>
				<?php array_map(function ($sub) use ($menu) {
					?>
					<a target="<?php echo $sub->target ?>" href="<?php echo $sub->url ?>"
					   class="Mobile-overlay-folder-item">
						<?php echo $sub->title ?>
					</a>
				<?php }, $subMenu); ?>
			</div>
			<?php
		}
	}, $itemsMenu) ?>

</div>


