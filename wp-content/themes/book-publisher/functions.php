<?php
/**
 * Book Publisher functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Book Publisher
 */

if ( ! defined( 'DIGITAL_BOOKS_URL' ) ) {
    define( 'DIGITAL_BOOKS_URL', esc_url( 'https://www.themagnifico.net/themes/book-publisher-wordpress-theme/', 'book-publisher') );
}
if ( ! defined( 'DIGITAL_BOOKS_TEXT' ) ) {
    define( 'DIGITAL_BOOKS_TEXT', __( 'Book Publisher Pro','book-publisher' ));
}
if ( ! defined( 'DIGITAL_BOOKS_BUY_TEXT' ) ) {
    define( 'DIGITAL_BOOKS_BUY_TEXT', __( 'Buy Book Publisher Pro','book-publisher' ));
}

function book_publisher_enqueue_styles() {
    wp_enqueue_style( 'bootstrap-css', get_template_directory_uri() . '/assets/css/bootstrap.css');
    $book_publisher_parentcss = 'digital-books-style';
    $book_publisher_theme = wp_get_theme(); wp_enqueue_style( $book_publisher_parentcss, get_template_directory_uri() . '/style.css', array(), $book_publisher_theme->parent()->get('Version'));
    wp_enqueue_style( 'book-publisher-style', get_stylesheet_uri(), array( $book_publisher_parentcss ), $book_publisher_theme->get('Version'));

    wp_enqueue_script( 'comment-reply', '/wp-includes/js/comment-reply.min.js', array(), false, true );
}

add_action( 'wp_enqueue_scripts', 'book_publisher_enqueue_styles' );

function book_publisher_admin_scripts() {
    // demo CSS
    wp_enqueue_style( 'book-publisher-demo-css', get_theme_file_uri( 'assets/css/demo.css' ) );
}
add_action( 'admin_enqueue_scripts', 'book_publisher_admin_scripts' );

