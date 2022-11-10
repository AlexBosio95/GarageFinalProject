let form = document.getElementById('register-form');

form.addEventListener('submit', function() {
    Validation('name')
    Validation('surname')
})








// Validation functions

function isValidCharacter(txtTitle) {   
    let title = document.getElementById(txtTitle);
    let regExp = /^[a-zA-Z]*$/

    if (!regExp.test(title.value)) {
        title.value = '';
        return false;
    } else {      
        return true;
    }
}


function Validation(userValue){
    let txtTitles = document.getElementById(userValue);

    if (isValidCharacter(txtTitles.id) == false) {
        alert("Please enter valid title. No special character allowed.");        
        return false;
    }  
}