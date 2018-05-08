<?php
/* 
 OUTPUT THE SHORTCODE
 This will display a list of CPT Titles unsorted 
 It may do some restrictions.
 It may bring back columns identified in the shortcode (if I'm smart enough)

 arguments are:
    posttypeslug		- what is the slug for the post type to be listed?
 	columnslugs			- array containing slugs of columns to return 

 */

     // normalize attribute keys, lowercase
    $atts = array_change_key_case((array)$atts, CASE_LOWER);
    // override default attributes with user attributes
    $atts = shortcode_atts( array( 
    	'posttypeslug' 			=> '', 
    	'columnslugs' 			=> ''
  //   	'taxonomystring'		=> '',
  //   	'numericsortslug' 		=> '',
		// 'numberofdaysfuture'	=> 0,
		// 'numberofdayspast'		=> 0,
		// 'displaydate'			=> 'n',
		// 'filterdate' 			=> '' 
    )
    , $atts );

 
 
if ( ! $atts['posttypeslug'] ) {
	echo ('Error: This shortcode requires a value for <br>
			<strong>postypeslug</strong> = the slug of the Custom Post Type you want to list from.<br>
			<strong>columnslugs</strong> = the list of field/column slugs within this post type that you want to return.<br>');
	echo ( '<strong>Values parsed are: </strong><br>');
	echo ('posttypeslug: ' 		. $atts['posttypeslug']  	.'<br>');
   	echo ('columnslugs: ' 		. $atts['columnslugs']  	.'<br>');
	return;
	}

 /* to begin with, focus on returning all columns within the post type.
 	maybe do this as a default.

 	The other option is for the user to specify the column name slugs to return.  This will most likely require an array.
 */

  	$args = array( 
		'post_type' 		=> $atts['posttypeslug'],  // change this to the post type slug 
		'post_status' 		=> 'publish'
		);
 

	$the_query = new WP_Query( $args );       

	 if ( $the_query->have_posts()  ) : ?>
 		<div class="fwd_CPT_loop_list">
 		<table id="table_id" class="display">
 			<thead>
 			<tr>
 				<th>
 					Title
 				</th>
 				<th>
 					Authors
 				</th>
 				<th>
 					Journal
 				</th>
 				<th>
 					Published
 				</th>
  			</tr>
  			</thead>

  			<tbody>
			<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
	            <tr>
	            	<!-- <div class="fwd_CPT_article"> -->
	            		<td>

			            	<div class="fwd_CPT_title">
			                	<a href="<?php the_permalink($the_query->ID); ?>"><?php the_title(); ?></a>
							</div> <!-- fwd_CPT_title -->
						</td>

						<td>
							<div class="fwd_CPT_line2">
								<? 
									$authorlist ='';
									$authors = get_field( 'fwd_publication_author' );
									foreach ( $authors as $author ):
										$authorlist .= $author->name . ', ';
									endforeach;
									echo substr( $authorlist, 0, strlen ( $authorlist )-1  ); // remove last comma.
								?>
							</div> <!-- fwd_CPT_line2 -->
						</td>

						<td>
			            	<div class="fwd_CPT_line3">
			                	<? $journals = get_field( 'fwd_publication_journal' ); 
			                	// var_dump($journals);
			                	if ($journals) {echo $journals->name .' ';}
			                	
			                	echo get_field( 'fwd_publication_volume' ) . ', ' . get_field( 'fwd_publication_pages' );
			                	?>
							</div> <!-- fwd_CPT_line3 -->
						</td>

						<td>
			            	<div class="fwd_CPT_line4">
			            		<?
			                	echo get_field( 'fwd_publication_year' ) ;
			                	?>
							</div> <!-- fwd_CPT_line4 -->
						</td>					
	            	<!-- </div> fwd_CPT_article -->
				</tr>
        	<?php endwhile; ?>
        	</tbody>
 			<tfoot>
 			<tr>
 				<th>
 					Title
 				</th>
 				<th>
 					Authors
 				</th>
 				<th>
 					Journal
 				</th>
 				<th>
 					Published
 				</th>
  			</tr>
  			</tfoot>
       </table>
		</div>
						
		<?
		// dump list of fields out / test debug 
		
		// $fields = get_fields();
		// if( $fields ): 
		// 	foreach( $fields as $name => $value ): 
		// 		echo '<div><b>' .$name; '</b></div>';
		// 	endforeach; 
		//endif; 

    	wp_reset_postdata(); 
     else: ?>
        <p>(No Articles to display)</p>
     <?php endif; ?>


