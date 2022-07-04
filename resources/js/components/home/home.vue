<template>
    <div class="content">
        <slider-home></slider-home>
        <service-bar/>
        <home-question/>
        <list-chosse-cate/>
        <list-port></list-port>
        <consultation-method></consultation-method>
        <front-footer-top-hidden-image></front-footer-top-hidden-image>
    </div>
</template>

<script>

    import ConsultationMethod from "../../components/ConsultationMethod/ConsultationMethod"
    import SliderHome from "../../components/slider/SliderHome"
    import ListPort from "../../components/Post/ListPort"
    import FrontFooterTopHiddenImage from "../../layouts/footer/footerTopHiddenImage"
    import ListChosseCate from "../../components/box/ListChosseCate"
    import HomeQuestion from "../../components/box/HomeQuestion"
    import ServiceBar from "../../components/box/ServiceBar"
export default {
    name: "Home",
    components:{
        FrontFooterTopHiddenImage,ConsultationMethod,SliderHome,ListPort,ListChosseCate,HomeQuestion,ServiceBar
    }
}
</script>

<style scoped>

</style>
