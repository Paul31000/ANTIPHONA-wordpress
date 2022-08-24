<?php
add_action( 'wp_enqueue_scripts', 'wpm_enqueue_styles' );

function wpm_enqueue_styles(){
wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
wp_enqueue_style('slick-css', get_stylesheet_directory_uri() .'/css/slick.css');
wp_enqueue_style('slick-theme-css', get_stylesheet_directory_uri() .'/css/slick-theme.css');
wp_enqueue_style('leaflet-map-css', 'https://unpkg.com/leaflet@1.7.1/dist/leaflet.css');
}

function hc_register_scripts() {
    wp_enqueue_script('hc-jquery', 'https://antiphona.prep.demohc.com/wp-includes/js/jquery/jquery.min.js?ver=3.5.1', array(), false, false);
    wp_enqueue_script('nav-script', get_stylesheet_directory_uri(). '/assets/js/hc-sticky-nav.js', array(), false, false);
    wp_enqueue_script('hc-post-grid', get_stylesheet_directory_uri(). '/assets/js/post-grid.js', array(), false, false);
    wp_enqueue_script('hc-post-grid-evenements', get_stylesheet_directory_uri(). '/assets/js/post-grid-evenements.js', array(), false, false);
    wp_enqueue_script('hc-slick-slider', get_stylesheet_directory_uri(). '/assets/js/slick-slider.js', array(), false, false);
    wp_enqueue_script('slick-min-js', get_stylesheet_directory_uri(). '/assets/js/slick.min.js', array(), false, false);
    wp_enqueue_script('leaflet-map-script', "https://unpkg.com/leaflet@1.7.1/dist/leaflet.js", array(), false, false);
}

add_action( 'wp_enqueue_scripts', 'hc_register_scripts' );

/**
 * Remove new widget editor
 */
add_filter( 'gutenberg_use_widgets_block_editor', '__return_false', 100 );
add_filter( 'use_widgets_block_editor', '__return_false' );

/* ajout logo */
add_theme_support('custom-logo');

/* integrity feuille css */
function add_leaflet_cdn_attributes( $html, $handle ) {
    if ( 'leaflet-map-css' === $handle ) {
        return str_replace( "media='all'", "media='all' integrity='sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==' crossorigin=''", $html );
    }
    return $html;
}
add_filter( 'style_loader_tag', 'add_leaflet_cdn_attributes', 10, 2 );

/* integrity script map */
function add_defer_jquery( $tag, $handle ) {
    if ( 'leaflet-map-script' === $handle ) {
        return str_replace( "id", "integrity=\"sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==\" crossorigin=\"\" id", $tag );
    }
    return $tag;
}
add_filter( 'script_loader_tag', 'add_defer_jquery', 10, 2 );

/* autoriser les svg */
function cc_mime_types($mimes) {
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}

add_filter('upload_mimes', 'cc_mime_types');

