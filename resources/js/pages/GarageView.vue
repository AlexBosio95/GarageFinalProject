<template>
<div class="bg">
    <div class="container mt-4">
        <router-link class="btn btn-primary" :to="{name: 'home'}"> < Back</router-link>
        <div class="card mt-4">
            <img :src="garage.image" class="card-img-top max-heigth" :alt="garage.title">
            <div class="card-body my-card">
                <div class="row">
                    <div class="col">
                        <h5 class="card-title">
                            Title: {{garage.title}}
                        </h5>
                        <div class="card-body">
                            <p class="card-text">Parking number: {{garage.n_parking}}</p>
                            <p class="card-text">Address: {{garage.address}}</p>

                            <p class="card-text">Length: {{garage.length}}</p>
                            <p class="card-text">Width: {{garage.width}}</p>
                            <p class="card-text">Square meters: {{garage.sqmt}}</p>
                            <p class="card-text">Description: {{garage.description}}</p>
                            <router-link class="messages-link btn" :to="{name: message.routeLink, params: {id: garage.id}}">
                                Send a message to the owner
                            </router-link>
                        </div>
                    </div>
                    <div class="col text-right">
                        <img class="img-map" :src="imageMap" :alt="garage.title" srcset="">
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

.max-heigth{
    height: 350px;
    object-fit: cover;
}

.img-map{
    width: 250px;
    height: 250px;
    object-fit: cover;
    object-position: center;
    border-radius: 1rem;
}

.my-card {
    background-color: $black;
    .card-title {
        color: $my-yellow;
    }

    .card-text {
        color: $my-yellow-s;
    }

    .messages-link {
        color: $black;
        background-color: $my-yellow;
    }
}

</style>