<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
	//------------------------------------------------------------
	// GET GALLERY PHOTOS
	if( is_array($arResult["DETAIL_PICTURE"]) ){
		$image_file[] = CFile::ResizeImageGet($arResult["DETAIL_PICTURE"]["ID"], array('width'=>1280, 'height'=>1280), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, true);
	}

	if( is_array($arResult["PROPERTIES"]["MORE_PHOTOS"]) && count($arResult["PROPERTIES"]["MORE_PHOTOS"]["VALUE"])>0 ){
		foreach ($arResult["PROPERTIES"]["MORE_PHOTOS"]["VALUE"] as $arImagesId) {
			$images_files[] = CFile::ResizeImageGet($arImagesId, array('width'=>1280, 'height'=>1280), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, true);
		}
	}

	$arResult["GALLERY_PHOTOS"] = array_merge($image_file, $images_files);

	//------------------------------------------------------------
	// GET DOCUMENTS
	if( is_array($arResult["DISPLAY_PROPERTIES"]["CAT_DOCUMENTS"]) && count($arResult["DISPLAY_PROPERTIES"]["CAT_DOCUMENTS"]["FILE_VALUE"])>0 ){
		$arResult["DOC_FILES"][] = $arResult["DISPLAY_PROPERTIES"]["CAT_DOCUMENTS"]["FILE_VALUE"];
	}

	//------------------------------------------------------------	
	$arResult["ELEM_PROP_GR_PROPERTIES_CHECK"] = 0;
	foreach ($arResult["PROPERTIES"] as $arProps) {
		if( preg_match('/ELEM_PROP_GR/', $arProps["CODE"]) ){
			if( strlen($arProps["VALUE"])>0 ){
				$arResult["ELEM_PROP_GR_PROPERTIES_CHECK"]++;
			}
		}
	}

	//------------------------------------------------------------
	//GET LINK FEATURED 
	if( is_array($arResult["PROPERTIES"]["CAT_FEATURED"]) && count($arResult["PROPERTIES"]["CAT_FEATURED"]["VALUE"])>0 ){
		$link_idblock_id = $arResult["PROPERTIES"]["CAT_FEATURED"]["LINK_IBLOCK_ID"];

		$arSelect = Array("ID", "NAME", "IBLOCK_ID", "IBLOCK_SECTION_ID", "PREVIEW_PICTURE", "DETAIL_PAGE_URL", "PROPERTY_CAT_PRICE", "PROPERTY_CAT_APPLIANCES");
		$arFilter = Array("IBLOCK_ID"=>IntVal($link_idblock_id), "ID"=>$arResult["PROPERTIES"]["CAT_FEATURED"]["VALUE"], "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");

		$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>99), $arSelect);
		while($ob = $res->GetNextElement())
		{
		 $arResult["CAT_FEATURED_ITEMS"][] = $ob->GetFields();	 
		}
   }
?>