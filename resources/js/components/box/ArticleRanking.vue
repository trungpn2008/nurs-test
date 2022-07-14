<template>
    <div class="article-ranking">
        <p class="title-box c-EB6D8E bd-c-EB6D8E">人気記事ランキング</p>
        <div class="list-article-ranking">
            <div class="item-article-ranking" v-for="(item,index) of listArticle">
                <b-row >
                    <b-col cols="2">
                        <p class="count-article">{{index+1}}</p>
                    </b-col>
                    <b-col cols="3" class="pd-0">
                        <b-img :src="item.image" class="img-item-article"></b-img>
                    </b-col>
                    <b-col cols="7">
                        <div class="content-ranking">
                            <p class="time-article">{{item.time}}</p>
                            <p class="cate-article">{{item.category}}</p>
                            <p class="title-article">{{item.title}}</p>
                        </div>
                    </b-col>
                </b-row>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "ArticleRanking",
    data() {
        return {
            title: "",
            listArticle: [
                {
                    title: '県外の介護付き有料老人ホームに入居…',
                    category: '介護付き有料老人ホーム ',
                    image:"/images/frontend/image/534534.png",
                    href: '#',
                    time:"2022.05.09",
                },
                {
                    title: '県外の介護付き有料老人ホームに入居…',
                    category: '介護付き有料老人ホーム ',
                    image:"/images/frontend/image/534534.png",
                    href: '#',
                    time:"2022.05.09",
                },
                {
                    title: '県外の介護付き有料老人ホームに入居…',
                    category: '介護付き有料老人ホーム ',
                    image:"/images/frontend/image/534534.png",
                    href: '#',
                    time:"2022.05.09",
                },
                {
                    title: '県外の介護付き有料老人ホームに入居…',
                    category: '介護付き有料老人ホーム ',
                    image:"/images/frontend/image/534534.png",
                    href: '#',
                    time:"2022.05.09",
                },
                {
                    title: '県外の介護付き有料老人ホームに入居…',
                    category: '介護付き有料老人ホーム ',
                    image:"/images/frontend/image/534534.png",
                    href: '#',
                    time:"2022.05.09",
                },
            ]
        }
    }
}
</script>

<style scoped>

</style>
