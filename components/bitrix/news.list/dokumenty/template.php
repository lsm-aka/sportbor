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
<?	
foreach ($arResult["SECTIONS"] as $arSections) {	
?>
	<div class="section-info margin-b-60">
		<h2 class="section-name"><?=$arSections['NAME'];?></h2>
		
		<?
			if( strlen($arSections['DESCRIPTION']) ){
		?>
				<div class="section-desc">
					<? echo $arSections['DESCRIPTION'];?>
				</div>
		<?
			}
		?>
	</div>

	<div class="section-elements row">	
	
		<?
			foreach ($arSections['ITEMS'] as $arItem) {
				$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
				$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
				if( $arItem["DETAIL_PICTURE"] ){
					$img_path = CFile::GetPath($arItem["DETAIL_PICTURE"]);
				}
				else{
					$img_path = CFile::GetPath($arItem["PREVIEW_PICTURE"]);
				}				
				$img_file = CFile::ResizeImageGet($arItem['PREVIEW_PICTURE'], array('width'=>260, 'height'=>372), BX_RESIZE_IMAGE_PROPORTIONAL, true);
			
		?>

			<div id="<?=$this->GetEditAreaId($arItem['ID']);?>" class="col-xs-12 col-md-6 col-lg-4">
				<div class="element-info">
					<div class="sertif-box round-agle">				
						<a class="image-zoom zooming-link" href="<?=$img_path;?>" target="_blank"><img src="<?=$img_file['src'];?>" alt="" class="img-responsive center-block"></a>
					</div>
					<div class="element-desc">				
						<div class="per-name">
							<?=$arItem['NAME'];?>
						</div>				
					</div>
				</div>		
			</div> <!-- / col-md-6 col-lg-4 -->
		<?				
			}		
		?>
	</div>
<?
}
?>