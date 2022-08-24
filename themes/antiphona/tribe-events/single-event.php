<?php
/**
 * Single Event Template
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


/* Get latitude and longitude coordonates */
$lat=get_field('latitude');
$long=get_field('longitude');
?>


		<div class="container" >
               <div class="row">
                  <div class="col-12 d-flex justify-content-center" id="breadcrumb_container_page">
                     <?php
                     if ( function_exists('yoast_breadcrumb') && !is_front_page() ) {
                     yoast_breadcrumb( '<p id="breadcrumbs">','</p>' );
                     }
                     ?>
                  </div>
               </div>
        </div> 
		<div class="container-fluid fond-gris">
			<div class="container">
				<br><br>
				<div class="row ">
					<div class="col-12">
						<br>
					</div>	
					<div class="col-12 d-flex justify-content-center">
						<div class="trait-vertical ">
							<br><br><br><br>
						</div>
					</div>	
				</div>
				<div class="row">
					<div class="col-12 d-flex justify-content-center">
						<?php echo $title; ?>
					</div>
				</div>
				<div class="row">
					<div class="col-12">
						<br><br>
						<a class="DMGolden lien-page-single" href="https://antiphona.prep.demohc.com/agenda/">
							<img src="https://antiphona.prep.demohc.com/wp-content/uploads/2021/12/fleche-or-gauche.png" alt="date"/>&nbsp;&nbsp;&nbsp;&nbsp;TOUS LES ÉVÈNEMENTS
						</a>
						<br><br>
					</div>
				</div>
				
				<div class="row">
					<div class="col-12 col-sm-6 event-information">
					
						<div class="title judson40 bold event-item"><?php the_title( false ) ?></div>
						
						<div class="DM-sans16 event-item">
							<img src="https://antiphona.prep.demohc.com/wp-content/uploads/2021/12/calendar@2x.png" alt="date"/>&nbsp;&nbsp;
							<?php echo tribe_get_start_date($event = null, $display_time = true, $date_format = 'd\ M', $timezone = null) ?>
						</div>	
						
						<div class="DM-sans16 event-item">
							<img src="https://antiphona.prep.demohc.com/wp-content/uploads/2021/12/clock@2x.png" alt="heure"/>&nbsp;&nbsp;
							<?php echo tribe_get_start_time(); ?>
						</div>	
						
						<div class="DM-sans16 event-item">
							<img src="https://antiphona.prep.demohc.com/wp-content/uploads/2021/12/placeholder@2x.png" alt="localisation"/>&nbsp;&nbsp;
							<?php  
                    		echo tribe_get_address($event_id );
							echo " ";
                    		echo tribe_get_zip( $event_id ); 
							echo " ";
                   			echo tribe_get_city( $event_id ); ?>
						</div>
						
						<div class="DM-sans16 event-item">
							<?php while ( have_posts() ) :  the_post(); ?>
							<?php the_content(); ?>
							<?php endwhile; ?>
						</div>
						
						<div class="row">
							<div class="col-12 col-sm-6 boutons-event">
								<?php $link = get_field('lien_site_achat_de_places');
								if( $link ):?>
									<div class="middle-bouton-golden"><a class="DMGolden bouton-white" target="blank" href="<?php echo esc_url( $link );?>">RÉSERVER</a></div>
								<?php endif; ?>
							</div>
							<div class="col-12 col-sm-6 boutons-event">
								<div class='DM-sans16 bold partager-event'>
									PARTAGER:
									<a class="" target="blank"  href="https://www.facebook.com/sharer.php?u=<?php echo(post_permalink(get_the_ID())); ?>&t=<?php echo(the_title( false )); ?>"> 
										<svg id="Groupe_153" data-name="Groupe 153" xmlns="http://www.w3.org/2000/svg" width="9.911" height="19.031" viewBox="0 0 9.911 19.031">
											<path id="Tracé_2175" data-name="Tracé 2175" d="M2.923,19.031c0-.07-.014-.139-.014-.209q0-4.126,0-8.253c0-.215,0-.215-.211-.215H0V6.984H.2c.843,0,1.686,0,2.529,0,.143,0,.184-.041.183-.184-.006-.854-.017-1.708,0-2.562A4.377,4.377,0,0,1,3.968,1.306,3.835,3.835,0,0,1,6.318.08,11.473,11.473,0,0,1,8.694.043c.361.019.721.046,1.082.065.093,0,.135.033.135.133q0,1.451,0,2.9A.458.458,0,0,1,9.9,3.21c-.053,0-.11.009-.167.009-.524,0-1.049-.008-1.573,0a4,4,0,0,0-.786.083,1.11,1.11,0,0,0-.928,1.13c-.023.8-.021,1.6-.037,2.4,0,.146.072.152.181.151q1.476,0,2.951,0H9.76c-.031.266-.058.515-.09.763-.081.63-.165,1.26-.247,1.89-.025.192-.051.385-.071.577-.013.118-.077.142-.186.141-.854,0-1.708,0-2.562-.006-.159,0-.2.049-.2.2q.006,4.126,0,8.253c0,.075-.009.15-.014.225Z" transform="translate(0 0)" fill="#d1b062"/>
										</svg>
									</a>
									<a class=""  target="blank" href="https://twitter.com/share?url=<?php echo(post_permalink(get_the_ID())); ?>&text=<?php echo(the_title( false )); ?>&via=ensantiphona">
										<svg enable-background="new 0 0 310 310" version="1.1" viewBox="0 0 310 310" xml:space="preserve" xmlns="http://www.w3.org/2000/svg">
											<path d="m302.97 57.388c-4.87 2.16-9.877 3.983-14.993 5.463 6.057-6.85 10.675-14.91 13.494-23.73 0.632-1.977-0.023-4.141-1.648-5.434-1.623-1.294-3.878-1.449-5.665-0.39-10.865 6.444-22.587 11.075-34.878 13.783-12.381-12.098-29.197-18.983-46.581-18.983-36.695 0-66.549 29.853-66.549 66.547 0 2.89 0.183 5.764 0.545 8.598-45.535-3.998-87.868-26.379-116.94-62.038-1.036-1.271-2.632-1.956-4.266-1.825-1.635 0.128-3.104 1.05-3.93 2.467-5.896 10.117-9.013 21.688-9.013 33.461 0 16.035 5.725 31.249 15.838 43.137-3.075-1.065-6.059-2.396-8.907-3.977-1.529-0.851-3.395-0.838-4.914 0.033-1.52 0.871-2.473 2.473-2.513 4.224-7e-3 0.295-7e-3 0.59-7e-3 0.889 0 23.935 12.882 45.484 32.577 57.229-1.692-0.169-3.383-0.414-5.063-0.735-1.732-0.331-3.513 0.276-4.681 1.597-1.17 1.32-1.557 3.16-1.018 4.84 7.29 22.76 26.059 39.501 48.749 44.605-18.819 11.787-40.34 17.961-62.932 17.961-4.714 0-9.455-0.277-14.095-0.826-2.305-0.274-4.509 1.087-5.294 3.279-0.785 2.193 0.047 4.638 2.008 5.895 29.023 18.609 62.582 28.445 97.047 28.445 67.754 0 110.14-31.95 133.76-58.753 29.46-33.421 46.356-77.658 46.356-121.37 0-1.826-0.028-3.67-0.084-5.508 11.623-8.757 21.63-19.355 29.773-31.536 1.237-1.85 1.103-4.295-0.33-5.998-1.431-1.704-3.816-2.255-5.852-1.353z"/>
										</svg>
									</a>									
								</div>
							</div>
						</div>
					</div>
					
					<div class="col-12 col-sm-6 image-event">	
						<div class="image-event-detail">	
							<?php 
									$image = get_field('image_evenement');
									echo wp_get_attachment_image( $image['ID'], 'full' );
							?>
						</div>	
					</div>

					<div class="col-12">
						<div id="map"></div>
						<script>
							var mapOptions = {
							center: [<?php 
									$venueId = get_post_meta(get_the_ID(), '_EventVenueID')[0]; 
									$lat = get_post_meta($venueId, 'latitude')[0]; 
									$lng = get_post_meta($venueId, 'longitude')[0]; 
									echo($lat);
									echo",";
									echo($lng);
								?>],
							scrollWheelZoom: false,
							zoom: 13}
							var map = L.map("map", mapOptions);
							var layer = new L.TileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png");
							map.addLayer(layer);
							var myIcon = L.icon({
								iconUrl: 'https://antiphona.prep.demohc.com/wp-content/uploads/2022/02/placeholder-red@2x.png',
								iconSize: [35, 43],
								iconAnchor: [17, 43]
							});

							L.marker([
								<?php 
									echo($lat);
									echo",";
									echo($lng);
								?>
								], {icon: myIcon}).addTo(map);
						</script>
					</div>
				</div>
				<div class="row">
					<div class="col-12 col-sm-6">
						<?php
							$prev_post = get_adjacent_post(false, '', true);
							if(!empty($prev_post)) {                              
								echo '<div class="link_sibling_art">';
								echo    '<a href="' . get_permalink($prev_post->ID) . '">';
								echo        '<div class="container-fluid">';
								echo            '<div class="row">';
								echo                '<div class="col-2 link-precedent">'; 
								echo                       '<div class="image"></div>';
								echo                '</div>';
								echo                '<div class="col-10">';
								echo                    '<div class="button_precedent">'; 
								echo                        'PRÉCÉDENT';
								echo                    '</div>' ;
								echo                    '<div class="button-titre-precedent">';
								echo                        $prev_post->post_title;
								echo                    '</div>';
								echo                '</div>'; 
								echo            '</div>';
								echo        '</div>';
								echo     '</a>';
								echo '</div>';
							};
						?> 
					</div>
					<div class="col-12 col-sm-6">
						<?php
								$next_post = get_adjacent_post(false, '', false);
								if(!empty($next_post)) {                              
									echo '<div class="link_sibling_art">';
									echo    '<a href="' . get_permalink($next_post->ID) . '">';
									echo        '<div class="container-fluid">';
									echo            '<div class="row ">';
									echo                '<div class="col-10" >';
									echo                    '<div class="row" >';
									echo                        '<div class="col-12 button_precedent d-flex justify-content-end ">'; 
									echo                            'SUIVANT';
									echo                        '</div>' ;
									echo                        '<div class="col-12 button-titre-precedent d-flex justify-content-end">';
									echo                            $next_post->post_title;
									echo                        '</div>';
									echo                     '</div>';
									echo                '</div>'; 
									echo                '<div class="col-2 link-suivant">'; 
									echo                       '<div class="image"></div>';
									echo                '</div>';
									echo            '</div>';
									echo        '</div>';
									echo     '</a>';
									echo '</div>';
								};
							?> 
					</div>
				</div>
			</div>
		</div>
	</div>

	

