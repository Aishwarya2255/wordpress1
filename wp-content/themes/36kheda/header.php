<?php
/**
 * The Header template for our theme
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */
?><!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) & !(IE 8)]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<script>
  (adsbygoogle = window.adsbygoogle || []).push({
    google_ad_client: "ca-pub-2568491613897625",
    enable_page_level_ads: true
  });
</script>
<script>
(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

ga('create', 'UA-91801044-2', 'auto');
ga('send', 'pageview');

</script>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width">
        <meta name="p:domain_verify" content="374d69e5b303758bde4f120a480378c1"/>
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js"></script>
	<![endif]-->
	<?php wp_head(); ?>
	<?php $options = get_option( 'bh_theme_options' ); ?>
    
    <link href="<?php echo get_stylesheet_directory_uri() ?>/css/font-awesome.css" rel="stylesheet">
    <link rel="preload" href="https://www.36kheda.com/wp-content/themes/36kheda/fonts/fontawesome-webfont.woff2?v=4.7.0" as="font" type="font/woff2" crossorigin>
	<link href="<?php echo site_url(); ?>/wp-content/themes/36kheda/css/custom.css" rel="stylesheet">
 	<link href="<?php echo get_stylesheet_directory_uri() ?>/css/bootstrap.css" rel="stylesheet">
  	
 	
<!--  	  	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script> -->

 	<style type="text/css">

/* Box styles */
.myBox {
border: none;
padding: 5px;
/*font: 24px/36px sans-serif;*/
width: 200px;
height: 200px;
overflow: scroll;
}

/* Scrollbar styles */
::-webkit-scrollbar {
width: 12px;
height: 12px;
}

::-webkit-scrollbar-track {
background: #f5f5f5;
border-radius: 10px;
}

::-webkit-scrollbar-thumb {
border-radius: 10px;
background: #ccc;  
}

::-webkit-scrollbar-thumb:hover {
background: #999;  
}


 		.custom-pagination span,
.custom-pagination a {
  display: inline-block;
  padding: 2px 10px;
}
.custom-pagination a {
  background-color: #ebebeb;
  color: #ff3c50;
}
.custom-pagination a:hover {
  background-color: #ff3c50;
  color: #fff;
}
.custom-pagination span.page-num {
  margin-right: 10px;
  padding: 0;
}
.custom-pagination span.dots {
  padding: 0;
  color: gainsboro;
}
.custom-pagination span.current {
  background-color: #ff3c50;
  color: #fff;
}

#loader{
	  position: fixed;
  top: 0px;
  left: 0px;
  background: #fff;
  height: 100%;
  width: 100%;
  z-index: 99999999999999999999999;
  text-align: center;
  line-height: 100vh;
}

#loader img{
	width: 30%;
}

 	</style>
</head>

<body <?php body_class(); ?>>

<!-- <div id="loader" style="display: none;">
	<img src="<?php echo site_url(); ?>/wp-content/uploads/2017/02/spinner.gif">
</div> -->
	<div id="page" class="hfeed site">
		<header id="masthead" class="site-header" role="banner">
		<div class="top-bar">
        	<a class="home-link" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
			<?php $logo =  $options['bh_logo'];?>	
			<img src="<?php echo $logo;?>" class="bh_logo">
			</a>
			<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu', 'menu_id' => 'primary-menu' ) ); ?>
			<?php wp_nav_menu( array( 'theme_location' => 'primary-2', 'menu_class' => 'nav-menu', 'menu_id' => 'primary-menu-2' ) ); ?>
	<?php //if(is_page('home')){?>
        <div class="main-menu">
       <!--  <span> अपना शहर चुनें: </span> -->
        <ul>
        	<?php
			$tax = get_categories('taxonomy=city&type=news'); 
			foreach ($tax as $value) {
				//echo "<li><a href='".site_url()."/".$value->taxonomy."/".$value->slug."'>".$value->name."</a></li>";
			}
		 /*foreach ($tax as $value) {
		    if($value->slug != ''){
		      $post_names[] =  $value->slug;
		    }
		  }
		  $post_names = implode('","', $post_names);*/

  ?> 
</ul>
<!-- <form action="/search" method="GET" class="srch_form">

	<input id="textFeild" placeholder="अपना शहर खोजें" type="text" name="qry" class="srch_text" required>
	<input type="submit" value=" " class="glyphicon glyphicon-search"> 
</form> -->

<form action="/" method="get">
	 <span> अपना शहर चुनें: </span>
   <!--  <input type="hidden" value="post" name="post_type" id="post_type" /> -->
    <input id="textFeild" type="text" name="s" id="search" value="<?php the_search_query(); ?>" />
    <input type="submit" alt="Search" value=" " class="glyphicon glyphicon-search" src=""/>
</form>

