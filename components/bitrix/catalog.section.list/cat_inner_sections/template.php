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

$strSectionEdit = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "SECTION_EDIT");
$strSectionDelete = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "SECTION_DELETE");
$arSectionDeleteParams = array("CONFIRM" => GetMessage('CT_BCSL_ELEMENT_DELETE_CONFIRM'));

?>
<div class="catalog-sections">
	<?
	$n=0;
		foreach ($arResult['SECTIONS'] as &$arSection)
			{
				$n++;
				$this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], $strSectionEdit);
				$this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], $strSectionDelete, $arSectionDeleteParams);

				if (false === $arSection['PICTURE'])
					$arSection['PICTURE'] = array(
						'SRC' => $arCurView['EMPTY_IMG'],
						'ALT' => (
							'' != $arSection["IPROPERTY_VALUES"]["SECTION_PICTURE_FILE_ALT"]
							? $arSection["IPROPERTY_VALUES"]["SECTION_PICTURE_FILE_ALT"]
							: $arSection["NAME"]
						),
						'TITLE' => (
							'' != $arSection["IPROPERTY_VALUES"]["SECTION_PICTURE_FILE_TITLE"]
							? $arSection["IPROPERTY_VALUES"]["SECTION_PICTURE_FILE_TITLE"]
							: $arSection["NAME"]
						)
					);
				?>
				<div class="col-sm-6" id="<? echo $this->GetEditAreaId($arSection['ID']); ?>">
					<div class="img-box round-agle scale-img-box">
						<div class="tag-img" style="background-image:url('<? echo $arSection['PICTURE']['SRC']; ?>');"></div>
						<a href="<? echo $arSection['SECTION_PAGE_URL']; ?>" class="product-detail bg-shadow" title="<? echo $arSection['PICTURE']['TITLE']; ?>"></a>
					</div>
					<div class="cls"></div>				
					<div class="text-box">
						<a href="<? echo $arSection['SECTION_PAGE_URL']; ?>" class="katalog-title-link"><? echo $arSection["NAME"]; ?></a>
						<?
						if( strlen($arSection["DESCRIPTION"])>0 ){
						?>
							<p><? echo $arSection["DESCRIPTION"]; ?></p>
						<?
						}
						?>						
					</div>				
				</div>
				<?
					if($n%2==0) echo '<div class="cls hidden-xs"></div>';
				}
				?>
		<div class="cls"></div>
</div>