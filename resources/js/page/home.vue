<template>
    <div class="content-home-page">
        <banner></banner>
        <button-choose-bar></button-choose-bar>
        <banner2></banner2>
        <banner3></banner3>
        <banner4></banner4>
        <banner5></banner5>
        <b-row>
            <b-col cols="12" sm="9">
                <lastest-column></lastest-column>
            </b-col>
            <b-col cols="12" sm="3">
                <thumbnail-left></thumbnail-left>
            </b-col>
        </b-row>
    </div>
</template>

<script>
import Banner from "../components/box/banner"
import Banner2 from "../components/box/Banner2"
import Banner3 from "../components/box/banner3"
import Banner4 from "../components/box/banner4"
import Banner5 from "../components/box/banner5"
import LastestColumn from "../components/box/LastestColumn"
import ThumbnailLeft from "../components/box/ThumbnailLeft"
import ButtonChooseBar from "../components/box/ButtonChooseBar"
export default {
    name: "Home",
    components:{
        Banner,ButtonChooseBar,Banner2,Banner3,Banner4,Banner5,LastestColumn,ThumbnailLeft
    }
}
</script>

<style scoped>

</style>
