<?php
namespace Halenelementor\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Background;
use Elementor\Utils;



// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


/**
 *
 * Halen elementor hero section widget.
 *
 * @since 1.0
 */
class Halen_Hero extends Widget_Base {

	public function get_name() {
		return 'halen-hero';
	}

	public function get_title() {
		return __( 'Hero Section', 'halen-companion' );
	}

	public function get_icon() {
		return 'eicon-slider-full-screen';
	}

	public function get_categories() {
		return [ 'halen-elements' ];
	}

	protected function _register_controls() {

		// ----------------------------------------  Hero content ------------------------------
		$this->start_controls_section(
			'hero_content',
			[
				'label' => __( 'Hero section content', 'halen-companion' ),
			]
        );
        $this->add_control(
            'sliders_settings_seperator',
            [
                'label' => esc_html__( 'Sliders', 'halen-companion' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'after'
            ]
        );

		$this->add_control(
            'sliders', [
                'label' => __( 'Create New', 'halen-companion' ),
                'type' => Controls_Manager::REPEATER,
                'title_field' => '{{{ big_text }}}',
                'fields' => [
                    [
                        'name' => 'bg_img',
                        'label' => __( 'Slider Image', 'halen-companion' ),
                        'label_block' => true,
                        'type' => Controls_Manager::MEDIA,
                        'default'     => [
                            'url'   => Utils::get_placeholder_image_src(),
                        ]
                    ],
                    [
                        'name' => 'big_text',
                        'label' => __( 'Big Text', 'halen-companion' ),
                        'label_block' => true,
                        'type' => Controls_Manager::TEXTAREA,
                        'default'     => 'Hi, This is Halen, a professional Photographer <br> I Captured Moments'
                    ],
                    [
                        'name' => 'btn_label',
                        'label' => __( 'Button Text', 'halen-companion' ),
                        'label_block' => true,
                        'type' => Controls_Manager::TEXT,
                        'default'     => __( 'Explore Work', 'halen-companion' ),
                    ],
                    [
                        'name' => 'btn_url',
                        'label' => __( 'Button URL', 'halen-companion' ),
                        'label_block' => true,
                        'type' => Controls_Manager::URL,
                        'default'     => [
                            'url' => '#'
                        ]
                    ],
                ],
                'default'   => [
                    [      
                        'bg_img'    => [
                            'url'        => Utils::get_placeholder_image_src(),
                        ],
                        'big_text'    => 'Hi, This is Halen, a professional Photographer <br> I Captured Moments',
                        'btn_label'    => __( 'Explore Work', 'halen-companion' ),
                        'btn_url'    => [
                            'url' => '#'
                        ],
                    ],
                    [      
                        'bg_img'    => [
                            'url'        => Utils::get_placeholder_image_src(),
                        ],
                        'big_text'    => 'Hi, This is Halen, a professional Photographer <br> I Captured Moments',
                        'btn_label'    => __( 'Explore Work', 'halen-companion' ),
                        'btn_url'    => [
                            'url' => '#'
                        ],
                    ],
                    [      
                        'bg_img'    => [
                            'url'        => Utils::get_placeholder_image_src(),
                        ],
                        'big_text'    => 'Hi, This is Halen, a professional Photographer <br> I Captured Moments',
                        'btn_label'    => __( 'Explore Work', 'halen-companion' ),
                        'btn_url'    => [
                            'url' => '#'
                        ],
                    ],
                ]
            ]
		);
        $this->end_controls_section(); // End Hero content


    /**
     * Style Tab
     * ------------------------------ Style Title ------------------------------
     *
     */
        $this->start_controls_section(
			'style_title', [
				'label' => __( 'Style Hero Section', 'halen-companion' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'big_title_col', [
				'label' => __( 'Title Color', 'halen-companion' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .slider_area .single_slider .slider_text h3' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'text_col', [
				'label' => __( 'Text Color', 'halen-companion' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .slider_area .single_slider .slider_text p' => 'color: {{VALUE}};',
				],
			]
        );

        $this->add_control(
            'button_section_separator',
            [
                'label'     => __( 'Button Styles', 'halen-companion' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'after',
            ]
        ); 
        $this->add_control(
			'button_col', [
				'label' => __( 'Button Color', 'halen-companion' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .slider_area .single_slider .slider_text .boxed-btn3' => 'color: {{VALUE}} !important',
				],
			]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'btn_bg_color',
                'label' => __( 'Button BG Color', 'halen-companion' ),
                'types' => [ 'gradient' ],
                'selector' => '{{WRAPPER}} .slider_area .single_slider .slider_text .boxed-btn3',
            ]
        );

        $this->add_control(
            'button_hover_section_separator',
            [
                'label'     => __( 'Button Hover Styles', 'halen-companion' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'after',
            ]
        ); 
        $this->add_control(
			'button_hover_col', [
				'label' => __( 'Button Hover Color', 'halen-companion' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .slider_area .single_slider .slider_text .boxed-btn3:hover' => 'color: {{VALUE}} !important; border-color: {{VALUE}};',
				],
			]
        );
        $this->add_control(
			'button_hover_bg_col', [
				'label' => __( 'Button Hover Bg Color', 'halen-companion' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .slider_area .single_slider .slider_text .boxed-btn3:hover' => 'background: {{VALUE}};',
				],
			]
        );

		$this->end_controls_section();
	}
    
	protected function render() {
    // call load widget script
    $this->load_widget_script(); 

    $settings   = $this->get_settings();
    $sliders    = !empty( $settings['sliders'] ) ? $settings['sliders'] : '';
    ?>
    
    <!-- slider_area_start -->
    <div class="slider_area">
        <div class="slider_active owl-carousel">
            <?php 
            if( is_array( $sliders ) && count( $sliders ) > 0 ) {
                foreach( $sliders as $item ) {
                    $bg_img = !empty( $item['bg_img']['url'] ) ? $item['bg_img']['url'] : '';
                    $big_text = ( !empty( $item['big_text'] ) ) ? $item['big_text'] : '';
                    $btn_label = ( !empty( $item['btn_label'] ) ) ? $item['btn_label'] : '';
                    $btn_url = ( !empty( $item['btn_url']['url'] ) ) ? $item['btn_url']['url'] : '';
                    ?>
                    <div class="single_slider  d-flex align-items-center slider_bg_1 black_overlay" <?php echo halen_inline_bg_img( esc_url( $bg_img ) ); ?>>
                        <div class="container">
                            <div class="row align-items-center">
                                <div class="col-xl-12 col-md-12">
                                    <div class="slider_text text-center ">
                                        <?php 
                                            if ( $big_text ) { 
                                                echo '<h3 class="wow fadeInDown" data-wow-duration="1s" data-wow-delay=".1s">'.wp_kses_post( nl2br( $big_text ) ).'</h3>';
                                            }
                                            if ( $btn_label ) { 
                                                echo '<div class="video_service_btn wow fadeInDown" data-wow-duration="1s" data-wow-delay=".1s"><a href="'.esc_url( $btn_url ).'" class="boxed-btn3">'.esc_html( $btn_label ).'</a></div>';
                                            }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            }
            ?>
        </div>
    </div>
    <!-- slider_area_end -->
    <?php

    } 
    
    public function load_widget_script(){
        if( \Elementor\Plugin::$instance->editor->is_edit_mode() === true  ) {
        ?>
        <script>
        ( function( $ ){
            // slider_active
            $('.slider_active').owlCarousel({
                loop:true,
                margin:0,
            items:1,
            autoplay:true,
            navText:['<i class="ti-angle-left"></i>','<i class="ti-angle-right"></i>'],
                nav:true,
            dots:false,
            autoplayHoverPause: true,
            autoplaySpeed: 800,
                responsive:{
                    0:{
                        items:1,
                        nav:false,
                    },
                    767:{
                        items:1,
                        nav:false,
                    },
                    992:{
                        items:1,
                        nav:false
                    },
                    1200:{
                        items:1,
                        nav:false
                    },
                    1600:{
                        items:1,
                        nav:true
                    }
                }
            });
        })(jQuery);
        </script>
        <?php 
        }
    }	
}