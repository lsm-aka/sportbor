<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
global $APPLICATION;
IncludeTemplateLangFile(__FILE__);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">	
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="icon" type="image/x-icon" href="<?=SITE_TEMPLATE_PATH?>/favicon.ico" />

	<?CUtil::InitJSCore( array('ajax', 'popup') );?>
	<?$APPLICATION->ShowHead();?>

	<?
	$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/vendor/css/grid.css");	
	$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/vendor/css/animate.css");	
	$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/vendor/css/owl.carousel.css");
	$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/vendor/css/fonts.css");
	$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/vendor/plugins/malihuSB/jquery.mCustomScrollbar.css");
	$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/vendor/plugins/select2-4.0.3/css/select2.min.css");
	$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/vendor/plugins/magnific_popup/magnific-popup.css");

	$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/css/globals.css");
	$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/css/navbar.css");
	$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/css/slider.css");
	$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/css/sections.css");	
	$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/css/forms.css");
	$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/css/basecolor.css", true);	

	$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/vendor/jquery-1.11.3.min.js");
	$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/vendor/jquery.cookie.js");
	$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/vendor/plugins/rCollapseJs/src/responsiveCollapse.js");
	$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/vendor/plugins/owl.carousel.min.js");		
	$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/vendor/plugins/malihuSB/jquery.mCustomScrollbar.concat.min.js");	
	$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/vendor/isotope.pkgd.min.js");
	$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/vendor/plugins/select2-4.0.3/js/select2.min.js");
	$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/vendor/plugins/instafeed/instafeed.min.js");	
	$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/vendor/spectrum.js");
	$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/vendor/plugins/magnific_popup/jquery.magnific-popup.min.js");	

	$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/vendor/form_valid/inputmask.js");
	$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/vendor/form_valid/inputmask.extensions.js");
	$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/vendor/form_valid/inputmask.regex.extensions.js");
	$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/js/costom.js");
	?>
	
	<?if(!CModule::IncludeModule("lsm.simplekit")){?>
		<?$APPLICATION->SetTitle(GetMessage("ERROR_INCLUDE_MODULE_LSM_TITLE"));?>
		<div class="include_module_error">			
			<p><?=GetMessage("ERROR_INCLUDE_MODULE_LSM_TEXT")?></p>
		</div>
		<?die();?>
	<?}?>

	<?
	Csimplekit::SetJSOptions();
	global $arLsmTheme, $bgmenu;

	global $USER;	
	$dir = $APPLICATION->GetCurDir();
	$page = $APPLICATION->GetCurPage();
	?>

	<title><?$APPLICATION->ShowTitle()?></title>

</head>
<body>
	<?$APPLICATION->ShowPanel();?>
	<?
		
		$arLsmTheme = $APPLICATION->IncludeComponent("lsm:theme.lsm", "", array(), false);		

		if( $arLsmTheme["BTNS_TYPE"]["VALUE"]==2 ){
			$btnsClass = ' btns-rad';
		}
		else{
			$btnsClass = '';
		}
	?>
	<div class="global-container<?=$btnsClass;?> <?if( Csimplekit::IsMainPage() ) echo 'home-page';?>">
	<div id="mnucontainer">

		<?		
		$bgmenu = $arLsmTheme["LSM_MENU_COLOR"]["VALUE"];

		if( !Csimplekit::IsMainPage() ){ // Если перешли на внутренную страницу
			if( $arLsmTheme["LSM_TOP_MENU"]["VALUE"] != 5 && $arLsmTheme["LSM_TOP_MENU"]["VALUE"] != 8 ){
				$bgmenu = 'light';
			}
			$mega_menu_inner = ' mega-menu-inner';
		}
		else{
			$mega_menu_inner = '';
		}
		?>
		<div class="mega-menu <?php echo $bgmenu; echo $mega_menu_inner; if($arLsmTheme["LSM_TOP_MENU"]["VALUE"]==6) echo ' shadow-none'; ?>">		<?// Подключаем выбранный тип меню
				$path = $_SERVER["DOCUMENT_ROOT"] . SITE_DIR . 'include/menus/type_' . $arLsmTheme["LSM_TOP_MENU_TYPE"]["VALUE"] . '/tpl_' . $arLsmTheme["LSM_TOP_MENU"]["VALUE"] . '/index.php';
				include_once $path;
			?>			
		</div>


		<?
			if( !Csimplekit::IsMainPage() ){ // Если перешли на внутренную страницу
		?>
			<div class="inner-page light<?if($arLsmTheme["LSM_TOP_MENU"]["VALUE"]>5) echo ' inner-page-min';?>">
				<div class="inner-page-head">

					<h1><?$APPLICATION->ShowTitle()?></h1>

					<div class="breadcrumb-container">
						<?$APPLICATION->IncludeComponent(
							"bitrix:breadcrumb", 
							"breadcrumb", 
							Array(
								"PATH" => "",
								"SITE_ID" => SITE_ID,
								"START_FROM" => "0"
							)
						);?>
					</div>
				</div>	
				<?
					if( strlen($dir)>0 ){
						$cur_dir = str_replace( SITE_DIR, '/', $dir );
						$cur_dir = str_replace( '\/\/', '/', $cur_dir );
						$ar_dir = explode('/', $cur_dir);
						$this_dir = $ar_dir[1];
					}
				?>			
				<section class="inner-sections inner-<? echo strlen($this_dir)>0 ? $this_dir : 'def-page'; ?>">
				<div class="container">
					<div class="flex-container-2 row">

					<?										
					$menu = new CMenu('left');
					if( $menu->Init($dir, true) && !Csimplekit::IsProjectsPage() ){// Если в разделе есть левое меню
					?>

						<div class="col-xs-12 col-md-3 flex-elements element-r hidden-xs hidden-sm">
							
								<?$APPLICATION->IncludeComponent(
									"bitrix:menu", 
									"right_menu", 
									array(
										"ALLOW_MULTI_SELECT" => "N",
										"CHILD_MENU_TYPE" => "left",
										"DELAY" => "N",
										"MAX_LEVEL" => "3",
										"MENU_CACHE_GET_VARS" => array(
										),
										"MENU_CACHE_TIME" => "3600",
										"MENU_CACHE_TYPE" => "N",
										"MENU_CACHE_USE_GROUPS" => "N",
										"CACHE_SELECTED_ITEMS" => "N",
										"ROOT_MENU_TYPE" => "left",
										"USE_EXT" => "Y",
										"COMPONENT_TEMPLATE" => "right_menu"
									),
									false
								);?>
							
							
								<?$APPLICATION->IncludeComponent(
									"bitrix:main.include", 
									"section_inc1", 
									Array(
										"AREA_FILE_SHOW" => "sect",	
										"AREA_FILE_SUFFIX" => "inc",
										"AREA_FILE_RECURSIVE" => "Y",
										"EDIT_TEMPLATE" => "standard.php",
									),
									false
								);?>
							
						</div>
					<?
						$element_l = ' col-md-9 element-l';
					}
					else{// Если в разделе нет левого меню
						$element_l = '';
					}
					?>
						<div class="col-xs-12 flex-elements<?=$element_l;?>">
			<?	
			 }			 
			?>