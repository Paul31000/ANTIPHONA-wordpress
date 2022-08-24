<?php
if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}
 
/*
Element Description: VC custom - Human's connexion
*/
 
/* Custom Card */
class WPBakeryShortCode_hc_lienFacebook extends WPBakeryShortCode {
 
 
    protected function content( $atts, $content = NULL ) {
 
        $html = '';
        $theme_path = get_stylesheet_directory_uri(); 
    
            // Params extraction
            extract(
                shortcode_atts(
                    array(
                        
                        // Général
                        'link' => '',
                        'title' => '',
                        'apparence_bouton' => '', 
                    ), 
                    $atts
                )
            );
            
        
           
        $html.=    '<a href="https://www.facebook.com/EnsAntiphona">
                        <svg id="Groupe_153" data-name="Groupe 153" xmlns="http://www.w3.org/2000/svg" width="9.911" height="19.031" viewBox="0 0 9.911 19.031">
                            <path id="Tracé_2175" data-name="Tracé 2175" d="M2.923,19.031c0-.07-.014-.139-.014-.209q0-4.126,0-8.253c0-.215,0-.215-.211-.215H0V6.984H.2c.843,0,1.686,0,2.529,0,.143,0,.184-.041.183-.184-.006-.854-.017-1.708,0-2.562A4.377,4.377,0,0,1,3.968,1.306,3.835,3.835,0,0,1,6.318.08,11.473,11.473,0,0,1,8.694.043c.361.019.721.046,1.082.065.093,0,.135.033.135.133q0,1.451,0,2.9A.458.458,0,0,1,9.9,3.21c-.053,0-.11.009-.167.009-.524,0-1.049-.008-1.573,0a4,4,0,0,0-.786.083,1.11,1.11,0,0,0-.928,1.13c-.023.8-.021,1.6-.037,2.4,0,.146.072.152.181.151q1.476,0,2.951,0H9.76c-.031.266-.058.515-.09.763-.081.63-.165,1.26-.247,1.89-.025.192-.051.385-.071.577-.013.118-.077.142-.186.141-.854,0-1.708,0-2.562-.006-.159,0-.2.049-.2.2q.006,4.126,0,8.253c0,.075-.009.15-.014.225Z" transform="translate(0 0)" fill="#d1b062"/>
                        </svg>
                    </a>';
        
        return $html;
    }
}
    
vc_map(

    array(
        'name' => 'HC lien Facebook',
        'base' => 'hc_lienFacebook',
        'description' => 'lien facebook', 
        'category' => 'Humans Connexion',
        'show_settings_on_create' => true,
        'icon' => hcvc_plugin_url().'/inc/vc-elements/icons/hc_icon.png',
    )
);