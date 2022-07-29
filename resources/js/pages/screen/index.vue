<template>
    <section>
        <div class="mainimg no">
            <div class="text-box">
                <ul class="bread">
                    <li><a href="#">トップ </a></li>
                    <li><a href="#">掲示板投稿</a></li>
                </ul>

                <div class="info">
                    <div class="bg-title">
                        <p class="note">
                            ― 皆様の介護のお悩み掲示板 ―
                        </p>
                        <p class="title">
							<span>
								掲 示 板
							</span>
                        </p>
                    </div>

                    <p class="text">
                        老人ホームの種類
                    </p>
                    <p class="image">
                        <img src="img/icon02.png" alt="">
                    </p>
                </div>
            </div>
        </div>
        <div class="main">
            <div class="content">
                <!-- ~*~*~*~*~ module start ~*~*~*~*~ -->
                <!-- {$c8_Contents} -->

                <ul class="bread">
                    <li><a href="#">
                        トップ
                    </a></li>
                    <li><a href="#">掲示板投稿</a></li>
                    <li><a href="#">完了</a></li>

                </ul>
                <div class="module">
                    <div class="screen">
                        <div class="text-box">
                            お申し込みありがとうございます。 <br>
                            入力が完了いたしました。<br>
                            ご入力いただきました情報は、無事送信されました。<br>
                            ご紹介者様には、ポイント付与後、<br>
                            ご入力いただいたメールアドレスへご連絡させていたたきますので、 <br>
                            今しばらくお待ちください。

                        </div>
                        <div class="btn">
                            <p class="inner"><a @click="hasHistory() ? $router.go(-1) : $router.push({path:'/'})">
                                閉じる
                            </a></p>

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
import Infor from '../../components/Infor.vue';

export default {
    components: {Infor},
    methods:{
        hasHistory () { return window.history.length > 2 },
    },
}
</script>

<style scoped>
@import '../../assets/css/screen.css';
</style>
