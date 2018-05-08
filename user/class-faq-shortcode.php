<?php

/* 
 * @package fwd\short;
 * 
 */
namespace fwd\short;
     
        
    class fwd_shortcodes  {
        
        public function __construct()  {
            add_shortcode( 'fwd-show-posttype', array( $this, 'fwd_archive_loop' ) );

            // fwd_show_postlist1 displays bullet list filtered on a single taxonomy and taxonomy entry
            add_shortcode( 'fwd-show-postlist1', array( $this, 'fwd_archive_bullet_list' ) );

            // fwd_show_postlist2 displays bullet list - All Entries
            add_shortcode( 'fwd-show-postlist2', array( $this, 'fwd_archive_bullet_list_unfiltered' ) );
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

        /*
         * fwd_show_postlist2 displays bullet list - All Entries.
         * return bullet list with several columns - labelled but unsorted.
         *
         * Ideally this larger unsorted unfiltered list should be managed by a JQuery on the front end.
         *
         */
        public function fwd_archive_bullet_list_unfiltered ($atts = [], $content = null, $tag = '')
        {
           ob_start();
           include( FWD_SHORTCODE_DIR . 'user/views/fwd_archive_bullet_list_unfiltered_function.php' );
           return ob_get_clean();
        }           
    }