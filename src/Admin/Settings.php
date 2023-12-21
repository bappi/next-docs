<?php

namespace NextDocs\Admin;

use NextDocs\Lib;

defined( 'ABSPATH' ) || exit;

/**
 * Class Settings.
 *
 * @since   1.0.0
 * @package NextDocs\Admin
 */
class Settings extends Lib\Settings {

	/**
	 * Get settings tabs.
	 *
	 * @since 1.0.0
	 * @return array
	 */
	public function get_tabs() {
		$tabs = array(
			'general' => __( 'General', 'next-docs' ),
		);

		return apply_filters( 'next_docs_settings_tabs', $tabs );
	}

	/**
	 * Get settings.
	 *
	 * @param string $tab Current tab.
	 *
	 * @since 1.0.0
	 * @return array
	 */
	public function get_settings( $tab ) {
		$settings = array();

		switch ( $tab ) {
			case 'general':
				$settings = array(
					array(
						'title' => __( 'General settings', 'next-docs' ),
						'type'  => 'title',
						'desc'  => __( 'The following options affect how the plugin will work.', 'next-docs' ),
						'id'    => 'general_options',
					),
					array(
						'title'    => __( 'Next Docs', 'next-docs' ),
						'id'       => 'nextdocs_is_enable',
						'desc'     => __( 'Enable/Disable plugin.', 'next-docs' ),
						'desc_tip' => __( 'Click to enable/disable plugin functionality.', 'next-docs' ),
						'type'     => 'checkbox',
						'default'  => 'yes',
					),
					array(
						'type' => 'sectionend',
						'id'   => 'general_options',
					),
				);
				break;
			default:
				break;
		}

		return apply_filters( 'next_docs_get_settings_' . $tab, $settings );
	}

	/**
	 * Output tabs.
	 *
	 * @param array $tabs Tabs.
	 *
	 * @since 1.0.0
	 * @return void
	 */
	public function output_tabs( $tabs ) {
		parent::output_tabs( $tabs );
		if ( next_docs()->get_docs_url() ) {
			printf( '<a href="%s" class="nav-tab" target="_blank">%s</a>', esc_url( next_docs()->get_docs_url() ), esc_html__( 'Documentation', 'next-docs' ) );
		}
	}

	/**
	 * Output settings.
	 *
	 * @since 1.0.0
	 * @return void
	 */
	public function output_settings() {
		$tabs        = $this->get_tabs();
		$current_tab = $this->get_current_tab();
		$tab_exists  = isset( $tabs[ $current_tab ] );
		$settings    = $this->get_settings( $current_tab );
		if ( ! empty( $tabs ) && ! $tab_exists && ! headers_sent() ) {
			wp_safe_redirect( admin_url( 'admin.php?page=' . $this->get_current_page() ) );
			exit();
		}
		?>
		<div class="wrap pev-wrap woocommerce">
			<nav class="nav-tab-wrapper pev-navbar">
				<?php $this->output_tabs( $tabs ); ?>
			</nav>
			<hr class="wp-header-end">
			<div class="pev-poststuff">
				<div class="column-1">
					<?php $this->output_form( $settings ); ?>
				</div>
				<div class="column-2">
				</div>
			</div>
		</div>
		<script type="text/javascript">
			document.addEventListener('DOMContentLoaded', function () {
				document.querySelectorAll('[data-cond-id]').forEach(function (element) {
					var $this = element;
					var conditional_id = $this.getAttribute('data-cond-id');
					var conditional_value = $this.getAttribute('data-cond-value') || '';
					var conditional_operator = $this.getAttribute('data-cond-operator') || '==';
					var $conditional_field = document.getElementById(conditional_id);
					$conditional_field.addEventListener('change', function () {
						var value = this.value.trim();
						if (this.type === 'checkbox' || this.type === 'radio') {
							conditional_operator = 'checked';
						}

						var show = false;
						if (conditional_operator === '==') {
							show = value == conditional_value ? true : false; // eslint-disable-line eqeqeq
						} else if (conditional_operator === '!=') {
							show = value != conditional_value; // eslint-disable-line eqeqeq
						} else if (conditional_operator === 'contains') {
							show = value.indexOf(conditional_value) > -1;
						} else if (conditional_operator === 'checked') {
							show = this.checked;
						} else {
							show = false;
						}

						if (show) {
							$this.closest('tr').style.display = 'block';
						} else {
							$this.closest('tr').style.display = 'none';
						}
					});

					$conditional_field.dispatchEvent(new Event('change'));
				});
			});
		</script>
		<?php
	}
}
