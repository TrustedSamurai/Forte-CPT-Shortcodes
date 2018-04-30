<?php

/* 
 * @package fwd\short;
 * 
 */
namespace fwd\short;
     
        
    class fwd_admin  {
        
        public function __construct()  {
            // include the admin page under the Settings Menu
            add_action( 'admin_menu', array( $this, 'fwd_add_options_page' ) );
                    
        }


        /*
         *
         * set up the Admin menu 
         *
         */
        public function fwd_add_options_page() 
        {
            // add settings page for FWD CPT Shortcode plugin
            add_options_page( 
                'Forte CPT Shortcodes', 
                'Forte CPT Shortcodes', 
                'read', 
                'fwd-cpt-shortcode-page', 
                array( $this, 'fwd_cpt_shortcode_page_function' ) 
            );

        }

 
        public function fwd_cpt_shortcode_page_function() {  
            ?>
            <h2><?php _e('Custom Post Types - Shortcodes'); ?></h2>
            <p><?php _e('by John Anderson :- Forte Web Design'); ?></p>
            <table class="form-table">
                <tbody>
                    <tr valign="top">
                        <th scope="row" valign="top">
                        </th>
                        <td>
                        </td>
                    </tr>
                    <tr valign="top">
                        <th scope="row" valign="top">
                        </th>
                        <td>
                            
                        </td>
                        <th scope="row" valign="top">
                            
                        </th>
                        <td>
                            
                        </td>
                    </tr>
                </tbody>
            </table>
 
            <?php 

        }

        
    }