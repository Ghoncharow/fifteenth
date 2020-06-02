$(function(){
    
    // каруселька на главной    
    var owl = $('.owl-carousel');
    owl.owlCarousel({
        loop: false,
        margin: 30,
        nav: true,
        responsive: {
            0:{
                items:1
            },
            500:{
                items:3
            },
            1000:{
                items:4
            },
            1500:{
                items:5
            },
            2000:{
                items:6
            }
        }
    });
    owl.on('mousewheel', '.owl-stage', function (e) {
        if (e.deltaY>0) {
            owl.trigger('next.owl');
        } else {
            owl.trigger('prev.owl');
        }
        e.preventDefault();
    });

    // наложение svg-масок
    $('.fotorama__stage').append('<img id="ribbon" src="/include/ribbon.svg" alt="ribbon">');
    $('.fotorama__stage').append('<img id="rounding" src="/include/rounding.svg" alt="rounding">');
    $('.bx-yandex-view-map').append('<img id="top-rounding" src="/include/top-rounding.svg" alt="top-rounding">');
    $('.bx-yandex-view-map').append('<img id="lower-rounding" src="/include/lower-rounding.svg" alt="lower-rounding">');
    $('.discount .news-item:first').append('<img id="mask1" src="/include/mask1.svg" alt="mask1">');
    $('.discount .news-item:eq(1)').append('<img id="mask2" src="/include/mask2.svg" alt="mask2">');
    // добавление фоновых картинок
    $('.trends-of-season .trends a:eq(1), .trends-of-season .trends a:eq(2)').wrapAll('<div class="trend1"></div>');
    $('.catalog-section .why-right').prepend('<img id="why-are-we1" src="/include/circle-for-why-are-we.svg" alt="for-why-are-we">');
    $('.main .basic-services').prepend('<img id="aloe-left" src="/include/aloe-vera-left.png" alt="aloe-left">');
    $('.main .basic-services').prepend('<img id="aloe-right" src="/include/aloe-vera-right.png" alt="aloe-right">');
    $('.main .trends-of-season').prepend('<img id="background2" src="/include/background2.png" alt="background">');
    $('.our-works-masters').prepend('<img id="background3" src="/include/background3.png" alt="background">');
    $('#workarea-inner').prepend('<img id="background-masters" src="/include/background3.png" alt="background">');
    $('.design .news-list').prepend('<img id="background-design" src="/include/background2.png" alt="background">');
    $('.design .news-list').prepend('<img id="background1" src="/include/background1.png" alt="background">');
    
    // меню-hamburger
    $('#nav-icon4').click(function() {
        $('#nav-icon4').toggleClass('open');
        $("#header .menu").slideToggle("slow");
    });

    // модальное окно для yandex-карт
    $("#fancybox-1").fancybox({
        maxWidth	: 1000,
        maxHeight	: 1000,
        width		: '70%',
        height		: 'auto',
		openEffect	: 'elastic',
		closeEffect	: 'elastic',
        helpers : {
            overlay: { locked: false },
            title : { type : 'over' }
        }
    });

    // кроссбраузерное переключение модального окна
    // переключение рейтингов на главной в случае с перезагрузкой
    $('.main .bx_item_detail_rating').wrapAll('<div class="masters-wrap"></div>');
    $('.main .bx_item_detail_rating').attr('style', '');
    $(".main .bx_item_detail_rating:eq("+$('.news-detail .preview_picture').data('number')+")").css('display', 'block');
    $(".bx-yandex-map").bind("DOMSubtreeModified DOMNodeInserted DOMNodeRemoved propertychange", function () {
        // для старых браузеров
        if ($('.bx-yandex-map > ymaps > ymaps > ymaps').hasClass('ymaps-point-overlay') && !$('.news-detail > div').hasClass('our-masters')) $('.reception').css('display', 'block');
        if ($('.bx-yandex-map > ymaps > ymaps > ymaps').hasClass('ymaps-balloon-overlay')) $('.reception').css('display', 'none');
        // для современных браузеров
        $(".ymaps-image-with-content").on("click", function () { 
            $('.reception').css('display', 'none');
        });
        $(".ymaps-b-balloon__close").on("click", function () { 
            $('.reception').css('display', 'block');
        });
    });
    // самодельное модальное окно для коментариев
    $(".button7.toggle").on("click", function (e) { 
        e.preventDefault();
        $('#behind, .reviews-reply-form').css('display', 'block');
    });
    $("#behind, #close-button").on("click", function (e) { 
        e.preventDefault();
        $('#behind, .reviews-reply-form').css('display', 'none');
    });

    // 3D-тур, фотогалереи на главной, в услугах и дизайне
    $(".fancybox").fancybox({
        maxWidth	: 1000,
        maxHeight	: 1000,
        width		: '70%',
        height		: '90%',
		openEffect	: 'elastic',
		closeEffect	: 'elastic',
        helpers : {
            overlay: { locked: false },
            title : { type : 'over' }
        }
    });

    // раздел услуги
    $('.services .basic-services').wrapAll('<div class="services-wrap"></div>');
    $('.services .services-wrap').append('<img id="background4" src="/include/background3.png" alt="background">');
    $('.services .services-wrap').append('<img id="aloe-for-service" src="/include/aloe-for-service.png" alt="aloe-for-service">');
    $('.services .basic-services:eq(0)').css('display', 'block');
    $(".services .news-item:eq(0) .cover").addClass("services-cover-hover");
    $(".services .news-item:eq(0) .border").addClass("services-border-hover");
    $('.services .news-item').on('click', function(){
        $('.services .basic-services').attr('style', '');
        $(".services .cover").removeClass("services-cover-hover");
        $(".services .border").removeClass("services-border-hover");
        var i = $('.services .news-item').index(this);
        //console.log(i);
        $(".services .basic-services:eq("+i+")").css('display', 'block');
        $(".services .news-item:eq("+i+") .cover").addClass("services-cover-hover");
        $(".services .news-item:eq("+i+") .border").addClass("services-border-hover");
        if (i==4) {
            // в презентации покрытий свои размеры html-блоков
            $('#background4').css('height', $('.services .basic-services:eq(4)').height() - $('.services .news-list1').height() - 100 );
            if (innerWidth > 2000) $('#aloe-for-service').css({ 'bottom': $('.services .news-list1').height() });
            else if (innerWidth > 800) $('#aloe-for-service').css({ 'bottom': $('.services .news-list1').height() + 60 });
            else $('#aloe-for-service').css({ 'bottom': $('.services .news-list1').height() + 120 });
        } else $('#background4, #aloe-for-service').attr('style','');
    });
    $('.all-price-lists').first().before('<img id="background-all" src="/include/background-all.png" alt="background">');
    $('.all-price-lists').first().before('<img id="aloe-for-price" src="/include/aloe-for-price-list.png" alt="background">');
    // Обработчик события изменения размеров окна для фона в презентации покрытий
    $(window).resize(function(){
        if ($('.services .basic-services:eq(4)').css('display') == 'block') { 
            if (innerWidth > 2000) $('#aloe-for-service').css({ 'bottom': $('.services .news-list1').height() });
            else if (innerWidth > 800) $('#aloe-for-service').css({ 'bottom': $('.services .news-list1').height() + 60 });
            else $('#aloe-for-service').css({ 'bottom': $('.services .news-list1').height() + 120 });
            $('#background4').css('height', $('.services .basic-services:eq(4)').height() - $('.services .news-list1').height() - 100 );
        }
    });
    $(window).resize();

    // Выдвигающаяся боковая панель для записи    
	$('.cd-btn').on('click', function(event){
        //open the lateral panel
		event.preventDefault();
		$('.cd-panel').addClass('is-visible');
	});
	$('.cd-panel').on('click', function(event){
        //clode the lateral panel
		if( $(event.target).is('.cd-panel') || $(event.target).is('.cd-panel-close') ) { 
			$('.cd-panel').removeClass('is-visible');
			event.preventDefault();
		}
    });
    $(this).keydown(function(event){
        if (event.which == 27) {
            $('.cd-panel').removeClass('is-visible');
            $('#behind, .reviews-reply-form').css('display', 'none');
        }
    });
    // делаем некликабельной область на слайдере под кнопку
    $('.fotorama__stage__frame:nth-child(1) .property').on('click', function(e) {
        e.stopPropagation();
    });

});