<template>
    <div class="hashtag">
        <b-breadcrumb :items="items"></b-breadcrumb>
        <div class="box-list-hashtag">
            <p class="title-hashtag"> ハッシュタグ</p>
            <div class="list-hashtag">
                <b-row>
                    <b-col cols="12" sm="4" v-for="item of listHashtag">
                        <p class="text-hashtag">{{item.text}} <span>({{item.count}})</span></p>
                    </b-col>
                </b-row>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "hashtag",
    data() {
        return {
            items: [
                {
                    text: 'トップ',
                    href: '#'
                },
                {
                    text: 'ハッシュタグ',
                    active: true
                }
            ],
            listHashtag:[
                {
                    text:"#特別養護老人ホーム（特養)",
                    count:"136",
                },
                {
                    text:"#アルツハイマー型認知症",
                    count:"135",
                },
                {
                    text:"#デイサービス",
                    count:"124",
                },
                {
                    text:"#特別養護老人ホーム（特養)",
                    count:"136",
                },
                {
                    text:"#アルツハイマー型認知症",
                    count:"135",
                },
                {
                    text:"#デイサービス",
                    count:"124",
                },
                {
                    text:"#特別養護老人ホーム（特養)",
                    count:"136",
                },
                {
                    text:"#アルツハイマー型認知症",
                    count:"135",
                },
                {
                    text:"#デイサービス",
                    count:"124",
                },
                {
                    text:"#特別養護老人ホーム（特養)",
                    count:"136",
                },
                {
                    text:"#アルツハイマー型認知症",
                    count:"135",
                },
                {
                    text:"#デイサービス",
                    count:"124",
                },
                {
                    text:"#特別養護老人ホーム（特養)",
                    count:"136",
                },
                {
                    text:"#アルツハイマー型認知症",
                    count:"135",
                },
                {
                    text:"#デイサービス",
                    count:"124",
                },
                {
                    text:"#特別養護老人ホーム（特養)",
                    count:"136",
                },
                {
                    text:"#アルツハイマー型認知症",
                    count:"135",
                },
                {
                    text:"#デイサービス",
                    count:"124",
                },
                {
                    text:"#特別養護老人ホーム（特養)",
                    count:"136",
                },
                {
                    text:"#アルツハイマー型認知症",
                    count:"135",
                },
                {
                    text:"#デイサービス",
                    count:"124",
                },
                {
                    text:"#特別養護老人ホーム（特養)",
                    count:"136",
                },
                {
                    text:"#アルツハイマー型認知症",
                    count:"135",
                },
                {
                    text:"#デイサービス",
                    count:"124",
                },
                {
                    text:"#特別養護老人ホーム（特養)",
                    count:"136",
                },
                {
                    text:"#アルツハイマー型認知症",
                    count:"135",
                },
                {
                    text:"#デイサービス",
                    count:"124",
                },
                {
                    text:"#特別養護老人ホーム（特養)",
                    count:"136",
                },
                {
                    text:"#アルツハイマー型認知症",
                    count:"135",
                },
                {
                    text:"#デイサービス",
                    count:"124",
                },
                {
                    text:"#特別養護老人ホーム（特養)",
                    count:"136",
                },
                {
                    text:"#アルツハイマー型認知症",
                    count:"135",
                },
                {
                    text:"#デイサービス",
                    count:"124",
                },
            ]
        }
    },
}
</script>

<style scoped>

</style>
