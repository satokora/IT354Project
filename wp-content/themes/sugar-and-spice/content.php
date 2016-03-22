<?php
/**
 * @package Sugar & Spice
 */

?>

<article id="<?php echo $recipeId; ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h1 class="entry-title"><a href="<?php echo  $recipeId; ?>" rel="bookmark"><?php echo $recipeName; ?></a></h1>

		<div class="entry-meta">
			<?php sugarspice_posted_on(); ?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<div class="entry-content">
        <?php echo $recipeIngr; ?>
	</div><!-- .entry-content -->

	<footer class="entry-meta bottom">
		
		<?php sugarspice_post_meta(); ?>

	</footer><!-- .entry-meta -->
</article><!-- #post-## -->
