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


   var login = document.getElementById('login');
   var register = document.getElementById('register');
   var btn = document.getElementById('btn');

  document.getElementById('register_btn').addEventListener('click', function(){
   login.style.left = "-400px";
   register.style.left = "50px";
   btn.style.left = "120px";
   // login.style.display="none";
   // register.style.display="block";
  })

  document.getElementById('login_btn').addEventListener('click', function(){
   login.style.left = "50px";
   register.style.left = "450px";
   btn.style.left = "0";
   // login.style.display="block";
   // register.style.display="none";
  })