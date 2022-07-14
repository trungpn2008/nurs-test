<template>
    <div class="content-home-page">
        <banner6></banner6>
        <div class="info-homepage">
            <b-row>
                <b-col cols="12" sm="8">
                    <column-detail></column-detail>
                </b-col>
                <b-col cols="12" sm="4">
                    <thumbnail-left></thumbnail-left>
                    <article-ranking></article-ranking>
                    <popular-keywords></popular-keywords>
                </b-col>
            </b-row>
        </div>
    </div>
</template>

<script>
import Banner6 from "../components/box/banner6"
import columnDetail from "../components/box/columnDetail"
import LastestColumn1 from "../components/box/LastestColumn1"
import ThumbnailLeft from "../components/box/ThumbnailLeft"
import ArticleRanking from "../components/box/ArticleRanking"
import PopularKeywords from "../components/box/PopularKeywords"
export default {
    name: "Home",
    components:{
        Banner6,LastestColumn1,ThumbnailLeft,ArticleRanking,PopularKeywords,columnDetail
    },
}
</script>

<style scoped>

</style>
