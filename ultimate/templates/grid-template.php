<?php
/**
 * Template Name: Grid Template
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

$header_title = get_field('first_column_title_grid');
$header_sub_title = get_field('header_sub_title');
$first_column_content_1 = get_field('first_column_content_1');


 
?>
<?php if (has_post_thumbnail( $post->ID ) ): ?>
	<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' ); ?>
         <style type="text/css">
			.single-page{
				background: url(<?php echo $image[0]; ?>) no-repeat center center; 
				  -webkit-background-size: cover;
				  -moz-background-size: cover;
				  -o-background-size: cover;
				  background-size: cover;
			}
		</style>
    <?php endif; ?>


<div class="headerBlock3"></div><!-- /.headerBlock3 -->
<div class="container bgwhite homeposition homeposition-new">
    	<div class="row">
        	<div class="col-md-10 col-md-offset-1">
            	<h2 class="text-center text-uppercase">
                	<?php echo $header_title; ?>
                    <?php if(!empty($header_sub_title)){ ?>
                    	<span class="h2-subtitle"><?php echo $header_sub_title; ?></span>
                	<?php } ?>
                </h2>
               <!-- <hr class="hr-margin-no-top" />--> 
            </div><!-- /.col-xs-12 -->
            <?php if(!empty(get_field('secondary_content'))): ?>
            <div class="col-md-10 col-md-offset-1">
            	<hr class="hr-margin-no-top" /> 
                <?php the_field('secondary_content'); ?> 
            </div>
            <?php endif; ?>
        </div><!-- /. row --> 
</div><!-- /.withnewBG -->
<div class="container bgwhite homeposition only-gallery">
    <!--<div class="row">
         <?php  //echo gallery_images_three_column($feature_offer_images); ?> 
    </div> /.row--> 
    <?php while ( have_posts() ) : the_post(); ?>
		<?php the_content(); ?>
	<?php endwhile; ?> 
</div> 

<div id="withnewBG"> </div><!-- /.withnewBG -->
<?php get_footer(); ?>