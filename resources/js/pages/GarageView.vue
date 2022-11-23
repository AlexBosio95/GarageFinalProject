<template>
<div class="bg">
    <div class="container mt-4">
        <div class="row" v-if="garage">
            <div class="col-12 col-md-6">
                <div class="card-info">
                    <img :src="garage.image" class="card-img" :alt="garage.title">
                    <h5 class="card-title">{{garage.title}}</h5>
                    <div class="main-card">

                        <!-- Riga con address -->
                        <div class="row align-items-center">
                            <div class="col-12 col-md-3">
                                <div>
                                    <i class="fa-solid fa-location-dot icon"></i>
                                    <span class="card-text tag-icon">Address</span>
                                </div>
                            </div>
                            <div class="col-12 col-md-9 mar-sm">
                                <div class="container-text">
                                    <p class="card-text">Address: {{garage.address}}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Riga con length e height -->
                        <div class="row mt-4 align-items-center">
                            <div class="col-6 col-md-3">
                                <div class="d-flex align-items-center">
                                    <i class="fa-solid fa-ruler-horizontal icon"></i>
                                    <span class="card-text tag-icon">Length</span>
                                </div>
                            </div>
                            <div class="col-6 col-md-3">
                                <div class="container-text">
                                    <p class="card-text">{{garage.length}}</p>
                                </div>
                            </div>
                            <div class="col-6 col-md-3 mar-sm">
                                <div class="d-flex align-items-center">
                                    <i class="fa-solid fa-ruler-combined icon"></i>
                                    <span class="card-text tag-icon">Height</span>
                                </div>
                            </div>
                            <div class="col-6 col-md-3 mar-sm">
                                <div class="container-text">
                                    <p class="card-text">{{(!isHeight) ? '-' : garage.height}}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Riga con parking e width -->
                        <div class="row mt-4 align-items-center">
                            <div class="col-6 col-md-3">
                                <div class="d-flex align-items-center">
                                    <i class="fa-solid fa-ruler-vertical icon"></i>
                                    <span class="card-text tag-icon">width</span>
                                </div>
                            </div>
                            <div class="col-6 col-md-3">
                                <div class="container-text">
                                    <p class="card-text">{{garage.width}}</p>
                                </div>
                            </div>
                            <div class="col-6 col-md-3 mar-sm">
                                <div class="d-flex align-items-center">
                                    <i class="fa-solid fa-square-parking icon"></i>
                                    <span class="card-text tag-icon">Parking</span>
                                </div>
                            </div>
                            <div class="col-6 col-md-3 mar-sm">
                                <div class="container-text">
                                    <p class="card-text">{{garage.n_parking}}</p>
                                </div>
                            </div>
                        </div>

                        <p class="card-text mt-4">Description: {{garage.description}}</p>

                    </div>
                </div>
                <div class="service-container mb-4 d-flex flex-wrap">
                    <span class="services" v-for="(service) in garage.services" :key="service.id">{{service.name}}</span>
                    <span v-if="!service" class="services">No service</span>
                </div>
            </div>

            <div class="col-12 col-md-6">
                <div class="card-map">
                    <div class="position-relative">
                        <img class="img-map" :src="imageMap" :alt="garage.title" srcset="">
                        <i class="fa-solid fa-location-dot icon-gps"></i>
                    </div>

                    <div class="container-send-msg">
                        <router-link class="messages-link btn" :to="{name: message.routeLink, params: {id: garage.id}}">
                            Send a message to the owner
                        </router-link>
                    </div>

                </div>
            </div>
        </div>
        <div v-else class="d-flex justify-content-center">
            <div v-if="(error == '')" class="spinner-grow text-warning" role="status">
                <span class="sr-only">Loading...</span>
            </div>
            <div v-else>
                <h1 class="text-center title">{{error}}</h1>
            </div>
        </div>
        <div class="my-3">
            <router-link class="btn-back" :to="{name: 'home'}"> Back</router-link>
        </div>
    </div>
</div>

</template>

<script>

export default {
    name: 'GarageView',

    data: function(){
        return{
            garage: null,
            addressGarage: [],
            imageMap: '',
            isHeight: false,
            service: false,
            error: '',
            message: {
                title: 'Messages',
                routeLink : 'messages'
            },
        }
    },

    methods: {
        getViewGarage(){
            const slug = this.$route.params.slug;

            axios.get('/api/garage/' + slug)
                .then((response) => {
                    this.garage = response.data.results;
                    console.log(this.garage);

                    this.imageMap = 'https://api.tomtom.com/map/1/staticimage?key=4Hp3L2fnTAkWmOm1ZdH2caelj0iHxlMM&zoom=13&center=' + this.garage.longitude + ',' + this.garage.latitude +'&format=jpg&layer=basic&style=main&width=1305&height=748&view=Unified&language=it-IT';

                    if (this.garage.services.length == 0) {
                        this.service = false
                    } else {
                        this.service = true
                    }

                    if (this.garage.height) {
                        this.isHeight = true
                    }

                    
            }).catch(function (error){
                console.log(error);
            })
        },

        timerNoGarage(){
            if (this.post == null) {
                setTimeout(() =>{
                    this.error = 'Garage not exist'
                }, 2000)
            }
        }
    },
    mounted() {
        this.getViewGarage();
        this.timerNoGarage();
    }

}
</script>

<style lang='scss' scoped>

@import '../../sass/variables.scss';

.bg{
    background-color: $bg-main;
}

.card-map{
    border-radius: .5rem;

    .img-map{
        width: 100%;
        height: 480px;
        object-fit: cover;
        object-position: center;
        border-radius: .5rem;
    }

    .container-send-msg{
        background-color: $bg-head;
        width: 100%;
        border-radius: .5rem;
        margin-top: 1rem;
        padding: 2rem;
        text-align: center;
    }

    .messages-link {
        color: $bg-head;
        background-color: $my-yellow;
    }

    .icon-gps{
        position: absolute;
        font-size: 2rem;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }
}



.card-info{
    border-radius: .5rem;
    padding: 1.5rem;
    background-color: $bg-head;
    height: 600px;

    .card-img{
        max-height: 200px;
        object-fit: cover;
    }

    .card-title {
        color: $my-yellow;
        margin-top: 1rem;
    }

    .card-text {
        color: $my-yellow;
    }

    .tag-icon{
        font-size: 20px;
    }

    .icon{
        color: $my-yellow;
        font-size: 1.5rem;
        margin-right: .5rem;
    }

    .container-text{
        background-color: $bg-main;
        padding: .5rem;
        border-radius: .5rem;
    }

}

.service-container{
    margin-top: 1rem;
    background-color: $bg-head;
    padding: 2rem;
    border-radius: .5rem;

    .services{
        background-color: $my-yellow;
        font-size: 1rem;
        color: $bg-head;
        padding: .5rem;
        margin-right: .8rem;
        margin-top: .8rem;
        border-radius: .5rem;
    }
}

.btn-back{
    background-color: $my-yellow;
    padding: .5rem 2rem;
    border-radius: .5rem;
    color: $bg-head;

}

.title{
    color: $my-yellow;
}


@media screen and (max-width: 600px) {

    .card-info{
        height: 700px;

        .card-text {
            font-size: .9rem;
        }

        i{
            margin-right: .5rem;
        }
    }

    .mar-sm{
        margin-top: .8rem;
    }

}

</style>