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

<?
if( strlen($arResult["SECTION"]["DESCRIPTION"]) ){
?>
<div class="service-inner-content">
	<p>
		<?=$arResult["SECTION"]["DESCRIPTION"];?>
	</p>
</div>
<?
}
?>

<div class="services inner-row">
	<div class="services-body services-body-inner">
		<div id="services-inner-2">	
			<?
			if( count($arResult["THIS_SECTIONS"])>0 ){			
			?>
				<div class="row">			
					<?
					if( count($arResult["THIS_SECTIONS"])>0 ){	
					?>
					
						<?		
							foreach ($arResult["THIS_SECTIONS"] as $arSections) {
								$arResult["THIS_SECTIONS"]["SEC_ID"][$arSections["ID"]]	= $arSections["ID"];
								if( $arSections["PICTURE"]>0 ){
									$img_file = CFile::ResizeImageGet($arSections["PICTURE"], array('width'=>370, 'height'=>230), BX_RESIZE_IMAGE_EXACT, true);
								}
								else{
									$img_file = array("src"=>SITE_TEMPLATE_PATH."/img/default.jpg", "width"=>"370", "height"=>"230");
								}				
						?>
								<div class="item col-xs-12 col-sm-6">
									<div class="round-agle">
										<div class="img-box round-agle">
											<a href="<?=$arSections['SECTION_PAGE_URL']?>" class="round-agle">
												<img src="<?=$img_file['src'];?>" width="<?=$img_file['width'];?>" height="<?=$img_file['height'];?>" alt="" class="img-responsive center-block round-agle scale-box">
											</a>
										</div>
										<div class="content-box">
											<a class="detail-link" href="<?=$arSections['SECTION_PAGE_URL']?>"><h3 class="list-elements-title"><?=$arSections["NAME"]?></h3></a>
											<?
											if( strlen($arSections["DESCRIPTION"]) ){
											?>
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
															$arSections["DESCRIPTION"] = $obParser->html_cut($arSections["DESCRIPTION"], $truncate_len);
														}													
														echo $arSections["DESCRIPTION"];
													?>
												</p>
											<?					
											}
											?>		
										</div>
									</div>
								</div>							
						<?
							}
						}
						?>
						<?
						if( count($arResult["ITEMS"])>0 ){
							foreach ($arResult["ITEMS"] as $arItem) {
								if( $arResult["THIS_SECTIONS"]["SEC_ID"][$arItem["IBLOCK_SECTION_ID"]]>0 ){
									continue;
								}
								$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
								$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));

								if( $arItem["PREVIEW_PICTURE"]>0 ){
									$img_file = CFile::ResizeImageGet($arItem["PREVIEW_PICTURE"], array('width'=>370, 'height'=>230), BX_RESIZE_IMAGE_EXACT, true);
								}
								else{
									$img_file = array("src"=>SITE_TEMPLATE_PATH."/img/default.jpg", "width"=>"370", "height"=>"230");
								}
								$n++;
								if( $n == count($arResult["ITEMS"]) ){
									$n = 'last';
								}
						?>

								<div class="item col-xs-12 col-sm-6">
									<div class="round-agle">
										<div class="img-box round-agle">
											<a href="<?=$arItem['DETAIL_PAGE_URL']?>" class="round-agle">
												<img src="<?=$img_file['src'];?>" width="<?=$img_file['width'];?>" height="<?=$img_file['height'];?>" alt="" class="img-responsive center-block round-agle scale-box">
											</a>
										</div>
										<div class="content-box">
											<a class="detail-link" href="<?=$arItem['DETAIL_PAGE_URL']?>"><h3 class="list-elements-title"><?=$arItem["NAME"]?></h3></a>
											<?
											if( strlen($arItem["PREVIEW_TEXT"]) ){
											?>
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
											<?					
											}
											?>		
										</div>
									</div>
								</div>

						<?
							}
						}
						?>
					<div class="cls"></div>
				</div>	<!-- /row -->
			<?
			}
			else{
			?>
			<?
				if( count($arResult["ITEMS"])>0 ){
					foreach ($arResult["ITEMS"] as $arItem) {
					
					$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
					$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
					if( $arItem["PREVIEW_PICTURE"]>0 ){
						$img_file = CFile::ResizeImageGet($arItem["PREVIEW_PICTURE"], array('width'=>260, 'height'=>260), BX_RESIZE_IMAGE_EXACT, true);
					}
					else{
						$img_file = array("src"=>SITE_TEMPLATE_PATH."/img/default.jpg", "width"=>"260", "height"=>"260");
					}
					$n++;
					if( $n == count($arResult["ITEMS"]) ){
						$n = 'last';
					}
			?>
						<div id="<?=$this->GetEditAreaId($arItem['ID']);?>" class="service-item item-<?=$n;?>">
							
							<?if( is_array($img_file) ){?>
								<div class="image-box round-agle static-width col-sm-5 col-md-6 col-lg-4">
									<div class="round-agle">
										<a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="service-link round-agle flex-box scale-box" style="background-image: url(<?=$img_file['src']?>)"></a>
									</div>
								</div>
							<?}?>
								<div class="col-sm-7 col-md-6 col-lg-8">
									<div class="list-content">
										<a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="service-link">	
											<h3 class="title-box"><span><?=$arItem["NAME"]?></span></h3>
										</a>
										
										<?if($arParams["DISPLAY_PREVIEW_TEXT"]!="N" && $arItem["PREVIEW_TEXT"]){?>
										<div class="preview-block">
											<p>


												<?
													if( strlen($arItem["PREVIEW_TEXT"])>140 ){
														$prev_text = strip_tags($arItem["PREVIEW_TEXT"]);
														$prev_text = substr($prev_text, 0, 140);
														$prev_text = rtrim($prev_text, "!,.-");
														$prev_text = substr($prev_text, 0, strrpos($prev_text, ' '));
														echo $prev_text."… ";
													}
													else{
														echo $arItem["PREVIEW_TEXT"];
													}	
													
												?>

											</p>
										</div>	
										<?}?>

										<div>
											<a href="<?=$arItem["DETAIL_PAGE_URL"]?>" class="btn btn-color btn-read-more"><?=GetMessage("READ_MORE");?></a>
										</div>
									</div>
								</div>	
								<div class="cls"></div>			
						</div>
			
			<?	
					}
				}
			}
			?>
		</div>
	</div>
</div>