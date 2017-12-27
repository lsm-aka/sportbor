<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?
	//------------------------------------------------------------
	// GET GALLERY PHOTOS
	if( is_array($arResult["DETAIL_PICTURE"]) ){
		$image_file[] = CFile::ResizeImageGet($arResult["DETAIL_PICTURE"]["ID"], array('width'=>1170, 'height'=>600), BX_RESIZE_IMAGE_EXACT, true);
	}
	elseif( is_array($arResult["PREVIEW_PICTURE"]) ){
		$image_file[] = CFile::ResizeImageGet($arResult["PREVIEW_PICTURE"]["ID"], array('width'=>1170, 'height'=>600), BX_RESIZE_IMAGE_EXACT, true);
	}

	if( is_array($arResult["PROPERTIES"]["MORE_PHOTOS"]) && count($arResult["PROPERTIES"]["MORE_PHOTOS"]["VALUE"])>0 ){
		foreach ($arResult["PROPERTIES"]["MORE_PHOTOS"]["VALUE"] as $arImagesId) {
			$images_files[] = CFile::ResizeImageGet($arImagesId, array('width'=>1170, 'height'=>600), BX_RESIZE_IMAGE_EXACT, true);
		}
	}

	$arResult["GALLERY_PHOTOS"] = array_merge($image_file, $images_files);

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
	//PAGE NAVIGATION PREV - NEXT

	// Прямая сортировка, чтобы последний элемент был справа от текущего, при обратной будет наоборот, слева.
	$arSort = array(
		'ACTIVE_FROM' => 'ASC',
		'ID' => 'ASC',
	);

	// минимальные поля ID, NAME, DETAIL_PAGE_URL
	$arSelect = array(
		'ID',
		'NAME',
		'DETAIL_PAGE_URL',
		//'DATE_CREATE',
		//'DATE_ACTIVE_FROM',
		//'PREVIEW_PICTURE',
		//'DETAIL_PICTURE',
	);

	// выбираем активные элементы из нужного инфоблока по фильтру, вообще фильтр должен совпадать с фильтром компонента
	// иначе могут в пагинацию попасть левые элементы инфоблока, которых не будет на сайте.
	$arFilter = array(
		'IBLOCK_ID'             => $arParams['IBLOCK_ID'],
		'SECTION_CODE'          => $arParams['SECTION_CODE'],
		//'SECTION_CODE'          => $arResult['SECTION']['CODE'],
		'SECTION_ID'            => $arResult['IBLOCK_SECTION_ID'],
		'ACTIVE'                => 'Y',
		'ACTIVE_DATE'           => 'Y',
		'SECTION_ACTIVE'        => 'Y',
		'SECTION_GLOBAL_ACTIVE' => 'Y',
		'INCLUDE_SUBSECTIONS'   => 'Y',
		'CHECK_PERMISSIONS'     => 'Y',
		'MIN_PERMISSION'        => 'R',
	);


	// тут получим по 1 соседу с каждой стороны от текущего элемента
	$arNavParams = array(
		'nPageSize'  => 1,
		'nElementID' => $arResult['ID'],
	);
	$arElements     = Array();
	$rsElements   = CIBlockElement::GetList($arSort, $arFilter, FALSE, $arNavParams, $arSelect);
	if($arParams['DETAIL_URL'])
		$rsElements->SetUrlTemplates($arParams['DETAIL_URL']);

	while($obElement = $rsElements->GetNextElement()) {
		$arElements[] = $obElement->GetFields();
	}	
	
	// в $arResult['RIGHT_PAGE'] и $arResult['LEFT_PAGE']  массивы с информацией о соседних элементах для текущего
	switch(count($arElements))
	{
		case '3': //Сработает, когда справа и слева есть элементы
		{
			$RIGHT_PAGE = array_pop($arElements); // Последний элемент справа
			$LEFT_PAGE = array_shift($arElements); // Первый элемент слева

			$arResult['RIGHT_PAGE'] = Array(
				'NAME' => $RIGHT_PAGE['NAME'],
				'URL'  => $RIGHT_PAGE['DETAIL_PAGE_URL']
			);
			$arResult['LEFT_PAGE']  = Array(
				'NAME' => $LEFT_PAGE['NAME'],
				'URL'  => $LEFT_PAGE['DETAIL_PAGE_URL']
			);
		}
		break;

		case '2': //Сработает либо на первом, либо на последнем элементе
		{
			$RIGHT_PAGE = array_pop($arElements); // Последний элемент справа
			$LEFT_PAGE = array_shift($arElements); // Первый элемент слева

			// тут проверяем, слева или справа будет текущий открытый элемент, его исключаем

			if($LEFT_PAGE["ID"] && $LEFT_PAGE["ID"] != $arResult["ID"])
			{
				$arResult['RIGHT_PAGE'] = Array();
				$arResult['LEFT_PAGE']  = Array(
					'NAME' => $LEFT_PAGE['NAME'],
					'URL'  => $LEFT_PAGE['DETAIL_PAGE_URL']
				);
			}
			elseif($RIGHT_PAGE && $RIGHT_PAGE != $arResult["ID"])
			{
				$arResult['LEFT_PAGE'] = Array();
				$arResult['RIGHT_PAGE']  = Array(
					'NAME' => $RIGHT_PAGE['NAME'],
					'URL'  => $RIGHT_PAGE['DETAIL_PAGE_URL']
				);
			}
			else
			{
				$arResult['RIGHT_PAGE'] = Array();
				$arResult['LEFT_PAGE']  = Array();
			}
		}
		break;

		default: //Если что-то пойдет не так, постраничка выводиться не будет
		{
			$arResult['RIGHT_PAGE'] = Array();
			$arResult['LEFT_PAGE']  = Array();
		}
	}
	$arResult["ELEMENTS_COUNT"] = CIBlockSection::GetSectionElementsCount($arResult['IBLOCK_SECTION_ID'], Array("CNT_ACTIVE"=>"Y"));
?>