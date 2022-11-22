<template>
<div class="bg">
    <div class="container mt-4">
        <router-link class="btn btn-primary" :to="{name: 'home'}"> Back</router-link>
        
        <div class="row">
            <div class="col">
                <div class="card-info">
                    <img :src="garage.image" class="card-img" :alt="garage.title">
                    <h5 class="card-title">
                        Title: {{garage.title}}
                    </h5>
                    <div class="main-card">

                        <!-- Riga con address -->
                        <div class="row align-items-center">
                            <div class="col-3">
                                <div>
                                    <i class="fa-solid fa-location-dot icon"></i>
                                    <span class="card-text tag-icon">Address</span>
                                </div>
                            </div>
                            <div class="col-9">
                                <div class="container-text">
                                    <p class="card-text">Address: {{garage.address}}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Riga con length e height -->
                        <div class="row mt-4">
                            <div class="col">
                                <div>
                                    <i class="fa-solid fa-ruler-horizontal icon"></i>
                                    <span class="card-text tag-icon">Length</span>
                                </div>
                            </div>
                            <div class="col">
                                <div class="container-text">
                                    <p class="card-text">{{garage.length}}</p>
                                </div>
                            </div>
                            <div class="col">
                                <div>
                                    <i class="fa-solid fa-ruler-combined icon"></i>
                                    <span class="card-text tag-icon">Height</span>
                                </div>
                            </div>
                            <div class="col">
                                <div class="container-text">
                                    <p class="card-text">{{garage.height}}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Riga con parking e width -->
                        <div class="row mt-4">
                            <div class="col">
                                <div>
                                    <i class="fa-solid fa-ruler-vertical icon"></i>
                                    <span class="card-text tag-icon">width</span>
                                </div>
                            </div>
                            <div class="col">
                                <div class="container-text">
                                    <p class="card-text">{{garage.width}}</p>
                                </div>
                            </div>
                            <div class="col">
                                <div>
                                    <i class="fa-solid fa-square-parking icon"></i>
                                    <span class="card-text tag-icon">Parking</span>
                                </div>
                            </div>
                            <div class="col">
                                <div class="container-text">
                                    <p class="card-text">{{garage.n_parking}}</p>
                                </div>
                            </div>
                        </div>

                        <p class="card-text mt-4">Description: {{garage.description}}</p>

                    </div>
                </div>
            </div>

            <div class="col">
                <div class="card-map">
                    <img class="img-map" :src="imageMap" :alt="garage.title" srcset="">

                    <div class="container-send-msg">
                        <router-link class="messages-link btn" :to="{name: message.routeLink, params: {id: garage.id}}">
                            Send a message to the owner
                        </router-link>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

</template>

<script>

export default {
    name: 'GarageView',

    data: function(){
        return{
            garage: '',
            addressGarage: [],
            imageMap: '',
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

                    console.log(this.imageMap);
                    
            }).catch(function (error){
                console.log(error);
            })
        }
    },
    mounted() {
        this.getViewGarage();
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
        color: $my-yellow-s;
    }

    .tag-icon{
        font-size: 20px;
    }

    .icon{
        color: $my-yellow;
        font-size: 1.5rem;
    }

    .container-text{
        background-color: $bg-main;
        padding: .5rem;
        border-radius: .5rem;
    }
}

</style>