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

    // $(function(){
    //     $(".favoris").click(function(e){
    //         e.preventDefault();
    //         var $form = $(this).closest('form');
    //         var idannonce = $form.find('input[name="idannonce"]').val();
    //         var iduser = $form.find('input[name="iduser"]').val();
    //         var parameters = 'idannonce='+idannonce+'&iduser='+iduser;
    //         console.log(parameters)
    //     $.post('assets/ajax/ajax_like.php', parameters, function(data){
    //         data = $('#resultat').html(data.resultat);
    //          },'json');
    //     });
    // });

    $(function(){
        $(".favoris").click(function(e){
            e.preventDefault();
            var $form = $(this).closest('form');
            var idannonce = $form.find('input[name="idannonce"]').val();
            var iduser = $form.find('input[name="iduser"]').val();
            var parameters = 'idannonce='+idannonce+'&iduser='+iduser;
            $.ajax({
                url:'assets/ajax/ajax_like.php',
                method : 'post',
                data: parameters,
                dataType: 'JSON',
                success: function(data){
                   retour = $('.resultat'+idannonce).html(data.resultat);
                   return retour;
                }  
            });
        });
    });

    $(function(){
        $(".removefavori").click(function(e){
            e.preventDefault();
            var $form = $(this).closest('form');
            var idSupr = $form.find('input[name="idSupr"]').val();
            var iduser = $form.find('input[name="iduser"]').val();
            var idannonce = $form.find('input[name="idannonce"]').val();
            var parameters = "idSupr="+idSupr+"&idannonce="+idannonce+'&iduser='+iduser;
            console.log(parameters)
            $.ajax({
                url:'assets/ajax/ajax_delete_like.php',
                method : 'post',
                data: parameters,
                dataType: 'JSON',
                success: function(data){
                   retour = $('.resultat'+idannonce).html(data.resultat);
                   console.log(retour)
                   return retour;
                }  
            });
        });
    });

    // $(".removefavori").click(function(e){
    //     e.preventDefault();
    //     ajax_remove();
    // });

    // function ajax_remove()
    // {
    //     var idSupr = $('#idSupr').val();
        
    //     var parameters = "idSupr="+idSupr;

    //     $.post('assets/ajax/ajax_delete_like.php', parameters, function(data){
    //         console.log(data);
    //         $('#resultat').html(data.resultat);
    //     },'json');
    // }

    
});