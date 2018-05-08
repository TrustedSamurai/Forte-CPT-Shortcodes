<?php
/* 
 OUTPUT THE SHORTCODE
 This will display a list of CPT Titles sorted by the numeric field specified in the
 shortcode.  It will also restrict output to just the taxonomy specified.

 arguments are:
    posttypeslug		- what is the slug for the post type to be listed?
 	taxonomyslug		- slug of taxonomy stated in $args 'taxonomy' array below
	taxonomystring		- The string within the taxonomy slug to search/filter on
	numericsortslug 	- where a numeric sort is required specify the slug of the field here
	filterdate 			- specify the date slug if you want restrict the content based on numbersofdaysfuture and numberofdayspast.
	numberofdaysfuture	- set the number of days worth of entries to display.  Defaults to 0 (unlimited days).
	numberofdayspast	- set the number of days worth of entries to display.  Defaults to 0 (unlimited days).

	displaydate			- when displaying the event date at the front of title specify 
							- 'N' to hide date
							- DMY to display dd Mmm YYYY
							- DM  to display dd Mmm.
							Defaults to (N).

 */

     // normalize attribute keys, lowercase
    $atts = array_change_key_case((array)$atts, CASE_LOWER);
    // override default attributes with user attributes
    $atts = shortcode_atts( array( 
    	'posttypeslug' 			=> '', 
    	'taxonomyslug' 			=> '',
    	'taxonomystring'		=> '',
    	'numericsortslug' 		=> '',
		'numberofdaysfuture'	=> 0,
		'numberofdayspast'		=> 0,
		'displaydate'			=> 'n',
		'filterdate' 			=> '' )
    , $atts );

 
 
if ( ! $atts['posttypeslug'] 	|| 
	 ! $atts['taxonomyslug'] 	||
	 ! $atts['numericsortslug'] || 
	 ! $atts['taxonomystring'] 
	) {
	echo ('Error: This shortcode requires a value for <br>
			<strong>postypeslug</strong> = the slug of the Custom Post Type you want to list from.<br>
			<strong>taxonomyslug</strong> = the slug of the taxonomy that you want to restrict the list to (look in CPT editor).<br>
			<strong>taxonomystring</strong> = this is the taxonomy value itself.  ie: North or Fred.<br>
			<strong>numericsortslug</strong> = the slug of the numeric field in your CPT to order the results by.<br>');
	echo ( '<strong>Values parsed are: </strong><br>');
	echo ('posttypeslug: ' 		. $atts['posttypeslug']  	.'<br>');
   	echo ('taxonomyslug: ' 		. $atts['taxonomyslug']  	.'<br>');
   	echo ('taxonomystring: ' 	. $atts['taxonomystring']  	.'<br>');
   	echo ('numericsortslug: ' 	. $atts['numericsortslug']  .'<br>');
   	echo ('filterdate: ' 		. $atts['filterdate'] ) 	.'<br>';
	return;
	}

	//
	// These date ranges will only be used if a date_slug is specified from the CPT
	if (0 == $atts['numberofdayspast'] ) {
		$atts['numberofdayspast'] = 7300; // set it to show 20 years into past
	}
	if (0 == $atts['numberofdaysfuture'] ) {
		$atts['numberofdaysfuture'] = 7300; // set it to show 20 years into past
	}
	$today = date("o-m-d");
	$past = strtotime ( '-'.$atts['numberofdayspast'].' days' , strtotime ( $today ) ) ;
		$past = date ('o-m-d' , $past );

	$future = strtotime ( '+'.$atts['numberofdaysfuture'].' days' , strtotime ( $today ) ) ;
		$future = date ('o-m-d' , $future );

 

	if ( ! $atts['filterdate'] ) { // do not filter on date range
  	$args = array( 
		'post_type' 		=> $atts['posttypeslug'],  // change this to the post type slug 
		'post_status' 		=> 'publish',
    	'tax_query' 		=> array(                     
    	'relation' 			=> 'OR',                      
      		array(
		        'taxonomy' 	=> $atts['taxonomyslug'],     // native slug of taxonomy (change this)        
		        'field' 	=> 'slug',                    
		        'terms' 	=> array( $atts['taxonomystring'] )
  		        )
      	),  
		'orderby'			=> 'meta_value meta_value_num',  // set order by a custom value text or numeric
		'meta_key'			=> $atts['numericsortslug'],		 // define the slug to sort by
		'order'				=> 'ASC'
		);
  } else {
  	$args = array( 
		'post_type' 		=> $atts['posttypeslug'],  // change this to the post type slug 
		'post_status' 		=> 'publish',
    	'tax_query' 		=> array(                     
    	'relation' 			=> 'OR',                      
      		array(
		        'taxonomy' 	=> $atts['taxonomyslug'],     // native slug of taxonomy (change this)        
		        'field' 	=> 'slug',                    
		        'terms' 	=> array( $atts['taxonomystring'] )
  		        )
      	),  

     	'meta_query'  => array(
          	array(
	           'key'     => $atts['filterdate'],
	           'value'   => array($today,$future),
	           'compare' => 'BETWEEN',
	           'type'    => 'DATE'
	           )
         ),
		'orderby'			=> 'meta_value meta_value_num',  // set order by a custom value text or numeric
		'meta_key'			=> $atts['numericsortslug'],		 // define the slug to sort by
		'order'				=> 'ASC'
		);
  }

	$the_query = new WP_Query( $args );       

	 if ( $the_query->have_posts()  ) : ?>
 		<div class="fwd_CPT_loop_list">
        <ul>    
			<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
	            <li class="fwd_CPT_title">
	                <!-- <p><?php the_field( 'fwd_publication_year' ); ?></p> -->
	                <a href="<?php the_permalink($the_query->ID); ?>">
	                	<?php  
		                	if ( ! $atts['filterdate'] ) {
		                		//no date available use the post publication date
		                		$newsdate = get_the_date( 'Y-m-d' ) ;
		                	} else {
		                		// a date slug has been specified
		                		$newsdate = get_field( $atts['filterdate'], false, false );
		                	}
							$newsdate = new DateTime( $newsdate );
							if ( 'DM' == $atts['displaydate']) {
								echo $newsdate->format('j M').'-';
							} elseif ( 'DMY' == $atts['displaydate']) {
								echo $newsdate->format('j M Y').'-';
							} ?>
							<?php the_title(); ?></a>
	            </li>
        	<?php endwhile; ?>
		</ul>
		</div>

    	<?php wp_reset_postdata(); ?>
    <?php else: ?>
        <p>(No Articles to display)</p>
     <?php endif; ?>


