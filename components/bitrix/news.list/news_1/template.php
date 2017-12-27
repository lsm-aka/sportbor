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


<div class="row">

<?
$n=0;
foreach($arResult["ITEMS"] as $arItem){
$n++;
?>
<?
$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
?>
	<div class="col-xs-12 col-sm-6 col-md-4 <?if($n>2) echo 'hidden-xs hidden-sm';?>"">
		<div class="news-elem-box round-agle" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
			<a class="detail-link" href="<?=$arItem["DETAIL_PAGE_URL"]?>"><h3 class="list-elements-title"><?echo $arItem["NAME"]?></h3></a>
			<?if($arParams["DISPLAY_DATE"]!="N" && $arItem["DISPLAY_ACTIVE_FROM"]){?>
				<span class="create-date"><?echo $arItem["DISPLAY_ACTIVE_FROM"]?></span>
			<?}?>
			<?if($arParams["DISPLAY_PREVIEW_TEXT"]!="N" && $arItem["PREVIEW_TEXT"]){?>
				<div class="content-box">
					<div class="like-p">
						<?
							$obParser = new CTextParser;
							if($arParams["PREVIEW_TRUNCATE_LEN"] > 0){
								$arItem["PREVIEW_TEXT"] = $obParser->html_cut($arItem["PREVIEW_TEXT"], $arParams["PREVIEW_TRUNCATE_LEN"]);
							}													
							echo $arItem["PREVIEW_TEXT"];
						?>
					</div>
				</div>
			<?}?>
			<?
			if( strlen($arItem["DISPLAY_PROPERTIES"]["AFFILIATION_NEWS"]["VALUE"])>0 ){
			?>
				<div class="btn-block">
					<span class="btn btn-color btn-xs"><?=$arItem["DISPLAY_PROPERTIES"]["AFFILIATION_NEWS"]["VALUE"]?></span>
				</div>
			<?
			}
			?>		
		</div>
	</div>
<?}?>
</div> <!-- /row -->