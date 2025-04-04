<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

<div class="breadcames">
<?php if(function_exists('bcn_display'))
		    {
		        bcn_display();
		    }?>
</div>

	<header class="entry-header">
		 
		<?php if ( is_single() ) : ?>
		<h1 class="entry-title"><?php the_title(); ?></h1>
		<?php else : ?>
		<h1 class="entry-title">
			<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
		</h1>
		<?php endif; // is_single() ?>
		<div class="single-author-block"> 
		<?php $thisauthorID=$post->post_author; 
		$srcId = get_the_author_meta('author_pic',  $thisauthorID); 
		$authorImg = wp_get_attachment_image_src($srcId);?>
		<img src="<?php echo $authorImg[0];?>">
		<!-- by <a href="<?php the_author_meta('user_url'); ?>"><?php the_author_meta('first_name')?> <? the_author_meta('last_name'); ?></a> -->
		by 
		<?php 
		the_author_posts_link();
		echo "-".human_time_diff( get_the_time("U"), current_time("timestamp") ) . " ago"; ?> 

<div class="tags">  
	<?php

	$t = get_the_terms( get_the_ID(), 'tags');
	if(!empty($t)){
	foreach ($t as $value) {
		echo "<a href='".site_url()."/tags/".$value->name."'>".$value->name."</a>";
	}
	}
	?>
	</div>

		</div>

	
	
    

    		<?php

	if( ss_framework_get_custom_field( 'ss_video_mp4', $post->ID ) || ss_framework_get_custom_field( 'ss_video_webm', $post->ID ) || ss_framework_get_custom_field( 'ss_video_ogg', $post->ID ) ) {

		$shortcode = '[video';

			if( ss_framework_get_custom_field( 'ss_video_mp4', $post->ID ) )
				$shortcode .= ' mp4="' . ss_framework_get_custom_field( 'ss_video_mp4', $post->ID ) . '"';

			if( ss_framework_get_custom_field( 'ss_video_webm', $post->ID ) )
				$shortcode .= ' webm="' . ss_framework_get_custom_field( 'ss_video_webm', $post->ID ) . '"';

			if( ss_framework_get_custom_field( 'ss_video_ogg', $post->ID ) )
				$shortcode .= ' ogg="' . ss_framework_get_custom_field( 'ss_video_ogg', $post->ID ) . '"';

			if( ss_framework_get_custom_field( 'ss_video_preview', $post->ID ) )
				$shortcode .= ' poster="' . ss_framework_get_custom_field( 'ss_video_preview', $post->ID ) . '"';

			if( ss_framework_get_custom_field( 'ss_video_aspect_ratio', $post->ID ) )
				$shortcode .= ' aspect_ratio="' . ss_framework_get_custom_field( 'ss_video_aspect_ratio', $post->ID ) . '"';

		$shortcode .= ']';

		echo do_shortcode( $shortcode );

	} elseif( ss_framework_get_custom_field( 'ss_video_external', $post->ID ) ) {

		echo do_shortcode( ss_framework_get_custom_field( 'ss_video_external', $post->ID ) );

	}

	?>
	
		
		
<div class="sharing"> <?php echo do_shortcode('[addtoany]'); ?>
		<div class="Views">  <?php if(function_exists('the_views')) { the_views(); } ?> </div>
		 <button id="cpyB" class="btBilal"><?php echo wpbitly_shortlink(); ?></button>
	</div>
	<div class="entry-meta">
			<?php twentythirteen_entry_meta(); ?>
			<?php edit_post_link( __( 'Edit', 'twentythirteen' ), '<span class="edit-link">', '</span>' ); ?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<?php if ( is_search() ) : // Only display Excerpts for Search ?>
	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->
	<?php else : ?>
	<div class="entry-content">
		<?php
			/* translators: %s: Name of current post */
			the_content( sprintf(
				__( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'twentythirteen' ),
				the_title( '<span class="screen-reader-text">', '</span>', false )
			) );
		
		/*$content = get_the_content();
		$content = preg_replace("/<img[^>]+\>/i", " ", $content);          
		$content = apply_filters('the_content', $content);
		$content = str_replace(']]>', ']]>', $content);
		echo $content;*/


			wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'twentythirteen' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) );
		?>
	</div><!-- .entry-content -->
	<?php endif; ?>

	<footer class="entry-meta">
		

		<?php if ( is_single() && get_the_author_meta( 'description' ) /*&& is_multi_author()*/ ) : ?>
			<?php get_template_part( 'author-bio' ); ?>
		<?php endif; ?>

		<?php if ( comments_open() && ! is_single() ) : ?>
			<div class="comments-link">
				<?php comments_popup_link( '<span class="leave-reply">' . __( 'Leave a comment', 'twentythirteen' ) . '</span>', __( 'One comment so far', 'twentythirteen' ), __( 'View all % comments', 'twentythirteen' ) ); ?>
			</div><!-- .comments-link -->
		<?php endif; // comments_open() ?>
	</footer><!-- .entry-meta -->
</article><!-- #post -->
