<?php
/**
 * Event Teams
 *
 * @author 		ThemeBoy
 * @category 	Admin
 * @package 	SportsPress/Admin/Meta Boxes
 * @version     0.8.6
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * SP_Meta_Box_Event_Teams
 */
class SP_Meta_Box_Event_Teams {

	/**
	 * Output the metabox
	 */
	public static function output( $post ) {
		$limit = get_option( 'sportspress_event_teams', 2 );
		$teams = (array) get_post_meta( $post->ID, 'sp_team', false );
		for ( $i = 0; $i < $limit; $i ++ ):
			$team = array_shift( $teams );
			?>
			<div class="sp-instance">
				<p class="sp-tab-select sp-title-generator">
				<?php
				$args = array(
					'post_type' => 'sp_team',
					'name' => 'sp_team[]',
					'class' => 'sportspress-pages',
					'show_option_none' => sprintf( __( '&mdash; None &mdash;', 'sportspress' ), 'Team' ),
					'selected' => $team,
				);
				wp_dropdown_pages( $args );
				?>
				</p>
				<ul id="sp_team-tabs" class="wp-tab-bar sp-tab-bar">
					<li class="wp-tab-active"><a href="#sp_player-all"><?php _e( 'Players', 'sportspress' ); ?></a></li>
					<li class="wp-tab"><a href="#sp_staff-all"><?php _e( 'Staff', 'sportspress' ); ?></a></li>
				</ul>
				<?php
				sp_post_checklist( $post->ID, 'sp_player', 'block', 'sp_current_team', $i );
				sp_post_checklist( $post->ID, 'sp_staff', 'none', 'sp_current_team', $i );
				?>
			</div>
			<?php
		endfor;
	}

	/**
	 * Save meta box data
	 */
	public static function save( $post_id, $post ) {
		sp_update_post_meta_recursive( $post_id, 'sp_team', sp_array_value( $_POST, 'sp_team', array() ) );
		sp_update_post_meta_recursive( $post_id, 'sp_player', sp_array_value( $_POST, 'sp_player', array() ) );
		sp_update_post_meta_recursive( $post_id, 'sp_staff', sp_array_value( $_POST, 'sp_staff', array() ) );
	}
}