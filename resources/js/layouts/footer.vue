<template>
    <footer>
<!--        <b-container fluid>-->
<!--            <b-row>-->
<!--                <b-col xl="4" xs="12">-->
        <ConsultationMethod></ConsultationMethod>
        <div class="footer">
            <div class="footer-left bd-sl-r-1-000 hidden-xs hidden-sm hidden-md">
                <div class="logo-page-footer">
                    <b-img src="/images/frontend/image/logo.png"></b-img>
                </div>
                <div class="info-footer">
                    <p class="text-address">〒530-0003 大阪市北区堂島2-2-2近鉄堂島ビル10F</p>
                    <b-row>
                        <b-col xl="6" xs="6">TEL.06-6456-5633</b-col>
                        <b-col xl="6" xs="6">FAX.06-6456-5642</b-col>
                    </b-row>
                </div>
            </div>

            <!--                </b-col>-->
            <!--                <b-col xl="3" xs="12">-->
            <div class="footer-mid bd-sl-r-1-000 hidden-xs hidden-sm hidden-md">
                <ul>
                    <li><a href="/about">介護なんでも相談室</a></li>
                    <li><a href="/faq">FAQ</a></li>
                    <li><a href="/posting-guidelines">投稿ガイドライン</a></li>
                    <li><a href="/terms-of-service">利用規約</a></li>
                    <li><a href="/privacy-policy">プライバシーポリシー</a></li>
                    <li><a href="/operating-company">運営会社</a></li>
                </ul>
            </div>
            <!--                </b-col>-->
            <!--                <b-col xl="5" xs="12">-->
            <div class="footer-right hidden-xs hidden-sm hidden-md">
                <p class="text-group-company">グループ会社</p>
                <b-row cols="3">
                    <b-col><a href="#">ケア21コーポレートサイト</a></b-col>
                    <b-col><a href="#">たのしい職場</a></b-col>
                    <b-col><a href="#">未来ケアカレッジ</a></b-col>
                    <b-col><a href="#">ケア21施設検索サイト</a></b-col>
                    <b-col><a href="#">RiRus</a></b-col>
                    <b-col><a href="#">未来ケアワーカー</a></b-col>
                    <b-col><a href="#">ケア21メディカル</a></b-col>
                    <b-col><a href="#">みらいスターズ</a></b-col>
                </b-row>
            </div>
            <!--                </b-col>-->
            <!--            </b-row>-->
            <!--        </b-container>-->
            <b-container class="display-xs display-sm  display-md hidden-lg hidden-xl hidden-xxl hidden-xxx hidden-xxxl">
                <b-row>
                    <b-col cols="12">
                        <div class="footer-left">
                            <div class="logo-page-footer">
                                <b-img src="/images/frontend/image/logo.png"></b-img>
                            </div>
                            <div class="info-footer">
                                <p class="text-address">〒530-0003 大阪市北区堂島2-2-2近鉄堂島ビル10F</p>
                                <b-row>
                                    <b-col xl="6" cols="6">TEL.06-6456-5633</b-col>
                                    <b-col xl="6" cols="6">FAX.06-6456-5642</b-col>
                                </b-row>
                            </div>
                        </div>
                    </b-col>
                    <b-col cols="12">
                        <div class="footer-mid">
                            <ul>
                                <li><a href="/about">介護なんでも相談室</a></li>
                                <li><a href="/faq">FAQ</a></li>
                                <li><a href="/posting-guidelines">投稿ガイドライン</a></li>
                                <li><a href="/terms-of-service">利用規約</a></li>
                                <li><a href="/privacy-policy">プライバシーポリシー</a></li>
                                <li><a href="/operating-company">運営会社</a></li>
                            </ul>
                        </div>
                    </b-col >
                    <b-col cols="12">
                        <div class="footer-right">
                            <p class="text-group-company">グループ会社</p>
                            <b-row cols="3">
                                <b-col><a href="#">ケア21コーポレートサイト</a></b-col>
                                <b-col><a href="#">たのしい職場</a></b-col>
                                <b-col><a href="#">未来ケアカレッジ</a></b-col>
                                <b-col><a href="#">ケア21施設検索サイト</a></b-col>
                                <b-col><a href="#">RiRus</a></b-col>
                                <b-col><a href="#">未来ケアワーカー</a></b-col>
                                <b-col><a href="#">ケア21メディカル</a></b-col>
                                <b-col><a href="#">みらいスターズ</a></b-col>
                            </b-row>
                        </div>
                    </b-col>
                </b-row>
            </b-container>
        </div>
    </footer>
</template>

<script>
import ConsultationMethod from "../components/box/ConsultationMethod.vue"
export default {
    name: "FrontFooter",
    components:{
        ConsultationMethod
    }
}
</script>

<style scoped>

</style>
