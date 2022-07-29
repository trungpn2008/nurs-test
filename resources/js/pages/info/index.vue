<template>
    <section>
        <div class="mainimg no">
            <div class="text-box">
                <ul class="bread">
                    <li><a href="#">トップ </a></li>
                    <li><a href="#">プロフィール</a></li>
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
                    <p class="att">
                        ※任意5,000文字以内
                    </p>
                    <div class="care">
                        <p class="title">
							<span>
								介護対象者のプロフィール1
							</span>
                        </p>
                        <div class="info-box">
                            <label for="">
                                続柄<span>必須</span>
                            </label>
                            <select name="" id="">
                                <option value="0">
                                    選択する
                                </option>
                                <option value="0">
                                    選択する
                                </option>
                                <option value="0">
                                    選択する
                                </option>
                            </select>
                            <label for="">
                                認知症の有無<span>必須</span>
                            </label>
                            <select name="" id="">
                                <option value="0">
                                    選択する
                                </option>
                                <option value="0">
                                    選択する
                                </option>
                                <option value="0">
                                    選択する
                                </option>
                            </select>
                            <label for="">
                                要介護度<span>必須</span>
                            </label>
                            <select name="" id="">
                                <option value="0">
                                    選択する
                                </option>
                                <option value="0">
                                    選択する
                                </option>
                                <option value="0">
                                    選択する
                                </option>
                            </select>
                            <label for="">
                                介護状況<span>必須</span>
                            </label>
                            <select name="" id="">
                                <option value="0">
                                    選択する
                                </option>
                                <option value="0">
                                    選択する
                                </option>
                                <option value="0">
                                    選択する
                                </option>
                            </select>
                            <p class="btn">
                                <a href="#">
                                    <span>介建対象否を追加</span>

                                </a>
                            </p>
                        </div>
                    </div>
                    <ul class="list-btn">
                        <li><a href="#">
                            戻る
                        </a></li>
                        <li><a href="#">変更</a></li>
                    </ul>
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
                    <li><a href="#">1150943312さんのMy知恵袋</a></li>

                </ul>
                <div class="module">
                    <div class="info">
                        <div class="inner">
                            <p class="image" style="width: 135px;height: 135px;">
                                <img :src="profile.avatar" :alt="profile.nickname" style="border-radius: 50%;width: 100%;">
                            </p>
                            <div class="text-box">
                                <p class="att">
                                    登緑番号: {{ profile.id }}
                                </p>
                                <p class="num">
                                    {{ profile.id + ' '+ profile.nickname}}
                                </p>
                                <p class="user">
									<span>
										プロフィール
									</span>
                                </p>
                                <div class="info-box">
                                    <p class="text">
                                        性別:
                                        <span>
											{{ profile.gender === 1 ? '女性' : '男性' }}
										</span>
                                    </p>
                                    <p class="text">
                                        年齢:
                                        <span>
											{{ profile.age_number }}
										</span>
                                    </p>
                                    <p class="text">
                                        参加日:
                                        <span>
											{{profile.date_begin}}
										</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="description-info-user">
                            <b-tabs content-class="mt-3" fill>
                                <b-tab title="質問">
                                    <b-card no-body>
                                        <b-tabs pills card>
                                            <b-tab title="すべて" active>
                                                <div class="table" v-if="all.length > 0">
                                                    <b-table striped hover :items="all"></b-table>
                                                </div>
                                                <div class="table" v-else>
                                                    <b-card-text><div class="no-result"><p>条件に一致する實問がありません</p></div></b-card-text>
                                                </div>
                                            </b-tab>
                                            <b-tab title="回答受付中">
                                                <div class="table" v-if="accept.length >0">
                                                    <b-table striped hover :items="accept"></b-table>
                                                </div>
                                                <div class="table" v-else>
                                                    <b-card-text><div class="no-result"><p>条件に一致する實問がありません</p></div></b-card-text>
                                                </div>
                                            </b-tab>
                                            <b-tab title="解決済み">
                                                <div class="table" v-if="solved.length >0">
                                                    <b-table striped hover :items="accept"></b-table>
                                                </div>
                                                <div class="table" v-else>
                                                    <b-card-text><div class="no-result"><p>条件に一致する實問がありません</p></div></b-card-text>
                                                </div>
                                            </b-tab>
                                            <b-tab title="ベストアンサー未選択">
                                                <div class="table" v-if="bestAnswer.length >0">
                                                    <b-table striped hover :items="accept"></b-table>
                                                </div>
                                                <div class="table" v-else>
                                                    <b-card-text><div class="no-result"><p>条件に一致する實問がありません</p></div></b-card-text>
                                                </div>
                                            </b-tab>
                                            <b-tab title="取り消し•削除">
                                                <div class="table" v-if="cancel.length >0">
                                                    <b-table striped hover :items="accept"></b-table>
                                                </div>
                                                <div class="table" v-else>
                                                    <b-card-text><div class="no-result"><p>条件に一致する實問がありません</p></div></b-card-text>
                                                </div>
                                            </b-tab>
                                        </b-tabs>
                                    </b-card>
                                </b-tab>
                                <b-tab title="回答"><p>回答</p></b-tab>
                                <b-tab title="おすすめ"><p>おすすめ</p></b-tab>
                                <b-tab title="知恵コレ"><p>知恵コレ</p></b-tab>
                            </b-tabs>
                        </div>
