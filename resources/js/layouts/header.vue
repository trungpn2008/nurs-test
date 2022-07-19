<template>
    <header>
<!--        <div v-if="windowWidth < 768">-->
<!--            mobile-->
<!--        </div>-->
<!--        <div v-else>-->
<!--            destop-->
<!--        </div>-->
            <b-container fluid>
                <b-row class="pd-l-r-40">
                    <b-col xl="4" xs="12" class="pd-0">
                        <div class="logo-page">
                            <a href="/">
                                <b-img src="/images/frontend/image/logo.png"></b-img>
                            </a>
                        </div>
                    </b-col>
                    <b-col xl="8" xs="12" class="">
                        <div class="top-header hidden-xs hidden-sm hidden-md">
                            <div class="search-box">
                                <b-form>
                                    <b-form-input class="input-search-page" placeholder="キーワードを入力ください"></b-form-input>
                                    <b-img src="/images/frontend/icons/search.png" class="icon-search"></b-img>
                                </b-form>
                            </div>
                            <div class="text-number-header">
                                <b-img src="/images/frontend/icons/letter01.png"></b-img>
                                <p class="number-header">0120-000-000</p>
                            </div>
                            <div class="text-open-header">平日 9：00～18：00</div>
                        </div>
                        <div class="menu-header hidden-xs hidden-sm hidden-md">
                            <b-nav>
                                <b-nav-item href="/notice-holiday" class="bd-sl-r-1-000">掲示板</b-nav-item>
                                <b-nav-item href="/notice" class="bd-sl-r-1-000">コラム</b-nav-item>
                                <b-nav-item href="/manager-intro" class="bd-sl-r-1-000">ケアマネジャー紹介</b-nav-item>
                                <b-nav-item href="/faq">FAQ</b-nav-item>
                                <li class="nav-item"><a href="/register" class="btn-register-page">新規会員登録</a></li>
                                <li class="nav-item"><a href="/login" class="btn-login-page">ログイン</a></li>
                                <li class="nav-item"><a href="/notice" class="pd-0"><b-img src="/images/frontend/icons/bell.png" class="icon-bell"></b-img></a></li>
                            </b-nav>
                        </div>
                        <div class="menu-header-mobile display-xs display-sm display-md hidden-lg  hidden-xl hidden-xxl hidden-xxx hidden-xxxl">
                            <b-button v-b-toggle.sidebar-right.sidebar-backdrop class="btn-menu-mobile"><b-img src="/images/frontend/icons/menu-btn-mobile.png"></b-img></b-button>

                            <b-sidebar
                                id="sidebar-backdrop"
                                :backdrop-variant="variant"
                                right
                                width="75%"
                                backdrop
                                no-header
                                shadow
                            >
                                <template #default="{ hide }">
                                    <b-button class="btn-close-mobile" @click="hide"><b-icon-x-lg></b-icon-x-lg></b-button>
                                    <div class="top-header">
                                        <div class="search-box">
                                            <b-form>
                                                <b-form-input class="input-search-page" placeholder="キーワードを入力ください"></b-form-input>
                                                <b-img src="/images/frontend/icons/search.png" class="icon-search"></b-img>
                                            </b-form>
                                        </div>
                                        <div class="btn-register-login-mobile">
                                            <a href="/register" class="btn-register-page">新規会員登録</a>
                                            <a href="/login" class="btn-login-page">ログイン</a>
                                        </div>
                                        <div class="menu-mobile">
                                            <ul>
                                                <li><a href="/notice-holiday">掲示板</a></li>
                                                <li><a href="/notice">コラム</a></li>
                                                <li><a href="/manager-intro">ケアマネジャー紹介</a></li>
                                                <li><a href="/faq">FAQ</a></li>
                                            </ul>
                                        </div>
                                        <div class="text-number-mobile">
                                            <div class="text-number-header">
                                                <b-img src="/images/frontend/icons/letter01.png"></b-img>
                                                <p class="number-header">0120-000-000</p>
                                            </div>
                                            <div class="text-open-header">平日 9：00～18：00</div>
                                        </div>
                                    </div>
                                </template>
                            </b-sidebar>
                        </div>
                    </b-col>
                </b-row>
            </b-container>
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
    methods(){
        this.$emit("windowWidth",0,windowWidth)
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

