<template>
    <div class="content">
        <consultation-method2></consultation-method2>
        <front-footer-top></front-footer-top>
    </div>
</template>
<script>
    import FrontHeader from "../../layouts/header"
    import FrontBody from "../../layouts/body"
    import FrontFooter from "../../layouts/footer/footer"
    import FrontFooterTop from "../../layouts/footer/footerTop"
    import FrontFooterTopHiddenImage from "../../layouts/footer/footerTopHiddenImage"
    import ConsultationMethod2 from "../../components/ConsultationMethod/ConsultationMethod2"
export default {
    name: "Home2",
    components:{
        FrontHeader,FrontFooter,FrontFooterTop,FrontFooterTopHiddenImage,FrontBody,ConsultationMethod2
    }
}
</script>

<style scoped>

</style>
