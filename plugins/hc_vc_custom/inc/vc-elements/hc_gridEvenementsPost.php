<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/*
Element Description: VC custom - Human's connexion
*/

/* Custom Card */
class WPBakeryShortCode_hc_gridEvenementsPost extends WPBakeryShortCode {
    

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
            'post_type' => 'post',
            'orderby' => 'publish_date',
            'order'   => 'DESC',
            'post_status' => array('publish'),
            'posts_per_page' => $posts_number,
            'tax_query' => 'all',
            'paged' => 1
        );

        
        
        $noBorderBottom = $posts_number - 1;
        
        $query = new WP_Query( $args );

                $html.= '<div id="hc-post-grid-0002" class="hc-post-grid container">';
                $html.= '</br>';

                $html.= '<div class="row " id="items_container">';

                // The Loop
                if ( $query->have_posts() ) {

                    $html.= '<div class="container">';
                    $html.=     '<div class="row">';
                    while ( $query->have_posts() ) {
                        $query->the_post();
                        $html.='<div class="col-lg-4 col-sm-6 col-12 actu">';
                        $html.=     "<a class='lien-actu' target='_blank' href='".get_field('lien_vers_article_presse')."'>";
                        $html.=         '<div class="img-actu">';
                        $html.=             '<img  class="img-responsive" src="'.get_the_post_thumbnail_url(get_the_ID(), 'full').'" class="img-responsive">';
                        $html.=         '</div>';
                        $html.=         '<div class="titre-actualite">';
                        $html.=            get_the_title();
                        $html.=         '</div>';
                        $html.=         '<div class="a-propos-actu">';
                        $html.=            get_the_date('F Y');
                        $html.=         '</div>';
                        $html.=         "<br>";
                        $html.=         "<div class='middle-bouton-golden bouton-actualite'>";
                        $html.=            "<div class='DMGolden bouton-golden-actualite'>EN SAVOIR +</div>";
                        $html.=         "</div>";
                        $html.=         "<br>";
                        $html.=     "</a>";
                        $html.='</div>';
                        
                    }
                    $html.=    '</div>';
                    $html.='</div>';
                } else {
                    // no posts found
                }
                /* Restore original Post Data */
                wp_reset_postdata();
                
            $html.= '</div>'; /* .row */
            
                $totalPost = $query->found_posts;
                $html .= '<div class="row">';
                $html .= '<div id="blog-load-more" class="col-12 text-center">';
                $html .= '<p><span class="current-posts-number"  data-post-number="'.$posts_number.'"></span><span class="posts-total" data-total-posts="' . $totalPost . '"></span></p>';
                
                $pagination=2;

                $html .= '<div class="page-actu-pagination">';
                $html.=     '<ul>';
                $html.=         '<li  data-page="1" data-current_category="all" data-postPerPage="'.$posts_number.'" class="1 active">';
                $html.=             '1';
                $html.=         '</li>';
                

                for ($i=6; $i <$totalPost ; $i=$i+$posts_number) { 
                    $html .= '<li data-page="'.$pagination.'" data-current_category="all" data-postPerPage="'.$posts_number.'">'. $pagination .' '. '</li>';
                    $pagination++;
                }

                $html.=     '</ul>';
                $html .= '</div>';

                $html .= '</div>';
                $html .= '</div>';
            
		$html.= '</div>';

                 
                       

		return $html;
	}

}
vc_map(

	array(
		'name' => 'HC Grille d\'évènements et de posts',
		'base' => 'hc_gridEvenementsPost',
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
          
