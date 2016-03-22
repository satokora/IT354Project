<?php
/**
 * Sugar & Spice functions and definitions
 *
 * @package Sugar & Spice
 */


if ( ! function_exists( 'sugarspice_setup' ) ) :



/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 */
function sugarspice_setup() {

	/**
	 * Set the content width based on the theme's design and stylesheet.
	 */
	global $content_width;
	if ( ! isset( $content_width ) )
	$content_width = 600; /* pixels */

	load_theme_textdomain( 'sugarspice', get_template_directory() . '/languages' );

	add_theme_support( 'automatic-feed-links' );

	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 210, 210, true );

	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'sugarspice' ),
		'footer' => __( 'Footer Menu', 'sugarspice' )
	) );

	add_theme_support( 'custom-background', apply_filters( 'sugarspice_custom_background_args', array(
		'default-color' => '',
		'default-image' => get_template_directory_uri() . '/images/bg.png',
	) ) );

    add_theme_support( 'html5', array( 'comment-list', 'search-form', 'comment-form', ) );
}
endif; // sugarspice_setup
add_action( 'after_setup_theme', 'sugarspice_setup' );

/**
 * Adjust $content_width it depending on the temaplte used
 */
function sugarspice_content_width() {
	global $content_width;

	if ( ! is_active_sidebar( 'sidebar-1' ) || is_page_template( 'full-width-page.php' ) )
		$content_width = 940;
}
add_action( 'template_redirect', 'sugarspice_content_width' );

/**
 * Register widgetized area and update sidebar with default widgets
 */
function sugarspice_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'sugarspice' ),
		'id'            => 'sidebar-1',
        'description'   => 'Main widget area',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title"><span>',
		'after_title'   => '</span></h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Prefooter Area One', 'sugarspice' ),
		'id'            => 'prefooter-1',
        'description'   => 'Widget area above the footer.',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title"><span>',
		'after_title'   => '</span></h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Prefooter Area Two', 'sugarspice' ),
		'id'            => 'prefooter-2',
        'description'   => 'Widget area above the footer.',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title"><span>',
		'after_title'   => '</span></h3>',
	) );

	register_sidebar( array(
		'name'          => __( 'Prefooter Area Three', 'sugarspice' ),
		'id'            => 'prefooter-3',
        'description'   => 'Widget area above the footer.',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title"><span>',
		'after_title'   => '</span></h3>',
	) );

    register_widget( 'sugarspice_contact_widget' );
    register_widget( 'sugarspice_about_widget' );
    register_widget( 'sugarspice_archives_widget' );
    register_widget( 'sugarspice_social_widget' );
}
add_action( 'widgets_init', 'sugarspice_widgets_init' );

include( get_template_directory() . '/inc/widgets/contact-widget.php' );
include( get_template_directory() . '/inc/widgets/about-widget.php' );
include( get_template_directory() . '/inc/widgets/archives-widget.php' );
include( get_template_directory() . '/inc/widgets/social-widget.php' );

function sugarspice_prefooter_class() {
	$count = 0;

	if ( is_active_sidebar( 'prefooter-1' ) )
		$count++;

	if ( is_active_sidebar( 'prefooter-2' ) )
		$count++;

	if ( is_active_sidebar( 'prefooter-3' ) )
		$count++;

	$class = '';

    if ( $count == 2 ) {
        $class = 'one-half';
    } else if ( $count == 3 ) {
        $class = 'one-third';
	}

	if ( $class ){
		echo 'class="' . $class . '"';
        }
}

/**
 * Enqueue scripts and styles
 */
function sugarspice_scripts() {

    wp_enqueue_script( 'sugarspice-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

    wp_register_script('modernizr', get_template_directory_uri() . '/js/modernizr.min.js', array(), '2.6.2', true);
    wp_enqueue_script('modernizr');

    wp_register_script('tinynav', get_template_directory_uri() . '/js/tinynav.min.js', array(), '1.1', true);
    wp_enqueue_script('tinynav');

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	wp_enqueue_script( 'sugarspice-flexslider', get_template_directory_uri() . '/js/jquery.flexslider-min.js', array( 'jquery' ), '2.2.0', true );

	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'sugarspice-keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20120202' );
	}
}
add_action( 'wp_enqueue_scripts', 'sugarspice_scripts' );

/**
 * Returns the Google font stylesheet URL, if available.
 */
