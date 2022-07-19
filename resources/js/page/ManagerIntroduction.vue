<template>
    <div class="content-home-page">
        <banner7></banner7>
        <div class="info-homepage">
            <b-container fluid>
                <b-row>
                    <b-col cols="12" sm="8">
                        <intro-manager></intro-manager>
                        <lastest-column3></lastest-column3>
                    </b-col>
                    <b-col cols="12" sm="4">
                        <thumbnail-left></thumbnail-left>
                        <article-ranking></article-ranking>
                        <popular-keywords></popular-keywords>
                    </b-col>
                </b-row>
            </b-container>
        </div>
    </div>
</template>

<script>
import Banner7 from "../components/box/banner7"
import IntroManager from "../components/box/IntroManager"
import LastestColumn3 from "../components/box/LastestColumn3"
import ThumbnailLeft from "../components/box/ThumbnailLeft"
import ArticleRanking from "../components/box/ArticleRanking"
import PopularKeywords from "../components/box/PopularKeywords"
export default {
    name: "Home",
    components:{
        Banner7,LastestColumn3,ThumbnailLeft,ArticleRanking,PopularKeywords,IntroManager
    },
}
</script>

<style scoped>

</style>
