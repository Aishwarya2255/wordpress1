<?php
/**
 * Twenty Thirteen functions and definitions
 *
 * Sets up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme (see https://codex.wordpress.org/Theme_Development
 * and https://codex.wordpress.org/Child_Themes), you can override certain
 * functions (those wrapped in a function_exists() call) by defining them first
 * in your child theme's functions.php file. The child theme's functions.php
 * file is included before the parent theme's file, so the child theme
 * functions would be used.
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters, @link https://codex.wordpress.org/Plugin_API
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */

/*
 * Set up the content width value based on the theme's design.
 *
 * @see twentythirteen_content_width() for template-specific adjustments.
 */
if ( ! isset( $content_width ) )
	$content_width = 604;

/**
 * Add support for a custom header image.
 */
require get_template_directory() . '/inc/custom-header.php';
define( 'SS_BASE_DIR', get_template_directory() . '/' );
define( 'SS_BASE_URL', get_template_directory_uri() . '/' );



/**
 * Twenty Thirteen only works in WordPress 3.6 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '3.6-alpha', '<' ) )
	require get_template_directory() . '/inc/back-compat.php';

/**
 * Twenty Thirteen setup.
 *
 * Sets up theme defaults and registers the various WordPress features that
 * Twenty Thirteen supports.
 *
 * @uses load_theme_textdomain() For translation/localization support.
 * @uses add_editor_style() To add Visual Editor stylesheets.
 * @uses add_theme_support() To add support for automatic feed links, post
 * formats, and post thumbnails.
 * @uses register_nav_menu() To add support for a navigation menu.
 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
 *
 * @since Twenty Thirteen 1.0
 */
function twentythirteen_setup() {
	/*
	 * Makes Twenty Thirteen available for translation.
	 *
	 * Translations can be filed at WordPress.org. See: https://translate.wordpress.org/projects/wp-themes/twentythirteen
	 * If you're building a theme based on Twenty Thirteen, use a find and
	 * replace to change 'twentythirteen' to the name of your theme in all
	 * template files.
	 */
	load_theme_textdomain( 'twentythirteen' );

	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, icons, and column width.
	 */
	add_editor_style( array( 'css/editor-style.css', 'genericons/genericons.css', twentythirteen_fonts_url() ) );

	// Adds RSS feed links to <head> for posts and comments.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Switches default core markup for search form, comment form,
	 * and comments to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
	) );

	/*
	 * This theme supports all available post formats by default.
	 * See https://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'audio', 'chat', 'gallery', 'image', 'link', 'quote', 'status', 'video'
	) );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menu( 'primary', __( 'Topic', 'twentythirteen' ) );
	// nav by bilalhssn
	register_nav_menu( 'primary-2', __( 'City', 'twentythirteen' ) );

	/*
	 * This theme uses a custom image size for featured images, displayed on
	 * "standard" posts and pages.
	 */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 604, 270, true );

	// This theme uses its own gallery styles.
	add_filter( 'use_default_gallery_style', '__return_false' );

	// Indicate widget sidebars can use selective refresh in the Customizer.
	add_theme_support( 'customize-selective-refresh-widgets' );
}
add_action( 'after_setup_theme', 'twentythirteen_setup' );


/**
 * Return the Google font stylesheet URL, if available.
 *
 * The use of Source Sans Pro and Bitter by default is localized. For languages
 * that use characters not supported by the font, the font can be disabled.
 *
 * @since Twenty Thirteen 1.0
 *
 * @return string Font stylesheet or empty string if disabled.
 */
function twentythirteen_fonts_url() {
	$fonts_url = '';

	/* Translators: If there are characters in your language that are not
	 * supported by Source Sans Pro, translate this to 'off'. Do not translate
	 * into your own language.
	 */
	$source_sans_pro = _x( 'on', 'Source Sans Pro font: on or off', 'twentythirteen' );

	/* Translators: If there are characters in your language that are not
	 * supported by Bitter, translate this to 'off'. Do not translate into your
	 * own language.
	 */
	$bitter = _x( 'on', 'Bitter font: on or off', 'twentythirteen' );

	if ( 'off' !== $source_sans_pro || 'off' !== $bitter ) {
		$font_families = array();

		if ( 'off' !== $source_sans_pro )
			$font_families[] = 'Source Sans Pro:300,400,700,300italic,400italic,700italic';

		if ( 'off' !== $bitter )
			$font_families[] = 'Bitter:400,700';

		$query_args = array(
			'family' => urlencode( implode( '|', $font_families ) ),
			'subset' => urlencode( 'latin,latin-ext' ),
		);
		$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
	}

	return $fonts_url;
}


// Add theme options
include( SS_BASE_DIR . 'functions/admin.php' );

// Add meta boxes
include( SS_BASE_DIR . 'functions/meta-box/class.php' );
include( SS_BASE_DIR . 'functions/meta-boxes.php' );

// Add widgets
include( SS_BASE_DIR . 'functions/widgets.php' );

// Add shortcodes
include( SS_BASE_DIR . 'functions/shortcodes.php' );

// Add custom functions
include( SS_BASE_DIR . 'functions/custom-functions.php' );

// Add custom post types
//include( SS_BASE_DIR . 'functions/custom-post-types.php' );

// Automatic plugin activation
include( SS_BASE_DIR . 'functions/plugin-activation.php' );

// Theme updates notifier
include( SS_BASE_DIR . 'functions/update-notifier.php' );

/**
 * Enqueue scripts and styles for the front end.
 *
 * @since Twenty Thirteen 1.0
 */
