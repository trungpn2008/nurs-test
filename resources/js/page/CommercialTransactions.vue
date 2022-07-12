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
                    {{item.text}}
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "CommercialTransactions",
    data() {
        return {
            title: "特定商取引に関する法律に基づく表示",
            descriptions: [
                {
                    title: '提供業者',
                    text: '株式会社ヤマップ',
                },
                {
                    title: '運営統括責任者',
                    text: '春山 慶彦',
                },
                {
                    title: '所在地',
                    text: '福岡市博多区博多駅前3-23-20 博多AGビル6F',
                },
                {
                    title: '代表電話番号',
                    text: '092-710-5511',
                },
                {
                    title: '利用料',
                    text: '当サイト上・当アプリ上で表示している有料サービス利用額です。',
                },
                {
                    title: '利用料以外に発生する料金等',
                    text: 'サイトの閲覧、コンテンツのダウンロード、お問い合わせ等の際の電子メールの送受信時などに、所定の通信料が発生します。',
                },
                {
                    title: 'サービス開始時期',
                    text: 'プレミアムサービスについては有料登録をし、ステータス更新後にご利用可能です。',
                },
                {
                    title: 'ダウンロードファイルの使用',
                    text: 'JPEGにてご使用できます。',
                },
                {
                    title: '返品についての特約事項',
                    text: '電子商品としての性質上、返品／キャンセルには応じられません。',
                },
                {
                    title: '解約条件・解約方法',
                    text: '銀行振込みにおいて自動的に課金が継続されることはありません。解約については ヘルプセンター を参照ください。',
                }
            ]
        }
    }
}
</script>

<style scoped>

</style>
