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