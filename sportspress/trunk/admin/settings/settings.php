<?php
function sportspress_settings() {

	$active_tab = isset( $_GET[ 'tab' ] ) ? $_GET[ 'tab' ] : 'general';

?>
	<div class="wrap">

		<h2 class="nav-tab-wrapper">
			<a href="?page=sportspress" class="nav-tab<?php echo $active_tab == 'general' ? ' nav-tab-active' : ''; ?>"><?php _e( 'SportsPress', 'sportspress' ); ?></a>
			<a href="?page=sportspress&tab=events" class="nav-tab<?php echo $active_tab == 'events' ? ' nav-tab-active' : ''; ?>"><?php _e( 'Events', 'sportspress' ); ?></a>
			<a href="?page=sportspress&tab=tables" class="nav-tab<?php echo $active_tab == 'tables' ? ' nav-tab-active' : ''; ?>"><?php _e( 'League Tables', 'sportspress' ); ?></a>
			<a href="?page=sportspress&tab=players" class="nav-tab<?php echo $active_tab == 'players' ? ' nav-tab-active' : ''; ?>"><?php _e( 'Players', 'sportspress' ); ?></a>
		</h2>

		<form method="post" action="options.php">
			<?php
				switch ( $active_tab ):
					case 'events':
						include 'events.php';
						break;
					case 'tables':
						include 'tables.php';
						break;
					case 'players':
						include 'players.php';
						break;
					default:
						include 'general.php';
				endswitch;
			?>
		</form>
		
	</div>
<?php
}

function sportspress_sport_callback() {
	global $sportspress_sports;
	$options = get_option( 'sportspress' );
	?>
	<select id="sportspress_sport" name="sportspress[sport]">
		<?php foreach( $sportspress_sports as $slug => $sport ): ?>
			<option value="<?php echo $slug; ?>" <?php selected( $options['sport'], $slug ); ?>><?php echo $sport['name']; ?></option>
		<?php endforeach; ?>
	</select>
	<?php
}

function sportspress_team_stats_callback() {
	sportspress_render_option_field( 'sportspress_stats', 'team', 'textarea' );
}

function sportspress_event_stats_callback() {
	sportspress_render_option_field( 'sportspress_stats', 'event', 'textarea' );
}

function sportspress_player_stats_callback() {
	sportspress_render_option_field( 'sportspress_stats', 'player', 'textarea' );
}

function sportspress_settings_init() {

    $installed = get_option( 'sportspress_installed', false );
	
	// General settings
	register_setting(
		'sportspress_general',
		'sportspress',
		'sportspress_validate'
	);
	
	add_settings_section(
		'general',
		'',
		'',
		'sportspress_general'
	);
	
	add_settings_field(	
		'sport',
		__( 'Sport', 'sportspress' ),
		'sportspress_sport_callback',	
		'sportspress_general',
		'general'
	);

	// Event Settings
	register_setting(
		'sportspress_events',
		'sportspress',
		'sportspress_validate'
	);
	
	add_settings_section(
		'events',
		'',
		'',
		'sportspress_events'
	);
	
	add_settings_field(	
		'sport',
		__( 'Sport', 'sportspress' ),
		'sportspress_sport_callback',	
		'sportspress_events',
		'events'
	);
	
}
add_action( 'admin_init', 'sportspress_settings_init', 1 );

function sportspress_validate( $input ) {
	
	$options = get_option( 'sportspress' );

	// Do nothing if sport is the same as currently selected
	if ( sportspress_array_value( $options, 'sport', null ) == sportspress_array_value( $input, 'sport', null ) )

		return $input;

	// Get sports presets
	global $sportspress_sports;

	// Get array of post types to insert
	$post_groups = sportspress_array_value( sportspress_array_value( $sportspress_sports, sportspress_array_value( $input, 'sport', null ), array() ), 'posts', array() );

	// Loop through each post type
	foreach( $post_groups as $post_type => $posts ):

		$args = array(
			'post_type' => $post_type,
			'numberposts' => -1,
			'posts_per_page' => -1,
			'meta_query' => array(
				array(
					'key' => 'sp_preset',
					'value' => 1
				)
			)
		);

		// Delete posts
		$old_posts = get_posts( $args );

		foreach( $old_posts as $post ):
			wp_delete_post( $post->ID, true);
		endforeach;

		// Add posts
		foreach( $posts as $index => $post ):

			// Make sure post doesn't overlap
			if ( ! get_page_by_path( $post['post_name'], OBJECT, $post_type ) ):

				// Translate post title
				$post['post_title'] = __( $post['post_title'], 'sportspress' );

				// Set post type
				$post['post_type'] = $post_type;

				// Increment menu order by 2 and publish post
				$post['menu_order'] = $index * 2 + 2;
				$post['post_status'] = 'publish';
				$id = wp_insert_post( $post );

				// Flag as preset
				update_post_meta( $id, 'sp_preset', 1 );

				// Update meta
				if ( array_key_exists( 'meta', $post ) ):

					foreach ( $post['meta'] as $key => $value ):

						update_post_meta( $id, $key, $value );

					endforeach;

				endif;

			endif;

		endforeach;

	endforeach;

	return $input;
}

function sportspress_add_options_page() {
	add_options_page(
		__( 'SportsPress', 'sportspress' ),
		__( 'SportsPress', 'sportspress' ),
		'manage_options',
		'sportspress',
		'sportspress_settings'
	);
}
add_action( 'admin_menu', 'sportspress_add_options_page' );
