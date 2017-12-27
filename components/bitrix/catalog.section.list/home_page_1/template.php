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
	$n=0;
	foreach ($arResult['SECTIONS'] as $arSections){
		$n++;
		if($n%2==0){
			$left_right = 'right';
		}
		else{
			$left_right = 'left';
		}

	?>
	<?if($n%2!=0){?>	
	<div class="row katalog-items">
	<?}?>
		<div class="col-xs-12 col-md-6 <?=$left_right;?>">
			<div class="flex-box">
				<div class="col-xs-12 col-sm-4">
					<div class="img-box round-agle scale-img-box">
						<?
							$img_file = CFile::ResizeImageGet($arSections['PICTURE']['ID'], array('width'=>120, 'height'=>120), BX_RESIZE_IMAGE_PROPORTIONAL, true);
						?>
						<div class="tag-img" style="background-image:url(<?=$img_file['src'];?>);"></div>
						<a href="<?=$arSections['SECTION_PAGE_URL'];?>" class="product-detail bg-shadow"></a>
					</div>
				</div>	
				
				<div class="col-xs-12 col-sm-8">
					<div class="text-box">
						<a href="<?=$arSections['SECTION_PAGE_URL'];?>" class="katalog-title-link"><?=$arSections['NAME'];?></a>
						<?if( strlen($arSections['DESCRIPTION']) ){?>
							<p><?=$arSections['DESCRIPTION'];?></p>
						<?}?>						
					</div>
				</div>
			</div>
		</div>		
	<?
		if($n%2==0){
			echo '</div>';			
		}
		if( ( $n == intval($arParams['VIEW_SEC_COUNTS']) && $n%2!=0 ) || ( $n == count($arResult['SECTIONS']) && $n%2!=0 ) ){
			echo '</div>';
		}
		if( $n == intval($arParams['VIEW_SEC_COUNTS']) ){
			break;
		}		
	?>	
	<?}?>
