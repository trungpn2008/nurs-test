<template>
    <div class="post-complete">
        <b-breadcrumb :items="items"></b-breadcrumb>
        <div class="description-complete">
            <div class="content-complete">
                <p>お申し込みありがとうございます。
                    入力が完了いたしました。
                    ご入力いただきました情報は、無事送信されました。
                    ご紹介者様には、ポイント付与後、
                    ご入力いただいたメールアドレスへご連絡させていたたきますので、
                    今しばらくお待ちください。</p>
            </div>
            <div class="btn-page-complete">
                <b-button class="btn-closeup">閉じる</b-button>
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
                    href: '#'
                },
                {
                    text: '掲示板投稿',
                    href: '#'
                },
                {
                    text: '確認',
                    href: '#'
                },
                {
                    text: '完了',
                    active: true
                }
            ]
        }
    }
}
</script>

<style scoped>

</style>
