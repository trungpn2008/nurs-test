<template>
    <div class="box-consultation-method-3">
        <div class="content-consultation-method">
            <p class="text-fisrt-box hidden-xs hidden-sm hidden-md">
                ― 介護の今をコラム形式でわかりやすく紹介 ―
            </p>
            <div class="text-time-box hidden-xs hidden-sm hidden-md">
                <p class="title-consultation-method">
                    <b-img :src="imageMethod"></b-img>
                    {{title}}
                </p>
                <div class="txt-time">
                    <p>□□□□□掲示版の説明が入ります□□□□□</p>
                    <p>□□□□□掲示版の説明が入ります□□□□□</p>
                    <p>□□□□□掲示版の説明が入ります□□□□□</p>
                </div>
                <div class="image-box">
                    <b-img src="/images/frontend/image/34565635.png"></b-img>
                </div>
            </div>
            <div class="text-time-box1 display-xs display-sm  display-md hidden-lg hidden-xl hidden-xxl hidden-xxx hidden-xxxl">
                <div class="image-box">
                    <b-img src="/images/frontend/image/34565635.png"></b-img>
                </div>
                <p class="text-fisrt-box">
                    ― 介護の今をコラム形式でわかりやすく紹介 ―
                </p>
                <p class="title-consultation-method">
                    <b-img :src="imageMethod"></b-img>
                    {{title}}
                </p>
                <div class="txt-time">
                    <p>□□□□□掲示版の説明が入ります□□□□□</p>
                    <p>□□□□□掲示版の説明が入ります□□□□□</p>
                    <p>□□□□□掲示版の説明が入ります□□□□□</p>
                </div>

            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "banner5",
    data() {
        return {
            imageMethod: "/images/frontend/image/4764533246.png",
            title: "コ ラ ム",
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
