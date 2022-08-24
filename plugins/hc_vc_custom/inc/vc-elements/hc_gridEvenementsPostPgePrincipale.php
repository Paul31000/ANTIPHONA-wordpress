<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/*
Element Description: VC custom - Human's connexion
*/

/* Custom Card */
class WPBakeryShortCode_hc_gridEvenementsPostPgePrincipale extends WPBakeryShortCode {
    

	protected function content( $atts, $content = NULL ) {

		$html = '';
		$theme_path = get_stylesheet_directory_uri();	

		// Params extraction
		extract(
			shortcode_atts(
				array(
					// Général
                    'posts_number' => ''
				), 
				$atts
			)
		);

        $terms = get_terms( array( 
            'taxonomy' => 'category',
            'parent'   => 0
        ) );

        /*Query*/
        $args = array(
            'post_type' => array('post'),
            'orderby' => 'publish_date',
            'order'   => 'DESC',
            'post_status' => array('publish'),
            'posts_per_page' => $posts_number,
            'tax_query' => 'all',
            'paged' => 1
        );

        
        
        $noBorderBottom = $posts_number - 1;
        
        $query = new WP_Query( $args );

                // The Loop
                if ( $query->have_posts() ) {

                    $html.= '<div class="container">';
                    $html.=     '<div class="row grid-actu-pge-principale">';
                    while ( $query->have_posts() ) {
                        $query->the_post();
                        $html.='<div class="col-sm-4 col-12 actu">';
                        $html.=     "<a class='lien-actu' href='".get_permalink()."'>";
                        $html.=         '<div class="img-actu">';
                        $html.=             '<img src="'.get_the_post_thumbnail_url(get_the_ID(), 'full').'" class="img-responsive">';
                        $html.=         '</div>';
                        $html.=         '<div class="titre-actualite">';
                        $html.=            get_the_title();
                        $html.=         '</div>';
                        $html.=         '<div class="a-propos-actu">';
                        $html.=            get_the_date('F Y');
                        $html.=         '</div>';
                        $html.=         "<div class='middle-bouton-golden bouton-actualite'>";
                        $html.=            "<div class='DMGolden bouton-golden-actualite bckgdWhite'>EN SAVOIR +</div>";
                        $html.=         "</div>";
                        $html.=     "</a>";
                        $html.='</div>';
                        
                    }
                    $html.=    '</div>';
                    $html.='</div>';
                } else {
                    // no posts found
                }

		return $html;
	}

}
vc_map(

	array(
		'name' => 'HC Grille d\'évènements et de posts destinée à la page principale',
		'base' => 'hc_gridEvenementsPostPgePrincipale',
		'description' => '', 
		'category' => 'Humans Connexion',
		'show_settings_on_create' => true,
		'icon' => hcvc_plugin_url().'/inc/vc-elements/icons/hc_icon.png',
		'params' => array( 
            array(
				'type' => 'textfield',
				'value' => '',
				'heading' => 'Nombre d\'évènements à afficher',
				'admin_label' => true,
                'param_name'  => 'posts_number',
				'weight' => 0,
                'description' => ''
			)
		)
	)
	
);
          
