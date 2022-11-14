const axios = require('axios');
const { isNull } = require('lodash');

const apiKey = '4Hp3L2fnTAkWmOm1ZdH2caelj0iHxlMM';

const address = document.getElementById('address');

if (!isNull(document.getElementById('address'))) {

    const search = document.getElementById('address');
    
    search.addEventListener('input', function(){
        //e.preventDefault();
    
        const select = document.getElementById('search-results');
        select.innerHTML = '';
    
        //Regex per convertire le stringhe inserite
        let pattern = / /gi;
        let result = address.value.replace(pattern, '-');
    
        // chiamata ajax
        axios.get('https://api.tomtom.com/search/2/geocode/' + result + '.json?key=' + apiKey + '&countrySet=IT')
            .then(function (response) {
                // handle success
                let results = response.data.results;
    
                results.forEach(result => {
                    //creazione della option
                    let option = document.createElement('option');
    
                    //aggiunta classe results
                    const optionAtt = document.createAttribute("class");
                    optionAtt.value = "results";
                    
                    //aggiunta value delle option
                    const optionValue = document.createAttribute("value");
                    
                    // attribuzione dei valori ai campi option
                    option.setAttributeNode(optionAtt);
                    option.setAttributeNode(optionValue);
                    
                    //inserimento dell'address come testo delle option
                    option.text = result.address.freeformAddress;
    
                    //inserimento dell'address come value delle option
                    optionValue.value = result.address.freeformAddress;
                    
                    select.append(option);
                });
            })
            .catch(function (error) {
                // handle error
                console.log(error);
        })
    });
}