<template>
    <div class="content">
        <slider-home></slider-home>
        <service-bar/>
        <search-box/>
        <home-question/>
        <list-chosse-cate/>
        <list-port></list-port>
        <consultation-method></consultation-method>
        <front-footer-top-hidden-image></front-footer-top-hidden-image>
<!--        <front-footer></front-footer>-->
    </div>
</template>

<script>

    import ConsultationMethod from "../components/ConsultationMethod/ConsultationMethod"
    import SliderHome from "../components/slider/SliderHome"
    import ListPort from "../components/Post/ListPort"
    import FrontFooter from "../layouts/footer/footer"
    import FrontFooterTopHiddenImage from "../layouts/footer/footerTopHiddenImage"
    import ListChosseCate from "../components/box/ListChosseCate"
    import HomeQuestion from "../components/box/HomeQuestion"
    import ServiceBar from "../components/box/ServiceBar"
    import SearchBox from "../components/box/SearchBox"
export default {
    name: "Home",
    components:{
        FrontFooterTopHiddenImage,ConsultationMethod,SliderHome,ListPort,ListChosseCate,HomeQuestion,ServiceBar,SearchBox,FrontFooter
    }
}
</script>

<style scoped>

</style>
