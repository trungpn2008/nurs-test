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
                    <li><a href="#">ユーザーマイページ</a></li>

                </ul>
                <div class="module">
                    <div class="user">
                        <p class="title">
							<span>
								ユーザーマイページ
							</span>
                        </p>
                        <p class="image">
                            <img  :src="profile.avatar" alt="" style="border-radius: 50%;width: 100%;">
                        </p>
                        <div class="info">
                            <label for="">ニックネーム</label><br>
                            <input type="text" name="nickname" v-model="profile.nickname" disabled placeholder="coach">
                        </div>
                        <div class="info-box">
                            <div class="info-left">
                                <label for="">性別<span>必須</span></label><br>
                                <select name="gender" id="gender" disabled v-model="profile.gender" >
                                    <option value="1" :selected="profile.gender === 1">女性</option>
                                    <option value="2" :selected="profile.gender === 1">男性</option>
                                </select>
                            </div>
                            <div class="info-right">
                                <label for="">あなたの生まれた年<span>必須</span></label><br>
                                <select name="year_of_birth" id="year_of_birth" disabled v-model="profile.year_of_birth">
                                    <option value="1990" :selected="profile.year_of_birth === 1990">1990</option>
                                    <option value="1991" :selected="profile.year_of_birth === 1991">1991</option>
                                    <option value="1992" :selected="profile.year_of_birth === 1992">1992</option>
                                </select>
                            </div>

                        </div>
                        <label for="">プロフィール文 </label><br>
                        <textarea name="content_profile" id="content_profile" cols="650" rows="150"v-model="profile.content_profile" disabled v-html="profile.content_profile" style="padding: 10px 15px;"></textarea>
                        <p class="btn">
                            <a href="/profile">
								<span>
									プロフィール変更
								</span>
                            </a>
                        </p>
                        <ul class="list">
                            <li><a href="/">
                                みんなの広場
                            </a></li>
                            <li><a href="/qa">
                                Q&A
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
    data() {
        return {
            profile:{
                avatar: null,
                nickname:null,
                gender:null,
                year_of_birth:null,
                content_profile:null,
            },
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
                    this.$toast.error('Session expired!')
                    this.$router.push("/login");
                }
            });
            this.profile.nickname = data.data.user_name;
            this.profile.avatar = data.data.avatar;
            this.profile.gender = data.data.gender;
            this.profile.year_of_birth = data.data.year_of_birth;
            this.profile.content_profile = data.data.content_profile;
        },
    },
    async mounted() {
        await this.getinfo();
    },
}
</script>

<style scoped>
@import '../../assets/css/user.css';
</style>
