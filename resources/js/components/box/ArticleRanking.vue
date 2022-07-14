<template>
    <div class="article-ranking">
        <p class="title-box">人気記事ランキング</p>
        <b-row>
            <b-col cols="1">
                <p class="count-article"></p>
            </b-col>
            <b-col cols="4">
                <b-img src=""></b-img>
            </b-col>
            <b-col cols="8">
                <div class="content-ranking">
                    <p class="time-article"></p>
                    <p class="cate-article"></p>
                    <p class="title-article"></p>
                </div>
            </b-col>
        </b-row>
    </div>
</template>

<script>
export default {
    name: "ArticleRanking"
}
</script>

<style scoped>

</style>
