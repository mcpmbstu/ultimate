<?php
/**
 * Twenty Fifteen functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @link https://codex.wordpress.org/Child_Themes
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * {@link https://codex.wordpress.org/Plugin_API}
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * @since Twenty Fifteen 1.0
 */
if ( ! isset( $content_width ) ) {
	$content_width = 660;
}

/**
 * Twenty Fifteen only works in WordPress 4.1 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '4.1-alpha', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
}

if ( ! function_exists( 'twentyfifteen_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 *
 * @since Twenty Fifteen 1.0
 */

function twentyfifteen_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on twentyfifteen, use a find and replace
	 * to change 'twentyfifteen' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'twentyfifteen', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * See: https://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 825, 510, true );

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu',      'twentyfifteen' ),
		'social'  => __( 'Social Links Menu', 'twentyfifteen' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
	) );

	/*
	 * Enable support for Post Formats.
	 *
	 * See: https://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'quote', 'link', 'gallery', 'status', 'audio', 'chat'
	) );

	$color_scheme  = twentyfifteen_get_color_scheme();
	$default_color = trim( $color_scheme[0], '#' );

	// Setup the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'twentyfifteen_custom_background_args', array(
		'default-color'      => $default_color,
		'default-attachment' => 'fixed',
	) ) );

	/*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, icons, and column width.
	 */
	//add_editor_style( array( 'css/editor-style.css', 'genericons/genericons.css', twentyfifteen_fonts_url() ) );
}
endif; // twentyfifteen_setup
add_action( 'after_setup_theme', 'twentyfifteen_setup' );

/**
 * Register widget area.
 *
 * @since Twenty Fifteen 1.0
 *
 * @link https://codex.wordpress.org/Function_Reference/register_sidebar
 */
function twentyfifteen_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Widget Area', 'twentyfifteen' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Add widgets here to appear in your sidebar.', 'twentyfifteen' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'twentyfifteen_widgets_init' );

if ( ! function_exists( 'twentyfifteen_fonts_url' ) ) :
/**
 * Register Google fonts for Twenty Fifteen.
 *
 * @since Twenty Fifteen 1.0
 *
 * @return string Google fonts URL for the theme.
 */
function twentyfifteen_fonts_url() {
	$fonts_url = '';
	$fonts     = array();
	$subsets   = 'latin,latin-ext';

	/*
	 * Translators: If there are characters in your language that are not supported
	 * by Noto Sans, translate this to 'off'. Do not translate into your own language.
	 */
	if ( 'off' !== _x( 'on', 'Noto Sans font: on or off', 'twentyfifteen' ) ) {
		$fonts[] = 'Noto Sans:400italic,700italic,400,700';
	}

	/*
	 * Translators: If there are characters in your language that are not supported
	 * by Noto Serif, translate this to 'off'. Do not translate into your own language.
	 */
	if ( 'off' !== _x( 'on', 'Noto Serif font: on or off', 'twentyfifteen' ) ) {
		$fonts[] = 'Noto Serif:400italic,700italic,400,700';
	}

	/*
	 * Translators: If there are characters in your language that are not supported
	 * by Inconsolata, translate this to 'off'. Do not translate into your own language.
	 */
	if ( 'off' !== _x( 'on', 'Inconsolata font: on or off', 'twentyfifteen' ) ) {
		$fonts[] = 'Inconsolata:400,700';
	}

	/*
	 * Translators: To add an additional character subset specific to your language,
	 * translate this to 'greek', 'cyrillic', 'devanagari' or 'vietnamese'. Do not translate into your own language.
	 */
	$subset = _x( 'no-subset', 'Add new subset (greek, cyrillic, devanagari, vietnamese)', 'twentyfifteen' );

	if ( 'cyrillic' == $subset ) {
		$subsets .= ',cyrillic,cyrillic-ext';
	} elseif ( 'greek' == $subset ) {
		$subsets .= ',greek,greek-ext';
	} elseif ( 'devanagari' == $subset ) {
		$subsets .= ',devanagari';
	} elseif ( 'vietnamese' == $subset ) {
		$subsets .= ',vietnamese';
	}

	if ( $fonts ) {
		$fonts_url = add_query_arg( array(
			'family' => urlencode( implode( '|', $fonts ) ),
			'subset' => urlencode( $subsets ),
		), 'https://fonts.googleapis.com/css' );
	}

	return $fonts_url;
}
endif;

/**
 * JavaScript Detection.
 *
 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
 *
 * @since Twenty Fifteen 1.1
 */
function twentyfifteen_javascript_detection() {
	echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}
add_action( 'wp_head', 'twentyfifteen_javascript_detection', 0 );

/**
 * Enqueue scripts and styles.
 *
 * @since Twenty Fifteen 1.0
 */
function twentyfifteen_scripts() {
	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 'twentyfifteen-fonts', twentyfifteen_fonts_url(), array(), null );

	// Add Genericons, used in the main stylesheet.
	wp_enqueue_style( 'genericons', get_template_directory_uri() . '/genericons/genericons.css', array(), '3.2' );

	// Load our main stylesheet.
	wp_enqueue_style( 'twentyfifteen-style', get_stylesheet_uri() );

	// Load the Internet Explorer specific stylesheet.
	wp_enqueue_style( 'twentyfifteen-ie', get_template_directory_uri() . '/css/ie.css', array( 'twentyfifteen-style' ), '20141010' );
	wp_style_add_data( 'twentyfifteen-ie', 'conditional', 'lt IE 9' );

	// Load the Internet Explorer 7 specific stylesheet.
	wp_enqueue_style( 'twentyfifteen-ie7', get_template_directory_uri() . '/css/ie7.css', array( 'twentyfifteen-style' ), '20141010' );
	wp_style_add_data( 'twentyfifteen-ie7', 'conditional', 'lt IE 8' );

	wp_enqueue_script( 'twentyfifteen-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20141010', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'twentyfifteen-keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20141010' );
	}

	wp_enqueue_script( 'twentyfifteen-script', get_template_directory_uri() . '/js/functions.js', array( 'jquery' ), '20150330', true );
	wp_localize_script( 'twentyfifteen-script', 'screenReaderText', array(
		'expand'   => '<span class="screen-reader-text">' . __( 'expand child menu', 'twentyfifteen' ) . '</span>',
		'collapse' => '<span class="screen-reader-text">' . __( 'collapse child menu', 'twentyfifteen' ) . '</span>',
	) );
}
add_action( 'wp_enqueue_scripts', 'twentyfifteen_scripts' );

/**
 * Add featured image as background image to post navigation elements.
 *
 * @since Twenty Fifteen 1.0
 *
 * @see wp_add_inline_style()
 */
