window.axios = require('axios');
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

const axios = require('axios');

const apiKey = 'ozgNZDzFDy0AdhocSjFCL5AnXpleMEB5';

const address = document.getElementById('address');

address.addEventListener('input', function(){
    let pattern = / /gi;
    let result = address.value.replace(pattern, '-')

    axios.get('https://api.tomtom.com/search/2/geocode/via-roma-17.json?key=' + apiKey + '&countrySet=IT')
    .then(function (response) {
        // handle success
        console.log(response.data);
        })
        .catch(function (error) {
        // handle error
        console.log(error);
    })
});


