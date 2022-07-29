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
                    <li><a href="#">確認</a></li>

                </ul>
                <div class="module">
                    <div class="posting">
                        <div class="text-box">
                            <p class="text">
                                お名前: {{ store.register.name }}
                            </p>
                            <p class="text">
                                フリガナ: {{ store.register.furigana }}
                            </p>
                            <p class="text">
                                ニックネーム: {{ store.register.nickName }}
                            </p>
                            <p class="text">
                                メールアドレス: {{ store.register.email }}
                            </p>
                            <p class="text">
                                パスワード: {{ store.register.password }}
                            </p>
                            <p class="text">
                                連絡方法: {{ store.register.data_choose.contacts }}
                            </p>

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
import { store } from '../../store.js'
export default {
    components: {Infor},
    data() {
        return {
            register:[],
            store
        };
    },
    methods:{
        hasHistory () { return window.history.length > 2 },
        async getContact(id) {
            let { data } = await this.axios.get("api/customer/choose-option/detail", {
                params: { id: id }
                // auth: {
                //     username: "care21@greentechsolutions",
                //     password: "care21greentech@"
                // },
            });
            this.store.register.data_choose.contacts = data.data.title;
        },
    },
    async mounted(){
        await this.getContact(this.store.register.data_choose.contacts);
    }
}
</script>

<style scoped>
@import '../../assets/css/posting.css';
</style>
