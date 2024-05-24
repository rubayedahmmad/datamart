let navbar = document.querySelector('.navbar');
let searchForm = document.querySelector('.search-form');
let cartItem = document.querySelector('.cart-items-container');
let loginFormContainer = document.querySelector('.login-form-container');
let loginForm = loginFormContainer.querySelectorAll('form')[0];
let signupForm = loginFormContainer.querySelectorAll('form')[1];
let closeButton = document.querySelector('#close-login-form');
let backButton = document.querySelector('#close-signup-form'); 

document.querySelector('#menu-btn').onclick = () => {
    navbar.classList.toggle('active');
    searchForm.classList.remove('active');
    cartItem.classList.remove('active');
    loginFormContainer.style.display = 'none';
}

document.querySelector('#search-btn').onclick = () => {
    searchForm.classList.toggle('active');
    navbar.classList.remove('active');
    cartItem.classList.remove('active');
    loginFormContainer.style.display = 'none';
}

document.querySelector('#cart-btn').onclick = () => {
    cartItem.classList.toggle('active');
    navbar.classList.remove('active');
    searchForm.classList.remove('active');
    loginFormContainer.style.display = 'none';
}

document.querySelector('#user-btn').onclick = () => {
    loginFormContainer.style.display = 'flex';
    navbar.classList.remove('active');
    searchForm.classList.remove('active');
    cartItem.classList.remove('active');
}

closeButton.onclick = () => {
    loginFormContainer.style.display = 'none';
}
backButton.onclick = () => {
    loginFormContainer.style.display = 'none';
}

window.onscroll = () => {
    navbar.classList.remove('active');
    searchForm.classList.remove('active');
    cartItem.classList.remove('active');
    loginFormContainer.style.display = 'none';
}

document.querySelector('#signup-link').onclick = (e) => {
    e.preventDefault();
    loginForm.style.display = 'none';
    signupForm.style.display = 'block';
}

document.querySelector('#login-link').onclick = (e) => {
    e.preventDefault();
    signupForm.style.display = 'none';
    loginForm.style.display = 'block';
}
