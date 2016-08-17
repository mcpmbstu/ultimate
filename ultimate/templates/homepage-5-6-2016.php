<?php
/**
 * Template Name: Homepage
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */
 
get_header(); 
if ( function_exists( 'ot_get_option' ) ) {
  $tab_title1 = ot_get_option( 'tab_title1' );
  $tab_title2 = ot_get_option( 'tab_title2' );
  $tab_title3 = ot_get_option( 'tab_title3' );
  $tab_content1 = ot_get_option('tab_content1');
  $tab_content2 = ot_get_option('tab_content2');
  $tab_content3 = ot_get_option('tab_content3'); 
  
  $feature_offer_images = ot_get_option('feature_offer_images');
}
?>

<div class="headerBlock3"></div><!-- /.headerBlock3 -->

<div class="container bgwhiteNew homeposition homeposition-new">
<div class="main-tab-div">
	<div class="row"> 
    
    <div id="homeTab" class="hidden-xs">
      <!-- Nav tabs -->
      <ul class="nav nav-tabs homepagetab" role="tablist">
        <li role="presentation" class="tab-li-0 active"><a href="#home" class="accord accord-0" aria-controls="home" role="tab" data-toggle="tab"><?php echo $tab_title1; ?></a></li>
        <li role="presentation" class="tab-li-1"><a href="#profile" class="accord accord-1" aria-controls="profile" role="tab" data-toggle="tab"><?php echo $tab_title2; ?></a></li>
        <li role="presentation" class="tab-li-2"><a href="#messages" class="accord accord-2" aria-controls="messages" role="tab" data-toggle="tab"><?php echo $tab_title3; ?></a></li> 
      </ul>
    
      <!-- Tab panes -->
      <div class="tab-content">
        <div role="tabpanel" class="tab-pane tabmain-0 active" id="home">
			<div class="row">
        	 	<?php echo $tab_content1; ?>
            </div><!-- /.row-->
        </div><!-- /.tab-pane -->
        <div role="tabpanel" class="tab-pane tabmain-1" id="profile">
			<div class="row">
        	 	<?php echo $tab_content2; ?>
            </div><!-- /.row-->
        </div><!-- /.tab-pane -->
        <div role="tabpanel" class="tab-pane tabmain-2" id="messages">
			<div class="row">
        	 	<?php echo $tab_content3; ?>
            </div><!-- /.row-->
        </div><!-- /.tab-pane --> 
      </div><!-- /.tab-content -->
    </div><!-- /#homeTab-->
    
    <div class="mobileonly visible-xs-block visible-sm-block">
             <!-- This is for jQuery function loop --> 
            <div class="accordion2 accordion-maintab">
            
            </div><!-- /.accordion -->
	</div><!-- /.mobileonly -->
        
    <script type="text/javascript">

    	jQuery(document).ready(function() {
			//alert(jQuery('.homepagetab .accord-1').text());
			var number = 3;	
			var classView = '.accordion-maintab';
			var className = '.tab-li-';
			var innerClass = '.tabmain-';	
			var classTitle = '.accord';
			loop_for_accordion1(classView,number,className,innerClass,classTitle);	 
		});
    </script>
    </div><!-- /.mobileonly -->

</div>  <!-- /.row-->    
</div> <!-- /.main-tab-div --> 
	 
</div><!-- /.container -->  
<div class="container bgwhite homeposition only-gallery" style="padding-top: 15px;">
    <div class="row">
         <?php  echo gallery_images_three_column($feature_offer_images); ?> 
    </div><!-- /.row -->  
