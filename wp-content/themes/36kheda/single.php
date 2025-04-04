<?php
/**
 * The template for displaying all single posts
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">
		<div class="col-md-8">
			<?php /* The loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', get_post_format() ); ?>
				<?php twentythirteen_post_nav(); ?>
				<?php comments_template(); ?>

			<?php endwhile; ?>
		</div>
		<div class="col-md-4 govt-single-sidebar">
		<?php

			if ( get_post_type( get_the_ID() ) == 'jobs' ) {


			$category = get_the_terms( $post->ID, array('job-cat') );
			//echo "<h2>".$category[0]->name."</h2>";     
			echo "<h2>Trending Now <span class='glyphicon glyphicon-send' area-hidden='true'></span> </h2>";     
			$thidId = $category[0]->term_id;
			//echo $post->ID;
			?>
			<div class="blog-list">

					<?php 
						$args = array(
								'post__not_in' => array($post->ID),
								'posts_per_page' => '5',
								'order' => 'DESC',
								'tax_query' => array(
								    array(
								    'taxonomy' => 'job-cat',
								    'field' => 'id',
								    'terms' => $thidId
								    )
								  ),
								

								
								);
					$bilal = 1;
					$the_query = new WP_Query( $args ); ?>
					<?php if ( $the_query->have_posts() ) : ?>
					<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
						<div class="col-md-12">
					<div class="img-block col-md-2">	

					<div class="tagss"> 	<?$term_list = wp_get_post_terms($post->ID, 'city', array("fields" => "all"));
									$term_list_topic = wp_get_post_terms($post->ID, 'topic', array("fields" => "all"));
									echo '<a href="'.site_url().'/city/'.$term_list[0]->slug.'">'.$term_list[0]->name.'</a>';
									echo '<a href="'.site_url().'/topic/'.$term_list_topic[0]->slug.'">'.$term_list_topic[0]->name.'</a>';?>
			</div>
			<div class="counterr"><?php echo $bilal; $bilal++;?></div>
			<a href="<?php echo the_permalink(); ?>"><? //the_post_thumbnail(array(100,100));?></a> </div>
						<div class="col-md-10">
						<?php
								$thetitle = $post->post_title;
								$getlength = strlen($thetitle);
								$thelength = 75;
								$titleIs = mb_substr($thetitle, 0, $thelength, 'UTF-8');
								?>
						<h4><a href="<?php echo the_permalink(); ?>"><? echo $titleIs; ?></a></h4>
						 
						<span><? echo the_author_posts_link(); ?></span>
						<div class="date">	<?php echo human_time_diff( get_the_time('U'), current_time('timestamp') ) . ' ago'; ?> </div>
						</div>
						</div>			
					<?php endwhile; ?>
					<?php wp_reset_postdata(); ?>
							

					<?php endif; ?>
		</div>
		<h2> Most Recent <span class="glyphicon glyphicon-hourglass" area-hidden="true"></span></h2>
		<div class="blog-list">

					<?php 
						$args = array(
								'post__not_in' => array($post->ID),
								'post_type' => array('post', 'news', 'jobs'),
								'posts_per_page' => '5',
								'order' => 'DESC',
								);
						$bilal = 1;
					$the_query = new WP_Query( $args ); ?>
					<?php if ( $the_query->have_posts() ) : ?>
					<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
						<div class="col-md-12">
					<div class="img-block col-md-2">	

					<div class="tagss"> 	<?$term_list = wp_get_post_terms($post->ID, 'city', array("fields" => "all"));
									$term_list_topic = wp_get_post_terms($post->ID, 'topic', array("fields" => "all"));
									echo '<a href="'.site_url().'/city/'.$term_list[0]->slug.'">'.$term_list[0]->name.'</a>';
									echo '<a href="'.site_url().'/topic/'.$term_list_topic[0]->slug.'">'.$term_list_topic[0]->name.'</a>';?>
			</div>
					<div class="counterr"><?php echo $bilal; $bilal++;?></div>

			<a href="<?php echo the_permalink(); ?>"><? //the_post_thumbnail(array(100,100));?></a> </div>
						<div class="col-md-10">
						<?php
								$thetitle = $post->post_title;
								$getlength = strlen($thetitle);
								$thelength = 75;
								$titleIs = mb_substr($thetitle, 0, $thelength, 'UTF-8');
								?>
						<h4><a href="<?php echo the_permalink(); ?>"><? echo $titleIs; ?></a></h4>
						 
						<span><? echo the_author_posts_link(); ?></span>
						<div class="date">	<?php echo human_time_diff( get_the_time('U'), current_time('timestamp') ) . ' ago'; ?> </div>
						</div>
						</div>			
					<?php endwhile; ?>
					<?php wp_reset_postdata(); ?>
							

					<?php endif; ?>
		</div>

		<? } else if(get_post_type( get_the_ID() ) == 'news') { 

			$category = get_the_terms( $post->ID, array('topic') );
			//echo "<h2>".$category[0]->name."</h2>";     
			echo "<h2>Trending Now <span class='glyphicon glyphicon-send' area-hidden='true'></span> </h2>";     
			$thidId = $category[0]->term_id;
			//echo $post->ID;
			?>
			<div class="blog-list">

					<?php 
						$args = array(
								'post__not_in' => array($post->ID),
								'posts_per_page' => '5',
								'order' => 'DESC',
								'tax_query' => array(
								    array(
								    'taxonomy' => 'topic',
								    'field' => 'id',
								    'terms' => $thidId
								    )
								  ),
								

								
								);
					$bilal = 1;		
					$the_query = new WP_Query( $args ); ?>
					<?php if ( $the_query->have_posts() ) : ?>
					<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
						<div class="col-md-12">
					<div class="img-block col-md-2">	
					<div class="counterr"><?php echo $bilal; $bilal++;?></div>
					
			<a href="<?php echo the_permalink(); ?>"><? //the_post_thumbnail(array(100,100));?></a> </div>
						<div class="col-md-10">
						<?php
								$thetitle = $post->post_title;
								$getlength = strlen($thetitle);
								$thelength = 75;
								$titleIs = mb_substr($thetitle, 0, $thelength, 'UTF-8');
								?>
						<h4><a href="<?php echo the_permalink(); ?>"><? echo $titleIs; ?></a></h4>
						 
						<span><? echo the_author_posts_link(); ?></span>
						<div class="date">	<?php echo human_time_diff( get_the_time('U'), current_time('timestamp') ) . ' ago'; ?> </div>
						</div>
						</div>			
					<?php endwhile; ?>
					<?php wp_reset_postdata(); ?>
							

					<?php endif; ?>
		</div>
		<h2> Most Recent <span class="glyphicon glyphicon-hourglass" area-hidden="true"></span></h2>
		<div class="blog-list">

					<?php 
						$args = array(
								'post__not_in' => array($post->ID),
								'post_type' => array('post', 'news', 'jobs'),
								'posts_per_page' => '5',
								'order' => 'DESC',
								);
					$bilal = 1;
					$the_query = new WP_Query( $args ); ?>
					<?php if ( $the_query->have_posts() ) : ?>
					<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
						<div class="col-md-12">
					<div class="img-block col-md-2">	

					<div class="tagss"> 	<?$term_list = wp_get_post_terms($post->ID, 'city', array("fields" => "all"));
									$term_list_topic = wp_get_post_terms($post->ID, 'topic', array("fields" => "all"));
									echo '<a href="'.site_url().'/city/'.$term_list[0]->slug.'">'.$term_list[0]->name.'</a>';
									echo '<a href="'.site_url().'/topic/'.$term_list_topic[0]->slug.'">'.$term_list_topic[0]->name.'</a>';?>
			</div>
			<div class="counterr"><?php echo $bilal; $bilal++;?></div>
			<a href="<?php echo the_permalink(); ?>"><? //the_post_thumbnail(array(100,100));?></a> </div>
						<div class="col-md-10">
						<?php
								$thetitle = $post->post_title;
								$getlength = strlen($thetitle);
								$thelength = 75;
								$titleIs = mb_substr($thetitle, 0, $thelength, 'UTF-8');
								?>
						<h4><a href="<?php echo the_permalink(); ?>"><? echo $titleIs; ?></a></h4>
						 
						<span><? echo the_author_posts_link(); ?></span>
						<div class="date">	<?php echo human_time_diff( get_the_time('U'), current_time('timestamp') ) . ' ago'; ?> </div>
						</div>
						</div>			
					<?php endwhile; ?>
					<?php wp_reset_postdata(); ?>
							

					<?php endif; ?>
		</div>


		<?}?>
		</div>
		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>