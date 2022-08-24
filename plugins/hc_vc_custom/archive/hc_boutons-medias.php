<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/*
Element Description: VC custom - Human's connexion
*/

/* Custom Card */
class WPBakeryShortCode_hc_evenements extends WPBakeryShortCode {
    

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

        /*Query*/
        $today = date('Y-m-d');
        $args = array(
            'post_type' => 'tribe_events',
            'orderby'=> '_EventStartDate',
            'order'   => 'ASC',
            'posts_per_page' => $posts_number, 

            'meta_query' => array(
                'relation' => 'AND',
                array(
                    'key'     => '_EventStartDate',
                    'value'   => $today,
                    'compare' => '>=',
                    'type' 	  => 'DATE',
                ),
                array(
                    'key'    => 'complet',
                    /* 'value' => 'oui', */
                    'compare' => 'NOT EXISTS',
                ) 
            )
        );
        
        $noBorderBottom = $posts_number - 1;
        
        $query = new WP_Query( $args );
        
                // The Loop
                /* var_dump($query); */
                if ( $query->have_posts() ) {
                    while ( $query->have_posts() ) {
                        $query->the_post();
                           
                            $html.='<div class="row item-grid-agenda">';
                            $html.=     '<div class="col-1 date">';
                            $html.=        '<div class="jour judson70">'.tribe_get_start_date($event = null, $display_time = true, $date_format = 'd', $timezone = null).'</div>';
                            $html.=        '<div class="mois judson33">'.tribe_get_start_date($event = null, $display_time = true, $date_format = 'M', $timezone = null).'</div>';
                            $html.=     '</div>';
                            $html.=     '<div class="col-1"></div>';
                            $html.=     '<div class="col-4 a-propos">';
                            $html.=         '<div class="titre judson40">'.get_the_title().'</div>';
                            $html.=         '<div class="lieu DM-sans16">'.tribe_get_venue().'</div>';
                            $html.=     '</div>';
                            $html.=     '<div class="col-1"></div>';
                            $html.=     '<div class="col-1">';
                            $html.=         '<div class="heure DM-sans16">'.tribe_get_start_time().'</div>';
                            $html.=     '</div>';
                            $html.=     '<div class="col-2"></div>';
                            $html.=     '<div class="col-2">';
                            $html.=         '<div class="middle-bouton-golden"><a class="DMGolden bouton-white" href="'.get_permalink().'">RÉSERVER</a></div>';
                            $html.=     '</div>';
                            $html.='</div>';
                            $html.='<div class="trait-horizontal-gris"></div>';
                            
                            
                    }
                } else {
                    // no posts found
                }

		return $html;
	}

}
vc_map(

	array(
		'name' => 'HC Grille d\'évènements',
		'base' => 'hc_evenements',
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
