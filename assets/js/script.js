const nav = document.querySelector('.nav-list');
const navigation = document.querySelector('.nav_container');
const hamburger = document.querySelector('.open i');
const title = document.querySelector('.nav_title');

 document.querySelector('.open').addEventListener('click',()=>{
    nav.classList.add('active');
 });

 document.querySelector('.close').addEventListener('click',()=>{
    nav.classList.remove('active');
 });

 window.addEventListener('scroll', () =>{
   if(window.scrollY > 150){
      navigation.classList.add('scroll');
      hamburger.classList.add('active');
   }else{
      navigation.classList.remove('scroll');
      hamburger.classList.remove('active');
   }
})

$(function()
{
   function timeChecker()
      {
        setInterval(function(){
         var storedTimeStamp = sessionStorage.getItem("lastTimeStamp");
         timeCompare(storedTimeStamp);
        },3000);
      }

      function timeCompare(timeString){
         var currentTime   = new Date();
         var pastTime      = new Date(timeString);
         var timeDiff      = currentTime - pastTime;
         var minPast       = Math.floor( (timeDiff/60000) );

         if (minPast > 5){
            sessionStorage.removeItem('lastTimeStamp');
            window.location = "logout.php";
            return false
         }
         
      }
   
   $(document).mousemove(function(){
      var timeStamp = new Date();
      sessionStorage.setItem('lastTimeStamp',timeStamp);
   });

   timeChecker()
});
