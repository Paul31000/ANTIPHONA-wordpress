<?php
/** 
 * The single post.<br>
 * This file works as display full post content page and its comments.
 * 
 * @package bootstrap-basic4
 */


// begins template. -------------------------------------------------------------------------
get_header();
get_sidebar();
?> 
        </div>
        
        
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
            <div class="container-fluid fond-gris">
                <br><br>
                <div class="row">
                    <div class="col-6">
                    </div>
                    <div class="col-6 trait-vertical">
                        <br><br><br><br>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-2 col-0">
                    </div>
                    <div class="col-sm-8 col-12 center">
                        <?php if(get_post_type()=='prgm'){ ?>
                            <div class="judson33 golden"><?php echo(get_the_terms(get_the_ID(),'prgm_category')[0]->name); ?></div>
                        <?php } ?>
                        <h1><?php the_title() ?></h1>
                    </div>
                    <div class="col-sm-2 col-0">
                    </div>
                </div>
                <div class="container"> 
                    <div class="row">
                        <div class="col-12 lien-page-single">
                            <?php if(get_post_type()=='post'){ ?>
                                <a class="DMGolden18 ls3" href="<?php site_url(); ?> /presse/"><img src="<?php site_url(); ?>/wp-content/uploads/2021/12/fleche-or-gauche.png"/> &nbsp;&nbsp;TOUTES LES ACTUALITÉS </a>
                            <?php } else if(get_post_type()=='prgm'){ ?>
                                <a class="DMGolden18 ls3" href="<?php site_url(); ?> /infoprogrammes/"><img src="<?php site_url(); ?>/wp-content/uploads/2021/12/fleche-or-gauche.png"/> &nbsp;&nbsp;TOUS LES PROGRAMMES </a>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <?php
                                    the_content();
                            ?> 
                        </div>
                    </div>
                </div>
                <div class="container"> 
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <?php
                                $prev_post = get_adjacent_post(false, '', true);
                                if(!empty($prev_post)) {                              
                                    echo '<div class="link_sibling_art">';
                                    echo    '<a href="' . get_permalink($prev_post->ID) . '">';
                                    echo        '<div class="container-fluid">';
                                    echo            '<div class="row">';
                                    echo                '<div class="col-2 link-precedent">'; 
                                    echo                       '<div class="image"></div>';
                                    echo                '</div>';
                                    echo                '<div class="col-10">';
                                    echo                    '<div class="button_precedent">'; 
                                    echo                        'PRÉCÉDENT';
                                    echo                    '</div>' ;
                                    echo                    '<div class="button-titre-precedent">';
                                    echo                        $prev_post->post_title;
                                    echo                    '</div>';
                                    echo                '</div>'; 
                                    echo            '</div>';
                                    echo        '</div>';
                                    echo     '</a>';
                                    echo '</div>';
                                };
                            ?> 
                        </div>
                        <div class="col-12 col-sm-6 mb-5 mb-md-0">
                            <?php
                                    $next_post = get_adjacent_post(false, '', false);
                                    if(!empty($next_post)) {                              
                                        echo '<div class="link_sibling_art">';
                                        echo    '<a href="' . get_permalink($next_post->ID) . '">';
                                        echo        '<div class="container-fluid">';
                                        echo            '<div class="row ">';
                                        echo                '<div class="col-10" >';
                                        echo                    '<div class="row" >';
                                        echo                        '<div class="col-12 button_precedent d-flex justify-content-end ">'; 
                                        echo                            'SUIVANT';
                                        echo                        '</div>' ;
                                        echo                        '<div class="col-12 button-titre-precedent d-flex justify-content-end">';
                                        echo                            $next_post->post_title;
                                        echo                        '</div>';
                                        echo                     '</div>';
                                        echo                '</div>'; 
                                        echo                '<div class="col-2 link-suivant">'; 
                                        echo                       '<div class="image"></div>';
                                        echo                '</div>';
                                        echo            '</div>';
                                        echo        '</div>';
                                        echo     '</a>';
                                        echo '</div>';
                                    };
                                ?> 
                        </div>
                    </div>
                </div>
            </div>
<?php
get_sidebar('right');
get_footer();
?>