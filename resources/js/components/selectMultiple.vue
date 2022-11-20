<template>
<div class="card-filter">
    <div class="card-container">
        <div class="icon">
            <i class="fa-solid fa-wifi"></i>
        </div>
        <div class="select">
            <div class="my-container">

                <div class="select-btn">
                    <span class="btn-text">Select Services</span>
                    <span class="arrow-dwn">
                        <i class="fa-solid fa-chevron-down"></i>
                    </span>
                </div>

                <ul class="list-items">
                    <li class="item" v-for="(service, index) in services" :key="index">
                        <input type="checkbox" class="checkbox" :id="service.name" :value="service.id" v-model="selectedServices" @click="$emit('push', selectedServices)">
                        <label :for="service.name" class="form-check-label">{{service.name}}</label>
                    </li>
                </ul>
            </div>

            <!-- <select class="custom-select" v-model="selectedServices" multiple touchUi: false>
                <option v-for="(service, index) in services" :key="index" :value="service.id">{{service.name}}</option>
            </select> -->
        </div>
    </div>
</div>
</template>

<script>
export default {
    props: {services: Array,},
    data(){
        return{
            selectedServices: []
        }
    },
    methods: {
        selectService(){
            const selectBtn = document.querySelector(".select-btn"),
                items = document.querySelectorAll(".item");

            selectBtn.addEventListener("click", () => {
                selectBtn.classList.toggle("open");
            });

            items.forEach(item => {
                item.addEventListener("click", () => {
                    item.classList.toggle("checked");

                    let checked = document.querySelectorAll(".checked"),
                        btnText = document.querySelector(".btn-text");

                        if(checked && checked.length > 0){
                            btnText.innerText = `${checked.length} Selected`;
                        }else{
                            btnText.innerText = "Select Language";
                        }
                });
            })

        }
    },

    mounted(){
        this.selectService();
    }

}
</script>

<style lang='scss' scoped>

@import '../../sass/variables.scss';


</style>