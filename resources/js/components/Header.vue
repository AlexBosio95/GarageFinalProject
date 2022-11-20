<template>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light">
            <a class="navbar-brand" href="#">Garages</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li v-for="(item, index) in menu" :key="index" class="nav-item active">
                        <router-link class="nav-link" :to="{name: item.routeLink}">{{item.title}}</router-link>
                    </li>
                </ul>
            </div>
            </nav>
    </header>
</template>

<script>
export default {
    name: 'Header',
    data() {
        return {
            menu:[
                {
                    title: 'Home',
                    routeLink : 'home'
                },
                {
                    title: 'About Us',
                    routeLink : 'about-us'
                },
                {
                    title: 'Contacts',
                    routeLink : 'contacts'
                },
            ]
            
        }
    }
}
</script>

<style lang='scss' scoped>

@import '../../sass/variables.scss';

header{

    height: 10vh;
    background-color: $bg-head;

    nav{
        background-color: $bg-head;
    }
}


</style>