window.axios = require('axios');
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

const axios = require('axios');

const apiKey = 'qBc1vqSKVnlnj1WF2hOCYudzk69sxweG';

axios.get('https://api.tomtom.com/search/2/search/36.98844,-121.97483.json?key=' + apiKey
)
.then(function (response) {
    // handle success
    console.log(response);
    })
    .catch(function (error) {
    // handle error
    console.log(error);
    })

