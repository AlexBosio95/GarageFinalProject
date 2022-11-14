const { isNull } = require("lodash");

const email_regexp = /^([a-zA-Z0-9.-])+@(([a-zA-Z0-9-]{2,})+.)+([a-zA-Z0-9]{2,})+$/;
const nameRegExp = /^[a-zA-Zàèìòù/ /gi]*$/;

if (!isNull(document.getElementById('register-form'))) {
    const msgWrapper = document.createElement('div');
    const name = document.getElementById('name');
    const surName = document.getElementById('surname');
    const email = document.getElementById('email');
    
    name.addEventListener('keyup', function() {
        Validation('name', nameRegExp, msgWrapper);
    });

    surName.addEventListener('keyup', function() {
        Validation('surname', nameRegExp, msgWrapper);
    });

    email.addEventListener('keyup', function() {
        Validation('email', email_regexp, msgWrapper);
    });

}

if (!isNull(document.getElementById('edit-form'))) {
    const msgWrapper = document.createElement('div');

    title.addEventListener('keyup', function () {
        Validation('title', nameRegExp, msgWrapper);
    });
}

if (!isNull(document.getElementById('create-form'))) {
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

function resetValue() {
    if (!isNull(document.getElementById('create-form')) || !isNull(document.getElementById('edit-form'))){
        document.getElementById('title').value = '';
    }
    
    if (!isValidCharacter('name', nameRegExp)) {
        document.getElementById('name').value = '';
    }

    if (!isValidCharacter('surname', nameRegExp)) {
        document.getElementById('surname').value = '';
    }

    if (!isValidCharacter('email', email_regexp)) {
        document.getElementById('email').value = '';
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

        txtTitles.addEventListener('blur', resetValue);

    } else if (isValidCharacter(txtTitles.id, regExp)) {
        txtTitles.removeEventListener('blur', resetValue);
        msgWrapper.remove();
    }
}