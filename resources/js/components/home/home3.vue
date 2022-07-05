<template>
    <div class="content">
        <slider-home></slider-home>
        <service-bar/>
        <search-box/>
        <home-question/>
        <list-chosse-cate/>
        <list-port></list-port>
        <question-home/>
        <question-home-image/>
        <consultation-method2></consultation-method2>
<!--        <front-footer-top-hidden-image></front-footer-top-hidden-image>-->
<!--        <front-footer-top/>-->
        <front-footer-ver2/>
    </div>
</template>

<script>

    import ConsultationMethod2 from "../../components/ConsultationMethod/ConsultationMethod2"
    import SliderHome from "../../components/slider/SliderHome"
    import ListPort from "../../components/Post/ListPort"
    import FrontFooterVer2 from "../../layouts/footer/footerver2"
    import FrontFooterTop from "../../layouts/footer/footerTop"
    import ListChosseCate from "../../components/box/ListChosseCate"
    import HomeQuestion from "../../components/box/HomeQuestion"
    import ServiceBar from "../../components/box/ServiceBar"
    import SearchBox from "../../components/box/SearchBox"
    import QuestionHomeImage from "../../components/box/QuestionHomeImage"
    import QuestionHome from "../../components/box/QuestionHome"
export default {
    name: "Home3",
    components:{
        FrontFooterTop,ConsultationMethod2,SliderHome,ListPort,ListChosseCate,HomeQuestion,ServiceBar,SearchBox,FrontFooterVer2,QuestionHomeImage,QuestionHome
    }
}
</script>

<style scoped>

</style>
