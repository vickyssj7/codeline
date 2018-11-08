<?php
/**
 * @package unite
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header page-header">

		<?php 
                    if ( of_get_option( 'single_post_image', 1 ) == 1 ) :
                        the_post_thumbnail( 'unite-featured', array( 'class' => 'thumbnail' )); 
                    endif;
                  ?>

		<h1 class="entry-title "><?php the_title(); ?></h1>

		
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'unite' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-meta">
		<div class="entry-meta">
			<?php if(get_field('release_date')) { ?>
			<span class = "release-date"><i class = "fa fa-calendar"></i> Release: <?=date('F d, Y',strtotime(get_field('release_date')))?></span> | 
			<?php } ?>
			<?php if(get_field('ticket_price')) { ?>
			<span class = "ticket-price">Ticket Price: $<?=get_field('ticket_price')?></span> | 
			<?php } ?>
			<?php 
				$postId = get_the_ID(); 
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
		</div><!-- .entry-meta -->
		<hr class="section-divider">
	</footer><!-- .entry-meta -->
</article><!-- #post-## -->
