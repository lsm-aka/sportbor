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
<div class="container services-body">
	<div class="row">	
		<div id="services-carusel-2" class="owl-carousel owl-theme">
			<?
			if( count($arResult["ITEMS"])>0 ){			
				foreach ($arResult["ITEMS"] as $arItem) {
					if( $arItem["PREVIEW_PICTURE"]["ID"]>0 ){
						$img_file = CFile::ResizeImageGet($arItem["PREVIEW_PICTURE"]["ID"], array('width'=>360, 'height'=>230), BX_RESIZE_IMAGE_EXACT, true);
					}
					else{
						$img_file = array("src"=>SITE_TEMPLATE_PATH."/img/default-image.png", "width"=>"360", "height"=>"230");
					}				
			?>
					<div class="item">
						<div class="round-agle">
							<div class="img-box round-agle scale-img-box">
								<a href="<?=$arItem['DETAIL_PAGE_URL']?>">
									<img src="<?=$img_file['src'];?>" width="<?=$img_file['width'];?>" height="<?=$img_file['height'];?>" alt="" class="img-responsive center-block">
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



		</div>		
	</div>
</div>