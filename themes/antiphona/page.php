<?php
/** 
 * The page template file.<br>
 * This file works as display page content (post type "page") and its comments.
 * 
 * @package bootstrap-basic4
 */


// begins template. -------------------------------------------------------------------------
get_header();

?> 

            <?php if(!is_front_page()) { ?>
               <div class="container" >
                  <div class="row">
                     <div class="col-12 d-flex justify-content-center" id="breadcrumb_container_page">
                        <?php
                        if ( function_exists('yoast_breadcrumb') && !is_front_page() ) {
                        yoast_breadcrumb( '<p id="breadcrumbs">','</p>' );
                        }
                        ?>
                     </div>
                  </div>
               </div> 
            <?php } ?>
            <div class="container">
               <?php
               if (have_posts()) {
                  the_content(); 
               } else {
                  get_template_part('template-parts/section', 'no-results');
               }// endif;
               ?>  
            </div> 

<?php
get_sidebar('right');
get_footer();
?>