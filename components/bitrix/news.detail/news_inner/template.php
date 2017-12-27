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
<div class="inner-page-detail">
<input type="hidden" id="element-name" value="<?=$arResult["NAME"]?>" />
<input type="hidden" id="element-id" value="<?=$arResult["ID"]?>" />

	<?if($arParams["DISPLAY_PICTURE"]!="N"){?>

			<?
			if( count($arResult["GALLERY_PHOTOS"])>1 ){
			?>
				<div class="inner-slider-block">
					<div id="inner-page-slider" class="owl-carousel owl-theme">
						<?
							$n=0;
							foreach ($arResult["GALLERY_PHOTOS"] as $arGallery) {
								$n++;
						?>
								<div data-thumb='<div class="serv-owl-thumbs round-agle" style="background-color:#fff;background-image: url(<?=$arGallery['src']?>)">&nbsp;</div>' class="item round-agle service-slider-item item-<?=$n?>">
									<div class="flex-box item-image round-agle" style="background-image: url(<?=$arGallery['src']?>)">
										<a target="_blank" href="<?=$arGallery['src']?>" class="zooming-link"></a>
									</div>
								</div>
						<?		
							}
						?>
					</div>	
					<div class="owl-nav-block">
						<div class="container-fluid">
							<div class="owl-nav round-agle owl-prev animated fadeInLeft">
								<span class="lsm-stack">					 
									 <span class="icon-angle-left lsm-stack-1x"></span>
								</span>
							</div>
							<div class="owl-nav round-agle owl-next animated fadeInRight">
								<span class="lsm-stack">					 
									 <span class="icon-angle-right lsm-stack-1x"></span>
								</span>
							</div>
						</div>
					</div>
				</div>			
			<?
			}
			else{
				if( is_array($arResult["DETAIL_PICTURE"]) ){
					
					$image_file = CFile::ResizeImageGet($arResult["DETAIL_PICTURE"]["ID"], array('width'=>1400, 'height'=>800), BX_RESIZE_IMAGE_PROPORTIONAL, true);
				
				
			?>		<div class="inner-slider-block">
						<div class="detail-page-image">
							<span class="round-agle">
								<img src="<?=$image_file['src']?>" alt="" class="img-responsive">
							</span>
						</div>
					</div>
			<?	
				}
			}
			?>
			<div class="cls"></div>						
	<?}?>	
	
		<div class="detail-text">			
			<h3><?=$arResult["NAME"];?></h3>
			<span class="news-date-time"><?=$arResult["DISPLAY_ACTIVE_FROM"]?></span>
			<?
			if( strlen($arResult["DETAIL_TEXT"])>0 ){
				echo $arResult["DETAIL_TEXT"];
			}
			?>
		</div>
		<div class="cls"></div>
	
</div>

<div class="share-blocks">
	<div class="flex-box">
		<div class="share-label">
			<?=GetMessage('SHARE_LABEL')?>
		</div>
		<div class="share-box">
		<?
		//SHARE
		$APPLICATION->IncludeComponent(
			"bitrix:main.include",
			"",
			Array(
				"AREA_FILE_SHOW" => "file",
				"AREA_FILE_SUFFIX" => "",
				"AREA_FILE_RECURSIVE" => "Y",
				"EDIT_TEMPLATE" => "standard.php",
				"PATH" => SITE_DIR . 'include/share_buttons/yashare.php'
			)
		);
		?>	
		</div>
	</div>	
</div>

