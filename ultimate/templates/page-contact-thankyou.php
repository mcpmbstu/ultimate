<?php
/**
 * Template Name: Page Thankyou
 *
 * @package WordPress
 * @subpackage Ultimate_Advanture
 * @since ultimate v1.0
 */
 
get_header(); 
global $post;
if ( function_exists( 'ot_get_option' ) ) { 
  $feature_offer_images = ot_get_option('feature_offer_images');
}

$header_title = get_field('header_title');
$header_sub_title = get_field('header_sub_title');
$first_column_content_1 = get_field('first_column_content_1');


 
?>
<?php if (has_post_thumbnail( $post->ID ) ): ?>
	<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' ); ?>
         <style type="text/css">
			.single-page{
				background: url(<?php echo $image[0]; ?>);
				/*background-position: center;*/
				width: 100%;
    			background-size: 100%;
			}
		</style>
    <?php endif; ?>


<div class="headerBlock3"></div><!-- /.headerBlock3 -->
<div class="container bgwhite homeposition homeposition-new">
    	<div class="row">
        	<div class="col-md-10 col-md-offset-1">
            	<h2 class="text-center text-uppercase">
                	<?php the_title(); ?>
                </h2>
            </div><!-- /.col-xs-12 -->
            <div class="col-md-10 col-md-offset-1">
            	<hr class="hr-margin-no-top" />
            	<!--<p><?php //echo $first_column_content; ?></p>-->
                <?php while ( have_posts() ) : the_post(); ?>
                	<?php the_content(); ?>
                <?php endwhile; ?>
            </div>
        </div><!-- /. row --> 
</div><!-- /.withnewBG --> 

 



 



<?php get_footer(); ?>