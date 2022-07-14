<template>
    <div class="questions-and-answers">
        <p class="title-questions-and-answers">{{title}}</p>
        <div class="box-search">
            <b-row>
                <b-col cols="12" sm="8">
                    <div class="search-input">
                        <b-form>
                            <b-form-input class="input-search-qa  mb-35" placeholder="検索"></b-form-input>
                            <b-img src="/images/frontend/icons/search.png" class="icon-search"></b-img>
                        </b-form>
                    </div>
                    <div class="keywords">
                        <div class="title-line fs-20 mb-40 lh-40">
                            <p class="text-line">このワードに近いキーワード</p>
                            <div class="line"></div>
                        </div>
<!--                        <p class="text-keywords-search">このワードに近いキーワード</p>-->
                        <div class="list-keywords-search">
                            <ul>
                                <li v-for="(index,item) of listKeyword" :key="index"><a :href="item.href">{{item.text}}</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="list-result-search-keywords">
                        <p class="title-count-result-search-keywords">51,812件見つかりました</p>
                        <div class="content-result-search-keywords">
                            <a :href="item1.href" class="item-result" v-for="(index,item1) of listresult" :key="index">
                                <b-row>
                                    <b-col cols="2" sm="2" md="2" lg="1">
                                        <b-img :src="item1.image"></b-img>
                                    </b-col>
                                    <b-col cols="10" sm="10" md="10" lg="11">
                                        <div class="item-description-result">
                                            <div class="title-item-result"><p>{{item1.title}}</p></div>
                                            <div class="content-item-result">{{item1.content}}</div>
                                            <div class="time-item-result">{{item1.time}}</div>
                                        </div>
                                    </b-col>
                                </b-row>
                            </a>
                        </div>
                    </div>
                </b-col>
                <b-col cols="12" sm="4">
                    <div class="relate-keywords">
                        <div class="title-line fs-20 mb-40 lh-40">
                            <p class="text-line">関連キーワード</p>
                            <div class="line"></div>
                        </div>
                        <div class="list-relate-keywords-search">
                            <b-row>
                                <b-col cols="6" sm="6" v-for="(index,item2) of listRelateKeyword" :key="index">
                                    <a :href="item2.href">{{item2.text}}</a>
                                </b-col>
                            </b-row>
                        </div>
                    </div>
                </b-col>
            </b-row>
        </div>
    </div>
</template>

