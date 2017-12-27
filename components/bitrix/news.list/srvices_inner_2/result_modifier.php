<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?
if(CModule::IncludeModule("iblock")){
	//unset($arResult["ITEMS"]);
	if( count($arResult["SECTION"]["PATH"])==0 ){		
// выборка только активных разделов из инфоблока $IBLOCK_ID, $ID - раздел-родителя
		$arFilter = Array('IBLOCK_ID'=>$arParams["IBLOCK_ID"], "SECTION_ID"=>0, 'GLOBAL_ACTIVE'=>'Y');
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
	}
	elseif( count($arResult["SECTION"]["PATH"])>0 ){
		$parentSectionDepyhLivel = 0;
		$parentSectionId = 0;

		foreach ($arResult["SECTION"]["PATH"] as $parent_section) {			
			if( $parent_section["DEPTH_LEVEL"] > $parentSectionDepyhLivel ){
				$parentSectionDepyhLivel = $parent_section["DEPTH_LEVEL"];
				$parentSectionId = $parent_section["ID"];
				$arResult["SECTION"]["DESCRIPTION"] = $parent_section["DESCRIPTION"];
			}
		}
		
		// выборка только активных разделов из инфоблока $IBLOCK_ID, $parentSectionId - раздел-родителя
		$arFilter = Array('IBLOCK_ID'=>$arParams["IBLOCK_ID"], "SECTION_ID"=>$parentSectionId, 'GLOBAL_ACTIVE'=>'Y');
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

		$arSelect = Array("ID", "IBLOCK_ID", "*", "PROPERTY_*");
		$arFilter = Array("IBLOCK_ID"=>$arParams["IBLOCK_ID"], "SECTION_ID"=>$parentSectionId, "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");
		$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>$arParams["NEWS_COUNT"]), $arSelect);
		$n=0;
		while($ob = $res->GetNextElement()){
		 $arResult["ITEMS"][$n] = $ob->GetFields();
		 $arResult["ITEMS"][$n]["PROPS"] = $ob->GetProperties();
		 $n++;
		}
	}  
}
?>