
<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the "site-content" div and all content after.
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */
?>

 
<div id="withnewBG" style="margin-top:0;"> 
<?php if(is_front_page()){ ?>
<div class="bgcommongray">

    <div class="container class-transparent">
    	<div class="row row-centered">
             <div class="col-xs-12">
                    <h2 class="text-center text-uppercase">
                        Chuffed to be affiliated by...
                    </h2>
             </div><!-- /.col-xs-12 -->
             <div class="col-xs-12 make-center-responsive" style="text-align: center;">
             	<?php 
					if ( function_exists( 'ot_get_option' ) ) {
					  $affiliated_images = ot_get_option( 'affiliated_images' );
					}
				?>
             	<?php echo gallery_images_no_column($affiliated_images); ?>
             </div><!-- /.col-xs-12 --> 
        </div><!-- /.row -->  
        <div class="spacebar50"></div><!-- /.spacebar50 -->      
    </div><!-- /.container -->
</div><!-- /.bgcommongray -->
<?php } ?>


<div class="full-white-bg">
	<div class="container class-transparent">
    	 <div class="spacebar50 hidden-xs"></div><!-- /.spacebar50 -->
         <div class="row hidden-xs">
         	<?php 
			if ( function_exists( 'ot_get_option' ) ) { 
			  $number_of_footer_menu = ot_get_option( 'number_of_footer_menu'); 
			}
			?>
         	<?php echo ultimate_widgets($number_of_footer_menu); ?>
         </div><!-- /.row -->
         <div id="accordion-responsive" class="row visible-xs-block visible-sm-block">
             <!-- This is for jQuery function loop -->
             <input type="hidden" id="footer_widget_number" value="<?php echo $number_of_footer_menu; ?>"  />
            <div class="accordion accordion-footer">
            
            </div><!-- /.accordion -->
        </div><!-- /.accordion-responsive -->
    
    <script type="text/javascript">

    	jQuery(document).ready(function() {
			var number = jQuery('#footer_widget_number').val();	
			var classView = '.accordion-footer';
			var className = '.footer-widget-';
			var innerClass = '.menu';	
			var classTitle = '.footer-widget-title';
			loop_for_accordion(classView,number,className,innerClass,classTitle);	 
		});
    </script>
    	<div class="spacebar50 hidden-xs"></div><!-- /.spacebar50 -->
        
        <div class="row">
        	<?php 
			if ( function_exists( 'ot_get_option' ) ) { 
			  $social_settings = ot_get_option( 'social_settings'); 
			  
			  //print_r($social_settings);
			}
			?>
            
            <?php if(!is_front_page()){ ?>
                 <div class="col-md-5 partner-logo-customization"> 
					<?php 
						if(!is_front_page()){
							if ( function_exists( 'ot_get_option' ) ) {
							  $affiliated_images = ot_get_option( 'footer_partners' );
							} 
						}
                    ?>
					<?php echo gallery_images_columns($affiliated_images,3) ?>
                 </div><!-- /.col-xs-7 -->
              	<?php } ?>   
                
                
            <div class="col-xs-12 visible-xs">
            	<h5 class="social-title">FOLLOW US</h5>
            </div><!-- /.col-md-5 -->
        	<div class="col-xs-12 col-md-5 pull-right text-right">
            	<ul class="footer-social">
                	<li class="hidden-xs social-title">FOLLOW US</li>
                    <?php
						foreach($social_settings as $social):
							if($social['href']!= NULL){
							echo '<li><a href="'.$social['href'].'" title="'.$social['title'].'">'.social_icons($social['name']).'</a></li>';							}
						endforeach;
					?> 
                </ul>
            </div><!-- /.col-md-5 -->
            <div class="col-xs-12 socialbg"></div><!-- /.col-xs-12 -->
        </div><!-- /.row-->
        <div class="spacebar30"></div><!-- /.spacebar30 -->
    </div><!-- /.container -->
</div><!-- /.bgwhite -->

<?php 
if ( function_exists( 'ot_get_option' ) ) { 
  $footer_copyright = ot_get_option( 'footer_copyright' );
  
}  
?>
<div class="bottomFooter">
	<div class="bottomFooter1"> 
    	<div class="container class-transparent">
            <div class="row">
                <div class="col-md-6">
                	<div class="col-md-12 list-responsive-center">
                    <?php
					$defaults = array(
						'theme_location'  => '',
						'menu'            => 7,
						'container'       => false,
						'container_class' => '',
						'container_id'    => '',
						'menu_class'      => 'bottom-list',
						'menu_id'         => '',
						'echo'            => true,
						'fallback_cb'     => 'wp_page_menu',
						'before'          => '',
						'after'           => '',
						'link_before'     => '',
						'link_after'      => '',
						'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
						'depth'           => 0,
						'walker'          => ''
					);
					
					wp_nav_menu( $defaults );
					?> 
                     </div>
                     <div class="col-md-12">
                 	<p class="copyright-text hidden-xs"><?php echo $footer_copyright; ?></p>
                    <p class="copyright-text text-center visible-xs"><?php echo $footer_copyright; ?></p>
                 </div><!-- /.col-xs-12 -->
                 </div><!-- /.col-xs-5 -->
                 <?php //if(!is_front_page()){ ?>
                 <div class="col-md-6"> 
					<?php 
						//if(!is_front_page()){
							if ( function_exists( 'ot_get_option' ) ) {
							  $affiliated_images = ot_get_option( 'payment_system_logos' );
							} 
						//}
                    ?>
					<?php 
					$arrays = explode(',', $affiliated_images); //split string into array seperated by ', '
						foreach($arrays as $id):	
						$attr['title'] = get_post($id)->post_title;
						$image_attributes = wp_get_attachment_image_src( $attachment_id = $id, 'full'); 
					if ( $image_attributes ) : ?>
						<div class="col-xs-12 col-sm-12 col-md-12">
							<a href="<?php echo $attr['title']; ?>" class="h-fadein"><img src="<?php echo $image_attributes[0]; ?>" class="img-responsive max-width" alt="" /></a>
						</div><!-- /.col-md-4 -->
					<?php endif; ?>
					<?php endforeach; ?>
                 </div><!-- /.col-xs-7 -->
              	<?php //} ?>   
                 
            </div><!-- /.row-->
        </div><!-- /.container -->
	</div><!-- /.bottomFooter1 -->	
</div><!-- /.bottomFooter -->  
</div><!-- /.withnewBG-->
<script type="text/javascript">



jQuery(document).ready(function() {
	
	
	jQuery( '.swMain li a' ).click( function ( e ) {
        e.preventDefault(); 
		//loop_link();
      });
	  
	jQuery('.logo-list a').click(function() {
		var linkhome = jQuery('#link-home').val();
	   window.location = linkhome; 
	   return false;
	});  
});
</script> 
<?php wp_footer(); ?>
 
</body>
</html>
