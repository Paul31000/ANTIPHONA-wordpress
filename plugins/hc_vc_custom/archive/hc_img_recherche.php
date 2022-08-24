<?php
if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}
 
/*
Element Description: VC custom - Human's connexion
*/
 
/* Custom Card */
class WPBakeryShortCode_hc_img_recherche extends WPBakeryShortCode {
 
 
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
 
 $html.= "<div class='row d-flex justify-content-center recherche'>";
 $html.=     "<form id='searchform' method='get' action=";
 $html.=        esc_url( home_url( '/' ) );
 $html.=            ">";
 $html.=            "<input type='text' class='search-field' name='s' placeholder='Rechercher' value='";
 $html.=             get_search_query();
 $html.=            "'>";
 $html.=            "<input class='submit' value='' type='submit'></form>";
 $html.= "</div>";

 return $html;
 }
}
 
vc_map(
 
    array(
    'name' => 'HC img recherche',
    'base' => 'hc_img_recherche',
    'description' => 'barre de recherche', 
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