function sugarspice_fonts_url() {
	$fonts_url = '';

	$niconne = _x( 'on', 'Niconne font: on or off', 'sugarspice' );

	$ptserif = _x( 'on', 'PT Serif font: on or off', 'sugarspice' );

    $raleway = _x( 'on', 'Raleway font: on or off', 'sugarspice' );

	if ( 'off' !== $niconne || 'off' !== $ptserif || 'off' !== $raleway ) {
		$font_families = array();

		if ( 'off' !== $niconne )
			$font_families[] = 'Niconne';

		if ( 'off' !== $ptserif )
			$font_families[] = 'PT+Serif:400,700';

        if ( 'off' !== $raleway )
			$font_families[] = 'Raleway:400,600';

		$query_args = array(
			'family' => urlencode( implode( '|', $font_families ) ),
			'subset' => urlencode( 'latin,latin-ext' ),
		);
		$fonts_url = add_query_arg( $query_args, "//fonts.googleapis.com/css" );
	}

	return $fonts_url;
}

function sugarspice_css() {

	wp_enqueue_style( 'sugarspice-fonts', sugarspice_fonts_url() );

	wp_enqueue_style( 'sugarspice-style', get_stylesheet_uri() );

	if ( of_get_option( 'responsive' ) == 0 )
	wp_enqueue_style( 'sugarspice-responsive', get_template_directory_uri() . '/responsive.css' );

    wp_register_style('sugarspice-icofont', get_template_directory_uri() . '/fonts/icofont.css');
    wp_enqueue_style('sugarspice-icofont');

}
add_action( 'wp_enqueue_scripts', 'sugarspice_css' );

if (!function_exists('sugarspice_footer_js')) {
	function sugarspice_footer_js() {
    ?>
        <script>

        jQuery(document).ready(function($) {
            $('.widget-title').each(function() {
                var $this = $(this);
                $this.html($this.html().replace(/(\S+)\s*$/, '<em>$1</em>'));
            });
            $('#reply-title').addClass('section-title').wrapInner('<span></span>');

            if( $('.flexslider').length ) {
                $('.flexslider').flexslider({ directionNav: false, pauseOnAction: false, });
                $('.flex-control-nav').each(function(){
                    var $this = $(this);
                    var width = '-'+ ($this.width() / 2) +'px';
                    console.log($this.width());
                    $this.css('margin-left', width);
                });
            }

            $("#nav").tinyNav({header: '<?php _e( "Menu", "sugarspice" ); ?>'});
        });
        </script>
    <?php
	}
}
add_action( 'wp_footer', 'sugarspice_footer_js', 20, 1 );

/**
 * Excerpt config. Can be overriden in child theme
 */
if (!function_exists('sugarspice_excerpt_length')) {
    function sugarspice_excerpt_length( $length ) {
        return 40;
    }
}
add_filter( 'excerpt_length', 'sugarspice_excerpt_length', 999 );

if (!function_exists('sugarspice_excerpt_more')) {
    function sugarspice_excerpt_more( $more ) {
        return '...';
    }
}
add_filter('excerpt_more', 'sugarspice_excerpt_more');


/**
 * Options Framework
 */
