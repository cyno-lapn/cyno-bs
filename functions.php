<?php
/**
 * Theme functions and definitions
 *
 * @package Cyno_BS
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

// Define theme constants
define('CYNO_BS_VERSION', '1.0.0');
define('CYNO_BS_THEME_DIR', get_template_directory());
define('CYNO_BS_THEME_URL', get_template_directory_uri());
define('CYNO_BS_INC_DIR', CYNO_BS_THEME_DIR . '/inc');
define('CYNO_BS_ASSETS_URL', CYNO_BS_THEME_URL . '/assets');
define('CYNO_BS_VENDOR_URL', CYNO_BS_THEME_URL . '/vendor');

// Load theme initialization class
require_once CYNO_BS_INC_DIR . '/class-cyno-bs-init.php';
