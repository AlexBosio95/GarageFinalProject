<template>
    <div class="container">
        <h1 class="text-center mb-4">HomePage</h1>

        <!-- Header navigation -->

        <!-- Select City or address -->
        <form class="pb-4">
            <div class="form-group">
                <div class="row">
                    <div class="col">
                        <input placeholder="Insert an address to start looking for your perfect garage" type="text" class="form-control" id="search-bar" aria-describedby="emailHelp"  v-model="searchText" @input="selectCity">
                    </div>
                    <div class="col">
                        <div class="input-group mb-3" >
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="inputGroupSelect01">Select City</label>
                            </div>
                            <select class="custom-select" id="address-suggestion"  v-model="selectValue">
                                <option v-for="(garage, index) in addressArray" :key="index" :value="garage.address.freeformAddress" >
                                    {{garage.address.freeformAddress}}
                                </option>
                            </select>   
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <!-- Filter selection -->

        <h6>Filter Selection</h6>
        <div class="row">
            <div class="col">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="inputGroupSelect01">Select Radius</label>
                    </div>
                    <select class="custom-select" v-model="currentRadius">
                        <option v-for="(option, index) in dataRadius.options" :key="index" :value="option.value">{{option.text}}</option>
                    </select>
                </div>
            </div>

            <div class="col">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="inputGroupSelect01">Parking Number</label>
                    </div>

                    <select class="custom-select" v-model="currentParkingNumber">
                        <option v-for="(option, index) in ParkingNumber.options" :key="index" :value="option.value">{{option.text}}</option>
                    </select>

                </div>
            </div>

            <div class="col-12">
                <div class="mb-3">
                     <div class="form-check form-check-inline" v-for="(service, index) in services" :key="index">
                        <input type="checkbox" class="form-check-input mr-2" :id="service.name" :value="service.id" v-model="selectedServices">
                        <label :for="service.name" class="form-check-label">{{service.name}}</label>
                     </div>
                </div>
            </div>
        </div>
        
        

        

        <button class="btn btn-primary w-100" @click="searchGarages">Search</button>

        <!-- Result Garages -->

        <div class="mt-4">
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <li class="page-item" :class="(currentPage == 1) ? 'disabled': '' "><a class="page-link" href="#" @click.prevent="getAllGarages(currentPage - 1)">Previous</a></li>
                    <li class="page-item" :class="(currentPage == lastPage) ? 'disabled': '' "><a class="page-link" href="#" @click.prevent="getAllGarages(currentPage + 1)">Next</a></li>
                </ul>
            </nav>
        </div>
        <div class="row row-cols-4 mt-4">
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
            currentParkingNumber: 0,
            data: [],
            ArrayRadius: [],
            addressArray: [],
            selectValue: '',
            dataRadius: 
            {
                selected: 20000,
                options: [
                    { text: '20 km' , value: 20000},
                    { text: '50 km' , value: 50000}
                ]
            },
            ParkingNumber: 
            {
                selected: 0,
                options: [
                    { text: 'All' , value: 0},
                    { text: '1 Parking' , value: 1},
                    { text: '2 Parking' , value: 2},
                    { text: '3 Parking' , value: 3},
                    { text: '4 Parking' , value: 4},
                    { text: '5 Parking' , value: 5},
                ]
            },
            services: [],
            selectedServices: []
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

                console.log(response.data)
            });
        },
        getAllServices() {
            axios.get('/api/services')
            .then(response => {
                this.services = response.data.results;
            })
        },
        searchGarages(){


            axios.get('https://api.tomtom.com/search/2/geocode/' + this.selectValue + '.json?storeResult=false&view=Unified&key=4Hp3L2fnTAkWmOm1ZdH2caelj0iHxlMM&countrySet=IT')
            .then((response) => {
                this.data = response.data.results;                
                this.currentLat = this.data[0].position.lat;
                this.currentLong = this.data[0].position.lon;
                
                if (this.selectedServices.length == 0) {
                    this.selectedServices = 0
                }

                axios.get('/api/garages/' + this.currentRadius + '/' + this.currentLat + '/' + this.currentLong + '/' + this.currentParkingNumber + '/' + this.selectedServices)
                .then(response => {
                    this.ArrayGarages = response.data.results;
                    console.log(response.data.results)
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
        this.getAllServices();
    }
}
</script>

<style>
</style>