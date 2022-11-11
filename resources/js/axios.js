const axios = require('axios');

const apiKey = '4Hp3L2fnTAkWmOm1ZdH2caelj0iHxlMM';

const address = document.getElementById('address');
const search = document.getElementById('search-btn');

search.addEventListener('click', function(e){
    e.preventDefault();

    let pattern = / /gi;
    let result = address.value.replace(pattern, '-')

    axios.get('https://api.tomtom.com/search/2/geocode/' + result +'.json?key=' + apiKey + '&countrySet=IT')
        .then(function (response) {
            // handle success
            let results = response.data.results;

            const select = document.getElementById('search-results');

            results.forEach(result => {
                //console.log(result.address.freeformAddress);

                //creazione della option
                let option = document.createElement('option');
                const att = document.createAttribute("class");
                att.value = "results";
                option.setAttributeNode(att);
                
                //option.innerText(result.address.freeformAddress);

                select.append(option);

            });
        })
        .catch(function (error) {
            // handle error
            console.log(error);
    })
});


