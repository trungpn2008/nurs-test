<template>
    <div class="box-list-column">
        <p class="title-box c-4e8dc3 bd-c-4e8dc3">{{ title }}</p>
        <div class="list-column">
            <b-container fluid class="pd-0">
                <b-row>
                    <b-col cols="6" sm="6" class="item-list-column" v-for="(item,index) of listColumn" :key="index">
                        <b-img :src="item.image" class="image-item"></b-img>
                        <div class="description">
                            <div class="type-of-cate">
                                <p>
                                    <b-img src="/images/frontend/icons/53453452.png"></b-img>
                                    {{ item.cate_name }}
                                </p>
                                <p>
                                    <b-img src="/images/frontend/icons/543543623.png"></b-img>
                                    {{ item.cate_type_title }}
                                </p>
                            </div>
                            <p class="title-item-column">{{ item.title }}</p>
                        </div>
                    </b-col>
                </b-row>
            </b-container>
            <b-button class="btn-show-more">さらに表示する</b-button>
        </div>
    </div>
</template>

<script>
import axios from 'axios'
export default {
    name: "LastestColumn",
    data() {
        return {
            imageMethod: "/images/frontend/image/4764533246.png",
            title: "最新コラム",
            des: "お気軽にご相談ください ",
            listColumn: null,
            errors:[]
        }
    },
    mounted () {
        axios.get(`/api/news/list`)
            .then(response => {
                this.listColumn = response.data.data.news.data
            })
            .catch(e => {
                this.errors.push(e)
            })
    }
}
</script>

<style scoped>

</style>
