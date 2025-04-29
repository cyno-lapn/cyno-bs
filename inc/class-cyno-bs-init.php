<?php
/**
 * Theme initialization class
 *
 * @package Cyno_BS
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

class Cyno_BS_Init {
    /**
     * Instance
     *
     * @var Cyno_BS_Init
     */
    private static $instance = null;

    /**
     * Constructor
     */
    public function __construct() {
        $this->init_hooks();
    }

    /**
     * Get instance
     *
     * @return Cyno_BS_Init
     */
    public static function instance() {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Initialize hooks
     */
    private function init_hooks() {
        // Theme setup
        add_action('after_setup_theme', array($this, 'setup'));

        // Scripts and styles
        add_action('wp_enqueue_scripts', array($this, 'register_scripts'));
        add_action('wp_enqueue_scripts', array($this, 'register_styles'));
        add_action('wp_enqueue_scripts', array($this, 'enqueue_scripts'));
        add_action('wp_enqueue_scripts', array($this, 'enqueue_styles'));

        // Navigation
        add_filter('nav_menu_css_class', array($this, 'nav_menu_css_class'), 10, 2);
        add_filter('nav_menu_link_attributes', array($this, 'nav_menu_link_attributes'), 10, 3);
    }

    /**
     * Theme setup
     */
    public function setup() {
        // Add default posts and comments RSS feed links to head
        add_theme_support('automatic-feed-links');

        // Enable support for Post Thumbnails on posts and pages
        add_theme_support('post-thumbnails');

        // Add support for responsive embedded content
        add_theme_support('responsive-embeds');

        // Add support for custom navigation menus
        register_nav_menus(array(
            'primary' => esc_html__('Primary Menu', 'cyno-bs'),
            'footer' => esc_html__('Footer Menu', 'cyno-bs'),
        ));

        // Add support for core custom logo
        add_theme_support('custom-logo', array(
            'height'      => 250,
            'width'       => 250,
            'flex-width'  => true,
            'flex-height' => true,
        ));
    }

    /**
     * Register scripts
     */
    public function register_scripts() {
        $scripts = apply_filters('cyno_bs_register_scripts', array(
            'bootstrap-bundle' => array(
                'src'     => CYNO_BS_VENDOR_URL . '/bootstrap/js/bootstrap.bundle.min.js',
                'deps'    => array('jquery'),
                'version' => '5.3.0',
                'in_footer' => true,
            ),
            'cyno-bs-script' => array(
                'src'     => CYNO_BS_ASSETS_URL . '/js/frontend.js',
                'deps'    => array('jquery', 'bootstrap-bundle'),
                'version' => CYNO_BS_VERSION,
                'in_footer' => true,
            ),
        ));

        foreach ($scripts as $handle => $script) {
            wp_register_script(
                $handle,
                $script['src'],
                $script['deps'],
                $script['version'],
                $script['in_footer']
            );
        }
    }

    /**
     * Register styles
     */
    public function register_styles() {
        $styles = apply_filters('cyno_bs_register_styles', array(
            'bootstrap' => array(
                'src'     => CYNO_BS_VENDOR_URL . '/bootstrap/css/bootstrap.min.css',
                'deps'    => array(),
                'version' => '5.3.0',
                'media'   => 'all',
            ),
            'cyno-bs-style' => array(
                'src'     => get_stylesheet_uri(),
                'deps'    => array('bootstrap'),
                'version' => CYNO_BS_VERSION,
                'media'   => 'all',
            ),
        ));

        foreach ($styles as $handle => $style) {
            wp_register_style(
                $handle,
                $style['src'],
                $style['deps'],
                $style['version'],
                $style['media']
            );
        }
    }

    /**
     * Enqueue scripts
     */
    public function enqueue_scripts() {
        $scripts = apply_filters('cyno_bs_enqueue_scripts', array(
            'bootstrap-bundle',
            'cyno-bs-script',
        ));

        foreach ($scripts as $handle) {
            wp_enqueue_script($handle);
        }

        if (is_singular() && comments_open() && get_option('thread_comments')) {
            wp_enqueue_script('comment-reply');
        }
    }

    /**
     * Enqueue styles
     */
    public function enqueue_styles() {
        $styles = apply_filters('cyno_bs_enqueue_styles', array(
            'bootstrap',
            'cyno-bs-style',
        ));

        foreach ($styles as $handle) {
            wp_enqueue_style($handle);
        }
    }

    /**
     * Add Bootstrap classes to navigation menu items
     */
    public function nav_menu_css_class($classes, $item) {
        $classes[] = 'nav-item';
        return $classes;
    }

    /**
     * Add Bootstrap classes to navigation menu links
     */
    public function nav_menu_link_attributes($atts, $item, $args) {
        $atts['class'] = 'nav-link';
        return $atts;
    }
}

// Initialize theme
function cyno_bs_init() {
    return Cyno_BS_Init::instance();
}

// Start the theme
cyno_bs_init(); 