function twentythirteen_scripts_styles() {
	/*
	 * Adds JavaScript to pages with the comment form to support
	 * sites with threaded comments (when in use).
	 */
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	// Adds Masonry to handle vertical alignment of footer widgets.
	if ( is_active_sidebar( 'sidebar-1' ) )
		wp_enqueue_script( 'jquery-masonry' );

	// Loads JavaScript file with functionality specific to Twenty Thirteen.
	wp_enqueue_script( 'twentythirteen-script', get_template_directory_uri() . '/js/functions.js', array( 'jquery' ), '20160717', true );
	wp_enqueue_script( 'bilalhssn', get_template_directory_uri() . '/js/bilalhssn.js', array( 'jquery' ), '20160717', true );

	global $wp_query;
	wp_localize_script( 'bilalhssn', 'ajaxpagination', array(
		'ajaxurl' => admin_url( 'admin-ajax.php' ),
		'query_vars' => json_encode( $wp_query->query )
	));

	// Add Source Sans Pro and Bitter fonts, used in the main stylesheet.
	wp_enqueue_style( 'twentythirteen-fonts', twentythirteen_fonts_url(), array(), null );

	// Add Genericons font, used in the main stylesheet.
	wp_enqueue_style( 'genericons', get_template_directory_uri() . '/genericons/genericons.css', array(), '3.03' );

	// Loads our main stylesheet.
	wp_enqueue_style( 'twentythirteen-style', get_stylesheet_uri(), array(), '2013-07-18' );

	// Loads the Internet Explorer specific stylesheet.
	wp_enqueue_style( 'twentythirteen-ie', get_template_directory_uri() . '/css/ie.css', array( 'twentythirteen-style' ), '2013-07-18' );
	wp_style_add_data( 'twentythirteen-ie', 'conditional', 'lt IE 9' );


}
add_action( 'wp_enqueue_scripts', 'twentythirteen_scripts_styles' );

add_action('wp_ajax_nopriv_filter_jobs', 'job_filter');
add_action('wp_ajax_filter_jobs', 'job_filter');

function job_filter(){
	
	$tax_query = array('relation' => 'AND');

	if(isset($_POST['type_data'])&&$_POST['type_data']!=""){
			$tax_query[]=array(
				'taxonomy' => 'types',
				'field' => 'name',
				'terms' => $_POST['type_data']
				);
	}

	if(isset($_POST['loca_data'])&&$_POST['loca_data']!=""){
			$tax_query[]=array(
				'taxonomy' => 'qualifications',
				'field' => 'name',
				'terms' => $_POST['loca_data']
				);
	}
	
	if(isset($_POST['cat_data'])&&$_POST['cat_data']!=""){
			$tax_query[]=array(
				'taxonomy' => 'job-cat',
				'field' => 'name',
				'terms' => $_POST['cat_data']
				);
	}
	
	/*echo "<pre>";
	print_r($tax_query);
	echo "</pre>";*/
	
	$paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;

	$args= array(
					'post_type' => 'jobs',
					'posts_per_page' => '-1',
					'order' => 'DESC',
					'post_status' => 'publish',
					'paged' => $paged,
					'tax_query' => $tax_query
		);
	$posts = new WP_Query( $args );
    $GLOBALS['wp_query'] = $posts;

     if( ! $posts->have_posts() ) { 
        //get_template_part( 'content', 'none' );
        //echo "bilalhssn3";
        ?>
        <style type="text/css">
        #ajax-load{
        	display: none;
        }
        </style>
        <?

    }
    else {
    	if($count < 4){
    		?>
        <style type="text/css">
        #ajax-load{
        	display: none;
        }
        </style>
        <?
    	}
        while ( $posts->have_posts() ) { 
            $posts->the_post();?>
            <!-- get_template_part( 'content', get_post_format() ); -->
             <div class="col-md-12" >
	                    <? $hasThumb = has_post_thumbnail();
	                    if($hasThumb){
	                     ?>
						 <div class="col-md-4">
						<? the_post_thumbnail(); ?>
					</div>	 
					<div class="col-md-8">	
					<? } ?>
						<h4><a href="<?php echo get_the_permalink();?>"><?php the_title(); ?></a></h4>
						by <span><? echo the_author_posts_link(); ?></span>
						<div class="date"> <?php echo human_time_diff( get_the_time('U'), current_time('timestamp') ) . ' ago'; ?> </div>
	                   <? if($hasThumb){
	                     ?>
	                            </div> 
	                            <? }?>
					</div>
					<div class="clearfix"></div>
					<br/>
					<br/>
	<?php
     /* if (function_exists(custom_pagination)) {
        custom_pagination($the_query->max_num_pages,"",$paged);
      }*/
      
		} }
	}

add_action( 'wp_ajax_nopriv_bilalhssn_ac', 'my_yayaya_ajax' );
add_action( 'wp_ajax_bilalhssn_ac', 'my_yayaya_ajax' );

function my_yayaya_ajax() {
    
    //print_r($_POST);	
    $query_vars = json_decode( stripslashes( $_POST['query_vars'] ), true );

	//$query_vars['paged'] = $_POST['page'];
	$ct = $_POST['ct'];
	$yayaya_id = $_POST['yayaya_id'];

	$args = array(
					'post_type' => 'news',
					'posts_per_page' => '4',
					'order' => 'DESC',
					'author' => $yayaya_id,
					'offset' => $ct
					);


    $posts = new WP_Query( $args );
    $GLOBALS['wp_query'] = $posts;

    add_filter( 'editor_max_image_size', 'my_image_size_override' );
    $count = $posts->post_count;
    if( ! $posts->have_posts()) { 
        //get_template_part( 'content', 'none' );

        //echo "bilalhssn3";
        ?>
        <style type="text/css">
        #ajax-load{
        	display: none;
        }
        </style>
        <?php

    }
    else {
    	if($count < 4){
    		?>
        <style type="text/css">
        #ajax-load{
        	display: none;
        }
        </style>
        <?
    	}

        while ( $posts->have_posts() ) { 
            $posts->the_post();?>
            <!-- get_template_part( 'content', get_post_format() ); -->
            <div class="post-list col-md-3">
		<div class="img-block">	

		<div class="tagss"> <?$term_list = wp_get_post_terms($post->ID, 'city', array("fields" => "all"));
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
        <?php }
    }
    remove_filter( 'editor_max_image_size', 'my_image_size_override' );

    /*the_posts_pagination( array(
        'prev_text'          => __( 'Previous page', 'twentyfifteen' ),
        'next_text'          => __( 'Next page', 'twentyfifteen' ),
        'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'twentyfifteen' ) . ' </span>',
    ) );*/

    die();
}

