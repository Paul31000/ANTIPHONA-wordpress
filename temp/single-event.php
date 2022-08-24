<?php
/**
 * Template Name: Single Event Template
 * A single event. This displays the event title, description, meta, and
 * optionally, the Google map for the event.
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/single-event.php
 *
 * @package TribeEventsCalendar
 * @version 4.6.19
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

$events_label_singular = tribe_get_event_label_singular();
$events_label_plural   = tribe_get_event_label_plural();

$event_id = get_the_ID();

/**
 * Allows filtering of the single event template title classes.
 *
 * @since 5.8.0
 *
 * @param array  $title_classes List of classes to create the class string from.
 * @param string $event_id The ID of the displayed event.
 */
$title_classes = apply_filters( 'tribe_events_single_event_title_classes', [ 'tribe-events-single-event-title' ], $event_id );
$title_classes = implode( ' ', tribe_get_classes( $title_classes ) );

/**
 * Allows filtering of the single event template title before HTML.
 *
 * @since 5.8.0
 *
 * @param string $before HTML string to display before the title text.
 * @param string $event_id The ID of the displayed event.
 */
$before = apply_filters( 'tribe_events_single_event_title_html_before', '<h1 class="' . $title_classes . '">', $event_id );

/**
 * Allows filtering of the single event template title after HTML.
 *
 * @since 5.8.0
 *
 * @param string $after HTML string to display after the title text.
 * @param string $event_id The ID of the displayed event.
 */
$after = apply_filters( 'tribe_events_single_event_title_html_after', '</h1>', $event_id );

/**
 * Allows filtering of the single event template title HTML.
 *
 * @since 5.8.0
 *
 * @param string $after HTML string to display. Return an empty string to not display the title.
 * @param string $event_id The ID of the displayed event.
 */
$title = apply_filters( 'tribe_events_single_event_title_html', the_title( $before, $after, false ), $event_id );

/* Info from address.php */
$venue_id = get_the_ID();
$full_region = tribe_get_full_region( $venue_id );

/* Get latitude and longitude coordonates */
$lat = Tribe__Events__Pro__Geo_Loc::get_lat_for_event($venue_id);
$long = Tribe__Events__Pro__Geo_Loc::get_lng_for_event($venue_id);

/* echo $lat;
echo $long;
echo get_stylesheet_directory_uri(); */

$venueName = tribe_get_venue();


global $wpdb;
$prefix = $wpdb->prefix;
$tableName = 'postmeta';
$res = $wpdb->get_row('SELECT post_id FROM '.$prefix.$tableName.' WHERE meta_value = '.get_the_ID().' AND meta_key LIKE "_tribe_wooticket_for_event"');


?>

