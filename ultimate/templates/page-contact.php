<?php
/**
 * Template Name: Page Contact
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
                	<?php echo $header_title; ?>
                    <?php if(!empty($header_sub_title)){ ?>
                    	<span class="h2-subtitle"><?php echo $header_sub_title; ?></span>
                	<?php } ?>
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
<div class="container bgwhite homeposition only-gallery" style="padding-top: 15px;">
    <div class="row">
         <?php  echo gallery_images_three_column($feature_offer_images); ?> 
    </div><!-- /.row-->  
</div> 

<div class="container bgwhite homecaresual">
<div class="row rowbottomarrow">
	<div class="col-xs-12">
    	<?php
			$second_column_title = get_field('second_column_title_2');
			$second_column_content = get_field('second_column_content_2'); 
		?>
    	<h2 class="text-center text-uppercase">
			<?php echo $second_column_title; ?> 
        </h2>
    </div><!-- /.col-xs-12 -->
    
    <div class="common-feature-image">
    <?php
	// check if the repeater field has rows of data
	if( have_rows('second_content_images') ):	
		// loop through the rows of data
		while ( have_rows('second_content_images') ) : the_row();
			echo '<div class="col-xs-12 col-md-4 col-sm-4">';
				echo '<a href="'.get_sub_field('image_link').'"><img src="'.get_sub_field('second_content_images').'" class="img-responsive" alt="" /></a>';			
			echo '</div><!-- /.col-md-4 -->';	
		endwhile;	
	else :	
		// no rows found	
	endif;	
	?>  
    <div class="clearfix"></div>
    </div><!-- /.common-feature-image -->
    <div class="spacebar30"></div><!-- /. spacebar30 -->
    <div class="col-xs-10 col-xs-offset-1">
    	<p class="text-center" style="margin-bottom: 0;">
			<?php echo $second_column_content;  ?>
        </p>
         <div class="spacebar30"></div><!-- /. spacebar30 -->
    </div><!-- /.col-xs-12 --> 
   
</div><!-- /.row -->
</div><!-- /.container -->

<div id="withnewBG"> 
    
<div class="container bgwhite">
	<div class="row">
    	<div class="col-xs-12">
        	<div class="spacebar15"></div><!-- /. spacebar30 -->
        	<?php echo do_shortcode('[contact_form_page title="Contact us to book" sub_title="Please complete the form with as much information as possible and we will get back to you to dicuss your Ultimate Adventure."]'); ?>
        </div><!-- /.col-xs-12 -->
    </div><!-- /. row --> 
</div><!-- /.bgwhite -->
<?php $mapStatus = get_field('map_view'); ?>
<?php 
if($mapStatus ==1){
	echo do_shortcode('[page_location_map title="Talk to us" subtitle="For more information and help." style="padding-bottom: 30px; margin-top: 0; padding-top: 10px;"]');
}
?> 
 
    



 
 
</div><!-- /.withnewBG -->

 



<?php get_footer(); ?>