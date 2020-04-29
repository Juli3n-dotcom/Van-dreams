// const nav = document.querySelector('.nav-list');
// const navigation = document.querySelector('.nav_container');
// const hamburger = document.querySelector('.open i');
// const title = document.querySelector('.nav_title');

//  document.querySelector('.open').addEventListener('click',()=>{
//     nav.classList.add('active');
//  });

//  document.querySelector('.close').addEventListener('click',()=>{
//     nav.classList.remove('active');
//  });

//  window.addEventListener('scroll', () =>{
//    if(window.scrollY > 150){
//       navigation.classList.add('scroll');
//       hamburger.classList.add('active');
//    }else{
//       navigation.classList.remove('scroll');
//       hamburger.classList.remove('active');
//    }
// })

// page login
   

  //page dépot
  var btn_depot = document.getElementById('btn_depot');
  var next1 = document.getElementById('next1');
  var depot1 = document.getElementById('depot_1');
  var btn1 = document.getElementById('infos_btn')
  var next2 = document.getElementById('next2');
  var prev1 = document.getElementById('prev1');
  var depot2 = document.getElementById('depot_2');
  var depot3 = document.getElementById('depot_3');
  var next3 = document.getElementById('next3');
  var prev2 = document.getElementById('prev2');
  var depot4 = document.getElementById('depot_4');
  var next4 = document.getElementById('next4');
  var prev3 = document.getElementById('prev3');

  //page1
  next1.addEventListener('click', function(){
     depot_1.style.left ="-400px";
     depot_2.style.left ="50px";
     btn_depot.style.width ="150px";

  })
//page 2
  prev1.addEventListener('click', function(){
   depot_1.style.left ="50px";
   depot_2.style.left ="450px";
   btn_depot.style.width ="75px";
  })

  next2.addEventListener('click', function(){
   depot_2.style.left ="-400px";
   // depot_2.style.left ="50px";
   depot_3.style.left="50px";
   btn_depot.style.width ="225px";

})
//page 3
prev2.addEventListener('click', function(){
   depot_2.style.left ="50px";
   depot_3.style.left ="450px";
   btn_depot.style.width ="150px";
  })
next3.addEventListener('click', function(){
   depot_3.style.left ="-400px";
   depot_4.style.left="50px";
   btn_depot.style.width ="300px";
})

//page 4

prev3.addEventListener('click', function(){
   depot_3.style.left ="50px";
   depot_4.style.left ="450px";
   btn_depot.style.width ="225px";
  })

  next4.addEventListener('click', function(){
   depot_4.style.left ="-400px";
   depot_5.style.left="50px";
   btn_depot.style.width ="360px";
})