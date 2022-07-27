<template>
    <div class="product">
        <p class="title">
            人気記事ランキング

        </p>
        <div class="article" v-for="(item, index) in list">
            <div class="bg-title">
                <p class="num">
                    {{index + 1}}
                </p>
                <p class="image">
                    <img :src="item.image" :alt="item.title">
                </p>
            </div>

            <div class="text-box">
                <p class="date">{{item.date}}</p>
                <p class="note">{{item.cate_name}}</p>
                <div class="text" v-html="item.short_description"></div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            // list: {
            //     image: null,
            //     id: null,
            //     title: null,
            //     short_description: null,
            //     view: null,
            //     date: null,
            //     name: null,
            //     cate_name: null,
            //     cate_type_title: null,
            // },
            list: [],
        };
    },
    methods: {
        async getlist() {
            let {data} = await this.axios.get("api/news/list-popular", {
                params: {per_page: 5}
                // auth: {
                //     username: "care21@greentechsolutions",
                //     password: "care21greentech@"
                // },
            });
            this.list = data.data.data;
        },
    },
    computed: {
        // imageUrl() {
        //     return this.banner.image;
        // },
    },
    async mounted() {
        await this.getlist();
    },
}
</script>

<style>

</style>
