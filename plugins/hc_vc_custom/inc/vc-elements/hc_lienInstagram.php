<?php
if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}
 
/*
Element Description: VC custom - Human's connexion
*/
 
/* Custom Card */
class WPBakeryShortCode_hc_lienInstagram extends WPBakeryShortCode {
 
 
    protected function content( $atts, $content = NULL ) {
 
        $html = '';
        $theme_path = get_stylesheet_directory_uri(); 
    
            // Params extraction
            extract(
                shortcode_atts(
                    array(
                        
                        // Général
                        'link' => '',
                        'title' => '',
                        'apparence_bouton' => '', 
                    ), 
                    $atts
                )
            );
            
        
           
        $html.=    '<a href="https://www.instagram.com/ensemble_antiphona/?hl=fr"><svg id="Groupe_154" data-name="Groupe 154" xmlns="http://www.w3.org/2000/svg" width="20.532" height="20.532" viewBox="0 0 20.532 20.532">
        <path id="Tracé_2183" data-name="Tracé 2183" d="M14.866,0h-9.2A5.672,5.672,0,0,0,0,5.666v9.2a5.672,5.672,0,0,0,5.666,5.666h9.2a5.673,5.673,0,0,0,5.666-5.666v-9.2A5.672,5.672,0,0,0,14.866,0m3.844,14.866a3.849,3.849,0,0,1-3.844,3.844h-9.2a3.849,3.849,0,0,1-3.844-3.844v-9.2A3.849,3.849,0,0,1,5.666,1.822h9.2a3.849,3.849,0,0,1,3.844,3.845Z" fill="#d1b062"/>
        <path id="Tracé_2184" data-name="Tracé 2184" d="M38.064,32.778a5.291,5.291,0,1,0,5.291,5.29,5.3,5.3,0,0,0-5.291-5.29m0,8.759a3.469,3.469,0,1,1,3.469-3.469,3.473,3.473,0,0,1-3.469,3.469" transform="translate(-27.798 -27.802)" fill="#d1b062"/>
        <path id="Tracé_2185" data-name="Tracé 2185" d="M96.473,22.6a1.335,1.335,0,1,0,.945.391,1.34,1.34,0,0,0-.945-.391" transform="translate(-80.694 -19.171)" fill="#d1b062"/>
      </svg></a>';
        
        return $html;
    }
}
    
vc_map(

    array(
        'name' => 'HC instagram',
        'base' => 'hc_lieninstagram',
        'description' => 'lien instagram', 
        'category' => 'Humans Connexion',
        'show_settings_on_create' => true,
        'icon' => hcvc_plugin_url().'/inc/vc-elements/icons/hc_icon.png',
    )
);