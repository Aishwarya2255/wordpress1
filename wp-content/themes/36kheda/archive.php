<?php
/**
 * The template for displaying Archive pages
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * If you'd like to further customize these archive views, you may create a
 * new template file for each specific one. For example, Twenty Thirteen
 * already has tag.php for Tag archives, category.php for Category archives,
 * and author.php for Author archives.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">
		
	<?php if(is_tax('topic')){?>
		
		<div class="main-slide-part">
		<div class="col-md-12">
			
				<?php 

				$term = get_term_by( 'slug', get_query_var('term'), get_query_var('taxonomy') );
				$tax_bilal =  $term->slug;
				$args = array(
					'post_type' => 'news',
					'posts_per_page' => '5',
					'order' => 'DESC',
					'tax_query' => array(
							array(
								'taxonomy' => 'topic',
								'field' => 'slug',
								'terms' => $tax_bilal
								),
						),
					);
				$i = 5;
				$the_query = new WP_Query( $args ); ?>
				<?php if ( $the_query->have_posts() ) : ?>
					<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
						
						<?php if($i<=1||$i<=4) {?>
						<div class="col-md-6 small-img">
						<?php the_post_thumbnail('medium');?>
						<h3>
						
						<a class="big_title" href="<?php echo get_the_permalink();?>"><?php the_title(); ?></a>
						<?$term_list = wp_get_post_terms($post->ID, 'city', array("fields" => "all"));
						$term_list_topic = wp_get_post_terms($post->ID, 'topic', array("fields" => "all"));
						echo '<div class="city_name"><a href="'.site_url().'/city/'.$term_list[0]->slug.'">'.$term_list[0]->name.'</a></div>';
						echo '<div class="topic_name"><a href="'.site_url().'/topic/'.$term_list_topic[0]->slug.'">'.$term_list_topic[0]->name.'</a></div>';?>
						<div class="author">by <span><? echo the_author_posts_link(); ?></span>
						<div class="date">	<?php echo human_time_diff( get_the_time('U'), current_time('timestamp') ) . ' ago'; ?> </div>
                        </div>
						</h3>	
						</div>
						<?php } else if($i==5){?> 
						<div class="col-md-6 large-img">
						<?php the_post_thumbnail('large');?>
						<h3>
						
						<a class="big_title" href="<?php echo get_the_permalink();?>"><?php the_title(); ?></a>
						<?$term_list = wp_get_post_terms($post->ID, 'city', array("fields" => "all"));
						$term_list_topic = wp_get_post_terms($post->ID, 'topic', array("fields" => "all"));
						echo '<div class="city_name"><a href="'.site_url().'/city/'.$term_list[0]->slug.'">'.$term_list[0]->name.'</a></div>';
						echo '<div class="topic_name"><a href="'.site_url().'/topic/'.$term_list_topic[0]->slug.'">'.$term_list_topic[0]->name.'</a></div>';?>
						<div class="author">by <span><? echo the_author_posts_link(); ?></span>
						<div class="date"> <?php echo human_time_diff( get_the_time('U'), current_time('timestamp') ) . ' ago'; ?> </div>

                        </div>
						</h3>	
						</div>
                        <div class="col-md-6">
						<?php }?>
					<?php $i--; endwhile; ?>
					<?php wp_reset_postdata(); ?>
				<?php else : ?>
					<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
				<?php endif; ?>
					</div>
                    <div class="clr"></div>
                    </div>
                    <div class="clr"> </div>
                    </div>

<div class="container"> 

		<div class="col-md-9">
        <div class="row">
			<h2><?php echo $term->name;?></h2>
			<div class="blog-list post-3">
		
				<?php 
				$args = array(
					'post_type' => 'news',
					'posts_per_page' => '6',
					'order' => 'DESC',
					'tax_query' => array(
							array(
								'taxonomy' => 'topic',
								'field' => 'slug',
								'terms' => $tax_bilal
								),
						),
					'offset' => 6
					);
				$the_query = new WP_Query( $args ); ?>
				<?php if ( $the_query->have_posts() ) : ?>
					<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
                    <div class="post-list">
					<div class="img-block"> 
						<div class="tagss">
						<?$term_list = wp_get_post_terms($post->ID, 'city', array("fields" => "all"));
						$term_list_topic = wp_get_post_terms($post->ID, 'topic', array("fields" => "all"));
						echo '<a href="'.site_url().'/city/'.$term_list[0]->slug.'">'.$term_list[0]->name.'</a>';
						echo '<a href="'.site_url().'/topic/'.$term_list_topic[0]->slug.'">'.$term_list_topic[0]->name.'</a>';?>
</div>
				<a href="<?php echo get_the_permalink();?>">	<?php the_post_thumbnail('thumb');?> </a>  </div> 
					<h4><a href="<?php echo get_the_permalink();?>"><?php the_title(); ?></a></h4>
					by <span><? echo the_author_posts_link(); ?></span>
					<div class="date"> <?php echo human_time_diff( get_the_time('U'), current_time('timestamp') ) . ' ago'; ?> </div>
                        
				</div>
                
                	<?php endwhile; ?>
				
                	<?php wp_reset_postdata(); ?>

           <button id="ajax-load-tax" class="load-more">Load more...</button> 
		<div id="tax_bilal" style="display:none;"><?php echo $tax_bilal; ?></div>
				<?php else : ?>
					<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
                   
				<?php endif; ?>
                
			</div>
            </div>
		</div>
		<div class="col-md-3 side-bar">	
			<?php echo do_shortcode('[post_carousel_slider inst=1 min=1 max=1 order=asc]'); ?>
		</div>

		<?php } elseif(is_tax('city')){ ?>



		<div class="main-slide-part">
		<div class="col-md-12">
			
				<?php 

				$term = get_term_by( 'slug', get_query_var('term'), get_query_var('taxonomy') );
				$tax_bilal =  $term->slug;
				
				?>
			
					</div>
                    <div class="clr"></div>
                    </div>
                    <div class="clr"> </div>
                    </div>

<div class="container"> 

		<div class="col-md-12">
        <div class="row">
			<h2><?php echo $term->name;?></h2>
			<div class="blog-list post-3">
		
				<?php 
				$args = array(
					'post_type' => 'news',
					'posts_per_page' => '6',
					'order' => 'DESC',
					'tax_query' => array(
							array(
								'taxonomy' => 'city',
								'field' => 'slug',
								'terms' => $tax_bilal
								),
						),
					//'offset' => 6
					);
				$the_query = new WP_Query( $args ); ?>
				<?php if ( $the_query->have_posts() ) : ?>
					<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
                    <div class="post-list">
					<div class="img-block"> 
						<div class="tagss">
						<?$term_list = wp_get_post_terms($post->ID, 'city', array("fields" => "all"));
						$term_list_topic = wp_get_post_terms($post->ID, 'topic', array("fields" => "all"));
						echo '<a href="'.site_url().'/city/'.$term_list[0]->slug.'">'.$term_list[0]->name.'</a>';
						echo '<a href="'.site_url().'/topic/'.$term_list_topic[0]->slug.'">'.$term_list_topic[0]->name.'</a>';?>
</div>
				<a href="<?php echo get_the_permalink();?>">	<?php the_post_thumbnail('thumb');?> </a>  </div> 
					<h4><a href="<?php echo get_the_permalink();?>"><?php the_title(); ?></a></h4>
					by <span><? echo the_author_posts_link(); ?></span>
					<div class="date"> <?php echo human_time_diff( get_the_time('U'), current_time('timestamp') ) . ' ago'; ?> </div>
                        
				</div>
                
                	<?php endwhile; ?>
				
                	<?php wp_reset_postdata(); ?>

           <button id="ajax-load-tax" class="load-more">Load more...</button> 
		<div id="tax_bilal" style="display:none;"><?php echo $tax_bilal; ?></div>
				<?php else : ?>
					<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
                   
				<?php endif; ?>
                
			</div>
            </div>
		</div>
		<!-- <div class="col-md-3 side-bar">	
			<?php echo do_shortcode('[post_carousel_slider inst=1 min=1 max=1 order=asc]'); ?>
		</div> -->











		<?php } else { ?>
		<div class="col-md-8">
			<?php if ( have_posts() ) : ?>
			<header class="archive-header">
				<h1 class="archive-title"><?php
					if ( is_day() ) :
						printf( __( 'Daily Archives: %s', 'twentythirteen' ), get_the_date() );
					elseif ( is_month() ) :
						printf( __( 'Monthly Archives: %s', 'twentythirteen' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'twentythirteen' ) ) );
					elseif ( is_year() ) :
						printf( __( 'Yearly Archives: %s', 'twentythirteen' ), get_the_date( _x( 'Y', 'yearly archives date format', 'twentythirteen' ) ) );
					else :
						_e( 'Archives', 'twentythirteen' );
					endif;
				?></h1>
			</header><!-- .archive-header -->

			<?php /* The loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'content', get_post_format() ); ?>
			<?php endwhile; ?>

			<?php twentythirteen_paging_nav(); ?>

		<?php else : ?>
			<?php get_template_part( 'content', 'none' ); ?>
		<?php endif; ?>
		</div>
		<div class="col-md-4">
		</div>

		<?}?>

		</div>
		
		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
