<template>
    <section>
        <div class="mainimg no">
            <div class="text-box">
                <ul class="bread">
                    <li><a href="#">トップ </a></li>
                    <li><a href="#">プロフィール</a></li>
                </ul>

                <div class="info">
                    <div class="bg-title">
                        <p class="note">
                            ― 皆様の介護のお悩み掲示板 ―
                        </p>
                        <p class="title">
							<span>
								掲 示 板
							</span>
                        </p>
                    </div>

                    <p class="text">
                        老人ホームの種類
                    </p>
                    <p class="image">
                        <img src="img/icon02.png" alt="">
                    </p>
                    <p class="att">
                        ※任意5,000文字以内
                    </p>
                    <div class="care">
                        <p class="title">
							<span>
								介護対象者のプロフィール1
							</span>
                        </p>
                        <div class="info-box">
                            <label for="">
                                続柄<span>必須</span>
                            </label>
                            <select name="" id="">
                                <option value="0">
                                    選択する
                                </option>
                                <option value="0">
                                    選択する
                                </option>
                                <option value="0">
                                    選択する
                                </option>
                            </select>
                            <label for="">
                                認知症の有無<span>必須</span>
                            </label>
                            <select name="" id="">
                                <option value="0">
                                    選択する
                                </option>
                                <option value="0">
                                    選択する
                                </option>
                                <option value="0">
                                    選択する
                                </option>
                            </select>
                            <label for="">
                                要介護度<span>必須</span>
                            </label>
                            <select name="" id="">
                                <option value="0">
                                    選択する
                                </option>
                                <option value="0">
                                    選択する
                                </option>
                                <option value="0">
                                    選択する
                                </option>
                            </select>
                            <label for="">
                                介護状況<span>必須</span>
                            </label>
                            <select name="" id="">
                                <option value="0">
                                    選択する
                                </option>
                                <option value="0">
                                    選択する
                                </option>
                                <option value="0">
                                    選択する
                                </option>
                            </select>
                            <p class="btn">
                                <a href="#">
                                    <span>介建対象否を追加</span>

                                </a>
                            </p>
                        </div>
                    </div>
                    <ul class="list-btn">
                        <li><a href="#">
                            戻る
                        </a></li>
                        <li><a href="#">変更</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="main">
            <div class="content">
                <!-- ~*~*~*~*~ module start ~*~*~*~*~ -->
                <!-- {$c8_Contents} -->

                <ul class="bread">
                    <li><a href="#">
                        トップ
                    </a></li>
                    <li><a href="#">1150943312さんのMy知恵袋</a></li>

                </ul>
                <div class="module">
                    <div class="info">
                        <div class="inner">
                            <p class="image">
                                <img src="img/user_small.png" alt="">
                            </p>
                            <div class="text-box">
                                <p class="att">
                                    登緑番号: 1150943312
                                </p>
                                <p class="num">
                                    1150943312さん
                                </p>
                                <p class="user">
									<span>
										プロフィール
									</span>
                                </p>
                                <div class="info-box">
                                    <p class="text">
                                        性別:
                                        <span>
											非公開
										</span>
                                    </p>
                                    <p class="text">
                                        年齢:
                                        <span>
											非公開
										</span>
                                    </p>
                                    <p class="text">
                                        参加日:
                                        <span>
											2022年05月25日に参加
										</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <ul class="list">
                            <li><a href="#">
                                質問
                            </a></li>
                            <li><a href="#">回答</a></li>
                            <li><a href="#">おすすめ</a></li>
                            <li><a href="#">知恵コレ</a></li>
                        </ul>
                        <ul class="list-btn">
                            <li><a href="#">
                                すべて
                            </a></li>
                            <li><a href="#">回答受付中</a></li>
                            <li><a href="#">解決済み</a></li>
                            <li><a href="#">ベストアンサー未選択</a></li>
                            <li><a href="#">取り消し•削除</a></li>
                            <li><a href="#">
                                <img src="img/icon32.png" alt="">
                            </a></li>
                        </ul>
                        <p class="note">
                            条件に一致する實問がありません
                        </p>
                    </div>


                </div>
                <div class="module">
                    <div class="index_banner break">
                        <div class="box">
                            <div class="method">
                                <div class="text-box">
                                    <p class="bg-title">
										<span>
											相談方法
										</span>
                                    </p>
                                    <p class="text">
                                        電話、zoomでのご相談は、平日の9：00～18：00の時間帯で受け付けています。<br/>
                                        掲示板、メール、LINEでのご相談は、24時間受け付ています。
                                    </p>
                                </div>

                            </div>
                            <Infor />
                        </div>
                    </div>
                </div>

                <!-- ~*~*~*~*~ module end ~*~*~*~*~ -->
            </div>
            <!-- .content -->

        </div>
    </section>
</template>

<script>
import Infor from '../../components/Infor.vue';
export default {
    components: { Infor }
}
</script>

<style scoped>
@import '../../assets/css/info.css';
</style>