add_action( 'wp_ajax_nopriv_bilalhssn_ac_jobs', 'my_yayaya_ajax_jobs' );
add_action( 'wp_ajax_bilalhssn_ac_jobs', 'my_yayaya_ajax_jobs' );

function my_yayaya_ajax_jobs() {
    
    //print_r($_POST);	
    $query_vars = json_decode( stripslashes( $_POST['query_vars'] ), true );

	//$query_vars['paged'] = $_POST['page'];
	$ct = $_POST['ct'];
	$yayaya_id = $_POST['yayaya_id'];

	$args = array(
					'post_type' => 'jobs',
					'posts_per_page' => '4',
					'order' => 'DESC',
					'author' => $yayaya_id,
					'offset' => $ct
					);


    $posts = new WP_Query( $args );
    $GLOBALS['wp_query'] = $posts;

    add_filter( 'editor_max_image_size', 'my_image_size_override' );

    if( ! $posts->have_posts() ) { 
        //get_template_part( 'content', 'none' );
        echo 'bilalhssn';
         ?>
        <style type="text/css">
        #ajax-load{
        	display: none;
        }
        </style>
        <?
    }
    else {
        while ( $posts->have_posts() ) { 
            $posts->the_post();?>
            <!-- get_template_part( 'content', get_post_format() ); -->
            <div class="post-list col-md-3">
		<div class="img-block">	

		<div class="tagss"> <?$term_list = wp_get_post_terms($post->ID, 'city', array("fields" => "all"));
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
        <?php }
    }
    remove_filter( 'editor_max_image_size', 'my_image_size_override' );

    /*the_posts_pagination( array(
        'prev_text'          => __( 'Previous page', 'twentyfifteen' ),
        'next_text'          => __( 'Next page', 'twentyfifteen' ),
        'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'twentyfifteen' ) . ' </span>',
    ) );*/

    die();
}

function my_image_size_override() {
    return array( 825, 510 );
}

add_action( 'wp_ajax_nopriv_bilal_ac', 'my_yaya_ajax' );
add_action( 'wp_ajax_bilal_ac', 'my_yaya_ajax' );

function my_yaya_ajax() {

		$query_vars = json_decode( stripslashes( $_POST['query_vars'] ), true );

	//$query_vars['paged'] = $_POST['page'];
	$ct = $_POST['ct'];
	$tax_bilal = $_POST['yayaya_id'];

	$args = array(
					'post_type' => 'news',
					'posts_per_page' => '3',
					'order' => 'DESC',
					'tax_query' => array(
							array(
								'taxonomy' => 'topic',
								'field' => 'slug',
								'terms' => $tax_bilal
								),
						),
					'offset' => $ct
					);


    $posts = new WP_Query( $args );
    $GLOBALS['wp_query'] = $posts;

    add_filter( 'editor_max_image_size', 'my_image_size_override' );

    if( ! $posts->have_posts() ) { 
        //get_template_part( 'content', 'none' );
        //echo "bilalhssn3";
        ?>
        <style type="text/css">
        #ajax-load{
        	display: none;
        }
        </style>
        <?

    }
    else {
    	if($count < 4){
    		?>
        <style type="text/css">
        #ajax-load{
        	display: none;
        }
        </style>
        <?
    	}
        while ( $posts->have_posts() ) { 
            $posts->the_post();?>
            <!-- get_template_part( 'content', get_post_format() ); -->
             <div class="post-list col-md-3">
					<div class="img-block "> 
<div class="tagss"> 	<?$term_list = wp_get_post_terms($post->ID, 'city', array("fields" => "all"));
						$term_list_topic = wp_get_post_terms($post->ID, 'topic', array("fields" => "all"));
						echo '<a href="'.site_url().'/city/'.$term_list[0]->slug.'">'.$term_list[0]->name.'</a>';
						echo '<a href="'.site_url().'/topic/'.$term_list_topic[0]->slug.'">'.$term_list_topic[0]->name.'</a>';?>
</div>
				<a href="<?php echo get_the_permalink();?>">	<?php the_post_thumbnail('thumb');?> </a>  </div> 
					<h4><a href="<?php echo get_the_permalink();?>"><?php the_title(); ?></a></h4>
					by <span><? echo the_author_posts_link(); ?></span>
					<div class="date"> <?php echo human_time_diff( get_the_time('U'), current_time('timestamp') ) . ' ago'; ?> </div>
                        
				</div>
        <?php }
    }
    remove_filter( 'editor_max_image_size', 'my_image_size_override' );

    /*the_posts_pagination( array(
        'prev_text'          => __( 'Previous page', 'twentyfifteen' ),
        'next_text'          => __( 'Next page', 'twentyfifteen' ),
        'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'twentyfifteen' ) . ' </span>',
    ) );*/

    die();

	}

/**
 * Add preconnect for Google Fonts.
 *
 * @since Twenty Thirteen 2.1
 *
 * @param array   $urls          URLs to print for resource hints.
 * @param string  $relation_type The relation type the URLs are printed.
 * @return array URLs to print for resource hints.
 */
function twentythirteen_resource_hints( $urls, $relation_type ) {
	if ( wp_style_is( 'twentythirteen-fonts', 'queue' ) && 'preconnect' === $relation_type ) {
		if ( version_compare( $GLOBALS['wp_version'], '4.7-alpha', '>=' ) ) {
			$urls[] = array(
				'href' => 'https://fonts.gstatic.com',
				'crossorigin',
			);
		} else {
			$urls[] = 'https://fonts.gstatic.com';
		}
	}

	return $urls;
}
add_filter( 'wp_resource_hints', 'twentythirteen_resource_hints', 10, 2 );

