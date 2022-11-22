<template>
    <header>
        <nav class="navbar">
            <div class="logo">                
                <router-link class="my-text" :to="{name: 'home'}" >
                    <img src="../../../public/img/logo.png"  alt="logo">
                </router-link>
            </div>
            <div class="admin-link">
                
                <a href="http://127.0.0.1:8000/register"><span class="route-btn">register</span></a>
                <a href="http://127.0.0.1:8000/admin"><span class="route-btn-reverse">login</span></a>
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
        display: flex;
        justify-content: space-between;

        .logo{
            img{
                height: 8vh;
            }
            .my-text{
                color: $body-bg;

                span{
                    color: $my-yellow;
                }

            }
        }

        .admin-link{

            .route-btn{
                color: $bg-main;
                font-weight: bold;
                text-decoration: none;
                height: 10px;
                margin: 5px;
                background-color: $my-yellow;
                border-radius: 3px;
                border: none;
                padding: 0.4rem 1.8rem;
                text-align: center;
            }
            .route-btn-reverse{
                font-weight: bold;
                color:$my-yellow;
                text-decoration: none;
                height: 10px;
                margin: 5px;
                background-color: $bg-main;
                border-radius: 3px;
                border: none;
                padding: 0.4rem 1.8rem;
                text-align: center;
            }

        }

    }
}


</style>