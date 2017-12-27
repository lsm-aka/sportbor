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

<div id="services-carusel-1" class="flex-box services-container owl-carousel owl-theme dark">
<?
if( count($arResult["THIS_SECTIONS"])>0 ){
	$n=0;
	foreach ($arResult["THIS_SECTIONS"] as  $arSections) {
		if( $arSections["PICTURE"]>0 ){
			$img_file = CFile::ResizeImageGet($arSections["PICTURE"], array('width'=>640, 'height'=>360), BX_RESIZE_IMAGE_EXACT, true);
		}
		else{
			$img_file = array("src"=>SITE_TEMPLATE_PATH."/img/default-image.png", "width"=>"640", "height"=>"360");
		}
		
		$n++;
		if($n<10){
			$nNum = '0' . $n;
		}
		else{
			$nNum = $n;
		}
?>
	<div class="services-elements services-element-1" style="background-image:url(<?=$img_file['src'];?>);">
		<span class="elem-num"><?=$nNum;?></span>
		<a href="<?=$arSections['SECTION_PAGE_URL']?>" class="flex-box inner-flex">
			<div class="inner-flex-elem">
				<h3 class="list-elements-title"><?=$arSections["NAME"]?></h3>				
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
		</a>
	</div>
<?
	}	
}
?>
</div>
<div class="owl-nav-block light">					
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
