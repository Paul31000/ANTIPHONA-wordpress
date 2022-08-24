<?php
if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}
 
/*
Element Description: VC custom - Human's connexion
*/
 
/* Custom Card */
class WPBakeryShortCode_hc_bouton extends WPBakeryShortCode {
 
 
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
            
        
        $url_link = vc_build_link($link);
        $apparence_bouton=$atts['apparence_bouton'];
        switch($apparence_bouton){    
            case 'En bas à droite de son parent': 
                $html.=    "<a class='DMGolden bouton-golden-enfant' target='".$url_link["target"]."' rel='".$url_link["rel"]."' href='".$url_link["url"]."'>".$title."</a>";
                break;
            case 'Blanc':  
                $html.=     "<div class='middle-bouton-golden'>";
                $html.=         "<a class='DMGolden bouton-white' target='".$url_link["target"]."' rel='".$url_link["rel"]."' href='".$url_link["url"]."'>".$title."</a>";
                $html.=     "</div>";
                break;
            case 'Dore':  
                $html.=     "<div class='middle-bouton-golden'>";
                $html.=         "<a class='DMGolden bouton-golden' target='".$url_link["target"]."' rel='".$url_link["rel"]."' href='".$url_link["url"]."'>".$title."</a>";
                $html.=     "</div>";
                break;
            case 'Telecharger blanc sans bordure':  
                $html.=     "<div class='middle-bouton-golden'>";
                $html.=         "<a class='DMGolden bouton-telecharger-white-wborder' target='".$url_link["target"]."' rel='".$url_link["rel"]."' href='".$url_link["url"]."'>".
                        
                        '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="34.007" height="34" viewBox="0 0 34.007 34">
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
                    </svg>'

                .$title."</a>";
                $html.=     "</div>";
                break;
        } 
        return $html;
    }
}
    
vc_map(

    array(
        'name' => 'HC bouton',
        'base' => 'hc_bouton',
        'description' => 'bouton dore', 
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
                'type' => 'vc_link',
                'value' => '',
                'heading' => 'Lien de l\'image',
                'param_name' => 'link',
                'admin_label' => false,
                'weight' => 0,
            ),
            array(
                "type" => "dropdown",
                "holder" => "div",
                "class" => "",
                "heading" => __("apparence du bouton"),
                "param_name" => "apparence_bouton",
                "value" => array(
                    ' ',
                    'Dore',
                    'Blanc',
                    'Telecharger blanc sans bordure',
                    'En bas à droite de son parent'
                ),
                "description" => __("")
            ),
        )
    )
);