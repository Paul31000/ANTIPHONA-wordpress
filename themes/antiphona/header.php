<?php
/**
 * The theme header.
 * 
 * @package bootstrap-basic4
 */

$container_class = apply_filters('bootstrap_basic4_container_class', 'container');
if (!is_scalar($container_class) || empty($container_class)) {
    $container_class = 'container';
}
?>
<!DOCTYPE html>

<html class="no-js" <?php language_attributes(); ?>>
    <head>

    <!-- import police -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;700&family=Judson:wght@700&display=swap" rel="stylesheet">

        <meta charset="<?php bloginfo('charset'); ?>">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <link rel="profile" href="http://gmpg.org/xfn/11" />
        <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
    
     
        <!--WordPress head-->
        <?php wp_head(); ?> 
        <!--end WordPress head-->
    </head>
    <body <?php body_class(); ?>>
        <?php
        if (function_exists('wp_body_open')) {
            wp_body_open();
        }
        ?> 
        <header class="page-header page-header-sitebrand-topbar">
                <div class="container-fluid sticky-nav">
                    <div class="row">   
                        <div class="col-12 col-md-3 col-xl-3 elements-header">
                            <?php if ( function_exists( 'the_custom_logo' ) ) {the_custom_logo();} ?> 
                        </div> 
                        <div class="col-12 col-md-9 col-xl-9 elements-header justify-end"> 
                            <nav id="site-navigation" class="main-navigation navbar navbar-expand-xl">
                                <?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
                            </nav>
                            <a class="bouton-nous-rejoindre DMGolden" href="https://antiphona.prep.demohc.com/nous-rejoindre/">
                                NOUS REJOINDRE 
                            </a>  
                        </div>   
                    </div>
                </div>    
        </header><!--.page-header-->
        