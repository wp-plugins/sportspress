<?php
global $sportspress_sports;

$sportspress_sports['soccer'] = array(
	'name' => __( 'Soccer (Association Football)', 'sportspress' ),
	'terms' => array(
		// Positions
		'sp_position' => array(
			array(
				'name' => 'Goalkeeper',
				'slug' => 'goalkeeper',
			),
			array(
				'name' => 'Defender',
				'slug' => 'defender',
			),
			array(
				'name' => 'Midfielder',
				'slug' => 'midfielder',
			),
			array(
				'name' => 'Forward',
				'slug' => 'forward',
			),
		),
	),
	'posts' => array(
		// Results
		'sp_result' => array(
			array(
				'post_title' => '1',
				'post_name'  => 'one',
			),
			array(
				'post_title' => '2',
				'post_name'  => 'two',
			),
			array(
				'post_title' => 'Goals',
				'post_name'  => 'goals',
			),
		),
		// Outcomes
		'sp_outcome' => array(
			array(
				'post_title' => 'W',
				'post_name'  => 'w',
			),
			array(
				'post_title' => 'D',
				'post_name'  => 'd',
			),
			array(
				'post_title' => 'L',
				'post_name'  => 'l',
			),
		),
		// Table Columns
		'sp_column' => array(
			array(
				'post_title' => 'P',
				'post_name'  => 'p',
				'meta'       => array(
					'sp_equation'     => '$eventsplayed',
					'sp_precision'    => 1,
				),
			),
			array(
				'post_title' => 'W',
				'post_name'  => 'w',
				'meta'       => array(
					'sp_equation'     => '$w',
					'sp_precision'    => 1,
				),
			),
			array(
				'post_title' => 'D',
				'post_name'  => 'd',
				'meta'       => array(
					'sp_equation'     => '$d',
					'sp_precision'    => 1,
				),
			),
			array(
				'post_title' => 'L',
				'post_name'  => 'l',
				'meta'       => array(
					'sp_equation'     => '$l',
					'sp_precision'    => 1,
				),
			),
			array(
				'post_title' => 'F',
				'post_name'  => 'f',
				'meta'       => array(
					'sp_equation'     => '$goalsfor',
					'sp_precision'    => 1,
					'sp_priority'     => '3',
					'sp_order'        => 'DESC',
				),
			),
			array(
				'post_title' => 'A',
				'post_name'  => 'a',
				'meta'       => array(
					'sp_equation'     => '$goalsagainst',
					'sp_precision'    => 1,
				),
			),
			array(
				'post_title' => 'GD',
				'post_name'  => 'gd',
				'meta'       => array(
					'sp_equation'     => '$goalsfor - $goalsagainst',
					'sp_precision'    => 1,
					'sp_priority'     => '2',
					'sp_order'        => 'DESC',
				),
			),
			array(
				'post_title' => 'Pts',
				'post_name'  => 'pts',
				'meta'       => array(
					'sp_equation'     => '$w * 3 + $d',
					'sp_precision'    => 1,
					'sp_priority'     => '1',
					'sp_order'        => 'DESC',
				),
			),
		),
		// Player Metrics
		'sp_metric' => array(
			array(
				'post_title' => 'Height',
				'post_name'  => 'height',
			),
			array(
				'post_title' => 'Weight',
				'post_name'  => 'weight',
			),
		),
		// Player Statistics
		'sp_statistic' => array(
			array(
				'post_title' => 'Goals',
				'post_name'  => 'goals',
				'meta'       => array(
					'sp_calculate'     => 'sum',
				),
				'tax_input' => array(
					'sp_position' => array(
						'goalkeeper',
						'defender',
						'midfielder',
						'striker',
					),
				),
			),
			array(
				'post_title' => 'Assists',
				'post_name'  => 'assists',
				'meta'       => array(
					'sp_calculate'     => 'sum',
				),
				'tax_input' => array(
					'sp_position' => array(
						'goalkeeper',
						'defender',
						'midfielder',
						'striker',
					),
				),
			),
			array(
				'post_title' => 'Yellow Cards',
				'post_name'  => 'yellowcards',
				'meta'       => array(
					'sp_calculate'     => 'sum',
				),
				'tax_input' => array(
					'sp_position' => array(
						'goalkeeper',
						'defender',
						'midfielder',
						'striker',
					),
				),
			),
			array(
				'post_title' => 'Red Cards',
				'post_name'  => 'redcards',
				'meta'       => array(
					'sp_calculate'     => 'sum',
				),
				'tax_input' => array(
					'sp_position' => array(
						'goalkeeper',
						'defender',
						'midfielder',
						'striker',
					),
				),
			),
		),
	),
);
