<?php
/**********
* Plugin Name: Forte Shortcode plugin
* Plugin URI: https://fortewebdesign.com.au
* Description: Custom Post Type Shortcodes
* Version: 1.1.0
* Author: John Anderson
* Author URI: https://fortewebdesign.com.au
 * License:     GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 */

namespace fwd\short;

// stop unwanted visitors calling directly
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Go away!' );
}

define ( 'FWD_SHORTCODE_DIR', plugin_dir_path( __FILE__));


//instantiate the admin menu
require_once (FWD_SHORTCODE_DIR . '/admin/admin-control.php'); 
$fwd_admin_stuff = new fwd_admin();   


    
function launch () {

    global $pagenow, $post_type;
    
    if (!is_admin()) {


 		//instantiate the shortcodes
        include (FWD_SHORTCODE_DIR . '/user/class-faq-shortcode.php'); 
        $fwd_shortcode_stuff = new fwd_shortcodes();   
  }    
    
}


launch();
