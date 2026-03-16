const registerBtn = document.getElementById(`registerBtn`);
const registerMenu = document.getElementById(`registerMenu`);
const password = document.getElementById(`password`);
const eyeIcon = document.getElementById(`eyeIcon`);



registerBtn.addEventListener(`click`, (e)=>{
    e.preventDefault();
    registerMenu.classList.toggle(`show`);
})
eyeIcon.addEventListener(`click`, ()=>{
    password.setAttribute(`type`, `text`);
})