</div> 
<div class="container bgwhite homecaresual">
<div class="row rowbottomarrow">
	<div class="col-xs-12">
    	<?php
			if ( function_exists( 'ot_get_option' ) ) {
			  $feature_packages_title = ot_get_option( 'feature_packages_title' );
			  $feature_packages_sub_title = ot_get_option( 'feature_packages_sub_title' ); 
			}
		?>
    	<h2 class="text-center text-uppercase"><?php echo $feature_packages_title; ?>
        	<span class="h2-subtitle"><?php echo $feature_packages_sub_title; ?></span>
        </h2>
    </div><!-- /.col-xs-12 -->
    
    <div class="col-xs-12">
    	<?php echo do_shortcode('[ultimate-carasual page_parent="55"]'); ?>
    </div><!-- /.col-xs-12 -->
    <div class="col-xs-12 visible-xs text-center" style="padding-bottom: 35px;">
    	<a href="#" class="allbutton allbutton-2x">View Gallery</a>
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
                         <p class="testemonial-author"><?php the_title(); ?>, <?php //echo get_the_date( 'M. Y' ); ?></p>
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
                <div class="verticalDiv" style="background: url(<?php echo get_template_directory_uri(); ?>/images/banner1.png) center center no-repeat;">
                      <div class="verticalDivInner">
                         <h2><strong>Fun or Fear? - you decide.</strong> What a great photo from last weeks group.</h2>
                         <h4 class="week-post-time">abount 3 hours ago</h4>
                         <div class="week-post-social">
                             <span class="fa-stack fa-2x">
                              <i class="fa fa-circle fa-stack-2x"></i>
                              <i class="fa fa-facebook fa-stack-1x fa-inverse"  style="color: #666;"></i>
                            </span><!-- /. social file -->
                            <span class="fa-stack fa-2x">
                              <i class="fa fa-circle fa-stack-2x"></i>
                              <i class="fa fa-twitter fa-stack-1x fa-inverse"  style="color: #666;"></i>
                            </span><!-- /. social file -->
                            <span class="fa-stack fa-2x">
                              <i class="fa fa-circle fa-stack-2x"></i>
                              <i class="fa fa-linkedin fa-stack-1x fa-inverse"  style="color: #666;"></i>
                            </span><!-- /. social file -->
                        </div><!-- /.week-post-social -->
                      </div><!-- /.verticalDivInner -->
                </div><!-- /.verticalDiv -->
            </div><!-- /.col-md-6 -->
        </div><!-- /.row -->
        <div class="row">
        	<?php
			if ( function_exists( 'ot_get_option' ) ) {
			  $three_column_block_title = ot_get_option( 'three_column_block_title' );
			  $three_column_subtitle = ot_get_option( 'three_column_subtitle' );
			  $three_column_short_texts = ot_get_option( 'three_column_short_texts' ); 
			}
			?>
        	<div class="col-xs-12">
            	<h2 class="text-center text-uppercase">
                	<?php echo $three_column_block_title ?>
                	<span class="h2-subtitle"><?php echo $three_column_subtitle ?></span>
                </h2>
            </div><!-- /.col-xs-12 -->
            <div class="col-xs-12">
            	<p class="gray-paragraph"><?php echo $three_column_short_texts ?></p>
            </div><!-- /.col-xs-12 -->
        </div><!-- /.row -->
        
        <div class="row row-lists-view hidden-xs">
        	<?php
			if ( function_exists( 'ot_get_option' ) ) {
			  $column_1_title = ot_get_option( 'column_1_title' );
			  $column_1_category_list = ot_get_option( 'column_1_category_list' );
			  $column_1_number_of_posts = ot_get_option( 'column_1_number_of_posts' );
			  $column_1_more_button_texts = ot_get_option('column_1_more_button_texts');
			  $first_feature_ids = ot_get_option('first_feature_ids');
			  $myArray = explode(',', $first_feature_ids); 
			}
			?>
        	<div class="col-md-4 list-col-0">
           	  <h3 class="col-heading"><?php echo $column_1_title; ?></h3>
              
              <?php 
			  
			 
			  if (empty($first_feature_ids)) {
				// The Query
				$the_query = new WP_Query( array( 
					'post_type' 		=> $column_1_category_list,
					'posts_per_page'	=> $column_1_number_of_posts
					) ); 
					
					}else{
				$the_query = new WP_Query( array( 
					'post_type'	=> $column_1_category_list,
					'post__in'	=> $myArray,
					'orderby'=>'post__in'
					) ); 	
				 
				}
			// The Loop
			if ( $the_query->have_posts() ) {
				echo '<ul>';
				while ( $the_query->have_posts() ) {
					$the_query->the_post();
					
					$content = get_the_content(); 
					//echo wp_filter_nohtml_kses( $content ); //or strip_tags
		
					echo '<li><p><a href="'.get_the_permalink().'">' . get_the_title() . '</a><p>';
					//print truncate(wp_filter_nohtml_kses( $content ), 75);
					$short_text = get_field('short_text');
					print truncate(wp_filter_nohtml_kses( $short_text ), 75);
					echo '</li>';
				}
				echo '</ul>';
			} else {
				// no posts found
			}
			/* Restore original Post Data */
			wp_reset_postdata();
			$link = home_url( '?post_type=' . $column_1_category_list );
			?> 
                <p><a href="#<?php //echo $link; ?>" id="all-activity" class="link-more-color"><?php echo $column_1_more_button_texts; ?> <i class="fa fa-chevron-right"></i></a></p>
            </div><!-- /.col-md-4 -->
            
            
            <?php
			if ( function_exists( 'ot_get_option' ) ) {
			  $column_2_titile = ot_get_option( 'column_2_titile' );
			  $column_2_category_list = ot_get_option( 'column_2_category_list' );
			  $column_2_number_of_posts = ot_get_option( 'column_2_number_of_posts' );
			  $column_2_more_button_texts = ot_get_option('column_2_more_button_texts'); 
			  $second_feature_ids = ot_get_option('second_feature_ids');
			  $myArray = explode(',', $second_feature_ids); 
			}
			?>
        	<div class="col-md-4 list-col-1">
           	  <h3 class="col-heading"><?php echo $column_2_titile; ?></h3>
              
              <?php 
			  if (empty($second_feature_ids)) {
			// The Query
			$the_query = new WP_Query( array( 
				'post_type' 		=> $column_2_category_list,
				'posts_per_page'	=> $column_2_number_of_posts
				) ); 
				
			}else{
				$the_query = new WP_Query( array( 
					'post_type'	=> $column_2_category_list,
					'post__in'	=> $myArray,
					'orderby'=>'post__in'
					) ); 	
				 
				}	
			
			// The Loop
			if ( $the_query->have_posts() ) {
				echo '<ul>';
				while ( $the_query->have_posts() ) {
					$the_query->the_post();
					
					$content = get_the_content(); 
					//echo wp_filter_nohtml_kses( $content ); //or strip_tags
		
					echo '<li><p><a href="'.get_the_permalink().'">' . get_the_title() . '</a><p>';
					//print truncate(wp_filter_nohtml_kses( $content ), 75);
					$short_text = get_field('short_text');
					print truncate(wp_filter_nohtml_kses( $short_text ), 75);
					echo '</li>';
				}
				echo '</ul>';
			} else {
				// no posts found
			}
			/* Restore original Post Data */
			wp_reset_postdata();
			$link = home_url( '?post_type=' . $column_2_category_list );
			?> 
                <p><a href="<?php //echo $link; ?>" id="all-activity2" class="link-more-color"><?php echo $column_2_more_button_texts; ?> <i class="fa fa-chevron-right"></i></a></p>
            </div><!-- /.col-md-4 -->
            
            
            
             
             <?php
			if ( function_exists( 'ot_get_option' ) ) {
			  $column_3_titile = ot_get_option( 'column_3_titile' );
			  $column_3_category_list = ot_get_option( 'column_3_category_list' );
			  $column_3_number_of_posts = ot_get_option( 'column_3_number_of_posts' );
			  $column_3_more_button_texts = ot_get_option('column_3_more_button_texts'); 
			  $third_feature_ids = ot_get_option('third_feature_ids');
			  $myArray = explode(',', $third_feature_ids); 
			}
			?>
        	<div class="col-md-4 list-col-2">
           	  <h3 class="col-heading"><?php echo $column_3_titile; ?></h3>
              
              <?php 
			  if (empty($third_feature_ids)) {
			// The Query
			$the_query = new WP_Query( array( 
				'post_type' 		=> $column_3_category_list,
				'posts_per_page'	=> $column_3_number_of_posts
				) );
				
				}else{
				$the_query = new WP_Query( array( 
					'post_type'	=> $column_3_category_list,
					'post__in'	=> $myArray,
					'orderby'=>'post__in'
					) ); 	
				 
				} 
			
			// The Loop
			if ( $the_query->have_posts() ) {
				echo '<ul>';
				while ( $the_query->have_posts() ) {
					$the_query->the_post();					
					$content = get_the_content();  		
					echo '<li><p><a href="'.get_the_permalink().'">' . get_the_title() . '</a><p>';
					$short_text = get_field('short_text');
					print truncate(wp_filter_nohtml_kses( $short_text ), 75);
					//print truncate(wp_filter_nohtml_kses( $content ), 100);
					echo '</li>';
				}
				echo '</ul>';
			} else {
				// no posts found
			}
			/* Restore original Post Data */
			wp_reset_postdata();
			$link = home_url( '?post_type=' . $column_3_category_list );
			?> 
                <p><a href="<?php //echo $link; ?>" id="all-activity3" class="link-more-color"><?php echo $column_3_more_button_texts; ?> <i class="fa fa-chevron-right"></i></a></p>
              
            </div><!-- /.col-md-4 -->
             
            <div class="col-md-12 panel1"> 
            	<div class="row">
                	<div style="padding: 20px; background: #f1f1f1;">
                    	<?php 
						//clean_custom_menu(8); 
						$menu_items = wp_get_nav_menu_items(8);
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
                   </div>
                </div>
            </div><!-- #panel1 -->
            <div class="col-md-12 panel2"> 
            	<div class="row">
                	<div style="padding: 20px; background: #f1f1f1;">
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
                   </div>
                </div>
            </div><!-- #panel1 -->
            <div class="col-md-12 panel3"> 
            	<div class="row">
                	<div style="padding: 20px; background: #f1f1f1;">
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
                   </div>
                </div>
            </div><!-- #panel1 -->
            
             
             
        </div><!-- /.row -->
        <script type="text/javascript">
			jQuery( document ).ready(function(){
				jQuery(".panel1, .panel2, .panel3").hide();
				jQuery("#all-activity").click(function(){
					jQuery(".panel2, .panel3").hide();
					jQuery(".panel1").slideToggle();
					return false;
				});
				jQuery("#all-activity2").click(function(){
					jQuery(".panel1, .panel3").hide();
					jQuery(".panel2").slideToggle();
					return false;
				});
				jQuery("#all-activity3").click(function(){
					jQuery(".panel1, .panel2").hide();
					jQuery(".panel3").slideToggle();
					return false;
				});
			});
		</script>
        
        
	<div class="row row-lists-view bookingtab clearfix visible-xs-block">
    	<div class="accordion1 accordion-column">
        
        </div><!-- /.accordion -->
    </div><!-- /.row -->
        <script type="text/javascript">

    	jQuery(document).ready(function() {
			var number = 3;	
			var classView = '.accordion-column';	
			var className = '.list-col-';
			var innerClass = 'ul';	
			var classTitle = '.col-heading';
			loop_for_accordion(classView,number,className,innerClass,classTitle); 
		});
		 
    </script>
    </div><!-- /.container -->
    
