<template>
    <div class="container">
        <h1 class="text-center">HomePage</h1>
        <form>
            <div class="form-group">
                <input placeholder="Search Garages" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" v-model="searchText">
            </div>
            <button type="submit" class="btn btn-primary">Search</button>
        </form>
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <li class="page-item" :class="(currentPage == 1) ? 'disabled': '' "><a class="page-link" href="#" @click.prevent="getAllGarages(currentPage - 1)">Previous</a></li>
                <li class="page-item" :class="(currentPage == lastPage) ? 'disabled': '' "><a class="page-link" href="#" @click.prevent="getAllGarages(currentPage + 1)">Next</a></li>
            </ul>
        </nav>
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
            searchText: ''
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
                console.log(this.ArrayGarages);
            });
        },

        searchGarages(){
            axios.get('/api/garages/' + this.searchText)

        }
    },
    mounted(){
        this.getAllGarages(1);
    }
}
</script>

<style>
</style>