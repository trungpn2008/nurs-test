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
        <b-button class="btn-register db-rds-10 bg-EA6D8D">{{ btnText }}</b-button>
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
                gender:[
                    { text: '男性', value: '1' },
                    { text: '女性', value: '2' },
                ],
                Contact:[
                    { text: 'メール', value: '1' },
                    { text: '電話', value: '2' },
                    { text: 'ライン', value: '3' },
                    { text: '当サイトからの連絡は受けとらない', value: '4' },
                ],
                selected: [''],
                age:[
                    { value: '', text: 'Select age' },
                    { value: '18-24', text: '18～24歳' },
                    { value: '25-34', text: '25～34歳' },
                    { value: '35-44', text: '35～44歳' },
                    { value: '55-64', text: '55～64歳' },
                    { value: '65+', text: '65歳以上' },
                ],
                checkTern:[
                    { text: '利用規約ご同意後、チェックを入れてください。', value: '1' },
                ]
            },
        },
    },
    components:{
        InputFrom
    },
    data() {
        return {
            title:"新規会員登録",
            btnText: "入力内容を確認",
            users: {
                name:"",
                Furigana:"",
                nickname:"",
                gender:"",
                age:"",
                zipCode:"",
                address1:"",
                address2:"",
                phone:"",
                lineId:"",
                email:"",
                password:"",
                Contact:"",
                checkterm:"",
            },
            items: [
                {
                    text: 'トップ',
                    href: '#'
                },
                {
                    text: '新規会員登録',
                    active: true
                }
            ],
            regis: [
                { key: "name", label: "お名前", type: "text" ,alert:"必須" },
                { key: "Furigana", label: "フリガナ", type: "text" ,alert:"必須" },
                { key: "nickname", label: "ニックネーム", type: "text" ,alert:"必須" },
                { key: "gender", label: "性別", type: "radio" },
                { key: "age", label: "年齢", type: "select" },
                { key: "multiinput", label: "年齢", type: "multi-input",multiInput:[
                        { key: "zipCode", label: "郵便番号入力", type: "text" },
                        { key: "address1", label: "", type: "text" },
                        { key: "address2", label: "番地、マンション部屋番号入力", type: "text" },
                    ] },
                { key: "phone", label: "電話番号", type: "text" },
                { key: "lineId", label: "ラインID", type: "text" },
                { key: "email", label: "メールアドレス", type: "text" ,alert:"必須" },
                { key: "password", label: "パスワード", type: "text" ,alert:"必須" },
                { key: "Contact", label: "連絡方法", type: "radio" ,alert:"必須" },
                { key: "checkterm", label: "利用規約ご同意後、チェックを入れてください。", type: "checkbox-term" },
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
