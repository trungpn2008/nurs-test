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
                    <li><a href="#">質問・相談</a></li>
                </ul>
                <div class="module">
                    <div class="question">
                        <p class="bg-title">
                            <span>
                                質問・相談
                            </span>
                        </p>
                        <div class="info"  v-for="(item, index) in cate">
                            <p class="title">
                                <span>
                                    {{ item.title }}
                                </span>
                            </p>
                            <div class="accordion" role="tablist">
                                <b-card no-body v-for="(item1, index1) in item.content" v-bind:key="item1.id">
                                    <b-card-header header-tag="header" class="p-1" role="tab">
                                        <b-button block v-b-toggle="['accordion-'+index1+'-c'+item1.id]" class="btn-q">{{item1.question}}</b-button>
                                    </b-card-header>
                                    <b-collapse :id="'accordion-'+index1+'-c'+item1.id"  accordion="my-accordion" role="tabpanel">
                                        <b-card-body v-html="item1.answer">
                                        </b-card-body>
                                    </b-collapse>
                                </b-card>
                            </div>
                        </div>
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
            cate: [],
        };
    },
    methods: {
        async getPrivacy() {
            let { data } = await this.axios.get("api/faq-category/list", {
                params: { type: 1 }
                // auth: {
                //     username: "care21@greentechsolutions",
                //     password: "care21greentech@"
                // },
            });
            this.cate = data.data;
        },
    },
    computed: {
    },
    async mounted() {
        await this.getPrivacy();
    },
}
</script>

<style>
@import '../../assets/css/question.css';
</style>
