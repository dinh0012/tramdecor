<?php $socialLink =  WPEX_Theme_Options::get_theme_option('top_bar_right_social_icons'); ?>

<!-- bắt đầu lấy từ đoạn này -->
<footer>
	<div class="container">
		<div class="head_foot">
			<div class="row">
				<div class="col-md-2 col-sm-12">
					<div class="img_hf">
						<img class="img-responsive" src="<?php echo get_template_directory_uri() . '/img/logo.png' ?>">
					</div>
				</div>
				<?php get_template_part( 'template-parts/footer/charm_outsourcing_menu' ); ?>
				<?php get_template_part( 'template-parts/footer/topics-menu' ); ?>
				<?php get_template_part( 'template-parts/footer/main-menu' ); ?>

			</div>
		</div>
		<div class="main_foot">
			<div class="main_f_h3 font_gothic_r">
				Connect with us
			</div>
			<ul>
				<li><a target="_blank" href="<?php echo $socialLink['facebook'] ?>"><i class="fa fa-facebook-official" aria-hidden="true"></i></a></li>
				<li><a target="_blank" href="<?php echo $socialLink['youtube'] ?>"><i class="fa fa-youtube" aria-hidden="true"></i></a></li>
				<li><a target="_blank" href="<?php echo $socialLink['instagram'] ?>"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
			</ul>
		</div>
		<div class="bot_foot">
			<span class="font_gothic_r">@Copyright 2018 – Charm Marketing & Charm Outsourcing all rights reserved. </span>
		</div>
	</div>
</footer>
<!-- kết thúc từ đoạn này -->
</div>
<?php wp_footer(); ?>
</body>
</html>
