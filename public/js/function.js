/*------------------------------
	last-update 2019/04/19
------------------------------*/

//現在居るファイル名
var url = location.href;

//ua取得
var ua = navigator.userAgent;
if (ua.indexOf('iPhone') > 0 || (ua.indexOf('Android') > 0 && ua.indexOf('Mobile') > 0) || ua.indexOf('Windows Phone') > 0) {
	var device = 'sp';
} else {
	var device = 'pc';
}

$(function() {

	// モバイルメニュー
	$(".drawer").drawer();
	$('.drawer-close').on('click', function() {
		$('.drawer').drawer('close');
	});

	// machHeight
	function matchFnc() {
		$('.fixHeight').children().matchHeight();
	}
	$(window).on('load', matchFnc);

	// ギャラリー詳細ページのfancyboxをグループ化
	$('.mod_gallery_detail .fancybox a').each(function() {
		$(this).attr('rel', 'group');
	});

	// colorbox
	colorbox_setting = {
		maxWidth: '80%',
		maxHeight: '80%',
		opacity: 0.7,
		loop: false,
		returnFocus: false
	};
	$('.fancybox a').colorbox(colorbox_setting, {
		rel: 'group'
	});
	// 営業日カレンダー用
	$('.calendar').colorbox(colorbox_setting, {
		inline: true
	});

	// smoothScroll
	$(window).on('load', function() {
		$('a[href*="#"]').not('.calendar').SmoothScroll({
			duration: 800,
			easing: 'easeOutQuint'
		});
	});

	// contentslist 制御
	$('.contentslist>li').each(function() {
		if ($(this).find('ul').length) {
			$(this).addClass('multi');
			if (!($(this).find('img').length)) {
				if ($('ul', this).not('sublist')) {
					$(this).addClass('parent-text');
				}
			}
			if ($(this).find('img').length) {
				$(this).addClass('img-category');
			}
		} else {
			if ($(this).find('img').length) {
				$(this).addClass('img-category');
			} else {
				$(this).addClass('text-category');
				$(this).has('a').addClass('text-link');
			}
		}
	});
	// contentslist 制御
	$('.contentslist>li').each(function() {
		$('.contentslist>li:not(:has(>a))').addClass('nolink');
		if ($(this).find('ul').length) {
			$(this).addClass('multi');
			if (!($(this).find('img').length)) {
				if ($('ul', this).not('sublist')) {
					$(this).addClass('parent-text');
				}
			}
		} else {
			if ($(this).find('img').length) {
				$(this).addClass('img-category');
			} else {
				$(this).addClass('text-category');
			}
		}
	});
	// contentslistにリストが無い場合、非表示
	if (!($('.side .contentslist li').size())) {
		$('.side .contentslist').css('display', 'none');
		// side残さないとき
		// $('.side').css('display', 'none');
	}
	// contentslist 外部リンクのときtarget_blank
	$('.contentslist>li').each(function() {
		var catLink = $(this).find("a[href^='http']");
		catLink.not('[href*="' + location.hostname + '"]').attr('target', '_blank');
	});
	// カテゴリリストのリンク無し文字列にタグ付与
	$('.side>.contentslist>.nolink:not(.img-category), .drawer-menu .contentslist>.nolink:not(.img-category)').each(function() {
		var item = $(this).map(function() {
			return $(this).text();
		}).get().join();
		var array_item = item.split(/\r\n|\r|\n/);
		$(this).html($(this).html().replace(array_item[0], '<span class="n_title">' + array_item[0] + '</span>'));
	});

	// 新着、ギャラリーモジュールが何故かh1で囲まれててmarginが合わないことがあるので削除
	$('.module.mod_h1:has(.mod_news_list)').removeClass('mod_h1');
	$('.module.mod_h1:has(.mod_gallery_list)').removeClass('mod_h1');

	// 新着、ギャラリーのピックアップを囲っている.module削除
	$('.mod_gallery_list, .mod_news_list').each(function() {
		var parentClass = $(this).parent().attr('class');
		if (parentClass == 'module') {
			$(this).unwrap();
		}
	});

	// ギャラリーの記事数が0のときの表示
	$('.mod_gallery_list').each(function() {
		if (!($('#gallery dl', this).length)) {
			$('#gallery', this).append('<div class="module mod_text">只今準備中です</div>');
			$('ul.pager', this).hide();
		}
	});

	// iframe判断
	$('.mod_text iframe').each(function() {
		var iframeSrc = $(this).attr('src');
		if (iframeSrc.match(/youtube/)) {
			$(this).wrap('<div class="video" />');
		} else if (iframeSrc.match(/maps/)) {
			$(this).wrap('<div class="map" />');
		}
	});

	// 背景100%表示
	$('.break').parents('.module').addClass('break-wrap');

	// モジュールバナーのテキスト書き換え
	var arr = [{
		selector: '.mod_gallery_list p.pager a',
		string: 'もっと見る'
	}, {
		selector: '.mod_news_list p.pager a',
		string: 'もっと見る'
	}, {
		selector: '.mod_news_detail .back a, .mod_gallery_detail .back a',
		string: '一覧に戻る'
	}, {
		selector: '#contact_form p.submit button',
		string: '内容を送信する'
	}];
	// replace_string(arr);

	if (device == 'pc') {
		$(window).on('load', navFixed);
	} else if (device === 'sp') {
		set_anchor_for_call();
	}
	textLimit();
	// textLimit($('#gallery dt a'), '10');
	galleryBtn();
	newsDateReplace();
	rollover();
	pageTop();
	rightBar();
	formCheck();
	tableScroll();
	accordion();
	// contactFooter();
	// checkJa();
	// telColor();
	// changeBeforeAfter();
	enableEnlargeImage();
	// squareGallery(['.mod_gallery_list .img']);

});