/**
 * Filter the page title.
 *
 * Creates a nicely formatted and more specific title element text for output
 * in head of document, based on current view.
 *
 * @since Twenty Thirteen 1.0
 *
 * @param string $title Default title text for current view.
 * @param string $sep   Optional separator.
 * @return string The filtered title.
 */
function twentythirteen_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() )
		return $title;

	// Add the site name.
	$title .= get_bloginfo( 'name', 'display' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title = "$title $sep $site_description";

	// Add a page number if necessary.
	if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() )
		$title = "$title $sep " . sprintf( __( 'Page %s', 'twentythirteen' ), max( $paged, $page ) );

	return $title;
}
add_filter( 'wp_title', 'twentythirteen_wp_title', 10, 2 );

/**
 * Register two widget areas.
 *
 * @since Twenty Thirteen 1.0
 */
function twentythirteen_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Main Widget Area', 'twentythirteen' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Appears in the footer section of the site.', 'twentythirteen' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Secondary Widget Area', 'twentythirteen' ),
		'id'            => 'sidebar-2',
		'description'   => __( 'Appears on posts and pages in the sidebar.', 'twentythirteen' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer Widget Area', 'twentythirteen' ),
		'id'            => 'footer-0',
		'description'   => __( 'Appears on posts and pages in the sidebar.', 'twentythirteen' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Copyright Area', 'twentythirteen' ),
		'id'            => 'copy-right',
		'description'   => __( 'Appears on posts and pages in the sidebar.', 'twentythirteen' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'twentythirteen_widgets_init' );

if ( ! function_exists( 'twentythirteen_paging_nav' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable.
 *
 * @since Twenty Thirteen 1.0
 */
function twentythirteen_paging_nav() {
	global $wp_query;

	// Don't print empty markup if there's only one page.
	if ( $wp_query->max_num_pages < 2 )
		return;
	?>
	<nav class="navigation paging-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Posts navigation', 'twentythirteen' ); ?></h1>
		<div class="nav-links">

			<?php if ( get_next_posts_link() ) : ?>
			<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'twentythirteen' ) ); ?></div>
			<?php endif; ?>

			<?php if ( get_previous_posts_link() ) : ?>
			<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'twentythirteen' ) ); ?></div>
			<?php endif; ?>

		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'twentythirteen_post_nav' ) ) :
/**
 * Display navigation to next/previous post when applicable.
 *
 * @since Twenty Thirteen 1.0
 */
function twentythirteen_post_nav() {
	global $post;

	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( $post->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous )
		return;
	?>
	<nav class="navigation post-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Post navigation', 'twentythirteen' ); ?></h1>
		<div class="nav-links">

			<?php previous_post_link( '%link', _x( '<span class="meta-nav">&larr;</span> %title', 'Previous post link', 'twentythirteen' ) ); ?>
			<?php next_post_link( '%link', _x( '%title <span class="meta-nav">&rarr;</span>', 'Next post link', 'twentythirteen' ) ); ?>

		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'twentythirteen_entry_meta' ) ) :
/**
 * Print HTML with meta information for current post: categories, tags, permalink, author, and date.
 *
 * Create your own twentythirteen_entry_meta() to override in a child theme.
 *
 * @since Twenty Thirteen 1.0
 */
function twentythirteen_entry_meta() {
	if ( is_sticky() && is_home() && ! is_paged() )
		echo '<span class="featured-post">' . esc_html__( 'Sticky', 'twentythirteen' ) . '</span>';

	if ( ! has_post_format( 'link' ) && 'post' == get_post_type() )
		twentythirteen_entry_date();

	// Translators: used between list items, there is a space after the comma.
	$categories_list = get_the_category_list( __( ', ', 'twentythirteen' ) );
	if ( $categories_list ) {
		echo '<span class="categories-links">' . $categories_list . '</span>';
	}

	// Translators: used between list items, there is a space after the comma.
	$tag_list = get_the_tag_list( '', __( ', ', 'twentythirteen' ) );
	if ( $tag_list ) {
		echo '<span class="tags-links">' . $tag_list . '</span>';
	}

	// Post author
	if ( 'post' == get_post_type() ) {
		printf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span>',
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			esc_attr( sprintf( __( 'View all posts by %s', 'twentythirteen' ), get_the_author() ) ),
			get_the_author()
		);
	}
}
endif;

if ( ! function_exists( 'twentythirteen_entry_date' ) ) :
/**
 * Print HTML with date information for current post.
 *
 * Create your own twentythirteen_entry_date() to override in a child theme.
 *
 * @since Twenty Thirteen 1.0
 *
 * @param boolean $echo (optional) Whether to echo the date. Default true.
 * @return string The HTML-formatted post date.
 */
