const { isNull } = require("lodash");

if (!isNull(document.getElementById('available'))) {

    let checkbox = document.getElementById('available');
    checkbox.addEventListener('click', function () {
    
        if(checkbox.checked) {
            checkbox.value = 1;
        } else {
            checkbox.value = 0;
        }
    });
}




