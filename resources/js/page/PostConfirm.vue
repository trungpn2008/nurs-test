<template>
    <div class="post-confirm">
        <b-breadcrumb :items="items"></b-breadcrumb>
        <div class="description-confirm">
            <div class="content-confirm">
                <ul>
                    <li>お名前: 長長 </li>
                    <li>フリガナ: 長長長長長長長長長長 </li>
                    <li>ニックネーム: 長長長長長長長長長</li>
                    <li>メールアドレス: 長長長長長長長長長長長長長 </li>
                    <li>パスワード: 長長長長長長長長長長長長長長長長 </li>
                    <li>連絡方法: メール</li>
                </ul>
            </div>
            <div class="btn-page-confirm">
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
                    active: true
                }
            ]
        }
    }
}
</script>

<style scoped>

</style>
