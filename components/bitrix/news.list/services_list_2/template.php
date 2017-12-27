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
			<div class="section-head section-header-block">
				<h2 class="h1 section-title text-center"><?=GetMessage('LSM_service_section_title');?></h2>
				<p class="section-slogan text-center"><?=$arResult["DESCRIPTION"];?></p>
			</div>
		
			<div class="services-items">
				
				<?				
				foreach($arResult["ITEMS"] as $arItem){
					$n++;
					if( $n%2 == 0 ){
						$item_class = 'even';
					}
					else{
						$item_class = 'odd';
					}

					$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
					$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
					if( is_array($arItem["PREVIEW_PICTURE"]) ){
						$img_file = CFile::ResizeImageGet($arItem["PREVIEW_PICTURE"]["ID"], array('width'=>570, 'height'=>390), BX_RESIZE_IMAGE_EXACT, true);
					}

					if( $arItem["PROPERTIES"]["SERVICE_PRICE"]["VALUE"] > 0 ){
						$service_price = number_format($arItem["PROPERTIES"]["SERVICE_PRICE"]["VALUE"], 0, '.', ' ');
					}
					
				?>
					
					<div id="<?=$this->GetEditAreaId($arItem['ID']);?>" class="flex-container item-<?=$item_class;?>">
						<div class="flex-element element-1 col-md-3">
							<img src="<?=$img_file["src"]?>" alt="" class="img-responsive center-block">
							<span class="price-box btn btn-color btn-sm"><span class="price-from"><?=GetMessage('LSM_OT');?></span> <?=$service_price;?> <span class="price-lang"><?=GetMessage('LSM_R');?></span></span>
						</div>

						<div class="flex-element element-2 col-md-9">
							<div class="flex-content-box col-sm-offset-1 col-md-offset-2">
								<h3 class="title-box"><span><?=$arItem["NAME"]?></span></h3>
								<?if($arParams["DISPLAY_PREVIEW_TEXT"]!="N" && $arItem["PREVIEW_TEXT"]){?>
									<p><?echo $arItem["PREVIEW_TEXT"];?></p>
								<?}?>
								<a class="read-more" href="<?=$arItem["DETAIL_PAGE_URL"]?>"><?=GetMessage('LSM_READ_MORE');?> <i class="icon-r-arrow"></i></a>
							</div>
						</div>
					</div><!-- /flex-container -->

				<?}?>		

			</div>	<!-- /services-items -->	

			<div class="text-center light">
				<a class="btn btn-default def-t btn-lg more-services" href="javascript:void(0);"><?=GetMessage('LSM_btn_all_services');?></a>
			</div>	
