<?php
/**
 * The template for displaying Author bios
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */
?>

<div class="author-info">
	<div class="author-avatar">
		<?php
		/**
		 * Filter the author bio avatar size.
		 *
		 * @since Twenty Thirteen 1.0
		 *
		 * @param int $size The avatar height and width size in pixels.
		 */
		$author_bio_avatar_size = apply_filters( 'twentythirteen_author_bio_avatar_size', 74 );
		 //get_avatar( get_the_author_meta( 'user_email' ), $author_bio_avatar_size );
		$thisauthorID = get_the_author_ID();
		$srcId = get_the_author_meta('author_pic',  $thisauthorID); 
		$infoAuthor = get_the_author_meta('description',  $thisauthorID); 
		$authorImg = wp_get_attachment_image_src($srcId, 'thumb');?>
		<img src="<?php echo $authorImg[0];?>">
		
	</div><!-- .author-avatar -->
	<div class="author-description">
		<h2 class="author-title"><?php printf( __( 'About %s', 'twentythirteen' ), get_the_author() ); ?></h2>
		<p class="author-bio">
			<?php //the_author_meta( 'description' ); ?>
			<?php echo substr($infoAuthor, 0, 210); 

			?>
			<a class="author-link" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">
				<?php printf( __( 'View all posts by %s <span class="meta-nav">&rarr;</span>', 'twentythirteen' ), get_the_author() ); ?>
			</a>
		</p>
	</div><!-- .author-description -->
 		<?php $recent_author = get_user_by( 'ID', $thisauthorID );?>

		<h1>All stories by <?php echo $recent_author->display_name; ?></h1>
		<h1><?php /*printf( __( 'All stories by %s', 'twentythirteen' ), '<span class="vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '" title="' . esc_attr( get_the_author() ) . '" rel="me">' . get_the_author() . '</a></span>' );*/ ?></h1>
		

		<div class="blog-list">

		<?php 
			$args = array(
					'post_type' => 'jobs',
					'posts_per_page' => '3',
					'order' => 'DESC',
					'author' => $thisauthorID
					);
				
		$the_query = new WP_Query( $args ); ?>
		<?php if ( $the_query->have_posts() ) : ?>
		<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
			<div class="post-list">
		<div class="img-block">	

		<div class="tagss"> 	<?$term_list = wp_get_post_terms($post->ID, 'city', array("fields" => "all"));
						$term_list_topic = wp_get_post_terms($post->ID, 'topic', array("fields" => "all"));
						echo '<a href="'.site_url().'/city/'.$term_list[0]->slug.'">'.$term_list[0]->name.'</a>';
						echo '<a href="'.site_url().'/topic/'.$term_list_topic[0]->slug.'">'.$term_list_topic[0]->name.'</a>';?>
</div>

<a href="<?php echo the_permalink(); ?>"><? the_post_thumbnail('medium');?></a> </div>
			<h4><a href="<?php echo the_permalink(); ?>"><? echo the_title(); ?></a></h4>
			 <? echo the_excerpt(); ?>
			<span><? echo the_author_posts_link(); ?></span>
			<div class="date">	<?php echo human_time_diff( get_the_time('U'), current_time('timestamp') ) . ' ago'; ?> </div>
			</div>			
		<?php endwhile; ?>
		<?php wp_reset_postdata(); ?>
		<!-- <button id="ajax-load" class="load-more">Load more...</button> -->
		<div id="auth_id" style="display:none;"><?php echo $thisauthorID; ?></div>

		<?php endif; ?>
		</div>
		
		
</div><!-- .author-info -->