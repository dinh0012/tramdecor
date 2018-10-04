<?php
/**
 * The Header for multipage of theme
 *
 * Displays all of the <head> section and everything up till </header>
 *
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

    <!-- LOADER -->
    <div id="preloader">
    	<?php $preloader = (function_exists('ot_get_option'))? ot_get_option( 'preloader', TRUVATOURTHEMEURI. '/images/loader.gif' ) : TRUVATOURTHEMEURI. '/images/loader.gif'; ?>
        <img class="preloader" src="<?php echo esc_url($preloader); ?>" alt="">
    </div><!-- end loader -->
    <!-- END LOADER -->
    
    <!-- ******************************************
    START SITE HERE
    ********************************************** -->
	<div id="wrapper">
    	<?php truvatour_custom_search_form(); ?>
    	<div class="transparent-header">        
    	<?php $header_top_bar = (function_exists('ot_get_option'))? ot_get_option( 'header_top_bar', 'off' ) : 'off'; ?>
        <?php if($header_top_bar != 'off'): ?>
        <div class="topbar">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-sm-12 hidden-xs">
                        <nav class="topbar-menu">
                        	<?php							
							wp_nav_menu(
								array(
									'theme_location' => 'top-menu-left',
									'menu_class' => 'list-inline',
									'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
									'container' => false,
									'fallback_cb'     => '',
								)
							);
							?>
                        </nav><!-- end menu -->
                    </div><!-- end col -->

                    <div class="col-md-6 col-sm-12">
                        <nav class="topbar-menu">
                            <?php
							$extra_menu_top = '';
							$header_top_contact_link = (function_exists('ot_get_option'))? ot_get_option( 'header_top_contact_link', '' ) : '';
							$header_top_time = (function_exists('ot_get_option'))? ot_get_option( 'header_top_time', '' ) : '';
							$header_top_phone = (function_exists('ot_get_option'))? ot_get_option( 'header_top_phone', '' ) : '';
							if($header_top_contact_link != ''):
								$extra_menu_top .= '<li><a href="'.esc_url($header_top_contact_link).'"><i class="flaticon-message-closed-envelope"></i> '. esc_html__('Contact', 'truvatour'). '</a></li>';
							endif;
							if($header_top_time != ''):
								$extra_menu_top .= '<li><i class="flaticon-clock-circular-outline"></i> '.esc_html($header_top_time).'</li>';
							endif;
							if($header_top_phone != ''):
								$extra_menu_top .= '<li><i class="flaticon-telephone"></i> '.esc_html($header_top_phone).'</li>';
							endif;
													
							wp_nav_menu(
								array(
									'theme_location' => 'top-menu-right',
									'menu_class' => 'list-inline text-right navbar-right',
									'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s '.$extra_menu_top.'</ul>',
									'container' => false,
									'fallback_cb'     => '',
								)
							);
							?>
                        </nav><!-- end menu -->
                    </div><!-- end col -->
                </div><!-- end row -->
            </div><!-- end container -->
        </div><!-- end topbar -->
        <?php endif; ?>
    	
    	<header class="header" data-spy="affix" data-offset-top="150">
            <div class="container">
                <nav class="navbar navbar-default">
                    <div class="container-fluid">
                        <div class="navbar-header">
							<?php $logo = (function_exists('ot_get_option'))? ot_get_option( 'main_logo_alt', TRUVATOURTHEMEURI. '/images/logo-white.png' ) : TRUVATOURTHEMEURI. '/images/logo-white.png'; ?>
                            <a class="visible-sec navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
                                <?php if($logo != ''): ?>
                                <img src="<?php echo esc_url($logo); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
                                <?php else: ?>
                                <?php echo esc_html( get_bloginfo( 'name', 'display' ) ); ?>
                                <?php endif; ?>
                            </a>
                        </div>
                        <!-- end navbar header -->
                        <div class="hidden-sec slim-wrap" data-image="<?php echo esc_attr($logo); ?>" data-homelink="<?php echo esc_url( home_url( '/' ) ); ?>">
                        	<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="home-link-text"><img src="<?php echo esc_attr($logo); ?>" alt="" /></a>
                            <?php							      
                            $args_slim = array(
                            'theme_location'  => 'main-menu',
                            'menu_class'      => 'menu-items',
                            'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                            'fallback_cb'     => '',
                            'container'       => '',
                            );											
                            wp_nav_menu( $args_slim );
                            ?>
                        </div>
                        <div id="bs-example-navbar-collapse-1" class="collapse navbar-collapse visible-sec">
                            <?php							
                            wp_nav_menu(
                                array(
                                    'theme_location' => 'main-menu',
                                    'menu_class' => 'nav navbar-nav',
                                    'menu_id' => 'truvatourMainMenu',
                                    'container' => false,
                                    'fallback_cb'     => '',
									'walker' => new truvatour_scm_walker
                                )
                            );
                            ?>
                            
                            <ul class="nav navbar-nav navbar-right">
                            <?php 
							$myaccount_page_url = '';
							$order_link = '';
							$download_link = '';
							$editaddress_link = '';
							$editaccount_link = '';
							$login_button_in_menu = (function_exists('ot_get_option'))? ot_get_option( 'login_button_in_menu', 'on' ) : 'on'; ?>
                            <?php if($login_button_in_menu != 'off'): ?>
                            	<?php
								if( class_exists( 'woocommerce' )):
									$myaccount_page = get_option( 'woocommerce_myaccount_page_id' );
									if ( $myaccount_page != '' ) {
										$myaccount_page_url = get_permalink( $myaccount_page );
										$order_link = add_query_arg( 'orders', '', $myaccount_page_url );
										$download_link = add_query_arg( 'downloads', '', $myaccount_page_url );
										$editaddress_link = add_query_arg( 'edit-address', '', $myaccount_page_url );
										$editaccount_link = add_query_arg( 'edit-account', '', $myaccount_page_url );
									}								
								endif;
								?>
                            	<?php if(is_user_logged_in()):
								$user_id = get_current_user_id();
								$user_info = get_userdata( $user_id );
								?>
                                <li class="dropdown has-submenu">
                                    <a href="#" data-target="#" class="dropdown-toggle" data-toggle="dropdown">
									<?php echo get_avatar( $user_id, 24 ); ?> <?php echo esc_html($user_info->display_name); ?></a>
                                    
                                    <ul class="dropdown-menu show-right">
                                    	<?php if( class_exists( 'woocommerce' )): ?>
                                        <?php if ( $myaccount_page != '' ) { ?>                                    	
                                        <li><a href="<?php echo esc_url($myaccount_page_url); ?>"><i class="fa fa-crosshairs"></i><?php echo esc_html__('Dashboard', 'truvatour'); ?></a></li>
                                        <li><a href="<?php echo esc_url($order_link); ?>"><i class="fa fa-bookmark"></i> <?php echo esc_html__('Orders', 'truvatour'); ?></a></li>
                                        <li><a href="<?php echo esc_url($download_link); ?>"><i class="fa fa-image"></i> <?php echo esc_html__('Downloads', 'truvatour'); ?></a></li>
                                        <li><a href="<?php echo esc_url($editaddress_link); ?>"><i class="fa fa-list"></i> <?php echo esc_html__('Addresses', 'truvatour'); ?></a></li>
                                        <li><a href="<?php echo esc_url($myaccount_page_url); ?>"><i class="fa fa-user"></i><?php echo esc_html__('Public Profile', 'truvatour'); ?></a></li>
                                        <li><a href="<?php echo esc_url($editaccount_link); ?>"><i class="fa fa-pencil-square-o"></i><?php echo esc_html__('Edit Profile', 'truvatour'); ?></a></li>
                                        <?php } ?>
										<?php endif; ?>
                                        <li><a href="<?php echo esc_url(wp_logout_url( $myaccount_page_url )); ?>"><i class="fa fa-sign-out"></i><?php echo esc_html__('Logout', 'truvatour'); ?></a></li>
                                    </ul>
                                    
                                </li>
                                <?php else: ?>
                                <?php 
								if( class_exists( 'woocommerce' )):
								$log_in_url = $myaccount_page_url;
								else:
								$log_in_url = wp_login_url();
								endif;
								?>
                                <li class="login-registration"><a title="<?php echo esc_attr__('login', 'truvatour'); ?>" href="<?php echo esc_url($log_in_url); ?>"><?php echo esc_html__('login', 'truvatour'); ?></a></li>
                                <?php endif; ?>	
                            <?php endif; ?>
                                <?php
                                $search_icon_in_menu = (function_exists('ot_get_option'))? ot_get_option( 'search_icon_in_menu', 'on' ) : 'on';
                                if($search_icon_in_menu != 'off'): ?>
                                    <li><a href="javascript:void(0)" data-toggle="modal" data-target=".bs-example-modal-lg"><i class="flaticon-search"></i></a></li>                                                      
                                <?php endif; ?>                                
                            </ul>                                                    
                        </div>
                    </div>
            	</nav>
            </div>
        </header>
        </div>
        
        <section class="section no-pad">