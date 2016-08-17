<?php
/**
 * Template Name: Page Packages
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

$first_column_title = get_field('first_column_title');
$first_column_sub_title = get_field('first_column_sub_title');
$first_column_content = get_field('first_column_content');


 
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
                	<?php echo $first_column_title; ?>
                    <span class="h2-subtitle"><?php echo $first_column_sub_title; ?></span>
                </h2>
            </div><!-- /.col-xs-12 -->
            <div class="col-md-10 col-md-offset-1">
            	<hr class="hr-margin-no-top" />
            	<p><?php echo $first_column_content; ?></p>
            </div>
        </div><!-- /. row --> 
</div><!-- /.withnewBG -->
<div class="container bgwhite homeposition only-gallery" style="padding-top: 15px;">
    <div class="row">
         <?php  echo gallery_images_three_column($feature_offer_images); ?> 
    </div><!-- /.row -->  
</div>

<div class="container bgwhite homecaresual">
<div class="row rowbottomarrow">
	<div class="col-xs-12">
    	<?php
			$second_column_title = get_field('second_column_title');
			$second_column_content = get_field('second_column_content'); 
		?>
    	<h2 class="text-center text-uppercase">
			<?php echo $second_column_title; ?> 
        </h2>
    </div><!-- /.col-xs-12 -->
    
    <div class="common-feature-image">
    <?php
	// check if the repeater field has rows of data
	if( have_rows('second_column_images') ):	
		// loop through the rows of data
		while ( have_rows('second_column_images') ) : the_row();
			echo '<div class="col-xs-12 col-md-4 col-sm-4">';
				echo '<img src="'.get_sub_field('feature_package_image').'" class="img-responsive" alt="" />';			
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
	<div class="bg-testomnial">
    <div class="container bgwhite testimonialHome">
        <div class="row">
            <div class="col-xs-12 col-md-6 nopadding left-col">
                  
                 <div class="verticalDiv">
                      <div class="verticalDivInner">
                      
                      
                      
                         
     <div id="carousel-testimonial" class="carousel fade" data-ride="carousel">
              <!-- Indicators -->
            
              <!-- Wrapper for slides -->
              <div class="carousel-inner" role="listbox">
                
                  
                  <?php
					  $args = array(
						'post_type' 		=> 'ut-testimonial',
						'posts_per_page' 	=> 5);
					$query = new WP_Query( $args );
					$q = 0;
					
					if ( $query->have_posts() ) :
					while( $query->have_posts() ) : $query->the_post();
					$rating = get_post_meta($post->ID, "_rating", true);
					$left = 5 - $rating;
					 ?>
				 
						
                    <div class="item <?php if($q == 1 ){ echo 'active'; } ?>">
                      <h2> <?php echo get_the_excerpt(); ?></h2>
                         <div class="ratinglist">
                         	<?php for($x=0;$x<$rating;$x++){ ?>
                                <i class="fa fa-star fa-fw fa-2x"></i> 
                            <?php } ?>
                            <?php for($x=0;$x<$left;$x++){ ?>
                                <i class="fa fa-star fa-fw fa-2x" style="color: #2f354b;"></i> 
                            <?php } ?>
                         </div><!-- /.ratinglist --> 
                         <p class="testemonial-author"><?php the_title(); ?>, <?php echo get_the_date( 'M. Y' ); ?></p>
                    </div><!-- /.item -->
					<?php $q++;
					endwhile; endif;
					?> 
                  
                  
              </div><!-- /.carousel-inner -->
             
            </div><!-- /#carousel-testimonial -->
                      
                      
                      
                         <!--<h2> 123'm a block-level element of an unknown height and width, centered vertically within my parent.</h2>
                         <div class="ratinglist">
                            <i class="fa fa-star fa-fw fa-2x"></i>
                            <i class="fa fa-star fa-fw fa-2x"></i>
                            <i class="fa fa-star fa-fw fa-2x"></i>
                            <i class="fa fa-star fa-fw fa-2x"></i>
                            <i class="fa fa-star fa-fw fa-2x"></i>
                         </div> /.ratinglist 
                         <p class="testemonial-author">Gamen M. Jan 2015</p>-->
                      </div><!-- /.verticalDivInner -->
                </div><!-- /.verticalDiv -->
            </div><!-- /.col-md-6 -->
            <div class="col-xs-12 col-md-6 nopadding">
            	<?php
				if ( function_exists( 'ot_get_option' ) ) { 
				  $testimonial_random_image = ot_get_option('testimonial_random_image');
				  $testimonial_image_caption = '';
				  $testimonial_image_caption = ot_get_option('testimonial_image_caption'); 
				  $testimonial_social_link = ot_get_option('testimonial_social_link'); 
				}
				?>
                <div class="verticalDiv" style="background: url(<?php echo $testimonial_random_image; ?>) center center no-repeat;">
                      <div class="verticalDivInner"> 
                         	<h2><?php echo $testimonial_image_caption; ?></h2> 
                         <a class="allbuttonS testimonial-button" href="<?php echo $testimonial_social_link; ?>">Social</a>
                         <!--<h4 class="week-post-time">abount 3 hours ago</h4>-->
                      </div><!-- /.verticalDivInner -->
                </div><!-- /.verticalDiv -->
            </div><!-- /.col-md-6 -->
        </div><!-- /.row -->
        <div class="row" style="display: none;">
        	<?php
        	wp_reset_query();
// 			if ( function_exists( 'ot_get_option' ) ) {
// 			  $three_column_block_title = ot_get_option( 'three_column_block_title' );
// 			  $three_column_subtitle = ot_get_option( 'three_column_subtitle' );
// 			  $three_column_short_texts = ot_get_option( 'three_column_short_texts' ); 
// 			}
			?>
        	<div class="col-xs-12">
            	<h2 class="text-center text-uppercase">
                	<?php echo get_field('third_column_title_page',$post->ID); ?>
                	<span class="h2-subtitle"><?php echo get_field('third_column_subtitle',$post->ID); ?></span>
                </h2>
            </div><!-- /.col-xs-12 --> 
        </div><!-- /.row --> 
         <div class="content-box">
			<?php while ( have_posts() ) : the_post(); ?>
				 <?php the_content(); ?> 
			<?php endwhile; ?> 
			<?php wp_reset_postdata(); ?> 
        </div><!-- /.content-box -->
        <?php echo do_shortcode('[col_blank_space height="40"]'); ?>
 		
        
        <?php echo do_shortcode('[page-packages]');
    //$after_packages_content = get_field('after_packages_content');
    ?> 
    <div class="row" style=" padding-top: 30px;">
    	<div class="col-xs-12">
        	<?php echo do_shortcode('[contact_form_page title="Contact us to book" sub_title="Please complete the form with as much information as possible and we will get back to you to dicuss your Ultimate Adventure."]'); ?>
        </div><!-- /.col-xs-12 -->
    </div><!-- /. row --> 
        
    </div><!-- /.container -->
    
</div><!-- /.bg-testomnial -->    
    

<?php if (has_post_thumbnail( $post->ID ) ): ?>
	<?php //$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' ); ?> 
<?php endif; ?>

<?php //echo do_shortcode('[ultimate-package-form wrap="1" wrap_title="BUILD YOUR OWN PERFECT ADVENTURE" wrap_sub_title="Let us create the perfect package for you & we\'ll do the all planning." form_title="What are you looking for ?"]'); ?>
 
<div class="container">
    
</div> 
<?php echo do_shortcode('[page_location_map title="Talk to us" subtitle="For more information and help." style="padding-bottom: 30px; margin-top: 0; padding-top: 10px;"]'); ?>   
    



 
 
</div><!-- /.withnewBG -->

<script type="text/javascript">
/*	jQuery(document).ready(function() { 
  
	jQuery('.scrollbox').enscroll({
		showOnHover: true,
		verticalTrackClass: 'track3',
		verticalHandleClass: 'handle3'	
	});
});*/ 
</script>

<?php get_footer(); ?>