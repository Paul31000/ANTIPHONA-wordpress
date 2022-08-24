<?php
/** 
 * The theme footer.
 * 
 * @package bootstrap-basic4
 */
?>
            <!-- </div> --><!--row-->

            <footer id="site-footer" class="container-fluid px-0">
                <div class="fondNoir">
                    <div class="container">
                        <div class="row trait-dore">
                            <div class="col-0 col-xl-4"></div>
                            <div class="col-12 col-xl-5 footer-logo">
                                <?php dynamic_sidebar('footer-logo'); ?>
                            </div>
                            <div class="col-0 col-xl-3"></div>
                        </div>
                        <div class="row trait-dore">
                            <div class="col-12 col-xl-4">
                                <?php dynamic_sidebar('footer-newsletter-title'); ?>
                            </div>
                            <div class="col-12 col-xl-8">
                                <?php dynamic_sidebar('footer-newsletter-formulaire'); ?>
                            </div>
                        </div>
                        <div class="row ">
                            <div class="col-12 col-xl-12 reseaux-sociaux">
                                <?php dynamic_sidebar('footer-reseaux'); ?>
                            </div>
                        </div>
                        <div class="row d-flex justify-content-center">
                            <?php
                            wp_nav_menu(array('menu' => 'menu-footer', 'menu_id' => 'primary-menu',
                            'menu_class' => 'nav',
                            'container_id' => 'navbarContent', 'walker' =>  new \BootstrapBasic4\BootstrapBasic4WalkerNavMenu));
                            ?>
                        </div>
                    </div>   
                </div>  
                
<script>
window.axeptioSettings = {
  clientId: "62a0b5ef23bdf0a3a91889ed",
  cookiesVersion: "ensemble antiphona-fr",
};
 
(function(d, s) {
  var t = d.getElementsByTagName(s)[0], e = d.createElement(s);
  e.async = true; e.src = "//static.axept.io/sdk.js";
  t.parentNode.insertBefore(e, t);
})(document, "script");
</script>
            </footer><!--.page-footer-->
             
    <?php wp_footer(); ?>

   
    </body>
</html>