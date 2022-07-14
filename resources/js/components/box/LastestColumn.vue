<template>
    <div class="box-list-column">
        <p class="title-list-column">{{ title }}</p>
        <div class="list-column">
            <b-row>
                <b-col cols="12" sm="6" v-for="item of listColumn">
                    <b-img :src="item.image"></b-img>
                    <div class="description">
                        <div class="type-of-cate">
                            <p>{{item.cate}}</p>
                            <p>{{item.type}}</p>
                        </div>
                        <p class="title-item-column">{{item.title}}</p>
                    </div>
                </b-col>
            </b-row>
            <b-button class="btn-show-more">さらに表示する</b-button>
        </div>
    </div>
</template>

<script>
export default {
    name: "LastestColumn",
    data() {
        return {
            imageMethod: "/images/frontend/image/4764533246.png",
            title: "最新コラム",
            des: "お気軽にご相談ください ",
            listColumn: [
                {
                    title: '介護はどこにどう申請するの？ケアマネジャーが介護の第一…',
                    cate: '介護保険制度',
                    image: "/images/frontend/image/4q435423.png",
                    href: '#',
                    type: 'その他',
                },
                {
                    title: '介護はどこにどう申請するの？ケアマネジャーが介護の第一…',
                    cate: '介護保険制度',
                    image: "/images/frontend/image/ga3422343.png",
                    href: '#',
                    type: 'その他',
                },
                {
                    title: '介護はどこにどう申請するの？ケアマネジャーが介護の第一…',
                    cate: '介護保険制度',
                    image: "/images/frontend/image/45re45345.png",
                    href: '#',
                    type: 'その他',
                },
                {
                    title: '介護はどこにどう申請するの？ケアマネジャーが介護の第一…',
                    cate: '介護保険制度',
                    image: "/images/frontend/image/4q435423.png",
                    href: '#',
                    type: 'その他',
                },
                {
                    title: '介護はどこにどう申請するの？ケアマネジャーが介護の第一…',
                    cate: '介護保険制度',
                    image: "/images/frontend/image/4q435423.png",
                    href: '#',
                    type: 'その他',
                },
                {
                    title: '介護はどこにどう申請するの？ケアマネジャーが介護の第一…',
                    cate: '介護保険制度',
                    image: "/images/frontend/image/ga3422343.png",
                    href: '#',
                    type: 'その他',
                },
            ]
        }
    }
}
</script>

<style scoped>

</style>
