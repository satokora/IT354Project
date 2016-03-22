<?php
/**
 * The Template for displaying all single posts.
 *
 * @package Sugar & Spice
 */

get_header(); 

global $wpdb;
$query= $wpdb->prepare("SELECT r.id, r.title, r.author, r.ingredient, r.photo_path, r.photo from $wpdb->recipes");
$rows = $wpdb->get_results($sql);
?>

        <div id="primary" class="content-area">  
            <div id="content" class="site-content" role="main">


            <?php foreach ($rows as $row){ ?>
<?php echo $row->id; ?>
                <?php get_template_part( 'content', get_post_format() ); ?>
                
                <?php if ( get_the_author_meta( 'description' ) ) { ?>
                <div class="entry-author section">
                    <h2 class="section-title"><span><?php _e('About the author', 'sugarspice'); ?></span></h2>
                    <div class="avatar author-photo"><?php echo get_avatar( get_the_author_meta( 'ID' ) , 80 ); ?></div>
                    <div class="author-content">
                        <h5><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>" rel="me"><?php the_author(); ?></a></h5>
                        <?php the_author_meta( 'description' ); ?>
                    </div>
                </div><!-- .entry-author -->
                <?php } ?>
                
                <?php sugarspice_content_nav( 'nav-below' ); ?>

                <?php
                    // If comments are open or we have at least one comment, load up the comment template
                    if ( comments_open() || '0' != get_comments_number() )
                        comments_template();
                ?>

            <?php } // end of the loop. ?>



            </div><!-- #content -->
        </div><!-- #primary -->
        
<?php get_sidebar(); ?>
<?php get_footer(); ?>