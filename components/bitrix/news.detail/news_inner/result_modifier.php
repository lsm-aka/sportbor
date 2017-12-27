<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?
	//------------------------------------------------------------
	// GET GALLERY PHOTOS
	if( is_array($arResult["DETAIL_PICTURE"]) ){
		$image_file[] = CFile::ResizeImageGet($arResult["DETAIL_PICTURE"]["ID"], array('width'=>1400, 'height'=>800), BX_RESIZE_IMAGE_EXACT, true);
	}

	if( is_array($arResult["PROPERTIES"]["MORE_PHOTOS"]) && count($arResult["PROPERTIES"]["MORE_PHOTOS"]["VALUE"])>0 ){
		foreach ($arResult["PROPERTIES"]["MORE_PHOTOS"]["VALUE"] as $arImagesId) {
			$images_files[] = CFile::ResizeImageGet($arImagesId, array('width'=>1400, 'height'=>800), BX_RESIZE_IMAGE_EXACT, true);
		}
	}

	$arResult["GALLERY_PHOTOS"] = array_merge($image_file, $images_files);

?>