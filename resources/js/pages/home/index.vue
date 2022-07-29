<template>
    <section>
        <div class="mainimg">
			<div class="box">
				<div class="box01">
					<p class="image">
						<img :src="banner.image_left" alt="">
					</p>
				</div>
				<div class="text-box">
                    <p class="bg-title" v-html="banner.intro"></p>
                    <p class="title" v-html="banner.intro2"></p>
                    <p class="text" v-html="banner.description"></p>
				</div>
				<div class="box02">
					<p class="image">
						<img :src="banner.image_right" alt="">
					</p>
				</div>
			</div>

		</div>
        <div class="main">
			<div class="content">
				<!-- ~*~*~*~*~ module start ~*~*~*~*~ -->
				<!-- {$c8_Contents} -->
				<div class="module">
					<ul class="list-navigation">
						<li>老人ホーム </li>
						<li>費　用</li>
						<li>訪　問</li>
						<li>通　所</li>
						<li>看　護</li>
						<li>リハビリ</li>
						<li>□□□□□</li>
						<li>□□□□□</li>
						<li>□□□□□</li>
					</ul>
				</div>
				<div class="module break-wrap">
					<div class="index-counseling break">
						<div class="box">
							<div class="bg-image" :style="{
    'background': 'url(' + imageUrl + ') center no-repeat'}">
								<p class="att" v-html="banner2.intro"></p>
							</div>
							<div class="text-box">
								<p class="title" v-html="banner2.intro2"></p>
								<p class="text" v-html="banner2.description"></p>
							</div>
						</div>
					</div>
				</div>
				<div class="module break-wrap">
					<div class="index-consultation break">
						<div class="box">
							<p class="note" v-html="banner3.intro"></p>
							<div class="method">
								<div class="text-box">
									<p class="bg-title">
										<span :style="{
    'background': 'url(' + imageicon3 + ') left center no-repeat'}">
											{{ banner3.title }}
										</span>
									</p>
									<p class="text" v-html="banner3.description"></p>
								</div>
								<p class="img">
									<img :src="banner3.image" alt="">
								</p>
							</div>
							<div class="info">
								<p class="title">
                                    <span  v-html="banner3.intro2"></span>
                                </p>
								<div class="info-box">
									<div class="article" v-for="(item, index) in banner3.list_image">
										<p class="image">
											<img :src="item.image" alt="">
										</p>
										<p class="att">
                                            {{ item.title }}
										</p>
										<p class="note">
                                            {{ item.note }}
										</p>
										<p class="num" v-if="item.check === 'on'">
											<span>
												24
											</span>
											時間
										</p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="module break-wrap">
					<div class="index-board break">
						<div class="box">
                            <p class="note" v-html="banner4.intro"></p>
							<div class="method">
								<div class="text-box">
									<p class="bg-title">
										<span :style="{
                                        'background': 'url(' + imageicon4 + ') left center no-repeat'}">
                                        {{ banner4.title }}
										</span>
									</p>
                                    <p class="text" v-html="banner4.description"></p>
								</div>
								<p class="img">
                                    <img :src="banner4.image" alt="">
								</p>
							</div>
							<div class="info">
								<p class="title">
                                    <span  v-html="banner4.intro2"></span>
								</p>
								<div class="info-box">
									<div class="article" v-for="(item, index) in banner4.list_image">
										<p class="image">
											<img :src="item.image" alt="">
										</p>
										<p class="att" v-html="item.note"></p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="module break-wrap">
					<div class="index-present break">
						<div class="box">
                            <p class="note" v-html="banner5.intro"></p>
							<div class="method">
								<div class="text-box">
									<p class="bg-title">
										<span :style="{
                                        'background': 'url(' + imageicon5 + ') left center no-repeat'}">
                                        {{ banner5.title }}
										</span>
									</p>
                                    <p class="text" v-html="banner5.description"></p>
								</div>
								<p class="img">
                                    <img :src="banner5.image" alt="">
								</p>
							</div>

						</div>
					</div>
				</div>
				<div class="module break-wrap">
					<div class="index-latest break">
						<div class="box">
							<div class="box-left">
								<p class="title">
									最新コラム
								</p>
								<div class="info-box">
									<div class="article" v-for="(item, index) in listQa">
										<p class="image">
											<img :src="require('../../assets/img/no-image.png')" alt="">
										</p>
										<div class="text-box">
											<div class="author">
												<p class="page">
													<span>
														{{item.qa_cate_title}}

													</span>
												</p>
												<p class="question">
													<span>
														{{item.qa_type_title}}

													</span>
												</p>
											</div>
											<p class="text">
                                                {{item.title}}…
											</p>
										</div>
									</div>
								</div>
								<p class="btn">
									<a href="#">
										さらに表示する
									</a>
								</p>
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
				<div class="module break-wrap">
					<div class="index-event break">
						<div class="box">
							<div class="box01" v-for="(item, index) in listEvent">
								<p class="att">
									<span>
										{{item.title}}
									</span>
								</p>
								<p class="title">
                                    {{item.description}}
								</p>
							</div>
						</div>
					</div>
				</div>
				<div class="module break-wrap">
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
										電話、zoomでのご相談は、平日の9：00～18：00の時間帯で受け付けています。<br>
										掲示板、メール、LINEでのご相談は、24時間受け付ています。
									</p>
								</div>
							</div>
							<Infor/>
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
import categoryRight from '../../components/categoryRight.vue';
import listPopular from '../../components/listPopular.vue';
import Infor from '../../components/Infor.vue';
export default {
    components: { categoryRight,listPopular,Infor },
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
            banner2: {
                image_left:null,
                title:null,
                image_right:null,
                image:null,
                intro:null,
                intro2:null,
                description:null,
                list_image:[],
            },
            banner3: {
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
            banner5: {
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
            listEvent: []
        };
    },
    methods: {
        async getbanner() {
            let { data } = await this.axios.get("api/images/detail", {
                params: { type: 1 }
                // auth: {
                //     username: "care21@greentechsolutions",
                //     password: "care21greentech@"
                // },
            });
            this.banner = data.data;
        },
        async getbanner2() {
            let { data } = await this.axios.get("api/images/detail", {
                params: { type: 2 }
                // auth: {
                //     username: "care21@greentechsolutions",
                //     password: "care21greentech@"
                // },
            });
            this.banner2 = data.data;
        },
        async getbanner3() {
            let { data } = await this.axios.get("api/images/detail", {
                params: { type: 3 }
                // auth: {
                //     username: "care21@greentechsolutions",
                //     password: "care21greentech@"
                // },
            });
            this.banner3 = data.data;
        },
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
        async getbanner5() {
            let { data } = await this.axios.get("api/images/detail", {
                params: { type: 5 }
                // auth: {
                //     username: "care21@greentechsolutions",
                //     password: "care21greentech@"
                // },
            });
            console.log(data.data)
            this.banner5 = data.data;
        },
        async getlistQa() {
            let { data } = await this.axios.get("api/qa/list-all", {
                params: { per_page: 6 }
                // auth: {
                //     username: "care21@greentechsolutions",
                //     password: "care21greentech@"
                // },
            });
            this.listQa = data.data.data;
        },
        async getlistEvent() {
            let { data } = await this.axios.get("api/images/detail", {
                params: { type: 7,list:1 }
                // auth: {
                //     username: "care21@greentechsolutions",
                //     password: "care21greentech@"
                // },
            });
            this.listEvent = data.data;
        }
    },
    computed: {
        imageUrl() {
            return this.banner2.image;
        },
        imageicon3() {
            return this.banner3.icon;
        },
        imageicon4() {
            return this.banner4.icon;
        },
        imageicon5() {
            return this.banner5.icon;
        }
    },
    async mounted() {
        await this.getbanner();
        await this.getbanner2();
        await this.getbanner3();
        await this.getbanner4();
        await this.getbanner5();
        await this.getlistQa();
        await this.getlistEvent();
    },
}
</script>

<style scoped>
    @import "../../assets/css/index.css";
</style>