<script>
export default {
    name: "QuestionsAndAnswers",
    data() {
        return {
            title:"弊社に寄せられたよくあるご質問と回答をご紹介いたします。",
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
            listresult:[
                {
                    title:"特養の順番待ち名簿はどれ位のペースで更新されますか？",
                    href:"#",
                    content:"特別養護老人ホームの名簿の順番について教えてください。\n" +
                        "昨年要介護４で特別養護老人ホームに申し込み、１２月に申込んだ施設から名簿の順番が繰り上がったことと現在の状況確認の電話がありました。今年３月に要介護５に区分が変更され、その旨その施設に連絡したのですが、その後何の連絡もありません。名簿の順番は年に何回ぐらい改定されるのでしょうか？",
                    image:"/images/frontend/image/avatar-draw.png",
                    time:"2022/05/15 18:28",
                },{
                    title:"特養の順番待ち名簿はどれ位のペースで更新されますか？",
                    href:"#",
                    content:"特別養護老人ホームの名簿の順番について教えてください。\n" +
                        "昨年要介護４で特別養護老人ホームに申し込み、１２月に申込んだ施設から名簿の順番が繰り上がったことと現在の状況確認の電話がありました。今年３月に要介護５に区分が変更され、その旨その施設に連絡したのですが、その後何の連絡もありません。名簿の順番は年に何回ぐらい改定されるのでしょうか？",
                    image:"/images/frontend/image/avatar-draw.png",
                    time:"2022/05/15 18:28",
                },{
                    title:"特養の順番待ち名簿はどれ位のペースで更新されますか？",
                    href:"#",
                    content:"特別養護老人ホームの名簿の順番について教えてください。\n" +
                        "昨年要介護４で特別養護老人ホームに申し込み、１２月に申込んだ施設から名簿の順番が繰り上がったことと現在の状況確認の電話がありました。今年３月に要介護５に区分が変更され、その旨その施設に連絡したのですが、その後何の連絡もありません。名簿の順番は年に何回ぐらい改定されるのでしょうか？",
                    image:"/images/frontend/image/avatar-draw.png",
                    time:"2022/05/15 18:28",
                },{
                    title:"特養の順番待ち名簿はどれ位のペースで更新されますか？",
                    href:"#",
                    content:"特別養護老人ホームの名簿の順番について教えてください。\n" +
                        "昨年要介護４で特別養護老人ホームに申し込み、１２月に申込んだ施設から名簿の順番が繰り上がったことと現在の状況確認の電話がありました。今年３月に要介護５に区分が変更され、その旨その施設に連絡したのですが、その後何の連絡もありません。名簿の順番は年に何回ぐらい改定されるのでしょうか？",
                    image:"/images/frontend/image/avatar-draw.png",
                    time:"2022/05/15 18:28",
                },{
                    title:"特養の順番待ち名簿はどれ位のペースで更新されますか？",
                    href:"#",
                    content:"特別養護老人ホームの名簿の順番について教えてください。\n" +
                        "昨年要介護４で特別養護老人ホームに申し込み、１２月に申込んだ施設から名簿の順番が繰り上がったことと現在の状況確認の電話がありました。今年３月に要介護５に区分が変更され、その旨その施設に連絡したのですが、その後何の連絡もありません。名簿の順番は年に何回ぐらい改定されるのでしょうか？",
                    image:"/images/frontend/image/avatar-draw.png",
                    time:"2022/05/15 18:28",
                },{
                    title:"特養の順番待ち名簿はどれ位のペースで更新されますか？",
                    href:"#",
                    content:"特別養護老人ホームの名簿の順番について教えてください。\n" +
                        "昨年要介護４で特別養護老人ホームに申し込み、１２月に申込んだ施設から名簿の順番が繰り上がったことと現在の状況確認の電話がありました。今年３月に要介護５に区分が変更され、その旨その施設に連絡したのですが、その後何の連絡もありません。名簿の順番は年に何回ぐらい改定されるのでしょうか？",
                    image:"/images/frontend/image/avatar-draw.png",
                    time:"2022/05/15 18:28",
                },{
                    title:"特養の順番待ち名簿はどれ位のペースで更新されますか？",
                    href:"#",
                    content:"特別養護老人ホームの名簿の順番について教えてください。\n" +
                        "昨年要介護４で特別養護老人ホームに申し込み、１２月に申込んだ施設から名簿の順番が繰り上がったことと現在の状況確認の電話がありました。今年３月に要介護５に区分が変更され、その旨その施設に連絡したのですが、その後何の連絡もありません。名簿の順番は年に何回ぐらい改定されるのでしょうか？",
                    image:"/images/frontend/image/avatar-draw.png",
                    time:"2022/05/15 18:28",
                },{
                    title:"特養の順番待ち名簿はどれ位のペースで更新されますか？",
                    href:"#",
                    content:"特別養護老人ホームの名簿の順番について教えてください。\n" +
                        "昨年要介護４で特別養護老人ホームに申し込み、１２月に申込んだ施設から名簿の順番が繰り上がったことと現在の状況確認の電話がありました。今年３月に要介護５に区分が変更され、その旨その施設に連絡したのですが、その後何の連絡もありません。名簿の順番は年に何回ぐらい改定されるのでしょうか？",
                    image:"/images/frontend/image/avatar-draw.png",
                    time:"2022/05/15 18:28",
                },{
                    title:"特養の順番待ち名簿はどれ位のペースで更新されますか？",
                    href:"#",
                    content:"特別養護老人ホームの名簿の順番について教えてください。\n" +
                        "昨年要介護４で特別養護老人ホームに申し込み、１２月に申込んだ施設から名簿の順番が繰り上がったことと現在の状況確認の電話がありました。今年３月に要介護５に区分が変更され、その旨その施設に連絡したのですが、その後何の連絡もありません。名簿の順番は年に何回ぐらい改定されるのでしょうか？",
                    image:"/images/frontend/image/avatar-draw.png",
                    time:"2022/05/15 18:28",
                },{
                    title:"特養の順番待ち名簿はどれ位のペースで更新されますか？",
                    href:"#",
                    content:"特別養護老人ホームの名簿の順番について教えてください。\n" +
                        "昨年要介護４で特別養護老人ホームに申し込み、１２月に申込んだ施設から名簿の順番が繰り上がったことと現在の状況確認の電話がありました。今年３月に要介護５に区分が変更され、その旨その施設に連絡したのですが、その後何の連絡もありません。名簿の順番は年に何回ぐらい改定されるのでしょうか？",
                    image:"/images/frontend/image/avatar-draw.png",
                    time:"2022/05/15 18:28",
                },{
                    title:"特養の順番待ち名簿はどれ位のペースで更新されますか？",
                    href:"#",
                    content:"特別養護老人ホームの名簿の順番について教えてください。\n" +
                        "昨年要介護４で特別養護老人ホームに申し込み、１２月に申込んだ施設から名簿の順番が繰り上がったことと現在の状況確認の電話がありました。今年３月に要介護５に区分が変更され、その旨その施設に連絡したのですが、その後何の連絡もありません。名簿の順番は年に何回ぐらい改定されるのでしょうか？",
                    image:"/images/frontend/image/avatar-draw.png",
                    time:"2022/05/15 18:28",
                },
            ],
            listKeyword:[
                {
                    text:"老人ホームの種類",
                    href:"#",
                },
                {
                    text:"老人ホーム",
                    href:"#",
                },
                {
                    text:"種類",
                    href:"#",
                },
                {
                    text:"老人ホームの種類",
                    href:"#",
                },
                {
                    text:"老人ホームの種類",
                    href:"#",
                },
                {
                    text:"老人ホームの種類",
                    href:"#",
                },
                {
                    text:"老人ホームの種類",
                    href:"#",
                },
            ],
            listRelateKeyword:[
                {
                    text:"老人ホームの種類",
                    href:"#",
                },
                {
                    text:"老人ホームの種類",
                    href:"#",
                },
                {
                    text:"老人ホームの種類",
                    href:"#",
                },
                {
                    text:"老人ホームの種類",
                    href:"#",
                },
                {
                    text:"老人ホームの種類",
                    href:"#",
                },
                {
                    text:"老人ホームの種類",
                    href:"#",
                },
            ]
        }
    },
}
</script>

<style scoped>

</style>
