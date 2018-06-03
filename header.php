<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package hipp
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'hipp' ); ?></a>

	<header id="masthead" class="site-header">
		<div class="container">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="logo-link">
				<div class="site-branding">
					<?php
					the_custom_logo();
					
					?>
					<div class="title-wrap" id="title-wrap"<?php if ( display_header_text() == false ) : ?> style="display: none"<?php endif; ?>>
						<div class="site-title">
							<?php
							$hipp_title = str_replace( '.design', '<span>.design</span>', get_bloginfo( 'name' ) );
							
							echo $hipp_title; 
							
							$hipp_description = get_bloginfo( 'description', 'display' );
							
							if ( $hipp_description || is_customize_preview() ) : ?>
							<div class="site-description"><?php echo $hipp_description; /* WPCS: xss ok. */ ?></div>
							<?php endif; ?>
						</div>
					</div>
				</div><!-- .site-branding -->
			</a>

			<nav id="site-navigation" class="main-navigation">
				<div class="menu-icon menu-icon--elastic" id="menu-icon">
					<div class="menu-icon-box">
						<div class="menu-icon-inner"></div>
					</div>
				</div>
				<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', 'hipp' ); ?></button>
				<?php
				wp_nav_menu( array(
					'theme_location' => 'menu-1',
					'menu_id'        => 'primary-menu',
				) );
				?>
			</nav><!-- #site-navigation -->
		</div><!-- .container -->
	</header><!-- #masthead -->

	<div id="content" class="site-content">
