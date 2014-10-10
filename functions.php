<?php
/**
 * CalibreFx Framework
 *
 * WordPress Themes Framework by CalibreFx Team
 *
 * @package		CalibreFx
 * @author		CalibreFx Team
 * @copyright   Copyright (c) 2012-2014, Calibreworks. (http://www.calibreworks.com/)
 * @license		GNU/GPL v2
 * @link		http://www.calibrefx.com
 *
 * The WordPress functions.php file. initialize CalibreFx framework and themes.
 *
 */

!defined('CALIBREFX_URI') && define('CALIBREFX_URI', get_template_directory());
!defined('CALIBREFX_URL') && define('CALIBREFX_URL', get_template_directory_uri());

/** Define Theme Info Constants */
define('FRAMEWORK_NAME', 'Calibrefx');
define('FRAMEWORK_CODENAME', 'Red Penguin');
define('FRAMEWORK_VERSION', '2.0a');
define('FRAMEWORK_DB_VERSION', '1000');
define('FRAMEWORK_URL', 'http://www.calibrefx.com');
define('FRAMEWORK_RELEASE_DATE', date_i18n('F j, Y', '1400033811'));

/** Run the calibrefx_pre Hook */
do_action('calibrefx_pre');

/*
 * ------------------------------------------------------
 *  Load the global functions
 * ------------------------------------------------------
 */
require_once( CALIBREFX_URI . '/system/config/constants.php');
require_once( CALIBREFX_URI . '/system/common.php' );

require_once( CALIBREFX_URI . '/system/class.calibrefx.php' );
require_once( CALIBREFX_URI . '/system/class.calibrefx-loader.php' );
require_once( CALIBREFX_URI . '/system/class.calibrefx-admin.php' );
require_once( CALIBREFX_URI . '/system/class.calibrefx-model.php' );
require_once( CALIBREFX_URI . '/system/class.calibrefx-generator.php' );


if ( ! isset( $content_width ) ) {
    $content_width = apply_filters( 'calibrefx_content_width', 550 );
}

/**
 * Run the Engine
 */
function calibrefx_initializing(){
    global $calibrefx;
    $calibrefx = Calibrefx::get_instance();

    // Add theme support
    add_theme_support('html5', array( 'comment-list', 'comment-form', 'search-form' ));
    add_theme_support('menus');
    add_theme_support('automatic-feed-links');
    add_theme_support('post-thumbnails');
    add_theme_support( 'post-formats', array(
        'aside', 'image', 'video', 'audio', 'quote', 'link', 'gallery',
    ) );

    //remove unneccesary headers 
    remove_action('wp_head', 'wp_generator');

    // Run the engine 
    $calibrefx->run();
    
    if( is_child_theme() ) {
        $calibrefx->load->add_child_path( CHILD_URI . '/app' );
        $calibrefx->load->do_autoload( CHILD_URI . '/app/config/autoload.php' );
    }
}
add_action( 'after_setup_theme', 'calibrefx_initializing', 0 );

/**
 * Enable GZip Compression
 */
function calibrefx_gzip_compression() {
     if (!current_theme_supports( 'calibrefx-preformance' ) )
         return false;
     
    // don't use on TinyMCE
    if (stripos( $_SERVER['REQUEST_URI'], 'wp-includes/js/tinymce' ) !== false) {
        return false;
    }
    // can't use zlib.output_compression and ob_gzhandler at the same time
    if (( ini_get( 'zlib.output_compression' ) == 'On' || ini_get( 'zlib.output_compression_level' ) > 0 ) || ini_get( 'output_handler' ) == 'ob_gzhandler' ) {
        return false;
    }

    if (extension_loaded( 'zlib' ) ) {
        ob_end_clean();
        ob_start( 'ob_gzhandler' );
    }
}
add_action( 'init', 'calibrefx_gzip_compression' );