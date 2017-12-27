<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?
if(CModule::IncludeModule("iblock")){	
	$arFilter = array('IBLOCK_ID' => IntVal($arParams['IBLOCK_ID']), 'GLOBAL_ACTIVE'=>'Y', 'ACTIVE' => 'Y'); 
	$arSelect = array('ID', 'NAME', 'DESCRIPTION');
	$rsSection = CIBlockSection::GetTreeList($arFilter, $arSelect); 
	while($arSection = $rsSection->Fetch()) {
	   $arResult["SECTIONS"][$arSection['ID']] = $arSection;
	    $arResult["SECTIONS_ID"][] = $arSection['ID'];
	}

	if( count($arResult["SECTIONS"])>0 ){

		$arParams["SORT_BY1"] = trim($arParams["SORT_BY1"]);
		if(strlen($arParams["SORT_BY1"])<=0)
			$arParams["SORT_BY1"] = "ACTIVE_FROM";
		if(!preg_match('/^(asc|desc|nulls)(,asc|,desc|,nulls){0,1}$/i', $arParams["SORT_ORDER1"]))
			$arParams["SORT_ORDER1"]="DESC";

		if(strlen($arParams["SORT_BY2"])<=0)
			$arParams["SORT_BY2"] = "SORT";
		if(!preg_match('/^(asc|desc|nulls)(,asc|,desc|,nulls){0,1}$/i', $arParams["SORT_ORDER2"]))
			$arParams["SORT_ORDER2"]="ASC";

		//ORDER BY
		$arSorts = array(
			$arParams["SORT_BY1"]=>$arParams["SORT_ORDER1"],
			$arParams["SORT_BY2"]=>$arParams["SORT_ORDER2"],
		);
		if(!array_key_exists("ID", $arSorts))
			$arSorts["ID"] = "DESC";

		$arSelect = Array( "ID", "IBLOCK_ID", "NAME", "IBLOCK_SECTION_ID", "SECTION_ID", "PREVIEW_PICTURE", "DETAIL_PICTURE", "PROPERTY_PARTNER_PHONE", "PROPERTY_PARTNER_EMAIL" );		
		$arFilter = array(
		    "IBLOCK_ID" => IntVal($arParams['IBLOCK_ID']),
		    "SECTION_ID" => $arResult["SECTIONS_ID"],
		    "INCLUDE_SUBSECTIONS" => "Y",
		    "ACTIVE_DATE"=>"Y",
		    "ACTIVE"=>"Y"
		);

		$res = CIBlockElement::GetList($arSorts, $arFilter, false, Array("nTopCount"=>$arParams['NEWS_COUNT']), $arSelect);
		while($ar_fields = $res->GetNext())
		{
		 $arResult["SECTIONS"][$ar_fields['IBLOCK_SECTION_ID']]['ITEMS'][] = $ar_fields;		 
		}		
	}
}
?>