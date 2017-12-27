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

<div class="section-info">
	<h2 class="section-name"><?=$arSections['NAME'];?></h2>
</div>
	
	<?
		foreach ($arSections['ITEMS'] as $arItem) {

		$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
		$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
		?>
		<div class="element-slide-block">
			<div class="section-elements">
				
					<div class="element-slide-ctrl">				
						<a href="javascript:void(0);" class="slide-ctrl-link">
							<span class="icon-plus toggle-slide-ctrl"></span><span class="icon-minus toggle-slide-ctrl"></span> <span class="slide-ctrl-text"><?=$arItem['NAME'];?></span>
						</a>						
					</div>

					<div class="per-status">
						<?
						echo $arItem['PROPERTY_VACANTS_SALARY_VALUE'];
						?>
					</div>

					<div class="element-slide-desc" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
							<?
							if( strlen($arItem['PREVIEW_TEXT']) ){
								echo $arItem['PREVIEW_TEXT'];
							}							
							?>

							<div class="btn-block">
								<a href="javascript:void(0);" class="btn btn-color btn-md send_resum_form"><?=GetMessage('CT_LSM_BTN_TEXT');?></a>
							</div>
					</div>
				
			</div>
		</div>
	<?				
		}		
	?>
	
<?
}
?>