
<template>
    <div>
        <Header />
        <Main />
    </div>
</template>

<script>
    import Header from '../components/Header.vue';
    import Main from '../components/Main.vue';
        export default {
            name: 'App',
            components: {
                Header, Main,
            }
        }
</script>

<style lang='scss'>

// Font
@import url('https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap');
@import url('https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap');

@import '../../sass/variables.scss';

body{
    font-family: 'Roboto', sans-serif;
    background-color: $bg-main;
    overflow-x: hidden;
}



</style>