<?php
/* 
 OUTPUT THE SHORTCODE
 */

	$args = array( 

		'post_type' 		=> 'publications', 
		'post_status' 		=> 'publish',
		'meta_key'			=> 'fwd_publication_year',
		'orderby'			=> 'meta_value meta_value_num',
		'order'				=> 'ASC'
		);

	$the_query = new WP_Query( $args );       

	 if ( $the_query->have_posts()  ) : ?>
        <ul>    
			<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
				<hr>
	            <li class="fwd_CPT_publications">
	                <p><?php the_field( 'fwd_publication_year' ); ?></p>
	                <a href="<?php the_permalink($the_query->ID); ?>"><?php the_title(); ?></a>
	                <p>fwd_publication_volume: <?php the_field( 'fwd_publication_volume' ); ?></p>
	                <p>Publication page count: <?php the_field( 'fwd_publication_pages' ); ?></p>


	            </li>
        	<?php endwhile; ?>
		</ul>

    	<?php wp_reset_postdata(); ?>
    <?php else: ?>
        <h2>No FAQ'S available!</h2>
     <?php endif; ?>


