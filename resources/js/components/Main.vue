<template>
    <main>
        <router-view></router-view>
    </main>
</template>

<script>
export default {
    name: 'MainPost',
}
</script>

<style lang='scss' scoped>

@import '../../sass/variables.scss';

main{
    background-color: $bg-main;
}



</style>