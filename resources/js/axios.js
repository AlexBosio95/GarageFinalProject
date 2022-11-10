window.axios = require('axios');
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

const axios = require('axios');

axios.get('https://api.tomtom.com/routing/1/calculateRoute/52.50931%2C13.42936%3A52.50274%2C13.43872/json?key=qBc1vqSKVnlnj1WF2hOCYudzk69sxweG'
)
.then(function (response) {
    // handle success
    console.log(response);
    })
    .catch(function (error) {
    // handle error
    console.log(error);
    })

