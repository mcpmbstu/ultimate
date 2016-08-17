<?php
/**
 * Template Name: Front Page
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */
 
get_header(); ?>

as
<div class="container bgwhite homeposition">
<div class="main-tab-div">
	<div class="row"> 
    <ul class="nav nav-tabs responsive homepagetab" id="nonResponsiveTabs">
        <li class="active"><a href="#nr-tab1">Ultimate Adventure</a></li>
        <li><a href="#nr-tab2">Accomodation</a></li>
        <li><a href="#nr-tab3">Special Offers</a></li>
      </ul>

      <div class="tab-content hidden-sm hidden-xs">
      	<div class="tab-pane active responsive" id="nr-tab1"> 
        	<div class="row">
        	<div class="col-md-5">
            	<img src="<?php echo get_template_directory_uri(); ?>/images/images.png" class="img-responsive" alt="" />
                
            </div><!-- /.col-md-5-->
            <div class="col-md-7">
            	 <p>The Ultimate Adventure Centre offers the most comprehensive range of outdoor activities available throughout North Devon, with an Ultimate twist. The recently opened Ultimate Assault (formely known as Wipeout) adds to the list of exhilarating experiences made possible through the Ultimate Adventure Centre. With accommodation totalling over 120 beds, plus a large dining cafe & function space available we can provide unique packages and fun for all types of groups on the North Devon coast. </p>
                <a href="#" class="allbutton">Explore activities</a>
            </div><!-- /.col-md-7-->
            </div><!-- /.row-->
            </div> <!-- /.responsive-->
        <div class="tab-pane responsive" id="nr-tab2">
        	<div class="row">
        	<div class="col-md-5">
            	<img src="<?php echo get_template_directory_uri(); ?>/images/images.png" class="img-responsive" alt="" />
                
            </div><!-- /.col-md-5-->
            <div class="col-md-7">
            	 <p>The Ultimate Adventure Centre offers the most comprehensive range of outdoor activities available throughout North Devon, with an Ultimate twist. The recently opened Ultimate Assault (formely known as Wipeout) adds to the list of exhilarating experiences made possible through the Ultimate Adventure Centre. With accommodation totalling over 120 beds, plus a large dining cafe & function space available we can provide unique packages and fun for all types of groups on the North Devon coast. </p>
                <a href="#" class="allbutton">Explore activities</a>
            </div><!-- /.col-md-7-->
            </div><!-- /.row-->
        
        </div>
        <div class="tab-pane responsive" id="nr-tab3">
        
        	<div class="row">
        	<div class="col-md-5">
            	<img src="<?php echo get_template_directory_uri(); ?>/images/images.png" class="img-responsive" alt="" />
                
            </div><!-- /.col-md-5-->
            <div class="col-md-7">
            	 <p>The Ultimate Adventure Centre offers the most comprehensive range of outdoor activities available throughout North Devon, with an Ultimate twist. The recently opened Ultimate Assault (formely known as Wipeout) adds to the list of exhilarating experiences made possible through the Ultimate Adventure Centre. With accommodation totalling over 120 beds, plus a large dining cafe & function space available we can provide unique packages and fun for all types of groups on the North Devon coast. </p>
                <a href="#" class="allbutton">Explore activities</a>
            </div><!-- /.col-md-7-->
            </div><!-- /.row-->
            
        </div>
      </div><!-- /.tab-content--> 
</div>  <!-- /.row-->    
</div> <!-- /.main-tab-div --> 
	<div class="row">
    	<div class="col-xs-12 col-sm-6 col-md-4">
        	<a href="#" class="h-fadein"><img src="<?php echo get_template_directory_uri(); ?>/images/book1.png" class="img-responsive max-width" alt="" /> </a>
        </div><!-- /.col-md-4 -->
        <div class="col-xs-12 col-sm-6 col-md-4">
        	<a href="#" class="h-fadein"><img src="<?php echo get_template_directory_uri(); ?>/images/book2.png" class="img-responsive max-width" alt="" /> </a>
        </div><!-- /.col-md-4 -->
        <div class="col-xs-12 col-sm-6 col-md-4">
        	<a href="#" class="h-fadein"><img src="<?php echo get_template_directory_uri(); ?>/images/book3.png" class="img-responsive max-width" alt="" /> </a>
        </div><!-- /.col-md-4 -->
    </div><!-- /.row -->   
</div><!-- /.container -->   




<?php get_footer(); ?>