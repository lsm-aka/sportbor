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
				<div class="inner-slider-block block-full">
					<div id="inner-page-slider" class="owl-carousel owl-theme">
						<?
							$n=0;
							foreach ($arResult["GALLERY_PHOTOS"] as $arGallery) {
								$n++;
						?>
								<div data-thumb='<div class="serv-owl-thumbs round-agle" style="background-color:#fff;background-image: url(<?=$arGallery['src']?>)">&nbsp;</div>' class="item round-agle project-slider-item item-<?=$n?>">
									<div class="flex-box item-image round-agle" style="background-image: url(<?=$arGallery['src']?>)">
										<a target="_blank" href="<?=$arGallery['src']?>" class="zooming-link"></a>
									</div>
								</div>
						<?		
							}
						?>
					</div>	
					<div class="owl-nav-hidden owl-nav round-agle owl-prev animated fadeInLeft">
						<span class="lsm-stack">					 
							 <span class="icon-angle-left lsm-stack-1x"></span>
						</span>
					</div>
					<div class="owl-nav-hidden owl-nav round-agle owl-next animated fadeInRight">
						<span class="lsm-stack">					 
							 <span class="icon-angle-right lsm-stack-1x"></span>
						</span>
					</div>
				</div>			
			<?
			}
			else{
				if( is_array($arResult["DETAIL_PICTURE"]) ){

					$image_file = CFile::ResizeImageGet($arResult["DETAIL_PICTURE"]["ID"], array('width'=>1400, 'height'=>800), BX_RESIZE_IMAGE_PROPORTIONAL, true);
				
				
			?>

				<div class="inner-slider-block block-full">
					<div id="inner-page-slider">						
						<div class="item round-agle project-slider-item item-01">
							<div class="flex-box item-image round-agle" style="background-image: url(<?=$image_file['src']?>)">&nbsp;</div>
						</div>
					</div>						
				</div>						
								
			<?	
				}
				elseif( is_array($arResult["PREVIEW_PICTURE"]) ){
					$image_file = CFile::ResizeImageGet($arResult["PREVIEW_PICTURE"]["ID"], array('width'=>1400, 'height'=>800), BX_RESIZE_IMAGE_PROPORTIONAL, true);
			?>
				<div class="inner-slider-block block-full">
					<div id="inner-page-slider">						
						<div class="item round-agle project-slider-item item-01">
							<div class="flex-box item-image round-agle" style="background-image: url(<?=$image_file['src']?>)">&nbsp;</div>
						</div>
					</div>						
				</div>
			<?
				}
			}
			?>
			<div class="cls"></div>
	<?}?>
	
	
	<div class="col-xs-12 flex-elements col-md-9 element-l">
		<div class="detail-text">
			<h3><?=$arResult["NAME"]?></h3>
			<?			
			if( strlen($arResult["DETAIL_TEXT"])>0 ){
			?>
				
					<?=$arResult["DETAIL_TEXT"];?>
				
			<?
			}
			?>
			<?			
			if( strlen($arResult["PROPERTIES"]["MORE_TEXT_BLOCK"]["~VALUE"]["TEXT"])>0 ){
			?>
				<div class="cls"></div>
				<div class="more-text-block">
					<?=$arResult["PROPERTIES"]["MORE_TEXT_BLOCK"]["~VALUE"]["TEXT"];?>
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
					    		if(strlen($arResult["PROPERTIES"]["ELEM_PROP_GR_AREA"]["VALUE"])>0){
					    			$check_props_in_right++;
					    	?>
									<li><em><?=$arResult["PROPERTIES"]["ELEM_PROP_GR_AREA"]["NAME"]?></em><span><?=$arResult["PROPERTIES"]["ELEM_PROP_GR_AREA"]["VALUE"]?></span></li>
					    	<?
					    		}
					    	?>
					        
							<?
					    		if(strlen($arResult["PROPERTIES"]["ELEM_PROP_GR_ADRES"]["VALUE"])>0){
					    	?>
					        		<li><em><?=$arResult["PROPERTIES"]["ELEM_PROP_GR_ADRES"]["NAME"]?></em><span><?=$arResult["PROPERTIES"]["ELEM_PROP_GR_ADRES"]["VALUE"]?></span></li>
					        <?
					    		}
					    	?>
					    	<?
					    		if(strlen($arResult["PROPERTIES"]["ELEM_PROP_GR_CATEGORY"]["VALUE"])>0){
					    	?>
					        		<li><em><?=$arResult["PROPERTIES"]["ELEM_PROP_GR_CATEGORY"]["NAME"]?></em><span><?=$arResult["PROPERTIES"]["ELEM_PROP_GR_CATEGORY"]["VALUE"]?></span></li>
					        <?
					    		}
					    	?>
					    	<?
					    		if(strlen($arResult["PROPERTIES"]["ELEM_PROP_GR_CUSTOMER"]["VALUE"])>0){
					    			$check_props_in_right++;
					    	?>
					        		<li><em><?=$arResult["PROPERTIES"]["ELEM_PROP_GR_CUSTOMER"]["NAME"]?></em><span><?=$arResult["PROPERTIES"]["ELEM_PROP_GR_CUSTOMER"]["VALUE"]?></span></li>
					        <?
					    		}
					    	?>
					    	<?
					    		if(strlen($arResult["PROPERTIES"]["ELEM_PROP_GR_DATE"]["VALUE"])>0){
					    			$check_props_in_right++;
					    	?>
					        		<li><em><?=$arResult["PROPERTIES"]["ELEM_PROP_GR_DATE"]["NAME"]?>:</em><span><?=$arResult["PROPERTIES"]["ELEM_PROP_GR_DATE"]["VALUE"]?></span></li>
					        <?
					    		}
					    	?>
					    	<?
					    		if(strlen($arResult["PROPERTIES"]["ELEM_PROP_GR_ARCHITECT"]["VALUE"])>0){
					    	?>
					        		<li><em><?=$arResult["PROPERTIES"]["ELEM_PROP_GR_ARCHITECT"]["NAME"]?></em><span><?=$arResult["PROPERTIES"]["ELEM_PROP_GR_ARCHITECT"]["VALUE"]?></span></li>
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
	</div>
	<div class="col-xs-12 col-md-3 flex-elements element-r">
		<?			
		if( $check_props_in_right>0 ){
		?>
			<div class="right-props-container round-agle">
				<?
					if(strlen($arResult["PROPERTIES"]["ELEM_PROP_GR_DATE"]["VALUE"])>0){
				?>
						<div class="prop-group">
							<div class="prop-1"><?=$arResult["PROPERTIES"]["ELEM_PROP_GR_DATE"]["NAME"]?></div>
							<div class="prop-2"><?=$arResult["PROPERTIES"]["ELEM_PROP_GR_DATE"]["VALUE"]?></div>
						</div>
				<?
					}
				?>
				<?
					if(strlen($arResult["PROPERTIES"]["ELEM_PROP_GR_CUSTOMER"]["VALUE"])>0){
				?>
						<div class="prop-group">
							<div class="prop-1"><?=$arResult["PROPERTIES"]["ELEM_PROP_GR_CUSTOMER"]["NAME"]?></div>
							<div class="prop-2"><?=$arResult["PROPERTIES"]["ELEM_PROP_GR_CUSTOMER"]["VALUE"]?></div>
						</div>
				<?
					}
				?>

				<?
					if(strlen($arResult["PROPERTIES"]["ELEM_PROP_GR_AREA"]["VALUE"])>0){
				?>
						<div class="prop-group">
							<div class="prop-1"><?=$arResult["PROPERTIES"]["ELEM_PROP_GR_AREA"]["NAME"]?></div>
							<div class="prop-2"><?=$arResult["PROPERTIES"]["ELEM_PROP_GR_AREA"]["VALUE"]?></div>
						</div>
				<?
					}
				?>
			</div>
		<?
		}
		?>
		<div class="cls"></div>
		<?$APPLICATION->IncludeComponent(
			"bitrix:main.include", 
			"section_inc1", 
			Array(
				"AREA_FILE_SHOW" => "sect",	
				"AREA_FILE_SUFFIX" => "inc",
				"AREA_FILE_RECURSIVE" => "Y",
				"EDIT_TEMPLATE" => "standard.php",
			),
			false
		);?>
	</div>		
	
<div class="cls"></div>
	<div class="next-prev-pager">
	    <div class="pager-text-left col-xs-5">
	        <?if(!empty($arResult["LEFT_PAGE"])):?>
	            <a class="ts-prev-page" title="<?=$arResult["LEFT_PAGE"]["NAME"]?>" href="<?=$arResult["LEFT_PAGE"]["URL"]?>">
	            	<div class="flex-box">
	            		<span class="icon-angle-left"></span>
	            		<span class="pager-text-prev hidden-xs"><?=GetMessage("DT_LSM_PREV_PAGE")?></span>
	            	</div>
	            </a>
	        <?endif?>
	    </div>
	    <div class="col-xs-2">
	    	<div class="pager-text-right-dots-block">
		    	<a href="<?=SITE_DIR?>projects/"><img src="<?=SITE_TEMPLATE_PATH?>/img/projects/page_nav.png" alt=""></a>
		    </div>
	    </div>
	    <div class="pager-text-right col-xs-5">
	        <?if(!empty($arResult["RIGHT_PAGE"])):?>
	            <a class="ts-next-page" title="<?=$arResult["RIGHT_PAGE"]["NAME"]?>" href="<?=$arResult["RIGHT_PAGE"]["URL"]?>">
	            	<div class="flex-box">
	            		<span class="pager-text-next hidden-xs"><?=GetMessage("DT_LSM_NEXT_PAGE")?></span>
	            		<span class="icon-angle-right"></span>
	            	</div>
	            </a>
	        <?endif?>
	    </div>
	</div>
</div>