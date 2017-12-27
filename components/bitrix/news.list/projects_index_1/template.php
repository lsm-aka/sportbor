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
<div class="projects-slider">
	<div id="projects-owl-1" class="owl-carousel owl-theme">

		<?foreach($arResult["ITEMS"] as $arItem){			
		$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
		$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
		 $file_img = CFile::ResizeImageGet($arItem["PREVIEW_PICTURE"]["ID"], array('width'=>760, 'height'=>460), BX_RESIZE_IMAGE_EXACT, true);
		?>

			<div class="projects-elements items">	
				<a href="<?=$arItem["DETAIL_PAGE_URL"]?>" id="<?=$this->GetEditAreaId($arItem['ID']);?>">		
					<div class="pr-img-box round-agle"><img style="display:block;" src="<?=$file_img["src"]?>" alt="" class="img-responsive center-block round-agle"></div>
					<div class="slider-text">
						<span class="slider-sec-title"><?=$arResult["SEC_NAME"][$arItem["ID"]];?></span>
						<span class="slider-title"><?echo $arItem["NAME"]?></span>
					</div>
				</a>
			</div>
		<?}?>

	</div>
	<div class="owl-nav-block">
		<div class="container">
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
</div>