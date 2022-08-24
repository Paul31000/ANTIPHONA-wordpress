<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/*
Element Description: VC custom - Human's connexion
*/

/* Custom Card */
class WPBakeryShortCode_hc_gridProgrammes extends WPBakeryShortCode {
    

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

        $cat=get_categories('taxonomy=prgm_category&type=custom_post_type'); 


        /*QUERY NOUVEAU (pour afficher nouveauté en premier)*/
        $args = array(
            'post_type' => array('prgm'),
            'orderby' => 'type',
            'post_status' => array('publish'),
            'posts_per_page' =>100,
            'tax_query' => array(
                array (
                    'taxonomy' => 'prgm_category',
                    'field' => 'slug',
                    'terms' => ('nouveau'),
                )
            ),
            'paged' => 1
        );

        $html.='<div class="prgramme-category-block">';
        $html.=     '<div class="prgramme-category-text">'."Nouveauté".'</div>';
        
        $query = new WP_Query( $args );
                // The Loop
                if ( $query->have_posts() ) {
                    while ( $query->have_posts() ) {
                        $query->the_post();
                        $html.="<a class='item-programme' href='".get_permalink()."'>";
                        $html.=     '<div class="titre-item-programme">'. get_the_title() .'</div>';
                        $html.=     '<img class="item-fleche" src="'.site_url().'/wp-content/uploads/2021/12/fleche-or.png">';
                        $html.="</a>";
                    }
                }
        wp_reset_postdata();     
        $html.='</div>';
        $html.='<div class="trait-horizontal-gris"></div>';


        /*QUERY AUTRES SLUGS (pour afficher nouveauté en premier)*/

        for($i=0;$i<count($cat);$i++){
            if($cat[$i]->slug!='nouveau'){
                /*Query*/
                $args = array(
                    'post_type' => array('prgm'),
                    'orderby' => 'type',
                    'post_status' => array('publish'),
                    'posts_per_page' =>100,
                    'tax_query' => array(
                        array (
                            'taxonomy' => 'prgm_category',
                            'field' => 'slug',
                            'terms' => ($cat[$i]->slug),
                        )
                    ),
                    'paged' => 1
                );
                if($i<count($cat)){
                    $html.='<div class="trait-horizontal-gris"></div>';
                }

                $html.='<div class="prgramme-category-block">';
                $html.=     '<div class="prgramme-category-text">'.$cat[$i]->name.'</div>';
                
                $query = new WP_Query( $args );
                        // The Loop
                        if ( $query->have_posts() ) {
                            while ( $query->have_posts() ) {
                                $query->the_post();
                                $html.="<a class='item-programme' href='".get_permalink()."'>";
                                $html.=     '<div class="titre-item-programme">'. get_the_title() .'</div>';
                                $html.=     '<img class="item-fleche" src="'.site_url().'/wp-content/uploads/2021/12/fleche-or.png">';
                                $html.="</a>";
                            }
                        }
                wp_reset_postdata();     
                $html.='</div>';
            }
        }

		return $html;
	}

}
vc_map(

	array(
		'name' => 'HC Grille de programmes',
		'base' => 'hc_gridProgrammes',
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
          
