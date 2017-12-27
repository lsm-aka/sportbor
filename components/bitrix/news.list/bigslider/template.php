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
<div class="slider-block">
	<div id="owl1" class="owl-carousel">
		<?foreach($arResult["ITEMS"] as $arItem):?>
			<?
			$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
			$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
			?>
			<div class="sl-item <?=$arItem['PROPERTIES']['SLIDER_BG_COLOR']['VALUE'];?>" style="background-image:url(<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>)"> 
		  		<div class="container">
		  			<div class="col-md-7 col-lg-7 no-padding-x">
		  				<div class="slider-table">
		  					<div class="slider-table-cell">
		  						<h3 class="slider-title"><?echo $arItem["NAME"]?></h3>
								<p class="slider-desc">
									<?if($arParams["DISPLAY_PREVIEW_TEXT"]!="N" && $arItem["PREVIEW_TEXT"]):?>
										<?echo $arItem["PREVIEW_TEXT"];?>
									<?endif;?>										
								</p>
								<div class="slider-btns">
									<ul class="list-inline">
									<?if( strlen($arItem['PROPERTIES']['TEXT_SL_BTN_1']['VALUE'])>0 ){?>
										<li><a href="<?=$arItem['PROPERTIES']['LINK_SL_BTN_1']['VALUE'];?>" class="btn btn-color btn-lg"><?=$arItem['PROPERTIES']['TEXT_SL_BTN_1']['VALUE'];?></a></li>
									<?}?>
									<?if( strlen($arItem['PROPERTIES']['TEXT_SL_BTN_2']['VALUE'])>0 ){?>	
										<li><a href="<?=$arItem['PROPERTIES']['LINK_SL_BTN_2']['VALUE'];?>" class="btn btn-default btn-lg"><?=$arItem['PROPERTIES']['TEXT_SL_BTN_2']['VALUE'];?></a></li>
									<?}?>
									</ul>
								</div>
		  					</div>
		  				</div>
	  				</div>			  			
				</div>			
		  </div> 
		<?endforeach;?>
	</div>

	<div class="owl-nav-block">
		<div class="container-fluid">
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
</div>