<?php
/**
 * Next Docs Uninstall
 *
 * Uninstalling Next Docs deletes user roles, pages, tables, and options.
 *
 * @package     NextDocs
 */

defined( 'WP_UNINSTALL_PLUGIN' ) || exit;

// remove all the options starting with next_docs.
$delete_all_options = get_option( 'nextdocs_delete_data' );
if ( empty( $delete_all_options ) ) {
	return;
}
// Delete all the options.
global $wpdb;
$wpdb->query( "DELETE FROM $wpdb->options WHERE option_name LIKE 'nextdocs_%';" );
