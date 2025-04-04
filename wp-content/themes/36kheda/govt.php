<?php
/*
Template Name: Govt Custom Page
*/
get_header();

$actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$actual_link = explode("/", $actual_link);
$taxas = $actual_link[4];  
$vals =  $actual_link[5];

?>
<ul  class="nav nav-pills">
			<li class="left-li">
             <a href="#1a" data-toggle="tab">Tab1 </a>
			</li>
			<li class="right-li">
				<a href="#2a" data-toggle="tab">Tab2</a>
			</li>
		
</ul>
<div class="col-md-9 left-big">
        <div class="row">
			<div class="breadcames">
<?php if(function_exists('bcn_display'))
		    {
		        bcn_display();
		    }?>
</div>
				<?php 
				$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
				if(isset($taxas)&&$taxas=="category"){
					$taxa = 'job-cat';
					$val = $vals;
					$tx = get_term_by('slug', $val, $taxa);
					echo "<h2>".$tx->name."</h2>";
				} else if(isset($taxas)&&$taxas=="qualifications") {
					$taxa = 'qualifications';
					$val = $vals;
					$tx = get_term_by('slug', $val, $taxa);
					echo "<h2>".$tx->name."</h2>";
				} else if(isset($taxas)&&$taxas=="locations") {
					$taxa = 'locations';
					$val = $vals;
					$tx = get_term_by('slug', $val, $taxa);
					echo "<h2>".$tx->name."</h2>";
				} else {?>
					<h2 class="govt_jobs">सरकारी नौकरी</h2>
				<? }
				echo '<div class="blog-list govt-list">';
				if(isset($taxa)){
				
				$args = array(
					'post_type' => 'jobs',
					'posts_per_page' => '10',
					'order' => 'DESC',
					'post_status' => 'publish',
					'paged' => $paged,
					'tax_query' => array(
						array(
							'taxonomy' => $taxa,
							'field'    => 'slug',
							'terms'    => $val,
						),
					),
				);
				
				} else{

				$args = array(
					'post_type' => 'jobs',
					'posts_per_page' => '10',
					'order' => 'DESC',
					'post_status' => 'publish',
					'paged' => $paged
				);
				}
				$the_query = new WP_Query( $args ); ?>
				<?php if ( $the_query->have_posts() ) : ?>
					<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
	                    <div class="col-md-12" >
	                    <? $hasThumb = has_post_thumbnail();
	                    if($hasThumb){
	                     ?>
						 <div class="col-md-3">
						<a href="<?php echo get_the_permalink();?>"><? the_post_thumbnail('thumb'); ?></a>
					</div>	 
					<div class="col-md-9">	
					<? } ?>
						<h4><strong><a href="<?php echo get_the_permalink();?>"><?php the_title(); ?></a></strong></h4>
						<?php
					$thecont = $post->post_content;
					$getlength = strlen($thecont);
					$thelength = 175;
					$contIs = mb_substr($thecont, 0, $thelength, 'UTF-8');
						?>
						<p><?php echo $contIs; ?> <a href="<?php echo get_the_permalink();?>">Read More...</a></p>
						by <span><? echo the_author_posts_link(); ?></span>
						<div class="date"> <?php echo human_time_diff( get_the_time('U'), current_time('timestamp') ) . ' ago'; ?> </div>
	                   <? if($hasThumb){
	                     ?>
	                            </div> 
	                            <? }?>
	                            <div class="clearfix"></div>
					</div>
					
				 
                    <?php endwhile; ?>
    <!-- end of the loop -->

    <!-- pagination here -->
    <?php
      if (function_exists(custom_pagination)) {
        custom_pagination($the_query->max_num_pages,"",$paged);
      }
    ?>

  <?php wp_reset_postdata(); ?>
                    
				<?php else : ?>
					<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
                   
				<?php endif; ?>

			</div>
            </div>
		</div>




		<div class="col-md-3 sidebar-filter right-small">
			
			<div class="radioBH">
			<h1> JOBS BY CATEGORY</h1> 
			<?php

			 $taxonomy = 'job-cat';
			 $terms = get_terms($taxonomy); // Get all terms of a taxonomy

			 if ( $terms && !is_wp_error( $terms ) ) :
			?>
			    <div class="job-cat"> 
			        <?php foreach ( $terms as $term ) { ?>
						 <div><a href="<?php echo get_term_link($term->slug, $taxonomy); ?>">  >  <?php echo $term->name; ?></a></div> 
			        <?php } ?>
			     </div>  
			<?php endif;?>
			</div>
			<div class="radioBH">
			<h1> Jobs by Qualifications</h1> 
			<?php

			 $taxonomy = 'qualifications';
			 $terms = get_terms($taxonomy); // Get all terms of a taxonomy

			 if ( $terms && !is_wp_error( $terms ) ) :
			?>
			    <div class="qualifications"> 
			        <?php foreach ( $terms as $term ) { ?>
						 <div><a href="<?php echo get_term_link($term->slug, $taxonomy); ?>">  >  <?php echo $term->name; ?> <?php  //echo '(' ;  echo $term->count; echo ')'; ?></a></div> 
			        <?php } ?>
			     </div>  
			<?php endif;?>
			</div>	
			<div class="radioBH">
			<h1> JOBS BY STATES</h1> 
			<?php

			 $taxonomy = 'locations';
			 $terms = get_terms($taxonomy); // Get all terms of a taxonomy

			 if ( $terms && !is_wp_error( $terms ) ) :
			?>
			    <div class="locations">

			        <?php foreach ( $terms as $term ) { ?>
			        	<div class="myBox">
						 <div><a href="<?php echo get_term_link($term->slug, $taxonomy); ?>">  >  <?php echo $term->name; ?></a></div> 
						</div>
			        <?php } ?>
			     </div>  
			<?php endif;?>
		</div>


			<!-- <form class="radioBH" action="<?php $_PHP_SELF ?>" method="GET">
				<h1>Jobs by Category</h1>
				<?
				$terms = get_terms( 'job-cat' );
				$count = count( $terms );
				if ( $count > 0 ) {
					echo '<div class="category">';
					foreach ( $terms as $term ) {
					
						if($vals==$term->slug){
							echo '<label><input class="job_r" type="radio" name="category" value="'.$term->slug.'" checked> ' . $term->name . ' ('.$term->count.') </label><br>';	
						}else {
							echo '<label><input class="job_r" type="radio" name="category" value="'.$term->slug.'"> ' . $term->name . ' ('.$term->count.') </label><br>';
						}
					}
					echo "</div>";

				}				
				?>
			</form>

			<form class="radioBH" action="<?php $_PHP_SELF ?>" method="GET">
				<h1>Jobs by Qualifications</h1>
				<?
				$terms = get_terms( 'qualifications' );
				$count = count( $terms );
				if ( $count > 0 ) {
					echo '<div class="qualifications">';
					foreach ( $terms as $term ) {
						
						if($vals==$term->slug){
							echo '<label><input type="radio" name="qualifications" value="'.$term->slug.'" checked> ' . $term->name . ' ('.$term->count.')</label> <br>';	
						}else {
							echo '<label><input type="radio" name="qualifications" value="'.$term->slug.'"> ' . $term->name . ' ('.$term->count.')</label> <br>';
						}
						
					}
					echo '</div>';
				}				
				?>
			</form>

			<form class="radioBH" action="<?php $_PHP_SELF ?>" method="GET">
				<h1>Jobs by States</h1>
				<?
				$terms = get_terms( 'locations' );
				$count = count( $terms );
				if ( $count > 0 ) {
					echo '<div class="locations">';
					foreach ( $terms as $term ) {
						echo '<div class="myBox">';
						if($vals==$term->slug){
							echo '<label><input type="radio" name="locations" value="'.$term->slug.'" checked> ' . $term->name . ' ('.$term->count.')</label> <br>';	
						}else {
							echo '<label><input type="radio" name="locations" value="'.$term->slug.'"> ' . $term->name . ' ('.$term->count.')</label> <br>';
						}
						echo '</div>';
					}
				echo '</div>';					
				}				
				?>
			</form> -->
			
			<h1>Jobs Archives</h1>
			<?php $args = array(
				'type'            => 'monthly',
				'limit'           => '',
				'format'          => 'html', 
				'before'          => '',
				'after'           => '',
				'show_post_count' => true,
				'echo'            => 1,
				'order'           => 'DESC',
			    'post_type'     => 'jobs'
			);
			wp_get_archives( $args ); ?>
			<?


				/*$terms = get_terms( 'locations' );
				$count = count( $terms );
				if ( $count > 0 ) {
					echo '<h1>Jobs by States</h1>';	
					echo '<ul class="locations myBox">';
					foreach ( $terms as $term ) {
						echo '<li class="'.$term->slug.'">' . $term->name . '</li>';
					}
					echo '</ul>';
				}*/

				/*$terms = get_terms( 'types' );
				$count = count( $terms );
				if ( $count > 0 ) {
					echo '<h1>Jobs Types</h1>';	
					echo '<ul class="types">';
					foreach ( $terms as $term ) {
						echo '<li class="'.$term->slug.'">' . $term->name . '</li>';
					}
					echo '</ul>';
				}*/

								

				

			?>
		</div>

<?php get_footer(); ?>

<script>
$(document).ready(function(){
    $("button").click(function(){
        $(".sidebar-filter-job").toggle();
    });


    $('.left-big').show();
    $('.right-small').hide()

    $('.left-li').on('click', function(){
    	console.log('left')
    	$('.left-big').show();
   		$('.right-small').hide();

    });

    $('.right-li').on('click', function(){
    	console.log('right')
    	$('.right-small').show();
	    	$('.left-big').hide();
    })



});
</script>