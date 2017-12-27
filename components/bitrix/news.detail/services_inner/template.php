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
					<div class="detail-page-image">
						<span class="round-agle">
							<img src="<?=$image_file['src']?>" alt="" class="img-responsive center-block">
						</span>
					</div>
			<?	
				}
			}
			?>
			<div class="cls"></div>
	<?}?>

	<?
	if( strlen($arResult["DETAIL_TEXT"])>0 ){
	?>
		<div class="detail-text">
			<?=$arResult["DETAIL_TEXT"];?>
		</div>
		<div class="cls"></div>
	<?
	}
	?>
	
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
	
</div>

<?
	if( count($arResult["COMPLETED_PROJECTS_ITEMS"])>0 ){
?>

	<div class="container-fluid services-body completed_projects-block">
		<div class="row">
			<div class="completed-header">
				<h3 class="list-elements-title"><?=GetMessage('IN_COMPLETED_PROJECTS')?></h3>
			</div>
			<?
			if( strlen($arResult["PROPERTIES"]["DESC_COMPLETED_PROJECTS"]["~VALUE"]["TEXT"]) ){
			?>
				<div class="row">			
					<div class="col-xs-12">				
						<?=$arResult["PROPERTIES"]["DESC_COMPLETED_PROJECTS"]["~VALUE"]["TEXT"]?>
					</div>
					<div class="cls"></div>
				</div>
			<?	
			}
			?>
		</div>
		
		<div class="row">

			<div id="services-inner-carusel-1" class="owl-carousel owl-theme">
				<?
				if( count($arResult["COMPLETED_PROJECTS_ITEMS"])>0 ){			
					foreach ($arResult["COMPLETED_PROJECTS_ITEMS"] as $arPrjects) {
						if( $arPrjects["PREVIEW_PICTURE"]>0 ){
							$img_file = CFile::ResizeImageGet($arPrjects["PREVIEW_PICTURE"], array('width'=>360, 'height'=>230), BX_RESIZE_IMAGE_EXACT, true);
						}
						else{
							$img_file = array("src"=>SITE_TEMPLATE_PATH."/img/default-image.png", "width"=>"370", "height"=>"260");
						}				
				?>
						<div class="item">
							<div class="round-agle">
								<div class="img-box round-agle scale-img-box">
									<a href="<?=$arPrjects['DETAIL_PAGE_URL']?>">
										<img src="<?=$img_file['src'];?>" width="<?=$img_file['width'];?>" height="<?=$img_file['height'];?>" alt="" class="img-responsive center-block">
									</a>
								</div>
								<div class="proj-sec-name">								
										<p><?=$arResult["PROJECTS_SECTION_INFO"][$arPrjects["IBLOCK_SECTION_ID"]]["NAME"]?></p>
								</div>
								<div class="proj-name">
									<a href="<?=$arPrjects['DETAIL_PAGE_URL']?>">
										<h3 class="list-elements-title"><?=$arPrjects['NAME']?></h3>
									</a>
								</div>						
							</div>
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
<div class="cls"></div>
<div class="advice-blocks round-agle">
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
				"PATH" => SITE_DIR . 'include/advice/tpl_inner.php'
			)
		);
	?>
</div>