<?php
/**********
* Plugin Name: Forte Shortcode plugin
* Plugin URI: http://google.com
* Description: Insert content into DIVI and hass Css support
* Version: 1.0.0
* Author: John Anderson
* Author URI: http://google.com
 * License:     GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 */

namespace fwd\short;

// stop unwanted visitors calling directly
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Go away!' );
}

    define ( 'FWD_SHORTCODE_DIR', plugin_dir_path( __FILE__));

    
function launch () {

    global $pagenow, $post_type;
    
    if (!is_admin()) {
        include (FWD_SHORTCODE_DIR . '/user/class-faq-shortcode.php'); 
        $run_user = new user_fwd();   
                   
    }    
    
}
launch();