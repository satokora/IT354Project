<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Sugar & Spice
 */

global $wpdb;
$rows=$wpdb->get_results( "SELECT * FROM $wpdb->recipes order by upload_date desc limit 10 " );

get_header(); ?>
        <div id="primary" class="content-area">  
            <div id="content" class="site-content" role="main">
                <h4>Your Recent Recipes</h4>
            <?php if ( count($rows)>0 ) : ?>

                <?php /* Start the Loop */ ?>
                <?php foreach ($rows as $row){ ?>
                <?php 
                $recipeId = $row->id;
                $recipeName = $row->title;
                $recipeAuthor = $row->author;
                $recipeIngr = str_replace(array('"',"<li>","</li>"), array('',"",""), $row->ingredient);
                $recipeDirc = $row->direction;
                $recipePhotoP = str_replace('"', '', $row->photo_path);
                $recipePhoto = $row->photo;

                ?>

                <article id="<?php echo $recipeId; ?>" <?php post_class(); ?>>
                    <div class="media">
                      <div class="media-left">
                        <a href="#">
                          <img class="media-object" src="<?php echo  $recipePhotoP; ?>" alt="<?php echo  $recipeName; ?>" style="width: 90px">
                        </a>
                      </div>
                      <div class="media-body">
                        <header class="entry-header">
                        <h1 class="entry-title"><a href="/view-recipe?id=<?php echo  $recipeId; ?>" rel="bookmark"><?php echo $recipeName." By ".$recipeAuthor?></a></h1>

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
                      </div>
                    </div>


                    
                </article><!-- #post-## -->
                    

                <?php } ?>

                <?php get_template_part('pagination'); ?>

            <?php else : ?>

                <?php get_template_part( 'no-results', 'index' ); ?>

            <?php endif; ?>

                
            </div><!-- #content -->
        </div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>