function twentythirteen_entry_date( $echo = true ) {
	if ( has_post_format( array( 'chat', 'status' ) ) )
		$format_prefix = _x( '%1$s on %2$s', '1: post format name. 2: date', 'twentythirteen' );
	else
		$format_prefix = '%2$s';

	$date = sprintf( '<span class="date"><a href="%1$s" title="%2$s" rel="newsmark"><time class="entry-date" datetime="%3$s">%4$s</time></a></span>',
		esc_url( get_permalink() ),
		esc_attr( sprintf( __( 'Permalink to %s', 'twentythirteen' ), the_title_attribute( 'echo=0' ) ) ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( sprintf( $format_prefix, get_post_format_string( get_post_format() ), get_the_date() ) )
	);

	if ( $echo )
		echo $date;

	return $date;
}
endif;

if ( ! function_exists( 'twentythirteen_the_attached_image' ) ) :
/**
 * Print the attached image with a link to the next attached image.
 *
 * @since Twenty Thirteen 1.0
 */
function twentythirteen_the_attached_image() {
	/**
	 * Filter the image attachment size to use.
	 *
	 * @since Twenty thirteen 1.0
	 *
	 * @param array $size {
	 *     @type int The attachment height in pixels.
	 *     @type int The attachment width in pixels.
	 * }
	 */
	$attachment_size     = apply_filters( 'twentythirteen_attachment_size', array( 724, 724 ) );
	$next_attachment_url = wp_get_attachment_url();
	$post                = get_post();

	/*
	 * Grab the IDs of all the image attachments in a gallery so we can get the URL
	 * of the next adjacent image in a gallery, or the first image (if we're
	 * looking at the last image in a gallery), or, in a gallery of one, just the
	 * link to that image file.
	 */
	$attachment_ids = get_posts( array(
		'post_parent'    => $post->post_parent,
		'fields'         => 'ids',
		'numberposts'    => -1,
		'post_status'    => 'inherit',
		'post_type'      => 'attachment',
		'post_mime_type' => 'image',
		'order'          => 'ASC',
		'orderby'        => 'menu_order ID',
	) );

	// If there is more than 1 attachment in a gallery...
	if ( count( $attachment_ids ) > 1 ) {
		foreach ( $attachment_ids as $idx => $attachment_id ) {
			if ( $attachment_id == $post->ID ) {
				$next_id = $attachment_ids[ ( $idx + 1 ) % count( $attachment_ids ) ];
				break;
			}
		}

		// get the URL of the next image attachment...
		if ( $next_id )
			$next_attachment_url = get_attachment_link( $next_id );

		// or get the URL of the first image attachment.
		else
			$next_attachment_url = get_attachment_link( reset( $attachment_ids ) );
	}

	printf( '<a href="%1$s" title="%2$s" rel="attachment">%3$s</a>',
		esc_url( $next_attachment_url ),
		the_title_attribute( array( 'echo' => false ) ),
		wp_get_attachment_image( $post->ID, $attachment_size )
	);
}
endif;

/**
 * Return the post URL.
 *
 * @uses get_url_in_content() to get the URL in the post meta (if it exists) or
 * the first link found in the post content.
 *
 * Falls back to the post permalink if no URL is found in the post.
 *
 * @since Twenty Thirteen 1.0
 *
 * @return string The Link format URL.
 */
function twentythirteen_get_link_url() {
	$content = get_the_content();
	$has_url = get_url_in_content( $content );

	return ( $has_url ) ? $has_url : apply_filters( 'the_permalink', get_permalink() );
}

if ( ! function_exists( 'twentythirteen_excerpt_more' ) && ! is_admin() ) :
/**
 * Replaces "[...]" (appended to automatically generated excerpts) with ...
 * and a Continue reading link.
 *
 * @since Twenty Thirteen 1.4
 *
 * @param string $more Default Read More excerpt link.
 * @return string Filtered Read More excerpt link.
 */
function twentythirteen_excerpt_more( $more ) {
	$link = sprintf( '<a href="%1$s" class="more-link">%2$s</a>',
		esc_url( get_permalink( get_the_ID() ) ),
			/* translators: %s: Name of current post */
			sprintf( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'twentythirteen' ), '<span class="screen-reader-text">' . get_the_title( get_the_ID() ) . '</span>' )
		);
	return ' &hellip; ' . $link;
}
add_filter( 'excerpt_more', 'twentythirteen_excerpt_more' );
endif;

/**
 * Extend the default WordPress body classes.
 *
 * Adds body classes to denote:
 * 1. Single or multiple authors.
 * 2. Active widgets in the sidebar to change the layout and spacing.
 * 3. When avatars are disabled in discussion settings.
 *
 * @since Twenty Thirteen 1.0
 *
 * @param array $classes A list of existing body class values.
 * @return array The filtered body class list.
 */
function twentythirteen_body_class( $classes ) {
	if ( ! is_multi_author() )
		$classes[] = 'single-author';

	if ( is_active_sidebar( 'sidebar-2' ) && ! is_attachment() && ! is_404() )
		$classes[] = 'sidebar';

	if ( ! get_option( 'show_avatars' ) )
		$classes[] = 'no-avatars';

	return $classes;
}
add_filter( 'body_class', 'twentythirteen_body_class' );

/**
 * Adjust content_width value for video post formats and attachment templates.
 *
 * @since Twenty Thirteen 1.0
 */
function twentythirteen_content_width() {
	global $content_width;

	if ( is_attachment() )
		$content_width = 724;
	elseif ( has_post_format( 'audio' ) )
		$content_width = 484;
}
add_action( 'template_redirect', 'twentythirteen_content_width' );

/**
 * Add postMessage support for site title and description for the Customizer.
 *
 * @since Twenty Thirteen 1.0
 *
 * @param WP_Customize_Manager $wp_customize Customizer object.
 */
