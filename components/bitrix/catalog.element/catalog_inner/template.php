<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use \Bitrix\Main\Localization\Loc;

/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 * @var CatalogSectionComponent $component
 * @var CBitrixComponentTemplate $this
 * @var string $templateName
 * @var string $componentPath
 * @var string $templateFolder
 */

$this->setFrameMode(true);
?>
<input type="hidden" id="element-name" value="<?=$arResult["NAME"]?>" />
<input type="hidden" id="element-id" value="<?=$arResult["ID"]?>" />

<div class="inner-row catalog-element-detail products">
	<div class="col-sm-6 catalog-slider-container">
		<?if($arParams["DISPLAY_PICTURE"]!="N"){?>
			<div class="inner-slider-block">
				<?
				if( count($arResult["GALLERY_PHOTOS"])>1 ){
				?>
					
					<div id="inner-page-slider" class="owl-carousel owl-theme">
						<?
							$n=0;
							foreach ($arResult["GALLERY_PHOTOS"] as $arGallery) {
								$n++;									
						?>
								<div data-thumb='<div class="serv-owl-thumbs round-agle" style="background-color:#fff;background-image: url(<?=$arGallery['src']?>)"></div>' class="item round-agle service-slider-item item-<?=$n?>">
									<div class="flex-box item-image round-agle" style="background-image: url(<?=$arGallery['src']?>)">
										<a target="_blank" href="<?=$arGallery['src']?>" class="product-detail bg-shadow zooming-link"></a>
									</div>
								</div>
						<?		
							}
						?>
					</div>
					<?
					if( is_array($arResult['PROPERTIES']['CAT_APPLIANCES']) && strlen($arResult['PROPERTIES']['CAT_APPLIANCES']['VALUE'])>0 ){
					?>
						<span class="product-lable round-agle"><?=$arResult['PROPERTIES']['CAT_APPLIANCES']['VALUE']?></span>
					<?
					}
					?>					
										
				<?
				}
				else{
					if( is_array($arResult["DETAIL_PICTURE"]) ){
						
						$image_file = CFile::ResizeImageGet($arResult["DETAIL_PICTURE"]["ID"], array('width'=>700, 'height'=>400), BX_RESIZE_IMAGE_PROPORTIONAL, true);
					
					
				?>						
							<div class="detail-page-image item round-agle service-slider-item">
								<div class="flex-box item-image round-agle" style="background-image: url(<?=$image_file['src']?>)">
									&nbsp;
									<a target="_blank" href="<?=$image_file['src']?>" class="product-detail bg-shadow zooming-link"></a>
								</div>
							</div>
						
				<?	
					}
				}
				?>
				<?
				if( is_array($arResult['PROPERTIES']['CAT_APPLIANCES']) && strlen($arResult['PROPERTIES']['CAT_APPLIANCES']['VALUE'])>0 ){
				?>
					<span class="product-lable round-agle"><?=$arResult['PROPERTIES']['CAT_APPLIANCES']['VALUE']?></span>
				<?
				}
				?>
			</div>
			<div class="cls"></div>
		<?}?>
	</div>
	<div class="col-sm-6">
		<div class="preview-text-block">
			<?
			if( strlen($arResult["PREVIEW_TEXT"])>0 ){
			?>
				<div class="element-preview-text cat_preview">
					<?=$arResult["PREVIEW_TEXT"]?>
				</div>			
			<?
			}
			?>
			<?
			if( strlen($arResult["PROPERTIES"]["CAT_PRICE"]["VALUE"])>0 ){
			?>
				<div class="element-price">
					<span class="price-name"><?=$arResult["PROPERTIES"]["CAT_PRICE"]["NAME"]?>:</span> <span class="price"><?=$arResult["PROPERTIES"]["CAT_PRICE"]["VALUE"]?> <?=GetMessage('PRICE_CURANCE_R');?></span>
				</div>
			<?
			}
			?>
				<div class="btn-block element-btn-block">
					<a href="javascript:void(0)" class="btn btn-color btn-md-lg cat-btn-order-ajax"><?=GetMessage('BTN_ORDER_TEXT');?></a>
				</div>
		</div>

		<div class="cls"></div>
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
	</div>
	<div class="cls"></div>

	<div class="col-xs-12 detail-info-block">
		<?
		if( strlen($arResult["DETAIL_TEXT"])>0 ){
		?>
			<h3><?=GetMessage('DETAIL_TEXT_LABLE');?></h3>
			<div class="cat-detail-text">
				<?=$arResult["DETAIL_TEXT"]?>
			</div>
		<?
		}
		?>
	
		<?			
		if( $arResult["ELEM_PROP_GR_PROPERTIES_CHECK"]>0 ){
			$check_props_in_right = 0;
		?>
			<div class="cls"></div>
			<div class="more-text-block">
				<h3><?=GetMessage("DT_LSM_ELEM_PROPS_GR_HEADER")?></h3>
				<div id="wrap-dots-betwins">
				    <ul>
				    	<?
				    		if(strlen($arResult["PROPERTIES"]["CAT_ELEM_PROP_GR_BRAND"]["VALUE"])>0){
				    			$check_props_in_right++;
				    	?>
						<li><em><?=$arResult["PROPERTIES"]["CAT_ELEM_PROP_GR_BRAND"]["NAME"]?></em><span><?=$arResult["PROPERTIES"]["CAT_ELEM_PROP_GR_BRAND"]["VALUE"]?></span></li>
				    	<?
				    		}
				    	?>
				        
						<?
				    		if(strlen($arResult["PROPERTIES"]["CAT_ELEM_PROP_GR_TYPE"]["VALUE"])>0){
				    	?>
				        		<li><em><?=$arResult["PROPERTIES"]["CAT_ELEM_PROP_GR_TYPE"]["NAME"]?></em><span><?=$arResult["PROPERTIES"]["CAT_ELEM_PROP_GR_TYPE"]["VALUE"]?></span></li>
				        <?
				    		}
				    	?>
				    	<?
				    		if(strlen($arResult["PROPERTIES"]["CAT_ELEM_PROP_GR_COLOR"]["VALUE"])>0){
				    	?>
				        		<li><em><?=$arResult["PROPERTIES"]["CAT_ELEM_PROP_GR_COLOR"]["NAME"]?></em><span><?=$arResult["PROPERTIES"]["CAT_ELEM_PROP_GR_COLOR"]["VALUE"]?></span></li>
				        <?
				    		}
				    	?>
				    	<?
				    		if(strlen($arResult["PROPERTIES"]["CAT_ELEM_PROP_GR_VOLTAGE"]["VALUE"])>0){
				    			$check_props_in_right++;
				    	?>
				        		<li><em><?=$arResult["PROPERTIES"]["CAT_ELEM_PROP_GR_VOLTAGE"]["NAME"]?></em><span><?=$arResult["PROPERTIES"]["CAT_ELEM_PROP_GR_VOLTAGE"]["VALUE"]?></span></li>
				        <?
				    		}
				    	?>			    
				    </ul>
				</div>
			</div>
		<?
		}
		?>
		<div class="cls"></div>		
		<?if( is_array($arResult["DOC_FILES"]) ){?>
			<div class="doc-files-container">
				<h3 class="list-elements-title"><?=GetMessage('IN_DOC_FILES')?></h3>
				<div class="row">
					<?
						$n=0;
						if( is_array($arResult["DOC_FILES"][0][1]) ){
							$arResult["DOCS_FILES"] = $arResult["DOC_FILES"][0];
						}
						else{
							$arResult["DOCS_FILES"] = $arResult["DOC_FILES"];
						}
					
						foreach ($arResult["DOCS_FILES"] as $arDocs) {
							$n++;
							unset($file_name, $file_type, $fileName);
							$file_name = explode('.', $arDocs["ORIGINAL_NAME"]);
							$file_type = array_pop($file_name);
							if( ToUpper($file_type) == 'DOCX'){
								$file_type = 'DOC';
							}
					?>
							<div class="col-xs-12 col-sm-6">
								<div class="flex-box file-name-flex-box">
									<div class="file-types-icon-wrap">
										<a target="_blank" href="<?=$arDocs["SRC"]?>">
											<object id="file-type-<?=$file_type?>" class="file-types" type="image/svg+xml" data="<?=SITE_TEMPLATE_PATH?>/img/<?=ToUpper($file_type)?>.svg" width="53" height="61">
												<img class="img-responsive" src="<?=SITE_TEMPLATE_PATH?>/img/<?=ToUpper($file_type)?>.svg" alt="" />
											</object>
										</a>
									</div>
									<div class="file-name-wrap">								
										<a target="_blank" href="<?=$arDocs["SRC"]?>">
											<?
												if( strlen($file_name[0]) ){
													
													if( strlen($file_name[0])>19 ){
														$fileName = strip_tags($file_name[0]);
														$fileName = substr($file_name[0], 0, 19) . '...';
														$fileName = rtrim($fileName, '!,.-()');
														//$fileName = substr($fileName, 0, strrpos($fileName, ' '));							
														
													}
													if( strlen($fileName)>0 ){
											?>
														<!-- <span class="file-name-text"><?=$fileName?> (<?=$file_type?>)</span> -->
														<span class="file-name-text"><?=GetMessage('DT_LSM_DEF_FILE_NAME')?> (<?=$file_type?>)</span>
											<?
													}else{
											?>
														<span class="file-name-text"><?=GetMessage('DT_LSM_DEF_FILE_NAME')?> (<?=$file_type?>)</span>
											<?
													}
												}
											?>
																					
										</a>
										<span class="file-size"><?=CFile::FormatSize($arDocs["FILE_SIZE"]);?></span>
									</div>
								</div>
							</div>	
					<?
							if( $n%2==0 && $n<count($arResult["DOC_FILES"]) ){
								echo '</div><div class="row">';
							}
						}
					?>
					<div class="cls"></div>
				</div> <!-- /row -->			
			</div>
		<?}?>

		<?
			if( count($arResult["CAT_FEATURED_ITEMS"])>0 ){
		?>

			<div class="container-fluid cat_featured-block">
				<div class="row">
					<div class="completed-header">
						<h3 class="list-elements-title"><?=GetMessage('IN_CAT_FEATURED')?></h3>
					</div>					
				</div>
				
				<div class="row">

					<div id="cat-featured-inner-carusel-1" class="owl-carousel owl-theme">
						<?
						if( count($arResult["CAT_FEATURED_ITEMS"])>0 ){			
							foreach ($arResult["CAT_FEATURED_ITEMS"] as $arProducts) {
								if( $arProducts["PREVIEW_PICTURE"]>0 ){
									$img_file = CFile::ResizeImageGet($arProducts["PREVIEW_PICTURE"], array('width'=>250, 'height'=>250), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, true);
								}
								else{
									$img_file = array("src"=>SITE_TEMPLATE_PATH."/img/default-image.png", "width"=>"250", "height"=>"250");
								}				
						?>
								<div class="item product-item">									
									<div class="img-box round-agle scale-img-box">
										<div class="flex-box">
											<span class="relative-box"><img src="<?=$img_file['src'];?>" alt="<?=$arProducts['NAME'];?>" class="img-responsive center-block"></span>
										</div>
										<a href="<?=$arProducts['DETAIL_PAGE_URL'];?>" class="product-detail bg-shadow"></a>
										<?
										if( strlen($arProducts['PROPERTY_CAT_APPLIANCES_VALUE'])>0 ){
										?>
											<span class="product-lable round-agle"><?=$arProducts['PROPERTY_CAT_APPLIANCES_VALUE']?></span>
										<?
										}
										?>
									</div>
									<?
									if( strlen($arProducts['NAME'])>0 ){
									?>										
									<div class="prop-name">
										<a href="<?=$arProducts['DETAIL_PAGE_URL']?>">
											<h3 class="list-elements-title"><?=$arProducts['NAME']?></h3>
										</a>
									</div>
									<?
									}
									?>
									<?
									if( strlen($arProducts['PROPERTY_CAT_PRICE_VALUE'])>0 ){
									?>
									<div class="prop-price">
										<span class="price"><?=$arProducts['PROPERTY_CAT_PRICE_VALUE']?> <?=GetMessage('PRICE_CURANCE_RUB');?></span>
									</div>
									<?
									}
									?>
								</div>
						<?
							}	
						}
						?>
					</div>
					<div class="cls"></div>		
				</div>
			</div>
		<?	
		}
		?>
	
	
	</div>
</div> <!-- /inner-row -->
<div class="cls"></div>