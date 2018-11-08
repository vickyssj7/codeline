<?php
/*This file is part of unite-child, unite child theme.

All functions of this file will be loaded before of parent theme functions.
Learn more at https://codex.wordpress.org/Child_Themes.

Note: this function loads the parent stylesheet before, then child theme stylesheet
(leave it in place unless you know what you are doing.)
*/

function unite_child_enqueue_child_styles() {
$parent_style = 'parent-style'; 
	wp_enqueue_style($parent_style, get_template_directory_uri() . '/style.css' );
	wp_enqueue_style( 
		'child-style', 
		get_stylesheet_directory_uri() . '/style.css',
		array( $parent_style ),
		wp_get_theme()->get('Version') );
	}
add_action( 'wp_enqueue_scripts', 'unite_child_enqueue_child_styles' );


function my_theme_enqueue_styles() {

    $parent_style = 'parent-style'; // This is 'unit-style' for the Twenty Fifteen theme.

    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( $parent_style ),
        wp_get_theme()->get('Version')
    );
}
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );


if(!function_exists('create_film_post_type')) {
    function create_film_post_type() {
      register_post_type( 'Films',
        array(
          'labels' => array(
            'name' => __( 'Films' ),
            'singular_name' => __( 'Film' )
          ),
          'public' => true,
          'has_archive' => true,
		  'supports' => array('title','editor','thumbnail'),
          'rewrite' => array('slug' => 'films'),
        )
      );
    }
    add_action( 'init', 'create_film_post_type' );
}


if(!function_exists('create_film_post_tax')) {
    function create_film_post_tax() {
       
        $listTax = ['gener', 'country', 'year', 'actors'];
        // create a new taxonomies
        foreach($listTax as $genreType) {
            register_taxonomy(
                $genreType,
                array('films'),
                array(
                    'label' => __( ucwords(str_replace(array('_','-'),' ',$genreType)) ),
                    "public" => true,
                    "hierarchical" => true,
                    "query_var" => true,
                    'rewrite' => array( 'slug' => $genreType, 'with_front' => true,  'hierarchical' => true, ),
                    "show_in_quick_edit" => false,
                )
            );
        }
    }
    add_action( 'init', 'create_film_post_tax' );
}

function showFilmInfo($post_id) {
	if($post_id) {
	?>
		<?php if(get_field('release_date',$post_id)) { ?>
		<span class = "release-date"><i class = "fa fa-calendar"></i> Release: <?=date('F d, Y',strtotime(get_field('release_date',$post_id)))?></span> | 
		<?php } ?>
		<?php if(get_field('ticket_price',$post_id)) { ?>
		<span class = "ticket-price">Ticket Price: $<?=get_field('ticket_price',$post_id)?></span> | 
		<?php } ?>
		<?php 
			$postId = $post_id; 
			$gener_categories = get_the_terms( $postId, 'gener' );
			$country_categories = get_the_terms( $postId, 'country' );
			if(count($gener_categories)) {
				foreach($gener_categories as $genData) {
					$genCatData[] = $genData->name;
				}
			}
			if(count($country_categories)) {
				foreach($country_categories as $cnData) {
					$genCnData[] = $cnData->name;
				}
			}
		?>
		<?php if(isset($genCatData)) { ?>
		<span class = "gener">Gener: <?=implode(', ', $genCatData)?></span> | 
		<?PHP } ?>
		<?php if(isset($genCnData)) { ?>
		<span class = "country">Country:  <?=implode(', ', $genCnData)?></span> 
		<?php } ?>
	<?php
	}
}

add_action('show_films_info','showFilmInfo',1,10);


function last_5films($atts) {
	$args = array(
		'post_type' => 'films',
		'orderby' => 'ID',
		'order' => 'DESC',
		'posts_per_page' => 5,
	);
	
	$getPosts = new WP_Query($args);
	if($getPosts->found_posts) {
		while($getPosts->have_posts()) {
			$getPosts->the_post();
			get_template_part('template','last_5films');
		}
	}
	
}
add_shortcode( 'last_5_films', 'last_5films' );