// function contactFooter() {
// 	var $elm = $('.f-fixed'), $footer = $('.f-contact'), elmBottom = parseInt($elm.css('bottom'));
// 	$(window).on('scroll', function () {
// 		var scroll_top = $(document).scrollTop(),
// 			footerHeight = $footer.outerHeight(),
// 			footerTop = $footer.offset().top,
// 			footerPos = footerTop - $(window).height(),
// 			bottom = (footerHeight + elmBottom) + 'px';
// 		if (scroll_top >= 300) {
// 			$elm.addClass('fixed');
// 		} else {
// 			$elm.removeClass('fixed');
// 		}
// 		if($(window).scrollTop() > footerPos){
// 			$elm.removeClass('fixed');
// 		}else{
// 			$elm.addClass('fixed');
// 		}
// 	});
// }

function replace_string(arr) {
	arr.forEach(function(v) {
		$(v.selector).text(v.string);
	});
}

function set_anchor_for_call(target_tag_arr) {
	var target_tag_arr = target_tag_arr || ['span', 'strong'];
	$.each(target_tag_arr, function(i, v) {
		$(v).each(function() {
			var text;
			if (v === 'img') {
				text = $(this).attr('alt');
			} else {
				text = $(this).text();
			};
			if (text.match(/(0[0-9]{1,4})-([0-9]{1,4})-([0-9]{3,4})/, 'g') && text.match(/^0[0-9\-]{6,7}-[0-9]{3,4}$/)) {
				var tag_for_call = '<a class="anchor-for-call" href="tel:' + text + '">';
				if (v === 'img') {
					$(this).wrap(tag_for_call);
				} else {
					$(this).wrapInner(tag_for_call);
				};
			};
		});
	});
};

// navigation
function navFixed() {
	$('.h-nav').waypoint({
		handler: function(direction) {
			if (direction == 'down') {
				$('.h-nav__inner').addClass('fixed');
			} else if (direction == 'up') {
				$('.h-nav__inner').removeClass('fixed');
			}
		}
	});
}

