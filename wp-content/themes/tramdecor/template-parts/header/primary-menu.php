<?php
/**
 * Primary Menu
 *
 * @package Smart Blog
 * @since 1.0
 */
?>

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