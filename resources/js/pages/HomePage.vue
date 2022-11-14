<template>
    <div class="container">

        <h1 class="text-center">HomePage</h1>
        <form>
            <div class="form-group">
                <input placeholder="Search Garages" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            <button type="submit" class="btn btn-primary">Search</button>
        </form>
        <div class="row row-cols-4">
            <div class="col" v-for="(garage, index) in ArrayGarages" :key="index">
                <div class="card" style="width: 18rem;">
                    <img :src="garage.image" class="card-img-top" :alt="garage.title">
                    <div class="card-body">
                        <h5 class="card-title">{{garage.title}}</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                        <a href="#" class="btn btn-primary">Go somewhere</a>
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
        }
    },
    methods: {
        getAllGarages(page) {
            axios.get('/api/garages', {
                params: { page: page }
            })
            .then((response) => {
                this.ArrayGarages = response.data.results.data;
                // this.currentPage = response.data.results.current_page;
                // this.lastPage = response.data.results.last_page;
                console.log(this.ArrayGarages);
            });
        }
    },
    mounted(){
        this.getAllGarages(1);
    }
}
</script>

<style>
</style>