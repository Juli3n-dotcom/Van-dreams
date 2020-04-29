$(document).ready(function(){
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
                $('#regions').append('<option value="'+region.id_region+'">'+region.name+'</option>')
            });
        });
    });
});


// $(document).ready(function(){
//     $('#country').change(function(e){
//         e.preventDefault();
//         ajax();
//     });
    
//     function ajax(){
//         var id = $('#country').val();

//         var parameters = id;
//         console.log(parameters);

//         $.post("assets/ajax/post_region.php", parameters, function(data) {
//             $('#resultat').html(data.resultat);
//         }, 'json');
//     }
// })

// document.getElementById('country').addEventListener('change', function(e){
//     e.preventDefault();
//     var data = this.value;
//     console.log(data);
//     var xhr = new XMLHttpRequest();

//     xhr.onreadystatechange = function(){
//        if(this.readyState == 4 && this.status == 200){
//            console.log(this.response);
//        }else if (this.readyState == 4){
//            alert("Une erreur est survenue..");
//        }
//     };

//     xhr.open('POST', "assets/ajax/post_region.php", true);
//     xhr.responseType = "json";
//     // xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
//     xhr.send(data);

//     return false;
// })