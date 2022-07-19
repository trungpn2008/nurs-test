<template>
    <div class="box-list-column">
        <p class="title-box c-4e8dc3 bd-c-4e8dc3">{{ title }}</p>
        <div class="list-column">
            <b-container fluid class="pd-0">
                <b-row>
                    <b-col cols="6" sm="6" class="item-list-column" v-for="(item,index) of listColumn" :key="index">
                        <b-img :src="item.image" class="image-item"></b-img>
                        <div class="description">
                            <div class="type-of-cate">
                                <p>
                                    <b-img src="/images/frontend/icons/53453452.png"></b-img>
                                    {{ item.cate }}
                                </p>
                                <p>
                                    <b-img src="/images/frontend/icons/543543623.png"></b-img>
                                    {{ item.type }}
                                </p>
                            </div>
                            <p class="title-item-column">{{ item.title }}</p>
                        </div>
                    </b-col>
                </b-row>
            </b-container>
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