function twentythirteen_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector' => '.site-title',
			'container_inclusive' => false,
			'render_callback' => 'twentythirteen_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector' => '.site-description',
			'container_inclusive' => false,
			'render_callback' => 'twentythirteen_customize_partial_blogdescription',
		) );
	}
}
add_action( 'customize_register', 'twentythirteen_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @since Twenty Thirteen 1.9
 * @see twentythirteen_customize_register()
 *
 * @return void
 */
function twentythirteen_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @since Twenty Thirteen 1.9
 * @see twentythirteen_customize_register()
 *
 * @return void
 */
function twentythirteen_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Enqueue Javascript postMessage handlers for the Customizer.
 *
 * Binds JavaScript handlers to make the Customizer preview
 * reload changes asynchronously.
 *
 * @since Twenty Thirteen 1.0
 */
function twentythirteen_customize_preview_js() {
	wp_enqueue_script( 'twentythirteen-customizer', get_template_directory_uri() . '/js/theme-customizer.js', array( 'customize-preview' ), '20141120', true );
}
add_action( 'customize_preview_init', 'twentythirteen_customize_preview_js' );




/*Bilal hussain */
add_action('admin_menu', 'add_appearance_menu');

function add_appearance_menu(){
     add_submenu_page( 'themes.php', $page_title, $menu_title, $capability, $menu_slug, $function); 
}

function bh_theme_menu()
{
  add_theme_page( 'Theme Option', 'Theme Options', 'manage_options', 'bh_theme_options.php', 'bh_theme_page');  
}
add_action('admin_menu', 'bh_theme_menu');


function bh_theme_page()
{
?>
    <div class="section panel">
      <h1>Custom Theme Options</h1>
      <form method="post" enctype="multipart/form-data" action="options.php">
        <?php 
          settings_fields('bh_theme_options'); 
        
          do_settings_sections('bh_theme_options.php');
        ?>
            <p class="submit">  
                <input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />  
            </p>  
            
      </form>
      
      <p>Created by <a target="_blank" href="http://bilalhssn.blogspot.in">© Bilal </a></p>
    </div>
    <?php
}

/**
 * Register the settings to use on the theme options page
 */
add_action( 'admin_init', 'bh_register_settings' );

/**
 * Function to register the settings
 */
function bh_register_settings()
{
    // Register the settings with Validation callback
    register_setting( 'bh_theme_options', 'bh_theme_options', 'bh_validate_settings' );

    // Add settings section
    add_settings_section( 'bh_text_section', 'Text box Title', 'bh_display_section', 'bh_theme_options.php' );

    // Create textbox field
    $field_args = array(
      'type'      => 'text',
      'id'        => 'bh_logo',
      'name'      => 'bh_logo',
      'desc'      => 'Hint** : Go to media, copy src and paste here!',
      'std'       => '',
      'label_for' => 'bh_logo',
      'class'     => 'css_class'
    );

    add_settings_field( 'add_logo', 'Add logo src', 'bh_display_setting', 'bh_theme_options.php', 'bh_text_section', $field_args );
}

function bh_display_section($section){ 
	echo "ryanhssn";
}

function bh_display_setting($args)
{
    extract( $args );

    $option_name = 'bh_theme_options';

    $options = get_option( $option_name );

    switch ( $type ) {  
          case 'text':  
              $options[$id] = stripslashes($options[$id]);  
              $options[$id] = esc_attr( $options[$id]);  
              echo "<input class='regular-text$class' type='text' id='$id' name='" . $option_name . "[$id]' value='$options[$id]' />";  
              echo ($desc != '') ? "<br /><span class='description'>$desc</span>" : "";  
          break;  
    }
}



/*
* Creating a function to create our CPT
*/

function custom_post_type() {

// Set UI labels for Custom Post Type
	$labels = array(
		'name'                => _x( 'News', 'Post Type General Name', 'twentythirteen' ),
		'singular_name'       => _x( 'News', 'Post Type Singular Name', 'twentythirteen' ),
		'menu_name'           => __( 'News', 'twentythirteen' ),
		'parent_item_colon'   => __( 'Parent News', 'twentythirteen' ),
		'all_items'           => __( 'All News', 'twentythirteen' ),
		'view_item'           => __( 'View News', 'twentythirteen' ),
		'add_new_item'        => __( 'Add New News', 'twentythirteen' ),
		'add_new'             => __( 'Add New', 'twentythirteen' ),
		'edit_item'           => __( 'Edit News', 'twentythirteen' ),
		'update_item'         => __( 'Update News', 'twentythirteen' ),
		'search_items'        => __( 'Search News', 'twentythirteen' ),
		'not_found'           => __( 'Not Found', 'twentythirteen' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'twentythirteen' ),
	);
	
// Set other options for Custom Post Type
	
	$args = array(
		'label'               => __( 'news', 'twentythirteen' ),
		'description'         => __( 'News news and reviews', 'twentythirteen' ),
		'labels'              => $labels,
		// Features this CPT supports in Post Editor
		'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', 'post-formats' ),
		// You can associate this CPT with a taxonomy or custom taxonomy. 
		'taxonomies'          => array('topic'),
		/* A hierarchical CPT is like Pages and can have
		* Parent and child items. A non-hierarchical CPT
		* is like Posts.
		*/	
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'page',
	);
	
	// Registering your Custom Post Type
	register_post_type( 'news', $args );

}

add_action( 'init', 'custom_post_type', 0 );

/*
* Creating a function to create our CPT
*/

function custom_post_type_() {

// Set UI labels for Custom Post Type
	$labels = array(
		'name'                => _x( 'Govt Jobs', 'Post Type General Name', 'twentythirteen' ),
		'singular_name'       => _x( 'Jobs', 'Post Type Singular Name', 'twentythirteen' ),
		'menu_name'           => __( 'Jobs', 'twentythirteen' ),
		'parent_item_colon'   => __( 'Parent Jobs', 'twentythirteen' ),
		'all_items'           => __( 'All Jobs', 'twentythirteen' ),
		'view_item'           => __( 'View Jobs', 'twentythirteen' ),
		'add_new_item'        => __( 'Add New Jobs', 'twentythirteen' ),
		'add_new'             => __( 'Add New', 'twentythirteen' ),
		'edit_item'           => __( 'Edit Jobs', 'twentythirteen' ),
		'update_item'         => __( 'Update Jobs', 'twentythirteen' ),
		'search_items'        => __( 'Search Jobs', 'twentythirteen' ),
		'not_found'           => __( 'Not Found', 'twentythirteen' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'twentythirteen' ),
	);
	
// Set other options for Custom Post Type
	
	$args = array(
		'label'               => __( 'jobs', 'twentythirteen' ),
		'description'         => __( 'News jobs and reviews', 'twentythirteen' ),
		'labels'              => $labels,
		// Features this CPT supports in Post Editor
		'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', 'post-formats' ),
		// You can associate this CPT with a taxonomy or custom taxonomy. 
		'taxonomies'          => array('type'),
		/* A hierarchical CPT is like Pages and can have
		* Parent and child items. A non-hierarchical CPT
		* is like Posts.
		*/	
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		'can_export'          => true,
		'has_archive'         => true,
		'rewrite' => array(
                'slug' => 'govt-job'
            ),
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'page',
	);
	
	// Registering your Custom Post Type
	register_post_type( 'jobs', $args );

}

/* Hook into the 'init' action so that the function
* Containing our post type registration is not 
* unnecessarily executed. 
*/

