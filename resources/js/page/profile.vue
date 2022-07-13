<template>
    <div class="register">
        <b-breadcrumb :items="items"></b-breadcrumb>
        <p class="title-register">{{title}}</p>
        <avatar @imageFileBase64="getImageFileBase64" :image="users.avatar" />
        <input-from
            :data="profile"
            :value="users"
            :options="options"
            :name="name"
            :cols="'col-md-12 col-sm-12 col-xs-12'"
        />
        <input-from
            :data="profile2"
            :value="users"
            :options="options"
            :name="name"
            :cols="'col-md-12 col-sm-12 col-xs-12'"
        />
        <b-button class="btn-add-or-edit">{{ btnText }}</b-button>
        <b-button class="btn-add-or-edit">戻る</b-button>
        <b-button class="btn-add-or-edit">変更</b-button>
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
                selected: [''],
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
            title:"あなたのプロフィール",
            btnText:"介建対象否を追加",
            users: {
                gender:"",
                birth:"",
                nickname:"",
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
                { key: "nickname", label: "ニックネーム", type: "text" ,alert:"必須" },
                { key: "multiinput", label: "年齢", type: "multi-input",multiInput:[
                        { key: "gender", label: "性別", type: "select-half-row",alert:"必須",labelActive:true },
                        { key: "birth", label: "あなたの生まれた年", type: "select-half-row",alert:"必須",labelActive:true },
                    ] },
                { key: "checkterm", label: "利用規約ご同意後、チェックを入れてください。", type: "checkbox-term" },
            ],
            profile2: [
                { key: "relationship", label: "続柄", type: "select" ,alert:"必須" },
                { key: "dementia", label: "認知症の有無", type: "select",alert:"必須" },
                { key: "degreeofcare", label: "要介護度", type: "select",alert:"必須" },
                { key: "caresituation", label: "介護状況", type: "select",alert:"必須" },
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

<style scoped>
.avatar {
    position: relative;
img {
    display: block;
}
.round-camera {
    position: absolute;
    right: 0;
    bottom: 0;
    width: 35px;
    height: 35px;
    border-radius: 50%;
    background-color: #e4e6eb;
    border: 2px solid white;
    transform: translate(-50%, -50%);
.round_circle_camera {
    color: #333;
    font-size: 20px;
    position: absolute;
    top: 45%;
    left: 50%;
    transform: translate(-50%, -50%);
}
}
}
</style>
