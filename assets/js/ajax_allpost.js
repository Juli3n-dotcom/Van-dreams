

$("#category, #subcat, #country, #regions, #prix_min, #prix_max").change(function(){

    var category = $('#category').val();
    var subcat = $('#subcat').val();
    var country = $('#country').val(); 
    var regions = $('#regions').val();
    var pmin = $('#prix_min').val();
    var pmax = $('#prix_max').val();
   

        var parametres = 'category='+category+'&subcat='+subcat+'&country='+country+'&regions='+regions+'&prix_min='+pmin+'&prix_max='+pmax;
        console.log(parametres);


        $.post("assets/ajax/ajax_allpost.php", parametres, function(data){

            // console.log(data); // debug
            $('#resultat').html(data.resultat);
    
        },'json');

    
    
});



