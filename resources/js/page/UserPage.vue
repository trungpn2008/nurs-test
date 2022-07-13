<template>
    <div class="register">
        <b-breadcrumb :items="items"></b-breadcrumb>
        <div class="box-register w-800">
            <!--            <p class="title-register">{{title}}</p>-->
            <div class="all-input hiddencam pd-t-40 mt-40">
                <div class="title-line fs-20 mb-40 lh-40 mt-40">
                    <p class="text-line bg-FFFFFF">{{title}}</p>
                    <div class="line"></div>
                </div>
                <avatar @imageFileBase64="getImageFileBase64" :image="users.avatar" />
<!--                <p class="text-center"><b-img src="/images/frontend/icons/2133.png"></b-img>JPEG、GIF、PNG形式</p>-->
                <input-from
                    :data="profile"
                    :value="users"
                    :options="options"
                    :cols="'col-md-12 col-sm-12 col-xs-12'"
                />
                <div class="all-btn">
                    <b-button class="btn-return">みんなの広場</b-button>
                    <b-button class="btn-change">Q&A</b-button>
                </div>
            </div>
        </div>

    </div>
</template>

<script>
import Avatar from "../components/box/Avatar"
import InputFrom from "../components/box/Input"
export default {
    name: "Profile",
    props: {
        options: {
            type: Object,
            default: {
                selected: [],
                gender:[
                    { value: '', text: 'Select gender' },
                    { value: '1', text: '男性' },
                    { value: '2', text: '女性' },
                ],
                birth:[
                    { value: '', text: 'Select year of birth' },
                    { value: '1995', text: '1995' },
                    { value: '1994', text: '1994' },
                    { value: '1993', text: '1993' },
                    { value: '1992', text: '1992' },
                    { value: '1991', text: '1991' },
                    { value: '1990', text: '1990' },
                    { value: '1989', text: '1989' },
                    { value: '1988', text: '1988' },
                    { value: '1987', text: '1987' },
                    { value: '1986', text: '1986' },
                    { value: '1985', text: '1985' },
                ],
                relationship:[
                    { value: '1', text: '選択する' },
                ],
                dementia:[
                    { value: '1', text: '選択する' },
                ],
                degreeofcare:[
                    { value: '1', text: '選択する' },
                ],
                caresituation:[
                    { value: '1', text: '選択する' },
                ],
                checkTern:[
                    { text: '投稿ガイドラインご同意後、チェックを入れてください。', value: '1' },
                ]
            },
        },
    },
    components:{
        InputFrom,Avatar
    },
    data() {
        return {
            title:"ユーザーマイページ",
            btnText:"介建対象否を追加",
            users: {
                gender:"",
                birth:"",
                nickname:"",
                avatar:"/images/frontend/image/avatar.png",
            },
            items: [
                {
                    text: 'トップ',
                    href: '#'
                },
                {
                    text: 'あなたのプロフィール',
                    active: true
                }
            ],
            profile: [

                { key: "multiinput", label: "", type: "multi-input-2",multiInput:[
                        { key: "nickname", label: "ニックネーム", type: "text" ,alert:"必須" },
                        { key: "gender", label: "性別", type: "select-half-row",alert:"必須",labelActive:true },
                        { key: "birth", label: "あなたの生まれた年", type: "select-half-row",alert:"必須",labelActive:true },
                        { key: "content", label: "プロフィール文", type: "textarea" ,alert:"必須" },
                    ] },
                // { key: "checkterm", label: "利用規約ご同意後、チェックを入れてください。", type: "checkbox-term" },
            ],
            profile2: [
                { key: "multiinput", label: "", type: "multi-input-2",multiInput:[
                        { key: "relationship", label: "続柄", type: "select" ,alert:"必須" },
                        { key: "dementia", label: "認知症の有無", type: "select",alert:"必須" },
                        { key: "degreeofcare", label: "要介護度", type: "select",alert:"必須" },
                        { key: "caresituation", label: "介護状況", type: "select",alert:"必須" },
                    ] },

            ],
        }
    },
    methods: {
        getImageFileBase64(data) {
            this.users.avatar = data;
        },
    },
}
</script>

<style scoped lang="scss">
.round-camera{
    display:none !important;
}
</style>
