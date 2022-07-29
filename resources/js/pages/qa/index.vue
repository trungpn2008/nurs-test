<template>
    <section>
        <div class="mainimg no">
            <div class="text-box">
                <ul class="bread">
                    <li><a href="#">トップ </a></li>
                    <li><a href="#">掲示板</a></li>
                    <li><a href="#">老人ホームの種類</a></li>
                </ul>

                <div class="info">
                    <div class="bg-title">
                        <p class="note"  v-html="banner4.intro"></p>
                        <p class="title">
							<span :style="{
                                        'background': 'url(' + imageicon4 + ') left center no-repeat'}">
								{{ banner4.title }}
							</span>
                        </p>
                    </div>

                    <p class="text"  v-html="banner4.intro2"></p>
                    <p class="image">
                        <img :src="banner4.image" alt="">
                    </p>
                </div>
            </div>
        </div>
        <div class="main">
            <div class="content">
                <!-- ~*~*~*~*~ module start ~*~*~*~*~ -->
                <!-- {$c8_Contents} -->
                <div class="module">
                    <div class="homes-list break">
                        <div class="box">
                            <ul class="list-btn">
                                <li v-for="(item, index) in listQaCate"><a :href="'/introduction?cate='+item.id" >{{ item.title }}</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="module">
                    <div class="homes-posted break">
                        <div class="box">
                            <div class="box-left">
                                <p class="bg-title">
                                    老人ホームの種類の投稿記事一覧

                                </p>
                                <div class="info-box">
                                    <div class="article" v-for="(item, index) in listQa">
                                        <p class="image">
                                            <img :src="item.image" alt="">
                                        </p>
                                        <div class="text-box">
                                            <div class="time">
                                                <p class="date">
                                                    {{ item.date }}
                                                </p>
                                                <p class="att">
                                                    {{ item.cate_name }}
                                                </p>
                                            </div>

                                            <p class="title">
                                                {{ item.title }}
                                            </p>
                                            <p class="text">
                                                {{ item.content }}
                                            </p>
                                            <div class="author">
                                                <p class="page">
													<span>
														{{ item.cate_name }}

													</span>
                                                </p>
                                                <p class="question">
													<span>
														{{ item.type_title }}

													</span>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <ul class="pager">
                                    <li><a href="#" class="link_before ">
                                        ...
                                    </a></li>
                                    <li class="active"><a href="#" class="link_page current">1</a></li>
                                    <li><a href="#" class="link_page">2</a></li>
                                    <li><a href="#" class="link_page">3</a></li>
                                    <li><a href="#" class="link_page">4</a></li>
                                    <li><a href="#" class="link_page">5</a></li>
                                    <li><a href="#" class="link_next">
                                        ...
                                    </a></li>
                                </ul>
                            </div>
                            <div class="box-right">
                                <category-right/>
                                <list-popular/>
                                <div class="keywords">
                                    <p class="title">
                                        人気キーワード
                                    </p>
                                    <ul class="list">
                                        <li>老人ホーム </li>
                                        <li>費　用
                                        </li>
                                        <li>訪　問</li>
                                        <li>通　所
                                        </li>
                                        <li>看　護
                                        </li>
                                        <li>リハビリ
                                        </li>
                                    </ul>

                                </div>
                            </div>
                        </div>
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
import categoryRight from "../../components/categoryRight";
import listPopular from "../../components/listPopular";
export default {
    components: { categoryRight,listPopular,Infor },
    data() {
        return {
            banner4: {
                image_left:null,
                title:null,
                image_right:null,
                image:null,
                intro:null,
                intro2:null,
                icon:null,
                description:null,
                list_image:[],
            },
            listQa: [],
            listQaCate: []
        };
    },
    methods: {
        async getbanner4() {
            let { data } = await this.axios.get("api/images/detail", {
                params: { type: 4 }
                // auth: {
                //     username: "care21@greentechsolutions",
                //     password: "care21greentech@"
                // },
            });
            this.banner4 = data.data;
        },
        async getlistQa() {
            let { data } = await this.axios.get("api/qa/list-all", {
                params: { per_page: 10,status:"all" }
                // auth: {
                //     username: "care21@greentechsolutions",
                //     password: "care21greentech@"
                // },
            });
            this.listQa = data.data.data;
        },
        async getlistQaCate() {
            let { data } = await this.axios.get("api/qa-cate/list", {
                params: { per_page: 10 }
                // auth: {
                //     username: "care21@greentechsolutions",
                //     password: "care21greentech@"
                // },
            });
            this.listQaCate = data.data;
        },
    },
    computed: {
        imageicon4() {
            return this.banner4.icon;
        },
    },
    async mounted() {
        await this.getbanner4();
        await this.getlistQa();
        await this.getlistQaCate();
    },
}
</script>

<style scoped>
@import '../../assets/css/homes.css';
</style>
