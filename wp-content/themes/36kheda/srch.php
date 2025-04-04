<?php
/*
Template Name: search page
*/
get_header();

global $wpdb;
$strng = $_GET['qry'];
//$result = $wpdb->get_results ( "SELECT * FROM `wpdbkheda_posts` WHERE `post_name` LIKE '%".$strng."%'" );
//echo " SELECT * FROM `wpdbkheda_terms`WHERE `slug` LIKE '%".$strng."%' " ;
//echo "$strng";
$result = $wpdb->get_results (" 
		SELECT * FROM wpdbkheda_posts INNER 
		JOIN wpdbkheda_term_relationships ON wpdbkheda_posts.ID=wpdbkheda_term_relationships.object_id 
		INNER JOIN wpdbkheda_terms ON wpdbkheda_terms.term_id=wpdbkheda_term_relationships.term_taxonomy_id 
		INNER JOIN wpdbkheda_term_taxonomy ON wpdbkheda_term_taxonomy.term_id=wpdbkheda_terms.term_id 
		WHERE wpdbkheda_term_taxonomy.taxonomy ='city' AND wpdbkheda_terms.slug LIKE '%".$strng."%'
		ORDER BY `wpdbkheda_posts`.`post_date` DESC"
		);

//echo '<pre>';
//print_r($result);
//echo '</pre>';

foreach ( $result as $post )
{
   the_post_thumbnail($post->ID);
   echo $post->post_title.'<br/>';	
   echo $post->post_content.'<br/>';
}

?>