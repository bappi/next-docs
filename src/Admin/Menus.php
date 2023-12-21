<?php

namespace NextDocs\Admin;

defined( 'ABSPATH' ) || exit;

/**
 * Menus class.
 *
 * @since 1.0.0
 * @package NextDocs
 */
class Menus {

	/**
	 * Menus constructor.
	 *
	 * @since 1.0.0
	 */
	public function __construct() {
		add_action( 'admin_menu', array( $this, 'settings_menu' ), 100 );
	}

	/**
	 * Settings menu.
	 *
	 * @return void
	 * @since 1.0.0
	 */
	public function settings_menu() {
		add_submenu_page(
			'edit.php?post_type=nextdocs-docs',
			__( 'Docs Settings', 'next-docs' ),
			__( 'Docs Settings', 'next-docs' ),
			'manage_options',
			'nextdocs-settings',
			array( Settings::class, 'output' )
		);
	}
}
