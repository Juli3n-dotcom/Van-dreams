
$(function() {


   $(document).on('click','#account',function (){;
       $("#topbar-menu").toggleClass("show");
       $("#topbar-menu").toggleClass("hide");
       $(this).find('#ico-account').toggleClass('ion-chevron-down');
       $(this).find('#ico-account').toggleClass('ion-chevron-up');
   })
   $(document).on('click','.submenu',function (){
       $(this).find("#sub-content").toggleClass("show");
       $(this).find("#sub-content").toggleClass("hide");
       $(this).find('#icon').toggleClass('ion-chevron-right');
       $(this).find('#icon').toggleClass('ion-chevron-up');
   })
    
});


var acc = document.getElementsByClassName("accordion");
var i;

for (i = 0; i < acc.length; i++) {
  acc[i].addEventListener("click", function() {
    this.classList.toggle("actif");
    var panel = this.nextElementSibling;
    if (panel.style.maxHeight) {
      panel.style.maxHeight = null;
    } else {
      panel.style.maxHeight = panel.scrollHeight + "px";
    } 
  });
}