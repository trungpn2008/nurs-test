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
                    <li><a href="#">お問い合わせ</a></li>

                </ul>
                <div class="module">
                    <div class="inquiry form_check">
                        <p class="bg-title">
							<span>
								お問い合わせ
							</span>
                        </p>
                        <form @submit.prevent="addInquiryData" method="post">
                            <label for="">
                                お名前
                            </label><br>
                            <input type="text" v-model="addInquiry.name" value=""><br>
                            <label for="">
                                メールアドレス
                            </label><br>
                            <input type="text" v-model="addInquiry.email" value=""><br>
                            <label for="">
                                メールアドレス確認
                            </label><br>
                            <input type="text" v-model="emailConfirm" value="">

                        <p class="att">
                            ※運営事務局よりご返信させていただく際に必要となりますので、お間違いのないようご入力ください
                        </p>
                        <p class="title">
                            お問い合わせの種類
                        </p>
<!--                        <ul class="list">-->
                            <label class="" v-for="(item, index) in inquiry" style="width: 100%">
                                <input type="radio" name="inquiry" v-model="addInquiry.inquiry_type" :value="item.id" style="border: none;
    background: none;
    margin-top: 2px;
    margin-right: 18px;
    width: 20px;
    height: 25px;
    background-color: #FCF9FC;
    border-radius: 50%;box-shadow: 0 2px 10px 0 #ffffff40 inset;">{{ item.title }}
                                <span class="checkmark"></span>
                            </label>
<!--                            <li>ログイン（パスワード紛失等）に関するお問い合わせ</li>-->
<!--                            <li>サイトの操作方法に関するお問い合わせ</li>-->
<!--                            <li>サイト内のコンテンツに対するお問い合わせ</li>-->
<!--                            <li>規約違反ユーザの通報</li>-->
<!--                            <li>その他（サイト全般）</li>-->

<!--                        </ul>-->
                        <label for="">ご質問・ご相談内容</label>
                        <textarea name="question" id="question" cols="30" rows="10" v-model="addInquiry.question" v-html="addInquiry.question"></textarea>

                        <p class="note">
                            <a href="/advice" target="_blank">個人情報の利用目的</a>に同意のうえ、送信ボタンを押してください。
                        </p>
                        <p class="text">
                            事務局から差し上げた内容に関しては、問合せいただいた個人宛てに差し上げたものです。内容の一部、または全部を転載・二次利用することはご遠慮ください。<br>
                            回答に時間がかかることがございます。また、頂いたご意見・お問合せすべてにはご返事を差し上げられない場合がございます。
                        </p>
                        <p class="btn"><a >
                            <button type="submit">
                                送信する
                            </button>
                        </a></p>

                        </form>
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
            inquiry: [],
            addInquiry:{
                name:null,
                email:null,
                inquiry_type:null,
                question:null,
            },
            emailConfirm:null
        };
    },
    methods: {
        async getInquiryCate() {
            let { data } = await this.axios.get("api/investigation-type/list", {
                // auth: {
                //     username: "care21@greentechsolutions",
                //     password: "care21greentech@"
                // },
            });
            this.inquiry = data.data;
        },
        async addInquiryData(e){
            await this.axios.post("api/investigation/add",this.addInquiry).then((result)=>{
                this.$toast.success('Inquiry success!')
                this.$router.push({path:'/screen'});
            }).catch((err) =>{
                this.$toast.error('Inquiry false!')
                // console.warn(err)
            });
            // e.preventDefault();
        },
    },
    computed: {
        // imageUrl() {
        //     return this.banner2.image;
        // },
    },
    async mounted() {
        await this.getInquiryCate();
    },
}
</script>

<style scoped>
@import '../../assets/css/inquiry.css';
</style>
