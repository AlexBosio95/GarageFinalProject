<template>

    <div>
        <!-- Header navigation -->

        <!-- Select City or address -->
        <div class="search-container">

            <div class="container">

                <h1 class="title">Garage</h1>
                <h3 class="subtitle">The first short-term rental website for your garage</h3>

                <div class="text-center">
                    <button class="capsule-btn">
                        <router-link class="text-btn" :to="{name: 'about-us'}">About Us</router-link>
                    </button>
                </div>
                
                <div class="search-box">
                    <div class="row justify-content-center align-items-center">
                        <div class="col-12 col-md-4">
                            <div>
                                <input type="search" @click="open = false" list="mylist" placeholder="Insert an address to start looking for your perfect garage"  class="search-bar" id="search-bar" aria-describedby="emailHelp"  v-model="searchText" @input="selectCity">
                            </div>

                            <datalist id="mylist" class="data-list">
                                <option selected disabled value="">Select your address</option>
                                <option v-for="(garage, index) in addressArray" :key="index" :value="garage.address.freeformAddress" >
                                    {{garage.address.freeformAddress}}
                                </option>
                            </datalist>

                        </div>

                        <div class="col-12 col-md-2 d-flex justify-content-left">
                            <button class="search-btn" :disabled = " searchText === '' " @click="searchGarages(1)"><i class="fa-solid fa-magnifying-glass"></i></button>
                        </div>
                    </div>
                </div>


                <div v-if="alertAddress" class="alert alert-danger" role="alert">
                    {{alertAddress}}
                </div>

            </div>

        </div>

        <!-- Filter selection -->

        <div class="container filter-content">
            <div class="row justify-content-center">

                <div class="col-11 col-md-4">
                    <!-- Radius km -->
                    <div class="card-filter">
                        <div class="row h-100">
                            <div class="col-4 d-flex justify-content-center align-items-center">
                                <i class="fa-solid fa-location-dot"></i>
                            </div>
                            <div class="col-7 d-flex justify-content-center align-items-center">
                                <select class="custom-select" v-model="currentRadius">
                                    <option v-for="(option, index) in dataRadius.options" :key="index" :value="option.value">{{option.text}}</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-11 col-md-4">
                    <!-- Parking -->
                    <div class="card-filter">
                        <div class="row h-100">
                            <div class="col-4 d-flex justify-content-center align-items-center">
                                <i class="fa-solid fa-square-parking"></i>
                            </div>
                            <div class="col-7 d-flex justify-content-center align-items-center">
                                <select class="custom-select" v-model="currentParkingNumber">
                                    <option v-for="(option, index) in ParkingNumber.options" :key="index" :value="option.value">{{option.text}}</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-11 col-md-4">
                    <!-- Services -->
                    <div class="card-filter">
                        <div class="card-container">

                            <div class="icon">
                                <i class="fa-solid fa-wifi"></i>
                            </div>

                            <div class="select">
                                <div class="my-container">

                                    <div class="select-btn" :class=" (open) ? 'open' : ''" @click="open = !open">
                                        <span class="btn-text">{{servicesSelected()}}</span>
                                        <span class="arrow-dwn">
                                            <i class="fa-solid fa-chevron-down"></i>
                                        </span>
                                    </div>

                                    <ul class="list-items">
                                        <li class="item" v-for="(service, index) in services" :key="index">
                                            <input type="checkbox" class="checkbox" :id="service.name" :value="service.id" v-model="selectedServices">
                                            <label :for="service.name" class="form-check-label">{{service.name}}</label>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>


            </div>
        </div>


        <!-- Result Garages -->

        <div class="container mt-5">


            <div class="text-center" v-if="loading">
                <div class="spinner-grow text-warning" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
            </div>

            <div class="alert alert-danger" :class="{ 'd-none' : isFull }"  role="alert">
                The search has no results
            </div>

            <!-- results number garages -->
            <div v-if="ArrayGarages.length > 0" class="results-container">
                <i class="fa-solid fa-warehouse results-number mr-2"></i>
                <span class="results-number">{{ArrayGarages.length}}</span>
            </div>

            <div class="row row-cols-1 row-cols-md-3 mt-4">
                <div class="col center-card" v-for="(garage, index) in (ArrayGarages.length == 0) ? AllArrayGarages : ArrayGarages" :key="index">
                    <cardGarage
                    :ArrayGarages = 'ArrayGarages'
                    :title = 'garage.title'
                    :image = 'garage.image'
                    :n_parking = 'garage.n_parking'
                    :address = 'garage.address'
                    :slug = 'garage.slug'
                    :services = 'garage.services'
                    />
                </div>
            </div>

            <div class="mt-4">
                <nav>
                    <ul class="pagination justify-content-center">
                        <li v-if="currentPage != 1"><a class="page-btn" href="#" @click.prevent="prevPage(currentPage)"><i class="fa-solid fa-angles-left"></i></a></li>
                        <li v-if="currentPage != lastPage"><a class="page-btn" href="#" @click.prevent="nextPage(currentPage)"><i class="fa-solid fa-angles-right"></i></a></li>
                    </ul>
                </nav>
            </div>
        </div>

    </div>