add_action( 'init', 'custom_post_type_', 0 );


// hook into the init action and call create_news_taxonomies when it fires
add_action( 'init', 'create_news_taxonomies', 0 );

// create two taxonomies, topics and writers for the post type "news"
function create_news_taxonomies() {
	// Add new taxonomy, make it hierarchical (like categories)
	$labels = array(
		'name'              => _x( 'Topics', 'taxonomy general name', 'textdomain' ),
		'singular_name'     => _x( 'Topic', 'taxonomy singular name', 'textdomain' ),
		'search_items'      => __( 'Search Topics', 'textdomain' ),
		'all_items'         => __( 'All Topics', 'textdomain' ),
		'parent_item'       => __( 'Parent Topic', 'textdomain' ),
		'parent_item_colon' => __( 'Parent Topic:', 'textdomain' ),
		'edit_item'         => __( 'Edit Topic', 'textdomain' ),
		'update_item'       => __( 'Update Topic', 'textdomain' ),
		'add_new_item'      => __( 'Add New Topic', 'textdomain' ),
		'new_item_name'     => __( 'New Topic Name', 'textdomain' ),
		'menu_name'         => __( 'Topic', 'textdomain' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'topic' ),
	);

	register_taxonomy( 'topic', array( 'news' ), $args );

	$labels = array(
		'name'              => _x( 'Cities', 'taxonomy general name', 'textdomain' ),
		'singular_name'     => _x( 'City', 'taxonomy singular name', 'textdomain' ),
		'search_items'      => __( 'Search Cities', 'textdomain' ),
		'all_items'         => __( 'All Cities', 'textdomain' ),
		'parent_item'       => __( 'Parent City', 'textdomain' ),
		'parent_item_colon' => __( 'Parent City:', 'textdomain' ),
		'edit_item'         => __( 'Edit City', 'textdomain' ),
		'update_item'       => __( 'Update City', 'textdomain' ),
		'add_new_item'      => __( 'Add New City', 'textdomain' ),
		'new_item_name'     => __( 'New City Name', 'textdomain' ),
		'menu_name'         => __( 'City', 'textdomain' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'city' ),
	);

	register_taxonomy( 'city', array( 'news' ), $args );

	$labels = array(
		'name'              => _x( 'Tags', 'taxonomy general name', 'textdomain' ),
		'singular_name'     => _x( 'Tag', 'taxonomy singular name', 'textdomain' ),
		'search_items'      => __( 'Search Tags', 'textdomain' ),
		'all_items'         => __( 'All Tags', 'textdomain' ),
		'parent_item'       => __( 'Parent Tag', 'textdomain' ),
		'parent_item_colon' => __( 'Parent Tag:', 'textdomain' ),
		'edit_item'         => __( 'Edit Tag', 'textdomain' ),
		'update_item'       => __( 'Update Tag', 'textdomain' ),
		'add_new_item'      => __( 'Add New Tag', 'textdomain' ),
		'new_item_name'     => __( 'New Tag Name', 'textdomain' ),
		'separate_items_with_commas' => __( 'Separate tags with commas' ),
	    'add_or_remove_items' => __( 'Add or remove tags' ),
	    'choose_from_most_used' => __( 'Choose from the most used tags' ),
		'menu_name'         => __( 'Tag', 'textdomain' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'tags' ),
	);

	register_taxonomy( 'tags', array( 'news' ), $args );

	/*$labels = array(
		'name'              => _x( 'Type', 'taxonomy general name', 'textdomain' ),
		'singular_name'     => _x( 'Type', 'taxonomy singular name', 'textdomain' ),
		'search_items'      => __( 'Search Types', 'textdomain' ),
		'all_items'         => __( 'All Types', 'textdomain' ),
		'parent_item'       => __( 'Parent Type', 'textdomain' ),
		'parent_item_colon' => __( 'Parent Type:', 'textdomain' ),
		'edit_item'         => __( 'Edit Type', 'textdomain' ),
		'update_item'       => __( 'Update Type', 'textdomain' ),
		'add_new_item'      => __( 'Add New Type', 'textdomain' ),
		'new_item_name'     => __( 'New Type Name', 'textdomain' ),
		'separate_items_with_commas' => __( 'Separate type with commas' ),
	    'add_or_remove_items' => __( 'Add or remove types' ),
	    'choose_from_most_used' => __( 'Choose from the most used types' ),
		'menu_name'         => __( 'Type', 'textdomain' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'types' ),
	);

	register_taxonomy( 'types', array( 'jobs' ), $args );*/

	$labels = array(
		'name'              => _x( 'Qualification', 'taxonomy general name', 'textdomain' ),
		'singular_name'     => _x( 'Qualification', 'taxonomy singular name', 'textdomain' ),
		'search_items'      => __( 'Search Qualifications', 'textdomain' ),
		'all_items'         => __( 'All Qualifications', 'textdomain' ),
		'parent_item'       => __( 'Parent Qualification', 'textdomain' ),
		'parent_item_colon' => __( 'Parent Qualification:', 'textdomain' ),
		'edit_item'         => __( 'Edit Qualification', 'textdomain' ),
		'update_item'       => __( 'Update Qualification', 'textdomain' ),
		'add_new_item'      => __( 'Add New Qualification', 'textdomain' ),
		'new_item_name'     => __( 'New Qualification Name', 'textdomain' ),
		'separate_items_with_commas' => __( 'Separate Qualification with commas' ),
	    'add_or_remove_items' => __( 'Add or remove Qualifications' ),
	    'choose_from_most_used' => __( 'Choose from the most used Qualifications' ),
		'menu_name'         => __( 'Qualification', 'textdomain' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'qualification' ),
	);

	register_taxonomy( 'qualifications', array( 'jobs' ), $args );

	$labels = array(
		'name'              => _x( 'Job category', 'taxonomy general name', 'textdomain' ),
		'singular_name'     => _x( 'Job category', 'taxonomy singular name', 'textdomain' ),
		'search_items'      => __( 'Search Job categorys', 'textdomain' ),
		'all_items'         => __( 'All Job categorys', 'textdomain' ),
		'parent_item'       => __( 'Parent Job category', 'textdomain' ),
		'parent_item_colon' => __( 'Parent Job category:', 'textdomain' ),
		'edit_item'         => __( 'Edit Job category', 'textdomain' ),
		'update_item'       => __( 'Update Job category', 'textdomain' ),
		'add_new_item'      => __( 'Add New Job category', 'textdomain' ),
		'new_item_name'     => __( 'New Job category Name', 'textdomain' ),
		'separate_items_with_commas' => __( 'Separate Job category with commas' ),
	    'add_or_remove_items' => __( 'Add or remove Job categorys' ),
	    'choose_from_most_used' => __( 'Choose from the most used Job categorys' ),
		'menu_name'         => __( 'Job category', 'textdomain' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'job-cat' ),
	);

	register_taxonomy( 'job-cat', array( 'jobs' ), $args );

	$labels = array(
		'name'              => _x( 'Locations', 'taxonomy general name', 'textdomain' ),
		'singular_name'     => _x( 'Locations', 'taxonomy singular name', 'textdomain' ),
		'search_items'      => __( 'Search Locations', 'textdomain' ),
		'all_items'         => __( 'All Locations', 'textdomain' ),
		'parent_item'       => __( 'Parent Locations', 'textdomain' ),
		'parent_item_colon' => __( 'Parent Locations:', 'textdomain' ),
		'edit_item'         => __( 'Edit Locations', 'textdomain' ),
		'update_item'       => __( 'Update Locations', 'textdomain' ),
		'add_new_item'      => __( 'Add New Locations', 'textdomain' ),
		'new_item_name'     => __( 'New Locations Name', 'textdomain' ),
		'separate_items_with_commas' => __( 'Separate Locations with commas' ),
	    'add_or_remove_items' => __( 'Add or remove Locations' ),
	    'choose_from_most_used' => __( 'Choose from the most used Locations' ),
		'menu_name'         => __( 'Locations', 'textdomain' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'locations' ),
	);

	register_taxonomy( 'locations', array( 'jobs' ), $args );
		
}


