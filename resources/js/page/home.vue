<template>
    <div class="content-home-page">
        <banner></banner>
        <button-choose-bar></button-choose-bar>
        <banner2></banner2>
    </div>
</template>

<script>
import Banner from "../components/box/banner"
import Banner2 from "../components/box/banner2"
import ButtonChooseBar from "../components/box/ButtonChooseBar"
export default {
    name: "Home",
    components:{
        Banner,ButtonChooseBar,Banner2
    }
}
</script>

<style scoped>

</style>
