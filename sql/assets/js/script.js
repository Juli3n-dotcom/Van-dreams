const nav = document.querySelector('.nav-list');

document.querySelector('.open').addEventListener('click',()=>{
   nav.classList.add('active');
});

document.querySelector('.close').addEventListener('click',()=>{
   nav.classList.remove('active');
});

   