function wpse_category_set_post_types( $query ){
    if( $query->is_category() && $query->is_main_query() ){
        $query->set( 'post_type', array( 'post', 'news', 'jobs' ) );
    }
}
add_action( 'pre_get_posts', 'wpse_category_set_post_types' );

function custom_excerpt_length( $length ) {
        return 20;
    }
    add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );	

function my_cpt_support_author() {
add_post_type_support( 'news', 'author' );
}
add_action('init', 'my_cpt_support_author');

function custom_pagination($numpages = '', $pagerange = '', $paged='') {


  if (empty($pagerange)) {
    $pagerange = 2;
  }

  /**
   * This first part of our function is a fallback
   * for custom pagination inside a regular loop that
   * uses the global $paged and global $wp_query variables.
   * 
   * It's good because we can now override default pagination
   * in our theme, and use this function in default quries
   * and custom queries.
   */
  global $paged;
  if (empty($paged)) {
    $paged = 1;
  }
  if ($numpages == '') {
    global $wp_query;
    $numpages = $wp_query->max_num_pages;
    if(!$numpages) {
        $numpages = 1;
    }
  }

  /** 
   * We construct the pagination arguments to enter into our paginate_links
   * function. 
   */
  $pagination_args = array(
    'base'            => get_pagenum_link(1) . '%_%',
    'format'          => 'page/%#%',
    'total'           => $numpages,
    'current'         => $paged,
    'show_all'        => False,
    'end_size'        => 1,
    'mid_size'        => $pagerange,
    'prev_next'       => True,
    'prev_text'       => __('&laquo;'),
    'next_text'       => __('&raquo;'),
    'type'            => 'plain',
    'add_args'        => false,
    'add_fragment'    => ''
  );

  $paginate_links = paginate_links($pagination_args);

  if ($paginate_links) {
    echo "<nav class='custom-pagination'>";
      echo "<span class='page-numbers page-num'>Page " . $paged . " of " . $numpages . "</span> ";
      echo $paginate_links;
    echo "</nav>";
  }

}


/**
 * Add REST API support to an already registered taxonomy.
 */
add_action( 'init', 'my_custom_taxonomy_rest_support', 25 );
function my_custom_taxonomy_rest_support() {
  global $wp_taxonomies;
 
  //be sure to set this to the name of your taxonomy!
  $taxonomy_name = 'city';
 
  if ( isset( $wp_taxonomies[ $taxonomy_name ] ) ) {
    $wp_taxonomies[ $taxonomy_name ]->show_in_rest = true;
 
    // Optionally customize the rest_base or controller class
    $wp_taxonomies[ $taxonomy_name ]->rest_base = $taxonomy_name;
    $wp_taxonomies[ $taxonomy_name ]->rest_controller_class = 'WP_REST_Terms_Controller';
  }
}


function custom_rewrite_rule() {
    //add_rewrite_rule('^/govt-jobs/([^/*])/?','index.php?page_id=465?job_category=air-force-jobs','top');

    //add_rewrite_rule('^govt-jobs/([^/]*)/([^/]*)','index.php?page_id=465/$matches[1]=$matches[2]','top');


    add_rewrite_rule('^govt-jobs/([^/]*)/','index.php?page_id=465/?qualifications=$matches[1]','top');

  }
  add_action('init', 'custom_rewrite_rule', 10, 0);




function wptp_add_tags_to_attachments() {
    register_taxonomy_for_object_type( 'city', 'attachment' );
}
add_action( 'init' , 'wptp_add_tags_to_attachments' );

// Remove dashicons in frontend for unauthenticated users
add_action( 'wp_enqueue_scripts', 'bs_dequeue_dashicons' );
function bs_dequeue_dashicons() {
    if ( ! is_user_logged_in() ) {
        wp_deregister_style( 'dashicons' );
    }
}
