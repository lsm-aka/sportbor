<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?
	foreach($arResult["ITEMS"] as $arItem){
		$res = CIBlockSection::GetByID($arItem["IBLOCK_SECTION_ID"]);
		if($ar_res = $res->GetNext()) {
		  $arResult["SEC_NAME"][$arItem["ID"]] = $ar_res['NAME'];						  
		}
	}
?>