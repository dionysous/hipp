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
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
				<div class="site-branding">
					<?php
					the_custom_logo();
					?>
					<div id="title-wrap">
						<?php
						if ( is_front_page() && is_home() ) :
							?>
							<h1 class="site-title"><?php bloginfo( 'name' ); ?></h1>
							<?php
						else :
							?>
							<p class="site-title"><?php bloginfo( 'name' ); ?></p>
							<?php
						endif;
						$hipp_description = get_bloginfo( 'description', 'display' );
						if ( $hipp_description || is_customize_preview() ) :
							?>
							<p class="site-description"><?php echo $hipp_description; /* WPCS: xss ok. */ ?></p>
						<?php endif; ?>
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
