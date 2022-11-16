<template>
    <div class="container">
        <h1 class="text-center">HomePage</h1>
        <form>
            <div class="form-group">
                <!-- 1) si scrive un luogo e viene richiamata la funzione "selectCity" -->
                <input placeholder="Insert an address to start looking for your perfect garage" type="text" class="form-control" id="search-bar" aria-describedby="emailHelp"  v-model="searchText" @input="selectCity">

                <!-- 3)riceve l'array di luoghi da searchCity e lo cicla creando le varie option, selezionando la option inserisce in selectValue l'indirizzo della località e richiama la funzione searchGarages -->
                <select id="address-suggestion" v-if="addressArray.length > 0" v-model="selectValue" @change="searchGarages(currentPage)" >
                    <option v-for="(garage, index) in addressArray" :key="index" :value="garage.address.freeformAddress" >
                        {{garage.address.freeformAddress}}
                    </option>
                </select>

            </div>
        </form>

        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <label class="input-group-text" for="inputGroupSelect01">Select Radius</label>
            </div>
            <select class="custom-select" id="inputGroupSelect01" v-model="currentRadius">
                <option selected value="20000">20 km</option>
                <option value="50000">50 km</option>
            </select>
        </div>

        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <li class="page-item" :class="(currentPage == 1) ? 'disabled': '' "><a class="page-link" href="#" @click.prevent="prevPage(currentPage)">Previous</a></li>
                <li class="page-item" :class="(lastPage == currentPage) ? 'disabled': '' "><a class="page-link" href="#" @click.prevent="nextPage(currentPage)">Next</a></li>
            </ul>
        </nav>
        <div class="row row-cols-4 mt-4" v-if="ArrayGarages.length > 0">
            <div class="col" v-for="(garage, index) in ArrayGarages" :key="index">
                <div class="card m-2">
                    <img :src="garage.image" class="card-img-top" :alt="garage.title">
                    <div class="card-body">
                        <h5 class="card-title">{{garage.title}}</h5>
                        <p class="card-text">Parking = {{garage.n_parking}}</p>
                        <p class="card-text">Address = {{garage.address}}</p>
                        <a href="#" class="btn btn-primary">View more</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>

<script>
export default {
    name: 'MainPost',
    data() {
        return{
            ArrayGarages: [''],
            currentPage: 1,
            lastPage: 1,
            searchText: '',
            currentLat: null,
            currentLong: null,
            currentRadius: 20000,
            data: [],
            ArrayRadius: [],
            addressArray: [],
            selectValue: ''
        }
    },
    methods: {
        nextPage(page){
            if(this.currentLat && this.currentLong){
                this.searchGarages(page + 1)
                this.currentPage ++
            }else{
                this.getAllGarages(page + 1)
                this.currentPage ++
            }
        },

        prevPage(page){
            if(this.currentLat && this.currentLong){
                this.searchGarages(page - 1)
                this.currentPage --
            }else{
                this.getAllGarages(page - 1)
                this.currentPage --
            }
        },

        getAllGarages(page) {
            axios.get('/api/garages', {
                params: { page: page }
            })
            .then((response) => {
                this.ArrayGarages = response.data.results.data;
                this.lastPage = response.data.results.last_page;
            });
        },


        searchGarages(page){
            // 4) ottiene da tomtom i dati(latitudine e longitudine) della località selezionata
            axios.get('https://api.tomtom.com/search/2/geocode/' + this.tomtomFormatter(this.selectValue) + '.json?storeResult=false&view=Unified&language=it-IT&key=4Hp3L2fnTAkWmOm1ZdH2caelj0iHxlMM&countrySet=IT')
            .then((response) => {
                this.data = response.data.results;
                this.currentLat = this.data[0].position.lat;
                this.currentLong = this.data[0].position.lon;

                //console.log('data',this.data, this.currentLat, this.currentLong)

                // 5) chiamata al batabase che restituisce i garages, che sono nel raggio selezionato, dalla località selezionata,
                // in base alle coordinate e al valore di inputGroupSelect01
                axios.get('/api/garages/' + this.currentRadius + '/' + this.currentLat + '/' + this.currentLong, {
                    params: { page: page }
                })
                .then(response => {
                    this.ArrayGarages = response.data.results;
                    this.currentPage = response.data.results.current_page;
                    this.currentPage = 1;
                    this.lastPage = response.config.params.page;
                    console.log(response)
                    console.log('page',this.currentPage, page, this.lastPage)
                    // console.log('min max',response.data.debug) //console.log per controllare funzionamento api coordinate
                    // console.log('final', this.ArrayGarages)
                    // console.log('last',this.lastPage)
                })
            });
        },


        selectCity(){
            //2) selectCity riceve searchtext tramite v-model e chiede a tomtom i dati sulla località digitata, riceve un array di possibili
            //chelocalità ricercate e le mette in addressArray che viene utilizzato nella select address-suggestion
            //(da correggere: cerca mettendo in primo piano le vid invece che il nome della località)
            if (this.searchText == '') {
                this.selectValue = ''
                this.addressArray = []
                this.getAllGarages(1);
            } else {
                axios.get('https://api.tomtom.com/search/2/geocode/' + this.tomtomFormatter(this.searchText) + '.json?storeResult=false&view=Unified&language=it-IT&key=4Hp3L2fnTAkWmOm1ZdH2caelj0iHxlMM&countrySet=IT')
                .then((response) => {
                    this.addressArray = response.data.results;
                });
            }
            console.log(this.addressArray)
        },


        tomtomFormatter(string){
            let pattern = / /gi;
            let result = string.replace(pattern, '-');
            return result
        }
    },

    mounted(){
        this.getAllGarages(1);
    }
}
</script>

<style>
</style>
