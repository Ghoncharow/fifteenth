<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
							</div>
						</div>
					</div>
					
				</div>
				

			</div>
	
			<div id="space-for-footer">
				<a href="#0" class="cd-btn"><b>Где нас найти</b></a>
			</div>
			
		</div>
		
		<div id="space-for-map">
				<?$APPLICATION->IncludeComponent(
	"bitrix:map.yandex.view", 
	".default", 
	array(
		"API_KEY" => "970a66f6-1704-45ee-b194-3a34ad19026a",
		"CONTROLS" => array(
			0 => "SMALLZOOM",
			1 => "TYPECONTROL",
			2 => "SCALELINE",
		),
		"INIT_MAP_TYPE" => "MAP",
		"MAP_DATA" => "a:4:{s:10:\"yandex_lat\";d:55.746083134520745;s:10:\"yandex_lon\";d:37.70884824979223;s:12:\"yandex_scale\";i:15;s:10:\"PLACEMARKS\";a:1:{i:0;a:3:{s:3:\"LON\";d:37.70816160428;s:3:\"LAT\";d:55.747051397954;s:4:\"TEXT\";s:9:\"ALOE NAIL\";}}}",
		"MAP_HEIGHT" => "400",
		"MAP_ID" => "ABC",
		"MAP_WIDTH" => "100%",
		"OPTIONS" => array(
			0 => "ENABLE_SCROLL_ZOOM",
			1 => "ENABLE_DBLCLICK_ZOOM",
			2 => "ENABLE_DRAGGING",
		),
		"COMPONENT_TEMPLATE" => ".default"
	),
	false
);?>

<?$APPLICATION->IncludeComponent(
	"bitrix:news.list",
	"reception",
	Array(
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"ADD_SECTIONS_CHAIN" => "Y",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "Y",
		"DETAIL_URL" => "",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"FIELD_CODE" => array("",""),
		"FILTER_NAME" => "",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => "13",
		"IBLOCK_TYPE" => "slider",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "Y",
		"INCLUDE_SUBSECTIONS" => "Y",
		"MESSAGE_404" => "",
		"NEWS_COUNT" => "20",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "Новости",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"PREVIEW_TRUNCATE_LEN" => "",
		"PROPERTY_CODE" => array("EMAIL",""),
		"SET_BROWSER_TITLE" => "N",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "Y",
		"SET_META_KEYWORDS" => "Y",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "N",
		"SHOW_404" => "N",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_BY2" => "SORT",
		"SORT_ORDER1" => "DESC",
		"SORT_ORDER2" => "ASC",
		"STRICT_SECTION_CHECK" => "N"
	)
);?>
		
		<div id="footer">

			<div id="copyright">
			<?$APPLICATION->IncludeFile(
									SITE_DIR."include/copyright.php",
									Array(),
									Array("MODE"=>"html")
								);?>
			</div>
			<div id="bottom-menu">

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
		<a href="https://www.instagram.com/aloenail/" target="_blanck">
				<img id="icon2" src="/include/instagram-icone-icon.png" width="35" height="35" alt="icon">
				</a>


			
			</div>

			<div class="lateral-panel">
				<div class="cd-panel from-right">
					<div class="cd-panel-container">
					<div class="cd-panel-header">
					<span title="<?=GetMessage("HDR_GOTO_MAIN")?>">
						<img id="logo-lateral" src="/include/aloe_logo.svg" width="210" height="66" alt="logo-mobile" >
					</span>
						<h1>ТЦ "Город Лефортово", ш. Энтузиастов</h1>
						<a href="#0" class="cd-panel-close">Close</a>
					</div>
						<div class="cd-panel-content">
							<h2>Напишите нам!</h2>							
							<br>
								<?$APPLICATION->IncludeComponent(
									"bitrix:main.feedback",
									"lateral",
									Array(
										"EMAIL_TO" => $GLOBALS["EMAIL"],
										"EVENT_MESSAGE_ID" => array("7"),
										"OK_TEXT" => "Спасибо, ваше сообщение принято.",
										"AJAX_MODE" => "Y",  // режим AJAX
										"AJAX_OPTION_SHADOW" => "N", // затемнять область
										"AJAX_OPTION_JUMP" => "N", // скроллить страницу до компонента.
										"AJAX_OPTION_STYLE" => "Y", // подключать стили
										"AJAX_OPTION_HISTORY" => "N",
										"REQUIRED_FIELDS" => array("NAME","EMAIL","MESSAGE"),
										"USE_CAPTCHA" => "Y"
									)
								);?>							
								<br>
								<br>						
							
						</div> <!-- cd-panel-content -->
					</div> <!-- cd-panel-container -->
				</div> <!-- cd-panel -->
			</div>

		</div>		
		</div>


	<?
	// Add mousewheel plugin (this is optional)
	$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/fancybox/lib/jquery.mousewheel.pack.js" );
	// Add fancyBox
	$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/fancybox/source/jquery.fancybox.pack.js" );
	// Optionally add helpers - button, thumbnail and/or media
	$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/fancybox/source/helpers/jquery.fancybox-buttons.js" );
	$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/fancybox/source/helpers/jquery.fancybox-media.js" );
	$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/fancybox/source/helpers/jquery.fancybox-thumbs.js" );
	// Подключение слайдеров
	$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/sliders/fotorama.js" );
	$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/sliders/owl.carousel.min.js" );
	$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/sliders/jquery.mousewheel.min.js" );
	// Основной скрипт сайта
	$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/development.js" );
	?>	
</body>
</html>