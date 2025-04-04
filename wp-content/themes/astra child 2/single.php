<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
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
<!-- custom field called -->
		<?php
		 $value1=get_field('designation');
         $value2=get_field('company');
         $value3=get_field('company_site');
         // echo $value1; 
         // echo $value2; 
   ?>

   <?php 
$image = get_field('image');
if( !empty( $image ) ): ?>

    <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" width="200" height="100" />
    <P><strong>DESIGNATION: </strong><?php echo $value1; ?></P>
     <P><strong>COMPANY: </strong><?php echo $value2; ?></P>
     <P><strong>COMPANY SITE:</strong><?php echo $value3; ?></P>

<?php echo get_field('catagory_image');?>

<?php echo get_field('Date_of_creation'); ?>

<!-- <?php

$variable = get_field('user', 'user_3');

 echo $variable;

?>
 -->
<?php endif; ?>

<!-- done -->

		<?php astra_content_loop(); ?>

		<?php astra_primary_content_bottom(); ?>

	</div><!-- #primary -->

<?php if ( astra_page_layout() == 'right-sidebar' ) : ?>

	<?php get_sidebar(); ?>


<?php endif ?>


<?php get_footer(); ?>
