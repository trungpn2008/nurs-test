<template>
    <div class="notice">
        <b-breadcrumb :items="items"></b-breadcrumb>
        <div class="list-notice">
            <b-container fluid>
                <b-row>
                    <b-col cols="12" sm="2">
                        <ul class="list-cate-notice">
                            <li v-for="item of listCategory"><a href="#">{{ item.text }}</a></li>
                        </ul>
                    </b-col>
                    <b-col cols="12" sm="8" id="my-table" class="list-item-notice"
                           :items="listNotice"
                           :per-page="perPage"
                           :current-page="currentPage">
                        <a :href="item.href" v-for="item of listNotice" class="item-link-notice">
                            <b-row>
                                <b-col cols="12" sm="4">
                                    <div class="image-notice">
                                        <b-img :src="item.image"></b-img>
                                    </div>
                                </b-col>
                                <b-col cols="12" sm="8">
                                    <div class="content-notice">
                                        <div class="time-cate">
                                            <p class="time-notice">{{ item.time }}</p>
                                            <div class="name-cate"><p>{{ item.cate }}</p></div>
                                        </div>
                                        <p class="title-notice">{{ item.title }}</p>
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
            </b-container>
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
            imageBanner: "/images/frontend/image/image-notice.png",
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
                    image: "/images/frontend/image/23077744_l.png",
                    time: "2022/05/15 18:28",
                    cate: "お知らせ",
                    href: "#"
                },
                {
                    title: "年末年始の休業のお知らせ",
                    image: "/images/frontend/image/23077744_l.png",
                    time: "2022/05/15 18:28",
                    cate: "お知らせ",
                    href: "#"
                },
                {
                    title: "年末年始の休業のお知らせ",
                    image: "/images/frontend/image/23077744_l.png",
                    time: "2022/05/15 18:28",
                    cate: "お知らせ",
                    href: "#"
                },
                {
                    title: "年末年始の休業のお知らせ",
                    image: "/images/frontend/image/23077744_l.png",
                    time: "2022/05/15 18:28",
                    cate: "お知らせ",
                    href: "#"
                },
                {
                    title: "年末年始の休業のお知らせ",
                    image: "/images/frontend/image/23077744_l.png",
                    time: "2022/05/15 18:28",
                    cate: "お知らせ",
                    href: "#"
                },
                {
                    title: "年末年始の休業のお知らせ",
                    image: "/images/frontend/image/23077744_l.png",
                    time: "2022/05/15 18:28",
                    cate: "お知らせ",
                    href: "#"
                },
                {
                    title: "年末年始の休業のお知らせ",
                    image: "/images/frontend/image/23077744_l.png",
                    time: "2022/05/15 18:28",
                    cate: "お知らせ",
                    href: "#"
                },
                {
                    title: "年末年始の休業のお知らせ",
                    image: "/images/frontend/image/23077744_l.png",
                    time: "2022/05/15 18:28",
                    cate: "お知らせ",
                    href: "#"
                },
                {
                    title: "年末年始の休業のお知らせ",
                    image: "/images/frontend/image/23077744_l.png",
                    time: "2022/05/15 18:28",
                    cate: "お知らせ",
                    href: "#"
                },
                {
                    title: "年末年始の休業のお知らせ",
                    image: "/images/frontend/image/23077744_l.png",
                    time: "2022/05/15 18:28",
                    cate: "お知らせ",
                    href: "#"
                },
                {
                    title: "年末年始の休業のお知らせ",
                    image: "/images/frontend/image/23077744_l.png",
                    time: "2022/05/15 18:28",
                    cate: "お知らせ",
                    href: "#"
                },
                {
                    title: "年末年始の休業のお知らせ",
                    image: "/images/frontend/image/23077744_l.png",
                    time: "2022/05/15 18:28",
                    cate: "お知らせ",
                    href: "#"
                },
                {
                    title: "年末年始の休業のお知らせ",
                    image: "/images/frontend/image/23077744_l.png",
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
