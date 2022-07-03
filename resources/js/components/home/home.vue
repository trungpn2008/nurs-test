<template>
        <front-footer-top-hidden-image></front-footer-top-hidden-image>
</template>

<script>
    import FrontHeader from "../../layouts/header"
    import Frontend from "../../layouts/frontend"
    import FrontBody from "../../layouts/body"
    import FrontFooter from "../../layouts/footer/footer"
    import FrontFooterTop from "../../layouts/footer/footerTop"
    import FrontFooterTopHiddenImage from "../../layouts/footer/footerTopHiddenImage"
export default {
    name: "Home",
    components:{
        FrontHeader,FrontFooter,FrontFooterTop,FrontFooterTopHiddenImage,FrontBody,Frontend
    }
}
</script>

<style scoped>

</style>
