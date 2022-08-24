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
    
        <div class="container">
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
                <div class="col-6"></div>
                <div class="col-6 trait-vertical">
                    <br><br><br><br>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-2 col-0">
                </div>
                <div class="col-sm-8 col-12 center discographie">
                    <h1>Disc<span>O</span>graphie</h1>
                </div>
                <div class="col-sm-2 col-0">
                </div>
            </div> 
            <div class="row page-album">

                <div class="col-sm-1 col-12 d-flex align-items-center justify-content-center">
                    <?php
                    $prev_post = get_adjacent_post(false, '', true);
                    if(!empty($prev_post)) { ?> 
                        <a href="<?php echo(get_permalink($prev_post->ID)); ?>">
                            <img src="https://antiphona.prep.demohc.com/wp-content/uploads/2022/02/fl-gauche.png"/>
                        </a>
                    <?php } ?>
                </div>

                <div class="col-12 col-lg-3">
                    <div class="judson40">
                        <p><?php the_title( false ); ?></p>
                    </div>
                    <div class="judson30">
                        <p><?php echo (get_field('date_et_label'));?></p>
                    </div>
                    <div class="texte_album">
                        <?php echo (get_field('texte_album'));?>
                    </div>
                    <div class="lien_vers_critiques">
                        <a href="<?php echo(get_field('lien_vers_article')); ?>">
                            VOIR LES CRITIQUES<img src="https://antiphona.prep.demohc.com/wp-content/uploads/2021/12/fleche-or.png"/>
                        </a>
                    </div>
                    <div class="prix_gagnes">
                        <?php 
                            $image = get_field('prix_gagnes');
                            echo wp_get_attachment_image( $image['ID'], 'thumbnail' );
                        ?>
                        <?php 
                            $image = get_field('prix_gagnes2');
                            echo wp_get_attachment_image( $image['ID'], 'thumbnail' );
                        ?>
                    </div>
                </div>

                <div class="col-12 col-lg-4 lecteur-audio">
                    <div class="background-lecteur-audio">
                        <div class="grandO"><p>O</p></div>
                        <div class="elements-lecteur">
                            <div class="play">
                                <?php $attr = array(
                                    'src'      => get_field('lien_de_la_musique'),
                                    'loop'     => '',
                                    'autoplay' => '',
                                    'preload' => 'none'
                                    );
                                    echo wp_audio_shortcode( $attr ); ?>
                            </div>
                            <div class="judson60 gold ecoutez"><p>Ecoutez un extrait</p></div>
                        </div> 
                    </div>   
                </div>


                <div class="col-12 col-lg-3">
                    <div class="image-album">
                        <?php 
                            $image = get_field('image_album');
                            echo wp_get_attachment_image( $image['ID'], 'thumbnail' );
                        ?>
                    </div>
                    <div class="golden judson30">
                        <p>Titres de l'album </p>
                    </div>
                    <div class="track-album">
                        <?php echo (get_field('titres_album')); ?>
                    </div>
                    <div class="middle-bouton-golden d-flex justify-content-between">
                        <a class="DMGolden bouton-white-wborder" href="<?php echo (get_field('lien_album')); ?>" download="<?php echo (get_field('lien_album')); ?>"> 
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="34.007" height="34" viewBox="0 0 34.007 34">
                                <defs>
                                    <clipPath id="clip-path">
                                    <rect id="Rectangle_413" data-name="Rectangle 413" width="34.007" height="34" fill="#d1b062"/>
                                    </clipPath>
                                </defs>
                                <g id="Groupe_113" data-name="Groupe 113" transform="translate(0 -0.001)">
                                    <g id="Groupe_112" data-name="Groupe 112" transform="translate(0 0.001)" clip-path="url(#clip-path)">
                                    <path id="Tracé_2261" data-name="Tracé 2261" d="M18,34H16.006a1.717,1.717,0,0,0-.256-.055A15.721,15.721,0,0,1,9.82,32.4,16.781,16.781,0,0,1,.268,19.959C.142,19.313.088,18.652,0,18V16a2.291,2.291,0,0,0,.056-.286A15.736,15.736,0,0,1,2,9.022,16.68,16.68,0,0,1,16.29.031a15.755,15.755,0,0,1,9.379,2.362,16.656,16.656,0,0,1,8.309,13.892,15.832,15.832,0,0,1-1.969,8.687,16.753,16.753,0,0,1-12.044,8.761c-.649.124-1.311.181-1.967.268M17,2.127A14.874,14.874,0,1,0,31.878,17.015,14.882,14.882,0,0,0,17,2.127" transform="translate(0 0)" fill="#d1b062"/>
                                    <path id="Tracé_2262" data-name="Tracé 2262" d="M25.639,27.4c.138-.129.226-.207.308-.289,1.315-1.314,2.624-2.634,3.95-3.937a1.636,1.636,0,0,1,.693-.413.994.994,0,0,1,1.113.532,1.032,1.032,0,0,1-.147,1.2c-.23.254-.479.49-.722.733q-2.582,2.582-5.165,5.164a1.469,1.469,0,0,1-2.179.007q-2.876-2.875-5.754-5.748a1.127,1.127,0,0,1-.376-1.135,1.057,1.057,0,0,1,1.647-.577,2.706,2.706,0,0,1,.293.27l3.9,3.9c.084.084.171.163.314.3V16.467c0-.133-.005-.267.008-.4a1.059,1.059,0,0,1,2.108-.008,3.747,3.747,0,0,1,.008.4q0,5.261,0,10.523Z" transform="translate(-7.575 -6.606)" fill="#d1b062"/>
                                    </g>
                                </g>
                            </svg>TÉLÉCHARGER L'ALBUM
                        </a>
                    </div>
                    <div class="middle-bouton-golden d-flex justify-content-between">
                        <a target="_blank" class="DMGolden bouton-white" href="<?php echo (get_field('livret')); ?>" > 
                            VOIR LE LIVRET
                        </a>
                    </div>
                </div>

                <div class="col-sm-1 col-12 d-flex align-items-center justify-content-center">
                    <?php
                        $next_post = get_adjacent_post(false, '', false);
                        if(!empty($next_post)) { ?> 
                            <a href="<?php echo (get_permalink($next_post->ID)); ?>">
                                <img src="https://antiphona.prep.demohc.com/wp-content/uploads/2022/02/fl-droite.png"/>
                            </a>
                        <?php } ?>
                </div>

                <div class="col-12">
                    <div class="espace-vide-album"></div>
                </div>
            </div>
            
        </div>
            <div class="container">
                <div class="page-album">
                    <?php the_content(); ?>
                </div>
            </div>
        
<?php
get_sidebar('right');
get_footer();
?>