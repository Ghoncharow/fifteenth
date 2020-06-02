<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
IncludeTemplateLangFile(__FILE__);
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ru" lang="ru">
<head>
    <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title><?$APPLICATION->ShowTitle()?></title>
	<link rel="shortcut icon" type="image/x-icon" href="<?=SITE_TEMPLATE_PATH?>/favicon2.ico" />
	
	<link rel="stylesheet" type="text/css" href="<?=SITE_TEMPLATE_PATH?>/common.css" />
	
	<?
	$APPLICATION->ShowHead();
	// подключаем jquery из ядра Битрикс
	CJSCore::Init(array("jquery")); 
	// подключение стилей для слайдеров
	$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/sliders/fotorama.css", true);
	$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/sliders/owl.carousel.min.css", true);
	// Add fancyBox
	$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/fancybox/source/jquery.fancybox.css", true);
	// Optionally add helpers - button, thumbnail and/or media
	$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/fancybox/source/helpers/jquery.fancybox-buttons.css", true);
	$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/fancybox/source/helpers/jquery.fancybox-thumbs.css", true);
	// подключаем боковую панель lateralPanel
	$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/lateral-panel/modernizr.js" );
	$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/lateral-panel/style.css", true);
	?>

	<!--[if lte IE 6]>
	<style type="text/css">
		
		#support-question { 
			background-image: none;
			filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src='./images/question.png', sizingMethod = 'crop'); 
		}
		
		#support-question { left: -9px;}
		
		#banner-overlay {
			background-image: none;
			filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src='./images/overlay.png', sizingMethod = 'crop');
		}
		
	</style>
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?=SITE_TEMPLATE_PATH?>/colors.css" />
	
		
</head>
<body>
		<div id="page-wrapper">
		
			<div id="panel"><?$APPLICATION->ShowPanel();?></div>
	
			<div id="header">
				<a href="<?=SITE_DIR?>" title="<?=GetMessage("HDR_GOTO_MAIN")?>">
					<img id="logo" src="/include/aloe_logo.svg" width="200" height="56.6" alt="logo" >
				</a>
				
				<?$APPLICATION->IncludeComponent("bitrix:menu", "top", array(
					"ROOT_MENU_TYPE" => "top",
					"MENU_CACHE_TYPE" => "Y",
					"MENU_CACHE_TIME" => "36000000",
					"MENU_CACHE_USE_GROUPS" => "Y",
					"MENU_CACHE_GET_VARS" => array(
					),
					"MAX_LEVEL" => "1",
					"CHILD_MENU_TYPE" => "left",
					"USE_EXT" => "N",
					"ALLOW_MULTI_SELECT" => "N"
					),
					false
				);?>
				<a href="<?=SITE_DIR?>" title="<?=GetMessage("HDR_GOTO_MAIN")?>">
					<img id="logo-mobile" src="/include/aloe_logo.svg" width="140" height="44" alt="logo-mobile" >
				</a>

				<a href="https://www.instagram.com/aloenail/" target="_blanck" title="Мы в соцсетях">
					<img id="icon1" src="/include/instagram-icone-icon.png" width="35" height="35" alt="icon">
				</a>

				<a class="fancybox" data-fancybox-type="iframe" title="3D-тур" href="https://p0.zoon.ru/3d_tours/tour_salon_krasoty_aloe_nail_na_shosse_entuziastov_12_k_2/index.html">
					<img id="icon-3d" src="/include/Icon_3D_tur.svg" width="65" height="65" alt="icon">
				</a>

				<a href="tel:89295105604" title="Позвоните нам">
					<div id="telephone"><nobr><b>+7 (929) 510-56-04</b></nobr></div>
					<img id="telephone1" src="/include/phone16.svg" width="35" height="35" alt="telephone">
				</a>


			</div>



									
		
			<div id="content-wrapper">
				<div id="content">
				
					<div id="workarea-wrapper">
						
						<div id="workarea">
							<div id="workarea-inner">
							<!-- <h5><?$APPLICATION->ShowTitle(false);?></h5>  -->

