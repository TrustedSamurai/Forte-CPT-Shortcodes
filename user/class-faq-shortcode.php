<?php

/* 
 * @package fwd\short;
 * 
 */
namespace fwd\short;
     
        
    class fwd_shortcodes  {
        
        public function __construct()  {
            add_shortcode( 'fwd-show-posttype', array( $this, 'fwd_archive_loop' ) );
            add_shortcode( 'fwd-show-postlist', array( $this, 'fwd_archive_bullet_list' ) );
         }


        /*
         * short code
         */
        public function fwd_archive_loop ()
        {
           ob_start();
           include( FWD_SHORTCODE_DIR . 'user/views/fwd_archive_loop_function.php' );
           return ob_get_clean();
        }       
        

        /*
         * short code
         */
        public function fwd_archive_bullet_list ($atts = [], $content = null, $tag = '')
        {
           ob_start();
           include( FWD_SHORTCODE_DIR . 'user/views/fwd_archive_bullet_list_function.php' );
           return ob_get_clean();
        }       

        
    }