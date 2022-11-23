<template>
    <div class="container">

        <h1 class="text-center m-5">About<span class="my-us">Us</span></h1>
        <p>        
            Garage finder è nato come progetto sviluppato in un team composto da quattro jr. full stack developer, che a conclusione di un percorso formativo per accquisire le competenze da web developer, hanno deciso di sviluppare una web app per affito di garage a breve termine.
        </p>
        <p>
            Con questo progetto abbiamo messo alla prova le competenze sia front-end che back-end apprese durante il corso, costruendo la parte back-end con laravel e la parte front con vue-router. Grazie all’utilizzo delle api di tomtom-dev siamo riusciti a localizzare i garage su una mappa. Utilizzando html css e bootstrap abbiamo ideato e creato e costruito un interfacciagrafica per il nostro sito.
        </p>

        <h1 class="text-center">Team</h1>

        <div class="cards-container">

            <div class="my-card">
                <img class="circle" src="../../../public/img/ab_pic.jpeg" alt="alex bosio">
                <h3> Alex Bosio</h3>
                <a href="https://www.linkedin.com/in/alex-bosio-dev/">linkedin</a>
            </div>

            <div class="my-card">
                <img class="circle my-image" src="../../../public/img/lb_pic.jpeg" alt="lorenzo bertoni">
                <h3> Lorenzo Bertoni</h3>
                <a href="https://www.linkedin.com/in/lorenzo-bertoni-0a8019255/">linkedin</a>
            </div>
             <div class="my-card">
                <img class="circle" src="../../../public/img/mv_pic.jpg" alt="marco vlaerio">
                <h3> Marco Vaerio</h3>
                <a href="https://www.linkedin.com/in/marco-valerio-dev/">linkedin</a>
            </div>

            <div class="my-card">
                <img class="circle" src="../../../public/img/vc_pic.jpg" alt="valerio cani">
                <h3> Valerio Cani</h3>
                <a href="https://www.linkedin.com/in/info-valerio-cani-dev/">linkedin</a>
            </div>
            
        </div>
        
    </div>

</template>

<script>
export default {
    name: 'about-us',
}
</script>

<style lang='scss' scoped>
@import '../../sass/variables.scss';

div .container{
    color: $body-bg ;

    .my-us{
        color: $my-yellow;
    }

    .cards-container {
        display: flex;
        justify-content: space-around;
        .my-card{
            img {
                height: 150px;
                border-radius: 50%;
                margin: 1rem;
            }
            
        }
    }


        
    }

    </style>