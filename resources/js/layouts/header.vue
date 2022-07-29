<template>
    <section>
        <button type="button" class="drawer-toggle drawer-hamburger">
            <span class="sr-only"></span>
            <span class="drawer-hamburger-icon"></span>
        </button>
        <nav class="drawer-nav">
            <div class="drawer-menu">
                <div class="search">
                    <input type="text" value="" placeholder="キーワードを入力ください">
                    <p class="image">
                        <img :src="require('../assets/img/icon_search.png')" alt="">
                    </p>
                </div>
                <ul class="list-btn">
                    <li>
                        <a href="/registration">新規会員登録</a>
                    </li>
                    <li>
                        <a class="login" href="/login">ログイン</a>
                    </li>
                </ul>
                <ul class="list">
                    <li><a href="/news">掲示板</a></li>
                    <li><a href="/introduction">コラム</a></li>
                    <li><a href="/news_details">ケアマネジャー紹介</a></li>
                    <li><a href="/faq">FAQ</a></li>
                </ul>
                <div class="info-box">
                    <p class="att">
                        <span>
                            0120-000-000
                        </span>
                    </p>
                    <p class="time">
                        平日 9：00～18：00
                    </p>
                </div>
            </div>
        </nav>
        <header id="header">
            <div class="header_sp">
                <p class="h-logo_sp wink">
                    <a class="h-logo__link" href="/"><img :src="require('../assets/img/logo.png')"
                            alt="{$c8_CompanyName}"></a>
                </p>
                <p class="image">
                    <img :src="require('../assets/img/icon_bell.png')" alt="">
                </p>
            </div>

            <div class="h-box">
                <div class="h-box__left">
                    <p class="h-logo wink">
                        <a class="h-logo__link" href="/"><img :src="require('../assets/img/logo.png')"
                                alt="{$c8_CompanyName}"></a>
                    </p>
                </div>
                <div class="h-box__right">
                    <div class="h-info">
                        <div class="info-box">
                            <div class="h-search">
                                <form action="">
                                    <input type="text" placeholder="キーワードを入力ください" value=""/>
                                    <p class="image">
                                        <img :src="require('../assets/img/icon_search.png')" alt=""/>
                                    </p>
                                </form>
                            </div>
                            <p class="h-tel">
                                <span>
                                    0120-000-000
                                </span>
                            </p>
                        </div>
                        <p class="h-time">
                            平日 9：00～18：00
                        </p>

                    </div>
                    <nav class="gnav">
                        <ul class="gnav-list">
                            <li class="gnav-list__item" data-current="index">
                                <a class="gnav-list__link" href="/news">掲示板</a>
                            </li>
                            <li class="gnav-list__item" data-current="concept">
                                <a class="gnav-list__link" href="/introduction">コラム</a>
                            </li>
                            <li class="gnav-list__item" data-current="voice">
                                <a class="gnav-list__link" href="/news_details">ケアマネジャー紹介</a>
                            </li>
                            <li class="gnav-list__item" data-current="faq">
                                <a class="gnav-list__link" href="/faq">FAQ</a>
                            </li>
                        </ul>
                        <ul class="h-list">
                            <li><a href="/registration">新規会員登録</a></li>
                            <li><a class="login" href="/login">ログイン</a></li>
                            <li><a href="#">
                                    <img :src="require('../assets/img/icon_bell.png')" alt="">
                                </a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </header>
    </section>
</template>

<script>
export default {
    name: "FrontHeader",
    async mounted() {
        // let jwt = this.$session.get('jwt');
        // let { data } = await this.axios.get("api/customer/check-expired", {
        //     headers: {"Authorization" : `Bearer `+jwt},
        //     // auth: {
        //     //     username: "care21@greentechsolutions",
        //     //     password: "care21greentech@"
        //     // },
        // }.catch((err) => {
        //     // console.log(err.response.data.code)
        //     if (err.response.data.code === 401){
        //         $(".login").html('プロフィール').data('href','/info');
        //     }
        // }));
        // $(".login").html('ログイン').data('href','/login');


    }
}
</script>

<style scoped>
.image-center{
    display: block;
    margin: 0 auto;
}
</style>

