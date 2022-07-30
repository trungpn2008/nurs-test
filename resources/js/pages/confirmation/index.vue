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
                    <li><a href="#">新規会員登録</a></li>
                </ul>
                <div class="module registration">
                    <p class="title">
                        掲示板投稿
                    </p>
                    <div id="contact_form">
                        <form @submit.prevent="addData" method="post" id="inquiry-form">
                            <input type="hidden" name="thanksurl" value="/thanks.php" class="errPosRight">
                            <input type="hidden" name="s" value="02" class="errPosRight">
                            <table class="form_table">
                                <tbody>
                                <tr class="form_name">
                                    <th>カテゴリー 必須
                                        <span class="req">必須</span>
                                    </th>
                                    <td>
                                        <select name="type" id="type" v-model="qa.qa_type">
                                            <option :value="item.id" v-for="(item, index) in type">{{ item.title }}</option>
                                        </select>
                                        <select name="cate" id="cate" v-model="qa.qa_cate">
                                            <option :value="item.id" v-for="(item, index) in cate">{{ item.title }}</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr class="form_address">
                                    <th>タイトル<span class="req">必須</span>
                                        <span class="note">
												50文字まで
											</span>
                                    </th>
                                    <td>
                                        <input type="text" name="title" value="" v-model="qa.title">
                                    </td>
                                </tr>
                                <tr class="form_inquiry">
                                    <th>内容<span class="req">必須</span>

                                    </th>
                                    <td>
                                        <textarea name="content" id="must" cols="600px" rows="500px" v-model="qa.content" style="padding: 10px 15px"></textarea>
                                    </td>
                                </tr>

                                <tr class="form">

                                    <td rowspan="2" colspan="2">
                                        <label class="container">
                                            <div class="check">
                                                <input type="checkbox" name="radio" v-model="check" value="1" id="1">
                                                <a href="/genaral" target="_blank">利用規約</a>ご同意後、チェックを入れてください。
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

export default {
    components: {Infor},
    data() {
        return {
            cate: null,
            type: null,
            qa:{
                title:null,
                qa_type:null,
                qa_cate:null,
                content:null,
            },
            check:0
        };
    },
    methods: {
        async getQaCate() {
            let { data } = await this.axios.get("api/qa-cate/list", {
                // auth: {
                //     username: "care21@greentechsolutions",
                //     password: "care21greentech@"
                // },
            });
            console.log(data.data)
            this.cate = data.data;
        },
        async getQaType() {
            let { data } = await this.axios.get("api/qa-type/list", {
                // auth: {
                //     username: "care21@greentechsolutions",
                //     password: "care21greentech@"
                // },
            });
            console.log(data.data)
            this.type = data.data;
        },
        async addData(e){
            let jwt = this.$session.get('jwt')
            console.log(this.qa)
            if (this.check === true){
                await this.axios.post("api/qa/add",this.qa,{headers: {"Authorization" : `Bearer `+jwt}}).then((result)=>{
                    // console.log(result)
                    this.$toast.success('Add data success!')
                    this.$router.push("/info");
                }).catch((err) => {
                    if (err.response.data.code === 401){
                        this.$toast.error('Session expired!')
                        this.$router.push("/login");
                    }
                });
                e.preventDefault();
            }else{
                // alert('no')
            }

        }
    },
    computed: {
        // imageUrl() {
        //     return this.banner2.image;
        // },
    },
    async mounted() {
        await this.getQaCate();
        await this.getQaType();
    },
}
</script>

<style scoped>
@import '../../assets/css/confirmation.css';
</style>
