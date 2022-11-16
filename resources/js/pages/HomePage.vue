<template>
    <div class="container">
        <h1 class="text-center">HomePage</h1>
        <form>
            <div class="form-group">
                <input placeholder="Insert an address to start looking for your perfect garage" type="text" class="form-control" id="search-bar" aria-describedby="emailHelp"  v-model="searchText" @input="selectCity">

                <select id="address-suggestion" v-if="addressArray.length > 0" v-model="selectValue" @change="searchGarages" >
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
            <select class="custom-select" id="inputGroupSelect01" @change="currentRadius">
                <option selected value="20000">20 km</option>
                <option value="50000">50 km</option>
            </select>
        </div>

        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <li class="page-item" :class="(currentPage == 1) ? 'disabled': '' "><a class="page-link" href="#" @click.prevent="getAllGarages(currentPage - 1)">Previous</a></li>
                <li class="page-item" :class="(currentPage == lastPage) ? 'disabled': '' "><a class="page-link" href="#" @click.prevent="getAllGarages(currentPage + 1)">Next</a></li>
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
            ArrayGarages: [],
            currentPage: 1,
            lastPage: null,
            searchText: '',
            currentLat: 0,
            currentLong: 0,
            currentRadius: 20000,
            data: [],
            ArrayRadius: [],
            addressArray: [],
            selectValue: ''
        }
    },
    methods: {
        getAllGarages(page) {
            axios.get('/api/garages', {
                params: { page: page }
            })
            .then((response) => {
                this.ArrayGarages = response.data.results.data;
                this.currentPage = response.data.results.current_page;
                this.lastPage = response.data.results.last_page;
            });
        },
        searchGarages(){

            

            axios.get('https://api.tomtom.com/search/2/geocode/' + this.selectValue + '.json?storeResult=false&view=Unified&key=4Hp3L2fnTAkWmOm1ZdH2caelj0iHxlMM&countrySet=IT')
            .then((response) => {
                this.data = response.data.results;                
                this.currentLat = this.data[0].position.lat;
                this.currentLong = this.data[0].position.lon;
                
                axios.get('/api/garages/' + this.currentRadius + '/' + this.currentLat + '/' + this.currentLong)
                .then(response => {
                    this.ArrayGarages = response.data.results;
                })
            });
        },

        selectCity(){

            if (this.searchText == '') {
                this.selectValue = ''
                this.addressArray = []
                this.getAllGarages(1);
            } else {

                axios.get('https://api.tomtom.com/search/2/geocode/' + this.searchText + '.json?storeResult=false&view=Unified&key=4Hp3L2fnTAkWmOm1ZdH2caelj0iHxlMM&countrySet=IT')
                .then((response) => {
                    this.addressArray = response.data.results;
                });
            }


            
        }
    },
    mounted(){
        this.getAllGarages(1);
    }
}
</script>

<style>
</style>