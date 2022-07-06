<template>
    <div class="swiper mySwiper pd-l-r-40 pd-t-b-30">

        <div class="text-box-slide">
            <b-container fluid>
                <b-row>
                    <b-col cols="2"><p class="fs-24 fw-bold">今週のご相談</p></b-col>
                    <b-col cols="7"><p class="fs-14 text-center lh-36 fw-bold">介護の疑問、不安ございませんか！？ケア21の介護のプロ・専門家があなたの質問や悩みに答えます。</p></b-col>
                    <b-col cols="2"><p class="fs-14 lh-36 text-deco-unln fw-bold">すべて表示（11件）</p></b-col>
                    <b-col cols="1">
                        <div class="button-navi-slide">
                            <div class="swiper-button-next slide-home-next"><b-img src="/images/frontend/icons/next.png"></b-img></div>
                            <div class="swiper-button-prev slide-home-prev "><b-img src="/images/frontend/icons/pre.png"></b-img></div>
                        </div>
                    </b-col>
                </b-row>
            </b-container>

        </div>
        <div class="swiper-wrapper pd-t-b-12">
            <div class="swiper-slide swiper-slide-banner">
                <b-img src="/images/frontend/image/pixta_42818806_M-thumb-1000x667-8725.png"></b-img>
                <div class="box-image-slide">
                    <div class="box-category-title">
                        <a href="#" class="name-category">老人ホームの選び方</a>
                        <p class="title-image">新規会員登録でケアマネジャーが、無料
                            で介護相談に対応</p>
                    </div>
                    <div class="tag-image-bot-left">
                        <ul>
                            <li><span>＃おむつ</span><span>＃介護疲れ</span></li>
                            <li><span>＃おむつ</span><span>＃介護疲れ</span></li>
                            <li><span>＃おむつ</span><span>＃介護疲れ</span></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="swiper-slide swiper-slide-banner">
                <b-img src="/images/frontend/image/pixta_36351427_S.png"></b-img>
                <div class="box-image-slide">
                    <div class="box-category-title">
                        <a href="#" class="name-category bg-0B6FCA">老人ホームの選び方</a>
                        <p class="title-image">新規会員登録でケアマネジャーが、無料
                            で介護相談に対応</p>
                    </div>
                    <div class="tag-image-bot-left">
                        <ul>
                            <li><span>＃おむつ</span><span>＃介護疲れ</span></li>
                        </ul>
                    </div>
                    <div class="tag-image-top-right">
                        <ul>
                            <li><a href="#" class="bg-FF89FF">＃おむつ</a></li>
                            <li><a href="#" class="bg-00ACD1">＃おむつ</a></li>
                            <li><a href="#" class="bg-B4D009">＃おむつ</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="swiper-slide swiper-slide-banner">
                <b-img src="/images/frontend/image/1958d6ce6ee8461ae5a916355edb1303_m.png"></b-img>
                <div class="box-image-slide">
                    <div class="box-category-title">
                        <a href="#" class="name-category bg-D1A300">老人ホームの選び方</a>
                        <p class="title-image">新規会員登録でケアマネジャーが、無料
                            で介護相談に対応</p>
                    </div>
                    <div class="tag-image-bot-left">
                        <ul>
                            <li><span>＃おむつ</span><span>＃介護疲れ</span></li>
                        </ul>
                    </div>
                    <div class="tag-image-top-right">
                        <ul>
                            <li><a href="#" class="bg-FF89FF">＃おむつ</a></li>
                            <li><a href="#" class="bg-00ACD1">＃おむつ</a></li>
                            <li><a href="#" class="bg-B4D009">＃おむつ</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="swiper-pagination"></div>
    </div>
</template>

<script>
export default {
    name: "SliderHome",
    mounted() {
        var swiper = new Swiper(".mySwiper", {
            slidesPerView: 2.5,
            spaceBetween: 30,
            // pagination: {
            //     el: ".swiper-pagination",
            //     clickable: true
            // }
            navigation: {
                nextEl: ".slide-home-next",
                prevEl: ".slide-home-prev",
            },
        });
    }
}

</script>

<style scoped>

</style>
