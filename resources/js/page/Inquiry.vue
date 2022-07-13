<template>
    <div class="register">
        <b-breadcrumb :items="items"></b-breadcrumb>
        <p class="title-register">{{title}}</p>
        <input-from
            :data="regis"
            :value="users"
            :options="options"
            :name="name"
            :cols="'col-md-12 col-sm-12 col-xs-12'"
        />
        <div class="text-accept">個人情報の利用目的に同意のうえ、送信ボタンを押してください。</div>
        <div class="text-des">事務局から差し上げた内容に関しては、問合せいただいた個人宛てに差し上げたものです。内容の一部、または全部を転載・二次利用することはご遠慮ください。
            回答に時間がかかることがございます。また、頂いたご意見・お問合せすべてにはご返事を差し上げられない場合がございます。</div>
        <b-button class="btn-inquiry">{{ btnText }}</b-button>
    </div>
</template>

<script>
import InputFrom from "../components/box/Input"
export default {
    name: "Register",
    props: {
        options: {
            type: Object,
            default: {
                inquirytype:[
                    { text: 'ログイン（パスワード紛失等）に関するお問い合わせ', value: '1' },
                    { text: 'サイトの操作方法に関するお問い合わせ', value: '2' },
                    { text: 'サイト内のコンテンツに対するお問い合わせ', value: '3' },
                    { text: '各コンテンツに対するご意見・ご要望', value: '4' },
                    { text: '規約違反ユーザの通報', value: '5' },
                    { text: 'その他（サイト全般）', value: '6' },
                ],
            },
        },
    },
    components:{
        InputFrom
    },
    data() {
        return {
            title:"お問い合わせ",
            btnText: "入力内容を確認",
            users: {
                name:"",
                email:"",
                emailconfirm:"",
                inquirytype:"",
                questionsconsultation:"",
            },
            items: [
                {
                    text: 'トップ',
                    href: '#'
                },
                {
                    text: 'お問い合わせ',
                    active: true
                }
            ],
            regis: [
                { key: "multiinput", label: "年齢", type: "multi-input",multiInput:[
                        { key: "name", label: "お名前", type: "text"  },
                        { key: "email", label: "メールアドレス", type: "text"  },
                        { key: "emailconfirm", label: "メールアドレス確認", type: "text", notetext:'※運営事務局よりご返信させていただく際に必要となりますので、お間違いのないようご入力ください' },
                        { key: "inquirytype", label: "お問い合わせの種類", type: "radio" },
                        { key: "questionsconsultation", label: "ご質問・ご相談内容", type: "editor" },
                    ] },
            ],
        }
    },
    // methods: {
    //     changeDataSelect(key, value) {
    //         this.$emit("selectData", key, value);
    //     },
    // },
}
</script>

<style scoped>

</style>
