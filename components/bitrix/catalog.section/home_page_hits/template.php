<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use \Bitrix\Main\Localization\Loc;

/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 * @var CatalogSectionComponent $component
 * @var CBitrixComponentTemplate $this
 * @var string $templateName
 * @var string $componentPath
 */

$this->setFrameMode(true);
?>
<div class="row">
	<div id="cat-index-carusel-1" class="owl-carousel owl-theme">
		<?
		foreach ($arResult["ITEMS"] as $arItems) {

			if( $arItems['PREVIEW_PICTURE']['ID']>0 ){
				$cat_img_file = CFile::ResizeImageGet($arItems['PREVIEW_PICTURE']['ID'], array('width'=>250, 'height'=>250), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, true);
			}
			else{
				$cat_img_file = array("src"=>SITE_TEMPLATE_PATH."/img/default.png", "width"=>"250", "height"=>"250");
			}
		?>
			<div class="item product-item">
				<div class="img-box round-agle scale-img-box">
					<div class="flex-box">
						<span class="relative-box"><img src="<?=$cat_img_file['src'];?>" alt="<?=$arItems['PREVIEW_PICTURE']['ALT'];?>" class="img-responsive center-block"></span>
					</div>
					<a href="<?=$arItems['DETAIL_PAGE_URL'];?>" class="product-detail bg-shadow"></a>				
					<?
					if( is_array($arItems['PROPERTIES']['CAT_APPLIANCES']) && strlen($arItems['PROPERTIES']['CAT_APPLIANCES']['VALUE'])>0 ){
					?>
						<span class="product-lable round-agle"><?=$arItems['PROPERTIES']['CAT_APPLIANCES']['VALUE']?></span>
					<?
					}
					?>	
				</div>
				<div class="text-box">
					<a href="<?=$arItems['DETAIL_PAGE_URL'];?>" class="produkts-title-link"><?=$arItems['NAME'];?></a>
					<span class="price"><?=number_format( $arItems['PROPERTIES']['CAT_PRICE']['VALUE'], 2, '.', ' ' );?> <?=GetMessage('CT_HOME_CATALOG_CURENCY');?></span>
				</div>
			</div>

		<?	
		}
		?>			
	</div>
</div>