<?php

/**
 * Add dashboard support information
 *
 *
 * @author Jonatan Olsson <jonatan@kingmary.se>
 * @since 1.0.0
 *
 * @package kingmary-wordpress-theme
 */
class King_Mary_Dashboard {
	public function __construct() {
		add_action( 'wp_dashboard_setup', array( &$this, 'add_dashboard_widget' ) );
	}

	public function add_dashboard_widget() {
		wp_add_dashboard_widget(
			'kingmary_support_widger',         // Widget slug.
			'King Mary',         // Title.
			array( &$this, 'the_dashboard_widget' ) // Display function.
		);
	}

	public function the_dashboard_widget() {
		?>
		<div class="wrap">
			<h3><strong>Supporten</strong></h3>
			<p>Eam falli feugait accusam in. Ceteros concludaturque in est, vel cu eros movet quidam, persius menandri
				necessitatibus vim ea. Te salutandi expetenda dissentiet cum, graeco scripta voluptatibus eu nam. Sed ne
				dicta paulo dicant, ut est erant instructior vituperatoribus.
			</p>
			<h3 style="font-size:21px"><span class="dashicons dashicons-phone"></span> 060-525220 (Knappval 1)</h3>
			<p>Eller</p>
			<a class="button-primary" href="mailto:support@kingmary.se?Subject=<?php bloginfo( 'blog_name' ) ?>">Maila
				Supporten</a>
		</div>

		<?php
	}

}