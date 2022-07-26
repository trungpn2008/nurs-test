<template>
    <section>
        <div class="mainimg no">
            <div class="text-box">
                <ul class="bread">
                    <li><a href="#">トップ </a></li>
                    <li><a href="#">掲示板</a></li>
                    <li><a href="#">老人ホームの種類</a></li>
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
                        新規会員登録
                    </p>
                    <div id="contact_form">
                        <form action="/static/php/contact.php" method="post" id="inquiry-form">
                            <input type="hidden" name="thanksurl" value="/thanks.php" class="errPosRight">
                            <input type="hidden" name="s" value="02" class="errPosRight">
                            <table class="form_table">
                                <tbody>
                                <tr class="form_name">
                                    <th>お名前 <span class="req">必須</span></th>
                                    <td>
                                        <div id="err_name" class=" userformError form_inquiry-form "
                                             style="display: none;">
                                            <div class="formErrorMsg formErrorContent"></div>
                                            <div class="formErrorArrow">
                                                <div class="line10"></div>
                                                <div class="line9"></div>
                                                <div class="line8"></div>
                                                <div class="line7"></div>
                                                <div class="line6"></div>
                                                <div class="line5"></div>
                                                <div class="line4"></div>
                                                <div class="line3"></div>
                                                <div class="line2"></div>
                                                <div class="line1"></div>
                                            </div>
                                        </div>
                                        <input type="text" name="name" id="name"
                                               class="chkrequired errPosRight before">
                                    </td>
                                </tr>
                                <tr class="form_email">
                                    <th>フリガナ<span class="req">必須</span></th>
                                    <td>
                                        <div id="err_email" class=" userformError form_inquiry-form "
                                             style="display: none;">
                                            <div class="formErrorMsg formErrorContent"></div>
                                            <div class="formErrorArrow">
                                                <div class="line10"></div>
                                                <div class="line9"></div>
                                                <div class="line8"></div>
                                                <div class="line7"></div>
                                                <div class="line6"></div>
                                                <div class="line5"></div>
                                                <div class="line4"></div>
                                                <div class="line3"></div>
                                                <div class="line2"></div>
                                                <div class="line1"></div>
                                            </div>
                                        </div>
                                        <input type="text" name="email" id="email"
                                               class="chkrequired chkemail chkhankaku errPosRight before">
                                    </td>
                                </tr>
                                <tr>
                                    <th>ニックネーム<span class="req">必須</span></th>
                                    <td>
                                        <input type="text" name="zip" class="zipcode errPosRight">
                                    </td>
                                </tr>
                                <tr class="form_address">
                                    <th>性別</th>
                                    <td>
                                        <label class="">
                                            <input type="radio" name="radio" id="1">男性
                                            <span class="checkmark"></span>
                                        </label>
                                        <label class="">
                                            <input type="radio" name="radio" id="2">女性
                                            <span class="checkmark"></span>
                                        </label>
                                    </td>

                                </tr>
                                <tr class="form_tel">
                                    <th>年齢</th>
                                    <tdy>
                                        <select name="" id="">
                                            <option value="0">18～24歳</option>
                                            <option value="0">25～34歳</option>
                                            <option value="0">35～44歳</option>
                                            <option value="0">45～54歳</option>
                                            <option value="0">55～64歳</option>
                                            <option value="0">65歳以上</option>
                                        </select>
                                    </tdy>
                                </tr>
                                <tr class="form_inquiry">
                                    <th>住所</th>
                                    <td>
                                        郵便番号入力<br>
                                        <input type="text" value="" class="one"><br>
                                        <input type="text" value=""><br>
                                        番地、マンション部屋番号入力<br>
                                        <input type="text" value="">
                                    </td>

                                </tr>
                                <tr class="form_id">
                                    <th>ラインID</th>
                                    <td>
                                        <input type="text" value="">
                                    </td>

                                </tr>
                                <tr class="">
                                    <th>メールアドレス<span class="req">必須</span></th>
                                    <td>
                                        <input type="text" value="">
                                    </td>
                                </tr>
                                <tr class="form_check">

                                    <th>連絡方法
                                        必須<span class="req">必須</span></th>
                                    <td>
                                        <form action="">
                                            <label class="">
                                                <input type="radio" name="radio" id="1">メール
                                                <span class="checkmark"></span>
                                            </label>
                                            <label class="">
                                                <input type="radio" name="radio" id="2">電話
                                                <span class="checkmark"></span>
                                            </label>
                                            <label class="">
                                                <input type="radio" name="radio" id="2">ライン
                                                <span class="checkmark"></span>
                                            </label><br>
                                            <label class="">
                                                <input type="radio" name="radio" id="1">当サイトからの連絡は受けとらない
                                                <span class="checkmark"></span>
                                            </label>
                                        </form>
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
@import '../../assets/css/registration.css';
</style>
