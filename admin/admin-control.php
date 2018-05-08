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
            <p><?php _e('This plugin allows you to generate lists of CPTs in different formats and within certain date ranges etc.  For example you might want to display a list of Posts for a single taxonomy and exclude any where the date has expired.  '); ?></p>
            
        <h2>fwd-show-postlist1</h2>
        <p>
          Lists your posts in an un-ordered list. Restrict the list by a taxonomy ie: only show me posts where the Region = "North". Restrict the list by a date range. ie: Using the Event Date field show me Posts up to 30 days ahead of today. Sorts the list in the date order of the Date field you specify.
        </p>
        <h3>Parameters</h3>
        <table class="table">
          <tr>
            <th>posttypeslug</th>
            <td>slug of posttype to be displayed in this list</td>
          </tr>

          <tr>
            <th>taxonomyslug</th>
            <td>slug of taxonomy stated in $args 'taxonomy' array below</td>
          </tr>
            <th>taxonomystring</th>
            <td>The string within the taxonomy slug to search/filter on</td>
          </tr>
          <tr>
            <th>numericsortslug</th>
            <td>where a numeric sort is required specify the slug of the field here</td>
          </tr>
          <tr>
            <th>filterdate</th>
            <td>    specify the date slug if you want restrict the content based on numbersofdaysfuture and numberofdayspast.</td>
          </tr>
          <tr>
            <th>numberofdaysfuture</th>
            <td>set the number of days worth of entries to display. Defaults to 0 (unlimited days).</td>
          </tr>
          <tr>
            <th>numberofdayspast</th>
            <td>set the number of days worth of entries to display. Defaults to 0 (unlimited days).</td>
          </tr>
          <tr>
            <th>displaydate</th>
            <td>when displaying the event date at the front of title specify <br>'N' to hide date<br>
        DMY to display dd Mmm YYYY<br>
        DM to display dd Mmm<br>
        Defaults to (N).</td>
          </tr>
          <tr>
        </table>

        <style>
            body {
              padding: 2em;
            }

            table.table { width: 100%; }

            .table th, .table td { 
              text-align: left; 
              padding: 0.25em;
            }

            .table th {
              width:10%;
            }

            .table tr { 
              border-bottom: 1px solid #DDD;
            }
            @media screen and (max-width: 800px) {
              tr { 
                display: flex; 
                flex-direction: row;
                flex-wrap: wrap;
                margin: 0.5em 0;
                border: 1px solid rgba(3,3,3,0.2);
              }
              td, th {
                flex: 1 1 150px;
                border: 0.5px solid rgba(3,3,3,0.2);
              }
              td.edit-buttons, td.empty {
                /*flex: 1 0 90%;
                text-align: center;*/
              }
            }
        </style>
            <?php 

        }

        
    }