// アコーディオンメニュー
function accordion() {
	$('.accordion__img').each(function() {
		//画像がonの時notクラスを付ける
		var imgSrc = $(this).attr('src');
		if (imgSrc.match(/(.*)_on(\..*)/)) {
			$(this).attr('class', 'not');
		}
	});
	$('.accordion').hover(function() {
		var $category = $(this).find('.accordion__list');
		var height = $category.height();
		var textHeight = $category.get(0).scrollHeight + 'px';
		if ($('.accordion__label', this).find('.accordion__img').length) {//画像のとき
			if (!$('.accordion__img', this).hasClass("not")) {
				$('.accordion__img', this).eq(0).attr("src", $('.accordion__img', this).attr("src").replace(/^(.+)_off(\.[a-z]+)$/, "$1_on$2"));
			}
		} else {//テキストのとき
			$(this).addClass('active');
		}
		if(height == 0) {
			$category.css('height', textHeight);
		} else {
			$category.css('height', 0);
		}
	}, function() {
		if ($('.accordion__label', this).find('.accordion__img').length) {//画像のとき
			if (!$('.accordion__img', this).hasClass("not")) {
				$('.accordion__img', this).eq(0).attr("src", $('.accordion__img', this).attr("src").replace(/^(.+)_on(\.[a-z]+)$/, "$1_off$2"));
			}
		} else {//テキストのとき
			$(this).removeClass('active');
		}
		$(this).find('.accordion__list').css('height', 0);
	});
}

// ギャラリー一覧の本文
function textLimit(element, cutLength, afterText) {
	element = element || $('#gallery dd:not(.img)');
	cutLength = cutLength || '25';
	afterText = afterText || '…';
	element.each(function() {
		$(this).text($(this).text().replace(/<("[^"]*"|'[^']*'|[^'">])*>/g, ''));
		var textLength = $(this).text().length;
		var textTrim = $(this).text().substr(0, (cutLength));
		if (cutLength < textLength) {
			$(this).html(textTrim + afterText);
		}
	});
};

// ギャラリー詳細の一覧へ戻るボタン
function galleryBtn() {
	$('.mod_gallery_list p.pager a, .mod_news_list p.pager a').each(function() {
		var $href = $(this).attr('href') + '?page=1';
		$(this).attr('href', $href);
	});
	// var beforeUrl = document.referrer;
	$('.mod_news_detail .back a, .mod_gallery_detail .back a').attr('href', 'javascript:history.back();');
}

// 新着情報の日付書き換え
function newsDateReplace() {
	var $element = $('#news dt, .mod_news_detail .date');
	$element.each(function() {
		var date = $(this).text();
		date = date.substring(0, date.indexOf(' '));
		date = date.replace(/年|月/g, '.');
		date = date.replace(/日/g, '');
		$(this).text(date);
	});
}

function rollover() {
	current(); // カレント判定
	$('a img').each(function() {
		var imgSrc = $(this).attr('src');
		//画像がonの時notクラスを付ける
		if (imgSrc.match(/(.*)_on(\..*)/)) {
			$(this).attr('class', 'not');
		}
		//smartRollover
		if (imgSrc.match(/(.*)_off(\..*)/)) {
			var repSrc = RegExp.$1 + '_on' + RegExp.$2;
			$('<img>').attr('src', repSrc);
			$(this).hover(function() {
				$(this).attr('src', repSrc);
				$(this).css('opacity', 1);
			}, function() {
				$(this).attr('src', imgSrc);
			});
			//ロールオーバーが無い場合は、透明度80%
		} else if (!$(this).hasClass('not')) {
			$(this).hover(function() {
				$(this).css('opacity', 0.8);
			}, function() {
				$(this).css('opacity', 1);
			});
		}
	});
}

