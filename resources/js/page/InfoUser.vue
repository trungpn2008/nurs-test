<template>
    <div class="info-user">
        <b-breadcrumb :items="items"></b-breadcrumb>
        <div class="box-info-user">
            <b-row>
                <b-col cols="3">
                    <div class="image-avatar">
                        <b-img src=""></b-img>
                    </div>
                </b-col>
                <b-col cols="9">
                    <div class="text-name-id">
                        <p class="text-id">登緑番号: 1150943312</p>
                        <p class="text-id">1150943312さん</p>
                    </div>
                    <div class="detail-info-user">
                        <div class="text-title-profile">
                            <b-img src=""></b-img>
                            <p>プロフィール</p>
                        </div>
                        <div class="detail-profile">
                            <p>性別: <span>非公開</span></p>
                            <p>年齢: <span>非公開</span></p>
                            <p>参加日: <span>2022年05月25日に参加</span></p>
                        </div>
                    </div>
                </b-col>
                <div class="description-info-user">
                    <b-tabs content-class="mt-3" fill>
                        <b-tab title="質問">
                            <p>質問</p>
                            <b-card no-body>
                                <b-tabs pills card>
                                    <b-tab title="Tab 1" active><b-card-text>Tab contents 1</b-card-text></b-tab>
                                    <b-tab title="Tab 2"><b-card-text>Tab contents 2</b-card-text></b-tab>
                                </b-tabs>
                            </b-card>
                        </b-tab>
                        <b-tab title="回答"><p>回答</p></b-tab>
                        <b-tab title="おすすめ"><p>おすすめ</p></b-tab>
                        <b-tab title="知恵コレ"><p>知恵コレ</p></b-tab>
                    </b-tabs>
                </div>
            </b-row>
        </div>
    </div>
</template>

<script>
export default {
    name: "InfoUser",
    data() {
        return {
            title:"掲示板投稿",
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
