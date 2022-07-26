<template>
    <section>
        <div class="mainimg no">
            <div class="text-box">
                <ul class="bread">
                    <li><a href="#">トップ </a></li>
                    <li><a href="#">掲示板投稿</a></li>
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
                    <li><a href="#">新規会員登録</a></li>
                </ul>
                <div class="module registration">
                    <p class="title">
                        掲示板投稿
                    </p>
                    <div id="contact_form">
                        <form action="/static/php/contact.php" method="post" id="inquiry-form">
                            <input type="hidden" name="thanksurl" value="/thanks.php" class="errPosRight">
                            <input type="hidden" name="s" value="02" class="errPosRight">
                            <table class="form_table">
                                <tbody>
                                <tr class="form_name">
                                    <th>カテゴリー 必須
                                        <span class="req">必須</span>
                                    </th>
                                    <td>
                                        <select name="" id="">
                                            <option value="0">老人ホームの種類</option>
                                            <option value="0">老人ホームの種類</option>

                                            <option value="0">老人ホームの費用</option>

                                            <option value="0">老人ホームの選び方</option>
                                            <option value="0">介護保険制度とは</option>
                                            <option value="0">認知症について</option>
                                            <option value="0">在宅介護について</option>
                                            <option value="0">その他</option>

                                        </select>
                                        <select name="" id="">
                                            <option value="0">介護付き有料老人ホーム</option>
                                            <option value="0">住宅型有料老人ホーム</option>

                                            <option value="0">サービス付き高齢者向け住宅</option>

                                            <option value="0">グループホーム</option>
                                            <option value="0">ケアハウス</option>
                                            <option value="0">特別養護老人ホーム</option>
                                            <option value="0">介護老人保健施設</option>
                                            <option value="0">介護医療院</option>

                                        </select>
                                    </td>
                                </tr>
                                <tr class="form_address">
                                    <th>タイトル<span class="req">必須</span>
                                        <span class="note">
												50文字まで
											</span>
                                    </th>
                                    <td>
                                        <input type="text" value="">
                                    </td>
                                </tr>
                                <tr class="form_inquiry">
                                    <th>内容<span class="req">必須</span>

                                    </th>
                                    <td>
                                        <textarea name="" id="must" cols="600px" rows="500px"></textarea>
                                    </td>
                                </tr>

                                <tr class="form">

                                    <td rowspan="2" colspan="2">
                                        <label class="container">
                                            <form action="" class="check">
                                                <input type="radio" name="radio" id="1">
                                                <a href="#">利用規約</a>ご同意後、チェックを入れてください。
                                                <span class="checkmark"></span>
                                                <p class="submit">
                                                    <button type="submit">
                                                        入力内容を確認
                                                    </button>
                                                </p>
                                            </form>
                                        </label>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </form>
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
                            <Infor/>
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
    components: {Infor}
}
</script>

<style scoped>
@import '../../assets/css/confirmation.css';
</style>