function current() {
	var filename;
	var file_path = url.split('/');
	var pathname = location.pathname;
	var gallery = 'gallery';
	var $catList = $('.contentslist li');
	$catList.each(function() {
		var catUrl = $('a', this).attr('href');
		if (catUrl) {
			if ((catUrl.indexOf('?page=1') == -1) && (catUrl.indexOf(gallery) != -1)) {
				var catUrl = catUrl + '?page=1';
				$('a', this).attr('href', catUrl);
			}
		}
	});

	switch (pathname) {
		case '/':
			filename = 'index';
			break;
		case '/news/':
			filename = 'news';
			break;
		case '/' + gallery + '/':
			filename = gallery;
			break;
		default:
			// ギャラリーのカテゴリ別一覧：タイトルをカテゴリ名に変更する
			var catName = file_path[4];
			if (catName) {
				var $h1Module = $('.content .mod_h1');
				var $catList = $('.side .contentslist li');
				// var pageUrl = ('../../' + gallery + '/' + catName + '/?page=1');
				var catTitle, title, seotext;
				switch (catName) {
					case 'category01':
						catTitle = '固定カテゴリ01';
						break;
					case 'category02':
						catTitle = '固定カテゴリ02';
						break;
				};
				$catList.each(function() {
					var tag = $(this).children('a');
					var catUrl = tag.attr('href');
					var catListCatName;
					if (catUrl) {
						var reg = new RegExp(gallery + '\\/|\\.|\\/|\\?|page=1', 'g');
						catListCatName = catUrl.replace(reg, '');
					}
					if (catListCatName == catName) {
							$(this).addClass('current');
							if (tag.children().is('img')) { // バナー追加したとき
							catTitle = $(this).find('img').attr('alt');
						} else { // テキストリンクのとき
							catTitle = $(this).text();
						}
					}
				});
				var title = $('title').text().replace(/(.*)(?=｜)(.*)/g, catTitle + '$2');
				var seotext = $('.seotext').html().replace(/(.*)(?=\<span\>)(.*)/g, catTitle + '$2');
				if (catTitle) {
					$('h1', $h1Module).text(catTitle);
					// $h1Module.after('<div class="module mod_h2"><h2>' + catTitle + '</h2></div>');
					$('title').text(title);
					$('.seotext').html(seotext);
				}
			} else {
				var filename_ex = url.match(".+/(.+?)([\?#;].*)?$")[1];
				filename = url.match(".+/(.+?)\.[a-z]+([\?#;].*)?$")[1];
			}
			break;
	}

	if (file_path[3] == 'news') {
		filename = 'news';
	}

	if (file_path[3] == gallery) {
		filename = gallery;
	}

/* よくある質問：未回答が多いとき
	if (filename == 'faq') {
		$('.module.mod_h2').each(function() {
			var nextModule = $(this).next();
			//h2モジュールが隣接してるorモジュールと隣接してない（＝回答が存在しない）
			if (nextModule.hasClass('module mod_h2') || !(nextModule.hasClass('module'))) {
				$(this).after('<div class="module mod_text">回答は準備中です。</div>');
			}
		});
	}
*/

	if (filename == 'contact') {
		// メールフォームの見出しにid="mail"を付与
		$('#mail_title').parents('.module').attr('id', 'mail');
	}

	if (filename == 'thanks') {
		filename = 'contact';
	}

	$('.gnav-list__item, .sp-nav-list__item').each(function() {
		var currentName = $(this).data('current');
		if(currentName) {
			if (currentName === filename) {
				if ($(this).find('.gnav-list__img').length) {
					$('.gnav-list__img', this).addClass('not');
					$('.gnav-list__img', this).attr('src', $('.gnav-list__img', this).attr('src').replace(/^(.*)_off.(.*)$/, '$1_on.$2'));
				} else {
					$(this).addClass('current');
				}
			}
		}
	});

	if ((filename == 'news') || (filename == gallery)) {
		pagerCurrent();
	}

}

function pagerCurrent() {
	var currentPage = location.search.replace('?page=', '');
	$('.pager a').each(function() {
		var pagerNum = $(this).text();
		if (pagerNum == currentPage) {
			$(this).addClass('current');
		}
	});
	// if ($("#pageCount").length) {
	// 	var pageCount = $('#pageCount').text(); //phpで出力した番号取得
	// 	$('#gallery+ul.pager li:nth-child(n+' + pageCount + ')').css('display', 'none'); //該当番号以降のリンク非表示
	// }
}

