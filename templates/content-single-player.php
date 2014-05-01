<?php
/**
 * The template for displaying player content.
 *
 * Override this template by copying it to yourtheme/sportspress/content-single-player.php
 *
 * @author 		ThemeBoy
 * @package 	SportsPress/Templates
 * @version     0.8.1
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
if ( ! in_the_loop() ) return; // Return if not in main loop
?>

<?php
	/**
	 * sportspress_before_single_player hook
	 */
	 do_action( 'sportspress_before_single_player' );

	 if ( post_password_required() ) {
	 	echo get_the_password_form();
	 	return;
	 }
?>

<?php do_action( 'sportspress_single_player_content' ); ?>