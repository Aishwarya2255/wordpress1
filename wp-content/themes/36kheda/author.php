<?php
/**
 * The template for displaying Author archive pages
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
		
		<?php 
		$author = get_user_by( 'slug', get_query_var( 'author_name' ) );
		//echo $author->ID;
		$thisauthorID = $author->ID;
		$srcId = get_the_author_meta('cover_pic',  $thisauthorID); 
		$srcId_pro = get_the_author_meta('author_pic',  $thisauthorID); 
		$located = get_the_author_meta('located',  $thisauthorID); 
		$twitter = get_the_author_meta('twitter_bio',  $thisauthorID); 
		$mail = get_the_author_meta('mail_bio',  $thisauthorID); 
		$authorImg = wp_get_attachment_image_src($srcId, 'full');
		$authorImg_pro = wp_get_attachment_image_src($srcId_pro, 'full');
		$recent_author = get_user_by( 'ID', $thisauthorID );
		//print_r($recent_author);
		?>
		<div class="main_cover" style="background-image:url(<?php echo $authorImg[0];?>);">
		<div class="col-md-6">
		<img class="authorImg_pro" src="<?php echo $authorImg_pro[0];?>">
</div>
		<div class="author-detail col-md-6">
<span class="authore-name">  <?php echo $recent_author->display_name; ?> </span>
	<span class="located"> 		<?php echo $located; ?> </span>
<span class="des"> <?php echo the_author_meta('description', $thisauthorID );?> </span>

<?php if(!empty($twitter)){?><a class="author-btn twitter" href="<?php echo $twitter; ?>"> TWITTER </a><?php }?>
<?php if(!empty($mail)){?><a class="author-btn mail" href="mailto:<?php echo $mail; ?>"> MAIL  </a><?php }?>

		</div>
		</div>
		<?php //if ( have_posts() ) : ?>
	<div class="container">

		<div class="col-md-12">
 
		<h1>All stories by <?php echo $recent_author->display_name; ?></h1>
		<h1 class="thisIsHi" > <a class="active" id="nw_bh" href="javascript:void(0)">News</a> | <a id="jb_bh" href="javascript:void(0)">Jobs</a></h1>
		<h1><?php /*printf( __( 'All stories by %s', 'twentythirteen' ), '<span class="vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '" title="' . esc_attr( get_the_author() ) . '" rel="me">' . get_the_author() . '</a></span>' );*/ ?></h1>
		

		<div class="blog-list news_bh">

		<?php 
			$args = array(
					'post_type' => 'news',
					'posts_per_page' => '8',
					'order' => 'DESC',
					'author' => $thisauthorID
					);
				
		$the_query = new WP_Query( $args ); ?>
		<?php if ( $the_query->have_posts() ) : ?>
		<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
			<div class="post-list col-md-3">
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
		<button id="ajax-load" class="load-more">Load more...</button>
		<div id="auth_id" style="display:none;"><?php echo $thisauthorID; ?></div>
			<?php twentythirteen_paging_nav(); ?>

		<?php else : ?>
			<?php get_template_part( 'content', 'none' ); ?>
		<?php endif; ?>
		</div>


		<div class="blog-list jobs_bh" style="display:none;">

		<?php 
			$args = array(
					'post_type' => 'jobs',
					'posts_per_page' => '8',
					'order' => 'DESC',
					'author' => $thisauthorID
					);
				
		$the_query = new WP_Query( $args ); ?>
		<?php if ( $the_query->have_posts() ) : ?>
		<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
			<div class="post-list col-md-3">
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
		<button id="ajax-load_jobs" class="load-more">Load more...</button>
		<div id="auth_id_jobs" style="display:none;"><?php echo $thisauthorID; ?></div>
			<?php twentythirteen_paging_nav(); ?>

		<?php else : ?>
			<?php get_template_part( 'content', 'none' ); ?>
		<?php endif; ?>
		</div>
		</div>
		</div>
		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
