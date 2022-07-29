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
                    <li><a href="#">新規会員登録</a></li>
                </ul>
                <div class="module registration">
                    <p class="title">
                        新規会員登録
                    </p>
                    <div id="contact_form">
                        <form @submit.prevent="registerData" method="post" id="inquiry-form">
                            <input type="hidden" name="thanksurl" value="/thanks.php" class="errPosRight">
                            <input type="hidden" name="s" value="02" class="errPosRight">
                            <table class="form_table">
                                <tbody>
                                <tr class="form_name">
                                    <th>お名前 <span class="req">必須</span></th>
                                    <td>
                                        <div id="err_name" class=" userformError form_inquiry-form "
                                             style="display: none;">
                                            <div class="formErrorMsg formErrorContent"></div>
                                            <div class="formErrorArrow">
                                                <div class="line10"></div>
                                                <div class="line9"></div>
                                                <div class="line8"></div>
                                                <div class="line7"></div>
                                                <div class="line6"></div>
                                                <div class="line5"></div>
                                                <div class="line4"></div>
                                                <div class="line3"></div>
                                                <div class="line2"></div>
                                                <div class="line1"></div>
                                            </div>
                                        </div>
                                        <input type="text" name="name" id="name" v-model="register.name"
                                               class="chkrequired errPosRight before">
                                    </td>
                                </tr>
                                <tr class="form_email">
                                    <th>フリガナ<span class="req">必須</span></th>
                                    <td>
                                        <div id="err_email" class=" userformError form_inquiry-form "
                                             style="display: none;">
                                            <div class="formErrorMsg formErrorContent"></div>
                                            <div class="formErrorArrow">
                                                <div class="line10"></div>
                                                <div class="line9"></div>
                                                <div class="line8"></div>
                                                <div class="line7"></div>
                                                <div class="line6"></div>
                                                <div class="line5"></div>
                                                <div class="line4"></div>
                                                <div class="line3"></div>
                                                <div class="line2"></div>
                                                <div class="line1"></div>
                                            </div>
                                        </div>
                                        <input type="text" name="furigana" id="furigana" v-model="register.furigana"
                                               class="chkrequired chkemail chkhankaku errPosRight before">
                                    </td>
                                </tr>
                                <tr>
                                    <th>ニックネーム<span class="req">必須</span></th>
                                    <td>
                                        <input type="text" name="nickName" v-model="register.nickName" class=" errPosRight">
                                    </td>
                                </tr>
                                <tr class="form_address">
                                    <th>性別</th>
                                    <td>
                                        <label class="male">
                                            <input type="radio" name="gender" v-model="register.gender" value="2" id="male">男性
                                            <span class="checkmark"></span>
                                        </label>
                                        <label class="female">
                                            <input type="radio" name="gender" v-model="register.gender" value="1" id="female">女性
                                            <span class="checkmark"></span>
                                        </label>
                                    </td>

                                </tr>
                                <tr class="form_tel">
                                    <th>年齢</th>
                                    <td>
                                        <select name="ages" id="" v-model="register.data_choose.ages">
                                            <option :value="item.id" v-for="(item, index) in age">{{ item.title }}</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr class="form_inquiry">
                                    <th>住所</th>
                                    <td>
                                        郵便番号入力<br>
                                        <input type="text" name="zipcode" v-model="register.zipcode" value="" class="one"><br>
                                        <input type="text" name="address2" v-model="register.address2" value=""><br>
                                        番地、マンション部屋番号入力<br>
                                        <input type="text" name="address" v-model="register.address" value="">
                                    </td>

                                </tr>
                                <tr class="form_phone">
                                    <th>電話番号</th>
                                    <td>
                                        <input type="text" name="phone" v-model="register.phone" value="">
                                    </td>

                                </tr>
                                <tr class="form_id">
                                    <th>ラインID</th>
                                    <td>
                                        <input type="text" name="pass_port" v-model="register.pass_port" value="">
                                    </td>

                                </tr>
                                <tr class="">
                                    <th>メールアドレス<span class="req">必須</span></th>
                                    <td>
                                        <input type="text" name="email" v-model="register.email"  value="">
                                    </td>
                                </tr>
                                <tr class="">
                                    <th>パスワード<span class="req">必須</span></th>
                                    <td>
                                        <input type="text" name="email" v-model="register.password"  value="">
                                    </td>
                                </tr>
                                <tr class="form_check">

                                    <th>連絡方法
                                        必須<span class="req">必須</span></th>
                                    <td>
                                            <label class="" v-for="(item, index) in contact">
                                                <input type="radio" name="contacts" v-model="register.data_choose.contacts" :value="item.id">{{ item.title }}
                                                <span class="checkmark"></span>
                                            </label>
                                    </td>
                                </tr>
                                <tr class="form">

                                    <td rowspan="2" colspan="2">
                                        <label class="container">
                                            <div class="check">
                                                <input type="radio" name="radio" id="1">
                                                <a href="#">利用規約</a>ご同意後、チェックを入れてください。
                                                <span class="checkmark"></span>


                                            <p class="submit">
                                                <button type="submit">
                                                    入力内容を確認
                                                </button>
                                            </p>
                                            </div>
                                        </label>

                                    </td>
                                </tr>


                                </tbody>

                            </table>

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
            age: [],
            contact: [],
            register:{
                name:null,
                nickName:null,
                furigana:null,
                email:null,
                password:null,
                data_choose:{
                    contacts:null,
                    ages:null,
                },
                gender:null,
                zipcode:null,
                address2:null,
                address:null,
                phone:null,
                pass_port:null,
            },
            store
        };
    },
    methods: {
        async getListAge() {
            let { data } = await this.axios.get("api/customer/list-choose-cate/detail", {
                params: { code: "age" }
                // auth: {
                //     username: "care21@greentechsolutions",
                //     password: "care21greentech@"
                // },
            });
            this.age = data.data.content;
        },
        async getContact() {
            let { data } = await this.axios.get("api/customer/list-choose-cate/detail", {
                params: { code: "contact" }
                // auth: {
                //     username: "care21@greentechsolutions",
                //     password: "care21greentech@"
                // },
            });
            this.contact = data.data.content;
        },
        async registerData(e){
            await this.axios.post("api/customer/register",this.register).then((result)=>{
                this.store.addDataRegister(this.register)
                this.$toast.success('Register success!')
                this.$router.push({path:'/posting'});
            }).catch((err) =>{
                this.$toast.error('Register false!')
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
        await this.getListAge();
        await this.getContact();
    },
}
</script>

<style scoped>
@import '../../assets/css/registration.css';
</style>