function book_publisher_customize_register($wp_customize){

    // Pro Version
    class Book_Publisher_Customize_Pro_Version extends WP_Customize_Control {
        public $type = 'pro_options';

        public function render_content() {
            echo '<span>For More <strong>'. esc_html( $this->label ) .'</strong>?</span>';
            echo '<a href="'. esc_url($this->description) .'" target="_blank">';
                echo '<span class="dashicons dashicons-info"></span>';
                echo '<strong> '. esc_html( DIGITAL_BOOKS_BUY_TEXT,'book-publisher' ) .'<strong></a>';
            echo '</a>';
        }
    }

    $wp_customize->add_setting('book_publisher_topbar_text', array(
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('book_publisher_topbar_text', array(
        'label' => __('Topbar Text', 'book-publisher'),
        'section' => 'digital_books_social_link',
        'priority' => 1,
        'type' => 'text',
    ));

    //Latest Product
    $wp_customize->add_section('book_publisher_latest_product',array(
        'title' => esc_html__('Latest Product','book-publisher'),
        'description' => esc_html__('Here you have to select product category which will display perticular latest product in the home page.','book-publisher'),
    ));

    $wp_customize->add_setting('book_publisher_latest_product_section_setting', array(
        'default' => 1,
        'sanitize_callback' => 'digital_books_sanitize_checkbox'
    ));
    $wp_customize->add_control( new WP_Customize_Control($wp_customize,'book_publisher_latest_product_section_setting',array(
        'label'          => __( 'Enable Disable Latest Product', 'book-publisher' ),
        'section'        => 'book_publisher_latest_product',
        'settings'       => 'book_publisher_latest_product_section_setting',
        'type'           => 'checkbox',
    )));


    $wp_customize->add_setting('book_publisher_latest_product_title', array(
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('book_publisher_latest_product_title', array(
        'label' => __('Section Title', 'book-publisher'),
        'section' => 'book_publisher_latest_product',
        'type' => 'text',
    ));

    $book_publisher_args = array(
       'type'                     => 'product',
        'child_of'                 => 0,
        'parent'                   => '',
        'orderby'                  => 'term_group',
        'order'                    => 'ASC',
        'hide_empty'               => false,
        'hierarchical'             => 1,
        'number'                   => '',
        'taxonomy'                 => 'product_cat',
        'pad_counts'               => false
    );
    $book_publisher_categories = get_categories( $book_publisher_args );
    $book_publisher_cats = array();
    $i = 0;
    foreach($book_publisher_categories as $category){
        if($i==0){
            $default = $category->slug;
            $i++;
        }
        $book_publisher_cats[$category->slug] = $category->name;
    }
    $wp_customize->add_setting('book_publisher_latest_product',array(
        'sanitize_callback' => 'digital_books_sanitize_select',
    ));
    $wp_customize->add_control('book_publisher_latest_product',array(
        'type'    => 'select',
        'choices' => $book_publisher_cats,
        'label' => __('Select Product Category','book-publisher'),
        'section' => 'book_publisher_latest_product',
    ));

     // Pro Version
    $wp_customize->add_setting( 'pro_version_latest_product_setting', array(
        'sanitize_callback' => 'Digital_Books_sanitize_custom_control'
    ));
    $wp_customize->add_control( new Book_Publisher_Customize_Pro_Version ( $wp_customize,'pro_version_latest_product_setting', array(
        'section'     => 'book_publisher_latest_product',
        'type'        => 'pro_options',
        'label'       => esc_html__( 'Customizer Options', 'book-publisher' ),
        'description' => esc_url( DIGITAL_BOOKS_URL ),
        'priority'    => 100
    )));

}
add_action('customize_register', 'book_publisher_customize_register');

if ( ! function_exists( 'book_publisher_setup' ) ) :
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function book_publisher_setup() {

        add_theme_support( 'responsive-embeds' );

        // Add default posts and comments RSS feed links to head.
        add_theme_support( 'automatic-feed-links' );

        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support( 'title-tag' );

        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
         */
        add_theme_support( 'post-thumbnails' );

        add_image_size('book-publisher-featured-header-image', 2000, 660, true);

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         * to output valid HTML5.
         */
        add_theme_support( 'html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        ) );

        // Set up the WordPress core custom background feature.
        add_theme_support( 'custom-background', apply_filters( 'digital_books_custom_background_args', array(
            'default-color' => '',
            'default-image' => '',
        ) ) );

        /**
         * Add support for core custom logo.
         *
         * @link https://codex.wordpress.org/Theme_Logo
         */
        add_theme_support( 'custom-logo', array(
            'height'      => 50,
            'width'       => 50,
            'flex-width'  => true,
        ) );

        add_editor_style( array( '/editor-style.css' ) );

        add_theme_support( 'align-wide' );

        add_theme_support( 'wp-block-styles' );
    }
endif;
add_action( 'after_setup_theme', 'book_publisher_setup' );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function book_publisher_widgets_init() {
        register_sidebar( array(
        'name'          => esc_html__( 'Sidebar', 'book-publisher' ),
        'id'            => 'sidebar',
        'description'   => esc_html__( 'Add widgets here.', 'book-publisher' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h5 class="widget-title">',
        'after_title'   => '</h5>',
    ) );
}
add_action( 'widgets_init', 'book_publisher_widgets_init' );

if ( ! defined( 'DIGITAL_BOOKS_CONTACT_SUPPORT' ) ) {
define('DIGITAL_BOOKS_CONTACT_SUPPORT',__('https://wordpress.org/support/theme/book-publisher','book-publisher'));
}
if ( ! defined( 'DIGITAL_BOOKS_REVIEW' ) ) {
define('DIGITAL_BOOKS_REVIEW',__('https://wordpress.org/support/theme/book-publisher/reviews/#new-post','book-publisher'));
}
if ( ! defined( 'DIGITAL_BOOKS_LIVE_DEMO' ) ) {
define('DIGITAL_BOOKS_LIVE_DEMO',__('https://www.themagnifico.net/demo/book-publisher/','book-publisher'));
}
if ( ! defined( 'DIGITAL_BOOKS_GET_PREMIUM_PRO' ) ) {
define('DIGITAL_BOOKS_GET_PREMIUM_PRO',__('https://www.themagnifico.net/themes/book-publisher-wordpress-theme/','book-publisher'));
}
if ( ! defined( 'DIGITAL_BOOKS_PRO_DOC' ) ) {
define('DIGITAL_BOOKS_PRO_DOC',__('https://www.themagnifico.net/eard/wathiqa/book-publisher-pro-doc/','book-publisher'));
}

/**
 * Enqueue theme color style.
 */
function book_publisher_theme_color() {

    $book_publisher_theme_color_css = '';
    $digital_books_theme_color = get_theme_mod('digital_books_theme_color');
    $digital_books_theme_color_2 = get_theme_mod('digital_books_theme_color_2');
    $digital_books_preloader_bg_color = get_theme_mod('digital_books_preloader_bg_color');
    $digital_books_preloader_dot_1_color = get_theme_mod('digital_books_preloader_dot_1_color');
    $digital_books_preloader_dot_2_color = get_theme_mod('digital_books_preloader_dot_2_color');

    if(get_theme_mod('digital_books_preloader_bg_color') == '') {
            $digital_books_preloader_bg_color = '#000';
    }
    if(get_theme_mod('digital_books_preloader_dot_1_color') == '') {
        $digital_books_preloader_dot_1_color = '#fff';
    }
    if(get_theme_mod('digital_books_preloader_dot_2_color') == '') {
        $digital_books_preloader_dot_2_color = '#fc3656';
    }
    $book_publisher_theme_color_css = '

        .sticky .entry-title::before, .main-navigation .sub-menu, #button, .sidebar input[type="submit"], .comment-respond input#submit, .post-navigation .nav-previous a:hover, .post-navigation .nav-next a:hover, .posts-navigation .nav-previous a:hover, .posts-navigation .nav-next a:hover, .woocommerce .woocommerce-ordering select, .woocommerce ul.products li.product .onsale, .woocommerce span.onsale, .pro-button a, .woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button, .woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt, .wp-block-button__link, .serv-box:hover, .woocommerce-account .woocommerce-MyAccount-navigation ul li, .btn-primary, .sidebar h5, .toggle-nav i, span.onsale, .slide-btn a, .serach_inner [type="submit"],span.cart-value,.slide-btn a:hover,.woocommerce a.added_to_cart,a.account-btn:hover,.main-navigation .menu > li > a:hover {
            background: '.esc_attr($digital_books_theme_color).';
        }
        a, .sidebar ul li a:hover, #colophon a:hover, #colophon a:focus, p.price, .woocommerce ul.products li.product .price, .woocommerce div.product p.price, .woocommerce div.product span.price, .woocommerce-message::before, .woocommerce-info::before, .slider-inner-box a h2,.slider-inner-box h2,.main-navigation .menu > li > a:hover,.woocommerce .star-rating span::before,.pro-button a:hover,.woocommerce #respond input#submit:hover,.woocommerce a.button:hover,.woocommerce button.button:hover,.woocommerce input.button:hover,.woocommerce #respond input#submit.alt:hover, .woocommerce a.button.alt:hover, .woocommerce button.button.alt:hover, .woocommerce input.button.alt:hover,.woocommerce a.added_to_cart:hover,.product-box h5.price {
            color: '.esc_attr($digital_books_theme_color).';
        }
        .pro-button a:hover,.woocommerce #respond input#submit:hover,.woocommerce a.button:hover,.woocommerce button.button:hover,.woocommerce input.button:hover,.woocommerce #respond input#submit.alt:hover, .woocommerce a.button.alt:hover, .woocommerce button.button.alt:hover, .woocommerce input.button.alt:hover,.woocommerce a.added_to_cart:hover {
            border-color: '.esc_attr($digital_books_theme_color).';
        }
        .wp-block-quote, .wp-block-quote:not(.is-large):not(.is-style-large), .wp-block-pullquote {
            border-color: '.esc_attr($digital_books_theme_color).'!important;
        }

        #colophon,.top-info,.serach_inner,#top-slider {
            background: '.esc_attr($digital_books_theme_color_2).';
        }
        .loading{
            background-color: '.esc_attr($digital_books_preloader_bg_color).';
         }
         @keyframes loading {
          0%,
          100% {
            transform: translatey(-2.5rem);
            background-color: '.esc_attr($digital_books_preloader_dot_1_color).';
          }
          50% {
            transform: translatey(2.5rem);
            background-color: '.esc_attr($digital_books_preloader_dot_2_color).';
          }
        }
    ';
    wp_add_inline_style( 'book-publisher-style',$book_publisher_theme_color_css );

}
add_action( 'wp_enqueue_scripts', 'book_publisher_theme_color' );
