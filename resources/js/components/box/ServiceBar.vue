<template>
    <div class="service-bar">
        <ul>
            <li>
                <b-dropdown text="フィルター">
                    <template #button-content>
                        <b-img src="/images/frontend/icons/slider.png"></b-img>
                        フィルター
                    </template>
                    <b-dropdown-item href="#">An item</b-dropdown-item>
                    <b-dropdown-item href="#">Another item</b-dropdown-item>
                </b-dropdown>
            </li>
            <li>
                <div class="service-item-bar">
                    <a href="#">おすすめ</a>
                </div>
            </li>
            <li>
                <div class="service-item-bar">
                    <a href="#" class="bg-FF6673 c-fff last-item-bar">回答急募！</a>
                </div>
            </li>
            <li>

            </li>
        </ul>
        <div class="service-slide-bar">
            <div class="swiper slide-bar">
                <div class="swiper-wrapper">
                    <div class="swiper-slide swiper-slide-service">
                        <div class="service-item-bar">
                            <a href="#">認知症</a>
                        </div>
                    </div>
                    <div class="swiper-slide swiper-slide-service"><div class="service-item-bar"><a href="#">介護食</a></div></div>
                    <div class="swiper-slide swiper-slide-service"><div class="service-item-bar"><a href="#">老人ホームの選び方</a></div></div>
                    <div class="swiper-slide swiper-slide-service"><div class="service-item-bar"><a href="#">在宅介護</a></div></div>
                    <div class="swiper-slide swiper-slide-service"><div class="service-item-bar"><a href="#">介護費用</a></div></div>
                    <div class="swiper-slide swiper-slide-service"><div class="service-item-bar"><a href="#">アルツハイマー型認知症</a></div></div>
                    <div class="swiper-slide swiper-slide-service"><div class="service-item-bar"><a href="#">特別養護老人ホーム（特養）</a></div></div>
                    <div class="swiper-slide swiper-slide-service"><div class="service-item-bar"><a href="#">認知症</a></div></div>
                    <div class="swiper-slide swiper-slide-service"><div class="service-item-bar"><a href="#">認知症</a></div></div>
                </div>

<!--                <div class="swiper-button-prev"><b-img src="/images/frontend/icons/pre.png"></b-img></div>-->
<!--                <div class="swiper-pagination"></div>-->
            </div>
            <div class="swiper-button-next"><b-img src="/images/frontend/icons/next.png"></b-img></div>
        </div>


    </div>
</template>

<script>
export default {
    name: "ServiceBar",
    mounted() {
        var swiperSlideBar = new Swiper(".slide-bar", {
            slidesPerView: "auto",
            spaceBetween: 5,
            slidesPerGroup: 5,
            loop: false,
            loopFillGroupWithBlank: true,
            // pagination: {
            //     el: ".swiper-pagination",
            //     clickable: true,
            // },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
        });

    }
}
</script>

<style scoped>

</style>
