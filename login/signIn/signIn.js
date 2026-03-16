const Email = document.getElementById(`Email`);
const Password = document.getElementById(`Password`);
const nameIcon = document.getElementById(`nameIcon`);
const emailIcon = document.getElementById(`emailIcon`);
const lockIcon = document.getElementById(`lockIcon`);
const eyeIcon = document.getElementById(`eyeIcon`);
const nameError = document.getElementById(`nameError`);
const emailError = document.getElementById(`emailError`);
const passwordError = document.getElementById(`passwordError`);
const signInBtn = document.getElementById(`signInBtn`);

function empty(string){
    if (string.length < 1) {
        return true;
    }else{
        return false;
    }
}

Email.addEventListener(`input`, ()=>{
    emailIcon.style.display = `none`;
})
Password.addEventListener(`input`, ()=>{
    lockIcon.style.display = `none`;
})


function validateEmail(){
emailValue = Email.value;
const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

if (!emailPattern.test(emailValue)) {
    emailError.innerHTML = `Invalid Email`;
    emailError.style.color = `Red`;
    emailError.style.fontSize = `12px`;
}else{
    emailError.innerHTML = ``
}};
Email.addEventListener(`input`, ()=>{
    validateEmail()
});

function validatePassword() {
    passwordValue = Password.value;
    const passwordPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/;
    if (passwordPattern.test(passwordValue)) {
        passwordError.innerHTML= ``;
    }else{
        passwordError.innerHTML= `password must be 8 words containing one uppercase,lowercase, numbers and symbols`;
        passwordError.style.color= `Red`;
        passwordError.style.fontSize= `10px;`;
    }
}
Password.addEventListener(`input`, ()=>{
    validatePassword();
})
eyeIcon.addEventListener(`click`, ()=>{
    Password.setAttribute(`type`, `text`);
})

signInBtn.addEventListener(`submit`, (e)=>{
    e.preventDefault();
    if (validateEmail() && validatePassword()) {
        signInBtn.submit();
    }
    return;
})