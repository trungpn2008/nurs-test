<template>
    <div class="warpper">
        <front-header></front-header>
<!--        <front-footer-top></front-footer-top>-->
<!--        <front-footer-top-hidden-image></front-footer-top-hidden-image>-->
<!--        <front-body></front-body>-->
        <router-view></router-view>
        <front-footer></front-footer>
    </div>
</template>

<script>
    import FrontHeader from "../layouts/header"
    import FrontBody from "../layouts/body"
    import FrontFooter from "../layouts/footer/footer"
    import FrontFooterTop from "../layouts/footer/footerTop"
    import FrontFooterTopHiddenImage from "../layouts/footer/footerTopHiddenImage"
export default {
    name: "FrontendHome",
    components:{
        FrontHeader,FrontFooter,FrontFooterTop,FrontFooterTopHiddenImage,FrontBody
    }
}
</script>

<style scoped>

</style>