</template>

<script>
import cardGarage from "../components/cardGarage.vue"

export default
    {
    components: { cardGarage },
    name: 'MainPost',
    data() {
        return{
            ArrayGarages: [],
            AllArrayGarages: [],
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
            isFull: true,
            alertAddress: null,
            dataRadius:
            {
                selected: 20000,
                options: [
                    { text: '5 km' , value: 5000},
                    { text: '10 km' , value: 10000},
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
            selectedServices: [],
            loading: true,
            open: false,
        }
    },
    methods: {

        nextPage(page){

            if(this.ArrayGarages.length > 0){
                this.searchGarages(page + 1)
                this.currentPage ++
            }else {
                this.getAllGarages(page + 1)
                this.currentPage ++
            }
        },

        prevPage(page){
            if(this.ArrayGarages.length > 0){
                this.searchGarages(page - 1)
                this.currentPage --
            }else {
                this.getAllGarages(page - 1)
                this.currentPage --
            }
        },

        getAllGarages(page) {
            axios.get('/api/garages', {
                params: { page: page }
            })
            .then((response) => {
                this.AllArrayGarages = response.data.results.data;
                this.currentPage = response.data.results.current_page;
                this.lastPage = response.data.results.last_page;
                this.loading = false;
                this.open = false;
            });
        },

        getAllServices() {
            axios.get('/api/services')
            .then(response => {
                this.services = response.data.results;
            })
        },

        searchGarages(page){
            this.ArrayGarages = [];
            this.AllArrayGarages = [];
            this.alertAddress = null;
            this.isFull = true;
            this.loading = true;
            this.currentPage = 0;
            this.lastPage = 0;
            this.open = false;

            if (this.searchText != '') {

                axios.get('https://api.tomtom.com/search/2/geocode/' + this.searchText + '.json?storeResult=false&view=Unified&key=4Hp3L2fnTAkWmOm1ZdH2caelj0iHxlMM&countrySet=IT')
                    .then((response) => {
                        this.data = response.data.results;
                        this.currentLat = this.data[0].position.lat;
                        this.currentLong = this.data[0].position.lon;

                        if (this.selectedServices.length == 0) {
                            this.selectedServices.push(0);
                        }

                        axios.get('/api/garages/' + this.currentRadius + '/' + this.currentLat + '/' + this.currentLong + '/' + this.currentParkingNumber + '/' + this.selectedServices, {
                            params: { page: page }
                            })
                            .then(response => {
                                this.ArrayGarages = response.data.results.data;
                                this.currentPage = response.data.results.current_page;
                                this.lastPage = response.data.results.last_page;

                                //console.log(response.data.results);

                                if (this.selectedServices.includes(0)) {
                                    this.selectedServices.splice(0, 1);
                                }

                                if (this.ArrayGarages.length == 0) {
                                    this.isFull = false
                                }
                                this.loading = false
                            })

                    })

                    .catch((error) => {
                        console.log(error);
                        this.loading = false
                        this.currentPage = 0
                        this.lastPage = 0
                        this.isFull = false

                    })

            } else {
                this.alertAddress = 'Address is required !';

            }

        },
        selectCity(){

            if (this.searchText == '') {
                this.selectValue = '';
                this.addressArray = [];
                this.ArrayGarages = [];
                this.isFull= true;
                this.loading = false;
                this.getAllGarages(1);
                this.open = false;
            } else {
                axios.get('https://api.tomtom.com/search/2/geocode/' + this.searchText + '.json?storeResult=false&view=Unified&key=4Hp3L2fnTAkWmOm1ZdH2caelj0iHxlMM&countrySet=IT')
                .then((response) => {
                    this.addressArray = response.data.results;

                });
            }
        },

        servicesSelected(){
            if (this.selectedServices.length == 0) {
                return 'Select Services'
            } else {
                return this.selectedServices.length + ' Selected'
            }
        }

    },
    mounted(){
        this.getAllGarages(1);
        this.getAllServices();
    }
}
</script>

<style lang='scss' scoped>

@import '../../sass/variables.scss';

.search-container{
    background-color: $bg-head;
    position: relative;
    padding-bottom: 3rem;

    .title{
        font-family: 'Inter', sans-serif;
        color: white;
        text-align: center;
        font-weight: bold;
        font-size: 48px;

        &::after {
            content: 'finder';
            color: $my-yellow;
        }
    }

    .subtitle{
        font-family: 'Inter', sans-serif;
        color: white;
        text-align: center;
        font-weight: bold;
        font-size: 20px;

    }

    .capsule-btn{
        background-color: $my-yellow;
        border-radius: 2rem;
        border: none;
        padding: 0.1rem 1.8rem;
        text-align: center;

        .text-btn{
            color: $bg-head;
            text-decoration: none;
            line-height: 30px;
            font-size: 15px;
            font-family: 'Inter', sans-serif;
            font-weight: 900;
        }

        &:hover{
            transform: scale(1.03);
            transition: .5s;
        }
    }

    .search-box{
        position: absolute;
        bottom: -1.5rem;
        left: 50%;
        transform: translate(-50%);
        width: 100%;
        background-color: transparent;

        .search-bar{
            border: none;
            width: 100%;
            border-radius: 5px;
            height: 46px;
            z-index: 1;
            width: 100%;
            padding: .8rem;
        }

        .search-btn{
            border: none;
            padding: 0 2rem;
            background-color: $my-yellow;
            border-radius: 4rem;
            height: 46px;
            cursor: pointer;

            &:hover{
                transform: scale(1.1);
                transition: .5s;
            }

            i{
                color: $bg-head;
                font-size: 1.5rem;
            }
        }

    }

}

.filter-content{
    margin-top: 4rem;
}

.area-select{
    display: flex;
    align-items: center;
    padding: 0 16px;
}

.card-filter{
    background-color: $bg-head;
    height: 65px;
    border-radius: .3rem;

    i{
        color: $my-yellow;
        font-size: 2.5rem;
    }

    .value{
        color: white;
    }

    select{
        background-color: $my-yellow;
        color: $bg-head;
        border: none;
    }

}

.results-container{
    background-color: $bg-head;
    padding: 0.5rem 1rem;
    border-radius: 0.5rem;
    width: 8%;
    text-align: center;

    .results-number{
        color: $my-yellow;
    }
}



.card-filter{
    background-color: $bg-head;
    height: 65px;
    border-radius: .3rem;

    .card-container{
        display: flex;
        height: 100%;

        .icon{
            width: 30%;
            display: flex;
            justify-content: center;
            align-items: center;

            i{
                color: $my-yellow;
                font-size: 2.5rem;
            }
        }

        .select{
            width: 70%;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 0 1rem;
        }


        .my-container{
            position: relative;
            width: 100%;

            .select-btn{
                display: flex;
                align-items: center;
                justify-content: space-between;
                padding: 0 14px;
                border-radius: 5px;
                cursor: pointer;
                background-color: $my-yellow;
                height: 35px;

                .btn-text{
                    font-size: 0.9rem;
                    color: $bg-head;
                }

                .arrow-dwn{
                    transition: 0.3s;
                    z-index: 1;

                    i{
                        color: $bg-head;
                        font-size: 1rem;
                    }
                }

                &.open .arrow-dwn{
                    transform: rotate(-180deg);
                }
            }

            .list-items{
                position: absolute;
                width: 100%;
                top: 3rem;
                border-radius: 5px;
                padding: 16px;
                background-color: $my-yellow;
                display: none;
                z-index: 1;

                .item{
                    display: flex;
                    align-items: center;
                    list-style: none;
                    height: 50px;
                    cursor: pointer;
                    transition: 0.3s;
                    padding: 0 15px;
                    border-radius: 8px;
                    position: relative;

                    label{

                        &::before{
                            font-family: "Font Awesome 5 Free";
                            content: '\f111';
                            font-size: 20px;
                            position: absolute;
                            top: 50%;
                            left: 7%;
                            transform: translate(0, - 50%);
                        }
                    }

                    .checkbox{
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        height: 16px;
                        width: 16px;
                        border-radius: 4px;
                        margin-right: 12px;
                        border: 1.5px solid $bg-head;
                        transition: all 0.3s ease-in-out;
                        opacity: 0;

                        &:checked + label::before{
                            font-family: "Font Awesome 5 Free";
                            content: '\f058';
                            font-size: 20px;
                            position: absolute;
                            top: 50%;
                            left: 7%;
                            transform: translate(0, - 50%);
                        }
                    }

                    &:hover{
                        background-color: $my-yellow-s;
                    }
                }

                .item-text{
                    font-size: 16px;
                    font-weight: 400;
                    color: #333;
                }
            }

            .select-btn.open ~ .list-items{
                display: block;
            }
        }
    }

}

.page-btn{
    background-color: $my-yellow;
    color: $bg-head;
    padding: .5rem 1rem;
    margin: .5rem;
    border-radius: .5rem;
    text-decoration: none;

    &:hover{
        color: $my-yellow;
        background-color: $bg-head;

    }
}



@media screen and (max-width: 600px) {

    .search-container{
    background-color: $bg-head;
    position: relative;
    padding-bottom: 3rem;

    

        .search-box{
            position: absolute;
            bottom: -5rem;
            width: 80%;
            
            .search-btn{
                border: none;
                padding: 0 2rem;
                background-color: $my-yellow;
                border-radius: 4rem;
                height: 46px;
                cursor: pointer;

                margin-top: 1rem;
                width: 100%;
            }
        }
    }

    .filter-content{
    margin-top: 6rem;
    }

    .card-filter{
        margin-top: .5rem;
    }

    .center-card{
        padding-left: 0;
    }

}



</style>
