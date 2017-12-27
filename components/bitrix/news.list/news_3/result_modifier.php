<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?
if(CModule::IncludeModule("iblock")){
	$arFilter = array( "IBLOCK_ID" => $arParams["IBLOCK_ID"], "PROPERTY_DISTINGUISH_NEWS_VALUE" => "Y", "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y" );
	$rsItems = CIBlockElement::GetList(Array("ID" => "DESC"), $arFilter, false, false, Array());

	while($ar_fields = $rsItems->GetNext())
	{
	 $arResult["TOP_ITEM"] = $ar_fields;
	 if( is_array($arResult["TOP_ITEM"]) ){
	 	break;
	 }
	}

	if( !$arResult["TOP_ITEM"] ){
		$arFilter = array( "IBLOCK_ID" => $arParams["IBLOCK_ID"], "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y" );
		$rsItems = CIBlockElement::GetList(Array("ID" => "DESC"), $arFilter, false, false, Array());

		while($ar_fields = $rsItems->GetNext())
		{
		 $arResult["TOP_ITEM"] = $ar_fields;
		 if( is_array($arResult["TOP_ITEM"]) ){
		 	break;
		 }
		}
	}

}
?>