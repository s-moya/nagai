var mediaQuery_mobile = 768;

$(function(){

  /* TOP メインスライダ
	-----------------------------*/
  if($('.juicyslider').length){
    $('.juicyslider').juicyslider({
        // these are the defaults
        mode: "cover",                              // "cover" or "contain"
        width: '100%',                              // set null to make the slider as wide/tall as the window,
        height: '100%',                             // otherwise set any other values in px or % unit
        mask: "none",                             // "raster", "square", "strip" or "none"
        bgcolor: "",
        autoplay: 8000,                             // 0 fofr no autoplay, any other postive number for play interval in (ms)
        shuffle: false,                             // set true to shuffle the picture order
        show: {effect: 'fade', duration: 1000},     // effect params refer to jQuery UI
        hide: {effect: 'fade', duration: 1000},     // try 'puff' or 'drop' for the effect arg
    });
  }

	/* gnav child menu 調整
	-----------------------------*/
	$('.openedParentNav').removeClass('openedParentNav');
	$('.parentNav a').removeClass('active');
	$('.childNav').removeClass('openedChildNav');

	$(".gNav .parentNav").mouseenter(function(){
		$(this).addClass('openedParentNav');
		$(this).children('a').addClass('active');
		$(this).children('.childNav').addClass('openedChildNav');
	}).mouseleave(function(){
		$(this).removeClass('openedParentNav');
		$(this).children('a').removeClass('active');
		$(this).children('.childNav').removeClass('openedChildNav');
	});

	$(".gNav .parentNav > a").click(function(){
		// return false;
	});

	/* gnaviのhover時クラス切り替え
	-----------------------------*/
	$main_navi_list = $("#top").find(".main_navi li");

	$main_navi_list.on("mouseenter",function(){
		$this = $(this);
		if(!$this.hasClass("main_navi_current")) {
			$this.addClass("main_navi_on");
		}
	}).on("mouseleave",function(){
		$this = $(this);
		if(!$this.hasClass("main_navi_current")) {
			$this.removeClass("main_navi_on");
		}
	});


	/* サイドナビの切り替え
	-----------------------------*/
	$side_navi = $(".nav_category");

	$side_navi.find("dt").not('.none_child_nav').click(function(){
		$this_dd = $(this).next("dd");
		if(!$this_dd.is(":visible")) {
			$this_dd.slideDown(300);
		}else {
			$this_dd.slideUp(300);
		}
	});

	$('.event_year_list dl:visible:last').addClass('last-year');


	/* tabの切り替え
	-----------------------------*/
	$tab        = $(".hall_tab_area").find("li");
	$tab_detail = $(".hall_tab_detail>li");
	$current_tab    = "hall_tab_area_current";
	$current_detail = "hall_tab_detail_current";

	$tab.click(function(){
		$index = $tab.index(this);
		$tab.removeClass($current_tab);
		$(this).addClass($current_tab);
		$tab_detail.removeClass($current_detail);
		$tab_detail.eq($index).addClass($current_detail);
	});


	/* スムーススクロール
	-----------------------------*/
	$('a[href^=#]').not('.modal-panel').not('.next').not('.prev').click(function(){
		var speed = 800;
		var href= $(this).attr("href");

		var target = $(href == "#" || href == "" ? 'html' : href);
		if(target == '#top'){
			var position = target.offset().top;
		}else{
			var position = target.offset().top - 70;
		}
		$("html, body").animate({
			scrollTop : position
		}, speed, "easeOutExpo");
		return false;
	});


	/* fiixedNav
	-----------------------------*/
	var h           = $(window).height();
	var nav         = $('.fixedNav');
	var nav_top	    = parseInt($('.gNavArea').offset().top);
	var nav_height  = nav.height();
  var easing      = 'easeOutExpo';
  if(!nav_top && !nav_height){
    nav_top = nav_height = 100;
  }

	nav.css({
		top: '-' + (nav_height + 6) +'px'
	});

  $(window).scroll(function () {
    if(getBrowserWidth() >= mediaQuery_mobile){
      if ($(this).scrollTop() >= nav_top + nav_height + 10) {
      	$('.gNavArea').addClass('fix');
        nav.stop().animate({
        	top: '0px'
        },{
        	duration: 250,
        	easing: easing
        });
        $('.fixedNav ul li a.current').removeClass('current-hide');

      }else if($(this).scrollTop() < nav_top){
        $('.fixedNav ul li a.current').addClass('current-hide');
        nav.stop().animate({
          // top: '-'+( nav_height + 20 )+'px'
  				top: '-500px'
        },{
        	duration: 500,
        	easing: easing
        });

  			$('.openedParentNav').removeClass('openedParentNav');
  			$('.gNav .active').removeClass('active');
  			$('.childNav').removeClass('openedChildNav');

        //easeOutBack
        $('.gNavArea').removeClass('fix');
      }
    }
  });
});


