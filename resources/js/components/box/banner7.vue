<template>
    <div class="box-consultation-method-5">
        <div class="content-consultation-method">
            <b-breadcrumb :items="items" class="hidden-xs hidden-sm hidden-md"></b-breadcrumb>
            <p class="text-fisrt-box">
                ― 介護のプロの相談員をご紹介 ―
            </p>
            <div class="text-time-box">
                <p class="title-consultation-method">
                    <b-img :src="imageMethod"></b-img>
                    {{title}}
                </p>
<!--                <div class="txt-time">-->
<!--                    <p class="tpc">老人ホームの種類</p>-->
<!--                </div>-->
                <div class="image-box">
                    <b-img src="/images/frontend/image/dasdwr323.png"></b-img>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "banner7",
    data() {
        return {
            items: [
                {
                    text: 'トップ',
                    href: '#'
                },
                {
                    text: '掲示板',
                    href: '#'
                },
                {
                    text: '老人ホームの種類',
                    active: true
                }
            ],
            imageMethod: "/images/frontend/icons/ewq3325.png",
            title: "ケアマネジャー紹介",
            des: "お気軽にご相談ください ",
            boxIcon: [
                {
                    title: '老人ホームの\n' +
                        '種類',
                    text: 'について',
                    image:"/images/frontend/image/56463.png",
                    href: '#',
                    active:false,
                },
                {
                    title: '老人ホームの\n' +
                        '費用',
                    text: 'について',
                    image:"/images/frontend/image/546345.png",
                    href: '#',
                    active:false,
                },
                {
                    title: '老人ホームの' +
                        '選び方',
                    text: '',
                    image:"/images/frontend/image/4657452.png",
                    href: '#',
                    active: false
                },
                {
                    title: '介護保険制度',
                    text: 'とは',
                    image:"/images/frontend/image/376565.png",
                    href: '#',
                    active: false
                },
                {
                    title: '認知症',
                    text: 'について',
                    image:"/images/frontend/image/347673546.png",
                    href: '#',
                    active: false,
                },
                {
                    title: '在宅介護',
                    text: 'について',
                    image:"/images/frontend/image/3567356.png",
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