// sidebar
add_action( 'widgets_init', 'sortie_de_crise_widgets_init' );
function sortie_de_crise_widgets_init() {
    
    register_sidebar( array(
        'name'          => __( 'footer logo slogan', 'sortie_de_crise_website' ),
        'id'            => 'footer-logo',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );
    register_sidebar( array(
        'name'          => __( 'footer newsletter title', 'sortie_de_crise_website' ),
        'id'            => 'footer-newsletter-title',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );
    register_sidebar( array(
        'name'          => __( 'footer newsletter formulaire', 'sortie_de_crise_website' ),
        'id'            => 'footer-newsletter-formulaire',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );
    register_sidebar( array(
        'name'          => __( 'footer reseaux', 'sortie_de_crise_website' ),
        'id'            => 'footer-reseaux',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );

}

// debut route ajax
function custom_api_get_posts(){
    register_rest_route( 'posts', '/all-posts', array(
        'methods' => 'GET',
        'callback' => 'custom_api_get_posts_callback'
    ));
}
add_action('rest_api_init', 'custom_api_get_posts');

function custom_api_get_posts_callback($request){
    $paged = $request->get_param('page');
    $paged = (isset($paged) || !(empty($paged))) ? $paged : 1;
    $category = $request->get_param('category');
    $postPerPage = $request->get_param('post-per-page');
    $postPerPage = (isset($postPerPage) || !(empty($postPerPage))) ? $postPerPage : 12;

    $query_tax = '';
    if($category !== 'all') {
        $query_tax = array(
            [
                'taxonomy' => 'category',
                'field'    => 'term_id',
                'terms'    => array( $category ),
            ]);
    }
    $args = array(
        'post_type' => array('tribe_events','post'),
        'orderby' => 'publish_date',
        'order'   => 'DESC',
        'post_status' => array('publish'),
        'posts_per_page' => $postPerPage,
        'tax_query' => $query_tax,
        'paged' => $paged
    );

    $query = new WP_Query( $args );

    $post_array= [];
    if($query->have_posts()) {
        $i =0;
        while($query->have_posts()) {
            $query->the_post();
            $post_array['posts'][$i]['image'] = get_the_post_thumbnail_url(get_the_ID(), 'full');
            $post_array['posts'][$i]['url'] = get_permalink();
            if( get_post_type( get_the_ID())=='tribe_events'){
                $post_array['posts'][$i]['title'] = tribe_get_start_date($event = null, $display_time = true, $date_format = 'j F Y', $timezone = null).' , '.tribe_get_venue().':';
                $post_array['posts'][$i]['propos'] = get_the_terms(get_the_ID(),"tribe_events_cat")[0]->name.' | '.get_the_date();
            }else{
                $post_array['posts'][$i]['title'] = get_the_title();
                $post_array['posts'][$i]['propos'] = get_the_category()[0]->name.' | '.get_the_date();
            }
            
            $post_array['posts'][$i]['date'] = get_the_date();
            $i++;
        }
        $post_array['nbCategoryPosts'] = $query->found_posts;
    }

    return $post_array;
}

//
//
// ajax agenda
//
//


// debut route ajax
function custom_api_get_evenements(){
    register_rest_route( 'agendaRequete', '/tous-evenements', array(
        'methods' => 'GET',
        'callback' => 'requete_evenements'
    ));
}
add_action('rest_api_init', 'custom_api_get_evenements');

function requete_evenements($request){
    $pourMois = $request-> get_param('boolean');
    $pourMois = (boolean)$pourMois;
    if($pourMois){
        $aujourdhui = date('Y-m-d');
        $dateFin = date('Y-m-d', strtotime('+1 month'));
            $args = array(
                'post_type' => 'tribe_events',
                'orderby'=> '_EventStartDate',
                'order'   => 'ASC',
                'posts_per_page' => $posts_number, 
                'meta_query' => array(
                    'relation' => 'AND',
                    array(
                        'key'     => '_EventStartDate',
                        'value'   => $aujourdhui,
                        'compare' => '>=',
                        'type' 	  => 'DATE',
                    ),
                    array(
                        'key'     => '_EventStartDate',
                        'value'   => $dateFin,
                        'compare' => '<=',
                        'type' 	  => 'DATE',
                    ),
                )
            );
    }else{
        $date = date('Y-m-d', strtotime('+1 month'));
            $args = array(
                'post_type' => 'tribe_events',
                'orderby'=> '_EventStartDate',
                'order'   => 'ASC',
                'posts_per_page' => 4, 
                'meta_query' => array(
                    'relation' => 'AND',
                    array(
                        'key'     => '_EventStartDate',
                        'value'   => $date,
                        'compare' => '>=',
                        'type' 	  => 'DATE',
                    ),
                )
            );
    }
    
    $query = new WP_Query( $args );

    $post_array= [];
    if($query->have_posts()) {

        $i =0;
        while($query->have_posts()) {
            $query->the_post();
            $post_array['posts'][$i]['title'] = get_the_title() ;
            $post_array['posts'][$i]['lieu'] = tribe_get_venue();
            $post_array['posts'][$i]['start_jour'] = tribe_get_start_date($event = null, $display_time = true, $date_format = 'd', $timezone = null);
            $post_array['posts'][$i]['start_mois'] = tribe_get_start_date($event = null, $display_time = true, $date_format = 'M', $timezone = null);
            $post_array['posts'][$i]['start_heure'] = tribe_get_start_time();
            $post_array['posts'][$i]['url'] = get_permalink();

            $i++;
        }
        $post_array['nbCategoryPosts'] = $query->found_posts;
    }

    return $post_array;
}

//
//
// CUSTOM POST TYPE PROGRAMME
//
//
function wpm_custom_post_type_prgm() {

	// On rentre les différentes dénominations de notre custom post type qui seront affichées dans l'administration
	$labels = array(
		// Le nom au pluriel
		'name'                => _x( 'programmes', 'Post Type General Name'),
		// Le nom au singulier
		'singular_name'       => _x( 'programme', 'Post Type Singular Name'),
		// Le libellé affiché dans le menu
		'menu_name'           => __( 'programmes'),
		// Les différents libellés de l'administration
		'all_items'           => __( 'Tous les programmes'),
		'view_item'           => __( 'Voir les programmes'),
		'add_new_item'        => __( 'Ajouter un nouveau programme'),
		'add_new'             => __( 'Ajouter'),
		'edit_item'           => __( 'Editer un programme'),
		'update_item'         => __( 'Modifier un programme'),
		'search_items'        => __( 'Rechercher un programme'),
		'not_found'           => __( 'Non trouvée'),
		'not_found_in_trash'  => __( 'Non trouvée dans la corbeille'),
	);
	
	// On peut définir ici d'autres options pour notre custom post type
	
	$args = array(
		'label'               => __( 'programmes'),
		'description'         => __( 'Tous les programmes'),
		'labels'              => $labels,
		// On définit les options disponibles dans l'éditeur de notre custom post type ( un titre, un auteur...)
		'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', ),
		/* 
		* Différentes options supplémentaires
		*/
		'show_in_rest' => true,
		'hierarchical'        => false,
		'public'              => true,
		'has_archive'         => false,
		'rewrite'			  => array( 'slug' => 'programmes'),

	);
	
	// On enregistre notre custom post type qu'on nomme ici "prgrm" et ses arguments
	register_post_type( 'prgm', $args );
                         
    register_taxonomy(
        'prgm_category',
        'prgm',
        array(
          'label' => 'programme',
          'labels' => array(
          'name' => 'Editer les types de programmes',
          'singular_name' => 'Type de programme',
          'all_items' => 'Tous les types de programmes',
          'edit_item' => 'Éditer le type de programme',
          'view_item' => 'Voir le type de programme',
          'update_item' => 'Mettre à jour le type de programme',
          'add_new_item' => 'Ajouter un type de programme',
          'new_item_name' => 'Nouveau programme',
          'search_items' => 'Rechercher parmi les types de programmes',
          'popular_items' => 'Types de programmes les plus utilisés'
        ),
        'hierarchical' => true
        )
      );

    register_taxonomy_for_object_type( 'prgm_category', 'prgm' );
}

add_action( 'init', 'wpm_custom_post_type_prgm', 0 );

function wpm_custom_post_type_album() {

	// On rentre les différentes dénominations de notre custom post type qui seront affichées dans l'administration
	$labels = array(
		// Le nom au pluriel
		'name'                => _x( 'albums', 'Post Type General Name'),
		// Le nom au singulier
		'singular_name'       => _x( 'album', 'Post Type Singular Name'),
		// Le libellé affiché dans le menu
		'menu_name'           => __( 'albums'),
		// Les différents libellés de l'administration
		'all_items'           => __( 'Tous les albums'),
		'view_item'           => __( 'Voir les albums'),
		'add_new_item'        => __( 'Ajouter un nouvel album'),
		'add_new'             => __( 'Ajouter'),
		'edit_item'           => __( 'Editer un album'),
		'update_item'         => __( 'Modifier un album'),
		'search_items'        => __( 'Rechercher un album'),
		'not_found'           => __( 'Non trouvée'),
		'not_found_in_trash'  => __( 'Non trouvée dans la corbeille'),
	);
	
	// On peut définir ici d'autres options pour notre custom post type
	
	$args = array(
		'label'               => __( 'albums'),
		'description'         => __( 'Tous les albums'),
		'labels'              => $labels,
		// On définit les options disponibles dans l'éditeur de notre custom post type ( un titre, un auteur...)
		'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', ),
		/* 
		* Différentes options supplémentaires
		*/
		'show_in_rest' => true,
		'hierarchical'        => false,
		'public'              => true,
		'has_archive'         => false,
		'rewrite'			  => array( 'slug' => 'album'),

	);
	
	// On enregistre notre custom post type qu'on nomme ici "prgrm" et ses arguments
	register_post_type( 'album', $args );
             
}

add_action( 'init', 'wpm_custom_post_type_album', 1 );

?>