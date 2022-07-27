<template>
    <div class="category" :style="{
                                        'background': 'url(' + imageUrl + ') left center no-repeat'}">
        <p class="term">
            <span v-html="banner.intro"></span>
        </p>
        <p class="att" v-html="banner.description"></p>
    </div>
</template>

<script>
export default {
    data() {
        return {
            banner: {
                image_left: null,
                title: null,
                image_right: null,
                image: null,
                intro: null,
                intro2: null,
                description: null,
                list_image: [],
            },
        };
    },
    methods: {
        async getbanner() {
            let {data} = await this.axios.get("api/images/detail", {
                params: {type: 6}
                // auth: {
                //     username: "care21@greentechsolutions",
                //     password: "care21greentech@"
                // },
            });
            this.banner = data.data;
        },
    },
    computed: {
        imageUrl() {
            return this.banner.image;
        },
    },
    async mounted() {
        await this.getbanner();
    },
}
</script>

<style>

</style>
