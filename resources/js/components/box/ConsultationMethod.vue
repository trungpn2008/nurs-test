<template>
    <div class="box-consultation-method">
        <div class="content-consultation-method">
            <p class="title-consultation-method">
                <b-img :src="imageMethod"></b-img>
                {{ title }}
            </p>
            <p class="des-consultation-method">
                {{ des }}
            </p>
        </div>
        <div class="contact-method hidden-xs hidden-sm hidden-md">
            <b-container fluid>
                <b-row cols="5">
                    <b-col v-for="(bx,index) of boxIcon">
                        <a :href="bx.href">
                            <div class="item-contact-method">
                                <b-img :src="bx.image" class="image-method"></b-img>
                                <div class="content-contact-method">
                                    <p class="title-contact-method">
                                        {{ bx.title }}
                                    </p>
                                    <p class="text-contact-method">
                                        {{ bx.text }}
                                    </p>
                                </div>
                                <b-img :src="bx.cyclePin" class="cycle-pin-image"></b-img>
                            </div>
                        </a>
                    </b-col>
                </b-row>
            </b-container>
        </div>
        <div
            class="contact-method display-xs display-sm  display-md hidden-lg hidden-xl hidden-xxl hidden-xxx hidden-xxxl">
            <b-container fluid>
                <b-row>
                    <b-col cols="12" v-for="(item,index) of boxIcon">
                        <a :href="item.href">
                            <div class="item-contact-method">
                                <div class="content-contact-method">
                                    <b-row>
                                        <b-col cols="5"><p class="title-contact-method">
                                            {{ item.title }}
                                        </p></b-col>
                                        <b-col cols="2">
                                            <b-img :src="item.image" class="image-method"></b-img>
                                        </b-col>
                                        <b-col cols="5"><p class="text-contact-method">
                                            {{ item.text }}
                                        </p></b-col>
                                    </b-row>
                                </div>
                                <b-img :src="item.cyclePin" class="cycle-pin-image"></b-img>
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
    name: "ConsultationMethod",
    data() {
        return {
            imageMethod: "/images/frontend/icons/group-method.png",
            title: "相談方法",
            des: "電話、zoomでのご相談は、平日の9：00～18：00の時間帯で受け付けています。掲示板、メール、LINEでのご相談は、24時間受け付ています。",
            boxIcon: [
                {
                    title: '掲示板',
                    text: '受付時間：24時間受付',
                    image: "/images/frontend/icons/pagepin.png",
                    href: '#',
                    cyclePin: "/images/frontend/icons/cyclepin.png"
                },
                {
                    title: 'メール',
                    text: '受付時間：24時間受付',
                    image: "/images/frontend/icons/Vector.png",
                    href: '#',
                    cyclePin: "/images/frontend/icons/cyclepin.png"
                },
                {
                    title: '電　話',
                    text: '受付時間:平日9:00～18:00',
                    image: "/images/frontend/icons/Vector-1.png",
                    href: '#',
                },
                {
                    title: 'zoom',
                    text: '受付時間:平日9:00～18:00',
                    image: "/images/frontend/icons/wx6D6w.png",
                    href: '#',
                },
                {
                    title: 'LINE',
                    text: '受付時間：24時間受付',
                    image: "/images/frontend/icons/logoline.png",
                    href: '#',
                    cyclePin: "/images/frontend/icons/cyclepin.png"
                }
            ]
        }
    }
}
</script>

<style scoped>

</style>
