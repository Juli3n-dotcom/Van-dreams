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
      title.textContent = 'Böryunn';
   }else{
      navigation.classList.remove('scroll');
      hamburger.classList.remove('active');
      title.textContent = '';
   }
})