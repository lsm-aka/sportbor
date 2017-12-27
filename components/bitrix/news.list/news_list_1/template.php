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
$n=0;

?>
<div class="section-body">
	<div class="row">
			<?foreach($arResult["ITEMS"] as $arItem){?>
			<?
			$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
			$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
			if( is_array($arItem["PREVIEW_PICTURE"]) ){
				$img_file = CFile::ResizeImageGet($arItem["PREVIEW_PICTURE"]["ID"], array('width'=>320, 'height'=>246), BX_RESIZE_IMAGE_EXACT, true);
			}
			$n++;
			if( $n == count($arResult["ITEMS"]) ){
				$n = 'last';
			}
			?>
			<div id="<?=$this->GetEditAreaId($arItem['ID']);?>" class="service-item item-<?=$n;?>">
				
				<?if( is_array($img_file) ){?>
					<div class="image-box scale-img-box round-agle col-sm-4">
						<a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="service-link round-agle">	
							<img src="<?=$img_file["src"]?>" alt="" class="img-responsive center-block round-agle">
						</a>
					</div>
				<?}?>
					<div class="col-sm-8">
						<div class="list-content">
							<a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="service-link">	
								<h3 class="title-box"><span><?=$arItem["NAME"]?></span></h3>
							</a>

							<?if($arParams["DISPLAY_DATE"]!="N" && $arItem["DISPLAY_ACTIVE_FROM"]){?>
								<span class="news-date-time"><?echo $arItem["DISPLAY_ACTIVE_FROM"]?></span>
							<?}?>
							
							<?if($arParams["DISPLAY_PREVIEW_TEXT"]!="N" && $arItem["PREVIEW_TEXT"]){?>
							<div class="preview-block">
								<p>


									<?
										if( $arParams["PREVIEW_TRUNCATE_LEN"]>0 ){
											$truncate_len = $arParams["PREVIEW_TRUNCATE_LEN"];
										}
										else{
											$truncate_len = 150;
										}

										$obParser = new CTextParser;
										if($truncate_len > 0){
											$arItem["PREVIEW_TEXT"] = $obParser->html_cut($arItem["PREVIEW_TEXT"], $truncate_len);
										}													
										echo $arItem["PREVIEW_TEXT"];										
									?>

								</p>
							</div>	
							<?}?>

							<div>
								<a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="btn btn-default btn-md"><?=GetMessage("READ_MORE");?></a>
							</div>
						</div>
					</div>	
					<div class="cls"></div>			
			</div>

			<?			
		}
		?>						
	</div>
	<div class="row">
		<?if($arParams["DISPLAY_BOTTOM_PAGER"]){?>
			<br /><?=$arResult["NAV_STRING"]?>
		<?}?>
	</div>
</div>
		
		