if ( ! function_exists( 'optionsframework_init' ) ) {
	define( 'OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri() . '/inc/options-framework/' );
	require_once dirname( __FILE__ ) . '/inc/options-framework/options-framework.php';
}
// Theme Options sidebar
add_action( 'optionsframework_after','sugarspice_options_display_sidebar' );

function sugarspice_options_display_sidebar() { ?>
	<div id="optionsframework-sidebar">
		<div class="metabox-holder">
			<div class="postbox">
				<h3><?php _e('Support','sugarspice') ?></h3>
					<div class="inside">
                        <p><?php _e('The best way to contact me with <b>support questions</b> and <b>bug reports</b> is via the','sugarspice') ?> <a href="http://wordpress.org/support/theme/sugar-and-spice"><?php _e('WordPress support forums','corpo') ?></a>.</p>
                        <p><?php _e('If you like this theme, I\'d appreciate if you could ','sugarspice') ?>
                        <a href="http://wordpress.org/support/view/theme-reviews/sugar-and-spice"><?php _e('rate Sugar & Spice at WordPress.org','sugarspice') ?></a><br /><b><?php _e('Thanks!','sugarspice'); ?></b></p>
					</div>
			</div>
		</div>
	</div>
<?php }

/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';


add_filter('widget_text', 'do_shortcode');

/**
* textscrape()
* created by Satoko Kora
* This class accepts URL and scrapes text embeded in the page.
*/
function textscrape(){
    if (isset($_POST['sourceUrl'])){
      $url = trim($_POST['sourceUrl']);
      $raw = file_get_contents($url);
      $newlines = array('\t','\n','\r','\x20\x20','\0','\x0B');
      $content = str_replace($newlines, "", html_entity_decode($raw));

      $before_str = array(":", ";", "=", "*");
      $after_str   = array("&#58;", "&#59;", "&#61;", "&#42;");

      $content = str_replace($before_str, $after_str, $content);

      $label="";
      if(strrpos($content, 'Directions')>0){
        $label='Directions';
      }
      else if(strrpos($content, 'Preparation')>0){
        $label='Preparation';
      }
      else if(strrpos($content, 'Method')>0){
        $label='Method';
      }
      else if(strrpos($content, 'Instructions')>0){
        $label='Instructions';
      }
      else{
        $label='Instruction';
      }

      $start = strrpos($content, $label);
      $end = strpos($content, '</div>',$start) + 6;

      $instructions = filter_var(substr($content, $start, $end-$start), FILTER_SANITIZE_MAGIC_QUOTES);
      
      return $instructions;


  }
}
add_shortcode('scraping', 'textscrape');

function hideNavBar(){
  ?>
<script>
    jQuery(document).ready(function($){
        $('#nav').hide();
    });
</script>
<?php
}
add_shortcode('hideNav', 'hideNavBar');

function loginForUser(){
  if (isset($_POST['login'])){
    $username=trim($_POST['username']);
    $pass=trim($_POST['pass']);
    // connect to DB
  }

}
add_shortcode('login', 'loginForUser');

function my_bootstrap_theme_scripts(){

  wp_register_script( 'bootstrap-js', get_template_directory_uri() . '/bootstrap/js/bootstrap.min.js', array( 'jquery' ), '3.0.1', true );
  wp_register_style( 'bootstrap-css', get_template_directory_uri() . '/bootstrap/css/bootstrap.min.css', array(), '3.0.1', 'all' );
  wp_enqueue_script( 'bootstrap-js' );
  wp_enqueue_style( 'bootstrap-css' );
}
add_action('wp_enqueue_scripts', 'my_bootstrap_theme_scripts');
remove_filter('the_content', 'wpautop');

/**
* recipe search()
* created by Satoko Kora
* This class accepts URL and scrapes text embeded in the page.
*/
function yummly_search(){
  ?>
  <script type="text/javascript">
jQuery(document).ready(function($) {



    $("#search-new-recipe").click(function(){
      $recipeStr = $("#search-str").val().replace(' ', '+');
    $.ajax({
        type: "GET",
        url: 'http://api.yummly.com/v1/api/recipes?_app_id=0cf77f06&_app_key=39ad1d738fbcc68832b627eaef79f879&q=' + $recipeStr + '&requirePictures=true&maxResult=20',
        dataType: 'jsonp',
        success: function(data)
        {
          
          var $setStr ='';
          $.each(data.matches, function(index, obj){
            if (index % 4 == 0){
              if ($setStr != ''){
                $setStr += '</div><div class="row">';
              }else{
                $setStr += '<div class="row">';
              }
            }
              var $min = parseInt(obj.totalTimeInSeconds) / 60;
              $setStr +='<div class="col-sm-6 col-md-3"><div class="thumbnail"><img src="';
              $setStr += obj.smallImageUrls +'-c" alt="' + obj.recipeName + '"  class="thumbnail" >';
              $setStr += '<div class="caption"><a class="recipe-modal" href="#myModal"  data-toggle="modal" data-id="'+obj.id+'"><h3>' + obj.recipeName + '</h3></a>';
              $setStr += '<p>Preparation time: '+ $min +' min</p>';
              $setStr += '<p>' + obj.sourceDisplayName + '</p></div></div></div>';

          });
           $setStr += '</div>';
           $("#results").html($setStr); 
        },
        error: function()
        {
          
        }
      });
  });
  $("#search").submit(function() {
    $("#search-new-recipe").click();
    return false;
  });



  $('#myModal').on('shown.bs.modal', function (event) {
    var $selectedRecipeId = $(event.relatedTarget).attr('data-id');
    var $ingredients ='';
    var $photoUrl='';

    $.ajax({
      type: "GET",
      url: 'http://api.yummly.com/v1/api/recipe/'+ $selectedRecipeId +'?_app_id=0cf77f06&_app_key=39ad1d738fbcc68832b627eaef79f879',
      dataType: 'jsonp',
      success: function(data)
      {
        $('#myModalLabel').html(data.name);


        var $setStr ='';
        $setStr+='<div class="row"><div class="col-md-6"><img src="'+data.images[0].hostedLargeUrl+'" alt="'+data.name+'" class="thumbnail" /></div>';
        $setStr+='<div class="col-md-6"><table><tr><td>Ratings:</td><td>'+data.rating+'/5 stars</td></tr>';
        $setStr+='<tr><td>Servings:</td><td>'+data.numberOfServings+'</td></tr>';
        $setStr+='<tr><td>Nutrition:</td><td>'+data.nutritionEstimates[0].value+' '+data.nutritionEstimates[0].unit.plural+'</td></tr>';
        $setStr+='<tr><td>Total time:</td><td>'+data.totalTime+'</td></tr></table></div></div>';
        $setStr+='<div><ul>';
        $.each(data.ingredientLines, function(index, obj){
          $setStr+='<li>'+ obj +'</li>';
          $ingredients += obj + '\\';
        });
        $setStr += '</ul></div>';
        $setStr += '<div><a class="btn btn-warning" href="'+data.source.sourceRecipeUrl+'" target="_blank" role="button">See Details</a>  From <span id="source-name">'+data.source.sourceDisplayName+'</span></div>';
        
        $('input[name="recipeName"]').val(data.name);
        $('input[name="authorName"]').val(data.source.sourceDisplayName);
        $('input[name="ingrLabels"]').val($ingredients.substring(0,$ingredients.length-2));
        $('input[name="photo"]').val(data.images[0].hostedSmallUrl);
        $('input[name="sourceUrl"]').val(data.source.sourceRecipeUrl);

        $(".modal-body").html($setStr);

      },
      error: function()
      {
        $('#myModalLabel').html("No Data");
        $(".modal-body").html("Data not found");
      }
    });
  });


});
</script>
  <?php
}
add_shortcode('yummly', 'yummly_search');

function createRecipe(){
?>
  <script type="text/javascript">
jQuery(document).ready(function ($) {



$('.nav-tabs li a').click(function (e) {
  e.preventDefault();
  $(this).tab('show');
});
$( "#author-name" ).keyup(function() {
  $( ".card h4 span" ).text($( "#author-name" ).val());
});
$( "#recipe-name" ).keyup(function() {
  $( ".recipe-name p" ).text($( "#recipe-name" ).val());
});
$( "#ingredients" ).keyup(function() {
  var $list = $( "#ingredients" ).val();
  $list = $list.replace(/\n/g, '</li><li>');
  $list = "<li>" + $list + "</li>";
  $( ".ingrd ul" ).html($list);
});
$( "#directions" ).keyup(function() {
  var $list = $( "#directions" ).val();
  $list = $list.replace(/\n/g, '</li><li>');
  $list = "<li>" + $list + "</li>";
  $( ".dirc ol" ).html($list);
});
function readURL(input) {

    if (input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#upload-img').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
};

$("#upload").change(function(){
    readURL(this);
});

});
</script>
<?php
}
add_shortcode('new-recipe', 'createRecipe');

function importRecipe(){

  if(isset($_POST['recipeName'])){

    $recipeName = $_POST['recipeName'];
    $authorName = $_POST['authorName'];
    $ingres = $_POST['ingrLabels'];
    $photoPath = $_POST['photo'];
    $sourceUrl = $_POST['sourceUrl'];
    ?>
    <script type="text/javascript">
    jQuery(document).ready(function ($) {
      $( "#author-name").val("<?php echo $authorName; ?>");
      $( "#recipe-name" ).val("<?php echo $recipeName; ?>");
      $( "#ingredients" ).val("<?php echo $ingres; ?>");
      $( ".card img" ).attr("src", "<?php echo $photoPath; ?>");
      $(".card .media-left>a").attr("href", "<?php echo $photoPath; ?>");

      if ($( "#author-name" ).val()!=""){
        $( ".card h4 span" ).text($( "#author-name" ).val());
      };
      if ($( "#recipe-name" ).val()!=""){
        $( ".recipe-name p" ).text($( "#recipe-name" ).val());
      };
      if ($( "#ingredients" ).val()!=""){
        var $list = $( "#ingredients" ).val();
        $list = $list.replace(/\\/g, '\n');
        $list = $list.replace(/\n/g, '</li><li>');
        $list = "<li>" + $list + "</li>";
        $( ".ingrd ul" ).html($list);
      };
      if($( "#directions" ).val()!=""){
        var $list = $( "#directions" ).val();
        $list = $list.replace(/\n/g, '</li><li>');
        $list = "<li>" + $list + "</li>";
        $( ".dirc ol" ).html($list);
      }
    });
    </script>
    <?php
  }else{
    
  }
}
add_shortcode('importRcp', 'importRecipe');

function addJumpBtn(){
  if(isset($_POST['sourceUrl'])){
    $sourceUrl = $_POST['sourceUrl'];
    ?>
    <script type="text/javascript">
    jQuery(document).ready(function($) {
    $("#direc-form").append('<a class="btn btn-warning" href="<?php echo $sourceUrl; ?>" target="_blank" role="button">Display this recipe\'s page </a> ')
    });
    </script>
    <?php
  }
}
add_shortcode('jmpBtn', 'addJumpBtn');

function setIngreAndDirec()
{
  ?>
    <script type="text/javascript">
    jQuery(document).ready(function($) {
    $("#data-from-scratch").submit(function(event) {
      $("#list-ingres").val($(".ingrd ul").html());
      $("#list-direcs").val($(".dirc ol").html());
      $("#photo_path").val($(".card .media-left>a").attr("href"));
      });
    });
    </script>
    <?php
}
add_shortcode('setIngDir', 'setIngreAndDirec');

function storeRecipe()
{
  include 'wp-load.php';
  global $wpdb;
  if(isset($_POST['save'])){
    
    $title = $_POST['recipe-name'];
    $authorName = $_POST['author-name'];
    $ingres = $_POST['list-ingres'];
    $direcs = $_POST['list-direcs'];
    $photoPath = $_POST['photo_path'];
    $date = new DateTime();
    $recipeId=$date->getTimestamp().str_replace(" ", "", $title);
    $imgdat=null;

      if ($_FILES["upload"]["tmp_name"]!=null)
      {
        $fp = fopen($_FILES["upload"]["tmp_name"], "rb");
        if(!$fp)
        {
         print("cannot open file");
         exit;
        }
        $imgdat = fread($fp, filesize($_FILES["upload"]["tmp_name"]));
        fclose($fp);

        print("file size：{$_FILES["upfile"]["size"]}<BR>\n");
        $len = strlen($imgdat);
        print("data length = $len<BR>");

        $imgdat = addslashes($imgdat);
      }

      if($imgdat!=null){
        $photoPath="BLOB";
      }

    
    $dataArray = array(
      "id" => $recipeId,
      "title" => $title,
      "author" => $authorName,
      "ingredient" => '"'.$ingres.'"',
      "direction" => '"'.$direcs.'"',
      "photo_path" => '"'.$photoPath.'"',
      "photo" => $imgdat
    );

    $result = $wpdb->insert( $wpdb->recipes, $dataArray , array('%s', '%d'));

    $result = $wpdb->update($wpdb->recipes, array('title'=>$title), array('id'=>$recipeId));

    if ($result==1){
      ?><script type="text/javascript">

        window.location = '/recipes/';
        </script><?php
    }else if($result==0){
      echo $title;
      echo "data insertion failed";
    }else{
      echo $result;
    }

  }
}
add_shortcode('storeR', 'storeRecipe');

function setRecipe()
{
  include 'wp-load.php';
  global $wpdb;
  if(isset($_GET['id'])){
    $recId = $_GET['id'];

    $rows = $wpdb->get_results($wpdb->prepare("SELECT * FROM $wpdb->recipes WHERE ID =%s",$recId));

    $recipeName = $rows[0]->title;
    $authorName = $rows[0]->author;
    $ingres = str_replace('"', '', $rows[0]->ingredient);
    $direcs = str_replace('"', '', $rows[0]->direction);
    $photoPath = str_replace('"', '', $rows[0]->photo_path);
    ?>
    <script type="text/javascript">
    jQuery(document).ready(function ($) {

      $( ".card img" ).attr("src", "<?php echo $photoPath; ?>");
      $( ".card h4 span" ).text("<?php echo $authorName; ?>");
      $( ".recipe-name p" ).text("<?php echo $recipeName; ?>");
      $( ".ingrd ul" ).html("<?php echo $ingres; ?>");
      $( ".dirc ol" ).html("<?php echo $direcs; ?>");
      // $( ".card+a" ).attr("href","/add-new-recipe/create-a-recipe?id=<?php echo $recId; ?>");

    });
    </script>
    <?php
  }
}
add_shortcode('setRcp', 'setRecipe');


