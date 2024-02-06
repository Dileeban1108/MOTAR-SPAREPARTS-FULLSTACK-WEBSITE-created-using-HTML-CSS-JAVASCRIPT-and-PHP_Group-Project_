
document.addEventListener('DOMContentLoaded', function() {
    var searchBar = document.getElementsByName('search-bar')[0];

    searchBar.value = '';
});



let menu=document.querySelector('#menu-bar');
let navbar=document.querySelector('.navbar');
menu.onclick = () =>{
    menu.classList.toggle('fa-times');
    navbar.classList.toggle('active');
}
window.onscroll = () =>{
    menu.classList.remove('fa-times');
    navbar.classList.remove('active');

    if(window.scrollY > 60){
        document.querySelector('#scroll-top').classList.add('active');
    }else{
        document.querySelector('#scroll-top').classList.remove('active');
    }
} 
function loader(){
    document.querySelector('.loader-container').classList.add('fade-out');
}
function fadeout(){
    setInterval(loader, 100);
}
window.onload=fadeout();








function logoutcall() {
    document.getElementById("profile").style.display = 'block';
}

function logoutcancel(){
    document.getElementById("profile").style.display = 'none';
}



// -----succes box------
document.addEventListener('DOMContentLoaded', function() {
    var successMsg = document.querySelector('.success-msg-box');
    if (successMsg) {
      successMsg.style.display = 'block';
      successMsg.style.transition = 'transform 0.5s ease-in-out'; // Add transition effect
      successMsg.style.transform = 'translateX(100%)'; // Start off-screen to the right

      setTimeout(function() {
        successMsg.style.transform = 'translateX(0)'; // Slide in from the right
      }, 0);

      setTimeout(function() {
        successMsg.style.transform = 'translateX(100%)'; // Slide out to the left
      }, 1500);
    }
});

// -----error box------
document.addEventListener('DOMContentLoaded', function() {
    var successMsg = document.querySelector('.error-msg-box');
    if (successMsg) {
      successMsg.style.display = 'block';
      successMsg.style.transition = 'transform 0.5s ease-in-out'; // Add transition effect
      successMsg.style.transform = 'translateX(100%)'; // Start off-screen to the right

      setTimeout(function() {
        successMsg.style.transform = 'translateX(0)'; // Slide in from the right
      }, 0);

      setTimeout(function() {
        successMsg.style.transform = 'translateX(100%)'; // Slide out to the left
      }, 1500);
    }
});