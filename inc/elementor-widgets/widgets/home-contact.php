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
 * Halen elementor home contact section widget.
 *
 * @since 1.0
 */
class Halen_Home_Contact extends Widget_Base {

	public function get_name() {
		return 'halen-home-contact';
	}

	public function get_title() {
		return __( 'Home Contact', 'halen-companion' );
	}

	public function get_icon() {
		return 'eicon-column';
	}

	public function get_categories() {
		return [ 'halen-elements' ];
	}

	protected function _register_controls() {

        // ----------------------------------------  Home Contact content ------------------------------
        $this->start_controls_section(
            'home_contact_content',
            [
                'label' => __( 'Home Contact Settings', 'halen-companion' ),
            ]
        );
        $this->add_control(
            'sec_title',
            [
                'label' => esc_html__( 'Section Title', 'halen-companion' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default'   => esc_html__( 'Do you Have any Project?', 'halen-companion' ),
            ]
        );
        $this->add_control(
            'sub_title',
            [
                'label' => esc_html__( 'Sub Title', 'halen-companion' ),
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'default'   => 'Nam libero tempore, cum soluta nobis est eligendi optio <br> cumque nihil impedit quo minus.',
            ]
        );
        $this->add_control(
            'btn_label',
            [
                'label' => esc_html__( 'Button Label', 'halen-companion' ),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'default'   => esc_html__( 'Contact Us', 'halen-companion' ),
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


	protected function render() {
    $settings  = $this->get_settings();      
    $sec_title = !empty( $settings['sec_title'] ) ? $settings['sec_title'] : '';
    $sub_title = !empty( $settings['sub_title'] ) ? $settings['sub_title'] : '';
    $btn_label = !empty( $settings['btn_label'] ) ? $settings['btn_label'] : '';
    $btn_url   = !empty( $settings['btn_url']['url'] ) ? $settings['btn_url']['url'] : '';
    ?>

    <!-- project  -->
    <div class="project_area">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="project_info text-center">                        
                        <?php 
                            if ( $sec_title ) { 
                                echo '<h3>'.esc_html( $sec_title ).'</h3>';
                            }
                            if ( $sub_title ) { 
                                echo '<p>'.wp_kses_post( nl2br( $sub_title ) ).'</p>';
                            }
                            if ( $btn_label ) { 
                                echo '<a href="'.esc_url( $btn_url ).'" class="boxed-btn3-white">'.esc_html( $btn_label ).'</a>';
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/ project  -->
    <?php
    }
}