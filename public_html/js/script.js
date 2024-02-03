let userBox = document.querySelector('.header .flex .account-box');

document.querySelector('#user-btn').onclick = () =>{
    userBox.classList.toggle('active');
    navbar.classList.remove('active');
}

let navbar = document.querySelector('.header .flex .navbar');

document.querySelector('#menu-btn').onclick = () =>{
    navbar.classList.toggle('active');
    userBox.classList.remove('active');
}

window.onscroll = () =>{
    userBox.classList.remove('active');
    navbar.classList.remove('active');
}

var loader = document. getElementById ("loader");
window.addEventListener("load", function () {
loader. style.display
"none" ;
});


$('#toggle').click(function () {
    //check if checkbox is checked
    if ($(this).is(':checked')) {
        
        $('#sendNewSms').removeAttr('disabled'); //enable input
        
    } else {
        $('#sendNewSms').attr('disabled', true); //disable input
    }
});
