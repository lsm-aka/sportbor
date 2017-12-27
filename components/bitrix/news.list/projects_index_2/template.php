<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>
	<div class="projects-slider slider-min-nav">
		<div id="projects-owl-2" class="flex-box owl-carousel owl-theme dark">

			<?foreach($arResult["ITEMS"] as $arItem){			
			$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
			$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
			 $file_img = CFile::ResizeImageGet($arItem["PREVIEW_PICTURE"]["ID"], array('width'=>760, 'height'=>460), BX_RESIZE_IMAGE_EXACT, true);
			 $n++;
			?>
				<div class="element-<?=$n;?> item" style="background-image:url(<?=$file_img['src']?>);">				
					<a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="flex-box inner-flex" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
						<div class="inner-flex-elem">
							<p class="proj-title"><?echo $arItem["NAME"]?></p>
							<span class="title-bottom"><?=$arResult["SEC_NAME"][$arItem["ID"]];?></span>
						</div>
					</a>
				</div>	
			<?}?>	
		</div>	
		<div class="owl-nav-block light">					
			<div class="owl-nav owl-prev">
				<span class="lsm-stack">					 
					 <span class="icon-angle-left lsm-stack-1x"></span>
				</span>
			</div>
			<div class="owl-nav owl-next">
				<span class="lsm-stack">					 
					 <span class="icon-angle-right lsm-stack-1x"></span>
				</span>
			</div>					
		</div>	
	</div>
	