</div><!-- /.bg-testomnial -->    
    
    
    
    
<div id="carousel-example1" class="carousel slide" data-ride="carousel">
  


<?php
if ( function_exists( 'ot_get_option' ) ) {
  
  /* get the slider array */
  $slides = ot_get_option( 'secondary_slider', array() ); 
  
   $counter = count($slides);
  echo '<ol class="carousel-indicators">';
  for($j=0;$j<$counter;$j++){
	if($j == 0){
		echo '<li data-target="#carousel-example1" class="active" data-slide-to="'.$j.'"></li>';	
	}else{
		echo '<li data-target="#carousel-example1" data-slide-to="'.$j.'"></li>';  
	}
  }
  echo '</ol>';
  
  
  if ( ! empty( $slides ) ) {
	echo '<div class="carousel-inner">';
	 $x2 =0; 
    foreach( $slides as $slide ) {
		if($x2==0){
      echo '
      <div class="item active">
        <a href="' . $slide['link'] . '"><img src="' . $slide['image'] . '" alt="' . $slide['title'] . '" /></a> 
      </div>';
		}else{
			echo '
			  <div class="item">
				<a href="' . $slide['link'] . '"><img src="' . $slide['image'] . '" alt="' . $slide['title'] . '" /></a> 
			  </div>'; 	
		}
		$x2++;
    }
  }  
  echo '</div><!-- /.carousel-inner -->';  
}
?>

   

  <a class="left carousel-control" href="#carousel-example1" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left"></span>
  </a>
  <a class="right carousel-control" href="#carousel-example1" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right"></span>
  </a>
</div><!-- /.carousel-example -->

<div class="bggray">
    <div class="container class-transparent booking-text-blok">
    	<div class="spacebar75"></div><!-- /.spacebar50 -->
        <div class="row">
        	<?php 
			if ( function_exists( 'ot_get_option' ) ) {
			  /* get the slider array */
			  $booking_content = ot_get_option( 'booking_content');
			  //echo $booking_content;
			  
			  echo do_shortcode($booking_content);
			}
			?> 
            
        </div><!-- /.row -->
        <div class="spacebar50"></div><!-- /.spacebar50 -->
    </div><!-- /.container -->
</div><!-- /.bggray -->

<?php echo do_shortcode('[ultimate-package-form wrap="1" wrap_title="BUILD YOUR OWN PERFECT ADVENTURE" wrap_sub_title="Let us create the perfect package for you & we\'ll do the all planning." form_title="What are you looking for ?"]'); ?>


</div><!-- /.withnewBG -->



<?php get_footer(); ?>