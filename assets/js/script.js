const nav = document.querySelector('.nav-list');

document.querySelector('.open').addEventListener('click',()=>{
   nav.classList.add('active');
});

document.querySelector('.close').addEventListener('click',()=>{
   nav.classList.remove('active');
});

var login = document.getElementById('login');
var register = document.getElementById('register');
var btn = document.getElementById('btn');


//Notification like si pas connecté
$(document).ready(function(){
   $('.noUser').click(function(){
      $('body').append('<div id="toats" class="notif alert-danger" onload="killToats()"></div>');    
         $('#toats').append('<div class="toats_headers"></div>');
            $('.toats_headers').append(' <a class="toats_die"></a>');
               $('.toats_die').append('<i class="icon ion-md-close"></i>');
               $('.toats_header').append('<h5><i class="fas fa-exclamation-circle"></i> Notification :</h5>');
            $('#toats').append('<div class="toats_core"></div> ')
               $('.toats_core').append('<p>merci de vous connecter pour liker cette annonce.</p>')
   });

});