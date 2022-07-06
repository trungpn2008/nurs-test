<template>
    <div class="search-box">
        <b-row>
            <b-col cols="6" offset="3">
                <b-card no-body>
                    <b-tabs pills card>
                        <b-tab title="キーワードから探す">
                            <b-card-text>content</b-card-text>
                        </b-tab>
                        <b-tab title="悩み、相談から探す" active>
                            <b-card-text>
                                <div class="list-seach-box">
                                    <b-row>
                                        <b-col cols="4">
                                            <a href="#">
                                                <div class="item-tab">
                                                    <p class="title-item-tab">介護保険制度</p>
                                                    <p class="des-item-tab">介護保険制度、負担金額、ケアマネジャー等に関する相談一覧</p>
                                                </div>
                                            </a>
                                        </b-col>
                                        <b-col cols="4">
                                            <a href="#">
                                                <div class="item-tab">
                                                    <p class="title-item-tab">要介護認定</p>
                                                    <p class="des-item-tab">要介護認定、認定調査や区分変更申請等に関する相談一覧</p>
                                                </div>
                                            </a>
                                        </b-col>
                                        <b-col cols="4">
                                            <a href="#">
                                                <div class="item-tab">
                                                    <p class="title-item-tab">認知症</p>
                                                    <p class="des-item-tab">認知症の予防や疑い、各種症状、対処法に関する相談一覧</p>
                                                </div>
                                            </a>
                                        </b-col>
                                        <b-col cols="4">
                                            <a href="#">
                                                <div class="item-tab">
                                                    <p class="title-item-tab">在宅介護</p>
                                                    <p class="des-item-tab">在宅介護での介助方法、仕事との調
                                                        整等に関する相談一覧</p>
                                                </div>
                                            </a>
                                        </b-col>
                                        <b-col cols="4">
                                            <a href="#">
                                                <div class="item-tab">
                                                    <p class="title-item-tab">施設介護</p>
                                                    <p class="des-item-tab">介護施設の選び方、サービス内容、
                                                        トラブル等に関する相談一覧</p>
                                                </div>
                                            </a>
                                        </b-col>
                                        <b-col cols="4">
                                            <a href="#">
                                                <div class="item-tab">
                                                    <p class="title-item-tab">介護サービス</p>
                                                    <p class="des-item-tab">在宅介護で利用できる介護サービス
                                                        等に関する相談一覧</p>
                                                </div>
                                            </a>
                                        </b-col>
                                        <b-col cols="4">
                                            <a href="#">
                                                <div class="item-tab">
                                                    <p class="title-item-tab">福祉用具</p>
                                                    <p class="des-item-tab">福祉用具の使い方、レンタル、購入
                                                        等に関する相談一覧</p>
                                                </div>
                                            </a>
                                        </b-col>
                                        <b-col cols="4">
                                            <a href="#">
                                                <div class="item-tab">
                                                    <p class="title-item-tab">高齢者の食事 </p>
                                                    <p class="des-item-tab">高齢者の食事、水分補給、嚥下等に
                                                        関する相談一覧</p>
                                                </div>
                                            </a>
                                        </b-col>
                                        <b-col cols="4">
                                            <a href="#">
                                                <div class="item-tab">
                                                    <p class="title-item-tab">介護疲れ </p>
                                                    <p class="des-item-tab">介護うつ、ノイローゼ、家族トラブ
                                                        ル等に関する相談一覧</p>
                                                </div>
                                            </a>
                                        </b-col>
                                        <b-col cols="4">
                                            <a href="#">
                                                <div class="item-tab">
                                                    <p class="title-item-tab">介護費用 </p>
                                                    <p class="des-item-tab">介護費用の不安、費用負担軽減等に
                                                        関する相談一覧</p>
                                                </div>
                                            </a>
                                        </b-col>
                                        <b-col cols="4">
                                            <a href="#">
                                                <div class="item-tab">
                                                    <p class="title-item-tab">高齢者の入院 </p>
                                                    <p class="des-item-tab">高齢者の入退院、転院、退院後の居
                                                        場所等に関する相談一覧</p>
                                                </div>
                                            </a>
                                        </b-col>
                                        <b-col cols="4">
                                            <a href="#">
                                                <div class="item-tab">
                                                    <p class="title-item-tab">遺産・相続 </p>
                                                    <p class="des-item-tab">遺産相続、成年後見、空き家問題等
                                                        に関する相談一覧</p>
                                                </div>
                                            </a>
                                        </b-col>
                                        <b-col cols="4">
                                            <a href="#">
                                                <div class="item-tab">
                                                    <p class="title-item-tab">何でも介護相談 </p>
                                                    <p class="des-item-tab">カテゴリに分類できない疑問や悩み
                                                        をまとめました</p>
                                                </div>
                                            </a>
                                        </b-col>
                                    </b-row>
                                </div>
                            </b-card-text>
                        </b-tab>
                        <b-tab title="都道府県から探す">
                            <b-card-text>
                                <div class="table-chosse-search">
                                    <b-form-group>
                                        <div class="row-choose-search">
                                            <b-row>
                                                <b-col cols="3">
                                                    <p class="title-row-choosse">北海道・東北</p>
                                                </b-col>
                                                <b-col cols="9">
                                                    <div class="input-choose-search">
                                                        <b-row cols="5">
                                                            <b-col><b-form-radio   name="value" value="A"> 北海道</b-form-radio></b-col>
                                                            <b-col><b-form-radio   name="value" value="A"> 青森県</b-form-radio></b-col>
                                                            <b-col><b-form-radio   name="value" value="A"> 岩手県</b-form-radio></b-col>
                                                            <b-col><b-form-radio   name="value" value="A"> 宮城県</b-form-radio></b-col>
                                                            <b-col><b-form-radio   name="value" value="A"> 秋田県</b-form-radio></b-col>
                                                            <b-col><b-form-radio   name="value" value="A"> 山形県</b-form-radio></b-col>
                                                            <b-col><b-form-radio   name="value" value="A"> 福島県</b-form-radio></b-col>
                                                        </b-row>
                                                    </div>
                                                </b-col>
                                            </b-row>
                                        </div>
                                        <div class="row-choose-search">
                                            <b-row>
                                                <b-col cols="3">
                                                    <p class="title-row-choosse">関東</p>
                                                </b-col>
                                                <b-col cols="9">
                                                    <div class="input-choose-search">
                                                        <b-row cols="5">
                                                            <b-col><b-form-radio   name="value1" value="A"> 茨城県</b-form-radio></b-col>
                                                            <b-col><b-form-radio   name="value1" value="A"> 栃木県</b-form-radio></b-col>
                                                            <b-col><b-form-radio   name="value1" value="A"> 群馬県</b-form-radio></b-col>
                                                            <b-col><b-form-radio   name="value1" value="A"> 埼玉県</b-form-radio></b-col>
                                                            <b-col><b-form-radio   name="value1" value="A"> 千葉県</b-form-radio></b-col>
                                                            <b-col><b-form-radio   name="value1" value="A"> 東京都</b-form-radio></b-col>
                                                            <b-col><b-form-radio   name="value1" value="A"> 神奈川県</b-form-radio></b-col>
                                                        </b-row>
                                                    </div>
                                                </b-col>
                                            </b-row>
                                        </div>
                                        <div class="row-choose-search">
                                            <b-row>
                                                <b-col cols="3">
                                                    <p class="title-row-choosse">北陸・甲信越</p>
                                                </b-col>
                                                <b-col cols="9">
                                                    <div class="input-choose-search">
                                                        <b-row cols="5">
                                                            <b-col><b-form-radio   name="value2" value="A"> 新潟県</b-form-radio></b-col>
                                                            <b-col><b-form-radio   name="value2" value="A"> 富山県</b-form-radio></b-col>
                                                            <b-col><b-form-radio   name="value2" value="A"> 石川県</b-form-radio></b-col>
                                                            <b-col><b-form-radio   name="value2" value="A"> 福井県</b-form-radio></b-col>
                                                            <b-col><b-form-radio   name="value2" value="A"> 山梨県</b-form-radio></b-col>
                                                            <b-col><b-form-radio   name="value2" value="A"> 長野県</b-form-radio></b-col>
                                                        </b-row>
                                                    </div>
                                                </b-col>
                                            </b-row>
                                        </div>
                                        <div class="row-choose-search">
                                            <b-row>
                                                <b-col cols="3">
                                                    <p class="title-row-choosse">東海</p>
                                                </b-col>
                                                <b-col cols="9">
                                                    <div class="input-choose-search">
                                                        <b-row cols="5">
                                                            <b-col><b-form-radio   name="value3" value="A"> 岐阜県</b-form-radio></b-col>
                                                            <b-col><b-form-radio   name="value3" value="A"> 静岡県</b-form-radio></b-col>
                                                            <b-col><b-form-radio   name="value3" value="A"> 愛知県</b-form-radio></b-col>
                                                            <b-col><b-form-radio   name="value3" value="A"> 三重県</b-form-radio></b-col>
                                                        </b-row>
                                                    </div>
                                                </b-col>
                                            </b-row>
                                        </div>
                                        <div class="row-choose-search">
                                            <b-row>
                                                <b-col cols="3">
                                                    <p class="title-row-choosse">近畿</p>
                                                </b-col>
                                                <b-col cols="9">
                                                    <div class="input-choose-search">
                                                        <b-row cols="5">
                                                            <b-col><b-form-radio   name="value4" value="A"> 滋賀県</b-form-radio></b-col>
                                                            <b-col><b-form-radio   name="value4" value="A"> 京都府</b-form-radio></b-col>
                                                            <b-col><b-form-radio   name="value4" value="A"> 大阪府</b-form-radio></b-col>
                                                            <b-col><b-form-radio   name="value4" value="A"> 兵庫県</b-form-radio></b-col>
                                                            <b-col><b-form-radio   name="value4" value="A"> 奈良県</b-form-radio></b-col>
                                                            <b-col><b-form-radio   name="value4" value="A"> 和歌山県</b-form-radio></b-col>
                                                        </b-row>
                                                    </div>
                                                </b-col>
                                            </b-row>
                                        </div>
                                        <div class="row-choose-search">
                                            <b-row>
                                                <b-col cols="3">
                                                    <p class="title-row-choosse">中国・四国</p>
                                                </b-col>
                                                <b-col cols="9">
                                                    <div class="input-choose-search">
                                                        <b-row cols="5">
                                                            <b-col><b-form-radio   name="value5" value="A"> 鳥取県</b-form-radio></b-col>
                                                            <b-col><b-form-radio   name="value5" value="A"> 島根県</b-form-radio></b-col>
                                                            <b-col><b-form-radio   name="value5" value="A"> 岡山県</b-form-radio></b-col>
                                                            <b-col><b-form-radio   name="value5" value="A"> 広島県</b-form-radio></b-col>
                                                            <b-col><b-form-radio   name="value5" value="A"> 山口県</b-form-radio></b-col>
                                                            <b-col><b-form-radio   name="value5" value="A"> 徳島県</b-form-radio></b-col>
                                                            <b-col><b-form-radio   name="value5" value="A"> 香川県</b-form-radio></b-col>
                                                            <b-col><b-form-radio   name="value5" value="A"> 愛媛県</b-form-radio></b-col>
                                                            <b-col><b-form-radio   name="value5" value="A"> 高知県</b-form-radio></b-col>
                                                        </b-row>
                                                    </div>
                                                </b-col>
                                            </b-row>
                                        </div>
                                        <div class="row-choose-search">
                                            <b-row>
                                                <b-col cols="3">
                                                    <p class="title-row-choosse">九州・沖縄</p>
                                                </b-col>
                                                <b-col cols="9">
                                                    <div class="input-choose-search">
                                                        <b-row cols="5">
                                                            <b-col><b-form-radio   name="value6" value="A"> 福岡県</b-form-radio></b-col>
                                                            <b-col><b-form-radio   name="value6" value="A"> 佐賀県</b-form-radio></b-col>
                                                            <b-col><b-form-radio   name="value6" value="A"> 長崎県</b-form-radio></b-col>
                                                            <b-col><b-form-radio   name="value6" value="A"> 熊本県</b-form-radio></b-col>
                                                            <b-col><b-form-radio   name="value6" value="A"> 大分県</b-form-radio></b-col>
                                                            <b-col><b-form-radio   name="value6" value="A"> 宮崎県</b-form-radio></b-col>
                                                            <b-col><b-form-radio   name="value6" value="A"> 鹿児島県</b-form-radio></b-col>
                                                            <b-col><b-form-radio   name="value6" value="A"> 沖縄県</b-form-radio></b-col>
                                                        </b-row>
                                                    </div>
                                                </b-col>
                                            </b-row>
                                        </div>
                                    </b-form-group>
                                    <div class="btn-choose-search">
                                        <a href="#">このエリアで絞り込む</a>
                                    </div>
                                </div>
                            </b-card-text>
                        </b-tab>
                    </b-tabs>
                </b-card>
            </b-col>
        </b-row>
    </div>
</template>

<script>
export default {
    name: "SearchBox"
}
</script>

<style scoped>

</style>
