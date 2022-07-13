<template>
    <div class="notice">
        <b-breadcrumb :items="items"></b-breadcrumb>
        <div class="list-notice">
            <b-row>
                <b-col cols="12" sm="1">
                    <ul>
                        <li v-for="item of listCategory">{{item.text}}</li>
                    </ul>
                </b-col>
                <b-col cols="12" sm="9" id="my-table"
                       :items="listNotice"
                       :per-page="perPage"
                       :current-page="currentPage">
                    <a :href="item.href" v-for="item of listNotice">
                        <b-row>
                            <b-col cols="12" sm="4">
                                <div class="image-notice">
                                    <b-img :src="item.image"></b-img>
                                </div>
                                <div class="content-notice">
                                    <div class="time-cate">
                                        <p class="time-notice">{{item.time}}</p>
                                        <div class="name-cate">{{item.cate}}</div>
                                    </div>
                                    <p class="title-notice">{{item.title}}</p>
                                </div>
                            </b-col>
                        </b-row>
                    </a>
                    <b-pagination
                        v-model="currentPage"
                        :total-rows="rows"
                        :per-page="perPage"
                        aria-controls="my-table"
                    ></b-pagination>
                </b-col>
            </b-row>
        </div>
    </div>
</template>

<script>
export default {
    name: "notice",
    data() {
        return {
            perPage: 3,
            currentPage: 1,
            title: "みんなの法律相談ガイドライン",
            items: [
                {
                    text: 'トップ',
                    href: '#'
                },
                {
                    text: 'お知らせ',
                    active: true
                }
            ],
            listCategory:[
                {
                    text:"全て",
                },
                {
                    text:"お知らせ",
                },
                {
                    text:"コラム",
                },
            ],
            listNotice:[
                {
                    title:"年末年始の休業のお知らせ",
                    image:"",
                    time:"2022/05/15 18:28",
                    cate:"お知らせ",
                    href:"#"
                },
                {
                    title:"年末年始の休業のお知らせ",
                    image:"",
                    time:"2022/05/15 18:28",
                    cate:"お知らせ",
                    href:"#"
                },
                {
                    title:"年末年始の休業のお知らせ",
                    image:"",
                    time:"2022/05/15 18:28",
                    cate:"お知らせ",
                    href:"#"
                },
                {
                    title:"年末年始の休業のお知らせ",
                    image:"",
                    time:"2022/05/15 18:28",
                    cate:"お知らせ",
                    href:"#"
                },
                {
                    title:"年末年始の休業のお知らせ",
                    image:"",
                    time:"2022/05/15 18:28",
                    cate:"お知らせ",
                    href:"#"
                },
                {
                    title:"年末年始の休業のお知らせ",
                    image:"",
                    time:"2022/05/15 18:28",
                    cate:"お知らせ",
                    href:"#"
                },
                {
                    title:"年末年始の休業のお知らせ",
                    image:"",
                    time:"2022/05/15 18:28",
                    cate:"お知らせ",
                    href:"#"
                },
                {
                    title:"年末年始の休業のお知らせ",
                    image:"",
                    time:"2022/05/15 18:28",
                    cate:"お知らせ",
                    href:"#"
                },
                {
                    title:"年末年始の休業のお知らせ",
                    image:"",
                    time:"2022/05/15 18:28",
                    cate:"お知らせ",
                    href:"#"
                },
                {
                    title:"年末年始の休業のお知らせ",
                    image:"",
                    time:"2022/05/15 18:28",
                    cate:"お知らせ",
                    href:"#"
                },
                {
                    title:"年末年始の休業のお知らせ",
                    image:"",
                    time:"2022/05/15 18:28",
                    cate:"お知らせ",
                    href:"#"
                },
                {
                    title:"年末年始の休業のお知らせ",
                    image:"",
                    time:"2022/05/15 18:28",
                    cate:"お知らせ",
                    href:"#"
                },
                {
                    title:"年末年始の休業のお知らせ",
                    image:"",
                    time:"2022/05/15 18:28",
                    cate:"お知らせ",
                    href:"#"
                },
            ]
        }
    },computed: {
        rows() {
            return this.listNotice.length
        }
    }
}
</script>

<style scoped>

</style>
