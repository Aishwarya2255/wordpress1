<?php
/**
 * The template for displaying posts in the Gallery post format
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

		<?php if ( has_post_thumbnail() && ! post_password_required() && ! is_attachment() ) : ?>
		<div class="entry-thumbnail">
		 <style>
  .carousel-inner > .item > img,
  .carousel-inner > .item > a > img {
      /*width: 70%;*/
     /* margin: auto;*/
     height: 400px !important;
  }
  </style>


	<div id="myCarousel" class="carousel slide" data-ride="carousel">
	 <?php 
			// get the post object
			$post = get_post( get_the_ID() );
			// we need just the content
			$content = $post->post_content;
			// we need a expression to match things
			$regex = '/src="([^"]*)"/';
			// we want all matches
			preg_match_all( $regex, $content, $matches );
			// reversing the matches array
			$matches = array_reverse($matches);
			$ct = count($matches[0]);
			echo '<ol class="carousel-indicators">';
		//foreach ($matches[0] as $value) {
			for ($i=0; $i < $ct+1; $i++) { 
				echo '<li data-target="#myCarousel" data-slide-to="'.$i.'" class="active"></li>';
			}
		//}

		echo '</ol>';
		?>
    <!-- Indicators -->

  <!--   <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
      <li data-target="#myCarousel" data-slide-to="3"></li>
    </ol>
     -->

    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">

    		<?php
			
			if(!empty($matches[0])){
			// we've reversed the array, so index 0 returns the result
			/*echo "<pre>";
			print_r($matches);
			echo "</pre>";*/
			$cnt = 1;
			foreach ($matches[0] as $yaya) {
				if($cnt==1){?>
				 <div class="item active">
			        <img src="<?php the_post_thumbnail_url('full'); ?>">
			        
			      </div>
			       <div class="item">
			        <img src="<?php echo $yaya; ?>">
			        
			      </div>	
				<? $cnt++; }else{?>
				 <div class="item">
			        <img src="<?php echo $yaya; ?>">
			        
			      </div>		
				<?}
			}
			?>
		    </div>
		    <!-- Left and right controls -->
		    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
		      <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
		      <span class="sr-only">Previous</span>
		    </a>
		    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
		      <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
		      <span class="sr-only">Next</span>
		    </a>
		  </div>

			<? }else { the_post_thumbnail(); }?>
		</div>
		<?php endif; ?>

		<div class="sharing">

		<?php echo do_shortcode('[addtoany]'); ?>
	<div class="Views">		<?php if(function_exists('the_views')) { the_views(); } ?> </div>
		 <button id="cpyB" class="btBilal"><?php echo wpbitly_shortlink(); ?></button>
		  <span class="cp" style="display:none;   float: right;
  padding-right: 10px;
  padding-top: 6px;
">copied!</span>
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
			/*the_content( sprintf(
				__( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'twentythirteen' ),
				the_title( '<span class="screen-reader-text">', '</span>', false )
			) );
		*/
		$content = get_the_content();
		$content = preg_replace("/<img[^>]+\>/i", " ", $content);          
		$content = apply_filters('the_content', $content);
		$content = str_replace(']]>', ']]>', $content);
		echo $content;


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
