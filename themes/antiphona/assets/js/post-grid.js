

jQuery(document).ready(function ($) {
    const pagination = $('.page-actu-pagination li');
    const totalPosts = $('.posts-total');
    const nbPostPerPage = pagination.data('postperpage');

    if($('#hc-post-grid-0002').length) {
        pagination.on("click", function () {
            const page = $(this).data('page');
            $('.page-actu-pagination li.active').removeClass('active');
            $(this).addClass('active');
            let theCategory = $(this).data('current_category');
            ajaxSearch(theCategory,page);
        })

    }

    /**
     * Récupere les données de la grille
     * @param {String || id} category Catégorie de la grille
     * @param {Boolean} menuClick Changement de catégorie ou non
     */
    async function ajaxSearch(category, pagination=1) {
        let pageNumber = pagination;
        let totalPostValue = totalPosts.data('totalPosts');
        jQuery("#items_container").empty().append(await updateGridPost(pageNumber, category, totalPostValue)); 
    }

    /**
     * <a href="/category/${val.categories[0].slug}">${val.categories[0].name}</a> 
     *  
     * @param {*} pageNumber 
     * @param {*} category 
     */
    function updateGridPost(pageNumber, category,  totalPostValue) {
        return new Promise ((resolve) => {
            const url = "/wp-json/posts/all-posts?page=" + pageNumber + '&post-per-page=' + nbPostPerPage + '&category=' + category;
            jQuery.getJSON(url, function (data) {
                if(data.posts) {
                    const items = [];
                    
                    totalPostValue = data.nbCategoryPosts;
                    jQuery.each(data.posts, function (key, val) {
                        const item_string = `
                        
                        <div class="col-lg-4 col-sm-6 col-12 actu">
                            <a class="lien-actu" target='_blank' href='${val.url}'>
                                <div class="img-actu">
                                    <img src="${val.image ? val.image : " "}" class="img-responsive">
                                </div>
                                <div class="titre-actualite">
                                    ${val.title}
                                </div>
                                <div class="a-propos-actu">
                                    ${val.propos}
                                </div>
                                <br>
                                <div class="middle-bouton-golden bouton-actualite">
                                    <div class="DMGolden bouton-golden-actualite">EN SAVOIR +</div>
                                </div>
                                <br>
                            </a>
                        </div>`


                        items.push(item_string);
                    });
                    totalPosts.data('totalPosts', totalPostValue);
                    resolve(items);
                } else {
                    resolve([])
                }
            
            })
        })
    }
});