function twentyfifteen_post_nav_background() {
	if ( ! is_single() ) {
		return;
	}

	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );
	$css      = '';

	if ( is_attachment() && 'attachment' == $previous->post_type ) {
		return;
	}

	if ( $previous &&  has_post_thumbnail( $previous->ID ) ) {
		$prevthumb = wp_get_attachment_image_src( get_post_thumbnail_id( $previous->ID ), 'post-thumbnail' );
		$css .= '
			.post-navigation .nav-previous { background-image: url(' . esc_url( $prevthumb[0] ) . '); }
			.post-navigation .nav-previous .post-title, .post-navigation .nav-previous a:hover .post-title, .post-navigation .nav-previous .meta-nav { color: #fff; }
			.post-navigation .nav-previous a:before { background-color: rgba(0, 0, 0, 0.4); }
		';
	}

	if ( $next && has_post_thumbnail( $next->ID ) ) {
		$nextthumb = wp_get_attachment_image_src( get_post_thumbnail_id( $next->ID ), 'post-thumbnail' );
		$css .= '
			.post-navigation .nav-next { background-image: url(' . esc_url( $nextthumb[0] ) . '); border-top: 0; }
			.post-navigation .nav-next .post-title, .post-navigation .nav-next a:hover .post-title, .post-navigation .nav-next .meta-nav { color: #fff; }
			.post-navigation .nav-next a:before { background-color: rgba(0, 0, 0, 0.4); }
		';
	}

	wp_add_inline_style( 'twentyfifteen-style', $css );
}
add_action( 'wp_enqueue_scripts', 'twentyfifteen_post_nav_background' );

/**
 * Display descriptions in main navigation.
 *
 * @since Twenty Fifteen 1.0
 *
 * @param string  $item_output The menu item output.
 * @param WP_Post $item        Menu item object.
 * @param int     $depth       Depth of the menu.
 * @param array   $args        wp_nav_menu() arguments.
 * @return string Menu item with possible description.
 */
function twentyfifteen_nav_description( $item_output, $item, $depth, $args ) {
	if ( 'primary' == $args->theme_location && $item->description ) {
		$item_output = str_replace( $args->link_after . '</a>', '<div class="menu-item-description">' . $item->description . '</div>' . $args->link_after . '</a>', $item_output );
	}

	return $item_output;
}
add_filter( 'walker_nav_menu_start_el', 'twentyfifteen_nav_description', 10, 4 );

/**
 * Add a `screen-reader-text` class to the search form's submit button.
 *
 * @since Twenty Fifteen 1.0
 *
 * @param string $html Search form HTML.
 * @return string Modified search form HTML.
 */
function twentyfifteen_search_form_modify( $html ) {
	return str_replace( 'class="search-submit"', 'class="search-submit screen-reader-text"', $html );
}
add_filter( 'get_search_form', 'twentyfifteen_search_form_modify' );

/**
 * Implement the Custom Header feature.
 *
 * @since Twenty Fifteen 1.0
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 *
 * @since Twenty Fifteen 1.0
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Customizer additions.
 *
 * @since Twenty Fifteen 1.0
 */
require get_template_directory() . '/inc/customizer.php';





/********************** CUSTOM SCRIPTS ALL ***************/
/**
 * Proper way to enqueue scripts and styles
 */
function ultimate_name_scripts() {
	wp_enqueue_style( 'font-awesome-ultimate', get_template_directory_uri() . '/css/font-awesome.min.css' );
	wp_enqueue_script( 'custom-ultimate-33', get_template_directory_uri() . '/js/modernizr.custom.js', array(), '1.0.0', false );
	wp_enqueue_script( 'bootstrap-ultimate', get_template_directory_uri() . '/js/bootstrap.min.js', array(), '3.3.6', false ); 
	//wp_enqueue_style( 'superfish-ultimate', get_template_directory_uri() . '/css/superfish.css' ); 
	wp_enqueue_script( 'ultimate-jquery.validate', get_template_directory_uri() . '/js/jquery.validate.js', array(), '3.3.6', false ); 
	wp_enqueue_script( 'bootstrap-ultimate-validator', get_template_directory_uri() . '/js/jquery.validate.bootstrap.popover.js', array(), '3.3.6', false );
	wp_enqueue_style( 'bootstrap-ultimate', get_template_directory_uri() . '/css/bootstrap.min.css' );
	wp_enqueue_style( 'bootstrap-ultimate-checkbox', get_template_directory_uri() . '/css/build.css' );	
	
	//wp_enqueue_style( 'ultimate-nanoscroller', get_template_directory_uri() . '/css/nanoscroller.css' );	
	
	
	wp_enqueue_style( 'custom-ultimate-map', get_template_directory_uri() . '/css/easyLocator.min.css' ); 
	wp_enqueue_script( 'custom-ultimate-easyLocator.min', get_template_directory_uri() . '/js/easyLocator.min.js', array(), '1.0.0', false );
	wp_enqueue_script( 'custom-ultimate-markerclusterer.min', get_template_directory_uri() . '/js/markerclusterer.min.js', array(), '1.0.0', false ); 
	wp_enqueue_style( 'custom-ultimate-datepicker', get_template_directory_uri() . '/css/datepicker.css' );
    wp_enqueue_script( 'bootstrap-ultimate-datepicker', get_template_directory_uri() . '/js/bootstrap-datepicker.js', array(), '3.3.6', false );
	wp_enqueue_script( 'bootstrap-ultimate-bootstrap-spinner.min', get_template_directory_uri() . '/js/bootstrap-spinner.min.js', array(), '3.3.6', false );
	wp_enqueue_script( 'bootstrap-ultimate-mousehold.min', get_template_directory_uri() . '/js/mousehold.min.js', array(), '3.3.6', false );
	
	
	//wp_enqueue_style( 'custom-ultimate-1', get_template_directory_uri() . '/css/ddmegamenu.css' );
	//wp_enqueue_script( 'custom-ultimate-1', get_template_directory_uri() . '/js/ddmegamenu.js', array(), '1.0.0', false ); 
	
	 
    wp_enqueue_script( 'custom-ultimate-accordion', get_template_directory_uri() . '/js/accordion.js', array(), '1.0.0', true );
	
	
	wp_enqueue_style( 'custom-ultimate-car', get_template_directory_uri() . '/owl-carousel/owl.carousel.css' );
	wp_enqueue_style( 'custom-ultimate-car1', get_template_directory_uri() . '/owl-carousel/owl.theme.css' );
	wp_enqueue_script( 'custom-ultimate-car2', get_template_directory_uri() . '/owl-carousel/owl.carousel.js', array(), '1.0.0', true ); 
	wp_enqueue_style( 'jquery.smartWizard', get_template_directory_uri() . '/css/demo_style.css' );
	wp_enqueue_script( 'jquery.smartWizard', get_template_directory_uri() . '/js/jquery.smartWizard.js', array(), '1.0.0', false );
	//wp_enqueue_script( 'jquery.nanoscroller', get_template_directory_uri() . '/js/jquery.nanoscroller.js', array(), '1.0.0', false );
	//wp_enqueue_script( 'jquery.nicescroll.min', get_template_directory_uri() . '/js/jquery.nicescroll.min.js', array(), '1.0.0', false );
	
 
	wp_enqueue_style( 'custom-ultimate-2', get_template_directory_uri() . '/css/component.css' );
	wp_enqueue_style( 'custom-ultimate', get_template_directory_uri() . '/css/custom.css' );
	
	wp_enqueue_script( 'custom-ultimate-2', get_template_directory_uri() . '/js/cbpHorizontalMenu.js', array(), '1.0.0', true ); 
	
	
	//wp_enqueue_style( 'custom-ultimate-222', get_template_directory_uri() . '/css/jquerysctipttop.css' );
	wp_enqueue_script( 'custom-ultimate-23', get_template_directory_uri() . '/js/responsive-tabs.js', array(), '1.0.0', true ); 
	//wp_enqueue_script( 'custom-ultimate-24', get_template_directory_uri() . '/js/jquery.animate-enhanced.min.js', array(), '1.0.0', true ); 
	//wp_enqueue_script( 'custom-ultimate-25', get_template_directory_uri() . '/js/jquery.superslides.js', array(), '1.0.0', true ); 
	
 	
	wp_enqueue_script( 'enscroll-0.6.2.min', get_template_directory_uri() . '/js/jquery.tinyscrollbar.js', array(), '3.3.6', false );
	wp_enqueue_script( 'custom-ultimate-3', get_template_directory_uri() . '/js/custom.js', array(), '1.0.0', true ); 
}

add_action( 'wp_enqueue_scripts', 'ultimate_name_scripts' );






require_once('aq_resizer.php');
//include_once('acf-wp-wysiwyg/acf-wp_wysiwyg.php');
function gallery_images_three_column($data){
	$arrays = explode(',', $data); //split string into array seperated by ', '
	$i=1;
	foreach($arrays as $id):	
	$attr['title'] = get_post($id)->post_title;
	$image_attributes = wp_get_attachment_image_src( $attachment_id = $id, 'full'); 
if ( $image_attributes ) : ?>
	<div class="col-xs-12 col-sm-4 col-md-4">
    	<a href="<?php echo $attr['title']; ?>" id="<?php echo 'ac'.$i; ?>" class="h-fadein"><img src="<?php echo $image_attributes[0]; ?>" class="img-responsive max-width" alt="" /></a>
    </div><!-- /.col-md-4 -->
<?php endif; ?>
<?php $i++; endforeach; ?>
<div style="clear: both; height: auto; overflow: hidden;"></div>
	<div class="col-md-12 ac1">
    	<div class="row">
            <div style="padding: 20px; background: #fff;">
                <?php 
                //clean_custom_menu(8); 
                $menu_items = wp_get_nav_menu_items(9);
                foreach( $menu_items as $menu_item ) {
                    $link = $menu_item->url;
                    $title = $menu_item->title;
                    //echo $title . '<br />';
                    echo '<div class="col-md-4">';
                    echo '<div class="accordion-bottom-border"><a href="'.$link.'" >' . $title . '</a></div>';
                    echo '</div>';
                }
                ?>   
               <div style="clear: both; height: auto; overflow:hidden; display: block;"></div> 
           </div><!-- /end div -->
        </div><!-- /.row -->
    </div><!-- /.col-md-12 -->
    <div class="col-md-12 ac2">
    <div class="row">
            <div style="padding: 20px; background: #fff;">
                <?php 
                //clean_custom_menu(8); 
                $menu_items = wp_get_nav_menu_items(10);
                foreach( $menu_items as $menu_item ) {
                    $link = $menu_item->url;
                    $title = $menu_item->title;
                    //echo $title . '<br />';
                    echo '<div class="col-md-4">';
                    echo '<div class="accordion-bottom-border"><a href="'.$link.'" >' . $title . '</a></div>';
                    echo '</div>';
                }
                ?>   
               <div style="clear: both; height: auto; overflow:hidden; display: block;"></div> 
           </div><!-- /end div -->
        </div><!-- /.row -->
    </div><!-- /.col-md-12 -->
		<script type="text/javascript">
			jQuery( document ).ready(function(){
				jQuery(".ac1, .ac2, .ac3").hide();
				//jQuery("#ac1").click(function(){
				jQuery("#ac1").off("click").on("click", function() {
					jQuery(".ac2, .ac3").hide();
					jQuery(".ac1").slideToggle();
					return false;
				});
				//jQuery("#ac2").click(function(){
					jQuery("#ac2").off("click").on("click", function() {
					jQuery(".ac1, .ac3").hide();
					jQuery(".ac2").slideToggle();
					return false;
				});
/*				jQuery("#ac3").click(function(){
					jQuery(".ac1, .ac2").hide();
					jQuery(".ac3").slideToggle();
					return false;
				});*/
			});
		</script>
<?php }



function gallery_images_no_column($data){
	$arrays = explode(',', $data); //split string into array seperated by ', '
	foreach($arrays as $id):	
	$attr['title'] = get_post($id)->post_title;
	$image_attributes = wp_get_attachment_image_src( $attachment_id = $id, 'full'); 
if ( $image_attributes ) : ?> 
    	<img src="<?php echo $image_attributes[0]; ?>" class="center" alt="" />
<?php endif; ?>
<?php endforeach;
		
}



function gallery_images_columns($data,$col){
	$arrays = explode(',', $data); //split string into array seperated by ', '
	foreach($arrays as $id):	
	$attr['title'] = get_post($id)->post_title;
	$image_attributes = wp_get_attachment_image_src( $attachment_id = $id, 'full'); 
if ( $image_attributes ) : ?>
	<div class="col-xs-6 col-sm-6 col-md-<?php echo $col; ?>">
    	<a href="<?php echo $attr['title']; ?>" class="h-fadein"><img src="<?php echo $image_attributes[0]; ?>" class="img-responsive max-width" alt="" /></a>
    </div><!-- /.col-md-4 -->
<?php endif; ?>
<?php endforeach;
		
}




// Extended caresual function
function caresual_ultimate( $atts ) {
    extract( shortcode_atts( array(
		'page_parent'	=> 55,
        'number' => '10'
    ), $atts) ); 
	$totalImg = get_template_directory_uri() . '/images/placeholder.jpg';
	$args = array(
		'post_type' => array( 'ut-package' )
	);
	
	$args = array(
		'post_type'      => 'page',
		'posts_per_page' => $number,
		'post_parent'    => $page_parent,
		'order'          => 'ASC',
		'orderby'        => 'menu_order'
	 );
	$the_query = new WP_Query( $args );
	// The Loop
	if ( $the_query->have_posts() ) {
		echo '<div id="mobilespace">        
				<div id="owl-demo">';
		while ( $the_query->have_posts() ) {
			$the_query->the_post();
			$thumb = get_post_thumbnail_id();
			if($thumb){
				$img_url = wp_get_attachment_url( $thumb,'full' ); //get full URL to image (use "large" or "medium" if the images too big)
				$image = aq_resize( $img_url, 400, 300, true ); //resize & crop the image
				echo '<div class="item">';	
				echo '<a href="'.get_permalink().'"><img src="'.$image.'" alt="'.get_the_title().'"></a>';			
				echo '<p class="text-center owl-title"><a href="'.get_permalink().'">'.get_the_title().'</a><span>'.get_field('short_text').'</span></p>';
				echo '</div>';
			}else{
				$img_url = $totalImg; //get full URL to image (use "large" or "medium" if the images too big)
				//$image = aq_resize( $img_url, 400, 300, true ); //resize & crop the image
				echo '<div class="item">';	
				echo '<a href="'.get_permalink().'"><img src="'.$img_url.'" alt="'.get_the_title().'"></a>';			
				echo '<p class="text-center owl-title"><a href="'.get_permalink().'">'.get_the_title().'</a><span>'.get_field('short_text').'</span></p>';
				echo '</div>';
			}
		}
		echo '</div><!-- /.owl-demo -->            
			</div><!-- /.mobilespace -->';
	} else {
		// no posts found
	}
	/* Restore original Post Data */
	wp_reset_postdata();
	?> 
    
    <script type="text/javascript">	
	jQuery(document).ready(function() {
			jQuery("#owl-demo").owlCarousel({	 
			  autoPlay: 3000, //Set AutoPlay to 3 seconds
			  navigation: true,
			  navigationText: [
			  "",
			  ""
			  ], 
			  pagination: true,
			  items : 4,
			  itemsDesktop : [1199,3],
			  itemsDesktopSmall : [979,3]		 
		  });	  
	  });
    </script>
<?php   
}
add_shortcode( 'ultimate-carasual', 'caresual_ultimate' );



/*// Extended caresual function
function caresual_ultimate( $atts ) {
    extract( shortcode_atts( array(
        'number' => '10'
    ), $atts) ); 
	
	$args = array(
		'post_type' => array( 'ut-package' )
	);
	
	$args = array(
		'post_type'      => 'page',
		'posts_per_page' => $number,
		'post_parent'    => $post->ID,
		'order'          => 'ASC',
		'orderby'        => 'menu_order'
	 );
	$the_query = new WP_Query( $args );
	// The Loop
	if ( $the_query->have_posts() ) {
		echo '<div id="mobilespace">        
				<div id="owl-demo">';
		while ( $the_query->have_posts() ) {
			$the_query->the_post();
			$thumb = get_post_thumbnail_id();
			$img_url = wp_get_attachment_url( $thumb,'full' ); //get full URL to image (use "large" or "medium" if the images too big)
			$image = aq_resize( $img_url, 400, 300, true ); //resize & crop the image
			echo '<div class="item">';	
			echo '<a href="#"><img src="'.$image.'" alt="'.get_the_title().'"></a>';			
			echo '<p class="text-center owl-title"><a href="#">'.get_the_title().'</a><span>'.get_the_title().'</span></p>';
			echo '</div>';
		}
		echo '</div><!-- /.owl-demo -->            
			</div><!-- /.mobilespace -->';
	} else {
		// no posts found
	}
	/* Restore original Post Data 
	wp_reset_postdata();
	?> 
    
    <script type="text/javascript">	
	jQuery(document).ready(function() {
			jQuery("#owl-demo").owlCarousel({	 
			  autoPlay: 3000, //Set AutoPlay to 3 seconds
			  navigation: true,
			  navigationText: [
			  "",
			  ""
			  ], 
			  pagination: true,
			  items : 4,
			  itemsDesktop : [1199,3],
			  itemsDesktopSmall : [979,3]		 
		  });	  
	  });
    </script>
<?php   
}
add_shortcode( 'ultimate-carasual', 'caresual_ultimate' );*/





function truncate($str, $width) {
    return strtok(wordwrap($str, $width, "...\n"), "\n");
}

add_filter( 'post_type_archive_link', function( $link, $post_type ) {

    //Do something

    return $link;

}, 10, 2 );


/*function list_page_ultimate( $atts ) {
	extract( shortcode_atts( array(
        'number' => '5',
		'category' = '',
    ), $atts) ); 
	
	$args = array(
		'post_type' => array( 'ut-package' )
	);
	$the_query = new WP_Query( $args );
}

add_shortcode( 'ultimate-list-pages', 'list_page_ultimate' );*/





function ultimate_one_one( $atts, $content = null ) {
	extract( shortcode_atts( array(
        'class' => 'class-p'
    ), $atts) ); 
	
   return '<div class="col-md-1 '.$class.'">' . do_shortcode($content) . '</div>';
}
add_shortcode('col_one', 'ultimate_one_one');
 
function ultimate_two_two( $atts, $content = null ) {
	extract( shortcode_atts( array(
        'class' => 'class-p'
    ), $atts) );
   return '<div class="col-md-2 '.$class.'">' . do_shortcode($content) . '</div>';
}
add_shortcode('col_two', 'ultimate_two_two');
 
function ultimate_three_three( $atts, $content = null ) {
	extract( shortcode_atts( array(
        'class' => 'class-p'
    ), $atts) );
   return '<div class="col-md-33 '.$class.'">' . do_shortcode($content) . '</div>';
}
add_shortcode('col_three', 'ultimate_three_three');
 
function ultimate_four_four( $atts, $content = null ) {
	extract( shortcode_atts( array(
        'class' => 'class-p'
    ), $atts) );
   return '<div class="col-md-4 '.$class.'">' . do_shortcode($content) . '</div>';
}
add_shortcode('col_four', 'ultimate_four_four');
 
function ultimate_five_five( $atts, $content = null ) {
	extract( shortcode_atts( array(
        'class' => 'class-p'
    ), $atts) );
   return '<div class="col-md-5 '.$class.'">' . do_shortcode($content) . '</div>';
}
add_shortcode('col_five', 'ultimate_five_five');
 
function ultimate_six_six( $atts, $content = null ) {
	extract( shortcode_atts( array(
        'class' => 'class-p'
    ), $atts) );
	extract( shortcode_atts( array(
        'class' => 'class-p'
    ), $atts) );
   return '<div class="col-md-6 '.$class.'">' . do_shortcode($content) . '</div>';
}
add_shortcode('col_six', 'ultimate_six_six');
 
function ultimate_seven_seven( $atts, $content = null ) {
	extract( shortcode_atts( array(
        'class' => 'class-p'
    ), $atts) );
   return '<div class="col-md-7 '.$class.'">' . do_shortcode($content) . '</div>';
}
add_shortcode('col_seven', 'ultimate_seven_seven');
 
function ultimate_eight_eight( $atts, $content = null ) {
	extract( shortcode_atts( array(
        'class' => 'class-p'
    ), $atts) );
   return '<div class="col-md-8 '.$class.'">' . do_shortcode($content) . '</div>';
}
add_shortcode('col_eight', 'ultimate_eight_eight');

function ultimate_nine_nine( $atts, $content = null ) {
	extract( shortcode_atts( array(
        'class' => 'class-p'
    ), $atts) );
   return '<div class="col-md-9 '.$class.'">' . do_shortcode($content) . '</div>';
}
add_shortcode('col_nine', 'ultimate_nine_nine');

function ultimate_ten_ten( $atts, $content = null ) {
	extract( shortcode_atts( array(
        'class' => 'class-p'
    ), $atts) );
   return '<div class="col-md-10 '.$class.'">' . do_shortcode($content) . '</div>';
}
add_shortcode('col_ten', 'ultimate_ten_ten');

function ultimate_eleven_eleven( $atts, $content = null ) {
	extract( shortcode_atts( array(
        'class' => 'class-p'
    ), $atts) );
   return '<div class="col-md-11 '.$class.'">' . do_shortcode($content) . '</div>';
}
add_shortcode('col_eleven', 'ultimate_eleven_eleven');

function ultimate_twelve_twelve( $atts, $content = null ) {
	extract( shortcode_atts( array(
        'class' => 'class-p'
    ), $atts) );
   return '<div class="col-md-12 '.$class.'">' . do_shortcode($content) . '</div>';
}
add_shortcode('col_twelve', 'ultimate_twelve_twelve');


function ultimate_blank_space( $atts, $content = null ) {
	extract( shortcode_atts( array(
        'height' => ''
    ), $atts) );
   return '<div style="width: 100%; height:'.$height.'px; display: block;" ></div>';
}
add_shortcode('col_blank_space', 'ultimate_blank_space');

function ultimate_custom_heading( $atts, $content = null ) {
	extract( shortcode_atts( array(
        'size' 		=> '20',
		'title'		=> '',
		'class'		=> ''
    ), $atts) );
   return '<h3 class="'.$class.'" style="font-size:'.$size.'px; display: block; margin-bottom: 15px;" >'.$title.'</h3>';
}
add_shortcode('col_custom_heading', 'ultimate_custom_heading');


 
 
function webtreats_formatter($content) {
	$new_content = '';
	
	/* Matches the contents and the open and closing tags */
	$pattern_full = '{(\[raw\].*?\[/raw\])}is';
	
	/* Matches just the contents */
	$pattern_contents = '{\[raw\](.*?)\[/raw\]}is';
	
	/* Divide content into pieces */
	$pieces = preg_split($pattern_full, $content, -1, PREG_SPLIT_DELIM_CAPTURE);
	
	/* Loop over pieces */
	foreach ($pieces as $piece) {
		/* Look for presence of the shortcode */
		if (preg_match($pattern_contents, $piece, $matches)) {
			
			/* Append to content (no formatting) */
			$new_content .= $matches[1];
		} else {
			
			/* Format and append to content */
			$new_content .= wptexturize(wpautop($piece));		
		}
	}
	
	return $new_content;
}
 
// Remove the 2 main auto-formatters
remove_filter('the_content', 'wpautop');
remove_filter('the_content', 'wptexturize');
 
// Before displaying for viewing, apply this function
add_filter('the_content', 'webtreats_formatter', 99);
add_filter('widget_text', 'webtreats_formatter', 99);

//Long posts should require a higher limit, see http://core.trac.wordpress.org/ticket/8553
@ini_set('pcre.backtrack_limit', 500000);





/*******************
CUSTOM WIDGET AREA
***********************************/
function ultimate_widget_loop(){ 
	if ( function_exists( 'ot_get_option' ) ) { 
			  $numbers = ot_get_option( 'number_of_footer_menu'); 
			}
	
	if($numbers !=0){
		for($r=0;$r<$numbers;$r++){ 
			if($r==0){ $q+=1;	
			}else{ $q=$r;	
			}
			
			$column_number = 12/$numbers;
			register_sidebar( array(
				'name' => __( "Footer Sider $q", 'wpb' ),
				'id' => 'sidebar-'.$r.'',
				'description' => __( 'The footer sidebar appears on the footer in every page', 'ultimate' ),
				'before_widget' => '<div id="%1$s" class="widget %2$s col-xs-12 footer-widget-'.$r.' col-md-'.$column_number.'"><div class="footer-widget-box"><div class="footer-widget-body">',
				'after_widget' => '</div></div></div>',
				'before_title' => '<h3 class="widget-title footer-widget-title">',
				'after_title' => '</h3>',
			) ); 
		}
	}
}

add_action( 'widgets_init', 'ultimate_widget_loop' );


function ultimate_widgets($numbers){
	if($numbers !=0){
		for($r=0;$r<=$numbers;$r++){ 
			dynamic_sidebar('sidebar-'.$r.'');
		}
	} ?>
    
    
    
<?php }

function social_icons($icon_name){
	$html = '';
	switch ($icon_name) {
    case "Facebook": 
		$html ='<i class="fa fa-facebook fa-fw fa-2x fa-base-red"></i>';
        break;
	case "Twitter": 
		$html ='<i class="fa fa-twitter fa-fw fa-2x fa-base-red"></i>';
        break; 
	case "LinkedIn": 
		$html ='<i class="fa fa-linkedin fa-fw fa-2x fa-base-red"></i>';
        break; 
	case "Instagram": 
		$html ='<i class="fa fa-instagram fa-fw fa-2x fa-base-red"></i>';
        break;	
	case "Youtube": 
		$html ='<i class="fa fa-youtube-square fa-fw fa-2x fa-base-red"></i>';
        break; 						 
    default:
        break;
}

return $html;	
}


function ultimate_mega_menu(){ ?>
	<?php
		if ( function_exists( 'ot_get_option' ) ) { 
		  $top_menu_settings = ot_get_option( 'top_menu_settings'); 
		  $site_logo = ot_get_option( 'site_logo'); 
		  $myString = $top_menu_settings;
		  $myArray = explode(',', $myString); 
		}
	echo '<ul>';
	echo '<li class="logo-list"><a href="'.site_url().'"><img src="'.$site_logo.'" class="site-logo" alt="" /></a></li>';
	  for($x=0;$x<count($myArray);$x++){
		  echo '<li><a href="'.site_url().'">'.get_the_title( $myArray[$x] ).'</a>';
		  $children = wp_list_pages('title_li=&child_of='.$myArray[$x].'&echo=0&depth=-1');
		  echo '<div class="cbp-hrsub"><div class="cbp-hrsub-inner">';
		  echo '<h4 class="menu-header">'.get_the_title( $myArray[$x] ).'</h4>';
		  if ($children) { ?> 
              <ul class="immer-page-list">
                <?php echo $children; ?>
              </ul> 
              <?php } ?>
              </div><!-- /.cbp-hrsub-inner --></div><!-- /.cbp-hrsub -->
          </li>
	  <?php } ?>
      
    </ul> 
     
<?php }


function ultimate_responsive_menu(){
	if ( function_exists( 'ot_get_option' ) ) { 
	  $top_menu_settings = ot_get_option( 'top_menu_settings'); 
	  $site_logo = ot_get_option( 'site_logo'); 
	  $myString = $top_menu_settings;
	  $myArray = explode(',', $myString); 
	}
	
	echo '<ul class="nav navbar-nav mega-responsive">';
		for($x=0;$x<count($myArray);$x++){
			$children = wp_list_pages('title_li=&child_of='.$myArray[$x].'&echo=0&depth=-1');			
			if ($children) {
				echo '<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">'.get_the_title( $myArray[$x] ).' <i class="fa fa-chevron-down fa-fw fa-base-red fa-pos"></i></a>';
				echo '<ul class="dropdown-menu">';
                	echo $children;
                echo '</ul></li>'; 	
			}
		}
	echo '</ul>';
}



/********************
CUSTOM FORM BUILDER
********************************/

function ultimate_package_form( $atts ) {
	extract( shortcode_atts( array(
		'wrap'				=> 1,
		'wrap_title'		=> '',
		'wrap_sub_title'	=> '',
        'form_title' 		=> ''
    ), $atts) ); ?>
    
    
    <?php if($wrap == 1){ ?>
    <div class="form-div-block" id="experienceBuilder">
        <div class="container class-transparent">
             <div class="row">
                 <div class="col-xs-12">
                        <h2 class="text-center text-uppercase white-text">
                           <?php echo $wrap_title; ?>
                            <span class="h2-subtitle white-text opacity70"><?php echo $wrap_sub_title; ?></span>
                        </h2>
                    </div><!-- /.col-xs-12 -->
                    <?php //echo do_shortcode('[ultimate-package-form title="Whata are you looking for ?"]'); ?>
    <div class="col-xs-12">  
         <div class="steps">
            <ul class="blue 5steps">
                <li class="completed"><a href="#" class="stepBlox-1"><span class="visible-xs-block visible-sm-block">1</span><span class="hidden-xs">1. &nbsp;&nbsp;&nbsp;Step One</span></a></li>
                <li class="completedLast"><a href="#" class="stepBlox-2"><span class="visible-xs-block visible-sm-block">2</span><span class="hidden-xs">2. &nbsp;&nbsp;&nbsp;Step Two</span></a></li>
                <li class="current"><a href="#" class="stepBlox-3"><span class="visible-xs-block visible-sm-block">3</span><span class="hidden-xs">3. &nbsp;&nbsp;&nbsp;Step Three</span></a></li>
                <li class=""><a href="#" class="stepBlox-4"><span class="visible-xs-block visible-sm-block">4</span><span class="hidden-xs">4. &nbsp;&nbsp;&nbsp;Step Four</span></a></li>
                <li class="end"><a href="#" class="stepBlox-5"><span class="visible-xs-block visible-sm-block">5</span><span class="hidden-xs">5. &nbsp;&nbsp;&nbsp;Step Five</span></a></li>
            </ul>
        </div>
        <span style="clear:both; display:block;">&nbsp;</span>
 	</div><!-- /.col-xs-12 -->
    
    <div class="col-xs-12"> 
        <h4 class="text-center nav-darkblue h4-padding hide-on-click"><?php echo $form_title; ?></h4>
    </div><!-- /.col-xs-12 -->
	<form id="steps-forms" method="post" action="" accept-charset="UTF-8">
    <input type="hidden" id="site_url_ajax" value="<?php echo get_template_directory_uri (); ?>/ajax-form-build.php" />
    <div class="col-xs-12">
        <div class="row stepBoxHolder"> 
            <div class="stepBlox stepBlox-1">
                <div class="col-lg-2 col-md-4 col-sm-4 col-xs-6 thumb">
                    <a class="thumbnail new-thumb step1-click" onclick="jQuery('.steps').steps('next');" href="#" name="Residentials">
                        <img class="img-responsive" src="<?php echo get_template_directory_uri(); ?>/images/step1.png" alt="" />
                    </a>
                    <h4 class="form-select-title">Residentials</h4>
                    <p class="form-select-para">Activities &amp; Accommodation</p>
                </div>
                <div class="col-lg-2 col-md-4 col-sm-4 col-xs-6 thumb">
                    <a class="thumbnail new-thumb step1-click" onclick="jQuery('.steps').steps('next');" href="#" name="Day Trips">
                        <img class="img-responsive" src="<?php echo get_template_directory_uri(); ?>/images/step2.png" alt="" />
                    </a>
                    <h4 class="form-select-title">Day Trips</h4>
                    <p class="form-select-para">Maximise your day</p>
                </div>
                <div class="col-lg-2 col-md-4 col-sm-4 col-xs-6 thumb">
                    <a class="thumbnail new-thumb step1-click" onclick="jQuery('.steps').steps('next');" href="#" name="Team Building">
                        <img class="img-responsive" src="<?php echo get_template_directory_uri(); ?>/images/step3.png" alt="" />
                    </a>
                    <h4 class="form-select-title">Team Building</h4>
                    <p class="form-select-para">Motivate, Inspire, Communicate &amp; Enjoy</p>
                </div>
                <div class="col-lg-2 col-md-4 col-sm-4 col-xs-6 thumb">
                    <a class="thumbnail new-thumb step1-click" onclick="jQuery('.steps').steps('next');" href="#" name="Adventure Stag Dos">
                        <img class="img-responsive" src="<?php echo get_template_directory_uri(); ?>/images/step4.png" alt="" />
                    </a>
                    <h4 class="form-select-title">Adventure Stag Dos</h4>
                    <p class="form-select-para">No Limits, Adrenaline &amp; Memories</p>
                </div>
                <div class="col-lg-2 col-md-4 col-sm-4 col-xs-6 thumb">
                    <a class="thumbnail new-thumb step1-click" onclick="jQuery('.steps').steps('next');" href="#" name="Adventure Hen Dos">
                        <img class="img-responsive" src="<?php echo get_template_directory_uri(); ?>/images/step5.png" alt="" />
                    </a>
                    <h4 class="form-select-title">Adventure Hen Dos</h4>
                    <p class="form-select-para">Adventures to let your hair down.</p>
                </div>
                <div class="col-lg-2 col-md-4 col-sm-4 col-xs-6 thumb">
                    <a class="thumbnail new-thumb step1-click" onclick="jQuery('.steps').steps('next');" href="#" name="Birthdays">
                        <img class="img-responsive" src="<?php echo get_template_directory_uri(); ?>/images/step6.png" alt="" />
                    </a>
                    <h4 class="form-select-title">Birthdays</h4>
                    <p class="form-select-para">For the young &amp; young at heart</p>
                </div>
            	<input type="hidden" name="steps_package_name" id="steps_package_name" />
            </div><!-- /.stepBlox-1 -->
            <div class="stepBlox stepBlox-2">
            	<div class="col-xs-12 col-md-3">
                	<p>Tell us your approximate <strong>group size?</strong></p>
                    <div class="form-group has-feedback"> 
                        <input type="tel" name="step_2_number" class="required form-control" id="step_2_number" placeholder="Enter Number" data-popover-position="top"   /> 
                    </div><!-- /.form-group -->
                    <p class="text-center"><strong>Choose your Activities:</strong><br />
                    They range from £5 -£30pp</p> 
                    <p class="text-center"><img src="<?php echo get_template_directory_uri(); ?>/images/form-step-2-img.png" class="img-responsive" style="margin: auto;" alt="" /></p>
                </div><!-- /.col-md-2 -->
                <div class="col-xs-12 col-md-9">
                	<p>In a Few words tell us what <strong>sort of adventure</strong> you are looking for? </p>
                    <div class="form-group">  
                            <textarea class="required form-control" name="step_2_message" id="step_2_message" rows="3" placeholder="Write your message..."></textarea>
					</div><!-- /.form-group -->
                    <div class="row">
                    	<div class="col-xs-12 col-md-4">
                        	<h4 style="color: #fff;">Recommended Activites</h4>
                              <div class="checkbox checkbox-primary">
                                <input type="checkbox" name="recomanded[]" value="Ultimate Assault">
                                <label>Ultimate Assault</label>
                              </div><!-- /.checkbox -->
                              <div class="checkbox checkbox-primary">
                                <input type="checkbox" name="recomanded[]" value="Awesome 4some">
                                <label>Awesome 4some</label>
                              </div><!-- /.checkbox -->
                              <div class="checkbox checkbox-primary">
                                <input type="checkbox" name="recomanded[]" value="Coasteering">
                                <label>Coasteering</label>
                              </div><!-- /.checkbox -->
                        </div><!-- /.col-md-4 -->
                        <div class="col-xs-12 col-md-4">
                        	<h4 style="color: #fff;">Additional Activites</h4>
                            <div class="checkbox checkbox-primary">
                                <input type="checkbox" name="additional[]" value="Laser Tag">
                                <label>Laser Tag</label>
                              </div><!-- /.checkbox -->
                              <div class="checkbox checkbox-primary">
                                <input type="checkbox" name="additional[]" value="Mountain Boarding">
                                <label>Mountain Boarding</label>
                              </div><!-- /.checkbox -->
                              <div class="checkbox checkbox-primary">
                                <input type="checkbox" name="additional[]" value="Surfing">
                                <label>Surfing</label>
                              </div><!-- /.checkbox -->
                              <div class="checkbox checkbox-primary">
                                <input type="checkbox" name="additional[]" value="Water Zorbing">
                                <label>Water Zorbing</label>
                              </div><!-- /.checkbox -->
                        </div><!-- /.col-md-4 -->
                        <div class="col-xs-12 col-md-4">
                        	<h4 style="color: #fff;">Meals Required</h4>
                            <div class="checkbox checkbox-primary">
                                <input type="checkbox" name="meals[]" value="Breakfast">
                                <label>Breakfast</label>
                              </div><!-- /.checkbox -->
                              <div class="checkbox checkbox-primary">
                                <input type="checkbox" name="meals[]" value="Lunch">
                                <label>Lunch</label>
                              </div><!-- /.checkbox -->
                              <div class="checkbox checkbox-primary">
                                <input type="checkbox" name="meals[]" value="Dinner">
                                <label>Dinner</label>
                              </div><!-- /.checkbox -->
                        </div><!-- /.col-md-4 -->
                    </div><!-- /.row -->
                </div><!-- /.col-md-10 --> 
                    <div class="col-xs-12 col-md-12">
                    	<?php echo do_shortcode('[col_blank_space height="20"]'); ?>
                        <div class="form-group red-block">        
                        <button type="submit" name="submit" value="submit" class="btn submit-btn btn-submit clickStatus2prev beforeFirst"  ><i class="fa fa-chevron-left" style="color: #e44e4e;"></i>&nbsp;&nbsp; Previous Step</button>&nbsp;&nbsp;                     		<button type="submit" name="submit" value="submit" class="btn submit-btn btn-submit clickStatus2next"   >Next Step &nbsp;&nbsp;<i class="fa fa-chevron-right" style="color: #e44e4e;"></i></button>
                    </div><!-- /.red-block -->
                    </div> 
            </div><!-- /.stepBlox-2 -->
            <div class="stepBlox stepBlox-3">
            	<div class="col-xs-12 col-md-4">
                <div class="row visible-on"> <?php echo do_shortcode('[col_blank_space height="20"]'); ?></div><!-- /.row -->
                <p><strong>When</strong> would you like to stay?</p>
                	<div id="dp6" data-date="<?php echo date("m-d-Y"); ?>" data-date-format="mm-dd-yyyy"></div>
                    <input type="hidden" name="step_3_night_date"  id="step_3_night_date" value="<?php echo date("m-d-Y"); ?>" />
                </div><!-- /. col-md-5 -->
                <div class="col-xs-12 col-md-3">
                <div class="row visible-on"><?php echo do_shortcode('[col_blank_space height="20"]'); ?></div><!-- /.row -->
                	<p class="text-center"><strong>Number of nights stay</strong></p>
                    <div class="form-group has-feedback"> 
                        <input type="text" name="step_3_night_stay" class="required form-control" id="step_3_night_stay" placeholder="Enter Number" data-popover-position="top"> 
                    </div><!-- /.form-group -->
                    <p style="margin-top: 25px;"><img src="<?php echo get_template_directory_uri(); ?>/images/form-step-3-img1.png" class="img-responsive" style="margin: auto;"  alt="" /></p>
                    <p><strong>Flexibility of date?</strong><br />
                    Plus or Minus<br />
                    how many days?</p>
                    
                    <div class="input-group">
                        <span class="input-group-btn">
                            <button type="button" class="btn btn-default basecolor" data-value="decrease" data-target="#spinner" data-toggle="spinner">
                                <span class="glyphicon glyphicon-minus"></span>
                            </button>
                        </span>
                        <input type="text" name="step_3_many_days" data-ride="spinner" id="spinner" class="form-control input-number" value="1">
                        <span class="input-group-btn">
                            <button type="button" class="btn btn-default basecolor" data-value="increase" data-target="#spinner" data-toggle="spinner">
                                <span class="glyphicon glyphicon-plus"></span>
                            </button>
                        </span>
                    </div><!-- /.input-group -->

                </div><!-- /. col-md-5 -->
                <div class="col-xs-12 col-md-5">
                <div class="row visible-on"><?php echo do_shortcode('[col_blank_space height="20"]'); ?></div><!-- /.row -->
                	<p>Notes \ Questions \ Requests ?</p>
                    <div class="form-group">  
                            <textarea class="form-control" name="step_3_text_notes" id="step_3_text_notes" rows="10" placeholder="Write your message..." style="min-height: 264px;"></textarea>
					</div><!-- /.form-group -->
                </div><!-- /. col-md-5 --> 
                	<div class="col-xs-12">
                    	<?php echo do_shortcode('[col_blank_space height="30"]'); ?>
                    	<div class="form-group red-block">        
                            <button type="submit" name="submit" value="submit" class="btn submit-btn btn-submit clickStatus3prev"  ><i class="fa fa-chevron-left" style="color: #e44e4e;"></i>&nbsp;&nbsp; Previous Step</button>&nbsp;&nbsp;                     		<button type="submit" name="submit" value="submit" class="btn submit-btn btn-submit clickStatus3next" >Next Step &nbsp;&nbsp;<i class="fa fa-chevron-right" style="color: #e44e4e;"></i></button>
                        </div><!-- /.red-block -->
                    </div> 
            </div><!-- /.stepBlox-3 -->
            <div class="stepBlox stepBlox-4"> 
                	<div class="col-xs-12 col-md-6">
                    	<p><strong>Now let us do all the hard work. </strong></p>
                        <p>We will review your requirements and 	come back to you shortly with the perfect adventure for you.</p>
						<p>Please complete your contact details so we send it you.</p>
                        <p style="margin-top: 25px;"><img src="<?php echo get_template_directory_uri(); ?>/images/form-step-4-img.png" class="img-responsive" alt="" /></p>
                    </div><!-- /.col-md-6 -->
                    <div class="col-xs-12 col-md-6">
                    	<div class="row">
                        	<div class="col-xs-12 col-md-6">
                            	<p><strong>Name</strong></p>
                                <div class="form-group has-feedback"> 
                                    <input type="text" name="step_4_first_name" class="required form-control" id="step_4_first_name" placeholder="First Name" data-popover-position="top" /> 
                                </div><!-- /.form-group -->
                            </div><!-- /.col-md-6 -->
                            <div class="col-xs-12 col-md-6">
                            	<p>&nbsp;</p>
                                <div class="form-group has-feedback"> 
                                    <input type="text" name="step_4_last_name" class="required form-control" id="step_4_last_name" placeholder="Last Name" data-popover-position="top" /> 
                                </div><!-- /.form-group -->
                            </div><!-- /.col-md-6 -->
                            <div class="col-xs-12 col-md-12">
                            	<p><strong>Telephone / Mobile Number:</strong></p>
                                <div class="form-group has-feedback"> 
                                    <input type="tel" name="ut_step4_telephone" class="form-control" id="ut_step4_telephone" placeholder="Telephone / Mobile Number" data-popover-position="top" /> 
                                </div><!-- /.form-group -->
                            </div><!-- /.col-md-12 -->
                            <div class="col-xs-12 col-md-12">
                            	<p><strong>Email Address:</strong></p>
                                <div class="form-group has-feedback"> 
                                    <input type="email" name="step_4_email" class="required form-control" id="step_4_email" placeholder="Email Address" data-popover-position="top" /> 
                                </div><!-- /.form-group -->
                            </div><!-- /.col-md-12 -->
                        </div><!-- /.row -->
                    </div><!-- /.col-md-6 --> 
            		<div class="col-xs-12">
                    	<?php echo do_shortcode('[col_blank_space height="30"]'); ?>
                    	<div class="form-group red-block">        
                            <button type="submit" name="submit" value="submit" class="btn submit-btn btn-submit clickStatus4prev" ><i class="fa fa-chevron-left" style="color: #e44e4e;"></i>&nbsp;&nbsp; Previous Step</button>&nbsp;&nbsp;                     		<button type="submit" name="submit" value="submit" class="btn submit-btn btn-submit clickStatus4next finishSubmit" >Create my adventure &nbsp;&nbsp;<i class="fa fa-chevron-right" style="color: #e44e4e;"></i></button>
                        </div><!-- /.red-block -->
                    </div>
            </div><!-- /.stepBlox-4 -->
            <div class="stepBlox stepBlox-5">
            	<div class="col-xs-12 text-center">
                	<p style="margin-top: 25px;"><img src="<?php echo get_template_directory_uri(); ?>/images/thankyou.png" class="img-responsive" style="margin: auto;" alt="" /></p>
                    <?php
						if ( function_exists( 'ot_get_option' ) ) {
						  $thank_you_message_for_perfect_adventure = ot_get_option( 'thank_you_message_for_perfect_adventure' ); 
						  $company_email = ot_get_option( 'company_email' ); 
						  $booking_number = ot_get_option( 'booking_number' ); 
						}
					?>
                  <p>
                    	<?php echo $thank_you_message_for_perfect_adventure; ?><br />
						<strong>Call:</strong> <?php echo $booking_number; ?> or <strong>Email us</strong> <a href="mailTo:<?php echo $company_email; ?>" style="color: #95c3ed;">here</a> <i class="fa fa-chevron-right" style="color: #fff;"></i></p>
                </div><!-- /.col-xs-12 -->
            </div><!-- /.stepBlox-5 -->            
        </div><!-- /.row-->
    </div><!-- /.col-xs-12 -->
    </form>    
 <!-- Modal -->
 <div class="modal fade" id="contactFormModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content modal-content-no-radious">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button> 
                      </div><!-- /.modal-header -->
                      <div class="modal-body">
                        <div id="bookForm1"></div><!-- /bookForm -->
                        <?php // $is_captcha_corrent = MyCaptcha::verify(); 
						//echo $is_captcha_corrent;	 ?>
                      </div><!-- /.modal-body -->
                      <div class="modal-footer" style="text-align:center;">
                        <button type="button" class="btn btn-primary btn-block btn-ut-color" data-dismiss="modal">CLOSE</button> 
                      </div><!-- /.modal-footer -->
                    </div><!-- /.modal-content -->
                  </div><!-- /.modal-dialog-->
                </div>
 <!-- /.modal -->               
				</div><!-- /.row -->
            <div class="spacebar50"></div><!-- /.spacebar50 -->
        </div><!-- /.container -->
    </div><!-- /.form-div-block -->
	<?php }else{ ?> 
    
    <div class="col-xs-12">  
         <div class="steps">
            <ul class="blue 5steps">
                <li class="completed"><a href="#" class="stepBlox-1"><span class="visible-xs-block visible-sm-block">1</span><span class="hidden-xs">1. &nbsp;&nbsp;&nbsp;Step One</span></a></li>
                <li class="completedLast"><a href="#" class="stepBlox-2"><span class="visible-xs-block visible-sm-block">2</span><span class="hidden-xs">2. &nbsp;&nbsp;&nbsp;Step Two</span></a></li>
                <li class="current"><a href="#" class="stepBlox-3"><span class="visible-xs-block visible-sm-block">3</span><span class="hidden-xs">3. &nbsp;&nbsp;&nbsp;Step Three</span></a></li>
                <li class=""><a href="#" class="stepBlox-4"><span class="visible-xs-block visible-sm-block">4</span><span class="hidden-xs">4. &nbsp;&nbsp;&nbsp;Step Four</span></a></li>
                <li class="end"><a href="#" class="stepBlox-5"><span class="visible-xs-block visible-sm-block">5</span><span class="hidden-xs">5. &nbsp;&nbsp;&nbsp;Step Five</span></a></li>
            </ul>
        </div>
        <span style="clear:both; display:block;">&nbsp;</span>
 	</div><!-- /.col-xs-12 -->
    
    <div class="col-xs-12"> 
        <h4 class="text-center nav-darkblue h4-padding hide-on-click"><?php echo $form_title; ?></h4>
    </div><!-- /.col-xs-12 -->
	<form id="steps-forms" method="post" action="" accept-charset="UTF-8">
    <input type="hidden" id="site_url_ajax" value="<?php echo get_template_directory_uri (); ?>/ajax-form-build.php" />
    <div class="col-xs-12">
        <div class="row stepBoxHolder"> 
            <div class="stepBlox stepBlox-1">
                <div class="col-lg-2 col-md-4 col-sm-4 col-xs-6 thumb">
                    <a class="thumbnail new-thumb step1-click" onclick="jQuery('.steps').steps('next');" href="#" name="Residentails">
                        <img class="img-responsive" src="<?php echo get_template_directory_uri(); ?>/images/step1.png" alt="" />
                    </a>
                    <h4 class="form-select-title">Residentails</h4>
                    <p class="form-select-para">Activities &amp; Accommodation</p>
                </div>
                <div class="col-lg-2 col-md-4 col-sm-4 col-xs-6 thumb">
                    <a class="thumbnail new-thumb step1-click" onclick="jQuery('.steps').steps('next');" href="#" name="Day Trips">
                        <img class="img-responsive" src="<?php echo get_template_directory_uri(); ?>/images/step2.png" alt="" />
                    </a>
                    <h4 class="form-select-title">Day Trips</h4>
                    <p class="form-select-para">Maximise your day</p>
                </div>
                <div class="col-lg-2 col-md-4 col-sm-4 col-xs-6 thumb">
                    <a class="thumbnail new-thumb step1-click" onclick="jQuery('.steps').steps('next');" href="#" name="Team Building">
                        <img class="img-responsive" src="<?php echo get_template_directory_uri(); ?>/images/step3.png" alt="" />
                    </a>
                    <h4 class="form-select-title">Team Building</h4>
                    <p class="form-select-para">Motivate, Inspire, Communicate &amp; Enjoy</p>
                </div>
                <div class="col-lg-2 col-md-4 col-sm-4 col-xs-6 thumb">
                    <a class="thumbnail new-thumb step1-click" onclick="jQuery('.steps').steps('next');" href="#" name="Adventure Stag Dos">
                        <img class="img-responsive" src="<?php echo get_template_directory_uri(); ?>/images/step4.png" alt="" />
                    </a>
                    <h4 class="form-select-title">Adventure Stag Dos</h4>
                    <p class="form-select-para">No Limits, Adrenaline &amp; Memories</p>
                </div>
                <div class="col-lg-2 col-md-4 col-sm-4 col-xs-6 thumb">
                    <a class="thumbnail new-thumb step1-click" onclick="jQuery('.steps').steps('next');" href="#" name="Adventure Hen Dos">
                        <img class="img-responsive" src="<?php echo get_template_directory_uri(); ?>/images/step5.png" alt="" />
                    </a>
                    <h4 class="form-select-title">Adventure Hen Dos</h4>
                    <p class="form-select-para">Adventures to let your hair down.</p>
                </div>
                <div class="col-lg-2 col-md-4 col-sm-4 col-xs-6 thumb">
                    <a class="thumbnail new-thumb step1-click" onclick="jQuery('.steps').steps('next');" href="#" name="Birthdays">
                        <img class="img-responsive" src="<?php echo get_template_directory_uri(); ?>/images/step6.png" alt="" />
                    </a>
                    <h4 class="form-select-title">Birthdays</h4>
                    <p class="form-select-para">For the young &amp; young at heart</p>
                </div>
            	<input type="hidden" name="steps_package_name" id="steps_package_name" />
            </div><!-- /.stepBlox-1 -->
            <div class="stepBlox stepBlox-2">
            	<div class="col-xs-12 col-md-3">
                	<p>Tell us your approximate <strong>group size?</strong></p>
                    <div class="form-group has-feedback"> 
                        <input type="tel" name="step_2_number" class="required form-control" id="step_2_number" placeholder="Enter Number" data-popover-position="top"   /> 
                    </div><!-- /.form-group -->
                    <p class="text-center"><strong>Choose your Activities:</strong><br />
                    They range from £5 -£30pp</p> 
                    <p class="text-center"><img src="<?php echo get_template_directory_uri(); ?>/images/form-step-2-img.png" class="img-responsive" style="margin: auto;" alt="" /></p>
                </div><!-- /.col-md-2 -->
                <div class="col-xs-12 col-md-9">
                	<p>In a Few words tell us what <strong>sort of adventure</strong> you are looking for? </p>
                    <div class="form-group">  
                            <textarea class="required form-control" name="step_2_message" id="step_2_message" rows="3" placeholder="Write your message..."></textarea>
					</div><!-- /.form-group -->
                    <div class="row">
                    	<div class="col-xs-12 col-md-4">
                        	<h4 style="color: #fff;">Recommended Activites</h4>
                              <div class="checkbox checkbox-primary">
                                <input type="checkbox" name="recomanded[]" value="Ultimate Assault">
                                <label>Ultimate Assault</label>
                              </div><!-- /.checkbox -->
                              <div class="checkbox checkbox-primary">
                                <input type="checkbox" name="recomanded[]" value="Awesome 4some">
                                <label>Awesome 4some</label>
                              </div><!-- /.checkbox -->
                              <div class="checkbox checkbox-primary">
                                <input type="checkbox" name="recomanded[]" value="Coasteering">
                                <label>Coasteering</label>
                              </div><!-- /.checkbox -->
                        </div><!-- /.col-md-4 -->
                        <div class="col-xs-12 col-md-4">
                        	<h4 style="color: #fff;">Additional Activites</h4>
                            <div class="checkbox checkbox-primary">
                                <input type="checkbox" name="additional[]" value="Laser Tag">
                                <label>Laser Tag</label>
                              </div><!-- /.checkbox -->
                              <div class="checkbox checkbox-primary">
                                <input type="checkbox" name="additional[]" value="Mountain Boarding">
                                <label>Mountain Boarding</label>
                              </div><!-- /.checkbox -->
                              <div class="checkbox checkbox-primary">
                                <input type="checkbox" name="additional[]" value="Surfing">
                                <label>Surfing</label>
                              </div><!-- /.checkbox -->
                              <div class="checkbox checkbox-primary">
                                <input type="checkbox" name="additional[]" value="Water Zorbing">
                                <label>Water Zorbing</label>
                              </div><!-- /.checkbox -->
                        </div><!-- /.col-md-4 -->
                        <div class="col-xs-12 col-md-4">
                        	<h4 style="color: #fff;">Meals Required</h4>
                            <div class="checkbox checkbox-primary">
                                <input type="checkbox" name="meals[]" value="Breakfast">
                                <label>Breakfast</label>
                              </div><!-- /.checkbox -->
                              <div class="checkbox checkbox-primary">
                                <input type="checkbox" name="meals[]" value="Lunch">
                                <label>Lunch</label>
                              </div><!-- /.checkbox -->
                              <div class="checkbox checkbox-primary">
                                <input type="checkbox" name="meals[]" value="Dinner">
                                <label>Dinner</label>
                              </div><!-- /.checkbox -->
                        </div><!-- /.col-md-4 -->
                    </div><!-- /.row -->
                </div><!-- /.col-md-10 --> 
                    <div class="col-xs-12 col-md-12">
                    	<?php echo do_shortcode('[col_blank_space height="20"]'); ?>
                        <div class="form-group red-block">        
                        <button type="submit" name="submit" value="submit" class="btn submit-btn btn-submit clickStatus2prev beforeFirst"  ><i class="fa fa-chevron-left" style="color: #e44e4e;"></i>&nbsp;&nbsp; Previous Step</button>&nbsp;&nbsp;                     		<button type="submit" name="submit" value="submit" class="btn submit-btn btn-submit clickStatus2next"   >Next Step &nbsp;&nbsp;<i class="fa fa-chevron-right" style="color: #e44e4e;"></i></button>
                    </div><!-- /.red-block -->
                    </div> 
            </div><!-- /.stepBlox-2 -->
            <div class="stepBlox stepBlox-3">
            	<div class="col-xs-12 col-md-4">
                <div class="row visible-on"> <?php echo do_shortcode('[col_blank_space height="20"]'); ?></div><!-- /.row -->
                <p><strong>When</strong> would you like to stay?</p>
                	<div id="dp6" data-date="<?php echo date("m-d-Y"); ?>" data-date-format="mm-dd-yyyy"></div>
                    <input type="hidden" name="step_3_night_date"  id="step_3_night_date" value="<?php echo date("m-d-Y"); ?>" />
                </div><!-- /. col-md-5 -->
                <div class="col-xs-12 col-md-3">
                <div class="row visible-on"><?php echo do_shortcode('[col_blank_space height="20"]'); ?></div><!-- /.row -->
                	<p class="text-center"><strong>Number of nights stay</strong></p>
                    <div class="form-group has-feedback"> 
                        <input type="text" name="step_3_night_stay" class="required form-control" id="step_3_night_stay" placeholder="Enter Number" data-popover-position="top"> 
                    </div><!-- /.form-group -->
                    <p style="margin-top: 25px;"><img src="<?php echo get_template_directory_uri(); ?>/images/form-step-3-img1.png" class="img-responsive" style="margin: auto;"  alt="" /></p>
                    <p><strong>Flexibility of date?</strong><br />
                    Plus or Minus<br />
                    how many days?</p>
                    
                    <div class="input-group">
                        <span class="input-group-btn">
                            <button type="button" class="btn btn-default basecolor" data-value="decrease" data-target="#spinner" data-toggle="spinner">
                                <span class="glyphicon glyphicon-minus"></span>
                            </button>
                        </span>
                        <input type="text" name="step_3_many_days" data-ride="spinner" id="spinner" class="form-control input-number" value="1">
                        <span class="input-group-btn">
                            <button type="button" class="btn btn-default basecolor" data-value="increase" data-target="#spinner" data-toggle="spinner">
                                <span class="glyphicon glyphicon-plus"></span>
                            </button>
                        </span>
                    </div><!-- /.input-group -->

                </div><!-- /. col-md-5 -->
                <div class="col-xs-12 col-md-5">
                <div class="row visible-on"><?php echo do_shortcode('[col_blank_space height="20"]'); ?></div><!-- /.row -->
                	<p>Notes \ Questions \ Requests ?</p>
                    <div class="form-group">  
                            <textarea class="form-control" name="step_3_text_notes" id="step_3_text_notes" rows="10" placeholder="Write your message..." style="min-height: 264px;"></textarea>
					</div><!-- /.form-group -->
                </div><!-- /. col-md-5 --> 
                	<div class="col-xs-12">
                    	<?php echo do_shortcode('[col_blank_space height="30"]'); ?>
                    	<div class="form-group red-block">        
                            <button type="submit" name="submit" value="submit" class="btn submit-btn btn-submit clickStatus3prev"  ><i class="fa fa-chevron-left" style="color: #e44e4e;"></i>&nbsp;&nbsp; Previous Step</button>&nbsp;&nbsp;                     		<button type="submit" name="submit" value="submit" class="btn submit-btn btn-submit clickStatus3next" >Next Step &nbsp;&nbsp;<i class="fa fa-chevron-right" style="color: #e44e4e;"></i></button>
                        </div><!-- /.red-block -->
                    </div> 
            </div><!-- /.stepBlox-3 -->
            <div class="stepBlox stepBlox-4"> 
                	<div class="col-xs-12 col-md-6">
                    	<p><strong>Now let us do all the hard work. </strong></p>
                        <p>We will review your requirements and 	come back to you shortly with the perfect adventure for you.</p>
						<p>Please complete your contact details so we send it you.</p>
                        <p style="margin-top: 25px;"><img src="<?php echo get_template_directory_uri(); ?>/images/form-step-4-img.png" class="img-responsive" alt="" /></p>
                    </div><!-- /.col-md-6 -->
                    <div class="col-xs-12 col-md-6">
                    	<div class="row">
                        	<div class="col-xs-12 col-md-6">
                            	<p><strong>Name</strong></p>
                                <div class="form-group has-feedback"> 
                                    <input type="text" name="step_4_first_name" class="required form-control" id="step_4_first_name" placeholder="First Name" data-popover-position="top" /> 
                                </div><!-- /.form-group -->
                            </div><!-- /.col-md-6 -->
                            <div class="col-xs-12 col-md-6">
                            	<p>&nbsp;</p>
                                <div class="form-group has-feedback"> 
                                    <input type="text" name="step_4_last_name" class="required form-control" id="step_4_last_name" placeholder="Last Name" data-popover-position="top" /> 
                                </div><!-- /.form-group -->
                            </div><!-- /.col-md-6 -->
                            <div class="col-xs-12 col-md-12">
                            	<p><strong>Telephone / Mobile Number:</strong></p>
                                <div class="form-group has-feedback"> 
                                    <input type="tel" name="ut_step4_telephone" class="form-control" id="ut_step4_telephone" placeholder="Telephone / Mobile Number" data-popover-position="top" /> 
                                </div><!-- /.form-group -->
                            </div><!-- /.col-md-12 -->
                            <div class="col-xs-12 col-md-12">
                            	<p><strong>Email Address:</strong></p>
                                <div class="form-group has-feedback"> 
                                    <input type="email" name="step_4_email" class="required form-control" id="step_4_email" placeholder="Email Address" data-popover-position="top" /> 
                                </div><!-- /.form-group -->
                            </div><!-- /.col-md-12 -->
                        </div><!-- /.row -->
                    </div><!-- /.col-md-6 --> 
            		<div class="col-xs-12">
                    	<?php echo do_shortcode('[col_blank_space height="30"]'); ?>
                    	<div class="form-group red-block">        
                            <button type="submit" name="submit" value="submit" class="btn submit-btn btn-submit clickStatus4prev" ><i class="fa fa-chevron-left" style="color: #e44e4e;"></i>&nbsp;&nbsp; Previous Step</button>&nbsp;&nbsp;                     		<button type="submit" name="submit" value="submit" class="btn submit-btn btn-submit clickStatus4next finishSubmit" >Create my adventure &nbsp;&nbsp;<i class="fa fa-chevron-right" style="color: #e44e4e;"></i></button>
                        </div><!-- /.red-block -->
                    </div>
            </div><!-- /.stepBlox-4 -->
            <div class="stepBlox stepBlox-5">
            	<div class="col-xs-12 text-center">
                	<p style="margin-top: 25px;"><img src="<?php echo get_template_directory_uri(); ?>/images/thankyou.png" class="img-responsive" style="margin: auto;" alt="" /></p>
                    <?php
						if ( function_exists( 'ot_get_option' ) ) {
						  $thank_you_message_for_perfect_adventure = ot_get_option( 'thank_you_message_for_perfect_adventure' ); 
						  $company_email = ot_get_option( 'company_email' ); 
						  $booking_number = ot_get_option( 'booking_number' ); 
						}
					?>
                  <p>
                    	<?php echo $thank_you_message_for_perfect_adventure; ?><br />
						<strong>Call:</strong> <?php echo $booking_number; ?> or <strong>Email us</strong> <a href="mailTo:<?php echo $company_email; ?>" style="color: #95c3ed;">here</a> <i class="fa fa-chevron-right" style="color: #fff;"></i></p>
                </div><!-- /.col-xs-12 -->
            </div><!-- /.stepBlox-5 -->            
        </div><!-- /.row-->
    </div><!-- /.col-xs-12 -->
    </form>    
 <!-- Modal -->
 <div class="modal fade" id="contactFormModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content modal-content-no-radious">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button> 
                      </div><!-- /.modal-header -->
                      <div class="modal-body">
                        <div id="bookForm1"></div><!-- /bookForm -->
                        <?php // $is_captcha_corrent = MyCaptcha::verify(); 
						//echo $is_captcha_corrent;	 ?>
                      </div><!-- /.modal-body -->
                      <div class="modal-footer" style="text-align:center;">
                        <button type="button" class="btn btn-primary btn-block btn-ut-color" data-dismiss="modal">CLOSE</button> 
                      </div><!-- /.modal-footer -->
                    </div><!-- /.modal-content -->
                  </div><!-- /.modal-dialog-->
                </div>
 <!-- /.modal --> 
    
    <?php } ?>   
    
    <script type="text/javascript">
	jQuery(document).ready(function() {
		jQuery.fn.datepicker.dates['en'] = {
		days: ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"],
		daysShort: ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun"],
		daysMin: ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun"],
		months: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
		monthsShort: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
		today: "Today"
	};
	
	jQuery('#dp6').datepicker({ dateFormat: 'mm-dd-yyyy' })
	.on('changeDate', function(){                 
		//alert(jQuery('#dp6').datepicker('getDate'));		
		var date = jQuery('#dp6').data("datepicker").getDate(),
    	formatted = (date.getMonth() + 1) + "-" +  date.getDate() + "-" + date.getFullYear() ;
		//alert(formatted);
		change_date_value(formatted);
		return false;
	}); 
		
	function change_date_value(updateDate){
			jQuery('#step_3_night_date').val(updateDate); 
		}	 		  
     
	});
	
	
	
	
	jQuery(document).ready(function() {
    jQuery('.steps').steps(); 
	
	jQuery.validator.setDefaults({
		  debug: true,
		  success: "valid",
		  errorElement: "span",
		  rules: {
				step_2_number: "required",
				step_3_night_stay: "required",
				step_4_first_name: "required",
				step_4_last_name: "required",
				step_4_email: "required"
			},
			messages: {
				step_2_number: "Please specify your name",
				step_3_night_stay: "Must enter number",
				
				step_4_first_name: "Enter first name",
				step_4_last_name: "Enter last name",
				step_4_email: "Enter email address"
	
			}
		});
		
		var form = jQuery("#steps-forms");
	
	
	
	jQuery(document).on('click','.step1-click',function(e){ 
		var showClass = null; 
		//alert(document.location.hostname);
		jQuery('.hide-on-click').slideUp('normal'); 
		showClass = jQuery('.blue').find('li.current a').attr('class');
		//alert(showClass);
		//jQuery('.nav-darkblue').hide();
		jQuery('.stepBoxHolder .stepBlox').slideUp('normal');
		jQuery('.stepBoxHolder').find('.'+showClass).slideDown('normal');		
		e.preventDefault();
	}); 
	
	
	
	
	jQuery(document).on('click','.clickStatus2next',function(e){ 
		var showClass = null;   
		form.validate(); 
		
		

		
		if(form.valid() == true){ 
			jQuery('.steps').steps('next');
			showClass = jQuery('.blue').find('li.current a').attr('class');
			jQuery('.stepBoxHolder .stepBlox').slideUp('normal');
			jQuery('.stepBoxHolder').find('.'+showClass).slideDown('normal');
		}
		e.preventDefault();
	});
	
	
	jQuery(document).on('click','.clickStatus2prev',function(e){ 
		var showClass = null; 
		jQuery('.steps').steps('prev');
		//jQuery('.hide-on-click').slideUp('normal'); 
		jQuery('.hide-on-click').slideDown('normal');
		showClass = jQuery('.blue').find('li.current a').attr('class');
		//alert(showClass);
		//jQuery('.nav-darkblue').hide();
		jQuery('.stepBoxHolder .stepBlox').slideUp('normal');
		jQuery('.stepBoxHolder').find('.'+showClass).slideDown('normal');		
		e.preventDefault();
	});
	
	
	
	jQuery(document).on('click','.clickStatus3next',function(e){ 
		var showClass = null; 
		form.validate(); 
		
		if(form.valid() == true){ 
			jQuery('.steps').steps('next');  
			showClass = jQuery('.blue').find('li.current a').attr('class'); 
			jQuery('.stepBoxHolder .stepBlox').slideUp('normal');
			jQuery('.stepBoxHolder').find('.'+showClass).slideDown('normal');
		}
		e.preventDefault();
	});
	
	
	jQuery(document).on('click','.clickStatus3prev',function(e){ 
		var showClass = null; 
		jQuery('.steps').steps('prev');
		//jQuery('.hide-on-click').slideUp('normal'); 
		showClass = jQuery('.blue').find('li.current a').attr('class');
		//alert(showClass);
		//jQuery('.nav-darkblue').hide();
		jQuery('.stepBoxHolder .stepBlox').slideUp('normal');
		jQuery('.stepBoxHolder').find('.'+showClass).slideDown('normal');		
		e.preventDefault();
	});
	
	
	
	
	jQuery(document).on('click','.clickStatus4next',function(e){ 
		var showClass = null; 
		form.validate(); 
		//var ajaxnew = jQuery('#site_url_ajax').val();
		//alert(jQuery('#steps-forms').serialize());
		if(form.valid() === true){
			jQuery('.steps').steps('next'); 
			showClass = jQuery('.blue').find('li.current a').attr('class'); 
			jQuery('.stepBoxHolder .stepBlox').slideUp('normal');
			jQuery('.stepBoxHolder').find('.'+showClass).slideDown('normal');	



var formData = {
		'steps_package_name'              	: jQuery('#steps_package_name').val(),
		
		'step_2_number'              		: jQuery('#step_2_number').val(),
		'step_2_message'                    : jQuery('#step_2_message').val(),				
		'recomanded[]'						: jQuery("input[name='recomanded[]']:checked"),
		'additional[]'						: jQuery("input[name='additional[]']:checked"),
		'meals[]'							: jQuery("input[name='meals[]']:checked"),
		
		'step_3_night_stay'					: jQuery('#step_3_night_stay').val(),
		'step_3_night_date'					: jQuery('#step_3_night_date').val(),
		'spinner'							: jQuery('#spinner').val(),
		'step_3_text_notes'					: jQuery('#step_3_text_notes').val(),
		
		'step_4_first_name'					: jQuery('#step_4_first_name').val(),
		'step_4_last_name'					: jQuery('#step_4_last_name').val(),
		'ut_step4_telephone'				: jQuery('#ut_step4_telephone').val(),
		'step_4_email'						: jQuery('#step_4_email').val()
		
		}; 
				
				//alert(jQuery("input[name='recomanded[]']:checked"));
				//return false;
		
			// process the form
			jQuery.ajax({
				type        : 'POST',
				url         : '<?php echo get_template_directory_uri(); ?>/ajax-form-build.php',
				data        : jQuery('#steps-forms').serialize(),
				dataType    : 'json',
				encode      : true
			})
			// using the done promise callback
			.done(function(data) {
				
				//jQuery('#contactFormModal1').modal('show');
				
				//alert(data.message);
				if ( data.success === true) { 
					 jQuery('#bookForm1').html(data.message);
					 jQuery('#contactFormModal1').modal('show');
				} else { 
					jQuery('#bookForm1').html(data.message);
					jQuery('#contactFormModal1').modal('show'); 
				}
			}); 
		}
		e.preventDefault();
	});
	
	
	jQuery(document).on('click','.clickStatus4prev',function(e){ 
		var showClass = null; 
		jQuery('.steps').steps('prev');
		//jQuery('.hide-on-click').slideUp('normal'); 
		showClass = jQuery('.blue').find('li.current a').attr('class');
		//alert(showClass);
		//jQuery('.nav-darkblue').hide();
		jQuery('.stepBoxHolder .stepBlox').slideUp('normal');
		jQuery('.stepBoxHolder').find('.'+showClass).slideDown('normal');		
		e.preventDefault();
	});

	
	
	jQuery(document).on('click','.beforeFirst',function(e){
		jQuery('.hide-on-click').slideDown('normal');
		jQuery('span.error').hide();
		e.preventDefault();
	});
	
	/****** This is hidden input field value add *****/
	jQuery(document).on('click','.step1-click',function(e){
		var name =jQuery(this).attr('name');
		jQuery('#steps_package_name').val(name);
		e.preventDefault();
	});
	
	
	 

});


    	
    </script>
	
<?php }

add_shortcode('ultimate-package-form', 'ultimate_package_form');





 








/*******************
CUSTOM META BOX FOR TESTIMONIAL
***********************************/ 

add_action( 'add_meta_boxes', 'add_ultimate_rating_metaboxes' ); 

function add_ultimate_rating_metaboxes() {
	add_meta_box('wpt_ultimate_rating_location', 'Event Location', 'wpt_ultimate_rating_location', 'ut-testimonial', 'normal', 'high');
}
 

function wpt_ultimate_rating_location() {
	global $post;	
	// Noncename needed to verify where the data originated
	echo '<input type="hidden" name="eventmeta_noncename" id="eventmeta_noncename" value="' . 
	wp_create_nonce( plugin_basename(__FILE__) ) . '" />';	
	// Get the location data if its already been entered
	$location = get_post_meta($post->ID, '_rating', true); ?>    
    <select name="_rating" class="widefat">
    	<option value="1" <?php if($location == 1){ echo 'selected="selected"'; } ?> >1</option>
        <option value="2" <?php if($location == 2){ echo 'selected="selected"'; } ?>>2</option>
        <option value="3" <?php if($location == 3){ echo 'selected="selected"'; } ?>>3</option>
        <option value="4" <?php if($location == 4){ echo 'selected="selected"'; } ?>>4</option>
        <option value="5" <?php if($location == 5){ echo 'selected="selected"'; } ?>>5</option>
    </select>    
	<?php 
}


// Save the Metabox Data
function wpt_save_ultimate_rating_meta($post_id, $post) {
	
	// verify this came from the our screen and with proper authorization,
	// because save_post can be triggered at other times
	if ( !wp_verify_nonce( $_POST['eventmeta_noncename'], plugin_basename(__FILE__) )) {
	return $post->ID;
	}

	// Is the user allowed to edit the post or page?
	if ( !current_user_can( 'edit_post', $post->ID ))
		return $post->ID;

	// OK, we're authenticated: we need to find and save the data
	// We'll put it into an array to make it easier to loop though.
	
	$events_meta['_rating'] = $_POST['_rating'];
	
	// Add values of $events_meta as custom fields
	
	foreach ($events_meta as $key => $value) { // Cycle through the $events_meta array!
		if( $post->post_type == 'revision' ) return; // Don't store custom data twice
		$value = implode(',', (array)$value); // If $value is an array, make it a CSV (unlikely)
		if(get_post_meta($post->ID, $key, FALSE)) { // If the custom field already has a value
			update_post_meta($post->ID, $key, $value);
		} else { // If the custom field doesn't have a value
			add_post_meta($post->ID, $key, $value);
		}
		if(!$value) delete_post_meta($post->ID, $key); // Delete if blank
	}

}

add_action('save_post', 'wpt_save_ultimate_rating_meta', 1, 2); // save the custom fields


function ultimate_contact_form( $atts, $content = null ) {
	extract( shortcode_atts( array(
        'title' 	=> '',
		'sub_title' => '',
		'bgcolor'	=> ''
    ), $atts) );
	//session_start();   
	require_once( 'mycaptcha.php'); 
	 ?>
    <div class="contact-page-form" id="contact-page-anchor">
     	<div class="row">
        	<div class="col-xs-12">
            	<h2 class="text-center text-uppercase">
					<?php echo $title; ?>
                    <span class="h2-subtitle"><?php echo $sub_title; ?></span>
                </h2>
                 <hr class="hr-margin-no-top" />
                 
                 
              
                  <form id="signin-form" method="post" action="" accept-charset="UTF-8">
                    <fieldset>
                    <div class="row">
                        <div class="col-md-4"> 
                          <div class="form-group">
                            <label for="exampleInputEmail1">Name <span>*</span></label>   
                            <input type="text" name="ut_firstname" class="required form-control" id="firtName" placeholder="First name"> 
                          </div><!--/.form-group -->
                        </div><!--/.col-md-4 -->
                        
                        <div class="col-md-4"> 
                          <div class="form-group">
                            <label for="exampleInputEmail1">&nbsp;</label>   
                            <input type="text" name="ut_lastname" class="required form-control" id="lastName" placeholder="Last name" data-popover-position="top"  > 
                          </div><!--/.form-group -->
                        </div><!--/.col-md-4 -->
                        
                        <div class="col-md-4"> 
                          <div class="form-group">
                            <label for="exampleInputEmail1">Email <span>*</span></label> 
                            <input type="email" name="ut_email" class="required form-control" id="emailAddress" placeholder="Email address" data-error="Bruh, that email address is invalid" >  
                          </div><!--/.form-group -->
                        </div><!--/.col-md-4 --> 	
                    </div><!--/.row-->   
                    
                    
                    <div class="row">
                    <div class="col-md-6">
                        <div class="form-group has-feedback">
                            <label for="exampleInputEmail1">Telephone <span>*</span></label>
                            <input type="tel" name="ut_telephone" class="required form-control" id="ut_telephone" placeholder="Home or Mobile" data-popover-position="top"  > 
                        </div>
                    </div><!-- /.col-md-6 -->
                    
                    <div class="col-md-6">
                        <div class="form-group selectContainer">
                        	<label for="exampleInputEmail1">Package:</label>
                        	<?php
							$args = array(
								'post_type'      => 'page',
								'post_parent'	 => 55,
								'posts_per_page' => -1,
								'order'          => 'ASC',
								'orderby'        => 'menu_order'
							 );
							$the_query = new WP_Query( $args );
							?>
                             <select name="ut_package" id="utPackages" class="form-control" data-popover-position="top">
                            <option value="none">Select one</option>
							<?php
							if ( $the_query->have_posts() ): 			
							while ( $the_query->have_posts() ):
								$the_query->the_post(); ?>   
                                    <option value="<?php the_title(); ?>"><?php the_title(); ?></option>
							<?php endwhile;
							endif;	
							?> 
                            </select>  
                        </div>
                    </div><!-- /.col-md-6 --> 
                </div><!-- /.row -->
                
                <div class="row">
                	<div class="col-md-6">
                    	<div class="form-group has-feedback">
                            <label for="exampleInputEmail1">Activity</label>
                            <?php
							$args = array(
								'post_type'      => 'page',
								'post_parent'	 => 40,
								'posts_per_page' => -1,
								'order'          => 'ASC',
								'orderby'        => 'menu_order'
							 );
							$the_query = new WP_Query( $args );
							?>
                            <select name="ut_activity" id="ut_activity" class="form-control activity" data-popover-position="top">
                            <option value="none">Select one</option>
							<?php
							if ( $the_query->have_posts() ): 			
							while ( $the_query->have_posts() ):
								$the_query->the_post(); ?>
                                    <option value="<?php the_title(); ?>"><?php the_title(); ?></option>
							<?php endwhile;
							endif;	
							?> 
                            </select>
                        </div><!-- /.form-group -->
                    </div><!-- /.col-md-6 --> 
                    <div class="col-md-6">
                    	<div class="form-group has-feedback">
                            <label for="exampleInputEmail1">Accommodation</label>
                            <!--<input type="tel" name="ut_accommodation" class="required form-control" id="ut_accommodation" placeholder="Accommodation" data-popover-position="top"  >-->
                            <?php
							$args = array(
								'post_type'      => 'page',
								'post_parent'	 => 63,
								'posts_per_page' => -1,
								'order'          => 'ASC',
								'orderby'        => 'menu_order'
							 );
							$the_query = new WP_Query( $args );
							?>
                             <select name="ut_accommodation" id="ut_accommodation" class="form-control accommodation" data-popover-position="top">
                            <option value="none">Select one</option>
							<?php
							if ( $the_query->have_posts() ): 			
							while ( $the_query->have_posts() ):
								$the_query->the_post(); ?>   
                                    <option value="<?php the_title(); ?>"><?php the_title(); ?></option>
							<?php endwhile;
							endif;	
							?> 
                            </select> 
                        </div><!-- /.form-group -->
                    </div><!-- /.col-md-6 --> 
                </div><!-- /.row -->
                
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group has-feedback">
                            <label for="exampleInputEmail1">Number of Participants: <span>*</span></label>
                            <input type="tel" name="ut_participant" class="required form-control" id="parcticeNumber" placeholder="Enter Number" data-popover-position="top"> 
                        </div>
                    </div><!-- /.col-md-6 -->
                    
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Day <span>*</span></label>
                            <select name="ut_days" id="ut_days" class="required form-control daySelect" data-popover-position="top">
                                <option value="none">Day</option>
                            </select>
                        </div>
                    </div><!-- /.col-md-1 --> 
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Month <span>*</span></label>
                            <select name="ut_months" id="ut_months" class="required form-control" data-popover-position="top">
                              <option value="none">Month</option>
                              <option value="Jan">January</option>
                              <option value="Feb">February</option>
                              <option value="Mar">March</option>
                              <option value="Apr">April</option>
                              <option value="May">May</option>
                              <option value="Jun">June</option>
                              <option value="Jul">July</option>
                              <option value="Aug">August</option>
                              <option value="Sept">September</option>
                              <option value="Oct">October</option>
                              <option value="Nov">November</option>
                              <option value="Dec">December</option>
                            </select>
                        </div>
                    </div><!-- /.col-md-1 --> 
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Year <span>*</span></label>
                            <select name="ut_years" id="ut_years" class="required form-control yearSelect" data-popover-position="top">
                              <option value="none">Year</option> 
                            </select>
                        </div>
                    </div><!-- /.col-md-1 --> 
                </div><!-- /.row -->
                
                <hr />
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Message <span>*</span></label> 
                            <textarea class="required form-control" name="ut_message" id="ut_message" rows="10" placeholder="Write your message..."></textarea>
                        </div>
                    </div><!-- /.col-md-6 -->
                    
                    <div class="col-md-6">
                    	<div class="row">
                        	<div class="col-md-12">
                            	<div class="form-group">
                                    <label for="exampleInputEmail1">I am not a Robot: <span>*</span></label><br />
                                    <img src="<?php echo get_template_directory_uri(); ?>/captcha_code_file.php?rand=<?php echo rand(); ?>" id='captchaimg' ><br />   
                                     
                                    <small style="color: #fff;">Can't read the image? click <a href='javascript: refreshCaptcha();' style="color: #303548;"><strong>here</strong></a> to refresh</small> 
                                </div>
                            </div><!-- /.col-md-12 -->
                            
                            <div class="col-md-12">
                            	<div class="form-group" style="margin-bottom: 0;">
                                    <!--<input id="6_letters_code" class="form-control" name="captcha" type="text">-->
                                    <input id="captcha" class="form-control" name="captcha" type="text">
                                    
                                </div>
                            </div><!-- /.col-md-12 --> 
                        </div><!-- /.row -->
                        
                        <hr />
                        <div class="form-group red-block">  
                            
                            <button type="submit" name="submit" value="submit" class="btn submit-btn btn-submit contact-submit">Submit &nbsp;&nbsp;<i class="fa fa-chevron-right" style="color: #e44e4e;"></i></button>
                        </div>
                        <div class="form-group"> 
                            <span style="color: #fff;">*</span> <span style="color: #35354b; font-weight: 600;">Required Field</span>
                        </div>
                    </div><!-- /.col-md-6 --> 
                </div><!-- /.row -->
                 
                </fieldset>
              </form> 
              <div class="clearfix"></div>    
  				
  
                          

                 
                
				<!-- Modal -->
                <div class="modal fade" id="contactFormModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content modal-content-no-radious">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button> 
                      </div><!-- /.modal-header -->
                      <div class="modal-body">
                        <div id="bookForm"></div><!-- /bookForm -->
                        <?php $is_captcha_corrent = MyCaptcha::verify(); 
						echo $is_captcha_corrent;	 ?>
                      </div><!-- /.modal-body -->
                      <div class="modal-footer" style="text-align:center;">
                        <button type="button" class="btn btn-primary btn-block btn-ut-color" data-dismiss="modal">CLOSE</button> 
                      </div><!-- /.modal-footer -->
                    </div><!-- /.modal-content -->
                  </div><!-- /.modal-dialog-->
                </div><!-- /.modal -->
                
                <script type="text/javascript">
				
				function refreshCaptcha()
				{
					var img = document.images['captchaimg'];
					img.src = img.src.substring(0,img.src.lastIndexOf("?"))+"?rand="+Math.random()*1000;
				}
				 
					
					
					jQuery(function() {
					  jQuery('#signin-form').validate_popover({onsubmit: true, popoverPosition: 'top'});
					
					  jQuery(".contact-submit").click(function(ev) {
							ev.preventDefault();
							var status = false;
							
							utPackages = jQuery("#utPackages").val();
							ut_activity = jQuery("#ut_activity").val();
							ut_accommodation = jQuery("#ut_accommodation").val();
							//alert(utPackages);
							status = jQuery('#signin-form').validate().form();
							if(utPackages != 0 || ut_activity != 0 || ut_accommodation != 0){
								
							}else{
								status = false;
								jQuery('#bookForm').html('<h3 style="text-align: center; color: #000;"><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span><br/><strong>Sorry fail to send!!!</strong> <br />Your must fill at least one choice from <br/><b>Package, Activity Accommodation</b>.</h3>');
								jQuery('#contactFormModal').modal('show');	
							}
							
														
							if(status == true){
								//alert(status)
								var formData = {
									'firtName'              : jQuery('#firtName').val(),
									'lastName'             	: jQuery('#lastName').val(),
									'emailAddress'    		: jQuery('#emailAddress').val(),
									'utPackages'			: jQuery('#utPackages').val(),
									'ut_telephone'			: jQuery('#ut_telephone').val(),
									'ut_participant'		: jQuery('#parcticeNumber').val(),
									'ut_days'				: jQuery('#ut_days').val(),
									'ut_months'				: jQuery('#ut_months').val(),
									'ut_years'				: jQuery('#ut_years').val(),
									'ut_message'    		: jQuery('#ut_message').val(),
									'captcha'				: jQuery('#captcha').val(),
									'ut_activity'			: jQuery("#ut_activity").val(),
									'ut_accommodation'		: jQuery("#ut_accommodation").val()
								}; 
		
								// process the form
								jQuery.ajax({
									type        : 'POST',
									url         : '<?php echo get_template_directory_uri(); ?>/ajaxData.php',
									data        : formData,
									dataType    : 'json',
									encode      : true
								})
								// using the done promise callback
								.done(function(data) { 
									if ( ! data.success) { 
										 jQuery('#bookForm').html(data.errors.message);
										 jQuery('#contactFormModal').modal('show');
									} else { 
										jQuery('#bookForm').html(data.message);
										jQuery('#contactFormModal').modal('show'); 
									}
								});
								ev.preventDefault();
							}	// end validation check


					  });	// submit-btn click close
					
					  jQuery(window).resize(function() {
							jQuery.validator.reposition();
						});
					});
				
				// Form Select option value						
				jQuery(document).ready(function() { 
					for (i = 1; i <= 31; i++) {  
						jQuery('.daySelect').append("<option value='" + i + "'>" + i + "</option>");
					}
					
					for (i = 0; i <20; i++) {  
						if(i<10){
							jQuery('.yearSelect').append("<option value='201" + i + "'>201" + i + "</option>");
						}else{
							j=i-10;
							jQuery('.yearSelect').append("<option value='202" + j + "'>202" + j + "</option>");	
						}
					}
				}); 
				  
                </script>
                
            </div><!-- /.col-xs-12 -->
        </div><!-- /. row -->
     </div>  
    <!-- /.contact-page-form -->
<?php }
add_shortcode('contact_form_page', 'ultimate_contact_form');



function ultimate_location_map( $atts, $content = null ) {
	extract( shortcode_atts( array(
        'title' 	=> '',
		'subtitle' 	=> '',
		'style'		=> '' 
    ), $atts) );
	
	if ( function_exists( 'ot_get_option' ) ) {
		  $social_settings = ot_get_option( 'social_settings' );  
		}
		
		//print_r($social_settings);
		
	 ?> 
    	<div id="contactFormTitle">
        	<div class="container">
            	<div class="row">
                    <div class="col-xs-12">
                        <h2 class="text-center text-uppercase" <?php echo 'style="'.$style.'"'; ?>>
                            <?php echo $title; ?>
                            <span class="h2-subtitle"><?php echo $subtitle; ?></span>
                        </h2>
                    </div><!-- /.col-xs-12 -->
                </div><!-- /.row -->
            </div><!-- /.container -->
        </div><!-- /.contactFormTitle -->
    	<div id="contactFormFull">
        	<div id="map_canvas_over">
            	<div class="container" style="max-width: 960px;">
                	<div class="row hidden-on">
                    	<div id="on-off-info" class="col-md-4 hidden-xs" style="position: absolute; top: 50px;">
                        	<div class="contact_text_img">
                        		<h4><strong>Contact us</strong> to discuss <br />YOUR Ultimate Adventure</h4>
                                <div style="clear: both; width:100%;"></div>
                                <p><a class="allbuttonS allbutton1S" href="<?php echo get_permalink(81); ?>">Contact Us</a>&nbsp;&nbsp;
                                <a class="allbuttonS allbutton1S" href="<?php echo get_permalink(79); ?><?php //optionTree_specific_value('social_settings', 'Facebook'); ?>" target="_blank">Find us</a></p>
                            </div><!-- /.contact_text_img -->
                        </div><!-- /.col-md-5 -->
                        <div class="col-xs-10 col-xs-offset-1 hidden-md hidden-lg hidden-xs" style="position: absolute; top: 50px;">
                        	<div class="contact_text_img">
                        		<h4 class="text-center"><strong>Contact us</strong> to discuss <br />YOUR Ultimate Adventure</h4>
                                <div style="clear: both; width:100%;"></div>
                                <p class="text-center">
                                	<a class="allbuttonS allbutton1S" href="#">Contact Us</a><br /><br />
                                	<a class="allbuttonS allbutton1S" href="<?php optionTree_specific_value('social_settings', 'Facebook'); ?>" target="_blank">Find us</a>
                                </p>
                            </div><!-- /.contact_text_img -->
                        </div><!-- /.col-xs-4 -->
                    </div><!-- /. row -->
                </div><!-- /.container -->
            </div><!-- /.#map_canvas_over -->
			<div id="map_canvas"></div>
            
        </div><!-- /.contactFormFull -->
        
        <?php
		if ( function_exists( 'ot_get_option' ) ) { 
		  $map_zoom_level = ot_get_option('map_zoom_level'); 
		  $map_marker_address = ot_get_option('map_marker_address'); 
		  $google_map_location = ot_get_option('google_map_location'); 
		}
		?>
        <script type="text/javascript">
		
		
		
		
		
		/*
 * 5 ways to customize the Google Maps infowindow
 * 2015 - en.marnoto.com
 * http://en.marnoto.com/2014/09/5-formas-de-personalizar-infowindow.html
*/

// map center
var center = new google.maps.LatLng(<?php echo $google_map_location; ?>);

// marker position
var factory = new google.maps.LatLng(<?php echo $google_map_location; ?>);

//var myLatLng = {lat: 51.019725, lng: -4.238212};

function initialize() {
  var mapOptions = {
    center: center,
    zoom: <?php echo $map_zoom_level; ?>,
    mapTypeId: google.maps.MapTypeId.HYBRID
  };

  var map = new google.maps.Map(document.getElementById("map_canvas"),mapOptions);

  // InfoWindow content
  var content = '<div id="iw-container" style="padding: 15px 0 15px 15px;">' +
                    <!--'<div class="iw-title">ULTiMATE Adventure Center</div>' +-->
                    '<?php echo $map_marker_address; ?>' +
                      +
                  '</div>';

  // A new Info Window is created and set content
  var infowindow = new google.maps.InfoWindow({
    content: content,

    // Assign a maximum value for the width of the infowindow allows
    // greater control over the various content elements
    //maxWidth: 320
  });
  
  infowindow.setZIndex(99999);
   
  // marker options
  var marker = new google.maps.Marker({
    position: factory,
    map: map,
    title:"ULTiMATE Adventure Center"
  });

  // This event expects a click on a marker
  // When this event is fired the Info Window is opened.
  google.maps.event.addListener(marker, 'click', function() {
    infowindow.open(map,marker);
	jQuery('#on-off-info').css({'visibility' : 'hidden'});
  });

  // Event that closes the Info Window with a click on the map
  google.maps.event.addListener(map, 'closeclick', function() {
    infowindow.close();
	//jQuery('#on-off-info').css({'visibility' : 'visible'});
  });

  // *
  // START INFOWINDOW CUSTOMIZE.
  // The google.maps.event.addListener() event expects
  // the creation of the infowindow HTML structure 'domready'
  // and before the opening of the infowindow, defined styles are applied.
  // *
  google.maps.event.addListener(infowindow, 'domready', function() {

    // Reference to the DIV that wraps the bottom of infowindow
    var iwOuter = jQuery('.gm-style-iw');

    /* Since this div is in a position prior to .gm-div style-iw.
     * We use jQuery and create a iwBackground variable,
     * and took advantage of the existing reference .gm-style-iw for the previous div with .prev().
    */
    var iwBackground = iwOuter.prev();

    // Removes background shadow DIV
    iwBackground.children(':nth-child(2)').css({'display' : 'none'});

    // Removes white background DIV
    //iwBackground.children(':nth-child(4)').css({'display' : 'none'});

    // Moves the infowindow 115px to the right.
    //iwOuter.parent().parent().css({left: '115px'});

    // Moves the shadow of the arrow 76px to the left margin.
    //iwBackground.children(':nth-child(1)').attr('style', function(i,s){ return s + 'left: 76px !important;'});

    // Moves the arrow 76px to the left margin.
    //iwBackground.children(':nth-child(3)').attr('style', function(i,s){ return s + 'left: 76px !important;'});

    // Changes the desired tail shadow color.
    iwBackground.children(':nth-child(3)').find('div').children().css({'box-shadow': 'rgba(72, 181, 233, 0.6) 0px 1px 6px', 'z-index' : '1'});

    // Reference to the div that groups the close button elements.
    var iwCloseBtn = iwOuter.next();
	iwCloseBtn.addClass('liveclose');
    // Apply the desired effect to the close button
    //iwCloseBtn.css({opacity: '1', right: '38px', top: '3px', border: '7px solid #48b5e9', 'border-radius': '13px', 'box-shadow': '0 0 5px #3990B9'});

    // If the content of infowindow not exceed the set maximum height, then the gradient is removed.
    if(jQuery('.iw-content').height() < 140){
      jQuery('.iw-bottom-gradient').css({display: 'none'});
    }

    // The API automatically applies 0.7 opacity to the button after the mouseout event. This function reverses this event to the desired value.
    iwCloseBtn.mouseout(function(){
      jQuery(this).css({opacity: '1'});
    });
  });
}
google.maps.event.addDomListener(window, 'load', initialize);

// this is our gem
google.maps.event.addDomListener(window, 'resize', function() {
var center = map.getCenter();
google.maps.event.trigger(map, 'resize');
infowindow.open(map);
map.setCenter(center); 
});
		
jQuery(document).on('click', '.liveclose', function(event){
    //infowindow.close();
    jQuery('#on-off-info').css({'visibility' : 'visible'});
	//alert('test');
});		
		
/*		var myLatLng = {lat: 51.019725, lng: -4.238212};
		
		var mapOptions = {
			zoom: 12,
			disableDefaultUI: true,
			center: new google.maps.LatLng(myLatLng), mapTypeId: google.maps.MapTypeId.HYBRID
			}; 
  
			var map = new google.maps.Map(document.getElementById('map_canvas'), mapOptions);
			
			
			var contentString = '<div id="content" style="margin-top:20px;">'+
		  '<div id="siteNotice">'+
		  '</div>'+
		  '<h1 id="firstHeading" class="firstHeading">Uluru</h1>'+
		  '<div id="bodyContent">'+
		  '<p><b>Uluru</b>, also referred to as <b>Ayers Rock</b>, is a large ' +
		  'sandstone rock formation in the southern part of the '+
		  'Northern Territory, central Australia. It lies 335&#160;km (208&#160;mi) '+
		  'south west of the nearest large town, Alice Springs; 450&#160;km '+
		  '(280&#160;mi) by road. Kata Tjuta and Uluru are the two major '+
		  'features of the Uluru - Kata Tjuta National Park. Uluru is '+
		  'sacred to the Pitjantjatjara and Yankunytjatjara, the '+
		  'Aboriginal people of the area. It has many springs, waterholes, '+
		  'rock caves and ancient paintings. Uluru is listed as a World '+
		  'Heritage Site.</p>'+
		  '<p>Attribution: Uluru, <a href="https://en.wikipedia.org/w/index.php?title=Uluru&oldid=297882194">'+
		  'https://en.wikipedia.org/w/index.php?title=Uluru</a> '+
		  '(last visited June 22, 2009).</p>'+
		  '</div>'+
		  '</div>';
	  
			
			var infowindow = new google.maps.InfoWindow({
				content: contentString,
				zIndex: 99999999
			  });
  
			var marker = new google.maps.Marker({
				position: myLatLng,
				map: map,
				title: 'Hello World!'
			  });
			
			marker.addListener('click', function() {
				infowindow.open(map, marker);
			  });  
			
			// this is our gem
			google.maps.event.addDomListener(window, 'resize', function() {
			var center = map.getCenter();
			google.maps.event.trigger(map, 'resize');
			map.setCenter(center); 
		});*/
		
		
		</script>
<?php }

add_shortcode('page_location_map', 'ultimate_location_map');



function ut_contenttype($content_type){
	return 'text/html';
}
add_filter('wp_mail_content_type','ut_contenttype');


/****************************************************************************
-----------------------------------------------------------------------------
This function is for only option tree specific value from array 

-----------------------------------------------------------------------------
****************************************************************************/

function optionTree_specific_value($otion_name, $field_name){
		if ( function_exists( 'ot_get_option' ) ) {
	  
	  /* get the slider array */
	  $allDatas = ot_get_option( $otion_name, array() );
	  
	  if ( ! empty( $allDatas ) ) {
		foreach( $allDatas as $data ) {
			
		  if($data['name'] == $field_name){	
			echo $data['href'];	
		  }
		}
	  }
	}
}


function ultimate_packages_page( $atts, $content = null ) {
	extract( shortcode_atts( array(
        'id' 	=> ''
    ), $atts) );
	$number_of_packages = get_field('number_of_packages');
	?> 
    
    <div class="row testcol">
    	<div class="col-xs-12">
        	<h2 class="text-center text-uppercase" style="padding-bottom: 0; margin-top: 0; padding-top: 0; margin-bottom: 15px;">
            	<!--<span class="h2-subtitle"></span>-->
                <?php echo get_field('before_package_title'); ?>
            </h2>
            <?php echo get_field('before_packages_content'); ?>
        </div><!-- /.col-xs-12 -->
    </div><!-- /.row -->
    <?php $show_hide_price_section = get_field('show_/_hide_price_section'); ?>
    <?php if($show_hide_price_section == 'show' && $number_of_packages == 1){ ?>
    	<div class="row">
            <div class="col-xs-12 col-md-6 col-md-offset-3 col00">
            	<h3 class="packages-title"><?php echo get_field('title_1',$id); ?></h3>
                <div class="packages-sub-title"><p><?php echo get_field('sub_title_1',$id); ?></p></div>
                <div class="packages-box packages-box1">
                <?php						
                    if( have_rows('table_content_1',$id) ):
                        echo '<ul class="package-line package-line1">';
                        // loop through the rows of data
                        while ( have_rows('table_content_1',$id) ) : the_row();				
                            // display a sub field value
                            echo '<li>'.get_sub_field('packages_name').'</li>';                    
                        endwhile;
                        echo '</ul>';
                    else :				
                        // no rows found				
                    endif;
                ?> 
                <div class="paclages-button">
                    <a href="#contact-page-anchor">Click here</a>
                </div><!-- /.paclages-button -->
            </div><!-- /.packages-box -->
            </div><!-- /.col-xs-12 -->
        </div><!-- /.row -->
    <?php } ?>
    
    
    <?php $show_hide_price_section = get_field('show_/_hide_price_section'); ?>
    <?php if($show_hide_price_section == 'show' && $number_of_packages == 2){ ?>
    	<div class="row">
            <div class="col-xs-12 col-md-5 col-md-offset-1 col00">
            	<h3 class="packages-title"><?php echo get_field('title_1',$id); ?></h3>
                <div class="packages-sub-title"><p><?php echo get_field('sub_title_1',$id); ?></p></div>
                <div class="packages-box packages-box1">
                <?php						
                    if( have_rows('table_content_1',$id) ):
                        echo '<ul class="package-line package-line1">';
                        // loop through the rows of data
                        while ( have_rows('table_content_1',$id) ) : the_row();				
                            // display a sub field value
                            echo '<li>'.get_sub_field('packages_name').'</li>';                    
                        endwhile;
                        echo '</ul>';
                    else :				
                        // no rows found				
                    endif;
                ?> 
                <div class="paclages-button">
                    <a href="#contact-page-anchor">Click here</a>
                </div><!-- /.paclages-button -->
            </div><!-- /.packages-box -->
            </div><!-- /.col-xs-12 -->
            <div class="col-xs-12 col-md-4 col00">
        	<h3 class="packages-title"><?php echo get_field('title_2',$id); ?></h3>
            <div class="packages-sub-title"><p><?php echo get_field('sub_title_2',$id); ?></p></div>
            	<div class="packages-box packages-box2">
					<?php						
                        if( have_rows('table_content_2',$id) ):
                            echo '<ul class="package-line package-line2">';
                            // loop through the rows of data
                            while ( have_rows('table_content_2',$id) ) : the_row();				
                                // display a sub field value
                                echo '<li>'.get_sub_field('packages_name').'</li>';
                        
                            endwhile;
                            echo '</ul>';
                        else :				
                            // no rows found				
                        endif;
                    ?> 
                <div class="paclages-button">
                    <a href="#contact-page-anchor">Click here</a>
                </div><!-- /.paclages-button -->
              </div><!-- /.packages-box -->  
        </div><!-- /.col-md-4 -->
        </div><!-- /.row -->
    <?php } ?>
    
	
	<?php if($show_hide_price_section == 'show' && $number_of_packages == 3){ ?>
    <div class="row">
    	<div class="col-xs-12 col-md-4 col00">
        	<h3 class="packages-title"><?php echo get_field('title_1',$id); ?></h3>
            <div class="packages-sub-title"><p><?php echo get_field('sub_title_1',$id); ?></p></div>
                <div class="packages-box packages-box1">
                <?php						
                    if( have_rows('table_content_1',$id) ):
                        echo '<ul class="package-line package-line1">';
                        // loop through the rows of data
                        while ( have_rows('table_content_1',$id) ) : the_row();				
                            // display a sub field value
                            echo '<li>'.get_sub_field('packages_name').'</li>';
                    
                        endwhile;
                        echo '</ul>';
                    else :				
                        // no rows found				
                    endif;
                ?> 
                <div class="paclages-button">
                    <a href="#contact-page-anchor">Click here</a>
                </div><!-- /.paclages-button -->
            </div><!-- /.packages-box -->
        </div><!-- /.col-md-4 -->
        <div class="col-xs-12 col-md-4 col00">
        	<h3 class="packages-title"><?php echo get_field('title_2',$id); ?></h3>
            <div class="packages-sub-title"><p><?php echo get_field('sub_title_2',$id); ?></p></div>
            	<div class="packages-box packages-box2">
					<?php						
                        if( have_rows('table_content_2',$id) ):
                            echo '<ul class="package-line package-line2">';
                            // loop through the rows of data
                            while ( have_rows('table_content_2',$id) ) : the_row();				
                                // display a sub field value
                                echo '<li>'.get_sub_field('packages_name').'</li>';
                        
                            endwhile;
                            echo '</ul>';
                        else :				
                            // no rows found				
                        endif;
                    ?> 
                <div class="paclages-button">
                    <a href="#contact-page-anchor">Click here</a>
                </div><!-- /.paclages-button -->
              </div><!-- /.packages-box -->  
        </div><!-- /.col-md-4 -->
        <div class="col-xs-12 col-md-4 col00">
        	<h3 class="packages-title"><?php echo get_field('title_3',$id); ?></h3>
            <div class="packages-sub-title"><p><?php echo get_field('sub_title_3',$id); ?></p></div>
            <div class="packages-box packages-box3">
					<?php						
                        if( have_rows('table_content_3',$id) ):
                            echo '<ul class="package-line package-line3">';
                            // loop through the rows of data
                            while ( have_rows('table_content_3',$id) ) : the_row();				
                                // display a sub field value
                                echo '<li>'.get_sub_field('packages_name').'</li>';
                        
                            endwhile;
                            echo '</ul>';
                        else :				
                            // no rows found				
                        endif;
                    ?> 
                <div class="paclages-button">
                    <a href="#contact-page-anchor">Click here</a>
                </div><!-- /.paclages-button -->
              </div><!-- /.packages-box -->  
        </div><!-- /.col-md-4 -->
    </div><!-- /.row -->
    <?php } ?>
    <div class="row testcol">
    	<div class="col-xs-12" style="padding-top: 40px;">
        	<?php
				$after_package_title =get_field('after_package_title');
			 if(!empty($after_package_title)){ ?>
        	<h2 class="text-center text-uppercase" style="padding-bottom: 0; margin-top: 0; padding-top: 0; margin-bottom: 15px;">
            	<!--<span class="h2-subtitle"></span>-->
                <?php echo get_field('after_package_title'); ?>
            </h2>
            <?php } ?>
            <?php echo get_field('after_packages_content'); ?>
        </div><!-- /.col-xs-12 -->
    </div><!-- /.row -->
    
	<script type="text/javascript"> 
		
		
		pk1 = jQuery('.package-line1').outerHeight();
		pk2 = jQuery('.package-line2').outerHeight();
		pk3 = jQuery('.package-line3').outerHeight();
		
		var fruits = [pk1,pk2,pk3]; 
		var maxValueInArray = Math.max.apply(Math, fruits);
		//alert(maxValueInArray);

		jQuery('.package-line').css({'height': maxValueInArray});
		//alert(pk3);
    </script>	
<?php }

add_shortcode('page-packages', 'ultimate_packages_page');

/************************
21-5-2016
*******************************/
function add_theme_favicon() {
	if ( function_exists( 'ot_get_option' ) ) {
	  $site_favicon = ot_get_option( 'site_favicon' ); 
	}
	echo '<link rel="shortcut icon" href="' . $site_favicon . '" >';
}
add_action('wp_head', 'add_theme_favicon');



/********************************
31-5-2016
********************************/
function make_post_page_for_all( $atts ) {
	extract( shortcode_atts( array(
		'grid_title'	=> null,	
        'type' 			=> 'page',
		'parent'		=> null,
		'view_type'		=> 'grid',
		'grid_size'		=> 3
		
    ), $atts) ); ?>
    
    <?php
	$totalImg = get_template_directory_uri() . '/images/placeholder.jpg';
	wp_reset_query();
	$args = array(
		'post_type'      => $type,
		'post_parent'	 => $parent,
		'posts_per_page' => -1,
		'order'          => 'desc',
		'orderby'        => 'date'
	 );
	$the_query = new WP_Query( $args );
	// The Loop
	$i=0;
	$j = $grid_size;
	if($view_type == 'grid'){
	echo '<div class="row grid-block-all">';
	//echo '<div class="col-md-10 col-md-offset-1"><h2 class="text-center text-uppercase">'.$grid_title.'</h2></div>';
	//if($view_type == 'grid'){
		if ( $the_query->have_posts() ) { 
			
			while ( $the_query->have_posts() ) {
				$the_query->the_post();
				$thumb = get_post_thumbnail_id();
				if($thumb){
					$img_url = wp_get_attachment_url( $thumb,'full' ); //get full URL to image (use "large" or "medium" if the images too big)
					$image = aq_resize( $img_url, 400, 300, true ); //resize & crop the image
					echo '<div class="col-md-'. 12/$grid_size .' '.$i.'">';	 
					echo '<a href="'.get_permalink().'"><img src="'.$image.'" class="img-responsive alt="'.get_the_title().'"></a>'; 
					echo '<p class="text-center owl-title"><a href="'.get_permalink().'">'.get_the_title().'</a><span>'.get_field('short_text').'</span></p>';
					echo '</div>';
					
				}else{
					$img_url = $totalImg; //get full URL to image (use "large" or "medium" if the images too big) 
					echo '<div class="col-md-'. 12/$grid_size .' '.$i.'">';	
					echo '<a href="'.get_permalink().'"><img src="'.$img_url.'" class="img-responsive" alt="'.get_the_title().'"></a>';	
					echo '<p class="text-center owl-title"><a href="'.get_permalink().'">'.get_the_title().'</a><span>'.get_field('short_text').'</span></p>';
					echo '</div>';
				}
				$i++;
				if($i==$j){
					$i=0;
					echo '</div><!-- /.row --><div class="row">';		
				}
				
			}
		} else {
			// no posts found
		}
			if($i!=$j){
					echo '</div><!-- /.row -->';
			}
	
	 }	// end grid
	 
	 
	 if($view_type == 'list'){
	echo '<div class="row">';
	//echo '<div class="col-md-10 col-md-offset-1"><h2 class="text-center text-uppercase">'.$grid_title.'</h2></div>';
	//if($view_type == 'grid'){
		echo '<div class="col-md-10 col-md-offset-1"><ul class="list-view-grid">';
		if ( $the_query->have_posts() ) { 
			
			while ( $the_query->have_posts() ) {
				$the_query->the_post();
				$thumb = get_post_thumbnail_id(); ?>
                <div class="row">
                	<div class="col-md-3">
                    	<?php
						
						$img_url = wp_get_attachment_url( $thumb,'full' ); //get full URL to image (use "large" or "medium" if the images too big)
					$image = aq_resize( $img_url, 400, 300, true ); //resize & crop the image
					echo '<a href="'.get_permalink().'"><img src="'.$image.'" class="img-responsive img-news" alt="'.get_the_title().'"></a>';
						?>
                    </div>
                    <div class="col-md-9">
                    	<?php
						//echo '<li><a href="'.get_permalink().'">'.get_the_title().'</a>'; 
					echo '<p class="text-left"><a href="'.get_permalink().'">'.get_the_title().'</a>
					<span><b>'.get_the_date('Y-m-d').'</b></span><span>'.get_field('short_text').'</span></p>';
						?>
                    </div>
                </div>
                <div class="spacebar15" style="display: block; overflow: hidden;"></div>
				 <?php 
					    
				
			}
		} else {
			// no posts found
		} 
		echo '</ul></div><!-- /.div-xs-12 --></div><!-- /.row -->';
	 }	// end list
	
		
	//echo $grid_size;
	/* Restore original Post Data */
	wp_reset_query();
	?> 
	
<?php }

add_shortcode('ultimate-posts-view', 'make_post_page_for_all');

// Removes from post and pages
add_action('init', 'remove_comment_support', 100);

function remove_comment_support() {
    remove_post_type_support( 'post', 'comments' );
    remove_post_type_support( 'page', 'comments' );
}