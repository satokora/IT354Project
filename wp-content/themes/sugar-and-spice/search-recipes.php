<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package Sugar & Spice
 */



get_header(); ?>

	<section id="primary" class="content-area">

		<?php if(isset($_GET["s"])) : ?>
		<?php
		include 'wp-load.php';
  	global $wpdb;
  	$keyword = '%' . $_GET['s'] . '%';

    $rows = $wpdb->get_results($wpdb->prepare("SELECT * FROM $wpdb->recipes WHERE title like %s",str_replace("%", "", $keyword) ));

		?>

			<header class="page-header">
				<h1 class="page-title"><?php echo 'Search Results for: <span>' . $keyword . '</span>'; ?></h1>
			</header><!-- .page-header -->

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
                  <img class="media-object" src="<?php echo  $recipePhotoP; ?>" alt="<?php echo  $recipeName; ?>">
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

			<?php sugarspice_content_nav( 'nav-below' ); ?>

		<?php else : ?>

			<?php get_template_part( 'no-results', 'search' ); ?>

		<?php endif; ?>

	</section><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>