<template>
  <section>
    <div class="mainimg noo">

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
				<div class="module break-wrap">
					<div class="news break">
						<div class="box">
							<div class="box-left">
								<div class="bg-title">
									<p class="date">
										{{news[0].created_at}}
									</p>
									<p class="btn">
										{{news[0].cate_name}}
									</p>
								</div>
								<p class="title">
									{{news[0].title}}
								</p>

								<p class="image">
									<img :src="news[0].image" alt="">
								</p>
								<p class="text">
									{{news[0].short_description}}
								</p>
							</div>
							<div class="box-right">
								<template v-for="(item,index) in news">
                                    <div class="info" v-if="index!=0" :key="index">
									    <div class="bg-title">
										<p class="btn">
											<a href="#">
												{{item.cate_name}}
											</a>
										</p>
										<p class="date">
											{{item.created_at}}
										</p>
										</div>
										<p class="img">
											<img :src="item.image" alt="">
										</p>
										<p class="text">
											{{item.title}}
										</p>
									</div>

                                </template>
							</div>
						</div>
						<p class="page">
							<a href="#">
								一覧に戻る
							</a>
						</p>
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
import Infor from "../../components/Infor.vue";

export default {
    data() {
        return {
            news: [],
            paging: null
        };
    },
    methods: {
        async getNews() {
            let { data } = await this.axios.get("api/news/list", {
                auth: {
                    username: "care21@greentechsolutions",
                    password: "care21greentech@"
                },
            });
            this.paging = data.data.news;
            this.news = this.paging.data;
        }
    },
    async mounted() {
        await this.getNews();
    },
    components: { Infor }
}
</script>

<style>
@import '../../assets/css/news.css'
</style>