function getBrowserWidth(){
  if (window.innerWidth){
		return window.innerWidth;
	}else if(document.documentElement && document.documentElement.clientWidth != 0){
		return document.documentElement.clientWidth;
	}else if(document.body){
		return document.body.clientWidth;
	}return 0;
}


/* slideshowの切り替え
-----------------------------*/
function slideSwitch() {
   var $active = $('#slideshow img.active');
   if ( $active.length == 0 ) $active = $('#slideshow img:last');
   var $next =  $active.next().length ? $active.next()
      : $('#slideshow img:first');

   $active.addClass('last-active');
   $next.css({opacity: 0.0})
      .addClass('active')
      .animate({opacity: 1.0}, 1000, function() {
           $active.removeClass('active last-active');
      });
}


$(function() {

  setInterval( "slideSwitch()", 5000 );

	// TOPページイベントリストのタブ切り替え
	if($('body').hasClass('home')){
		$('.tabs li a').click(function(){
			if($(this).attr('data-genre')){
				var genreIDs = $(this).attr('data-genre').split(' ');
				var genreID_class = '';

				$.each(genreIDs, function(key, genreID) {
					if(key){
						if(key === genreIDs.length-1){
							genreID = genreID;
						}else{
							genreID = genreID+', ';
						}
						genreID_class += '.'+genreID;
					}
				});

				$('.sort_list li').not(genreID_class).removeClass('active').hide();
				if(genreID_class == '.genre_all'){
					// 「すべて」を選択したら全て表示
					$('.sort_list li').addClass('active').show();
				}else{
					// 該当するジャンルのみ表示
					$('.sort_list').find(genreID_class).addClass('active').css('display','block');
				}

			}
			$('.tabs li a').removeClass('current');
			$(this).addClass('current');
			$('.sort_list li.active').autoHeight({
				column : 2,
				reset : 'reset',
				height : 'height'
			});
			// $(".fixHeight").fixHeight();
			return false;
		});
	}

	// イベントカレンダータブ切り替え
	// bind change event to select
	$('.place_select').bind('click', function () {
		var place_select = $(this).attr('data-place'); // get selected value
		var params       = getParameter(window.location.href);
		var redirect_to  = location.href.replace(/page\/[0-9]+\//i,"");
		redirect_to  = redirect_to.split('?')[0];

		delete params.place_select;
		delete params.orderby;

		if (place_select.length > 0) {
			params["place_select"] = place_select;
		}

		var q_string = setParameter(params);
		if (q_string.length > 0) {
			redirect_to += '?' + q_string;
		}

		window.location = redirect_to;
		return false;
	});

	// イベントカレンダー前月・翌月切り替え
	$('.month_select').bind('click', function () {
		var month_select = $(this).attr('data-month'); // get selected value
		var year_select = $(this).attr('data-year'); // get selected value
		var params       = getParameter(window.location.href);
		var redirect_to  = location.href.replace(/page\/[0-9]+\//i,"");
		redirect_to  = redirect_to.split('?')[0];

		delete params.month_select;
		delete params.orderby;

		if (month_select.length > 0) {
			params["month_select"] = month_select;
		}

		if (year_select.length > 0) {
			params["year_select"] = year_select;
		}

		var q_string = setParameter(params);
		if (q_string.length > 0) {
			redirect_to += '?' + q_string;
		}

		window.location = redirect_to;
		return false;
	});

	function getParameter(str){
		var dec = decodeURIComponent;
		var par = new Array, itm;

		if(typeof(str) == 'undefined') return par;
		if(str.indexOf('?', 0) > -1) {
			str = str.split('?')[1];
			} else {
			str = '';
		}

		str = str.split('&');
		for(var i = 0; str.length > i; i++){
			itm = str[i].split("=");
			if(itm[0] != ''){
				par[itm[0]] = typeof(itm[1]) == 'undefined' ? true : dec(itm[1]);
			}
		}
		return par;
	}

	function setParameter(par){
		var enc = encodeURIComponent;
		var str = '', amp = '';
		if(!par) return '';
		for(var i in par){
			str = str + amp + i + "=" + enc(par[i]);
			amp = '&';
		}
		return str;
	}

	$("a.btn_closed").click(function(){
		return false;
	});

});

$(window).load(function() {

	// $('.heightLine>li').heightLine();
	// $('.heightLine>div').heightLine();

	// 下層TOPおすすめイベントの高さ調節
	$('.recommend_list .event_list li').each(function(){
		var imgHeight = $(this).find('.thumb').height();
		var detailHeight = $(this).find('.detail').height();
		var paddingTop = (imgHeight-detailHeight)/2;
		if(detailHeight < imgHeight){
			$(this).find('.detail').css('padding-top', paddingTop);
		}
	});

	// TOPスライダー
	if($('div.primary>div').attr('id') == 'main_visual'){
		var defaultOpt = {
			controls: false,
			auto: true,
			pager: true,
			// pagerCustom: '#pager',
			responsive: true,
			captions:true,
			mode : "fade",
			autoHover : true
		};
	  var slider = $('#slider').bxSlider(defaultOpt);
		if( slider.getSlideCount() < 2 ) {
		 // スライダー1つ以下のとき
		 defaultOpt['auto'] = false;	//	自動スライド停止
		 defaultOpt['pager'] = false;	//	pager無効
		}
		// スライダーをリロード
		slider.reloadSlider();
	}

	// フッタのおすすめスライダ
	if($('div.content_inner').next('div').attr('class') == 'recommend_list'){
		var footerSliderOption = {
			onSliderLoad: function(){
				$('#slider2').animate({
					'opacity':1
				},300);
			},
			auto: false,
			speed : 650,
			easing : 'easeOutQuad',
			adaptiveHeight : true,
			slideWidth : 313,
			slideMargin : 20,
			minSlides : 1,
			maxSlides : 3,
			moveSlides : 1,	//	1回にスライドさせる数
			// autoHover : true,	//	hover時にストップ
			pager : false,
			nextSelector : '.next',
			prevSelector : '.prev'
		};
		var slider2 = $('#slider2').bxSlider(footerSliderOption);
		if( slider2.getSlideCount() <= 3){
			// スライダーが3つ以下の時
			footerSliderOption['auto'] = false;			//	自動スライド停止
 		 	footerSliderOption['controls'] = false;	//	prev/next無効
		}
		// スライダーをリロード
		slider2.reloadSlider();
	}

	// 各館のホールイメージスライダー
	if($('#hall_slide').length){
	var hall_slider = $('#hall_slide').bxSlider({
			onSliderLoad: function(){
				$('#hall_slide, .hall_thumb').animate({
					'opacity':1
				},300);
			},
			onSlideAfter: function(){
			  hall_slider.startAuto();
			},
			mode: 'fade',
			speed: 1000,
			pause: 5000,
			auto: true,
			controls: false,
			tickerHover: true,
			pagerCustom: '.hall_img_thumb'
		});
	}

	// TOPのメニュースライダ
	// if( $('.menuSlider').length ){
	// 	var menuSliderOption = {
	// 		onSliderLoad: function(){
	// 			$('#menuSlider').animate({
	// 				'opacity':1
	// 			},300);
	// 		},
	// 		auto: false,
	// 		speed : 650,
	// 		easing : 'easeOutQuad',
	// 		adaptiveHeight : true,
	// 		slideWidth : 222,
	// 		slideMargin : 30,
	// 		minSlides : 1,
	// 		maxSlides : 6,
	// 		moveSlides : 1,	//	1回にスライドさせる数
	// 		// autoHover : true,	//	hover時にストップ
	// 		pager : false,
	// 		nextSelector : '.next',
	// 		prevSelector : '.prev'
	// 	};
	// 	var menuSlider = $('#menuSlider').bxSlider(menuSliderOption);
	// 	if( menuSlider.getSlideCount() <= 3){
	// 		// スライダーが3つ以下の時
	// 		menuSliderOption['auto'] = false;			//	自動スライド停止
	// 		menuSliderOption['controls'] = false;	//	prev/next無効
	// 	}
	// 	// スライダーをリロード
	// 	menuSlider.reloadSlider();
	// }


});

$(document).ready(function(){

  // setZoom();

	// TOP homeMenu スライダ（ 新 ）
	if( $('.menuSlider').length ){
		// $(".owl-carousel").owlCarousel();
		$('.owl-carousel').owlCarousel({
			lazyLoad : true,
			lazyContent : true,
      nav : false,
      dots : true,
			navSpeed : 500,
			items : 1,
			slideBy : 1,
	    center : false,
	    loop : true,
	    margin : 30,
			stagePadding : 70,
      responsiveRefreshRate : 300,
	    responsive : {
				0 : {
          items : 1,
          margin : 15
        },
        480 : {
          items : 2
        },
        640 : {
          items : 3
        },
        980 : {
          items : 4
        },
        1250 : {
          items : 4,
          nav : true,
          dots : false,
          stagePadding : 135
        }
	    }
		});
	}

	// ハッシュがついてたら要素の頭までスクロール
  var hashStr = location.hash;
  if(hashStr){
    var Hash = hashStr;
    var speed = 400;
    var easing = 'easeOutExpo';
    if($(Hash).offset()){
      if(Hash !== '#page'){
        var nav        = $('.fixedNav');
        var nav_height = 65;
        var HashOffset = $(Hash).offset().top;
        $("html, body").animate({
          scrollTop: HashOffset - nav_height
        }, speed);
      }else{
        var href= $(this).attr("href");
        var target = $(href == "#page" || href == "" ? 'html' : href);
        var position = target.offset().top;
        $("html, body").animate({scrollTop:position}, speed, easing);
      }
    }
    return false;
  }

	// お知らせ領域にスクロールバーを付ける
	if($('div').hasClass('info_wall')){
		$(".info_wall").mCustomScrollbar({
			scrollInertia: 200,
			advanced:{
		    updateOnContentResize: true
		  }
		});
	}

	// 通常モーダル
	$(".modal").fancybox({});

	// irameモーダル
	$(".fancybox").fancybox({
		'type' : 'iframe',
		// 'width' : 500,
		// 'height' : 400,
		'scrolling' : 'no',
		'autoSize' : true
	});

	// TOP : はじめから表示するモーダル
	if($('#modalNews').length && !Cookies.get('modal_news')){
		$.fancybox.open($('#modalNews'),{
				beforeShow: function(instance){
					$('html').addClass('-fancy-news-opened');
				},
				afterShow: function(){
					Cookies.set('modal_news', 'hidden', {
						//expires: 1/2, // 12時間非表示
						path: '/'
					});
				},
				afterClose: function(){
					$('html').removeClass('-fancy-news-opened');
				}
			}
		);
	}

	// 美術品モーダル
	var modal_panel_option = {
		// 'fitToView'	: false,
		'autoSize'	: false,
		'closeClick'	: false,
		// 'scrolling' : 'no',
		'autoSize' : true,
		'arrows': false,
		'nextEffect': 'fade',
		'prevEffect': 'fade',
		beforeShow: function(instance){
			$('html').addClass('-fancy-art-opened');
		},
		afterLoad: function ( instance, slide ) {
		},
		afterClose: function(){
			// console.log('after close');
			$('html').removeClass('-fancy-art-opened');
		}
	}
	$(".modal-panel").fancybox(modal_panel_option);
	// $.fancybox.open($(".modal-panel:first"), modal_panel_option);

	$('.artModal__navArw.-prev').click(function(){
		$.fancybox.prev();
	});
	$('.artModal__navArw.-next').click(function(){
		$.fancybox.next();
	});

	// TOP pickup スライダー
	if( $('.pickupArea').length ){
		var sudoSlider = $(".pickupSlider").sudoSlider({
			speed : 800,
			numeric: true,
			prevNext: false,
			auto: true,
			continuous: true,
			autoHeight: true,
			pause: 5800,
			resumePause: 5000,
			afterAnimation: function(slide){
				// sudoSlider.startAuto()
			},
			initCallback: function() {
				$('.fixHeight').fixHeight();
				$('.pickupArea').animate({
					'opacity':1
				},300);
			}
		});
	}

	// TOP pickup スライダー（スマホ）
	if( $('.indexPickupSlider').length ){
		var sudoSlider = $(".indexPickupSlider").sudoSlider({
			responsive: true,
			slideCount: 1,
			speed : 800,
			numeric: false,
			prevNext: false,
			auto: true,
			continuous: true,
			autoHeight: true,
			touchHandle: true,
			pause: 5800,
			afterAnimation: function(slide){
			},
			initCallback: function() {
				$('.fixHeight').fixHeight();
				$('.pickupArea').animate({
					'opacity':1
				},300);
			}
		});
	}

	// $(".gNav .parentNav").hover(function(){
	// 	// $(this).children('a').toggleClass('active');
	// 	// $(this).find('ul').toggle();
	// 	if($(this).hasClass('openedParentNav')){
	// 		$(this).removeClass('openedParentNav');
	// 		$(this).children('a').removeClass('active');
	// 		$(this).children('.childNav').removeClass('openedChildNav');
	// 	}else{
	// 		$(this).addClass('openedParentNav');
	// 		$(this).children('a').addClass('active');
	// 		$(this).children('.childNav').addClass('openedChildNav');
	// 	}
	// });

});

$(window).resize(function() {
  // setZoom();
});

