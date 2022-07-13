<template>
    <div class="guideline">
        <div class="title-line">
            <p class="text-line">{{ title }}</p>
            <div class="line"></div>
        </div>
        <div class="content-guideline">
            <div class="box-guideline" v-for="item of descriptions">
                <div class="title-line2">
                    <p class="text-line title-box-guideline">{{item.title}}</p>
                    <div class="line"></div>
                </div>
                <div class="descriotion-guideline">
                    <div class="accordion" role="tablist">
                        <b-card no-body class="mb-1" v-for="item1 of item.accordion">
                            <b-card-header header-tag="header" class="p-1" role="tab">
                                <b-button block v-b-toggle="item1.id" variant="info">{{item1.title}}</b-button>
                            </b-card-header>
                            <b-collapse :id="item1.id" accordion="my-accordion" role="tabpanel">
                                <b-card-body>
                                {{ text }}
                                </b-card-body>
                            </b-collapse>
                        </b-card>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "guidelines",
    data() {
        return {
            title: "みんなの法律相談ガイドライン",
            descriptions: [
                {
                    title: '安心介護について',
                    accordion: [
                        {
                            title:"Q1. 安心介護とは何ですか？",
                            id:"q1-1",
                            text:"Q1. 安心介護とは何ですか？"
                        },
                        {
                            title:"Q2. 安心介護のユーザーはどんな人ですか？",
                            id:"q1-2",
                            text:"Q2. 安心介護のユーザーはどんな人ですか？"
                        },
                        {
                            title:"Q3. 専門家の人はどんな資格を持っていますか？",
                            id:"q1-3",
                            text:"Q3. 専門家の人はどんな資格を持っていますか？"
                        },
                        {
                            title:"Q4. 安心介護でできることは、どんなことですか？",
                            id:"q1-4",
                            text:"Q4. 安心介護でできることは、どんなことですか？"
                        },
                        {
                            title:"Q5. 会員になるメリットは何ですか？",
                            id:"q1-5",
                            text:"Q5. 会員になるメリットは何ですか？"
                        },
                    ],
                }, {
                    title: '会員登録について',
                    accordion: [
                        {
                            title:"Q1. 会員登録はどのように行えば良いですか？",
                            id:"q2-1",
                            text:"Q1. 会員登録はどのように行えば良いですか？"
                        },
                        {
                            title:"Q2. パスワードがうまく設定できません",
                            id:"q2-2",
                            text:"Q2. パスワードがうまく設定できません？"
                        },
                        {
                            title:"Q3. 会員登録の認証メールが届きません",
                            id:"q2-3",
                            text:"Q3. 会員登録の認証メールが届きません？"
                        },
                        {
                            title:"Q4. 介護・医療従事者として登録すると何ができますか？",
                            id:"q2-4",
                            text:"Q4. 介護・医療従事者として登録すると何ができますか？"
                        },
                        {
                            title:"Q5. 一般ユーザーとして登録すると何ができますか？",
                            id:"q2-5",
                            text:"Q5. 一般ユーザーとして登録すると何ができますか？"
                        },
                    ],
                }, {
                    title: 'ログインについて',
                    accordion: [
                        {
                            title:"Q1. 会員登録ボタンを押したのにログインができません",
                            id:"q3-1",
                            text:"Q1. 会員登録ボタンを押したのにログインができません？"
                        },
                        {
                            title:"Q2. ログインができなくなりました",
                            id:"q3-2",
                            text:"Q2. ログインができなくなりました？"
                        },
                        {
                            title:"Q3. パスワードを忘れてしまいました",
                            id:"q3-3",
                            text:"Q3. パスワードを忘れてしまいました"
                        },
                        {
                            title:"Q4. 毎回のログインが面倒なのですが、簡単にする方法はありますか？",
                            id:"q3-4",
                            text:"Q4. 毎回のログインが面倒なのですが、簡単にする方法はありますか？"
                        },
                    ],
                },
            ]
        }
    }
}
</script>

<style scoped>

</style>
