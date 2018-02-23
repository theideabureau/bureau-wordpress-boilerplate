<?php // functions/admin.php


 //*************
// ADD CPT MENU

if ( FALSE ) {

	/**
	 * Adds custom post type archive support to the menu system
	 */

	add_action('admin_head-nav-menus.php', 'inject_cpt_archives_menu_meta_box');
	add_filter('wp_get_nav_menu_items', 'cpt_archive_menu_filter', 10, 3);

	function inject_cpt_archives_menu_meta_box() {
		add_meta_box( 'add-cpt', __( 'CPT Archives', 'default' ), 'wp_nav_menu_cpt_archives_meta_box', 'nav-menus', 'side', 'default' );
	}

	function wp_nav_menu_cpt_archives_meta_box() {

		/* get custom post types with archive support */
		$post_types = get_post_types( array( 'show_in_nav_menus' => true, 'has_archive' => true ), 'object' );

		/* hydrate the necessary object properties for the walker */
		foreach ( $post_types as &$post_type ) {
			$post_type->classes = array();
			$post_type->type = $post_type->name;
			$post_type->object_id = $post_type->name;
			$post_type->title = $post_type->labels->name;
			$post_type->object = 'cpt-archive';
		}

		$walker = new Walker_Nav_Menu_Checklist( array() );

		?>
		<div id="cpt-archive" class="posttypediv">
			<div id="tabs-panel-cpt-archive" class="tabs-panel tabs-panel-active">
				<ul id="ctp-archive-checklist" class="categorychecklist form-no-clear">
					<?php
						echo walk_nav_menu_tree( array_map('wp_setup_nav_menu_item', $post_types), 0, (object) array( 'walker' => $walker) );
					?>
				</ul>
			</div><!-- /.tabs-panel -->
		</div>
		<p class="button-controls">
			<span class="add-to-menu">
				<img class="waiting" src="<?php echo esc_url( admin_url( 'images/wpspin_light.gif' ) ); ?>" alt="" />
				<input type="submit"<?php disabled( $nav_menu_selected_id, 0 ); ?> class="button-secondary submit-add-to-menu" value="<?php esc_attr_e('Add to Menu'); ?>" name="add-ctp-archive-menu-item" id="submit-cpt-archive" />
			</span>
		</p>
		<?php
	}

	/* take care of the urls */
	function cpt_archive_menu_filter( $items, $menu, $args ) {
		/* alter the URL for cpt-archive objects */
		foreach ( $items as &$item ) {
			if ( $item->object != 'cpt-archive' ) continue;
			$item->url = get_post_type_archive_link( $item->type );

			/* set current */
			if ( get_query_var( 'post_type' ) == $item->type ) {
				$item->classes []= 'current-menu-item';
				$item->current = true;
			}
		}

		return $items;
	}

}


//********************
// CUSTOM FOOTER TEXT

add_filter('admin_footer_text', function() {
	echo 'Designed and Built by <a href="https://theideabureau.co" target="_blank">The Idea Bureau</a>';
});


 //**************
// DISABLE EMOJI

add_action('init', function() {
	remove_action('admin_print_styles', 'print_emoji_styles');
	remove_action('wp_head', 'print_emoji_detection_script', 7);
	remove_action('admin_print_scripts', 'print_emoji_detection_script');
	remove_action('wp_print_styles', 'print_emoji_styles');
	remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
	remove_filter('the_content_feed', 'wp_staticize_emoji');
	remove_filter('comment_text_rss', 'wp_staticize_emoji');
});


 //*****************************
// DISABLE UPDATE NOTIFICATIONS

/*

// maintain a list of users to show update notifications to
$show_updates_to = ['username1', 'username2'];

// check the current user againsts the show updated to list
if ( array_search(wp_get_current_user()->user_login, $show_updates_to) === FALSE ) {

	// remove nag message
	add_action('after_setup_theme', function() {

		if ( ! current_user_can('update_core')) {
			return;
		}

		add_action('init', create_function('$a',"remove_action( 'init', 'wp_version_check' );"),2);
		add_filter('pre_option_update_core','__return_null');
		add_filter('pre_site_transient_update_core','__return_null');

	});

	// remove plugin update notification
	remove_action('load-update-core.php','wp_update_plugins');
	add_filter('pre_site_transient_update_plugins','__return_null');

	function remove_core_updates() {

		global $wp_version;

		return (object) array(
			'last_checked' => time(),
			'version_checked' => $wp_version
		);

	}

	add_filter('pre_site_transient_update_core','remove_core_updates');
	add_filter('pre_site_transient_update_plugins','remove_core_updates');
	add_filter('pre_site_transient_update_themes','remove_core_updates');

}

*/
