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

<div class="catalog-inner-section products">
	<?
	if ( !empty($arResult['ITEMS']) )
	{
		$areaIds = array();
		foreach ($arResult['ITEMS'] as $arItem)
		{
			$uniqueId = $arItem['ID'].'_'.md5($this->randString().$component->getAction());
			$areaIds[$arItem['ID']] = $this->GetEditAreaId($uniqueId);
			$this->AddEditAction($uniqueId, $arItem['EDIT_LINK'], $elementEdit);
			$this->AddDeleteAction($uniqueId, $arItem['DELETE_LINK'], $elementDelete, $elementDeleteParams);

			if( $arItem['PREVIEW_PICTURE']['ID']>0 ){
				$cat_img_file = CFile::ResizeImageGet($arItem['PREVIEW_PICTURE']['ID'], array('width'=>250, 'height'=>250), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, true);
			}
			else{
				$cat_img_file = array("src"=>SITE_TEMPLATE_PATH."/img/default.png", "width"=>"250", "height"=>"250");
			}
			
	?>
			<div id="<?=$this->GetEditAreaId($arItem['ID']);?>" class="col-xs-12 col-sm-6 col-lg-4  catalog-inner-item">
				<div class="img-box round-agle scale-img-box">					
					<div class="flex-box">
						<span class="relative-box"><img src="<?=$cat_img_file['src']?>" alt="<?=$arItem['NAME']?>" class="img-responsive center-block"></span>
					</div>
					<a href="<?=$arItem['DETAIL_PAGE_URL']?>" class="product-detail bg-shadow"></a>
					<?
					if( is_array($arItem['PROPERTIES']['CAT_APPLIANCES']) && strlen($arItem['PROPERTIES']['CAT_APPLIANCES']['VALUE'])>0 ){
					?>
						<span class="product-lable round-agle"><?=$arItem['PROPERTIES']['CAT_APPLIANCES']['VALUE']?></span>
					<?
					}
					?>						
				</div>
				<div class="text-box">
					<a href="<?=$arItem['DETAIL_PAGE_URL']?>" class="produkts-title-link"><?=$arItem['NAME']?></a>
					<span class="price"><?=$arItem['PROPERTIES']['CAT_PRICE']['VALUE']?> руб.</span>
				</div>
			</div>

	<?
		}		
	}	
	?>
	<div class="cls"></div>
	<?
	if ( strlen($arResult['DESCRIPTION'])>0 ){
	?>
		<div class="cat-section-desc col-xs-12">
			<?=$arResult['DESCRIPTION']?>
		</div>
	<?}?>
</div>
