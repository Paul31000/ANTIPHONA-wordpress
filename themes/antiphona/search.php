<?php
/** 
 * The search template.
 * 
 * @package bootstrap-basic4
 */


// begins template. -------------------------------------------------------------------------
get_header();
get_sidebar();
?> 

            </div>
                <div class="container">
                    <div class="row">
                        <main id="main" class="col-md-<?php echo \BootstrapBasic4\Bootstrap4Utilities::getMainColumnSize(); ?> site-main" role="main">
                            <?php
                            if (have_posts()) {
                            ?> 
                            <header class="page-header">
                                <h1 class="page-title"><?php 
                                /* translators: %s: The search query string (search value). */
                                printf(__('Search Results for: %s', 'bootstrap-basic4'), '<span>' . get_search_query() . '</span>'); 
                                ?></h1>
                            </header><!-- .page-header -->
                        </main>
                    </div>
                </div>
                <div class="container-fluid">
                    <div id="fond-rouge">
                        <div class="row">
                            <div class="page-content col-12">
                                <div class='row d-flex align-items-center justify-content-center recherche'>
                                    <form id='searchform' method='get' action= <?php esc_url( home_url( '/' ) )?>>
                                        <input type='text' class='search-field' name='s' placeholder='Rechercher' value=<?php get_search_query() ?> >
                                        <input class='submit' value='' type='submit'>
                                    </form>
                                </div>
                            </div><!-- .page-content -->
                        </div>
                    </div>
                    <div class="container">
                        <?php
                            while ( have_posts() ) {
                                    the_post();
                                    $categories_title = '';
                                    foreach(get_the_category() as $category) {
                                        $categories_title .= '<span class="category_title">'.$category->cat_name.'</span>';
                                    }

                                    $html.= '<div class="col-12 search">';
                                    $html.=      '<div class="search-infos-article">';
                                    $html.=              '<p>'.$categories_title.' /'.get_the_date().'</p>';
                                    $html.=      '</div>';
                                    $html.=      '<div class="search-infos-article-titre">';
                                    $html.=              '<p>'.get_the_title().'</p>';
                                    $html.=      '</div>';
                                    $html.=      '<div class="search-infos-article-excerpt">';
                                    $html.=              '<p>'.get_the_excerpt().'</p>';
                                    $html.=      '</div>';
                                    $html.=      '<div class="button-link-post">';
                                    $html.=       '<a href="'.post_permalink().'"> en savoir <span>+</span></a>';
                                    $html.=      '</div>';
                                    $html.= '</div>';
                                    
                                }
                                echo $html;
                        } else {
                            get_template_part('template-parts/section', 'no-results');
                        }// endif;
                        ?> 
                    </div>
                </div>
                
<?php
get_sidebar('right');
get_footer();