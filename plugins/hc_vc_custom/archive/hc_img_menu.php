<?php
if ( ! defined( 'ABSPATH' ) ) {
 die( '-1' );
}
 
/*
Element Description: VC custom - Human's connexion
*/
 
/* Custom Card */
class WPBakeryShortCode_hc_img_menu extends WPBakeryShortCode {
 
 
 protected function content( $atts, $content = NULL ) {
 
 $html = '';
 $theme_path = get_stylesheet_directory_uri(); 
 
 // Params extraction
 extract(
 shortcode_atts(
 array(
 
 // Général
 'link' => '',
 'image' => '',
 'title' => '', 
 ), 
 $atts
 )
 );
 
 
 
 // Définition des images
 $i1 = wp_get_attachment_image_url($image, 'full');
 $i1title = get_the_title($image);
 //var_dump($link);
 $url_link = vc_build_link($link);
 //var_dump($url_link);
 
 $html.= '<div class="cardContent">';
 $html.=    '<a href="'.$url_link["url"].'" target="'.$url_link["target"].'" title="'.$url_link["title"].'">';
 $html.=        '<img class="mainImg" src="'.$i1.'" alt="'.$i1title.'" title="'.$i1title.'" />';
 $html.=        '<div class="card-color">';
 $html.=            '<img class="imgPlus" src="https://sortiedecrise.prep.demohc.com/wp-content/uploads/2021/08/plus.png"/>';
 $html.=        '</div>';
 $html.=        '<div class="container">';
 $html.=            '<div class="row">';
 $html.=                '<div class="col-1">';
 $html.=                '</div>';
 $html.=                '<div class="col-10">';
 $html.=                    '<div class="card-infos '.$dropdown.'">';
 $html.=                        '<div class="texte">';
 $html.=                            '<p class="cardTitle '.$classTitle.'">'.$title;
 $html.=                                '<div class="savoirPlus"><span>En savoir +</span>';
 $html.=                                '</div>';
 $html.=                            '</p>';
 $html.=                        '</div>';
 $html.=                    '</div>';
 $html.=                '</div>';
 $html.=                '<div class="col-1">';
 $html.=                '</div>';
 $html.=            '</div>';
 $html.=        '</div>';
 $html.=    '</a>';
 $html.= '</div>';
 
 return $html;
 }
}
 
vc_map(
 
    array(
    'name' => 'HC img menu',
    'base' => 'hc_img_menu',
    'description' => '', 
    'category' => 'Humans Connexion',
    'show_settings_on_create' => true,
    'icon' => hcvc_plugin_url().'/inc/vc-elements/icons/hc_icon.png',
    'params' => array( 
 
        // General
        array(
        'type' => 'textfield',
        'value' => '',
        'heading' => 'Titre à afficher',
        'param_name' => 'title',
        'admin_label' => true,
        'weight' => 0,
        ),
        
        array(
        'type' => 'attach_image',
        'value' => '',
        'heading' => 'Image de fond',
        'param_name' => 'image',
        'admin_label' => false,
        'weight' => 0,
        ),
        array(
        'type' => 'vc_link',
        'value' => '',
        'heading' => 'Lien de l\'image',
        'param_name' => 'link',
        'admin_label' => false,
        'weight' => 0,
        ),
    )
 )
 
);