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

<div class="row reviews-body">
	<?foreach($arResult["ITEMS"] as $arItem){?>
	<?
	$n++;
	if($n%2==0){
		$left_right = 'right';
	}
	else{
		$left_right = 'left';
	}
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
	<div class="col-xs-12 col-lg-6 <?=$left_right;?>">
		<div class="content-wrap round-agle" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
			<div class="img-box">									
				<?
				if( $arItem["PROPERTIES"]["AVATARS_PIC"]["VALUE"] > 0 ){
					$img_file = CFile::ResizeImageGet($arItem["PROPERTIES"]["AVATARS_PIC"]["VALUE"], array('width'=>100, 'height'=>100), BX_RESIZE_IMAGE_EXACT, true);
				?>
					<img src="<?=$img_file['src'];?>" alt="">
				<?
				}
				else{
				?>
					<img src="<?=SITE_TEMPLATE_PATH;?>/img/reviews/review-def-1.png" alt="">
				<?
				}
				?>									
			</div>
			<div class="row review-wrap">
				<div class="col-xs-12">
					<?if( strlen($arItem["PROPERTIES"]["REVIEWS_TEXT"]["~VALUE"]["TEXT"]) ){?>
						<div class="review-content">
							
								<?
								$arItem["REVIEWS_TEXT"] = $arItem["PROPERTIES"]["REVIEWS_TEXT"]["~VALUE"]["TEXT"];
									$obParser = new CTextParser;
									if($arParams["PREVIEW_TRUNCATE_LEN"] > 0){
										$arItem["REVIEWS_TEXT"] = $obParser->html_cut($arItem["REVIEWS_TEXT"], $arParams["PREVIEW_TRUNCATE_LEN"]);
									}													
									echo $arItem["REVIEWS_TEXT"];
								?>
							
						</div>
					<?}?>
					
					<?
					if( strlen($arItem["PROPERTIES"]["REVIEWER_FIO"]["VALUE"]) ){
					?>
						<div class="review-user-name"><?echo $arItem["PROPERTIES"]["REVIEWER_FIO"]["VALUE"];?></div>
					<?
					}
					?>
					<?
					if( strlen($arItem["PROPERTIES"]["REVIEWER_SOC_STATUS"]["VALUE"]) ){
					?>
						<div class="review-user-soc-position"><?echo $arItem["PROPERTIES"]["REVIEWER_SOC_STATUS"]["VALUE"];?></div>
					<?
					}
					?>
				</div>
			</div>
		</div>
	</div>
	<?
	}
	?>	

</div> <!-- /row -->