<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Astra
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header(); ?>

<?php if ( astra_page_layout() == 'left-sidebar' ) : ?>

	<?php get_sidebar(); ?>

<?php endif ?>

	<div id="primary" <?php astra_primary_class(); ?>>

		<?php astra_primary_content_top(); ?>

<!-- --------------------- catagory image---------------------- -->
		<?php echo "<img src='" .get_field("catagory_image",get_queried_object())."'/> <br/> <br/>";?>

		<?php 
		$term=get_queried_object();
        $val1=get_field('Date_of_creation',$term); ?>

      <P><strong>DATE OF CREATION: </strong><?php echo $val1; ?></P>

      <?php 
		$term=get_queried_object();
        $val2=get_field('page-link',$term); ?>

      <P><strong>FOR MORE: </strong><?php echo $val2; ?></P>

      <?php 
		$term=get_queried_object();
        $val3=get_field('url',$term); ?>

      <P><strong>VISIT OUR SITE: </strong><?php echo $val3; ?></P>

      <p><?php the_field('user', 'user_3'); ?></p>

      
     

<!-- ------------------------------------------------------------ -->
		
		<?php astra_primary_content_bottom(); ?>

		<?php astra_archive_header(); ?>

		<?php astra_content_loop(); ?>

		<?php astra_pagination(); ?>

		<?php astra_primary_content_bottom(); ?>

	</div><!-- #primary -->

<?php if ( astra_page_layout() == 'right-sidebar' ) : ?>

	<?php get_sidebar(); ?>

<?php endif ?>

<?php get_footer(); ?>
