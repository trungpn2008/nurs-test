<template>
    <div class="box-list-column1">
        <p class="title-box c-9cbe5a bd-c-9cbe5a">{{ title }}</p>
        <div class="list-column">
            <b-container fluid class="pd-0">
                <b-row>
                    <b-col cols="12" sm="12" class="item-list-column" c v-for="item of listColumn">
                        <div class="item-column" :items="listColumn"
                             :per-page="perPage"
                             :current-page="currentPage">
                            <b-row>
                                <b-col cols="3">
                                    <b-img :src="item.image" class="image-item"></b-img>
                                </b-col>
                                <b-col cols="9">
                                    <div class="description">
                                        <div class="content-ranking">
                                            <p class="time-article">{{ item.time }}</p>
                                            <p class="cate-article">{{ item.category }}</p>
                                        </div>
                                        <p class="title-item-column">{{ item.title }}</p>
                                        <p class="content-item-column">{{ item.content }}</p>
                                        <div class="type-of-cate">
                                            <p>
                                                <b-img src="/images/frontend/icons/53453452.png"></b-img>
                                                {{ item.cate }}
                                            </p>
                                            <p>
                                                <b-img src="/images/frontend/icons/543543623.png"></b-img>
                                                {{ item.type }}
                                            </p>
                                        </div>
                                    </div>
                                </b-col>
                            </b-row>
                        </div>
                    </b-col>
                </b-row>
            </b-container>
            <b-pagination
                v-model="currentPage"
                :total-rows="rows"
                :per-page="perPage"
                aria-controls="my-table"
            ></b-pagination>
        </div>
    </div>
</template>

