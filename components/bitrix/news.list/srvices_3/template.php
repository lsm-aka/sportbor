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
		<div id="services-carusel-3">
			<?
			if( count($arResult["THIS_SECTIONS"])>0 ){			
				foreach ($arResult["THIS_SECTIONS"] as $arSections) {
					if( $arSections["PICTURE"]>0 ){
						$img_file = CFile::ResizeImageGet($arSections["PICTURE"], array('width'=>360, 'height'=>230), BX_RESIZE_IMAGE_EXACT, true);
					}
					else{
						$img_file = array("src"=>SITE_TEMPLATE_PATH."/img/default-image.png", "width"=>"360", "height"=>"230");
					}				
			?>
			<div class="item">
				<div class="round-agle">
					<div class="img-box scale-img-box round-agle-tops">
						<a href="<?=$arSections['SECTION_PAGE_URL']?>">
							<img src="<?=$img_file['src'];?>" width="<?=$img_file['width'];?>" height="<?=$img_file['height'];?>" alt="" class="img-responsive center-block">
						</a>
					</div>
					<div class="content-box">
						<a class="detail-link" href="<?=$arSections['SECTION_PAGE_URL']?>">
							<h3 class="list-elements-title"><?=$arSections["NAME"]?></h3>
						</a>
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
		</div>
	</div> <!-- /row -->	
	<div class="btn-block">
		<a href="<?=SITE_DIR?>services/" class="btn btn-default btn-md"><?=GetMessage('CT_BNL_ALL_SERVICES');?></a>
	</div>
</div>