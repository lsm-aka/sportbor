<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?
if(CModule::IncludeModule("iblock")){

  // выборка только активных разделов из инфоблока $IBLOCK_ID, $ID - раздел-родителя
  $arFilter = Array('IBLOCK_ID'=>$arParams["IBLOCK_ID"], "SECTION_ID"=>$ID, 'GLOBAL_ACTIVE'=>'Y');
  $db_list = CIBlockSection::GetList(Array(), $arFilter, true, Array("UF_SERVICES_ICONS"), Array("nPageSize"=>$arParams["NEWS_COUNT"]));
  while($ar_result = $db_list->GetNext())
  {

		$obEnum = new CUserFieldEnum;
	    $rsEnum = $obEnum->GetList(array(), array("ID" => $ar_result["UF_SERVICES_ICONS"]));
	    
	    if($arF = $rsEnum->GetNext()) {
	   		if( strlen($arF['VALUE'])>0 ){
	   			$ar_result["UF_SERVICES_ICONS"] = $arF['VALUE'];
	   		}
	   		else{
	   			$ar_result["UF_SERVICES_ICONS"] = 'frame';
	   		}
	      
	    }

		$arResult["THIS_SECTIONS"][]  = $ar_result; 
	
  }

  if( count($arResult["THIS_SECTIONS"])>0 ){	
  	foreach ($arResult["THIS_SECTIONS"] as $arItems) {

  		$arFilter = Array('IBLOCK_ID'=>$arParams["IBLOCK_ID"], "SECTION_ID"=>$arItems["ID"], 'GLOBAL_ACTIVE'=>'Y');
		$db_list = CIBlockSection::GetList(Array(), $arFilter, true);
		while($ar_result = $db_list->GetNext())
		{
			$arResult["THIS_SECTIONS"]["SECTIONS"][$arItems["ID"]][]  = $ar_result; 
		}
  	}
  }
}
?>