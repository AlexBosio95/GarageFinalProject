<template>
    <div class="container">

        <h1 class="text-center">AboutUs</h1>
        <p>        
            Garage finder è nato come progetto sviluppato da 4 jr. full stack developer a conclusione di un percorso formativo durato sei mesi nel quale abbiamo imparato a sviluppare una web app.
        </p>
        <p>
            Con questo progetto abbiamo messo alla prova le competenze sia front-end che back-end apprese durante il corso, costruendo la parte back-end con laravel e la parte front con vue-router. Grazie all’utilizzo delle api di tomtom dev siamo riusciti a localizzare i garage in una mappa. Utilizzando html css e bootstrap abbiamo ideato e creato una grafica per il nostro sito.
        </p>

        <h1 class="text-center">Team</h1>

        <div class="container-cards">

            <div class="card">
                <img src="" alt="">
                <a href="">linkedin</a>

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
}
</style>