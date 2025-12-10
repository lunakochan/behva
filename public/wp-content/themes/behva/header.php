<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package behva
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
<?php wp_body_open(); ?>
<div id="page" class="site">

	<header class="site-header">
		<div class="container">
			<div class="header-container">
				<?php
				the_custom_logo();
				?>

				<nav id="site-navigation" class="main-navigation">
					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'menu-primary',
							'menu_id'        => 'primary-menu',
						)
					);
					?>
				</nav><!-- #site-navigation -->
				<a class="button-primary button-start" href="#">
					Get Started
				</a>
				<button class="menu-icon">
					<i class="uil uil-bars"></i>
				</button>
			</div>
		</div>
		<div id="menu-mobile">
			<div class="container">
				<div class="menu-mobile-container">
					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'menu-primary',
							'menu_id'        => 'primary-menu-mobile',
						)
					);
					?>
					<a class="button-primary button-start mobile" href="#">
						Get Started
					</a>
				</div>
			</div>
		</div>
	</header><!-- #masthead -->
