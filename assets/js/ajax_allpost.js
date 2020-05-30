$(document).ready(function(){
    
    /**
     * PARTIE DIVERS JAVASCRIPT
     */

    // $('#prix_min'). keydown(function (e) {
    //     if (e. keyCode == 13) {
    //         e. preventDefault();
    //     return false;
    //     }
    // });
    // $('#prix_max'). keydown(function (e) {
    //     if (e. keyCode == 13) {
    //         e. preventDefault();
    //     return false;
    //     }
    // });


    /**
     * PARTIE AJAX FILTRES
     */

    limite_annonce = 9;

    $('#bouton_voir_plus').click(function(event){
        event.preventDefault();
        limite_annonce += 9;
        ajax();
    });

    $('#category').change(function(event){
        event.preventDefault();
        ajax();
    });

    $('#subcat').change(function(event){
        event.preventDefault();
        ajax();
    });

    $('#country').change(function(event){
        event.preventDefault();
        ajax();
    });
    
    $('#regions').change(function(event){
        event.preventDefault();
        ajax();
    });

    // $('#prix_max').change(function(event){
    //     event.preventDefault();
    //     ajax();
    // });

    // $('#prix_min').change(function(event){
    //     event.preventDefault();
    //     ajax();
    // });

    // $('#ajax_tri').change(function(event){
    //     event.preventDefault();
    //     ajax();
    // });

    let ajax = function(){
        let category = $('#category').val();
        let subcat = $('#subcat').val();
        let country = $('#country').val(); 
        let regions = $('#regions').val(); 
        // let prix = $('#prix_max').val(); 
        let limite = limite_annonce;
        // let tri = $('#ajax_tri').val();
        let parameters = 'id_category='+category+'&id_sub_cat='+subcat+'&id_country='+country+'&id_region='+regions+'&limite='+limite_annonce;
        console.log(parameters);
        $.post('assets/ajax/ajax_allpost.php', parameters, function(data){
            console.log(data.resultat);
            $('#resultat').html(data.resultat);
        }, 'json');
    }
});