function pageTop() {
	var $elm = $('.pagetop'),
		$footer = $('.footer'),
		elmBottom = parseInt($elm.css('bottom'));
	$(window).on('scroll', function() {
		var scroll_top = $(document).scrollTop(),
			footerHeight = $footer.outerHeight(),
			footerTop = $footer.offset().top,
			footerPos = footerTop - $(window).height(),
			bottom = (footerHeight + elmBottom) + 'px';
		/* スクロールしたら出現 */
		if (scroll_top >= 300) {
			$elm.addClass('on');
		} else {
			$elm.removeClass('on');
		}
/* フッター手前でストップ
		if (device == 'pc') {
			if ($(window).scrollTop() > footerPos) {
				$elm.addClass('stop').css('bottom', bottom);
			} else {
				$elm.removeClass('stop').css('bottom', elmBottom);
			}
		}
*/
	});
}

// スクロールすると出現（class付与）
function rightBar() {
	var $elm = $('.rightbar');
	$(window).on('scroll', function() {
		var scroll_top = $(document).scrollTop();
		if (scroll_top >= 300) {
			$elm.addClass('on');
		} else {
			$elm.removeClass('on');
		}
	});
}

function formCheck() {
	//お問い合わせフォーム Validation
	//formタグに「id="inquiry-form"」、必須項目に「id="name設置値"」を付与
	$('#contact_form form').attr('id', 'inquiry-form');
	//郵便番号、住所に必須追加
	var addReq = '　<span class="req">※</span>';
	//必須項目：名前
	$('#contact_form .form_name input').attr('id', 'name');
	$('#contact_form .form_name input').removeAttr('required');
	//必須項目：メールアドレス
	$('#contact_form .form_email input').attr('id', 'email');
	$('#contact_form .form_email input').removeAttr('required');
	/* 住所必須のとき
		//必須項目：郵便番号
		$('#contact_form .form_zipcode').append(addReq);
		$('#contact_form input[name="zip"]').attr('id', 'zip');
		//必須項目：住所1
		$('#contact_form .form_address th').append(addReq);
		$('#contact_form .form_address input[name="addr1"]').attr('id', 'addr1').before('都道府県～市区町村（郵便番号を入れて頂くと自動で入ります）<br />');
		//必須項目：住所2
		$('#contact_form .form_address input[name="addr2"]').attr('id', 'addr2');
	*/
	/* 電話番号必須のとき
		//必須項目：電話番号
		//$('#contact_form .form_tel th').append(addReq);
		//$('#contact_form .form_tel input').attr('id', 'tel');
	*/
	//必須項目：お問い合わせ内容
	$('#contact_form .form_inquiry td textarea').attr('id', 'contact');
	$('#contact_form .form_inquiry td textarea').removeAttr('required');

	//thの必須マークデザイン変更
	$('.req').text('必須');

	var validation = $("#inquiry-form").exValidation({
		rules: {
			name: "chkrequired",
			email: "chkrequired chkemail chkhankaku",
			/* 住所必須のとき
			zip: "chkrequired chknumonly",
			addr1: "chkrequired",
			addr2: "chkrequired",
			*/
			/* 電話番号必須のとき
			tel: "chkrequired chktel",
			*/
			contact: "chkrequired"
		},
		customListener: "blur", // onBlur時のみにしてみる
		stepValidation: true,
		errTipCloseBtn: false,
		errTipPos: "right", // 吹き出しが表示される位置（左右）
		// errHoverHide: true, // マウスオーバーで消える
		scrollToErr: true //
	});

	// 郵便番号から住所自動入力（AjaxZip3）
	$('body').append('<script type="text/javascript" src="https://ajaxzip3.github.io/ajaxzip3.js" charset="UTF-8"></script>');
	$('#contact_form input[name="zip"]').on('keyup', function() {
		AjaxZip3.zip2addr(this, '', 'addr1', 'addr1');
	});
}

// エラー削除
function clearErrors() {
	// 表示されているエラーをフェイドアウト
	$("div[id*=err_]").fadeOut();
}

