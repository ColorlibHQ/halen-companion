<?php
if ( ! defined( 'WPINC' ) ) {
	die;
}
/**
 * @Packge     : Halen Companion
 * @Version    : 1.0
 * @Author     : Colorlib
 * @Author     URI : http://colorlib.com/wp/
 *
 */


/*===========================================================
	Get elementor templates
============================================================*/
function get_elementor_templates() {
	$options = [];
	$args = [
		'post_type' => 'elementor_library',
		'posts_per_page' => -1,
	];

	$page_templates = get_posts($args);

	if (!empty($page_templates) && !is_wp_error($page_templates)) {
		foreach ($page_templates as $post) {
			$options[$post->ID] = $post->post_title;
		}
	}
	return $options;
}

// Section Heading
function halen_section_heading( $title = '', $subtitle = '' ) {
	if( $title || $subtitle ) :
	?>
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="section-heading text-center">
						<?php
						// Sub title
						if ( $subtitle ) {
							echo '<p>' . esc_html( $subtitle ) . '</p>';
						}
						// Title
						if ( $title ) {
							echo '<h2>' . esc_html( $title ) . '</h2>';
						}
						?>
					</div>
				</div>
			</div>
		</div>
	<?php
	endif;
}

// Enqueue scripts
add_action( 'wp_enqueue_scripts', 'halen_companion_frontend_scripts', 99 );
function halen_companion_frontend_scripts() {

	wp_enqueue_script( 'halen-companion-script', plugins_url( '../js/loadmore-ajax.js', __FILE__ ), array( 'jquery' ), '1.0', true );
	wp_enqueue_script( 'halen-common-js', plugins_url( '../js/common.js', __FILE__ ), array( 'jquery' ), '1.0', true );

}
// 
add_action( 'wp_ajax_halen_portfolio_ajax', 'halen_portfolio_ajax' );

add_action( 'wp_ajax_nopriv_halen_portfolio_ajax', 'halen_portfolio_ajax' );
function halen_portfolio_ajax( ){

	ob_start();

	if( !empty( $_POST['elsettings'] ) ):


		$items = array_slice( $_POST['elsettings'], $_POST['postNumber'] );

	    $i = 0;
	    foreach( $items as $val ):

	    $tagclass = sanitize_title_with_dashes( $val['label'] );
	    $i++;
	?>
	<div class="single_gallery_item <?php echo esc_attr( $tagclass ); ?>">
	    <?php 
	    if( !empty( $val['img']['url'] ) ){
	        echo '<img src="'.esc_url( $val['img']['url'] ).'" />';
	    }
	    ?>
	    <div class="gallery-hover-overlay d-flex align-items-center justify-content-center">
	        <div class="port-hover-text text-center">
	            <?php 
	            if( !empty( $val['title'] ) ){
	                echo halen_heading_tag(
	                    array(
	                        'tag'  => 'h4',
	                        'text' => esc_html( $val['title'] )
	                    )
	                );
	            }

	            if( !empty( $val['sub-title-url'] ) &&  !empty( $val['sub-title'] ) ){
	                echo '<a href="'.esc_url( $val['sub-title-url'] ).'">'.esc_html( $val['sub-title'] ).'</a>';
	            }else{
	                echo '<p>'.esc_html( $val['sub-title'] ).'</p>';
	            }
	            ?>
	            
	        </div>
	    </div>
	</div>

	<?php 

	if( !empty( $_POST['postIncrNumber'] ) ){

	    if( $i == $_POST['postIncrNumber'] ){
	        break;
	    }
	}
	    endforeach;
	endif;
	echo ob_get_clean();
	die();
}

	// Update the post/page by your arguments
	function halen_update_the_followed_post_page_status( $title = 'Hello world!', $type = 'post', $status = 'draft', $message = false ){

		// Get the post/page by title
		$target_post_id = get_page_by_title( $title, OBJECT, $type);

		// Post/page arguments
		$target_post = array(
			'ID'    => $target_post_id->ID,
			'post_status'   => $type,
		);

		if ( $message == true ) {
			// Update the post/page
			$update_status = wp_update_post( $target_post, true );
		} else {
			// Update the post/page
			$update_status = wp_update_post( $target_post, false );
		}

		return $update_status;
	}


	
