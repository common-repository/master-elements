<?phpnamespace Elementor;use \Elementor\Controls_Manager;if (!defined('ABSPATH')) exit;class Master_Site_Title extends Widget_Base{    public $base;    public function __construct($data = [], $args = null)    {        parent::__construct($data, $args);    }    public function get_name()    {        /////////////////////////////////////        //get name of file        /////////////////////////////////////        return 'site-title';    }    public function get_title()    {        /////////////////////////////////////        //get title from file        /////////////////////////////////////        return esc_html__('Master Site Title', 'masterelements');    }    public function get_icon()    {        /////////////////////////////////////        //get icon        /////////////////////////////////////        return 'eicon-site-title';    }    public function get_categories()    {        //////////////////////////////////////////////////////////////////////////        //get category where widget will be added in elementor front end        //////////////////////////////////////////////////////////////////////////        return ['master-addons'];    }//////////////////////////////////////////////////////////////////////////// elementor default function to register your controls//////////////////////////////////////////////////////////////////////////    protected function _register_controls()    {        ///////////////////////////////////////  Content Section Start/////////////////////////////////////        $this->start_controls_section(        ////////////////////////////////////////////////////////////////////////////////////////////        //section which is shown after you drage your widget in the fornt-end area        ////////////////////////////////////////////////////////////////////////////////////////////            'section_content',            [                'label' => __('Master Site Title', 'additional-addons'),//......            ]        );//////////////////////////////////////////////// Adding Heading Controls.//////////////////////////////////////////////        $this->add_control(            'site_title_display',            [                'label' => __('Custom Title', 'masterelements'),                'type' => \Elementor\Controls_Manager::SWITCHER,                'label_on' => __('Show', 'masterelements'),                'label_off' => __('Hide', 'masterelements'),                'return_value' => 'yes',                'default' => 'empty',            ]        );        $this->add_control(            'site_title_content',            [                'label' => __('Enter Title Here', 'masterelements'),                'type' => \Elementor\Controls_Manager::TEXTAREA,                'rows' => 3,                'default' => __('Master Title', 'masterelements'),                'placeholder' => __('Type your Title here', 'masterelements'),                'condition' => [                    'site_title_display' => 'yes'                ],            ]        );        $this->add_control(            'site_title_display_link',            [                'label' => __('Custom Link', 'masterelements'),                'type' => \Elementor\Controls_Manager::SWITCHER,                'label_on' => __('Show', 'masterelements'),                'label_off' => __('Hide', 'masterelements'),                'return_value' => 'yes',                'default' => 'empty',            ]        );        $this->add_control(            'site_title_link',            [                'label' => __('Link', 'masterelements'),                'type' => \Elementor\Controls_Manager::URL,                'placeholder' => __('https://your-link.com', 'masterelements'),                'show_external' => true,                'default' => [                    'url' => '',                    'is_external' => true,                    'nofollow' => true,                ],                'condition' => [                    'site_title_display_link' => 'yes'                ],            ]        );        $this->add_control(            'site_title_heading',            [                'label' => __('Html Tag', 'masterelements'),                'type' => Controls_Manager::SELECT,                'default' => 'h1',                'options' => [                    'h1' => __('H1', 'masterelements'),                    'h2' => __('H2', 'masterelements'),                    'h3' => __('H3', 'masterelements'),                    'h4' => __('H4', 'masterelements'),                    'h5' => __('H5', 'masterelements'),                    'h6' => __('H6', 'masterelements'),                ],            ]        );        $this->add_responsive_control(            'site_title_text_align',            [                'label' => __('Title Alignment', 'masterelements'),                'type' => Controls_Manager::CHOOSE,                'devices' => ['desktop', 'tablet', 'mobile'],                'options' => [                    'left' => [                        'title' => __('Left', 'masterelements'),                        'icon' => 'fa fa-align-left',                    ],                    'center' => [                        'title' => __('Center', 'masterelements'),                        'icon' => 'fa fa-align-center',                    ],                    'right' => [                        'title' => __('Right', 'masterelements'),                        'icon' => 'fa fa-align-right',                    ],                    'justified' => [                        'title' => __('Justified', 'masterelements'),                        'icon' => 'fa fa-align-justify',                    ],                ],                'default' => 'center',                'toggle' => true,                'selector' => '.master-title',            ]        );        $this->end_controls_section();        $this->start_controls_section(            'section_style',            [                'label' => __('Style', 'additional-addons'),                'tab' => Controls_Manager::TAB_STYLE,            ]        );        $this->add_control(            'site_title_color',            [                'label' => __('Title Color', 'masterelements'),                'type' => \Elementor\Controls_Manager::COLOR,                'scheme' => [                    'type' => \Elementor\Scheme_Color::get_type(),                    'value' => \Elementor\Scheme_Color::COLOR_1,                ],                'selectors' => [                    '{{WRAPPER}} .master-title .master-link' => 'color: {{VALUE}}!important',                ],            ]        );        $this->add_group_control(            Group_Control_Typography::get_type(),            [                'name' => 'site_title_heading_content_typography',                'label' => __('Title Typography', 'masterelements'),                'scheme' => Scheme_Typography::TYPOGRAPHY_1,                'selector' => '{{WRAPPER}} .master-title',            ]        );        $this->add_group_control(            Group_Control_Text_Shadow::get_type(),            [                'name' => 'site_title_text_shadow',                'label' => __('Text Shadow', 'masterelements'),                'selector' => '{{WRAPPER}} .master-title',            ]        );        $this->end_controls_section();    }//function to show how front end will look like after you change settings in title widget//front end live preview.    protected function render()    {        $settings = $this->get_settings_for_display();        ?>        <?php $target = $settings['site_title_link']['is_external'] ? ' target="_blank"' : ''; ?>        <?php $nofollow = $settings['site_title_link']['nofollow'] ? ' rel="nofollow"' : ''; ?>        <?php        if ($settings['site_title_display_link'] == 'yes') {            $url = $settings['site_title_link']['url'];        } else {            $url = home_url('/');        }        ?>        <<?php echo $settings['site_title_heading'] ?> class="master-title" style="text-align:<?= $settings['site_title_text_align'] ?>" >        <a class="master-link" href="<?= $url ?>" <?= $target . ' ' . $nofollow; ?>           style="color:<?= $settings['site_title_color'] ?>"> <?php if ($settings['site_title_display'] == 'yes') {                echo $settings['site_title_content'];            } else {                echo get_bloginfo();            } ?> </a> </<?php echo $settings['heading'] ?>>        <?php    }}