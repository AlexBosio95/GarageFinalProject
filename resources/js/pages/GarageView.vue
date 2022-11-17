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
        }
    },

    methods: {
        getViewGarage(){
            const slug = this.$route.params.slug;

            axios.get('/api/garage/' + slug)
                .then((response) => {
                    console.log(response);
                    this.garage = response.data.results;
                    
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