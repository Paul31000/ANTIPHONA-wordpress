<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/*
Element Description: VC custom - Human's connexion
*/

/* Custom Card */
class WPBakeryShortCode_hc_slick_carousel_citations extends WPBakeryShortCode {
    

	protected function content( $atts, $content = NULL ) {

		$html = '';
		$theme_path = get_stylesheet_directory_uri();	

		// Params extraction
		extract(
			shortcode_atts(
				array(
					// Général
                    'texte1' => '',
                    'texte2' => '',
                    'texte3' => '',
                    'texte4' => '',
                    'auteur1' => '',
                    'auteur2' => '',
                    'auteur3' => '',
                    'auteur4' => ''
				), 
				$atts
			)
		);

        $html.="<div class='carousel-citations'>";
        $html.=     "<div class='row'>";
        
        $html.=         "<div class='order-2 order-sm-0 col-6 col-sm-1 d-flex align-items-center justify-content-center py-4'>";
        $html.=             "<button type='button' class='slick-prev'><img src='https://antiphona.prep.demohc.com/wp-content/uploads/2022/02/fl-gauche.png'></button>";
        $html.=         "</div>"; 
        $html.=         "<div class='d-none d-sm-block col-sm-1 quote'><img src='https://antiphona.prep.demohc.com/wp-content/uploads/2022/02/Groupe-142@2x.png'></div>";
        $html.=         "<div class='col-12 col-sm-8 slick-citations-show'>";
        for ($i=1; $i < 5 ; $i++) { 
            if(strlen($atts['texte'.$i])!=0){
                $html.=         "<div class='hc-item'>";
                $html.=             "<div class='DM-sans16 italique white'>";
                $html.=                 $atts['texte'.$i];
                $html.=             "</div>";
                $html.=             "<div class='DM-sans22 white'>";
                $html.=                  $atts['auteur'.$i];
                $html.=             "</div>";
                $html.=         "</div>";
                
            }
        }
        $html.=         "</div>"; 
        $html.=         "<div class='d-none d-sm-block col-sm-1'></div>";
        $html.=         "<div class='order-3 col-6 col-sm-1 d-flex align-items-center justify-content-center py-4'>";
        $html.=             "<button type='button' class='slick-next'><img src='https://antiphona.prep.demohc.com/wp-content/uploads/2022/02/fl-droite.png'></button>";
        $html.=         "</div>";
        $html.=     "</div>"; 
		$html.="</div>";

        return $html;
	}

}
vc_map(

	array(
		'name' => 'HC Carousel citations',
		'base' => 'hc_slick_carousel_citations',
		'description' => 'fournit un carousel de citations', 
		'category' => 'Humans Connexion',
		'show_settings_on_create' => true,
		'icon' => hcvc_plugin_url().'/inc/vc-elements/icons/hc_icon.png',
		'params' => array( 
            array(
                'type' => 'textfield',
                'value' => '',
                'heading' => 'texte1',
                'param_name' => 'texte1',
                'admin_label' => true,
                'weight' => 0,
            ),
            array(
                'type' => 'textfield',
                'value' => '',
                'heading' => 'auteur1',
                'param_name' => 'auteur1',
                'admin_label' => true,
                'weight' => 0,
            ),
            array(
                "type" => "textfield",
                'value' => '',
                'heading' => 'texte2',
                'param_name' => 'texte2',
                'admin_label' => true,
                'weight' => 0,
            ),
            array(
                'type' => 'textfield',
                'value' => '',
                'heading' => 'auteur2',
                'param_name' => 'auteur2',
                'admin_label' => true,
                'weight' => 0,
            ),
            array(
                "type" => "textfield",
                'value' => '',
                'heading' => 'texte3',
                'param_name' => 'texte3',
                'admin_label' => true,
                'weight' => 0,
            ),
            array(
                'type' => 'textfield',
                'value' => '',
                'heading' => 'auteur3',
                'param_name' => 'auteur3',
                'admin_label' => true,
                'weight' => 0,
            ),
            array(
                "type" => "textfield",
                'value' => '',
                'heading' => 'texte4',
                'param_name' => 'texte4',
                'admin_label' => true,
                'weight' => 0,
            ),
            array(
                'type' => 'textfield',
                'value' => '',
                'heading' => 'auteur4',
                'param_name' => 'auteur4',
                'admin_label' => true,
                'weight' => 0,
            ),
		)
	)
	
);
          
