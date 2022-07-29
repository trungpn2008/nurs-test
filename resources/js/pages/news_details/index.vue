<template>
    <section>
        <div class="mainimg noo" :style="{
    'background': 'url(' + imageUrl + ') center no-repeat;background-size: cover;'}">

            <p class="text">
                お知らせ
            </p>
        </div>
        <div class="main">
            <div class="content">
                <!-- ~*~*~*~*~ module start ~*~*~*~*~ -->
                <!-- {$c8_Contents} -->
                <ul class="bread">
                    <li><a href="#">
                        トップ
                    </a></li>
                    <li><a href="#">お知らせ</a></li>

                </ul>
                <div class="module">
                    <div class="news_details">
                        <div class="inner">
                            <div class="box-left">
                                <ul class="list">
                                    <li><a href="#" @click="changeTab('all')">全て</a></li>
                                    <li><a href="#" @click="changeTab('news')">お知らせ</a></li>
                                    <li><a href="#" @click="changeTab('column')">コラム</a></li>
                                </ul>
                            </div>
                            <div class="box-right">
                                <div class="info" v-for="(item, index) in news">
                                    <p class="image">
                                        <img :src="item.image" :alt="item.title">
                                    </p>
                                    <div class="text-box">
                                        <div class="bg-title">
                                            <p class="date">
                                                {{item.created_at}}
                                            </p>
                                            <p class="btn">
                                                {{item.cate_name}}
                                            </p>
                                        </div>
                                        <p class="text">
                                            {{item.title}}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <ul class="pager">
                            <li class=""><a href="#" class="link_page current">1</a></li>
                            <li><a href="#" class="link_page">2</a></li>
                            <li><a href="#" class="link_page">3</a></li>
                            <li><a href="#" class="link_next">
                                ...
                            </a></li>
                        </ul>
                    </div>
                </div>
                <div class="module">
                    <div class="index_banner break">
                        <div class="box">
                            <div class="method">
                                <div class="text-box">
                                    <p class="bg-title">
										<span>
											相談方法
										</span>
                                    </p>
                                    <p class="text">
                                        電話、zoomでのご相談は、平日の9：00～18：00の時間帯で受け付けています。<br/>
                                        掲示板、メール、LINEでのご相談は、24時間受け付ています。
                                    </p>
                                </div>

                            </div>
                            <Infor />
                        </div>
                    </div>
                </div>

                <!-- ~*~*~*~*~ module end ~*~*~*~*~ -->
            </div>
            <!-- .content -->

        </div>
    </section>
</template>

<script>
import Infor from '../../components/Infor.vue';
export default {
    components: { Infor },
    data() {
        return {
            banner: {
                image_left:null,
                title:null,
                image_right:null,
                image:null,
                intro:null,
                intro2:null,
                description:null,
                list_image:[],
            },
            news:[]
        };
    },
    methods: {
        async getbanner() {
            let { data } = await this.axios.get("api/images/detail", {
                params: { type: 5 }
                // auth: {
                //     username: "care21@greentechsolutions",
                //     password: "care21greentech@"
                // },
            });
            this.banner = data.data;
        },
        async getNewsColumn() {
            let { data } = await this.axios.get("api/news/list-news-column", {
                // auth: {
                //     username: "care21@greentechsolutions",
                //     password: "care21greentech@"
                // },
            }).catch((err) => {
                // console.log(err.response.data.code)
                // if (err.response.data.code === 401){
                this.$toast.error('Get all false!')
                //     this.$router.push("/login");
                // }
            });
            this.news=[];
            this.$toast.success('Get all success!')
            this.news = data.data.news;
        },
        async getNews() {
            let { data } = await this.axios.get("api/news/list", {
                // auth: {
                //     username: "care21@greentechsolutions",
                //     password: "care21greentech@"
                // },
            }).catch((err) => {
                // console.log(err.response.data.code)
                // if (err.response.data.code === 401){
                this.$toast.error('Get all news false!')
                //     this.$router.push("/login");
                // }
            });
            this.news=[];
            this.$toast.success('Get all news success!')
            this.news = data.data.news.data;
        },
        async getAllQuestion() {
            let { data } = await this.axios.get("api/qa/list-all", {
                // headers: {"Authorization" : `Bearer `+jwt},
                params:{
                    status:'all'
                }
                // auth: {
                //     username: "care21@greentechsolutions",
                //     password: "care21greentech@"
                // },
            }).catch((err) => {
                // console.log(err.response.data.code)
                // if (err.response.data.code === 401){
                    this.$toast.error('Get all question customer false!')
                //     this.$router.push("/login");
                // }
            });
            this.$toast.success('Get all question customer success!')
            // console.log(data.data.data)
            this.news = data.data.data;
        },
        changeTab(e){
            if(e === 'all'){
                this.getNewsColumn();
            }else if(e === 'news'){
                this.getNews();
            }else{
                this.getAllQuestion();
            }
        }
    },
    computed: {
        imageUrl() {
            return this.banner.image;
        },
    },
    async mounted() {
        await this.getbanner();
        await this.getNews();
    },
}
</script>

<style scoped>
@import '../../assets/css/new_details.css';
</style>
