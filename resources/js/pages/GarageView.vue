<template>
    <div class="container mt-4">
        <router-link class="btn btn-primary" :to="{name: 'home'}"> < Back</router-link>
        <div class="card mt-4">
            <img :src="garage.image" class="card-img-top max-heigth" :alt="garage.title">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <h5 class="card-title">{{garage.title}}</h5>
                        <p class="card-text">Parking = {{garage.n_parking}}</p>
                        <p class="card-text">Address = {{garage.address}}</p>
                        <p class="card-text">Length = {{garage.length}}</p>
                        <p class="card-text">Width = {{garage.width}}</p>
                        <p class="card-text">Description = {{garage.description}}</p>
                    </div>
                    <div class="col text-right">
                        <img class="img-map" :src="imageMap" :alt="garage.title" srcset="">
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
            imageMap: ''
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

.max-heigth{
    height: 280px;
    object-fit: cover;
}

.img-map{
    width: 250px;
    height: 250px;
    object-fit: cover;
    object-position: center;
    border-radius: 1rem;
}

</style>