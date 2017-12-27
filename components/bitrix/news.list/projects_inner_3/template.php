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
<div id="projects-4">
	<div class="container services-body">	
			<div class="row">
				<div id="option">
					<ul id="project-filter" class="list-inline button-group filters-button-group">
					<li>
						<a href="javascript:void(0)" class="button btn btn-md btn-color" data-filter="*">Все</a>
					</li>
					<?
					foreach($arResult["SEC_ID"] as $key => $arSecs){
					?>
						<li>
							<a href="javascript:void(0)" class="button btn btn-md" data-filter=".elem-<?=$arResult["SEC_ID"][$key];?>"><?=$arResult["SECS_NAME"][$arResult["SEC_ID"][$key]];?></a>
						</li>					
					<?
					}
					?>
					</ul>
				</div>
			</div>
		
			<div class="row">
				<div class="grid dark">

				<?foreach($arResult["ITEMS"] as $arItem){			
				$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
				$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
				 $file_img = CFile::ResizeImageGet($arItem["PREVIEW_PICTURE"]["ID"], array('width'=>760, 'height'=>760), BX_RESIZE_IMAGE_EXACT, true);
				 $n++;
				 switch ($n) {
				 		 	case 1:
				 		 		$itemClass = 'grid-item grid-item--height2';
				 		 		break;			 		 	
				 		 	case 5:
				 		 		$itemClass = 'grid-item grid-item-2 grid-item--height2';
				 		 		break;
				 		 	case 6:
				 		 		$itemClass = 'grid-item grid-item-2';
				 		 		break;
				 		 	case 7:
				 		 		$itemClass = 'grid-item grid-item-2';
				 		 		$n=0;
				 		 		break;
				 		 	
				 		 	default:
				 		 		$itemClass = 'grid-item';
				 		 		break;
				 		 }		 
				?>
				  <div class="<?=$itemClass;?> round-agle elem-<?=$arItem['IBLOCK_SECTION_ID'];?>">
					    <div class="item round-agle scale-box" style="background-image:url(<?=$file_img['src']?>);background-size: cover;background-position: center center;background-repeat: no-repeat;">		
							<a href="<?=$file_img['src']?>" class="flex-box inner-flex zooming-link" id="<?=$this->GetEditAreaId($arItem['ID']);?>">							
							</a>
						</div>
				  </div>
				<?}?>			 
				</div>
			</div>
	</div>
</div>