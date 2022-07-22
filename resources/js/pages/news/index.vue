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
									{{news[0].name}}
								</p>

								<p class="image">
									<img :src="news[0].image" alt="">
								</p>
								<p class="text">
									平素は格別のお引き立てを賜り、厚く御礼申し上げます。<br>
									誠に勝手ながら弊社では下記の期間を年末年始休業とさせていただきます。
								</p>
							</div>
							<div class="box-right">
								<div class="info">
									<div class="bg-title">
										<p class="btn">
											<a href="#">
												お知らせ
											</a>
										</p>
										<p class="date">
											2022/05/15 18:28
										</p>
										</div>
										<p class="img">
											<img src="img/img02.jpg" alt="">
										</p>
										<p class="text">
											年末年始の休業のお知らせ
										</p>
									</div>
								<div class="info">
									<div class="bg-title">
										<p class="btn">
											<a href="#">
												お知らせ
											</a>
										</p>
										<p class="date">
											2022/05/15 18:28
										</p>
									</div>
										<p class="img">
											<img src="img/img02.jpg" alt="">
										</p>
										<p class="text">
											年末年始の休業のお知らせ
										</p>

								</div>
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
							<div class="info-box">
								<div class="article">
									<p class="image">
										<img src="img/icon_page.png" alt="">
									</p>
									<p class="att">
										掲示板
									</p>
									<p class="note">
										受付時間：24時間受付
									</p>
									<p class="num">
										<span>
											24
										</span>
										時間
									</p>
								</div>
								<div class="article">
									<p class="image">
										<img src="img/icon_mail.png" alt="">
									</p>
									<p class="att">
										メール
									</p>
									<p class="note">
										受付時間：24時間受付
									</p>
									<p class="num">
										<span>
											24
										</span>
										時間
									</p>
								</div>
								<div class="article">
									<p class="image">
										<img src="img/icon_tel.png" alt="">
									</p>
									<p class="att">
										電　話
									</p>
									<p class="note">
										受付時間：平日9：00～18：00
									</p>
								</div>
								<div class="article">
									<p class="image">
										<img src="img/icon_zoom.png" alt="">
									</p>
									<p class="att">
										zoom
									</p>
									<p class="note">
										受付時間：平日9：00～18：00
									</p>
								</div>
								<div class="article">
									<p class="image">
										<img src="img/icon_line.png" alt="">
									</p>
									<p class="att">
										LINE
									</p>
									<p class="note">
										受付時間：24時間受付
									</p>
									<p class="num">
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

				<!-- ~*~*~*~*~ module end ~*~*~*~*~ -->
			</div>
			<!-- .content -->

		</div>
  </section>
</template>

<script>

export default {
    data(){
        return {
            news :[],
            paging : null
        }
    },
    methods:{
        async getNews(){
            console.log(this.axios);
            let {data} = await this.axios.get('api/news/list',{
                auth: {
                    username: 'care21@greentechsolutions',
                    password: 'care21greentech@'
                },
            });
            this.paging = data.data.news;
            this.news = this.paging.data;
            console.log(this.news)
        }
    },
    async created(){
        await this.getNews();
    }
}
</script>

<style>
@import '../../assets/css/news.css'
</style>
