<?php
/**
 * @package Sugar & Spice
 */
?>

<?php

// Display first post on Home Page in full, rest as excerpts
if( !is_paged() && ($rows[0] == $row) ) :

?>
    <article id="<?php echo $row->id; ?>" <?php post_class('firstfull'); ?>>
        <header class="entry-header">
            <h1 class="entry-title"><a href="<?php echo $row->id; ?>" rel="bookmark"><?php echo $row->title; ?></a></h1>

            <div class="entry-meta">
                <?php sugarspice_posted_on(); ?>
            </div><!-- .entry-meta -->
        </header><!-- .entry-header -->

        <div class="entry-content">
            <?php echo $row->ingredient; ?>
        </div><!-- .entry-content -->

        <footer class="entry-meta bottom">
            
            <?php sugarspice_post_meta(); ?>

        </footer><!-- .entry-meta -->
    </article><!-- #post-## -->
<?php
else :
    get_template_part( 'content', 'loop' );
endif;
