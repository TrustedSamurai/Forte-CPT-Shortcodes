<?php
/* 
 OUTPUT THE SHORTCODE
 This will display a list of CPT Titles sorted by the numeric field specified in the
 shortcode.  It will also restrict output to just the taxonomy specified.

 arguments are:
 	posttypeslug	- what is the slug of the main posttype?
 	taxonomyslug	- slug of taxonomy stated in $args 'taxonomy' array below
	numericsortslug - where a numeric sort is required specify the slug of the field here
	filterdate 		- specify the date slug if you want to hide content earlier than today()

 */

     // normalize attribute keys, lowercase
    $atts = array_change_key_case((array)$atts, CASE_LOWER);
    // override default attributes with user attributes
    $posttypeslug  		= shortcode_atts( array( 'posttypeslug' 	=> '*', ), $atts);
    $taxonomyslug  		= shortcode_atts( array( 'taxonomyslug' 	=> '*', ), $atts);
    $numericsortslug 	= shortcode_atts( array( 'numericsortslug' 	=> '*', ), $atts);
    $filterdate		 	= shortcode_atts( array( 'filterdate' 		=> '2000-01-01', ), $atts);

    var_dump($posttypeslug);


 	foreach ($taxonomyslug as $a) {
 		$taxonomylist .= $a;  // this probably won't handle an array properly yet!
 	}

 	$a='';
	foreach ($numericsortslug as $a) { // if there are multiples of this it will break!
 		$numericsortslugname .= $a;
 	} 

 	$a='';
	foreach ($filterdate as $a) { // if there are multiples of this it will break!
 		$filterdate .= $a;
 	} 

	$today = date("o-m-d");
	$future = strtotime ( '+6 days' , strtotime ( $today ) ) ;
	$future = date ( 'o-m-d' , $future );

  	$args = array( 

		'post_type' 		=> 'publications', 
		'post_status' 		=> 'publish',
    	'tax_query' 		=> array(                     
    	'relation' 			=> 'OR',                      
      		array(
		        'taxonomy' 	=> 'fwd_authors',     // native slug of taxonomy (change this)        
		        'field' 	=> 'slug',                    
		        'terms' 	=> array( $taxonomylist )
  		        )
      	),  

      	// 'meta_query'  => array(
       //   	array(
	      //     'key'     => $filterdate,
	      //     'value'   => array($today,$future),
	      //     'compare' => 'BETWEEN',
	      //     'type'    => 'DATE'
	      //     )
       //  ),

		'orderby'			=> 'meta_value meta_value_num',  // set order by a custom value text or numeric
		'meta_key'			=> $numericsortslugname,		 // define the slug to sort by
		'order'				=> 'ASC'
		);

	$the_query = new WP_Query( $args );       

	 if ( $the_query->have_posts()  ) : ?>
 		<div class="fwd_CPT_loop_list">
        <ul>    
			<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
	            <li class="fwd_CPT_title">
	                <!-- <p><?php the_field( 'fwd_publication_year' ); ?></p> -->
	                <a href="<?php the_permalink($the_query->ID); ?>">
	                <?php the_title(); ?></a>
	            </li>
        	<?php endwhile; ?>
		</ul>
		</div>

    	<?php wp_reset_postdata(); ?>
    <?php else: ?>
        <h2>No Articles by this author exist</h2>
     <?php endif; ?>


