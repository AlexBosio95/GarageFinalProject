const { isNull } = require("lodash");

const email_regexp = /^([a-zA-Z0-9.-])+@(([a-zA-Z0-9-]{2,})+.)+([a-zA-Z0-9]{2,})+$/;
const nameRegExp = /^[a-zA-Zàèìòù/ /gi]*$/;


if (!isNull(document.getElementById('register-form'))) {
    const registerForm = document.getElementById('register-form');
    
    registerForm.addEventListener('submit', function() {
        Validation('name', nameRegExp);
        Validation('surname', nameRegExp);
        Validation('email', email_regexp);
    });

}

if (!isNull(document.getElementById('edit-form'))) {
    const editForm = document.getElementById('edit-form');

    editForm.addEventListener('submit', function () {
        Validation('GarageTitle', nameRegExp);
    });
}

if (!isNull(document.getElementById('login-form'))) {
    const loginForm = document.getElementById('login-form');

    loginForm.addEventListener('submit', function () {
        Validation('GarageTitle', nameRegExp);
    });
}

// Validation functions
function isValidCharacter(txtTitle, regExp) {
    let title = document.getElementById(txtTitle);

    if (!regExp.test(title.value)) {
        title.value = '';
        return false;
    } else {
        return true;
    }
}

function Validation(userValue, regExp){
    let txtTitles = document.getElementById(userValue);

    if (isValidCharacter(txtTitles.id, regExp) == false) {
        alert("Please enter valid" + " " + userValue + " " + "No special character allowed.");
        return false;
    }
}