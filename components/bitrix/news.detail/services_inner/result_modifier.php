<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?
	//------------------------------------------------------------
	// GET GALLERY PHOTOS
	if( is_array($arResult["DETAIL_PICTURE"]) ){
		$image_file[] = CFile::ResizeImageGet($arResult["DETAIL_PICTURE"]["ID"], array('width'=>1400, 'height'=>800), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, true);
	}

	if( is_array($arResult["PROPERTIES"]["MORE_PHOTOS"]) && count($arResult["PROPERTIES"]["MORE_PHOTOS"]["VALUE"])>0 ){
		foreach ($arResult["PROPERTIES"]["MORE_PHOTOS"]["VALUE"] as $arImagesId) {
			$images_files[] = CFile::ResizeImageGet($arImagesId, array('width'=>1400, 'height'=>800), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, true);
		}
	}

	$arResult["GALLERY_PHOTOS"] = array_merge($image_file, $images_files);

	//------------------------------------------------------------
	// GET DOCUMENTS
	if( is_array($arResult["DISPLAY_PROPERTIES"]["SERVICE_DOCS"]) && count($arResult["DISPLAY_PROPERTIES"]["SERVICE_DOCS"]["FILE_VALUE"])>0 ){
		$arResult["DOC_FILES"] = $arResult["DISPLAY_PROPERTIES"]["SERVICE_DOCS"]["FILE_VALUE"];
	}

	//------------------------------------------------------------
	//GET LINK PROJECTS 
	if( is_array($arResult["PROPERTIES"]["COMPLETED_PROJECTS"]) && count($arResult["PROPERTIES"]["COMPLETED_PROJECTS"]["VALUE"])>0 ){
		$link_idblock_id = $arResult["PROPERTIES"]["COMPLETED_PROJECTS"]["LINK_IBLOCK_ID"];

		$arSelect = Array("ID", "NAME", "IBLOCK_ID", "IBLOCK_SECTION_ID", "PREVIEW_PICTURE", "DETAIL_PAGE_URL");
		$arFilter = Array("IBLOCK_ID"=>IntVal($link_idblock_id), "ID"=>$arResult["PROPERTIES"]["COMPLETED_PROJECTS"]["VALUE"], "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");

		$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>20), $arSelect);
		while($ob = $res->GetNextElement())
		{
		 $arResult["COMPLETED_PROJECTS_ITEMS"][] = $ob->GetFields();	 
		}
		
		//-----------------------------------------
		// GET SECTIONS NAME
		foreach ($arResult["COMPLETED_PROJECTS_ITEMS"] as $arItems) {
			$arResult["COMPLETED_PROJECTS_ITEM_SECTION_ID"][] = $arItems["IBLOCK_SECTION_ID"];
		}
		
		$obSection = CIBlockSection::GetList( array(), array( "IBLOCK_ID"=>IntVal($link_idblock_id), "ID"=>$arResult["COMPLETED_PROJECTS_ITEM_SECTION_ID"] ) );
		while($arSection = $obSection->Fetch()){
			$arResult["PROJECTS_SECTION_INFO"][$arSection["ID"]] = $arSection;
		}
   }
?>