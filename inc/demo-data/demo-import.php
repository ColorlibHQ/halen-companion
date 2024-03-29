<?php 
if( !defined( 'WPINC' ) ){
    die;
}
/**
 * @Packge     : Halen Companion
 * @Version    : 1.0
 * @Author     : Colorlib
 * @Author URI : http://colorlib.com/wp/
 *
 */

// demo import file
function halen_import_files() {
	
	$demoImg = '<img src="'.plugins_url( 'screen-image.jpg', __FILE__ ) .'" alt="'.esc_attr__( 'Demo Preview Imgae', 'halen-companion' ).'" />';
	
  return array(
    array(
      'import_file_name'             => 'Halen Demo',
      'local_import_file'            => HALEN_COMPANION_DEMO_DIR_PATH .'halen-demo.xml',
      'local_import_widget_file'     => HALEN_COMPANION_DEMO_DIR_PATH .'halen-widgets-demo.wie',
      'import_customizer_file_url'   => plugins_url( 'halen-customizer.dat', __FILE__ ),
      'import_notice' => $demoImg,
    ),
  );
}
add_filter( 'pt-ocdi/import_files', 'halen_import_files' );


// demo import setup
function halen_after_import_setup() {
	// Assign menus to their locations.
	$main_menu    = get_term_by( 'name', 'Main Menu', 'nav_menu' );
	$departments  = get_term_by( 'name', 'Departments', 'nav_menu' );
	$useful_links = get_term_by( 'name', 'Useful Links', 'nav_menu' );

	set_theme_mod( 'nav_menu_locations', array(
			'primary-menu' => $main_menu->term_id,
			'departments'  => $departments->term_id,
			'useful-links' => $useful_links->term_id,
		)
	);

	// Assign front page and posts page (blog page).
	$front_page_id = get_page_by_title( 'Homepage' );
	$blog_page_id  = get_page_by_title( 'Blog' );

	update_option( 'show_on_front', 'page' );
	update_option( 'page_on_front', $front_page_id->ID );
	update_option( 'page_for_posts', $blog_page_id->ID );
	update_option( 'posts_per_page', 3 );

	// Update the post to draft after import is done
	halen_update_the_followed_post_page_status();

	// Add an option to check after import is done
	update_option( 'halen-import-data', true );

}
add_action( 'pt-ocdi/after_import', 'halen_after_import_setup' );

//disable the branding notice after successful demo import
add_filter( 'pt-ocdi/disable_pt_branding', '__return_true' );

//change the location, title and other parameters of the plugin page
function halen_import_plugin_page_setup( $default_settings ) {
	$default_settings['parent_slug'] = 'themes.php';
	$default_settings['page_title']  = esc_html__( 'One Click Demo Import' , 'halen-companion' );
	$default_settings['menu_title']  = esc_html__( 'Import Demo Data' , 'halen-companion' );
	$default_settings['capability']  = 'import';
	$default_settings['menu_slug']   = 'halen-demo-import';

	return $default_settings;
}
add_filter( 'pt-ocdi/plugin_page_setup', 'halen_import_plugin_page_setup' );

// Enqueue scripts
function halen_demo_import_custom_scripts(){
	
	
	if( isset( $_GET['page'] ) && $_GET['page'] == 'halen-demo-import' ){
		// style
		wp_enqueue_style( 'halen-demo-import', plugins_url( 'css/demo-import.css', __FILE__ ), array(), '1.0', false );
	}
	
	
}
add_action( 'admin_enqueue_scripts', 'halen_demo_import_custom_scripts' );
