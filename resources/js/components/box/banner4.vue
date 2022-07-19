<template>
    <div class="box-consultation-method-2">
        <div class="content-consultation-method">
            <p class="text-fisrt-box hidden-xs hidden-sm hidden-md">
                ― 皆様の介護のお悩み掲示板 ―
            </p>
            <div class="text-time-box hidden-xs hidden-sm hidden-md">
                <p class="title-consultation-method">
                    <b-img :src="imageMethod"></b-img>
                    {{ title }}
                </p>
                <div class="txt-time">
                    <p>□□□□□掲示版の説明が入ります□□□□□</p>
                    <p>□□□□□掲示版の説明が入ります□□□□□</p>
                    <p>□□□□□掲示版の説明が入ります□□□□□</p>
                </div>
                <div class="image-box">
                    <b-img src="/images/frontend/image/547657634.png"></b-img>
                </div>
            </div>
            <div
                class="text-time-box1 display-xs display-sm  display-md hidden-lg hidden-xl hidden-xxl hidden-xxx hidden-xxxl">
                <div class="image-box">
                    <b-img src="/images/frontend/image/547657634.png"></b-img>
                </div>
                <p class="text-fisrt-box">
                    ― 皆様の介護のお悩み掲示板 ―
                </p>
                <p class="title-consultation-method">
                    <b-img :src="imageMethod"></b-img>
                    {{ title }}
                </p>

                <div class="txt-time">
                    <p>□□□□□掲示版の説明が入ります□□□□□</p>
                    <p>□□□□□掲示版の説明が入ります□□□□□</p>
                    <p>□□□□□掲示版の説明が入ります□□□□□</p>
                </div>
            </div>

            <p class="des-consultation-method">
                <b-img src="/images/frontend/icons/5645636745.png" class="img-left"></b-img>
                {{ des }}
                <b-img src="/images/frontend/icons/674564.png" class="img-right"></b-img>
            </p>
        </div>
        <div class="contact-method hidden-xs hidden-sm hidden-md">
            <b-container fluid>
                <b-row cols="6">
                    <b-col v-for="bx of boxIcon ">
                        <a :href="bx.href">
                            <div class="item-contact-method">
                                <div class="image-item-contact">
                                    <b-img :src="bx.image" class="image-method"></b-img>
                                </div>
                                <div class="content-contact-method">
                                    <p class="title-contact-method">
                                        {{ bx.title }} <span>{{ bx.text }}</span>
                                    </p>
                                    <!--                                <p class="text-contact-method">-->
                                    <!--                                    {{bx.text}}-->
                                    <!--                                </p>-->
                                </div>
                                <b-img :src="bx.cyclePin" class="cycle-pin-image"></b-img>
                            </div>
                        </a>
                    </b-col>
                </b-row>
            </b-container>
        </div>
        <div
            class="contact-method1 display-xs display-sm  display-md hidden-lg hidden-xl hidden-xxl hidden-xxx hidden-xxxl">
            <b-container fluid>
                <b-row>
                    <b-col cols="12" v-for="item of boxIcon ">
                        <a :href="item.href">
                            <div class="item-contact-method">
                                <div class="content-contact-method">
                                    <b-row>
                                        <!--                                    <b-col cols="6"><b-img :src="item.image" class="image-method"></b-img></b-col>-->
                                        <b-col cols="12" style="display: flex;justify-content: center;">
                                            <b-img :src="item.image" class="image-method"></b-img>
                                            <p class="title-contact-method">
                                                {{ item.title }} <span>{{ item.text }}</span>
                                            </p></b-col>
                                        <!--                                    <b-col cols="5"><p class="text-contact-method">-->
                                        <!--                                        {{item.text}}-->
                                        <!--                                    </p></b-col>-->
                                    </b-row>
                                </div>
                                <b-img v-if="item.active = true" :src="item.cyclePin" class="cycle-pin-image"></b-img>
                            </div>
                        </a>
                    </b-col>
                </b-row>
            </b-container>
        </div>
    </div>
</template>

<script>
export default {
    name: "banner4",
    data() {
        return {
            imageMethod: "/images/frontend/icons/7657.png",
            title: "掲 示 板",
            des: "お気軽にご相談ください ",
            boxIcon: [
                {
                    title: '老人ホームの\n' +
                        '種類',
                    text: 'について',
                    image: "/images/frontend/image/56463.png",
                    href: '#',
                    active: false,
                },
                {
                    title: '老人ホームの\n' +
                        '費用',
                    text: 'について',
                    image: "/images/frontend/image/546345.png",
                    href: '#',
                    active: false,
                },
                {
                    title: '老人ホームの' +
                        '選び方',
                    text: '',
                    image: "/images/frontend/image/4657452.png",
                    href: '#',
                    active: false
                },
                {
                    title: '介護保険制度',
                    text: 'とは',
                    image: "/images/frontend/image/376565.png",
                    href: '#',
                    active: false
                },
                {
                    title: '認知症',
                    text: 'について',
                    image: "/images/frontend/image/347673546.png",
                    href: '#',
                    active: false,
                },
                {
                    title: '在宅介護',
                    text: 'について',
                    image: "/images/frontend/image/3567356.png",
                    href: '#',
                    active: false,
                }
            ]
        }
    }
}
</script>

<style scoped>

</style>
