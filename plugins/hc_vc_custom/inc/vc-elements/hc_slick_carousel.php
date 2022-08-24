<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/*
Element Description: VC custom - Human's connexion
*/

/* Custom Card */
class WPBakeryShortCode_hc_slick_carousel extends WPBakeryShortCode {
    

	protected function content( $atts, $content = NULL ) {

		$html = '';
		$theme_path = get_stylesheet_directory_uri();	

		// Params extraction
		extract(
			shortcode_atts(
				array(
					// Général
                    'title' => '',
                    'excerpt' => '',
                    'images' => '',
				), 
				$atts
			)
		);
        $html.="<div class='container-fluid carousel'>";
        $html.=     "<div class='row'>";
        
        $html.=         "<div class='col-xl-1 col-0'></div>";
        $html.=         "<div class='col-xl-3 col-12'>";
        $html.=             "<h3>".$atts['title']."</h3>";
        $html.=             "<div class='text-carousel-description'>".$atts['excerpt']."</div>";
        $html.=             "<button type='button' class='slick-prev'>&larr;</button><button type='button' class='slick-next'>&rarr;</button>";
        $html.=         "</div>";
        $html.=         "<div class='col-xl-1 col-0'>";
        $html.=         "</div>";

        $html.=         "<div class='col-xl-6 col-12 slick-slide-show'>";
        $tabImgID=explode(',',$atts['images'],100);
        for ($i=0; $i <count($tabImgID) ; $i++) { 
            $html.="<div class='hc-item'>";
            $html.=(wp_get_attachment_image($tabImgID[$i],array(235,150)));
            $html.="</div>";
        }
        $html.=         "</div>"; 
        $html.=         "<div class='col-xl-1 col-0'></div>";

        $html.=     "</div>"; 
		$html.="</div>";

        return $html;
	}

}
vc_map(

	array(
		'name' => 'HC Carousel page principale',
		'base' => 'hc_slick_carousel',
		'description' => 'fournit un carousel d\'image pour les partenaires', 
		'category' => 'Humans Connexion',
		'show_settings_on_create' => true,
		'icon' => hcvc_plugin_url().'/inc/vc-elements/icons/hc_icon.png',
		'params' => array( 
            array(
                'type' => 'textfield',
                'value' => '',
                'heading' => 'Titre à afficher',
                'param_name' => 'title',
                'admin_label' => true,
                'weight' => 0,
            ),
            array(
                'type' => 'textfield',
                'value' => '',
                'heading' => 'texte description',
                'param_name' => 'excerpt',
                'admin_label' => true,
                'weight' => 0,
            ),
            array(
                "type" => "attach_images",
                'value' => '',
                'heading' => 'image carousel',
                'param_name' => 'images',
                'admin_label' => true,
                'weight' => 0,
            ),
		)
	)
	
);
          