<script>
export default {
    name: "LastestColumn1",
    data() {
        return {
            perPage: 3,
            currentPage: 1,
            imageMethod: "/images/frontend/image/4764533246.png",
            title: "老人ホームの種類の投稿記事一覧",
            des: "お気軽にご相談ください ",
            listColumn: [
                {
                    title: '県外の介護付き有料老人ホームに入居可能か？',
                    content: '入居可能です。都心や京都など人気のエリアに入居することができます。ただ入居には他にも条件があります…',
                    cate: '介護保険制度',
                    image: "/images/frontend/image/534347.png",
                    href: '#',
                    type: 'その他',
                    category: "老人ホームの種類について",
                    time: "2022.05.09",
                },
                {
                    title: '県外の介護付き有料老人ホームに入居可能か？',
                    content: '入居可能です。都心や京都など人気のエリアに入居することができます。ただ入居には他にも条件があります…',
                    cate: '介護保険制度',
                    image: "/images/frontend/image/767634f.png",
                    href: '#',
                    type: 'その他',
                    category: "介護付き有料老人ホーム",
                    time: "2022.05.09",
                },
                {
                    title: '県外の介護付き有料老人ホームに入居可能か？',
                    content: '入居可能です。都心や京都など人気のエリアに入居することができます。ただ入居には他にも条件があります…',
                    cate: '介護保険制度',
                    image: "/images/frontend/image/534347.png",
                    href: '#',
                    type: 'その他',
                    category: "老人ホームの種類について",
                    time: "2022.05.09",
                },
                {
                    title: '県外の介護付き有料老人ホームに入居可能か？',
                    content: '入居可能です。都心や京都など人気のエリアに入居することができます。ただ入居には他にも条件があります…',
                    cate: '介護保険制度',
                    image: "/images/frontend/image/767634f.png",
                    href: '#',
                    type: 'その他',
                    category: "介護付き有料老人ホーム",
                    time: "2022.05.09",
                },
                {
                    title: '県外の介護付き有料老人ホームに入居可能か？',
                    content: '入居可能です。都心や京都など人気のエリアに入居することができます。ただ入居には他にも条件があります…',
                    cate: '介護保険制度',
                    image: "/images/frontend/image/534347.png",
                    href: '#',
                    type: 'その他',
                    category: "老人ホームの種類について",
                    time: "2022.05.09",
                },
                {
                    title: '県外の介護付き有料老人ホームに入居可能か？',
                    content: '入居可能です。都心や京都など人気のエリアに入居することができます。ただ入居には他にも条件があります…',
                    cate: '介護保険制度',
                    image: "/images/frontend/image/767634f.png",
                    href: '#',
                    type: 'その他',
                    category: "介護付き有料老人ホーム",
                    time: "2022.05.09",
                },
                {
                    title: '県外の介護付き有料老人ホームに入居可能か？',
                    content: '入居可能です。都心や京都など人気のエリアに入居することができます。ただ入居には他にも条件があります…',
                    cate: '介護保険制度',
                    image: "/images/frontend/image/534347.png",
                    href: '#',
                    type: 'その他',
                    category: "老人ホームの種類について",
                    time: "2022.05.09",
                },
                {
                    title: '県外の介護付き有料老人ホームに入居可能か？',
                    content: '入居可能です。都心や京都など人気のエリアに入居することができます。ただ入居には他にも条件があります…',
                    cate: '介護保険制度',
                    image: "/images/frontend/image/767634f.png",
                    href: '#',
                    type: 'その他',
                    category: "介護付き有料老人ホーム",
                    time: "2022.05.09",
                },
                {
                    title: '県外の介護付き有料老人ホームに入居可能か？',
                    content: '入居可能です。都心や京都など人気のエリアに入居することができます。ただ入居には他にも条件があります…',
                    cate: '介護保険制度',
                    image: "/images/frontend/image/534347.png",
                    href: '#',
                    type: 'その他',
                    category: "老人ホームの種類について",
                    time: "2022.05.09",
                },
                {
                    title: '県外の介護付き有料老人ホームに入居可能か？',
                    content: '入居可能です。都心や京都など人気のエリアに入居することができます。ただ入居には他にも条件があります…',
                    cate: '介護保険制度',
                    image: "/images/frontend/image/767634f.png",
                    href: '#',
                    type: 'その他',
                    category: "介護付き有料老人ホーム",
                    time: "2022.05.09",
                },
                {
                    title: '県外の介護付き有料老人ホームに入居可能か？',
                    content: '入居可能です。都心や京都など人気のエリアに入居することができます。ただ入居には他にも条件があります…',
                    cate: '介護保険制度',
                    image: "/images/frontend/image/534347.png",
                    href: '#',
                    type: 'その他',
                    category: "老人ホームの種類について",
                    time: "2022.05.09",
                },
                {
                    title: '県外の介護付き有料老人ホームに入居可能か？',
                    content: '入居可能です。都心や京都など人気のエリアに入居することができます。ただ入居には他にも条件があります…',
                    cate: '介護保険制度',
                    image: "/images/frontend/image/767634f.png",
                    href: '#',
                    type: 'その他',
                    category: "介護付き有料老人ホーム",
                    time: "2022.05.09",
                },
                {
                    title: '県外の介護付き有料老人ホームに入居可能か？',
                    content: '入居可能です。都心や京都など人気のエリアに入居することができます。ただ入居には他にも条件があります…',
                    cate: '介護保険制度',
                    image: "/images/frontend/image/534347.png",
                    href: '#',
                    type: 'その他',
                    category: "老人ホームの種類について",
                    time: "2022.05.09",
                },
                {
                    title: '県外の介護付き有料老人ホームに入居可能か？',
                    content: '入居可能です。都心や京都など人気のエリアに入居することができます。ただ入居には他にも条件があります…',
                    cate: '介護保険制度',
                    image: "/images/frontend/image/767634f.png",
                    href: '#',
                    type: 'その他',
                    category: "介護付き有料老人ホーム",
                    time: "2022.05.09",
                },
            ]
        }
    }, computed: {
        rows() {
            return this.listColumn.length
        }
    }
}
</script>

<style scoped>

</style>
