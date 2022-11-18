<template>
    <div>
        <div class="card m-2">
            <img :src="garage.image" class="card-img-top" :alt="garage.title">
            <div class="card-body">
                <h5 class="card-title">{{garage.title}}</h5>
                <p class="card-text">Parking = {{garage.n_parking}}</p>
                <p class="card-text">Address = {{garage.address}}</p>
                <p class="card-text">Length = {{garage.length}}</p>
                <p class="card-text">Width = {{garage.width}}</p>
                <p class="card-text">Description = {{garage.description}}</p>
                <img class="w-100" :src="imageMap" alt="" srcset="">
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

                    this.imageMap = 'https://api.tomtom.com/map/1/staticimage?key=4Hp3L2fnTAkWmOm1ZdH2caelj0iHxlMM&zoom=9&center=' + this.garage.longitude + ',' + this.garage.latitude +'&format=jpg&layer=basic&style=main&width=1305&height=748&view=Unified&language=it-IT';

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

<style>

</style>