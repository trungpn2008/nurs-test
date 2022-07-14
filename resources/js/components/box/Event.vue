<template>
    <div class="event">
        <div class="event-item" v-for="item of listEvent">
            <b-img :src="item.frames" class="img-frames"></b-img>
            <div class="content-in-img">
                <b-img :src="item.imgLeft" class="img-left"></b-img>
                <div class="content-event">
                    <div class="title-event-row">
                        <b-img :src="item.imgTextLeft"></b-img>
                        <p class="title-event">{{item.textIntro}}</p>
                        <b-img :src="item.imgTextRight"></b-img>
                    </div>
                    <p class="topic-event">{{item.topic}}</p>
                </div>
                <b-img :src="item.imgRight" class="img-right"></b-img>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Event",
    data(){
        return{
            listEvent:[
                {
                    frames:"/images/frontend/image/76423.png",
                    imgLeft:"/images/frontend/image/4464325.png",
                    imgTextLeft:"/images/frontend/image/633456.png",
                    textIntro:"特別企画",
                    imgTextRight:"/images/frontend/image/35643545.png",
                    imgRight:"/images/frontend/image/5423622.png",
                    topic:"介護、なぜ？なに？クイズ",
                },
                {
                    frames:"/images/frontend/image/76423.png",
                    imgLeft:"/images/frontend/image/546354637.png",
                    imgTextLeft:"/images/frontend/image/633456.png",
                    textIntro:"キャンペーン！",
                    imgTextRight:"/images/frontend/image/35643545.png",
                    imgRight:"/images/frontend/image/frweye4564.png",
                    topic:"プレゼント企画",
                },
            ]
        }
    }
}
</script>

<style scoped>

</style>
