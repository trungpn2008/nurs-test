<template>
    <div class="box-consultation-method-1">
        <div class="content-consultation-method">
            <p class="text-fisrt-box hidden-xs hidden-sm hidden-md">
                ― あなたに合う相談方法がみつかる ―
            </p>
            <div class="text-time-box hidden-xs hidden-sm hidden-md">
                <p class="title-consultation-method">
                    <b-img :src="imageMethod"></b-img>
                    {{title}}
                </p>
                <div class="txt-time">
                    <p>電話、zoomでのご相談は、</p>
                    <p>平日の9：00～18：00の時間帯で受け付けています。</p>
                    <p>掲示板、メール、LINEでのご相談は、24時間受け付ています。</p>
                </div>
                <div class="image-box">
                    <b-img src="/images/frontend/image/756774.png"></b-img>
                </div>
            </div>
            <div class="text-time-box1 display-xs display-sm  display-md hidden-lg hidden-xl hidden-xxl hidden-xxx hidden-xxxl">
                <div class="image-box">
                    <b-img src="/images/frontend/image/756774.png"></b-img>
                </div>
                <p class="text-fisrt-box">
                    ― あなたに合う相談方法がみつかる ―
                </p>
                <p class="title-consultation-method">
                    <b-img :src="imageMethod"></b-img>
                    {{title}}
                </p>
                <div class="txt-time">
                    <p>電話、zoomでのご相談は、</p>
                    <p>平日の9：00～18：00の時間帯で受け付けています。</p>
                    <p>掲示板、メール、LINEでのご相談は、24時間受け付ています。</p>
                </div>
            </div>

            <p class="des-consultation-method">
                <b-img src="/images/frontend/icons/5645636745.png" class="img-left"></b-img>
                {{des}}
                <b-img src="/images/frontend/icons/674564.png" class="img-right"></b-img>
            </p>
        </div>
        <div class="contact-method hidden-xs hidden-sm hidden-md">
            <b-row cols="5">
                <b-col v-for="bx of boxIcon ">
                    <a :href="bx.href">
                        <div class="item-contact-method">
                            <div class="image-item-contact">
                                <b-img :src="bx.image" class="image-method"></b-img>
                            </div>
                            <div class="content-contact-method">
                                <p class="title-contact-method">
                                    {{bx.title}}
                                </p>
                                <p class="text-contact-method">
                                    {{bx.text}}
                                </p>
                            </div>
                            <b-img :src="bx.cyclePin" class="cycle-pin-image"></b-img>
                        </div>
                    </a>
                </b-col>
            </b-row>
        </div>
        <div class="contact-method1 display-xs display-sm  display-md hidden-lg hidden-xl hidden-xxl hidden-xxx hidden-xxxl">
            <b-row>
                <b-col cols="12" v-for="item of boxIcon ">
                    <a :href="item.href">
                        <div class="item-contact-method">
                            <div class="content-contact-method">
                                <b-row>
                                    <b-col cols="5"><p class="title-contact-method">
                                        {{item.title}}
                                    </p></b-col>
                                    <b-col cols="2"><b-img :src="item.image" class="image-method"></b-img></b-col>
                                    <b-col cols="5"><p class="text-contact-method">
                                        {{item.text}}
                                    </p></b-col>
                                </b-row>
                            </div>
                            <b-img v-if="item.active = true" :src="item.cyclePin" class="cycle-pin-image"></b-img>
                        </div>
                    </a>
                </b-col>
            </b-row>
        </div>
    </div>
</template>

<script>
export default {
    name: "banner3",
    data() {
        return {
            imageMethod: "/images/frontend/icons/7657.png",
            title: "相談方法",
            des: "皆様の介護のお悩み募集中",
            boxIcon: [
                {
                    title: '掲示板',
                    text: '受付時間：24時間受付',
                    image:"/images/frontend/icons/pagepin.png",
                    href: '#',
                    active:true,
                    cyclePin:"/images/frontend/icons/cyclepin.png"
                },
                {
                    title: 'メール',
                    text: '受付時間：24時間受付',
                    image:"/images/frontend/icons/Vector.png",
                    href: '#',
                    active:true,
                    cyclePin:"/images/frontend/icons/cyclepin.png"
                },
                {
                    title: '電　話',
                    text: '受付時間:平日9:00～18:00',
                    image:"/images/frontend/icons/Vector-1.png",
                    href: '#',
                    active: false
                },
                {
                    title: 'zoom',
                    text: '受付時間:平日9:00～18:00',
                    image:"/images/frontend/icons/wx6D6w.png",
                    href: '#',
                    active: false
                },
                {
                    title: 'LINE',
                    text: '受付時間：24時間受付',
                    image:"/images/frontend/icons/logoline.png",
                    href: '#',
                    active: true,
                    cyclePin:"/images/frontend/icons/cyclepin.png"
                }
            ]
        }
    }
}
</script>

<style scoped>

</style>
