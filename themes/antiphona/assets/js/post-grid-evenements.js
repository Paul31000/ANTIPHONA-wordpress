

jQuery(document).ready(function ($) {
    const menuItems = jQuery('.item-selector li');

    if(jQuery('#hc-event-grid-0001').length) {
        menuItems.on('click', function() {
            const periode = jQuery(this).data('periode');
            jQuery('.item-selector li.active').removeClass('active');
            jQuery(this).addClass('active');
            ajaxSearch(periode);
        })
    }

    /**
     * Récupere les données de la grille
     * @param {Boolean} boolean Changement de catégorie ou non
     */
    async function ajaxSearch(periode) {
        jQuery("#items_container").empty().append(await updateGridEvent(periode)); 
    }

    /**
     *  booleen pour la recherche sur le mois en cours ou les mois suivants
     * @param {*} periode 
     */
    function updateGridEvent(periode) {
        return new Promise ((resolve) => {
            const url = "/wp-json/agendaRequete/tous-evenements?periode=" + periode;
            jQuery.getJSON(url, function (data) {
                if(data.posts) {
                    const items = [];
                    
                    totalPostValue = data.nbCategoryPosts;
                    var item_string= ``;
                    if(periode=="mois"){
                        item_string= item_string +     `<div class="golden judson30 date-agenda">` + data.date +`</div>`;
                        items.push(item_string);
                    }
                    jQuery.each(data.posts, function (key, val) {
                        item_string =  `
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
                               <div class="middle-bouton-golden"><a class="DMGolden bouton-white" href="${val.url}">EN SAVOIR +</a></div>
                            </div>
                        </div>
                        <div class="trait-horizontal-gris"></div>`;


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