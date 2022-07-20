<template>
    <div class="content-home-page">
        <banner6></banner6>
        <qa-info-nrusing></qa-info-nrusing>
        <div class="info-homepage">
            <b-container fluid class="pd-0">
                <b-row>
                    <b-col cols="12" sm="8">
                        <lastest-column1></lastest-column1>
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
import Banner6 from "../components/box/banner6"
import QaInfoNrusing from "../components/box/QaInfoNrusing"
import LastestColumn1 from "../components/box/LastestColumn1"
import ThumbnailLeft from "../components/box/ThumbnailLeft"
import ArticleRanking from "../components/box/ArticleRanking"
import PopularKeywords from "../components/box/PopularKeywords"

export default {
    name: "Home",
    components: {
        Banner6, LastestColumn1, ThumbnailLeft, ArticleRanking, PopularKeywords, QaInfoNrusing
    },
}
</script>

<style scoped>

</style>
