<template>
    <div class="notice-holiday">
        <div class="image-banner">
            <b-img :src="imageBanner"></b-img>
        </div>
        <b-breadcrumb :items="items"></b-breadcrumb>
        <div class="list-notice-holiday">
            <b-container fluid>
                <b-row>
                    <b-col cols="12" sm="9">
                        <div class="big-item-notice-holiday">
                            <div class="time-cate">
                                <p class="time-notice-holiday">2022/05/15 18:28</p>
                                <div class="name-cate"><p>お知らせ</p></div>
                            </div>
                            <p class="title-notice-holiday">年末年始の休業のお知らせ</p>
                            <div class="image-notice-holiday">
                                <b-img :src="imageItem"></b-img>
                            </div>
                            <div class="content-notice-holiday">
                                <p>平素は格別のお引き立てを賜り、厚く御礼申し上げます。</p>
                                <p>誠に勝手ながら弊社では下記の期間を年末年始休業とさせていただきます。</p>
                            </div>
                        </div>
                    </b-col>
                    <b-col cols="12" sm="3">
                        <div class="list-item-holiday">
                            <div class="item-notice-holiday">
                                <div class="time-cate">
                                    <div class="name-cate"><p>お知らせ</p></div>
                                    <p class="time-notice-holiday">2022/05/15 18:28</p>
                                </div>
                                <div class="image-notice-holiday">
                                    <b-img :src="imageItem"></b-img>
                                </div>
                                <p class="title-notice-holiday">年末年始の休業のお知らせ</p>
                            </div>
                            <div class="item-notice-holiday">
                                <div class="time-cate">
                                    <div class="name-cate"><p>お知らせ</p></div>
                                    <p class="time-notice-holiday">2022/05/15 18:28</p>
                                </div>
                                <div class="image-notice-holiday">
                                    <b-img :src="imageItem"></b-img>
                                </div>
                                <p class="title-notice-holiday">年末年始の休業のお知らせ</p>
                            </div>
                        </div>
                    </b-col>
                </b-row>
            </b-container>
        </div>
        <b-button class="btn-back">一覧に戻る</b-button>
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
            imageBanner: "/images/frontend/image/image-notice.png",
            imageItem: "/images/frontend/image/23077744_l.png",
            items: [
                {
                    text: 'トップ',
                    href: '#'
                },
                {
                    text: '年末年始の休業のお知らせ',
                    active: true
                }
            ],
            listCategory: [
                {
                    text: "全て",
                },
                {
                    text: "お知らせ",
                },
                {
                    text: "コラム",
                },
            ],
            listNotice: [
                {
                    title: "年末年始の休業のお知らせ",
                    image: "",
                    time: "2022/05/15 18:28",
                    cate: "お知らせ",
                    href: "#"
                },
                {
                    title: "年末年始の休業のお知らせ",
                    image: "",
                    time: "2022/05/15 18:28",
                    cate: "お知らせ",
                    href: "#"
                },
                {
                    title: "年末年始の休業のお知らせ",
                    image: "",
                    time: "2022/05/15 18:28",
                    cate: "お知らせ",
                    href: "#"
                },
                {
                    title: "年末年始の休業のお知らせ",
                    image: "",
                    time: "2022/05/15 18:28",
                    cate: "お知らせ",
                    href: "#"
                },
                {
                    title: "年末年始の休業のお知らせ",
                    image: "",
                    time: "2022/05/15 18:28",
                    cate: "お知らせ",
                    href: "#"
                },
                {
                    title: "年末年始の休業のお知らせ",
                    image: "",
                    time: "2022/05/15 18:28",
                    cate: "お知らせ",
                    href: "#"
                },
                {
                    title: "年末年始の休業のお知らせ",
                    image: "",
                    time: "2022/05/15 18:28",
                    cate: "お知らせ",
                    href: "#"
                },
                {
                    title: "年末年始の休業のお知らせ",
                    image: "",
                    time: "2022/05/15 18:28",
                    cate: "お知らせ",
                    href: "#"
                },
                {
                    title: "年末年始の休業のお知らせ",
                    image: "",
                    time: "2022/05/15 18:28",
                    cate: "お知らせ",
                    href: "#"
                },
                {
                    title: "年末年始の休業のお知らせ",
                    image: "",
                    time: "2022/05/15 18:28",
                    cate: "お知らせ",
                    href: "#"
                },
                {
                    title: "年末年始の休業のお知らせ",
                    image: "",
                    time: "2022/05/15 18:28",
                    cate: "お知らせ",
                    href: "#"
                },
                {
                    title: "年末年始の休業のお知らせ",
                    image: "",
                    time: "2022/05/15 18:28",
                    cate: "お知らせ",
                    href: "#"
                },
                {
                    title: "年末年始の休業のお知らせ",
                    image: "",
                    time: "2022/05/15 18:28",
                    cate: "お知らせ",
                    href: "#"
                },
            ]
        }
    }, computed: {
        rows() {
            return this.listNotice.length
        }
    }
}
</script>

<style scoped>

</style>
