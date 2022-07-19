<template>
    <div class="info-user">
        <b-breadcrumb :items="items"></b-breadcrumb>
        <div class="box-info-user">
            <div class="box-detail">
                <b-container fluid>
                    <b-row>
                        <b-col cols="12" sm="3">
                            <div class="image-avatar">
                                <b-img src="/images/frontend/image/avatar.png"></b-img>
                            </div>
                        </b-col>
                        <b-col cols="12" sm="9">

                            <div class="text-name-id">
                                <p class="text-id">登緑番号: 1150943312</p>
                                <p class="text-name"> 1150943312さん</p>
                            </div>
                            <div class="detail-info-user">
                                <div class="text-title-profile">
                                    <div class="text-line-right">
                                        <b-img src="/images/frontend/icons/icon-avatar.png"></b-img>
                                        <p>プロフィール</p>
                                        <div class="line-right"></div>
                                    </div>
                                </div>
                                <div class="detail-profile">
                                    <div class="label-text">
                                        <p>性別: </p>
                                        <p>年齢: </p>
                                        <p>参加日: </p>
                                    </div>
                                    <div class="answer-text">
                                        <p>非公開</p>
                                        <p>非公開</p>
                                        <p>2022年05月25日に参加</p>
                                    </div>
                                </div>
                            </div>
                        </b-col>
                    </b-row>
                </b-container>
            </div>

            <div class="description-info-user">
                <b-tabs content-class="mt-3" fill>
                    <b-tab title="質問">
                        <b-card no-body>
                            <b-tabs pills card>
                                <b-tab title="Tab 1" active>
                                    <b-card-text>
                                        <div class="no-result"><p>条件に一致する實問がありません</p></div>
                                    </b-card-text>
                                </b-tab>
                                <b-tab title="Tab 2">
                                    <b-card-text>
                                        <div class="no-result"><p>条件に一致する實問がありません</p></div>
                                    </b-card-text>
                                </b-tab>
                            </b-tabs>
                        </b-card>
                    </b-tab>
                    <b-tab title="回答"><p>回答</p></b-tab>
                    <b-tab title="おすすめ"><p>おすすめ</p></b-tab>
                    <b-tab title="知恵コレ"><p>知恵コレ</p></b-tab>
                </b-tabs>
            </div>

        </div>
    </div>
</template>

<script>
export default {
    name: "InfoUser",
    data() {
        return {
            title: "掲示板投稿",
            items: [
                {
                    text: 'トップ',
                    href: '#'
                },
                {
                    text: '1150943312さんのMy知恵袋',
                    active: true
                }
            ],
        }
    },
}
</script>

<style scoped>

</style>