<!--                        <ul class="list">
                            <li><a href="#">
                                質問
                            </a></li>
                            <li><a href="#">回答</a></li>
                            <li><a href="#">おすすめ</a></li>
                            <li><a href="#">知恵コレ</a></li>
                        </ul>
                        <ul class="list-btn">
                            <li><a href="#">
                                すべて
                            </a></li>
                            <li><a href="#">回答受付中</a></li>
                            <li><a href="#">解決済み</a></li>
                            <li><a href="#">ベストアンサー未選択</a></li>
                            <li><a href="#">取り消し•削除</a></li>
                            <li><a href="#">
                                <img src="img/icon32.png" alt="">
                            </a></li>
                        </ul>
                        <p class="note">
                            条件に一致する實問がありません
                        </p>-->
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
            profile:{
                id: null,
                avatar: null,
                nickname:null,
                gender:null,
                year_of_birth:null,
                content_profile:null,
                date_begin:null,
                age_number:null,
            },
            all:[],
            accept:[],
            solved:[],
            bestAnswer:[],
            cancel:[]
        };
    },
    methods: {
        hasHistory () { return window.history.length > 2 },
        async getinfo() {
            let jwt = this.$session.get('jwt')
            let { data } = await this.axios.get("api/customer/info-customer", {
                headers: {"Authorization" : `Bearer `+jwt}
                // auth: {
                //     username: "care21@greentechsolutions",
                //     password: "care21greentech@"
                // },
            }).catch((err) => {
                // console.log(err.response.data.code)
                if (err.response.data.code === 401){
                    this.$router.push("/login");
                }
            });
            this.$toast.success('Get information customer success!')
            this.profile.id = data.data.id;
            this.profile.nickname = data.data.user_name;
            this.profile.avatar = data.data.avatar;
            this.profile.gender = data.data.gender;
            this.profile.year_of_birth = data.data.year_of_birth;
            this.profile.content_profile = data.data.content_profile;
            this.profile.date_begin = data.data.date_begin;
            this.profile.age_number = data.data.age_number;
        },
        async getAllQuestion() {
            let jwt = this.$session.get('jwt')
            let { data } = await this.axios.get("api/qa/list", {
                headers: {"Authorization" : `Bearer `+jwt},
                params:{
                    status:'all'
                }
                // auth: {
                //     username: "care21@greentechsolutions",
                //     password: "care21greentech@"
                // },
            }).catch((err) => {
                // console.log(err.response.data.code)
                if (err.response.data.code === 401){
                    this.$toast.error('Session expired!')
                    this.$router.push("/login");
                }
            });
            this.$toast.success('Get all question customer success!')
            this.all = data.data.data;
        },
        async getAcceptQuestion() {
            let jwt = this.$session.get('jwt')
            let { data } = await this.axios.get("api/qa/list", {
                headers: {"Authorization" : `Bearer `+jwt},
                params:{
                    status:1
                }
                // auth: {
                //     username: "care21@greentechsolutions",
                //     password: "care21greentech@"
                // },
            }).catch((err) => {
                // console.log(err.response.data.code)
                if (err.response.data.code === 401){
                    this.$toast.error('Session expired!')
                    this.$router.push("/login");
                }
            });
            this.$toast.success('Get all question customer success!')
            this.accept = data.data.data;
        },
        async getSolvedQuestion() {
            let jwt = this.$session.get('jwt')
            let { data } = await this.axios.get("api/qa/list", {
                headers: {"Authorization" : `Bearer `+jwt},
                params:{
                    status:1
                }
                // auth: {
                //     username: "care21@greentechsolutions",
                //     password: "care21greentech@"
                // },
            }).catch((err) => {
                // console.log(err.response.data.code)
                if (err.response.data.code === 401){
                    this.$toast.error('Session expired!')
                    this.$router.push("/login");
                }
            });
            this.$toast.success('Get all question customer success!')
            this.solved = data.data.data;
        },
        async getBestAnswerQuestion() {
            let jwt = this.$session.get('jwt')
            let { data } = await this.axios.get("api/qa/list", {
                headers: {"Authorization" : `Bearer `+jwt},
                params:{
                    status:1
                }
                // auth: {
                //     username: "care21@greentechsolutions",
                //     password: "care21greentech@"
                // },
            }).catch((err) => {
                // console.log(err.response.data.code)
                if (err.response.data.code === 401){
                    this.$toast.error('Session expired!')
                    this.$router.push("/login");
                }
            });
            this.$toast.success('Get all question customer success!')
            this.bestAnswer = data.data.data;
        },
        async getCancelQuestion() {
            let jwt = this.$session.get('jwt')
            let { data } = await this.axios.get("api/qa/list", {
                headers: {"Authorization" : `Bearer `+jwt},
                params:{
                    status:1
                }
                // auth: {
                //     username: "care21@greentechsolutions",
                //     password: "care21greentech@"
                // },
            }).catch((err) => {
                // console.log(err.response.data.code)
                if (err.response.data.code === 401){
                    this.$toast.error('Session expired!')
                    this.$router.push("/login");
                }
            });
            this.$toast.success('Get all question customer success!')
            this.cancel = data.data.data;
        },
    },
    async mounted() {
        await this.getinfo();
        await this.getAllQuestion();
        await this.getAcceptQuestion();
        await this.getSolvedQuestion();
        await this.getBestAnswerQuestion();
        await this.getCancelQuestion();
    },
}
</script>

<style scoped>
@import '../../assets/css/info.css';
</style>
