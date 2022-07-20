<template>
    <div class="article-ranking">
        <p class="title-box c-EB6D8E bd-c-EB6D8E">人気記事ランキング</p>
        <div class="list-article-ranking">
            <div class="item-article-ranking" v-for="(item,index) of listArticle">
                <b-container fluid>
                    <b-row>
                        <b-col cols="2">
                            <p class="count-article">{{ index + 1 }}</p>
                        </b-col>
                        <b-col cols="3" class="pd-0">
                            <b-img :src="item.image" class="img-item-article"></b-img>
                        </b-col>
                        <b-col cols="7">
                            <div class="content-ranking">
                                <p class="time-article">{{ item.date }}</p>
                                <p class="cate-article">{{ item.cate_name }}</p>
                                <p class="title-article">{{ item.title }}</p>
                            </div>
                        </b-col>
                    </b-row>
                </b-container>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";
import moment from "moment"
import dayjs from 'dayjs';
export default {
    name: "ArticleRanking",
    data() {
        return {
            title: "",
            listArticle: [],
            errors:[]
        }
    },
    created () {
        axios.get(`/api/news/list-popular`)
            .then(response => {
                this.listArticle = response.data.data.news.data
            })
            .catch(e => {
                this.errors.push(e)
            })
    },


}
</script>

<style scoped>

</style>