// Portfolio - Custom Post Type
function halen_custom_posts() {	
	$labels = array(
		'name'               => _x( 'Portfolios', 'post type general name', 'halen-companion' ),
		'singular_name'      => _x( 'Portfolio', 'post type singular name', 'halen-companion' ),
		'menu_name'          => _x( 'Portfolios', 'admin menu', 'halen-companion' ),
		'name_admin_bar'     => _x( 'Portfolio', 'add new on admin bar', 'halen-companion' ),
		'add_new'            => _x( 'Add New', 'portfolio', 'halen-companion' ),
		'add_new_item'       => __( 'Add New Portfolio', 'halen-companion' ),
		'new_item'           => __( 'New Portfolio', 'halen-companion' ),
		'edit_item'          => __( 'Edit Portfolio', 'halen-companion' ),
		'view_item'          => __( 'View Portfolio', 'halen-companion' ),
		'all_items'          => __( 'All Portfolios', 'halen-companion' ),
		'search_items'       => __( 'Search Portfolios', 'halen-companion' ),
		'parent_item_colon'  => __( 'Parent Portfolios:', 'halen-companion' ),
		'not_found'          => __( 'No portfolios found.', 'halen-companion' ),
		'not_found_in_trash' => __( 'No portfolios found in Trash.', 'halen-companion' )
	);

	$args = array(
		'labels'             => $labels,
		'description'        => __( 'Description.', 'halen-companion' ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'portfolio' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array( 'title', 'editor', 'thumbnail' )
	);

	register_post_type( 'portfolio', $args );

}
add_action( 'init', 'halen_custom_posts' );



/*=========================================================
    Courses Section
========================================================*/
function halen_portfolio_section( $pNumber = 3 ){ 
	$portfolios = new WP_Query( array(
		'post_type' => 'portfolio',
		'posts_per_page'=> $pNumber,

	) );
	
	if( $portfolios->have_posts() ) {
		while ( $portfolios->have_posts() ) {
			$portfolios->the_post();			
			$portfolio_img      = get_the_post_thumbnail( get_the_id(), 'halen_order_thumb_360x300', '', array( 'alt' => get_the_title() ) );
			$portfolio_fee      = ! empty( halen_meta( 'portfolio_fee') ) ? halen_meta( 'portfolio_fee') : 'N/A';
			?>
			<div class="col-lg-4 col-sm-6">
				<div class="single_popular_cource">
					<?php 
						if ( $portfolio_img ) {
							echo $portfolio_img;
						}
					?>
					<h3><?php the_title()?> <span><?php echo $portfolio_fee?></span></h3>
					<p><?php echo halen_excerpt_length( 30 )?></p>
					<a href="<?php the_permalink()?>" class="btn_2"><?php echo esc_html( 'Apply Course', 'halen-companion' )?></a>
				</div>
			</div>
			<?php
		}
	}
}

// Recent Course for Single Page
function halen_recent_course(){

	$sec_title    = !empty( halen_opt( 'halen_course_related_projects_sec_title' ) ) ? halen_opt( 'halen_course_related_projects_sec_title' ) : '';
	$pnumber      = !empty( halen_opt( 'halen_course_related_projects_item' ) ) ? halen_opt( 'halen_course_related_projects_item' ) : '';


	$recentCourse = new WP_Query( array(
        'post_type' => 'course',
        'posts_per_page'    => $pnumber,

    ) );

	?>
	<!-- related project part start -->
    <section class="related_project padding_bottom">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="section_tittle">
                        <h2><?php echo esc_html( $sec_title )?></h2>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
				<?php
				if( $recentCourse->have_posts() ){
					while ( $recentCourse->have_posts() ){
						$recentCourse->the_post(); 
						$project_img_id  = halen_meta( 'project_img');
						$project_img_url = wp_get_attachment_image_src( $project_img_id, 'halen_course_img_360x378' );
						?>
						<div class="col-lg-4 col-sm-6 mb-5">
							<div class="single_project_details">
								<a href="<?php echo $project_img_url[0]?>" class="grid-item img_gallery">
									<img src="<?php echo $project_img_url[0]?>" alt="<?php echo the_title()?>">
									<div class="course_hover_text">
										<i class="ti-plus"></i>
									</div>
								</a>
							</div>
						</div>
						<?php
					}
				}?>
			</div>
		</div>
	</section>
<?php
}