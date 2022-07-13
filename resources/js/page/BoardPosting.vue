<template>
    <div class="register">
        <b-breadcrumb :items="items"></b-breadcrumb>
        <p class="title-register">{{title}}</p>
        <input-from
            :data="post"
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
    name: "BoardPosting",
    props: {
        options: {
            type: Object,
            default: {
                selected: [1],
                category:[
                    { value: 1, text: '老人ホームの種類' },
                    { value: '2', text: '老人ホームの費用' },
                    { value: '3', text: '老人ホームの選び方' },
                    { value: '4', text: '介護保険制度とは' },
                    { value: '5', text: '認知症について' },
                    { value: '6', text: '在宅介護について' },
                    { value: '7', text: 'その他' },
                ],
                category1:[
                    { value: '1', text: '介護付き有料老人ホーム' },
                    { value: '2', text: '住宅型有料老人ホーム' },
                    { value: '3', text: 'サービス付き高齢者向け住宅' },
                    { value: '4', text: 'グループホーム' },
                    { value: '5', text: 'ケアハウス' },
                    { value: '6', text: '特別養護老人ホーム' },
                    { value: '7', text: '介護老人保健施設' },
                    { value: '8', text: '介護医療院' },
                ],
                checkTern:[
                    { text: '投稿ガイドラインご同意後、チェックを入れてください。', value: '1' },
                ]
            },
        },
    },
    components:{
        InputFrom
    },
    data() {
        return {
            title:"掲示板投稿",
            btnText:"投稿する",
            users: {
                category:"",
                category1:"",
                title:"",
                content:"",
                checkterm:"",
            },
            items: [
                {
                    text: 'トップ',
                    href: '#'
                },
                {
                    text: '掲示板投稿',
                    active: true
                }
            ],
            post: [
                { key: "multiinput", label: "カテゴリー  必須", type: "multi-input",multiInput:[
                        { key: "category", label: "", type: "select-half-row" },
                        { key: "category1", label: "", type: "select-half-row" },
                    ],alert:"必須" },
                { key: "title", label: "お名前", type: "text" ,alert:"必須" },
                { key: "content", label: "フリガナ", type: "editor" ,alert:"必須" },
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
