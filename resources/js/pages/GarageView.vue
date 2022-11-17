<template>
    <div>
        Prova
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