<template>
    <div class="logout">
        <b-breadcrumb :items="items"></b-breadcrumb>
        <div class="description-logout">
            <div class="title-line fs-20 mb-40 lh-40">
                <p class="text-line bg-FFFFFF">このワードに近いキーワード</p>
                <div class="line"></div>
            </div>
            <div class="content-logout">
                <div class="content-top">
                    <ul>
                        <li>回答やコメントに返信しましたか？</li>
                        <li>ポイントは交換しましたか？</li>
                        <li>退会すると履歴は参照できません。</li>
                    </ul>
                </div>
                <div class="content-bot">
                    <ul>
                        <li>※ 自分のプロフィール、貯めたポイントは全て消去されます。</li>
                        <li>※ただし、Q&Aやみんなの広場での投稿やコメントにつきましては削除されません。あなたのニックネームが「退会済み」になります。</li>
                        <li>※退会ボタン 押すと、登録しているメールアドレス宛に認証メールが配信されます。URLをクリック後、退会となります。</li>
                    </ul>
                </div>
            </div>
            <div class="btn-page-logout">
                <b-button class="btn-return">戻る</b-button>
                <b-button class="btn-logout">ログアウト</b-button>
            </div>

        </div>
    </div>
</template>

<script>
export default {
    name: "logout",
    data() {
        return {
            items: [
                {
                    text: 'トップ',
                    href: '/'
                },
                {
                    text: 'ログアウト',
                    active: true
                }
            ]
        }
    }
}
</script>

<style scoped>

</style>
