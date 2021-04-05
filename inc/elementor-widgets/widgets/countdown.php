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
 * Halen elementor Countdown section widget.
 *
 * @since 1.0
 */
class Halen_Countdown extends Widget_Base {

	public function get_name() {
		return 'halen-countdown';
	}

	public function get_title() {
		return __( 'Countdown', 'halen-companion' );
	}

	public function get_icon() {
		return 'eicon-column';
	}

	public function get_categories() {
		return [ 'halen-elements' ];
	}

	protected function _register_controls() {

        // ----------------------------------------  Countdown content ------------------------------
        $this->start_controls_section(
            'countdown_content',
            [
                'label' => __( 'Countdown Settings', 'halen-companion' ),
            ]
        );
		$this->add_control(
            'counters', [
                'label' => __( 'Create New', 'halen-companion' ),
                'type' => Controls_Manager::REPEATER,
                'title_field' => '{{{ counter_label }}}',
                'fields' => [
                    [
                        'name' => 'counter_val',
                        'label' => __( 'Counter Value', 'halen-companion' ),
                        'label_block' => true,
                        'type' => Controls_Manager::TEXT,
                        'default' => __( '520', 'halen-companion' ),
                    ],
                    [
                        'name' => 'counter_suffix',
                        'label' => __( 'Counter Suffix', 'halen-companion' ),
                        'label_block' => true,
                        'type' => Controls_Manager::TEXT,
                        'default' => __( '+', 'halen-companion' ),
                    ],
                    [
                        'name' => 'counter_label',
                        'label' => __( 'Counter Label', 'halen-companion' ),
                        'label_block' => true,
                        'type' => Controls_Manager::TEXT,
                        'default' => __( 'Total Projects', 'halen-companion' ),
                    ],
                ],
                'default'   => [
                    [      
                        'counter_val'    => __( '520', 'halen-companion' ),
                        'counter_suffix' => __( '+', 'halen-companion' ),
                        'counter_label'  => __( 'Total Projects', 'halen-companion' ),
                    ],
                    [      
                        'counter_val'    => __( '244', 'halen-companion' ),
                        'counter_suffix' => __( '', 'halen-companion' ),
                        'counter_label'  => __( 'On Going Projects', 'halen-companion' ),
                    ],
                    [      
                        'counter_val'    => __( '95', 'halen-companion' ),
                        'counter_suffix' => __( '%', 'halen-companion' ),
                        'counter_label'  => __( 'Job Success', 'halen-companion' ),
                    ],
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

    // call load widget script
    $this->load_widget_script(); 

    $settings = $this->get_settings();      
    $counters = !empty( $settings['counters'] ) ? $settings['counters'] : '';
    ?>
    
    <!-- counter  -->
    <div class="counter_area">
        <div class="container">
            <div class="row">
                <?php 
                if( is_array( $counters ) && count( $counters ) > 0 ) {
                    foreach( $counters as $item ) {
                        $counter_val = ( !empty( $item['counter_val'] ) ) ? $item['counter_val'] : '';
                        $counter_suffix = ( !empty( $item['counter_suffix'] ) ) ? '<span>'.$item['counter_suffix'].'</span>' : '';
                        $counter_label = ( !empty( $item['counter_label'] ) ) ? $item['counter_label'] : '';
                        ?>
                        <div class="col-xl-4 col-md-4">
                            <div class="single_counter text-center">
                                <!-- <h3> <span class="counter">520</span> <span>+</span> </h3>
                                <span>Total Projects</span> -->

                                <?php 
                                    if ( $counter_val ) { 
                                        echo '<h3> <span class="counter">'.esc_html( $counter_val ).'</span> '.wp_kses_post( $counter_suffix ).' </h3>';
                                    }
                                    if ( $counter_label ) { 
                                        echo '<span>'.esc_html( $counter_label ).'</span> ';
                                    }
                                ?>
                            </div>
                        </div>
                        <?php
                    }
                }
                ?>
            </div>
        </div>
    </div>
    <!-- counter end -->
    <?php
    }
    
    public function load_widget_script(){
        if( \Elementor\Plugin::$instance->editor->is_edit_mode() === true  ) {
        ?>
        <script>
        ( function( $ ){
            // counter 
            $('.counter').counterUp({
              delay: 10,
              time: 10000
            });
        })(jQuery);
        </script>
        <?php 
        }
    }	
}