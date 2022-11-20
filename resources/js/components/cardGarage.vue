<template>
        <div class="my-card m-2">
            <div class="img-conatiner">
                <img
                :src="getImage(image)"
                class="image-card"
                :alt="title"
                >
            </div>

            <div class="main-card">
                <h5 class="title">{{textFormatted(title, 20)}}</h5>
                <p class="text-address">{{textFormatted(address, 80)}}</p>
                <div class="d-flex align-items-center">
                    <i class="fa-solid fa-square-parking icon"></i>
                    <span class="text">{{n_parking}}</span>
                </div>
            </div>

            <div class="view-btn">
                <router-link class="text-btn" :to="{name: 'garage-view', params: {slug: slug}}" >Check out the garage</router-link>
            </div>

        </div>
</template>

<script>
export default {
    props: { 
        title : String,
        image: String, 
        n_parking: Number, 
        address: String, 
        slug: String, 
        services: Array, 
        ArrayGarages: Array },

        methods: {
            getImage(image){
                if (this.ArrayGarages.length == 0) {
                    return image
                } else {
                    return 'storage/' + image
                }
            },
            textFormatted(title, cut){
                if (title.length > cut) {
                    return title.slice(1, cut) + '...'
                } else {
                    return title
                }
            }
        }
    

}
</script>

<style lang='scss' scoped>

@import '../../sass/variables.scss';

.my-card{
    width: 100%;
    border: none;
    height: 500px;

    .img-conatiner{
        min-height: 262px;
    }

    .image-card{
        width: 100%;
        border-radius: .3rem;
        object-fit: cover;
    }

    .main-card{
        color: white;
        padding: 1.5rem 0;

        .title{
            font-size: 24px;
            height: 30px;
        }

        .icon{
            font-size: 2rem;
            margin-right: .5rem;
            color: $my-yellow;
            }

        .text-address{
            height: 40px;
            overflow: scroll;
        }
    }

    .view-btn{
        background-color: $my-yellow;
        border: none;
        width: 60%;
        height: 35px;
        border-radius: .3rem;
        text-align: center;
        cursor: pointer;

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
}

</style>