<!-- <div ng-app="myApp" ng-controller="namesCtrl">
<p><input id="txtbilal" type="text" ng-model="test" placeholder="अपना शहर खोजें"></p>
<ul id="customData" style="display:none;">
  <li ng-repeat="x in names | filter:test">
    <a href="{{ x.link }}">{{ x.name }}</a>
  </li>
</ul>

</div> -->

</div>
<?php// }?>
        </div>
        			
			
				
		 
		</header><!-- #masthead -->

<?php/* if(is_front_page()){*/?>
<?php if(is_page('home')){?>
<div class="main-slide-part">
		<div class="col-md-12">
			
				<?php 
				$args = array(
					'post_type' => 'news',
					'posts_per_page' => '5',
					'order' => 'DESC',
					'meta_query' => array(
						array(
							'key' => 'featured_news',
							'value' => true
							),
						),
					);
				$i = 5;
				$the_query = new WP_Query( $args ); ?>
				<?php if ( $the_query->have_posts() ) : ?>
					<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
						
						<?php if($i<=1||$i<=4) {?>
						<div class="col-md-6 small-img">
						<?php the_post_thumbnail('large');?>
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
                   <?php } ?>
                    
		<div id="main" class="site-main">
		<?php /*if(is_front_page()){*/?>
		<?php if(is_page('home')){?>
		 
		<div class="col-md-12">
        <div class="row">
			<!-- <div class="col-sm-12">
			<h2>पंचायत</h2>
            
				<?php 
				$args = array(
					'post_type' => 'news',
					'posts_per_page' => '3',
					'order' => 'ASC',
					'tax_query' => array(
							array(
								'taxonomy' => 'topic',
								'field' => 'slug',
								'terms' => 'issues'
								),
						),
					);
				$the_query = new WP_Query( $args ); ?>
				<?php if ( $the_query->have_posts() ) : ?>
					<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
                    <div class="post-list">
					<div class="img-block">	<?php the_post_thumbnail('thumb');?> </div>
						<h4><a href="<?php echo get_the_permalink();?>"><?php the_title(); ?></a></h4>
					</div>
					<?php endwhile; ?>
					<?php wp_reset_postdata(); ?>
				<?php else : ?>
					<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
                    
				<?php endif; ?>
			</div> -->

				<h2>ताज़ा खबर</h2>
			<div class="blog-list">
		
				<?php 
				$args = array(
					'post_type' => 'news',
					'posts_per_page' => '8',
					'order' => 'DESC',
					'meta_query' => array(
						array(
							'key' => 'featured_news_9',
							'value' => true
							),
						),
					);
				$bilal = 1;
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
<?php //echo $bilal; $bilal++;?>
				<a href="<?php echo get_the_permalink();?>">	<?php the_post_thumbnail('thumb');?> </a>  </div> 
					<h4><a href="<?php echo get_the_permalink();?>"><?php the_title(); ?></a></h4>
					by <span><? echo the_author_posts_link(); ?></span>
					<div class="date"> <?php echo human_time_diff( get_the_time('U'), current_time('timestamp') ) . ' ago'; ?> </div>
                        
				</div>
                
                	<?php endwhile; ?>
				
                	<?php wp_reset_postdata(); ?>
                    
				<?php else : ?>
					<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
                   
				<?php endif; ?>
                
			</div>
            </div>


            <div class="row">
			

				<h2>लेटेस्ट सरकारी नोकरियां </h2>
			<div class="blog-list">
		
				<?php 
				$args = array(
					'post_type' => 'jobs',
					'posts_per_page' => '8',
					'order' => 'DESC',
					'post_status' => 'publish'
					);
				$bilal = 1;
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
	<?php //echo $bilal; $bilal++;?>
				<a href="<?php echo get_the_permalink();?>">	<?php the_post_thumbnail('thumb');?> </a>  </div> 
					<?php
					$thetitle = $post->post_title;
					$getlength = strlen($thetitle);
					$thelength = 75;
					$titleIs = mb_substr($thetitle, 0, $thelength, 'UTF-8');
					?>
					<h4><a href="<?php echo get_the_permalink();?>"><?php echo $titleIs; ?></a></h4>
					by <span><? echo the_author_posts_link(); ?></span>
					<div class="date"> <?php echo human_time_diff( get_the_time('U'), current_time('timestamp') ) . ' ago'; ?> </div>
                        
				</div>
                
                	<?php endwhile; ?>
				
                	<?php wp_reset_postdata(); ?>
                    
				<?php else : ?>
					<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
                   
				<?php endif; ?>
                
			</div>
            </div>
		</div>
		<!-- <div class="col-md-3 side-bar">	
			<?php //echo do_shortcode('[post_carousel_slider inst=1 min=1 max=1 order=asc]'); ?>
		</div> -->
		<?php } ?>
