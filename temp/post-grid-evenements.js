

jQuery(document).ready(function ($) {
    const menuItems = jQuery('.item-selector li');

    if(jQuery('#hc-event-grid-0001').length) {
        menuItems.on('click', function() {
            const boolean = jQuery(this).data('boolean');
            jQuery('.item-selector li.active').removeClass('active');
            jQuery(this).addClass('active');
            ajaxSearch(boolean);
        })
    }

    /**
     * Récupere les données de la grille
     * @param {Boolean} boolean Changement de catégorie ou non
     */
    async function ajaxSearch(boolean) {
        jQuery("#items_container").empty().append(await updateGridEvent(boolean)); 
    }

    /**
     *  
     * @param {*} boolean 
     */
    function updateGridEvent(boolean) {
        return new Promise ((resolve) => {
            const url = "/wp-json/agendaRequete/tous-evenements?boolean=" + boolean;
            jQuery.getJSON(url, function (data) {
                if(data.posts) {
                    const items = [];
                    
                    totalPostValue = data.nbCategoryPosts;
                    jQuery.each(data.posts, function (key, val) {
                        const item_string = `
                        <div class="row item-grid-agenda">
                            <div class="col-sm-1 col-12 date">
                                <div class=" jour judson70">${val.start_jour}</div>
                                <div class="mois judson33">${val.start_mois}</div>
                            </div>
                            <div class="col-sm-1 col-0"></div>
                            <div class="col-sm-4 col-12 a-propos">
                                <div class="titre judson40">${val.title}</div>
                                <div class="lieu DM-sans16">${val.lieu}</div>
                            </div>
                            <div class="col-sm-1 col-0"></div>
                            <div class="col-sm-1 col-12">
                                <div class="heure DM-sans16">${val.start_heure}</div>
                            </div>
                            <div class="col-sm-1 col-0"></div>
                            <div class="col-sm-3 col-12">
                               <div class="middle-bouton-golden"><a class="DMGolden bouton-white" href="${val.url}">RÉSERVER</a></div>
                            </div>
                        </div>
                        <div class="trait-horizontal-gris"></div>`


                        items.push(item_string);
                    });
                    resolve(items);
                } else {
                    resolve([])
                }
            
            })
        })
    }
});