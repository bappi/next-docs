<?php

namespace NextDocs\PostType;

defined( 'ABSPATH' ) || exit;

/**
 * Class Docs.
 *
 * Responsible for registering custom post type Docs.
 *
 * @package NextDocs
 * @since 1.0.0
 */
class Docs {
	/**
	 * CPT constructor.
	 *
	 * @since 1.0.0
	 */
	public function __construct() {
		add_action( 'init', array( $this, 'register_cpt' ) );
		add_filter( 'manage_nd-docs_posts_columns', array( $this, 'add_custom_column' ) );
		add_action( 'manage_nd-docs_posts_custom_column', array( $this, 'add_custom_column_data' ), 10, 2 );
	}

	/**
	 * Register custom post types.
	 *
	 * @since 1.0.0
	 */
	public function register_cpt() {
		$labels = array(
			'name'               => _x( 'Docs', 'post type general name', 'next-docs' ),
			'singular_name'      => _x( 'Doc', 'post type singular name', 'next-docs' ),
			'menu_name'          => _x( 'Next Docs', 'admin menu', 'next-docs' ),
			'name_admin_bar'     => _x( 'Doc', 'add new on admin bar', 'next-docs' ),
			'add_new'            => _x( 'Add New Doc', 'ticket', 'next-docs' ),
			'add_new_item'       => __( 'Add New Doc', 'next-docs' ),
			'new_item'           => __( 'New Doc', 'next-docs' ),
			'edit_item'          => __( 'Edit Doc', 'next-docs' ),
			'view_item'          => __( 'View Doc', 'next-docs' ),
			'all_items'          => __( 'All Docs', 'next-docs' ),
			'search_items'       => __( 'Search Docs', 'next-docs' ),
			'parent_item_colon'  => __( 'Parent Docs:', 'next-docs' ),
			'not_found'          => __( 'No docs found.', 'next-docs' ),
			'not_found_in_trash' => __( 'No docs found in Trash.', 'next-docs' ),
		);

		$args = array(
			'labels'              => apply_filters( 'nextdocs_post_type_labels', $labels ),
			'public'              => true,
			'publicly_queryable'  => true,
			'exclude_from_search' => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'show_in_nav_menus'   => true,
			'query_var'           => true,
			'can_export'          => true,
			'rewrite'             => true,
			'capability_type'     => 'post',
			'has_archive'         => true,
			'hierarchical'        => true,
			'menu_position'       => 25,
			'menu_icon'           => 'dashicons-buddicons-replies',
			'supports'            => array(
				'title',
				'editor',
				'author',
				'thumbnail',
				'excerpt',
				'trackbacks',
				'custom-fields',
				'revisions',
				'page-attributes',
				'post-formats',
			),
		);
		register_post_type( 'nd-docs', apply_filters( 'nextdocs_post_type_args', $args ) );

		// Register docs category.
		register_taxonomy(
			'nd-docs-cat',
			array( 'nd-docs' ),
			array(
				'hierarchical'      => true,
				'show_ui'           => true,
				'show_in_rest'      => true,
				'show_admin_column' => true,
				'query_var'         => true,
				'rewrite'           => array( 'slug' => 'nd-docs-cat' ),
				'labels'            => array(
					'name'              => _x( 'Categories', 'Docs category general name', 'next-docs' ),
					'singular_name'     => _x( 'Category', 'Docs category singular name', 'next-docs' ),
					'search_items'      => __( 'Search Categories', 'next-docs' ),
					'all_items'         => __( 'All Categories', 'next-docs' ),
					'parent_item'       => __( 'Parent Category', 'next-docs' ),
					'parent_item_colon' => __( 'Parent Category:', 'next-docs' ),
					'edit_item'         => __( 'Edit Category', 'next-docs' ),
					'update_item'       => __( 'Update Category', 'next-docs' ),
					'add_new_item'      => __( 'Add New Category', 'next-docs' ),
					'new_item_name'     => __( 'New Category Name', 'next-docs' ),
					'menu_name'         => __( 'Categories', 'next-docs' ),
				),
			)
		);
	}


	/**
	 * Add custom column.
	 *
	 * @param array $columns All column of nd-docs.
	 *
	 * @since 1.0.0
	 * @return array
	 */
	public function add_custom_column( $columns ) {
		// TODO: will be implement later.
		return $columns;
	}

	/**
	 * Add custom column data.
	 *
	 * @param array $columns All column of nd-docs.
	 * @param int   $post_id All column of nd-docs.
	 *
	 * @since 1.0.0
	 * @return void
	 */
	public function add_custom_column_data( $columns, $post_id ) {
		// TODO: will be implement later.
	}
}
