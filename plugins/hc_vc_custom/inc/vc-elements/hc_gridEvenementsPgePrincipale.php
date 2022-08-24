<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/*
Element Description: VC custom - Human's connexion
*/

/* Custom Card */
class WPBakeryShortCode_hc_gridEvenementsPgePrincipale extends WPBakeryShortCode {
    

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

        $args = array(
            'posts_per_page' => $posts_number,
            'post_type' => 'tribe_events',//Display only event post types
            'eventDisplay' => 'custom',//Needed to override tribe's modifications to the WP_Query
            'order' => 'ASC',//Order events by the ones closest to today first
            'orderby' => '_EventStartDate',//Order events using their start date
            'meta_query' => array( array(
                'key' => '_EventStartDate',//Compare using the event's start date
                'value' => date('Y-m-d H:i:s'),//Compare against today's date
                'compare' => '>=',//Get events that are set to the value's date or in the future
                'type' => 'DATE'//This is a date query
            ) )
        );
        
        
        $noBorderBottom = $posts_number - 1;
        
        $query = new WP_Query( $args ); 


                $html.= '<div class="hc-tribe-event-main-grid container">';
                $html.=     '<div class="row">';
                $html.=         '<div class="col-12 item-selector">';
                
                // The Loop
                $traitSeparation=true;
                if ( $query->have_posts() ) {
                    while ( $query->have_posts() ) {
                        $query->the_post();
        
                        $html.=     "<a class='lien-actu' href='".get_permalink()."'>";
                        $html.=         '<div class="titre-actualite">';
                        $html.=            get_the_title();
                        $html.=         '</div>';
                        $html.=         '<div class="venue">';
                        $html.=            tribe_get_venue();
                        $html.=         '</div>';
                        $html.=         '<div class="date-concert">';
                        $html.=            tribe_get_start_date($event = null, $display_time = true, $date_format = 'j F Y \- G\hi', $timezone = null);
                        $html.=         '</div>';
                        $html.=     "</a>"; 
                        if($traitSeparation){
                            $html.=         '<div class="trait-separation">trait</div>';
                            $traitSeparation=false;
                        }
                    }
                    
                } else {
                    // no posts found
                }
                /* Restore original Post Data */
                wp_reset_postdata();
                
                $html.=        '</div>';
                $html.=     '</div>';
                $html.='</div>';

		return $html;
	}

}
vc_map(

	array(
		'name' => 'HC Grille d\'évènements destinée à la page principale',
		'base' => 'hc_gridEvenementsPgePrincipale',
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
          
