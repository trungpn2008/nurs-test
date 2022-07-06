<template>
    <header>
        <!--        <b-container fluid>-->
        <!--            <b-row>-->
        <div v-if="windowWidth < 768">
            mobile
        </div>
        <div v-else>
            destop
        </div>
        <b-container fluid>
            <div class="header-top">
                <p>介護相談 悩み、不安の相談・解決なら「介護なんでも相談室」</p>
                <a href="" class="menu-top">
                    <b-img right src="/images/frontend/icons/pull-down.png" alt="menu" width="25"></b-img>
                </a>
            </div>
            <div class="header-mid">
                <b-row class="h-100">
                    <b-col>
                        <div class="box-center-top-bot">
                            <p class="title-logo">介護なんでも相談室</p>
                        </div>
                    </b-col>
                    <b-col cols="2">
                        <div class="box-center-top-bot">
                            <p class="text-phone-header">0120-000-000</p>
                            <p class="text-time-header fs-16">平日9：00～18：00</p>
                        </div>
                    </b-col>
                    <b-col cols="1" class="bg-FFF3B8">
                        <div class="box-center-top-bot">
                            <b-img center src="/images/frontend/icons/help.png" width="30"></b-img>
                            <p class="text-faq fs-16">質問・相談</p>
                        </div>
                    </b-col>
                </b-row>
            </div>
        </b-container>
        <div class="header-bot">
            <div class="horizontal-menu">
                <ul class="menu-h-header">
                    <b-media tag="li" class="pd-t-b-5"><a href="/">掲示板</a></b-media>
                    <b-media tag="li" class="pd-t-b-5"><a href="/">コラム</a></b-media>
                    <b-media tag="li" class="pd-t-b-5"><a href="/">ケアマネジャー紹介</a></b-media>
                    <b-media tag="li" class="pd-t-b-5"><a href="/">FAQ</a></b-media>
                    <b-media tag="li" class="pd-t-b-5"><a href="/">
                        <b-img center src="/images/frontend/icons/search.png" width="25"></b-img>
                    </a></b-media>
                    <b-media tag="li" class="cycle-box"><a href="/">
                        <b-img center src="/images/frontend/icons/notification.png" width="25"></b-img>
                    </a></b-media>
                    <b-media tag="li" class="rectangle-box"><a href="/">
                        <b-img center src="/images/frontend/icons/menu.png" width="17"
                               class="fl-left pd-t-b-5 mr-5"></b-img>
                        <b-img center src="/images/frontend/icons/male-user.png" width="25" class="fl-left"></b-img>
                    </a></b-media>
                </ul>
            </div>
        </div>
        <!--            </b-row>-->
        <!--        </b-container>-->
    </header>
</template>

<script>
export default {
    name: "FrontHeader",
    data() {
        return {
            windowWidth: window.innerWidth,
            flag:false
        }
    },
    mounted() {
        window.onresize = () => {
            this.windowWidth = window.innerWidth
        }
    }
}
</script>

<style scoped>

</style>

