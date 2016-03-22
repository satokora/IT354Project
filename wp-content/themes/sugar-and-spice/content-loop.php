<?php
/**
 * @package Sugar & Spice
 */
?>

<article id="<?php echo $recipeId; ?>" <?php post_class('excerpt cf'); ?>>
    <div class="post-thumbnail">
    <?php if ($row->photo_path!="") { ?>
       <a href="<?php echo $row->photo_path; ?>">
         <img src="<?php echo $row->photo_path; ?>" alt="<?php echo $recipeName; ?>" />
       </a>	
    <?php } ?>
    </div>
	<header class="entry-header">
		<h1 class="entry-title"><a href="<?php echo $recipeId; ?>" rel="bookmark"><?php echo $recipeName; ?></a></h1>

		<?php if ( 'post' == get_post_type() ) : ?>
		<div class="entry-meta">
			<?php sugarspice_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-summary">
		<?php echo get_the_excerpt(); ?>
        <a class="more-link entry-meta" href="<?php the_permalink(); ?>"><?php _e('Continue reading &rarr;', 'sugarspice'); ?></a>
        
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'sugarspice' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-summary -->

</article><!-- #post-## -->
