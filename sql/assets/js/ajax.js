$(document).ready(function(){
// all post affiner votre recherche
    $("#category, #subcat, #country, #regions, #prix_min, #prix_max").change(function(){

        var category = $('#category').val();
        var subcat = $('#subcat').val();
        var country = $('#country').val(); 
        var regions = $('#regions').val();
        var pmin = $('#prix_min').val();
        var pmax = $('#prix_max').val();
       
    
            var parametres = 'category='+category+'&subcat='+subcat+'&country='+country+'&regions='+regions+'&prix_min='+pmin+'&prix_max='+pmax;
    
    
            $.post("assets/ajax/ajax_allpost.php", parametres, function(data){
    
                // console.log(data); // debug
                $('#resultat_global').html(data.resultat);
        
            },'json');
    
        
        
    });


//country + region    
    $("#country").change(function(){
        var id = $("#country").val();
        $.ajax({
            url:'assets/ajax/post_region.php',
            method: 'post',
            data: 'id='+id
        }).done(function(regions){
            // console.log(regions);
            regions = JSON.parse(regions);
            $('#regions').empty();
            regions.forEach(function(region){
                $('#regions').append('<option value="'+region.id_region+'">'+region.name_region+'</option>')
            });
        });
    });

//like
    // $(".favoris").click(function(e){
    //     e.preventDefault();
    //     ajax_like();
    // });

    // function ajax_like()
    // {
    //     var $form = $(this).closest('form');
    //     var idannonce = $form.find('input[name="idannonce"]').val();
    //     var iduser = $form.find('input[name="iduser"]').val();
    //     // var idannonce = $('#idannonce').val();
    //     // var iduser = $('#iduser').val();

    //     var parameters = 'idannonce='+idannonce+'&iduser='+iduser;
    //     console.log(parameters)
   
        // $.post('assets/ajax/ajax_like.php', parameters, function(data){
        //     console.log(data);
        //     $('#resultat').html(data.resultat);
        // },'json');
    // }

    $(function(){
        $(".favoris").click(function(e){

            e.preventDefault();
            var $form = $(this).closest('form');
            var idannonce = $form.find('input[name="idannonce"]').val();
            var iduser = $form.find('input[name="iduser"]').val();
            var parameters = 'idannonce='+idannonce+'&iduser='+iduser;
            console.log(parameters)
        $.post('assets/ajax/ajax_like.php', parameters, function(data){
            $('#resultat').html(data.resultat);
             },'json');
        $form.hide(1100);
        });
    });


    $(".removefavori").click(function(e){
        e.preventDefault();
        ajax_remove();
    });

    function ajax_remove()
    {
        var idSupr = $('#idSupr').val();
        
        var parameters = "idSupr="+idSupr;

        $.post('assets/ajax/ajax_delete_like.php', parameters, function(data){
            console.log(data);
            $('#resultat').html(data.resultat);
        },'json');
    }

    
});