$.fn.responsiveTable = (function() {
	var $window = $(window);
	return function() {
		var $el = this,
			$table = this.find('>table'),
			onResize = function() {
			var width = $table.outerWidth(),
				height = $table.outerHeight(),
				$parent = $el.parent(),
				containerWidth = $parent.width(),
				ratio = containerWidth / width;
			if (ratio < 1) {
				$el.height(height * ratio);
				$table.css('transform', 'scale(' + ratio + ')');
			} else {
				$el.height('');
				$table.css('transform', '');
			}
			};
		$table.css('transformOrigin', '0 0');
		$window.on('resize', onResize);
		onResize();
	};
}());
function tableScroll() {
	$('table.table').each(function() {
		/* 隣接した行見出しの内容が一致する場合結合 */
		var preItem = null,
			colnum = 0;
		$(this).find('tr').each(function() {
			var nowItem = $(this).find('.cols-label').eq(colnum);
			if (preItem == null) {
				preItem = nowItem;
			} else if (nowItem.text() == preItem.text()) {
				nowItem.remove();
				if (preItem.attr('rowspan') == null) {
					preItem.attr('rowspan', 1);
				}
				preItem.attr('rowspan', parseInt(preItem.attr('rowspan'), 10) + 1);
			} else {
				preItem = nowItem;
			}
		});
		// 3列以上の場合の処理
		var scroll = false;
		var rowCount = $(this).find('tr').length;
		for (var i = 0; i < rowCount; i++) {
			var colCount = $(this)[0].rows[i].cells.length;
			if (colCount >= 3) {
				var scroll = true;
				break;
			}
		}
		if (scroll == true) {
			/* 横スクロールにする場合
			$(this).wrap('<div class="scroll" />');
			*/
			/* 縮小する場合 */
			$(this).wrap('<div class="responsive-table" />');
			$(this).parent().responsiveTable();
		} else {
			// 2列以下は縦積み
			$(this).wrap('<div class="block-table" />');
		}
	});
}

// 言語判定
function checkJa() {
	var heading = $('.mod_h1 h1, .mod_h2 h2');
	heading.each(function() {
		var titleModule = $(this);
		var isJapanese = false;
		for (var i = 0; i < titleModule.text().length; i++) {
			// 日本語（英語以外）の場合「true」に設定
			if (titleModule.text().charCodeAt(i) >= 256) {
			isJapanese = true;
			break;
			}
		}

		// 英語のみの場合クラスを追加
		if (!(isJapanese)) {
			titleModule.parent().addClass('none');
		}
	});
}

//電話番号の文字色を一部のみ変える
function telColor() {
	$(".tel_color").children().addBack().contents().each(function() {
		if (this.nodeType == 3) {
			var $this = $(this);
			$this.replaceWith($this.text().replace(/(\S)/g, "<span>$&</span>"));
		}
	});
}

// ギャラリー詳細ページ　画像1と2を入れ替え
function changeBeforeAfter() {
	var before = $('.mod_gallery_detail.gallery_type03 .before_after dl.before dd a'),
		after = $('.mod_gallery_detail.gallery_type03 .before_after dl.after dd a');
	var before_href = before.attr('href'),
		after_href = after.attr('href');
	$('img', before).prependTo(after).addClass('moved');
	before.attr('href', after_href);
	$('img:not(.moved)', after).prependTo(before);
	after.attr('href', before_href);
}

//画像+テキストモジュールの画像拡大（「リンクする」にチェックで有効）
function enableEnlargeImage() {
	$('.module.mod_img_text_left, .module.mod_img_text_right').each(function() {
		var anchor_in_img_box = $(' > div:not(.text_box) > a', this);
		if (anchor_in_img_box.size() && anchor_in_img_box.attr('href') == '') {
			var src = $('> img', anchor_in_img_box).attr('src');
			anchor_in_img_box.attr('href', src);
			anchor_in_img_box.colorbox(colorbox_setting);
		}
	});
};

//正方形にトリミング（object-fit使用）
function squareGallery(elements) {
	$.each(elements, function(i,v) {
		$(v).each(function() {
			$(this).find('img').addClass('object-fit-img');
		});
	});
	objectFitImages('img.object-fit-img');
}
