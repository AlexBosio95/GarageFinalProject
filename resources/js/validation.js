const { isNull } = require("lodash");

const email_regexp = /^([a-zA-Z0-9.-])+@(([a-zA-Z0-9-]{2,})+.)+([a-zA-Z0-9]{2,})+$/;
const nameRegExp = /^[a-zA-Zàèìòù/ /gi]*$/;

//! modificare con alert
if (!isNull(document.getElementById('register-form'))) {
    const registerForm = document.getElementById('register-form');
    const msgWrapper = document.createElement('div');
    
    registerForm.addEventListener('submit', function() {
        Validation('name', nameRegExp, msgWrapper);
        Validation('surname', nameRegExp, msgWrapper);
        Validation('email', email_regexp, msgWrapper);
    });

}

if (!isNull(document.getElementById('edit-form'))) {
    const msgWrapper = document.createElement('div');

    title.addEventListener('keyup', function () {
        Validation('title', nameRegExp, msgWrapper);
    });
}

// Validation functions
function isValidCharacter(txtTitle, regExp) {
    let title = document.getElementById(txtTitle);

    if (!regExp.test(title.value)) {
        return false;
    } else {
        return true;
    }
}

function Validation(userValue, regExp, msgWrapper){
    let txtTitles = document.getElementById(userValue);

    if (!isValidCharacter(txtTitles.id, regExp)) {
        const message = "Please enter valid" + " " + userValue + " " + "No special character allowed.";

        msgWrapper.classList.add('alert');
        msgWrapper.classList.add('alert-danger');


        msgWrapper.innerText = message;
        txtTitles.after(msgWrapper);

        txtTitles.addEventListener('blur', function() {
            txtTitles.value = '';
        });

    } else if (isValidCharacter(txtTitles.id, regExp)) {
        msgWrapper.remove();
    }
}