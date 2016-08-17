<?php
/**
 * The template for displaying pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other "pages" on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage Ultimate_Advanture
 * @since ultimate v1.0
 */
 
get_header(); 
if ( function_exists( 'ot_get_option' ) ) { 
  $feature_offer_images = ot_get_option('feature_offer_images');
}

$first_column_title = get_field('first_column_title');
$first_column_sub_title = get_field('first_column_sub_title');
$first_column_content = get_field('first_column_content');


 
?>
<?php if (has_post_thumbnail( $post->ID ) ): ?>
	<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' ); ?>
         <style type="text/css">
			.single-page{
				background: url(<?php echo $image[0]; ?>);
				background-position: center;
				width: 100%;
    			background-size: 100%;
			}
		</style>
    <?php endif; ?>


 
<div class="container bgwhite homeposition homeposition-new">         
    	<div class="row">
        	<div class="col-md-10 col-md-offset-1">
            	<h2 class="text-center text-uppercase">
                	<?php the_title(); ?>
                    <span class="h2-subtitle"><?php the_field('add_subtitle'); ?></span>
                </h2>
            </div><!-- /.col-xs-12 -->
            <div class="col-md-10 col-md-offset-1">
            	<hr class="hr-margin-no-top" /> 
            </div>
        </div><!-- /. row --> 
</div><!-- /.withnewBG --> 

<div id="withnewBG" style="margin-top: 0;">     
<div class="container bgwhite">
<div class="row">
    <div class="col-xs-12">
     <?php
		//// Start the loop.
		while ( have_posts() ) : the_post(); 
			 the_content();
		endwhile;
    ?>  
    </div><!-- /.col-xs-12 -->
</div><!-- /.row -->
	<div class="row">
    	<div class="col-xs-12">
        	<?php echo do_shortcode('[contact_form_page title="Contact us to book" sub_title="Please complete the form with as much information as possible and we will get back to you to dicuss your Ultimate Adventure."]'); ?>
        </div><!-- /.col-xs-12 -->
    </div><!-- /. row --> 
</div><!-- /.bgwhite -->


<?php echo do_shortcode('[ultimate-package-form wrap="1" wrap_title="BUILD YOUR OWN PERFECT ADVENTURE" wrap_sub_title="Let us create the perfect package for you & we\'ll do the all planning" form_title="Whata are you looking for ?"]'); ?>

<?php echo do_shortcode('[page_location_map title="Talk to us" subtitle="For more information and help." style="padding-bottom: 30px; margin-top: 0; padding-top: 10px;"]'); ?>   
</div><!-- /.withnewBG -->
<?php get_footer(); ?>