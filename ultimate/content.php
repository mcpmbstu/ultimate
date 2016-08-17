<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */
 


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
                    <?php if(!empty($header_sub_title)){ ?>
                    	<span class="h2-subtitle"><?php echo $header_sub_title; ?></span>
                	<?php } ?>
                </h2>
                <hr class="hr-margin-no-top" /> 
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
    	<div class="row">
        	<div class="col-md-10 col-md-offset-1">
				<?php the_content(); ?>
        	</div>
        </div> 
</div> 

<div id="withnewBG"> </div><!-- /.withnewBG -->


