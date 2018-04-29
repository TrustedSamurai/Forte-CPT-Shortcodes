<?php

/* 
 * @package wamp\fwd;
 * 
 */
namespace fwd\short;
     
        
    class user_fwd  {
        
        public function __construct()  {
          add_shortcode( 'fwd-show-posttype', array($this, 'fwd_archive_loop') );
          add_shortcode( 'fwd-show-postlist', array($this, 'fwd_archive_loop_list') );
             
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
       public function fwd_archive_loop_list ($atts = [], $content = null, $tag = '')
        {
           ob_start();
           include( FWD_SHORTCODE_DIR . 'user/views/fwd_archive_loop_list_function.php' );
           return ob_get_clean();
        }       
        
    }