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
<div class="container-fluid">
	<div class="row">
		<div class="flex-box grid-container">

		<?
		foreach($arResult["ITEMS"] as $arItem){			
		$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
		$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
		 $file_img = CFile::ResizeImageGet($arItem["PREVIEW_PICTURE"]["ID"], array('width'=>760, 'height'=>760), BX_RESIZE_IMAGE_EXACT, true);
		 $n++;
		 if( $n >6 ){				
			break;					
		 }
		 switch ($n) {
		 		 	case 1:
		 		 		$itemClass = ' item-t';
		 		 		break;			 		 	
		 		 	case 2:
		 		 		$itemClass = ' item-b';
		 		 		break;
		 		 	case 3:
		 		 		$itemClass = ' item-b';
		 		 		break;			 		 	
		 		 	
		 		 	default:
		 		 		$itemClass = '';
		 		 		break;
		 		 }		 
		?>

		<?
			if( $n==1 || $n == 4 ){
				echo '<div class="grid">';
			}
		?>
			
			  <div class="grid-item grid-item-<?=$n;?><?=$itemClass;?>">
				    <div class="item flex-box" style="background-image:url(<?=$file_img['src']?>);">				
						<a href="<?echo $arItem["DETAIL_PAGE_URL"]?>" class="flex-box inner-flex" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
							<div class="inner-flex-elem">	
								<p class="title-top"><?=$arResult["SEC_NAME"][$arItem["ID"]];?></p>		
								<p class="proj-title"><?echo $arItem["NAME"]?></p>
							</div>
						</a>
					</div>
			  </div>				
		<?
			if( $n==3 || $n == 6 ){
				echo '</div>';					
			}				
			
		}
		?>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12 btn-block">
			<a href="<?=SITE_DIR?>projects/" class="btn btn-default btn-md"><?=GetMessage('ALL_PROJECTS')?></a>
		</div>
	</div>
</div>