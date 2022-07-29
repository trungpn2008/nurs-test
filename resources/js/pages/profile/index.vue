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
                    <li><a href="#">掲示板投稿</a></li>
                    <li><a href="#">完了</a></li>

                </ul>
                <div class="module">
                    <div class="profile">
                        <form @submit.prevent="updateProfile" method="post">
                        <p class="title">
							<span>
								あなたのプロフィール
							</span>
                        </p>
                        <input type="file" hidden ref="file" @change="changeData" />
                        <p class="image" @click="openFile()">
                            <img  :src="profile.avatar" alt="" style="border-radius: 50%;width: 100%;">
                        </p>
                        <div class="info">
                            <label for="">ニックネーム</label><br>
                            <input type="text" name="nickname" v-model="profile.nickname"  placeholder="coach">
                        </div>
                        <div class="info-box">
                            <div class="info-left">
                                <label for="">性別<span>必須</span></label><br>
                                <select name="gender" id="gender" v-model="profile.gender" >
                                    <option value="1" :selected="profile.gender === 1">女性</option>
                                    <option value="2" :selected="profile.gender === 2">男性</option>
                                </select>
                            </div>
                            <div class="info-right">
                                <label for="">あなたの生まれた年<span>必須</span></label><br>
                                <select name="year_of_birth" id="year_of_birth" v-model="profile.year_of_birth">
                                    <option value="1990" :selected="profile.year_of_birth === 1990">1990</option>
                                    <option value="1991" :selected="profile.year_of_birth === 1991">1991</option>
                                    <option value="1992" :selected="profile.year_of_birth === 1992">1992</option>
                                </select>
                            </div>

                        </div>
                        <label for="">プロフィール文 </label><br>
                        <textarea name="content_profile" id="content_profile" v-model="profile.content_profile" cols="650" rows="150" v-html="profile.content_profile" style="padding: 10px 15px;"></textarea>
                        <p class="att">
                            ※任意5,000文字以内
                        </p>
                        <div class="case">
                            <p class="title">
								<span>
									介護対象者のプロフィール1
								</span>
                            </p>
                            <label for="">介護対象者のプロフィール1<span>必須</span></label><br>
                            <select name="care" id="relationship" v-model="profile.data_choose.relationship">
                                <option :value="item.id" v-for="(item, index) in relationship" :selected="profile.data_choose.relationship === item.id">{{ item.title }}</option>
                            </select><br>
                            <label for="">認知症の有無<span>必須</span></label><br>
                            <select name="care" id="dementia" v-model="profile.data_choose.dementia">
                                <option :value="item.id" v-for="(item, index) in dementia" :selected="profile.data_choose.dementia === item.id">{{ item.title }}</option>
                            </select><br>
                            <label for="">要介護度<span>必須</span></label><br>
                            <select name="care" id="care" v-model="profile.data_choose.care">
                                <option :value="item.id" v-for="(item, index) in care" :selected="profile.data_choose.care === item.id">{{ item.title }}</option>
                            </select><br>
                            <label for="">介護状況<span>必須</span></label><br>
                            <select name="care_situation" id="care_situation" v-model="profile.data_choose.care_situation">
                                <option :value="item.id" v-for="(item, index) in care_situation" :selected="profile.data_choose.care_situation === item.id">{{ item.title }}</option>
                            </select><br>
                            <p class="btn">
                                <a href="#">
                                    <span>介建対象否を追加</span>
                                </a>
                            </p>
                        </div>
                        <ul class="list">
                            <li><a @click="hasHistory() ? $router.go(-1) : $router.push('/')">
                                戻る
                            </a></li>
                            <li><a href="#">
                                <button type="submit">
                                    変更
                                </button>
                            </a></li>
                        </ul>
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
            profile:{
                avatar: null,
                nickname:null,
                data_choose:[],
                gender:null,
                year_of_birth:null,
                content_profile:null,
            },
            info:{},
            relationship: [],
            dementia: [],
            care: [],
            care_situation: [],
        };
    },
    methods: {
        hasHistory () { return window.history.length > 2 },
        async openFile() {
            this.$refs.file.click();
        },
        changeData(event) {
            let input = event.target;
            if (input.files) {
                new Promise((resolve, reject) => {
                    const reader = new FileReader();
                    reader.readAsDataURL(input.files[0]);
                    reader.onload = () => resolve(reader.result);
                    reader.onerror = (error) => reject(error);
                }).then(async (data) => {
                    this.profile.avatar=data
                });
            }
        },
        async getRelationship() {
            let { data } = await this.axios.get("api/customer/list-choose-cate/detail", {
                params: { code: "relationship" }
                // auth: {
                //     username: "care21@greentechsolutions",
                //     password: "care21greentech@"
                // },
            });
            this.relationship = data.data.content;
        },
        async getDementia() {
            let { data } = await this.axios.get("api/customer/list-choose-cate/detail", {
                params: { code: "dementia" }
                // auth: {
                //     username: "care21@greentechsolutions",
                //     password: "care21greentech@"
                // },
            });
            this.dementia = data.data.content;
        },
        async getCare() {
            let { data } = await this.axios.get("api/customer/list-choose-cate/detail", {
                params: { code: "care" }
                // auth: {
                //     username: "care21@greentechsolutions",
                //     password: "care21greentech@"
                // },
            });
            this.care = data.data.content;
        },
        async getCareSituation() {
            let { data } = await this.axios.get("api/customer/list-choose-cate/detail", {
                params: { code: "care_situation" }
                // auth: {
                //     username: "care21@greentechsolutions",
                //     password: "care21greentech@"
                // },
            });
            this.care_situation = data.data.content;
        },

        async getinfo() {
            let jwt = this.$session.get('jwt')
            let { data } = await this.axios.get("api/customer/info-customer", {
                headers: {"Authorization" : `Bearer `+jwt}
                // auth: {
                //     username: "care21@greentechsolutions",
                //     password: "care21greentech@"
                // },
            }.catch((err) => {
                // console.log(err.response.data.code)
                if (err.response.data.code === 401){
                    this.$toast.error('Session expired!')
                    this.$router.push("/login");
                }
            }));
            this.profile.nickname = data.data.user_name;
            this.profile.avatar = data.data.avatar;
            this.profile.data_choose = data.data.data_choose;
            this.profile.gender = data.data.gender;
            this.profile.year_of_birth = data.data.year_of_birth;
            this.profile.content_profile = data.data.content_profile;
        },
        async updateProfile(e){
            let jwt = this.$session.get('jwt');
            console.log(this.profile)
            await this.axios.post("api/customer/update-profile",this.profile,{headers: {"Authorization" : `Bearer `+jwt}}).then((result)=>{
                // console.log(result);
                this.$toast.success('Update data success!')
                this.$router.push("/user");
            }).catch((err) => {
                // console.log(err.response.data.code)
                if (err.response.data.code === 401){
                    this.$toast.error('Session expired!')
                    this.$router.push("/login");
                }
            });
            // e.preventDefault();
        }
    },
    async mounted() {
        await this.getRelationship();
        await this.getDementia();
        await this.getCare();
        await this.getCareSituation();
        await this.getinfo();
    },
}
</script>

<style scoped>
@import '../../assets/css/profile.css';
</style>
