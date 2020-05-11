const navigation = document.querySelector('.container_header_index');
const head = document.querySelector('.header_index');
const hamburger = document.querySelector('.open i');
const title = document.querySelector('.nav_title');
const lien1 = document.querySelector('.link1');
 const lien2 = document.querySelector('.link2');
 const lien3 = document.querySelector('.link3');
 const lien4 = document.querySelector('.link4');
 const lien5 = document.querySelector('.link5');
 

 window.addEventListener('scroll', () =>{
   if(window.scrollY > 100){
    navigation.classList.add('scroll');
    hamburger.classList.add('active');
    head.classList.add('scroll');
    lien1.classList.add('scroll');
    lien2.classList.add('scroll');
    lien3.classList.add('scroll');
    lien4.classList.add('scroll');   
    lien5.classList.add('scroll');
    
  
   }else{
      navigation.classList.remove('scroll');
      hamburger.classList.remove('active');
      head.classList.remove('scroll');
      lien1.classList.remove('scroll');
    lien2.classList.remove('scroll');
    lien3.classList.remove('scroll');
    lien4.classList.remove('scroll');
    lien5.classList.remove('scroll');
   }
})