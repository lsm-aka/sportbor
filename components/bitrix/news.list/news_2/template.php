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

<div class="row">
	<div class="news-slider-block">
		<div id="owl-news-tpl2" class="owl-carousel owl-theme">
			<?foreach($arResult["ITEMS"] as $arItem){?>
			<?
			$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
			$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));

			$img_file = CFile::ResizeImageGet($arItem['PREVIEW_PICTURE']['ID'], array('width'=>320, 'height'=>246), BX_RESIZE_IMAGE_EXACT, true);
			?>

						<div class="news-item">
							<div class="news-elem-box" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
								<div class="img-box round-agle scale-img-box col-xs-12 col-sm-4 col-lg-6">
									<a class="detail-link" href="<?=$arItem["DETAIL_PAGE_URL"]?>">
										<div class="round-agle">
											<img src="<?=$img_file['src'];?>" alt="" class="img-responsive">
										</div>
									</a>
								</div>	
								<div class="content-box col-xs-12 col-sm-8 col-lg-6">						
									<?if($arParams["DISPLAY_DATE"]!="N" && $arItem["DISPLAY_ACTIVE_FROM"]){?>
										<span class="create-date"><?echo $arItem["DISPLAY_ACTIVE_FROM"]?></span>
									<?}?>
									<a class="detail-link" href="#"><h3 class="list-elements-title"><?echo $arItem["NAME"]?></h3></a>
									<?if($arParams["DISPLAY_PREVIEW_TEXT"]!="N" && $arItem["PREVIEW_TEXT"]){?>							
											<div class="like-p">
												<?
													$obParser = new CTextParser;
													if($arParams["PREVIEW_TRUNCATE_LEN"] > 0){
														$arItem["PREVIEW_TEXT"] = $obParser->html_cut($arItem["PREVIEW_TEXT"], $arParams["PREVIEW_TRUNCATE_LEN"]);
													}													
													echo $arItem["PREVIEW_TEXT"];
												?>
											</div>							
									<?}?>
								</div>						
							</div>
						</div>
			<?}?>

		</div><!-- /owl-news-tpl2 -->
		<div class="owl-nav-block">					
			<div class="owl-nav owl-prev">
				<span class="lsm-stack">					 
					 <span class="icon-angle-left lsm-stack-1x"></span>
				</span>
			</div>
			<div class="owl-nav owl-next">
				<span class="lsm-stack">					 
					 <span class="icon-angle-right lsm-stack-1x"></span>
				</span>
			</div>					
		</div>
	</div>						
</div> <!-- /row -->