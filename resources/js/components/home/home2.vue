<template>
        <front-footer-top></front-footer-top>
</template>
<script>
    import FrontHeader from "../../layouts/header"
    import FrontBody from "../../layouts/body"
    import FrontFooter from "../../layouts/footer/footer"
    import FrontFooterTop from "../../layouts/footer/footerTop"
    import FrontFooterTopHiddenImage from "../../layouts/footer/footerTopHiddenImage"
export default {
    name: "Home2",
    components:{
        FrontHeader,FrontFooter,FrontFooterTop,FrontFooterTopHiddenImage,FrontBody
    }
}
</script>

<style scoped>

</style>
