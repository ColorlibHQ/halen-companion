<?php
namespace Halenelementor\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Utils;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Shadow;



// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


/**
 *
 * Halen elementor about section widget.
 *
 * @since 1.0
 */
class Halen_About_Section extends Widget_Base {

	public function get_name() {
		return 'halen-about-us';
	}

	public function get_title() {
		return __( 'App About', 'halen-companion' );
	}

	public function get_icon() {
		return 'eicon-column';
	}

	public function get_categories() {
		return [ 'halen-elements' ];
	}

	protected function _register_controls() {

        // ----------------------------------------  About Us content ------------------------------
        $this->start_controls_section(
            'about_content',
            [
                'label' => __( 'App About Settings', 'halen-companion' ),
            ]
        );
        $this->add_control(
            'style_type',
            [
                'label' => esc_html__( 'Select Style', 'halen-companion' ),
                'type' => Controls_Manager::SELECT,
                'default'     => 'style_1',
                'options'     => [
                    'style_1' => __( 'Styles 1', 'halen-companion' ),
                    'style_2' => __( 'Styles 2', 'halen-companion' ),
                ]
            ]
        );
        $this->add_control(
            'sec_img',
            [
                'label' => esc_html__( 'Section Image', 'halen-companion' ),
                'description' => esc_html__( 'Best sizes are 588x341 & 336x680', 'halen-companion' ),
                'type' => Controls_Manager::MEDIA,
                'label_block' => true,
                'default'     => [
                    'url'   => Utils::get_placeholder_image_src(),
                ]
            ]
        );
        $this->add_control(
            'image_size',
            [
                'label' => esc_html__( 'Select Image Size', 'halen-companion' ),
                'type' => Controls_Manager::SELECT,
                'default'     => '588x341',
                'options'     => [
                    '588x341' => __( '588x341', 'halen-companion' ),
                    '336x680' => __( '336x680', 'halen-companion' ),
                ]
            ]
        );
        $this->add_control(
            'sec_title',
            [
                'label' => esc_html__( 'Section Title', 'halen-companion' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default'   => 'Features that give <br> you real feel',
            ]
        );
        $this->add_control(
            'sec_text',
            [
                'label' => esc_html__( 'Text', 'halen-companion' ),
                'type' => Controls_Manager::WYSIWYG,
                'label_block' => true,
                'default'   => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida Risus com odo viverra maecenas</p>',
            ]
        );
        $this->add_control(
            'btn_label',
            [
                'label' => esc_html__( 'Button Label', 'halen-companion' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default'   => __( 'Download Now', 'halen-companion' ),
            ]
        );
        $this->add_control(
            'btn_url',
            [
                'label' => esc_html__( 'Button URL', 'halen-companion' ),
                'type' => Controls_Manager::URL,
                'label_block' => true,
                'default'   => [
                    'url' => '#'
                ],
            ]
        );
        
        $this->end_controls_section(); // End left content

        //------------------------------ Style title ------------------------------
        
        // Top Section Styles
        $this->start_controls_section(
            'about_sec_style', [
                'label' => __( 'About Section Styles', 'halen-companion' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'sub_title_col', [
                'label' => __( 'Sub Title Color', 'halen-companion' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .welcome_halen_area .welcome_halen_info h2' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'sec_title_col', [
                'label' => __( 'Sec Title Color', 'halen-companion' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .welcome_halen_area .welcome_halen_info h3' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'sec_text_col', [
                'label' => __( 'Sec Text Color', 'halen-companion' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .welcome_halen_area .welcome_halen_info p' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .welcome_halen_area .welcome_halen_info ul li' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'list_circle_col', [
                'label' => __( 'List Item Icon Color', 'halen-companion' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .welcome_halen_area .welcome_halen_info ul li::before' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'btn_styles_seperator',
            [
                'label' => esc_html__( 'Button Styles', 'halen-companion' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'after'
            ]
        );
        $this->add_control(
            'btn_txt_col', [
                'label' => __( 'Button Text & Border Color', 'halen-companion' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .welcome_halen_area .welcome_halen_info .boxed-btn3-white-2' => 'color: {{VALUE}} !important; border-color: {{VALUE}}',
                    '{{WRAPPER}} .welcome_halen_area .welcome_halen_info .boxed-btn3-white-2:hover' => 'background: {{VALUE}} !important; border-color: transparent',
                ],
            ]
        );
        $this->add_control(
            'btn_hvr_col', [
                'label' => __( 'Button Hover Color', 'halen-companion' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .welcome_halen_area .welcome_halen_info .boxed-btn3-white-2:hover' => 'color: {{VALUE}} !important',
                ],
            ]
        );

        $this->end_controls_section();

    }

    public function halen_left_contents( $sec_title, $sec_text, $btn_label, $btn_url, $style_type ) {
        $dynamic_class = ( $style_type == 'style_1' ) ? 'features_info2' : 'features_info';
        $col_class = ( $style_type == 'style_1' ) ? 'col-xl-5 col-lg-5 col-md-6' : 'col-xl-6 col-lg-6 col-md-6';
        ?>
        <div class="<?=esc_attr($col_class)?>">
            <div class="<?=esc_attr($dynamic_class)?>">
                <?php 
                    if ( $sec_title ) { 
                        echo '<h3>'.wp_kses_post( nl2br($sec_title) ).'</h3>';
                    }
                    if ( $sec_text ) { 
                        echo wpautop( $sec_text );
                    }
                    if ( $btn_label ) { 
                        echo '<div class="about_btn">';
                            echo '<a class="boxed-btn4" href="'.esc_url( $btn_url ).'">'.esc_html( $btn_label ).'</a>';
                        echo '</div>';
                    }
                ?>
            </div>
        </div>
        <?php
    }


    public function halen_right_contents( $sec_img, $style_type ) {
        $dynamic_class = ( $style_type == 'style_1' ) ? 'about_draw fadeInUp' : 'about_image fadeInLeft';
        ?>
        <div class="col-xl-5 col-lg-5 offset-xl-1 offset-lg-1 col-md-6 ">
            <div class="<?=esc_attr($dynamic_class)?> wow" data-wow-duration=".7s" data-wow-delay=".5s">
                <?php 
                    if ( $sec_img ) { 
                        echo $sec_img;
                    }
                ?>
            </div>
        </div>
        <?php
    }


	protected function render() {
    $settings   = $this->get_settings();  
    $style_type = !empty( $settings['style_type'] ) ? $settings['style_type'] : '';
    $image_size = ($settings['image_size'] == '588x341') ? 'halen_feature_right_illustration_thumb_588x341' : 'halen_feature_left_phone_thumb_336x680';
    $sec_img    = !empty( $settings['sec_img']['id'] ) ? wp_get_attachment_image( $settings['sec_img']['id'], $image_size, '', array( 'alt' => 'feature image' ) ) : '';
    $sec_title  = !empty( $settings['sec_title'] ) ? $settings['sec_title'] : '';
    $sec_text   = !empty( $settings['sec_text'] ) ? $settings['sec_text'] : '';
    $btn_label  = !empty( $settings['btn_label'] ) ? $settings['btn_label'] : '';
    $btn_url    = !empty( $settings['btn_url']['url'] ) ? $settings['btn_url']['url'] : '';
    ?>
    
    <!-- about  -->
    <div class="features_area">
        <div class="container">
            <div class="features_main_wrap">
                <div class="row align-items-center">

                    <?php
                        if ( $style_type == 'style_1' ) {
                            $this->halen_left_contents( $sec_title, $sec_text, $btn_label, $btn_url, $style_type );
                            $this->halen_right_contents( $sec_img, $style_type );
                        } else {
                            $this->halen_right_contents( $sec_img, $style_type );
                            $this->halen_left_contents( $sec_title, $sec_text, $btn_label, $btn_url, $style_type );
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <?php
    }
}