<div id="tribe-events-content" class="tribe-events-single">
    <div class="event-top-back">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12 col-md-9">
                    <?php echo $before ?>
                    <p class="tribe-events-back">
                        <a href="<?php echo esc_url( tribe_get_events_link() ); ?>"> <?php printf( '< ' . esc_html_x( 'All %s', '%s Events plural label', 'the-events-calendar' ), $events_label_plural ); ?></a>
                    </p>
                    <!-- </div> -->
                    <!-- Notices -->
                    <?php tribe_the_notices() ?>
                    <div>
                    <?php echo $title; ?>
                    </div>


                    <!--HC- Event Date -->
                    <div class="tribe-events-schedule tribe-clearfix">
                        <?php echo tribe_events_event_schedule_details( $event_id, '<h2>', '</h2>' ); ?>
                    </div>
                    <!-- Event header -->


                    <div id="tribe-events-header" <?php tribe_events_the_header_attributes() ?>>
                        <!-- Navigation -->
                        <nav class="tribe-events-nav-pagination" aria-label="<?php printf( esc_html__( '%s Navigation', 'the-events-calendar' ), $events_label_singular ); ?>">
                            <ul class="tribe-events-sub-nav">
                                <li class="tribe-events-nav-previous"><?php tribe_the_prev_event_link( '<span>&laquo;</span> %title%' ) ?></li>
                                <li class="tribe-events-nav-next"><?php tribe_the_next_event_link( '%title% <span>&raquo;</span>' ) ?></li>
                            </ul>
                            <!-- .tribe-events-sub-nav -->
                        </nav>
                    </div>
                </div>
                <div class="col-12 col-lg-3">
                    <?php if($res->post_id !== NULL) { ?>
                    <a href="<?php echo wc_get_cart_url() ?>?add-to-cart=<?php echo $res->post_id ?>" class="button donation-btn">S'inscrire en ligne</a>
                    <?php } else {
                        echo '<p></p>';
                    } ?>
                    <!-- <a href="#" class="button donation-btn">S'inscrire en ligne</a> -->
                   <!--  <a href="<?php echo tribe_get_event_link() ?>#tribe-tickets" title="Buy Now" rel="bookmark" class="button donation-btn">S'inscrire en ligne</a> -->
                </div>
            </div>
        </div>
	    <!-- #tribe-events-header -->

        <div class="infos-bar">
            <div class="container">
                <div class="col-12 col-md-3 infos-square border-right">
                    <img src="https://coteauxpais.prep.demohc.com/wp-content/uploads/2021/09/debut.png" alt="">
                    <p class="infos-title">Début</p>
                    <p><?php echo tribe_get_start_date(); ?></p>
                </div>
                <div class="col-12 col-md-3 infos-square border-right">
                    <img src="https://coteauxpais.prep.demohc.com/wp-content/uploads/2021/09/fin.png" alt="">
                    <p class="infos-title">Fin</p>
                    <p><?php echo tribe_get_end_date(); ?></p>
                </div>
                <div class="col-12 col-md-3 infos-square border-right">
                    <img src="https://coteauxpais.prep.demohc.com/wp-content/uploads/2021/09/lieu.png" alt="">
                    <p class="infos-title">Lieu</p>
                    <p><?php echo tribe_get_venue( $venue_id ); ?></p>
                    <p><?php echo tribe_get_address( $venue_id ); ?></p>
                    <p><?php echo tribe_get_zip( $venue_id ); ?></p>
                    <p><?php echo tribe_get_city( $venue_id ); ?></p>
                </div>
                <div class="col-12 col-md-3 infos-square">
                    <img src="https://coteauxpais.prep.demohc.com/wp-content/uploads/2021/09/organisateur.png" alt="">
                    <p class="infos-title">Organisateur</p>
                    <p><?php echo tribe_get_organizer(); ?></p>
                </div>
            </div>
        </div>
    </div>
   
    <div class="event-content-back">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="d-flex"><h2 class="px-3">Au programme</h2></div>
                        <?php while ( have_posts() ) :  the_post(); ?>
                            <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                                <!-- Event featured image, but exclude link -->
                                <?php /* echo tribe_event_featured_image( $event_id, 'full', false ); */ ?>

                                <!-- Event content -->
                                <?php do_action( 'tribe_events_single_event_before_the_content' ) ?>
                                <div class="tribe-events-single-event-description tribe-events-content">
                                    <?php the_content(); ?>
                                </div>
                                <!-- .tribe-events-single-event-description -->
                                <?php do_action( 'tribe_events_single_event_after_the_content' ) ?>
                            </div>
                </div>

               <?php  $additional_fields = tribe_get_custom_fields();?>
                <div class="col-12 col-md-6">
                    <div class="d-flex"><h2 class="px-3">Tarifs</h2></div>
                    <div>
                    <?php if ( tribe_get_cost()){ ?>
			            <span class="tribe-events-cost"><?php echo tribe_get_cost( null, true ) ?></span>
                        <?php if ($additional_fields['Acompte ?'] === "Oui"){ ?>
                                <p class="cost-infos">Ce montant correspond à un acompte</p>
                           <?php } ?>
                        <!-- <p class="cost-infos">Ce montant correspond à un acompte</p> -->
		            <?php }else{
                         ?><!-- <p>Gratuit</p> -->
                         <p class="cost-infos">Pour toute inscription, veuillez prendre contact avec l'équipe concernée.</p>
                    <?php }; ?>
                    </div>
                </div>
            </div>


            <?php if($res->post_id !== NULL) { ?>
            <div class="row">
                <div class="col-12">
                    <div class="d-flex"><h2 class="px-3">Comment s'inscrire ?</h2></div>
                </div>
            </div>
            <div class="row align-items-start pb-5">
                <div class="col-12 col-md-4 col-lg-3 px-0">
                    <div class="event-steps">
                    <p class="steps-nbr">1</p>
                    <p>Je sélectionne mon/mes activités</p>
                    </div>
                </div>
                <div class="col-12 col-md-4 col-lg-3 px-0">
                    <div class="event-steps">
                    <p class="steps-nbr">2</p>
                    <p>Je valide mon/mes activités</p>
                    </div>
                </div>
                <div class="col-12 col-md-4 col-lg-3 px-0">
                    <div class="event-steps">
                    <p class="steps-nbr">3</p>
                    <p>Je rentre mes données personnelles et je valide l'inscription</p>
                    </div>
                </div>
                <div class="col-12 col-lg-3 event-register">
                        <p class="yellowtail-title">Inscrivez-vous dès maintenant</p>
                        <a href="<?php echo wc_get_cart_url() ?>?add-to-cart=<?php echo $res->post_id ?>" class="button donation-btn">S'inscrire en ligne</a>
                    <!-- <a href="#" class="button donation-btn">S'inscrire en ligne</a> -->
                </div>
            </div>
            <?php } else {
                /* echo '<p></p>'; */
            } ?>
        </div>
    </div>
                            <!-- MAP -->
    
   
                            <div id="mapid">
                            <?php  $the_query = new WP_Query(array('post_type'=>'post', 'post_status'=>'publish', 'posts_per_page'=>-1));
                                if ( $the_query ->have_posts() ) : 
                                    while ( $the_query->have_posts() ) : $the_query->the_post();?>
                                        <div class="marker"  data-url="<?php the_permalink(); ?>"  data-title= "<h4><?php echo $venueName; ?></h4>" rel="bookmark" data-lat="<?php echo $lat; ?>" 
                                            data-long="<?php echo $long; ?>">
                                        </div>
                                    <?php endwhile; ?>
                                    <?php wp_reset_postdata(); ?>
                            <?php else : ?>
                                <p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
                            <?php endif; ?>
                        </div>
	                    <!-- Event footer -->



                        
                        <!-- Event meta -->
                        <?php /* do_action( 'tribe_events_single_event_before_the_meta' ) */ ?>
                        <?php /* tribe_get_template_part( 'modules/meta' ); */ ?>
                        <?php do_action( 'tribe_events_single_event_after_the_meta' ) ?>
                    </div> <!-- #post-x -->
                    <?php if ( get_post_type() == Tribe__Events__Main::POSTTYPE && tribe_get_option( 'showComments', false ) ) comments_template() ?>
                <?php endwhile; ?>
        
    



	<!-- <div id="tribe-events-footer">
		
		<nav class="tribe-events-nav-pagination" aria-label="<?php printf( esc_html__( '%s Navigation', 'the-events-calendar' ), $events_label_singular ); ?>">
			<ul class="tribe-events-sub-nav">
				<li class="tribe-events-nav-previous"><?php tribe_the_prev_event_link( '<span>&laquo;</span> %title%' ) ?></li>
				<li class="tribe-events-nav-next"><?php tribe_the_next_event_link( '%title% <span>&raquo;</span>' ) ?></li>
			</ul>
			
		</nav>
	</div> -->
	<!-- #tribe-events-footer -->

</div><!-- #tribe-events-content -->
