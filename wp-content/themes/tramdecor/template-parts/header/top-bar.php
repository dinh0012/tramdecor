<?php $socialLink =  WPEX_Theme_Options::get_theme_option('top_bar_right_social_icons'); ?>
<div class="top_head_charm">
	<div class="container">
		<div class="menu_th_r">
			<ul >
				<li><a target="_blank" href="<?php echo $socialLink['facebook'] ?>"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
				<li><a target="_blank" href="<?php echo $socialLink['youtube'] ?>"><i class="fa fa-youtube" aria-hidden="true"></i></a></li>
				<li><a target="_blank" href="<?php echo $socialLink['instagram'] ?>"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
				<li><a target="_blank" href="<?php echo $socialLink['linkedin'] ?>"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
				<li><a target="_blank" href="<?php echo $socialLink['twitter'] ?>"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
				<li><a target="_blank" href="<?php echo $socialLink['skype'] ?>"><i class="fa fa-skype" aria-hidden="true"></i></a></li>
				<li><a target="_blank" href="<?php echo $socialLink['pinterest'] ?>"><i class="fa fa-pinterest" aria-hidden="true"></i></a></li>
				<li><a target="_blank" href="<?php echo $socialLink['vimeo'] ?>"><i class="fa fa-vimeo-square" aria-hidden="true"></i></a></li>
				<li class="fb_menu_s">
					<a href="javascript:void(0)" class="a_search"><i class="fa fa-search" aria-hidden="true"></i></a>
					<div class="form_menu_th_search">
						<form id="" name="" method="GET" action="<?php echo get_home_url() ?>">
							<div class="input-group">
								<input name="s" id="" type="text" class="form-control text_search" placeholder="Search" value="">
								<span class="input-group-btn">
                          <button id="" name="" type="submit" class="btn" value=""><i class="fa fa-search"></i></button>
                      </span>
							</div>
						</form>
					</div>
				</li>

			</ul>

		</div>
	</div>
</div>