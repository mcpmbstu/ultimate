<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "site-content" div.
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<!--[if lt IE 9]>
	<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/html5.js"></script>
	<![endif]-->
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>> 
<input type="hidden" id="page-template-name" value="<?php echo get_page_template_slug( $post->ID ); ?>" />
<input type="hidden" id="link-home" value="<?php echo site_url(); ?>" />
<nav class="navbar navbar-default new-hide-992">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <a href="#" class="navbar-toggle collapsed menu-toggle-class" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false" >MENU</a>
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <?php
	  if ( function_exists( 'ot_get_option' ) ) {  
		  $logo_mobile = ot_get_option( 'logo_mobile'); 
	  }
	  ?>
      <a class="navbar-brand" href="<?php echo site_url(); ?>"><img src="<?php echo $logo_mobile; ?>" alt="" class="img-responsive" /></a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
    
    	<?php
			echo ultimate_responsive_menu();
		?>
		<div class="row">
        	<div class="col-xs-12 mobile-menu-number" style="">
            
            	<ul class="topmenu">
                	<?php 
					if ( function_exists( 'ot_get_option' ) ) {
					  /* get the slider array */
					  $booking_number = ot_get_option( 'booking_number');
					  $company_email = ot_get_option( 'company_email');  
					}
					?> 
                    <li><a href="#" class="booking-number">TO BOOK <?php echo $booking_number; ?></a></li>
                    <li><a href="mailto:<?php echo $company_email; ?>">OR EMAIL</a></li>
                </ul>
                
            </div>
        </div>
		<?php
		$defaults = array(
			'theme_location'  => '',
			'menu'            => 2,
			'container'       => false,
			'container_class' => '',
			'container_id'    => '',
			'menu_class'      => 'nav navbar-nav red-bg-nav',
			'menu_id'         => '',
			'echo'            => true,
			'fallback_cb'     => 'wp_page_menu',
			'before'          => '',
			'after'           => '<i class="fa fa-chevron-right"></i>',
			'link_before'     => '',
			'link_after'      => '',
			'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
			'depth'           => 0,
			'walker'          => ''
		);
		
		wp_nav_menu( $defaults );
		
		?> 
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>


<div class="topBarHolder hidden-xs">
	<div class="container">
    	<div class="row">
        	<div class="col-xs-10 col-md-12 text-right">
            
            <?php

			$defaults = array(
				'theme_location'  => '',
				'menu'            => 2,
				'container'       => 'div',
				'container_class' => '',
				'container_id'    => '',
				'menu_class'      => 'topmenu',
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
            </div><!-- /.col-md-12 -->
        </div><!-- /.row -->
    </div><!-- /.container -->
</div><!-- /.topBarHolder -->
<div class="callDiv hidden-xs">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-md-12 text-right">
                <ul class="topmenu">
                	<?php 
					if ( function_exists( 'ot_get_option' ) ) {
					  /* get the slider array */
					  $booking_number = ot_get_option( 'booking_number');
					  $company_email = ot_get_option( 'company_email');  
					}
					?> 
                    <li><a href="#" class="booking-number">TO BOOK <?php echo $booking_number; ?></a></li>
                    <li><a href="mailto:<?php echo $company_email; ?>">OR EMAIL</a></li>
                </ul>
            </div><!-- /.col-xs-4 -->
        </div><!-- /.row -->
    </div><!-- /.container -->     
</div><!--/.callDiv --> 

<div class="headerBlock hidden-xs">
	<div class="main container hide-992"> 
        <nav id="cbp-hrmenu" class="cbp-hrmenu">
            <?php echo ultimate_mega_menu(); ?>					
        </nav>
    </div>
</div><!-- /.headerBlock -->  
<div class="headerBlock2"></div><!-- /.headerBlock2 -->

<?php if(is_front_page()){ ?>
<div id="carousel-example" class="carousel slide newsliderHeader" data-ride="carousel">
  <!--<ol class="carousel-indicators">
    <li data-target="#carousel-example" data-slide-to="0" class="active"></li>
    <li data-target="#carousel-example" data-slide-to="1"></li>
    <li data-target="#carousel-example" data-slide-to="2"></li>
    <li data-target="#carousel-example" data-slide-to="3"></li>
  </ol>-->
  
  <?php
  if ( function_exists( 'ot_get_option' ) ) {
  
  /* get the slider array */
  $slider_images = ot_get_option( 'slider_images', array() );
  
  $counter = count($slider_images);
  echo '<ol class="carousel-indicators">';
  for($j=0;$j<$counter;$j++){
	if($j == 0){
		echo '<li data-target="#carousel-example" class="active" data-slide-to="'.$j.'"></li>';	
	}else{
		echo '<li data-target="#carousel-example" data-slide-to="'.$j.'"></li>';  
	}
  }
  echo '</ol>';
  
  if ( ! empty( $slider_images ) ) {
	  $i=0;
	  echo '<div class="carousel-inner">';
    foreach( $slider_images as $slide ) { 
      if($i == 0){
	  echo '
      <div class="item active">
        <a href="' . $slide['link'] . '"><img src="' . $slide['image'] . '" alt="' . $slide['title'] . '" /></a>
		<div class="carousel-caption">
			<h3 class="main-banner ">'.$slide['title'].'</h3>
			<p class="hidden-mainboard"><a class="allbuttonS" href="' . $slide['link'] . '">'.$slide['description'].'</a></p>
		</div>
      </div>';
	  }else{
		echo '
      <div class="item">
        <a href="' . $slide['link'] . '"><img src="' . $slide['image'] . '" alt="' . $slide['title'] . '" /></a>
		<div class="carousel-caption text-center">
			<h3 class="main-banner ">'.$slide['title'].'</h3>
			<p class="hidden-mainboard"><a class="allbuttonS" href="' . $slide['link'] . '">'.$slide['description'].'</a></p>
		</div>
      </div>';  
	  }
	  $i++;
    }
	echo '</div><!-- /.end -->';
  }
  
}
  ?>


  <a class="left carousel-control hidden-xs" href="#carousel-example" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left"></span>
  </a>
  <a class="right carousel-control hidden-xs" href="#carousel-example" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right"></span>
  </a>
</div>
<?Php } ?>

<?php if(!is_front_page()){ ?>  
    	<div class="single-page">
            <div class="carousel-caption1">
            	<?php 
					$currentPage = wp_get_post_parent_id( $post->ID ); 
					if($currentPage == 67){ ?>
			    <h3 class="main-banner"><?php the_field('banner_title_1'); ?></h3>
                <?php }elseif($post->ID == 63 || $post->ID == 40 || $post->ID == 55){ ?>
                	<h3 class="main-banner"><?php the_field('banner_text_grid'); ?></h3>
				<?php }else{ ?>
                <h3 class="main-banner"><?php the_field('banner_text'); ?></h3>
                <?php } ?>
		    </div>
        </div><!-- /.single-page -->  
<?php } ?>